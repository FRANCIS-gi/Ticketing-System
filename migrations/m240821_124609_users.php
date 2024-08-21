<?php

use yii\db\Migration;

/**
 * Class m240821_124609_users
 */
class m240821_124609_users extends Migration
{
    /**
     * {@inheritdoc}
     */


    public function safeUp()
    {
        $this->createTable('users', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'email' => $this->string(255)->notNull()->unique(),
            'password_hash' => $this->string(255)->notNull(),
            'role_id' => $this->integer()->notNull(),
            'profile_picture' => $this->string(255),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            // 'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Add foreign key for role_id
        // $this->addForeignKey(
        //     'fk-users-role_id',
        //     'users',
        //     'role_id',
        //     'roles',
        //     'role_id',
        //     'CASCADE'
        // );
    }

    public function safeDown()
    {
        // $this->dropForeignKey('fk-users-role_id', 'users');
        $this->dropTable('users');
    }
}

/*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
    echo "m240821_083537_users cannot be reverted.\n";

    return false;
}
*/


/*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
    echo "m240821_124609_users cannot be reverted.\n";

    return false;
}
*/

