<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m240821_095133_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('projects', [
            'project_id' => $this->primaryKey(),
            'project_name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date(),
            'status' => $this->string(50)->notNull(),
            'created_by' => $this->integer()->notNull(),
        ]);
    
        // Add foreign key for created_by
        // $this->addForeignKey(
        //     'fk-projects-created_by',
        //     'projects',
        //     'created_by',
        //     'users',
        //     'user_id',
        //     'CASCADE'
        // );
    }
    
    public function safeDown()
    {
        // $this->dropForeignKey('fk-projects-created_by', 'projects');
        $this->dropTable('projects');
    }
    
}
