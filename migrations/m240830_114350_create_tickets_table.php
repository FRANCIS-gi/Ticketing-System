<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tickets}}`.
 */
class m240830_114350_create_tickets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tickets}}', [
            'ticket_id' => $this->primaryKey(),
            'company_name' => $this->string()->notNull(),
            'ticket_name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'priority' => $this->string()->notNull(),
            'status' => $this->string()->notNull(),
            'due_date' => $this->integer(),
            'created_by' => $this->string()->notNull(),
            'assigned_to' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tickets}}');
    }
}
