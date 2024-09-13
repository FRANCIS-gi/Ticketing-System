<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

class Ticket extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            ['title', 'string', 'max' => 255],
            ['description', 'string'],
            ['status', 'string'],
            [['status'], 'in', 'range' => ['Pending', 'Approved', 'cancelled']], // Valid status values
            ['assigned_to', 'integer'],
            ['assigned_to', 'default', 'value' => null],
            ['company_email', 'email'],
            ['assigned_to', 'exist', 'skipOnError' => true, 'targetClass' => Developer::class, 'targetAttribute' => ['assigned_to' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'assigned_to' => 'Assigned To',
            'company_email' => 'Company Email',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
  
    
    public function getDeveloper()
    {
        return $this->hasOne(Developer::class, ['id' => 'assigned_to']);
    }



    // public function getDeveloper()
    // {
    //     return $this->hasOne(User::className(), ['id' => 'developer_id']); // Adjust 'developer_id' as needed
    // }




    public function approve()
    {
        $this->status = 'approved';
        return $this->save();
    }

    public function cancel()
    {
        $this->status = 'cancelled';
        return $this->save();
    }

    public static function findTicketsByCompanyEmail($email)
    {
        return self::find()->where(['company_email' => $email])->all();
    }


    // if (!$ticket->save()) {
    //     Yii::$app->session->setFlash('error', 'Failed to assign the ticket: ' . implode(', ', $ticket->getErrors()));
    // }
    
}