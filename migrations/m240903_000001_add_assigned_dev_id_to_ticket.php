<?php
use yii\db\Migration;

class m000000_000000_add_assigned_to_column extends Migration
{
    public function up()
    {
        $this->addColumn('ticket', 'assigned_to', $this->integer()->null());

        // Add foreign key
        $this->addForeignKey(
            'fk-ticket-assigned_to',
            'ticket',
            'assigned_to',
            'developer',
            'id',
            'SET NULL'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-ticket-assigned_to', 'ticket');
        $this->dropColumn('ticket', 'assigned_to');
    }
}