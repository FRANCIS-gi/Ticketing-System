<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Company Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Showing tickets for company email: <?= Html::encode($userEmail) ?></p>
    

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'description:ntext',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'user_id',
                'label' => 'Submitted By',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : 'N/A';
                }
            ],
            'assigned_developer_id',
            'company_name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>