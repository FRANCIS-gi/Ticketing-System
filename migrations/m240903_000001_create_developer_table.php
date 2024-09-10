<?php
use yii\db\Migration;

class m240903_000001_insert_initial_developers extends Migration
{
    public function safeUp()
    {
        $this->insert('developer', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->batchInsert('developer', ['name', 'email'], [
            ['Jane Smith', 'jane@example.com'],
            ['Bob Johnson', 'bob@example.com'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('developer', ['email' => ['john@example.com', 'jane@example.com', 'bob@example.com']]);
    }
}