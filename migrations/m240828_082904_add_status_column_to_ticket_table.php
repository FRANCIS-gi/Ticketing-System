<?php

   use yii\db\Migration;

   /**
    * Class m230829_123456_add_status_column_to_ticket_table
    */
   class m230829_123456_add_status_column_to_ticket_table extends Migration
   {
       /**
        * {@inheritdoc}
        */
       public function safeUp()
       {
           $this->addColumn('ticket', 'status', $this->string()->defaultValue('pending')->after('email'));
       }

       /**
        * {@inheritdoc}
        */
       public function safeDown()
       {
           $this->dropColumn('ticket', 'status');
       }
   }