<?php

use yii\db\Migration;

/**
 * Class m240821_093228_sla
 */
class m240821_093228_sla extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sla', [
            'sla_id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'matrix_id' => $this->integer()->notNull(),
            'is_renewed' => $this->boolean()->notNull(),
            'expiration_date' => $this->date()->notNull(),
            'last_notification_date' => $this->date(),
            'next_notification_date' => $this->date()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    
        // Add foreign key for client_id
        $this->addForeignKey(
            'fk-sla-client_id',
            'sla',
            'client_id',
            'clients',
            'client_id',
            'CASCADE'
        );
    
        // Add foreign key for matrix_id
        $this->addForeignKey(
            'fk-sla-matrix_id',
            'sla',
            'matrix_id',
            'sla_matrix',
            'matrix_id',
            'CASCADE'
        );
    }
    
    public function safeDown()
    {
        $this->dropForeignKey('fk-sla-client_id', 'sla');
        $this->dropForeignKey('fk-sla-matrix_id', 'sla');
        $this->dropTable('sla');
    }
    

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240821_093228_sla cannot be reverted.\n";

        return false;
    }
    */
}
