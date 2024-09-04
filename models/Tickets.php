<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $ticket_id
 * @property string $company_name
 * @property string $ticket_name
 * @property string $description
 * @property string $priority
 * @property string $status
 * @property int|null $due_date
 * @property string $created_by
 * @property string $assigned_to
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'ticket_name', 'description', 'priority', 'status', 'created_by', 'assigned_to'], 'required'],
            [['description'], 'string'],
            [['due_date'], 'integer'],
            [['company_name', 'ticket_name', 'priority', 'status', 'created_by', 'assigned_to'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'company_name' => Yii::t('app', 'Company Name'),
            'ticket_name' => Yii::t('app', 'Ticket Name'),
            'description' => Yii::t('app', 'Description'),
            'priority' => Yii::t('app', 'Priority'),
            'status' => Yii::t('app', 'Status'),
            'due_date' => Yii::t('app', 'Due Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'assigned_to' => Yii::t('app', 'Assigned To'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TicketsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketsQuery(get_called_class());
    }
}
