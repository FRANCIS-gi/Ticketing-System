<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to signup:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'action' => ['site/signup'],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'text-danger'],
                ],
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'company_email') ?>

            <?= $form->field($model, 'company_name') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <!-- <?= $form->field($model, 'role')->dropDownList([
                User::ROLE_USER => 'User',
                User::ROLE_ADMIN => 'Admin',
            ]) ?> -->

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <div class="form-group">
                <div class="col-lg-8">
                    <p>
                        You already have an account? <?= Html::a('Login', ['site/login']) ?>
                    </p>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>