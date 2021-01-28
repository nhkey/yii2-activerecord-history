<?php

use yii\db\Migration;

use nhkey\arh\managers\DBManager;

/**
 * Class m200825_212611_add_index
 */
class m200825_212611_add_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx-field_id', DBManager::$defaultTableName, 'field_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200825_212611_add_index cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200825_212611_add_index cannot be reverted.\n";

        return false;
    }
    */
}
