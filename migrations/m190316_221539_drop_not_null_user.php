<?php

use yii\db\Migration;

use nhkey\arh\managers\DBManager;


/**
 * Class m190316_221539_drop_not_null_user
 */
class m190316_221539_drop_not_null_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(DBManager::$defaultTableName, 'user_id', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(DBManager::$defaultTableName, 'user_id', $this->string()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190316_221539_drop_not_null_user cannot be reverted.\n";

        return false;
    }
    */
}
