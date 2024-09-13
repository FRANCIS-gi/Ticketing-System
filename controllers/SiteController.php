<?php

namespace app\controllers;
use app\models\User;
 


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Ticket;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'about', 'contact', 'ticket', 'admin', 'create'],
                'rules' => [
                    [
                        'actions' => ['logout', 'about', 'contact', 'ticket', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['admin'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    Yii::$app->session->setFlash('error', 'Please login or create an account to access this page.');
                    return $this->redirect(['site/login']);
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }  
      public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
    


    
     * Login action.
     *
     * @return Response|string
     */

  
    public function actionLogin()
{
    if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        return $this->goBack();
    }

    $model->password = '';
    return $this->render('login', [
        'model' => $model,
    ]);
}
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */

     public function actionAbout()
     {
         $dataProvider = new ActiveDataProvider([
             'query' => Ticket::find(),
             'pagination' => [
                 'pageSize' => 20,
             ],
         ]);
 
         return $this->render('about', [
             'dataProvider' => $dataProvider,
         ]);
     


    // controllers/TicketController.php

     
    //  public function actionCancel($id)
    //  {
    //      $model = $this->findModel($id);
    //      $model->status = 'cancelled';
    //      if ($model->save()) {
    //          return json_encode(['success' => true]);
    //      }
    //      return json_encode(['success' => false]);
    //  }
     
    //  protected function findTicketModel($id)
    //  {
    //      if (($model = Ticket::findOne($id)) !== null) {
    //          return $model;
    //      }
    //      throw new NotFoundHttpException('The requested ticket does not exist.');
    //  }
 
    //  public function actionUpdateStatus()
    // {
    //     Yii::$app->response->format = Response::FORMAT_JSON; // Set response format to JSON

    //     $id = Yii::$app->request->post('id');
    //     $status = Yii::$app->request->post('status');

    //     $ticket = $this->findModel($id);
    //     $ticket->status = $status;

    //     if ($ticket->save()) {
    //         return ['success' => true];
    //     } else {
    //         return ['success' => false, 'message' => 'Unable to update ticket status.'];
    //     }
    


    /**
     * Displays admin page with all tickets.
     *
     * @return string
     */
    // public function actionAdmin()
    // {
    //     $dataProvider = new ActiveDataProvider([
    //         'query' => Ticket::find(),
    //         'pagination' => [
    //             'pageSize' => 20,
    //         ],
    //         'sort' => [
    //             'defaultOrder' => [
    //                 'created_at' => SORT_DESC,
    //             ]
    //         ],
    //     ]);

        return $this->render('admin', [
            'dataProvider' => $dataProvider,
        ]);
    }



    

    /**
     * Signup action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            // Redirect to login page after successful signup
            Yii::$app->session->setFlash('success', 'Please login to proceed.');
            return $this->redirect(['site/login']);
        }
    
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}

    /**
 
     */
//     public function actionTicket()
//     {
//         $model = new Ticket();

//         if ($model->load(Yii::$app->request->post())) {
//             $model->user_id = Yii::$app->user->id;
//             if ($model->save()) {
//                 Yii::$app->session->setFlash('success', 'Ticket created successfully.');
//                 return $this->redirect(['ticket']);
//             } else {
//                 Yii::$app->session->setFlash('error', 'Failed to create ticket. Please try again.');
//             }
//         }

//         $dataProvider = new ActiveDataProvider([
//             'query' => Ticket::find()->where(['user_id' => Yii::$app->user->id]),
//             'sort' => [
//                 'defaultOrder' => [
//                     'created_at' => SORT_DESC,
//                 ]
//             ],
//         ]);

//         return $this->render('ticket', [
//             'model' => $model,
//             'dataProvider' => $dataProvider,
//         ]);
//     }
// }