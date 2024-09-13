<?php

namespace app\controllers;

use Yii;
use app\models\Developer;
use app\models\Ticket;
use app\models\TicketSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class TicketController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionCreate()
    {
        $model = new Ticket(); // Initialize the Ticket model

        // If the form is submitted and valid
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Assign the logged-in user's email to the company_email field
            $model->company_email = Yii::$app->user->identity->company_email;

            // Save the model and redirect
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        // Render the create form and pass the model to the view
        return $this->render('create', [
            'model' => $model, // Pass the model to the view
        ]);
    }

 
 

public function actionView($id = null)
{
    if (!Yii::$app->user->isGuest) {
        $companyEmail = Yii::$app->user->identity->company_email; // Changed to company_email
        
        if ($id === null) {
            // Display list of tickets for the logged-in user's company
            $query = Ticket::find()
                ->where(['company_email' => $companyEmail]); // Adjusted to company_email
            $query->orderBy(['created_at' => SORT_DESC]);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => ['created_at' => SORT_DESC],
                ],
                'pagination' => [
                    'pageSize' => 50, // Adjust as needed
                ],
            ]);
            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'companyEmail' => $companyEmail, // Changed to companyEmail
            ]);
        } else {
            // Display single ticket
            try {
                $model = $this->findModel($id);
                
                // Check if the ticket belongs to the current user's company
                if ($model->company_email !== $companyEmail) { // Adjusted to company_email
                    throw new ForbiddenHttpException('You are not allowed to view this ticket.');
                }
                
                return $this->render('view', [
                    'model' => $model,
                ]);
            } catch (NotFoundHttpException $e) {
                Yii::error('Ticket not found: ' . $id, 'ticket.view');
                throw $e;
            } catch (\Exception $e) {
                Yii::error('Error while fetching ticket: ' . $e->getMessage(), 'ticket.view');
                return $this->redirect(['view']); // Redirect to the list view
            }
        }
    } else {
        // Redirect to login if the user is not authenticated
        return $this->redirect(['site/login']);
    }
}
 

    public function actionAssign($id)
{
    $ticket = $this->findTicket($id);
    if (!$ticket) {
        Yii::$app->session->setFlash('error', 'Ticket not found.');
        return $this->redirect(['index']);
    }

    $developers = Developer::find()->all();

    if ($ticket->load(Yii::$app->request->post())) {
        $newDeveloperId = Yii::$app->request->post('Ticket')['assigned_to'];
        $newDeveloper = Developer::findOne($newDeveloperId);

        if (!$newDeveloper) {
            Yii::$app->session->setFlash('error', 'Selected developer not found.');
            return $this->render('assign', [
                'model' => $ticket,
                'developers' => $developers,
            ]);
        }

        // Limit assignments
        if ($newDeveloper->getAssignedTickets()->count() >= 3) {
            Yii::$app->session->setFlash('error', 'This developer already has 3 assigned tickets. Please choose another developer.');
            return $this->render('assign', [
                'model' => $ticket,
                'developers' => $developers,
            ]);
        }

        // Set the assigned developer
        $ticket->assigned_to = $newDeveloperId;

        // Set a valid status
        $ticket->status = 'open'; // Ensure this is a valid status according to your rules

        // Debugging: Log ticket data
        Yii::info('Ticket model data before save: ' . json_encode($ticket->attributes), __METHOD__);

        if ($ticket->save()) {
            Yii::$app->session->setFlash('success', 'Ticket assigned successfully.');
            return $this->redirect(['view', 'id' => $ticket->id]);
        } else {
            // Flatten the error messages
            $errorMessages = [];
            foreach ($ticket->getErrors() as $errors) {
                $errorMessages = array_merge($errorMessages, $errors);
            }
            
            Yii::$app->session->setFlash('error', 'Failed to assign the ticket: ' . implode(', ', $errorMessages));
        }
    }

    return $this->render('assign', [
        'model' => $ticket,
        'developers' => $developers,
    ]);
}


public function actionApprove()
{
    Yii::$app->response->format = Response::FORMAT_JSON;

    $ticketId = Yii::$app->request->post('id');
    $ticket = Ticket::findOne($ticketId);

    if ($ticket !== null) {
        $ticket->status = 'Approved'; // Update the ticket status

        if ($ticket->save()) {
            // Set a flash message for successful approval
            Yii::$app->session->setFlash('success', 'Ticket has been approved successfully.');
            return ['success' => true];
        } else {
            Yii::error('Failed to save ticket: ' . json_encode($ticket->getErrors()), 'ticket.approve');
            return ['success' => false, 'message' => 'Failed to save ticket.'];
        }
    } else {
        Yii::error('Ticket not found: ' . $ticketId, 'ticket.approve');
        return ['success' => false, 'message' => 'Ticket not found.'];
    }
}

    
    
    protected function findTicket($id)
    {
        return Ticket::findOne($id);
    }
    
 
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested ticket does not exist.');
    }


    public function actionCancel()
    {
        Yii::$app->response->format = Response::FORMAT_JSON; // Set JSON response format
    
        $id = Yii::$app->request->post('id');
        $ticket = Ticket::findOne($id);
        
        if ($ticket) {
            // Logic to cancel the ticket
            $ticket->status = 'cancelled'; // Adjust this as needed
    
            if ($ticket->save()) {
                // Optionally set a flash message for success
                Yii::$app->session->setFlash('success', 'Ticket has been canceled successfully.');
                return $this->asJson(['success' => true]);
            } else {
                Yii::error('Failed to save ticket: ' . json_encode($ticket->getErrors()), 'ticket.cancel');
                return $this->asJson(['success' => false, 'message' => 'Failed to cancel the ticket.']);
            }
        }
    
        return $this->asJson(['success' => false, 'message' => 'Ticket not found.']);
    }
    

}
