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
    /**
     * @var string static default for migration
     */
    public static $defaultTableName = '{{%modelhistory}}';

    /**
     * @var string tableName
     */
    public $tableName;

    /**
     * @var string DB
     */
    public static $db = 'db';

    /**
     * @inheritdoc
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
