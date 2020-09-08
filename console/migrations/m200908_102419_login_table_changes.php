<?php

use yii\db\Migration;

/**
 * Class m200908_102419_login_table_changes
 */
class m200908_102419_login_table_changes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `login` ADD `password_reset_token` VARCHAR(250) NULL DEFAULT NULL AFTER `password`, ADD `auth_key` VARCHAR(250) NOT NULL AFTER `password_reset_token`;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `login`  DROP `password_reset_token`,  DROP `auth_key`;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200908_102419_login_table_changes cannot be reverted.\n";

        return false;
    }
    */
}
