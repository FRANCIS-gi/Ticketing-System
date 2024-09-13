<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title', // Assuming 'title' is a valid attribute
            'description',
            'status',
            'company_email', // Directly using comp_email attribute
            [
                'attribute' => 'developer.name',
                'label' => 'Assigned Developer',
                'value' => function ($model) {
                    return $model->developer ? $model->developer->name : 'Not Assigned';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{approve} {assign} {cancel}',
                'buttons' => [
                    'approve' => function ($url, $model, $key) {
                        $isDisabled = $model->status !== 'pending' || $model->assigned_to !== null;
                        return Html::a('Approve', '#', [
                            'class' => 'btn btn-success' . ($isDisabled ? ' disabled' : ''),
                            'title' => 'Approve Ticket',
                            'onclick' => $isDisabled ? 'return false;' : new JsExpression("approveTicket($(this), {$model->id})"),
                            'data-id' => $model->id,
                            'data-status' => $model->status,
                            'disabled' => $isDisabled
                        ]);
                    },
                    'assign' => function ($url, $model, $key) {
                        // Enable Assign button if not assigned
                        $isDisabled = $model->assigned_to !== null; // Disable if already assigned
                        return Html::a('Assign', '#', [
                            'class' => 'btn btn-primary' . ($isDisabled ? ' disabled' : ''),
                            'title' => 'Assign to Dev',
                            'onclick' => $isDisabled ? 'return false;' : new JsExpression("assignTicket($(this), {$model->id})"),
                            'data-id' => $model->id,
                            'disabled' => $isDisabled
                        ]);
                    },
                    'cancel' => function ($url, $model, $key) {
                        // Disable Cancel button if the ticket is assigned and not pending
                        $isDisabled = $model->assigned_to !== null && $model->status !== 'pending';
                        return Html::a('Cancel', '#', [
                            'class' => 'btn btn-danger' . ($isDisabled ? ' disabled' : ''),
                            'title' => 'Cancel Ticket',
                            'onclick' => $isDisabled ? 'return false;' : new JsExpression("cancelTicket($(this), {$model->id})"),
                            'data-id' => $model->id,
                            'disabled' => $isDisabled
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>

<script>
function approveTicket(button, ticketId) {
    $.ajax({
        url: '<?= \yii\helpers\Url::to(['/ticket/approve']) ?>',
        type: 'POST',
        data: {
            id: ticketId,
            _csrf: '<?= Yii::$app->request->csrfToken ?>'
        },
        success: function(response) {
            if (response.success) {
                var row = button.closest('tr');
                row.find('td').eq(3).text('Approved'); // Adjusted index for status
                disableButtons(row);
            } else {
                alert('Failed to approve the ticket: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error approving ticket:', textStatus, errorThrown);
            alert('Error approving ticket: ' + errorThrown);
        }
    });
}

function assignTicket(button, ticketId) {
    window.location.href = '<?= \yii\helpers\Url::to(['/ticket/assign']) ?>' + '?id=' + ticketId;
}

function cancelTicket(button, ticketId) {
    $.ajax({
        url: '<?= \yii\helpers\Url::to(['/ticket/cancel']) ?>',
        type: 'POST',
        data: {
            id: ticketId,
            _csrf: '<?= Yii::$app->request->csrfToken ?>'
        },
        success: function(response) {
            if (response.success) {
                var row = button.closest('tr');
                // Remove the row from the GridView
                row.remove();
                
                // Show a message to the user
                alert('Ticket has been cancelled.');
            } else {
                alert('Failed to cancel the ticket: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error cancelling ticket:', textStatus, errorThrown);
            alert('Error cancelling ticket: ' + errorThrown);
        }
    });
}

function disableButtons(row) {
    row.find('a.btn').addClass('disabled').attr('disabled', true);
}
</script>
