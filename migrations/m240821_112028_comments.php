<?php

use yii\db\Migration;

/**
 * Class m240821_112028_comments
 */
class m240821_112028_comments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'comment_id' => $this->primaryKey(),
            'ticket_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'comment_text' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // $this->addForeignKey(
        //     'fk-comments-ticket_id',
        //     'comments',
        //     'ticket_id',
        //     'tickets',
        //     'ticket_id',
        //     'CASCADE',
        //     'CASCADE'
        // );

        // $this->addForeignKey(
        //     'fk-comments-user_id',
        //     'comments',
        //     'user_id',
        //     'users',
        //     'user_id',
        //     'CASCADE',
        //     'CASCADE'
        // );
    }

    public function safeDown()
    {
        // Ensure the foreign keys are dropped before the table is deleted
        // $this->dropForeignKey('fk-comments-ticket_id', 'comments');
        // $this->dropForeignKey('fk-comments-user_id', 'comments');

        // Drop the table
        $this->dropTable('comments');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240821_112028_comments cannot be reverted.\n";

        return false;
    }
    */
}
