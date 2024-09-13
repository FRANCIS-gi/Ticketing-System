<?php

use yii\db\Migration;

class m240902_000001_add_is_admin_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'is_admin', $this->boolean()->defaultValue(false)->after('status'));
    }

    public function down()
    {
        $this->dropColumn('user', 'is_admin');
    }
}