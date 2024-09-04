<?php

use yii\db\Migration;

/**
 * Class m240821_095511_tickets_table
 */
class m240821_095511_tickets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tickets', [
            'ticket_id' => $this->primaryKey(),
            'company_name' => $this->string(255)->notNull(),
            'ticket_name' => $this->string(255)->notNull(),

            'description' => $this->text(),
            'priority' => $this->date()->notNull(),
            'status' => $this->date(),
            'due_date' => $this->string(50)->notNull(),
            'created_by' => $this->integer()->notNull(),
            'assigned_to' => $this->integer()->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240821_095511_tickets_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240821_095511_tickets_table cannot be reverted.\n";

        return false;
    }
    */
}
