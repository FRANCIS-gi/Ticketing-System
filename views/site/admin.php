<?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\grid\GridView;

$this->title = 'Admin Panel - All Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-default-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <?= Nav::widget([
                'options' => ['class' => 'nav-pills flex-column'],
                'items' => [
                    ['label' => 'Tickets', 'url' => ['admin/tickets'], 'active' => true],
                    ['label' => 'Users', 'url' => ['admin/users']],
                    ['label' => 'Settings', 'url' => ['admin/settings']],
                    ['label' => 'Analytics', 'url' => ['admin/analytics']],
                ],
            ]) ?>
        </div>
        <div class="col-md-9">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'title',
                    'description:ntext',
                    [
                        'attribute' => 'user_id',
                        'value' => 'user.username', // Assuming you have a relation set up to the User model
                    ],
                    'status',
                    'created_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['ticket/view', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'View'),
                                    'data-pjax' => '0',
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['ticket/update', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Update'),
                                    'data-pjax' => '0',
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['ticket/delete', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>