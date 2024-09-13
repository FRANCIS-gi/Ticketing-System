<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SignupForm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'company_name') ?>
<?= $form->field($model, 'company_email')->textInput(['type' => 'email']) ?>
<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'role')->dropDownList([
    'user' => 'User',
    'project_manager' => 'Project Manager',
    'ceo' => 'CEO',
], ['prompt' => 'Select Role']) ?>

<div class="form-group">
    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary']) ?>
</div>
<li class="nav-item">
    <?= Html::a('Login', ['site/login'], ['class' => 'nav-link']) ?>

<?php ActiveForm::end(); ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= Yii::$app->session->getFlash('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
