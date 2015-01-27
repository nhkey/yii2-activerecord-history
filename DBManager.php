<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh;

use Yii;
use yii\db\Connection;
use yii\di\Instance;


/**
 * Class DBManager
 * @package nhkey\arh
 */
class DBManager
{
    public static $tableName = '{{%modelhistory}}';

    /**
     * @var string
     */
    private static $db = 'db';

    /**
     * @param array $data
     */
    public static function saveField($data)
    {

        self::getDB()->createCommand()
            ->insert(self::$tableName, $data)->execute();
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