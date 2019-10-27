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
class m190619_174005_add_indexes extends Migration
{
    public function up()
    {
        $this->createIndex("idx-field_id-table", DBManager::$defaultTableName, ['field_id', 'table']);
    }

    public function down()
    {
        $this->dropIndex("idx-field_id-table", DBManager::$defaultTableName);
    }
}
