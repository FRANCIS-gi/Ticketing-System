<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modelsTicketsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tickets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ticket_id') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'ticket_name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'assigned_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
