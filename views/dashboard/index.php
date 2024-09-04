<?php

/** @var yii\web\View $this */

$this->title = 'Ticket Dashboard';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'info',
                'body' => '<h3>Ticket Overview</h3>',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Open Tickets',
                'icon' => 'fas fa-exclamation-circle',
                'theme' => 'danger'
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '53',
                'text' => 'Pending Tickets',
                'icon' => 'fas fa-clock',
                'theme' => 'warning'
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '44',
                'text' => 'Solved Tickets',
                'icon' => 'fas fa-check-circle',
                'theme' => 'success'
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '15',
                'text' => 'Unassigned Tickets',
                'icon' => 'fas fa-user-times',
                'theme' => 'info'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total Tickets',
                'number' => '262',
                'icon' => 'fas fa-ticket-alt',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Completion Rate'
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Average Response Time',
                'number' => '2.5 <small>hours</small>',
                'theme' => 'gradient-info',
                'icon' => 'far fa-clock',
                'progress' => [
                    'width' => '80%',
                    'description' => '80% within SLA'
                ]
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Callout::widget([
                'type' => 'warning',
                'head' => 'Attention: Unassigned Tickets',
                'body' => 'There are currently 15 tickets without assignment. Please review and assign these tickets to appropriate team members.'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= \hail812\adminlte\widgets\Callout::widget([
                'type' => 'info',
                'head' => 'Ticket Resolution Rate',
                'body' => 'The current ticket resolution rate is 75%. Keep up the good work!'
            ]) ?>
        </div>
    </div>
</div>