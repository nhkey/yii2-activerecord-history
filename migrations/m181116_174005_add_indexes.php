<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

use yii\db\Migration;
use nhkey\arh\managers\DBManager;


/**
 * Add indexes for performance
 *
 */
class m181116_174005_add_indexes extends Migration
{
    public function up()
    {
        $this->createIndex("idx-field_id", DBManager::$defaultTableName, 'field_id');
        $this->createIndex("idx-field_id-table-field_name", DBManager::$defaultTableName, ['field_id', 'table', 'field_name']);
    }

    public function down()
    {
        $this->dropIndex("idx-field_id", DBManager::$defaultTableName);
        $this->dropIndex("idx-field_id-table-field_name", DBManager::$defaultTableName);
    }
}
