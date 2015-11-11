<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

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

        $this->createTable(DBManager::$defaultTableName, [
            'id' => $this->bigPrimaryKey(),
            'date' => $this->datetime()->notNull(),
            'table' => $this->string()->notNull(),
            'field_name' => $this->string()->notNull(),
            'field_id' => $this->string()->notNull(),
            'old_value' => $this->text(),
            'new_value' => $this->text(),
            'type' => $this->smallInteger()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-table', DBManager::$defaultTableName, 'table');
        $this->createIndex('idx-field_name', DBManager::$defaultTableName, 'field_name');
        $this->createIndex('idx-type', DBManager::$defaultTableName, 'type');
    }

    public function down()
    {
        $this->dropTable(DBManager::$defaultTableName);
    }
}
