<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $developers app\models\Developer[] */

$form = ActiveForm::begin();

echo $form->field($model, 'assigned_to')->dropDownList(
    \yii\helpers\ArrayHelper::map($developers, 'id', 'name'),
    ['prompt' => 'Select a developer']
);

$isDisabled = $model->developer_id && $model->status === 'Approved';

echo Html::submitButton('Assign', [
    'class' => 'btn btn-primary',
    'disabled' => $isDisabled
]);

ActiveForm::end();

if ($isDisabled) {
    echo '<p class="text-warning">This ticket is already assigned and approved. Assignment cannot be changed.</p>';
}
?>