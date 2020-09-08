<?php

use yii\db\Migration;

/**
 * Class m200908_112003_investigations_table_changes
 */
class m200908_112003_investigations_table_changes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `investigations` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `investigations` CHANGE `id` `id` INT(11) NOT NULL;");
        $this->execute("ALTER TABLE `investigations` DROP PRIMARY KEY;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200908_112003_investigations_table_changes cannot be reverted.\n";

        return false;
    }
    */
}
