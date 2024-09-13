
<?php
use yii\db\Migration;

class m230101_000002_add_user_id_to_ticket_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%ticket}}', 'user_id', $this->integer()->notNull());
        
        // Optionally, create a foreign key constraint
        $this->addForeignKey(
            'fk-ticket-user_id',
            '{{%ticket}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-ticket-user_id', '{{%ticket}}');
        $this->dropColumn('{{%ticket}}', 'user_id');
    }
}
