<?php

use yii\db\Migration;

/**
 * Class m240821_120746_notifications_table
 */
class m240821_120746_notifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create the notifications table
        $this->createTable('notifications', [
            'notification_id' => $this->primaryKey(), // Primary key
            'user_id' => $this->integer()->notNull(), // Integer field for user_id
            'notification_type' => $this->string(50)->notNull(), // String field for notification type
            'message' => $this->text()->notNull(), // Text field for the message content
            // 'is_read' => $this->boolean()->defaultValue(false), // Boolean field for read status
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'), // DateTime field for creation timestamp
        ]);

        // Add foreign key constraint
        // $this->addForeignKey(
        //     'fk-notifications-user_id', // Name of the foreign key constraint
        //     'notifications', // Table name
        //     'user_id', // Column name in notifications table
        //     'users', // Referenced table
        //     'user_id', // Referenced column
        //     'CASCADE' // On delete action
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key constraint
        // $this->dropForeignKey(
        //     'fk-notifications-user_id',
        //     'notifications'
        // );

        // Drop the notifications table
        $this->dropTable('notifications');
    }
}
