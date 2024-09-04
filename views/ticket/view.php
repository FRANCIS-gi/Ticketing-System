<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tickets $model */

$this->title = $model->ticket_id;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tickets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ticket_id' => $model->ticket_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ticket_id' => $model->ticket_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ticket_id',
            'company_name',
            'ticket_name',
            'description:ntext',
            'priority',
            'status',
            'due_date',
            'created_by',
            'assigned_to',
        ],
    ]) ?>

</div>
