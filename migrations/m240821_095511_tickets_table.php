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
