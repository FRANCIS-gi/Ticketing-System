<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticketing}}`.
 */
class m230828_122229_create_ticketing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ticketing', [
            'id' => $this->primaryKey(),
            'staff_no' => $this->string(20)->notNull()->unique(),
            'full_name' => $this->string(100),
            'national_id' => $this->string(20),
            'email' => $this->string(100),
            'company_email' => $this->string(100),
            'password_hash' => $this->string(),
            'password_expires_at' => $this->dateTime(),
            'verification_token' => $this->string(),
            'auth_key' => $this->string(32),
            'flag' => $this->tinyInteger()->defaultValue(1)->comment('1:Active, 2:Deactivated, 3:Flagged'),
            'verified' => $this->tinyInteger()->defaultValue(1)->comment('1:Not-verified, 2:Verified'),
            'status' => $this->string(30)->defaultValue('Active')->comment('Active,Inactive,Terminated,OnLeave,New'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ticketing');
    }
}
