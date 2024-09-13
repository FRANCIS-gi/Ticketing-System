<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;

class SignupController extends Controller
{
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Signup successful! Please login.');
            return $this->redirect(['site/login']);
        }
    
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
    