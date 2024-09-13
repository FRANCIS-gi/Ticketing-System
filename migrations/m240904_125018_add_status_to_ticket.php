<?php

use yii\db\Migration;

/**
 * Class mXXXXXX_XXXXXX_add_status_to_ticket
 */
class mXXXXXX_XXXXXX_add_status_to_ticket extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ticket}}', 'status', $this->string()->defaultValue('assign'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ticket}}', 'status');
    }
}
