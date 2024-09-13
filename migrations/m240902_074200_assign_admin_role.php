<?php

use yii\db\Migration;

class m230902_123456_assign_admin_role extends Migration
{
    public function up()
    {
        $authManager = Yii::$app->authManager;

        $user1 = User::find()->where(['email' => 'ccosmas001@gmail.com'])->one();
        $user2 = User::find()->where(['email' => 'ptiongik@gmail.com'])->one();

        $authManager->assign($authManager->getRole('admin'), $user1->id);
        $authManager->assign($authManager->getRole('admin'), $user2->id);
    }

    public function down()
    {
        $authManager = Yii::$app->authManager;

        $user1 = User::find()->where(['email' => 'ccosmas001@gmail.com'])->one();
        $user2 = User::find()->where(['email' => 'ptiongik@gmail.com'])->one();

        $authManager->revoke($authManager->getRole('admin'), $user1->id);
        $authManager->revoke($authManager->getRole('admin'), $user2->id);
    }
}