<?php

namespace app\models;

use yii\db\ActiveRecord;

class Developer extends ActiveRecord
{
    public static function tableName()
    {
        return 'developer';
    }

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['name', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
            ['created_at', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];
    }

    public function getAssignedTickets()
    {
        return $this->hasMany(Ticket::class, ['assigned_to' => 'id']);
    }
}