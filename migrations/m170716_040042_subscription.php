<?php

use yii\db\Migration;
use yii\db\Schema;

class m170716_040042_subscription extends Migration
{
    public function up()
    {
        $this->createTable($this->db->tablePrefix.'subscription', [
            'id' => 'pk',
            'email' => Schema::TYPE_STRING . '(255) NOT NULL',
            'user_id' => Schema::TYPE_INTEGER,
            'time' => Schema::TYPE_TIMESTAMP. ' NOT NULL DEFAULT NOW()',
        ]);
        $this->addForeignKey( $this->db->tablePrefix.'subscription_user_id', $this->db->tablePrefix.'subscription', 'user_id', $this->db->tablePrefix.'user', 'id', 'CASCADE', null );

    }

    public function down()
    {
        echo "m170716_040042_subscription cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
