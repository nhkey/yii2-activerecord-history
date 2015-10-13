<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh\managers;

use Yii;
use yii\db\Connection;
use yii\di\Instance;


/**
 * Class DBManager for save history in DB
 * @package nhkey\arh
 */
class DBManager extends BaseManager
{
    public static $defaultTableName = '{{%modelhistory}}'; // static default for migration
    public $tableName;

    /**
     * @var string
     */
    public static $db = 'db';

    /**
     * @param array $data
     */
    public function saveField($data)
    {
        $table =  isset($this->tableName) ? $this->tableName : $this::$defaultTableName;
        
        self::getDB()->createCommand()
            ->insert($table, $data)->execute();
    }

    /**
     * @return object Return database connection
     * @throws \yii\base\InvalidConfigException
     */
    private static function getDB()
    {
        return Instance::ensure(self::$db, Connection::className());
    }
}
