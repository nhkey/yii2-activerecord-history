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
class m190625_174005_add_action_column extends Migration
{
    public function up()
    {
        $this->addColumn(DBManager::$defaultTableName, 'action', $this->string());
    }

    public function down()
    {
        $this->dropColumn(DBManager::$defaultTableName, 'action');
    }
}
