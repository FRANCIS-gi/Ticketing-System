
<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionAdminPanel()
    {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin) {
            // The user is logged in and is an admin
            return $this->render('admin-panel');
        } else {
            throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page.');
        }
    }
}
 
