<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tickets}}`.
 */
class m240827_175741_create_tickets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tickets}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'status' => $this->string()->defaultValue('open'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'assigned_to' => $this->integer()->null(),

        ]);
        $this->addForeignKey(
            'fk-ticket-assigned_to',
            'ticket',
            'assigned_to',
            'developer',
            'id',
            'SET NULL'
        );
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-ticket-assigned_to', 'ticket');

        $this->dropTable('{{%tickets}}');
    }
}
