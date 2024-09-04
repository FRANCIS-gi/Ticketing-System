<?php

namespace app\controllers;

class DashboardController extends \yii\web\Controller
{
    public function actionAnnually()
    {
        return $this->render('annually');
    }

    public function actionIndex()
    {
        $sidebarFile = 'sidebar-dashboards';
        

        return $this->render('index', [
            'sidebarFile' => $sidebarFile,
            
        ]);
    }

    public function actionMonthly()
    {
        return $this->render('monthly');
    }

    public function actionQuaterly()
    {
        return $this->render('quaterly');
    }

    public function actionWeekly()
    {
        return $this->render('weekly');
    }

}
