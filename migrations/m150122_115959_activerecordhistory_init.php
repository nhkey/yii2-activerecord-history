<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

use yii\db\Schema;
use yii\db\Migration;
use nhkey\arh\managers\DBManager;


/**
 * Initializes activerecord history tables.
 *
 */
class m150122_115959_activerecordhistory_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(DBManager::$tableName, [
            'id' => Schema::TYPE_BIGPK,
            'date' => Schema::TYPE_DATETIME . ' NOT NULL',
            'table' => Schema::TYPE_STRING . ' NOT NULL',
            'field_name' => Schema::TYPE_STRING . ' NOT NULL',
            'field_id' => Schema::TYPE_STRING . ' NOT NULL',
            'old_value' => Schema::TYPE_TEXT . ' NULL',
            'new_value' => Schema::TYPE_TEXT . ' NULL',
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('idx-table', DBManager::$tableName, 'table');
        $this->createIndex('idx-field_name', DBManager::$tableName, 'field_name');
        $this->createIndex('idx-type', DBManager::$tableName, 'type');
    }

    public function down()
    {
        $this->dropTable(DBManager::$tableName);
    }
}
