<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m240905_081649_add_is_admin_column_to_user_table extends Migration
{

   
 public function up()
{
    $this->addColumn('{{%user}}', 'is_admin', $this->boolean()->defaultValue(0));
}

public function down()
{
    $this->dropColumn('{{%user}}', 'is_admin');
}

}
