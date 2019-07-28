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
        if ($this->db->driverName === 'mysql') {
            $this->alterColumn(DBManager::$defaultTableName, 'user_id', $this->string());
        }else{
            $this->alterColumn(DBManager::$defaultTableName, 'user_id', 'DROP NOT NULL');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if ($this->db->driverName === 'mysql') {
            $this->alterColumn(DBManager::$defaultTableName, 'user_id', $this->string()->notNull());
        }else{
            echo "m190316_221539_drop_not_null_user cannot be reverted.\n";
            return false;
        }
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
