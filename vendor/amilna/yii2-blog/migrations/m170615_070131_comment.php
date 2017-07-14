<?php

use yii\db\Migration;
use yii\db\Schema;

class m170615_070131_comment extends Migration
{
    public function up()
    {
        $this->createTable($this->db->tablePrefix.'blog_comment', [
            'id' => 'pk',
            'comment' => Schema::TYPE_STRING . '(255) NOT NULL',
            'post_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'author_id' => Schema::TYPE_INTEGER,
            'parent_id' => Schema::TYPE_INTEGER,
            'time' => Schema::TYPE_TIMESTAMP. ' NOT NULL DEFAULT NOW()',
        ]);
        $this->addForeignKey( $this->db->tablePrefix.'blog_comment_parent_id', $this->db->tablePrefix.'blog_comment', 'parent_id', $this->db->tablePrefix.'blog_comment', 'id', 'SET NULL', null );
        $this->addForeignKey( $this->db->tablePrefix.'blog_comment_author_id', $this->db->tablePrefix.'blog_comment', 'author_id', $this->db->tablePrefix.'user', 'id', 'CASCADE', null );
        $this->addForeignKey( $this->db->tablePrefix.'blog_comment_post_id', $this->db->tablePrefix.'blog_comment', 'post_id', $this->db->tablePrefix.'blog_post', 'id', 'CASCADE', null );
    }

    public function down()
    {
        echo "m170615_070131_comment cannot be reverted.\n";

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
