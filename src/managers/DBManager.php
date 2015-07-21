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
 * Class DBManager
 * @package nhkey\arh
 */
class DBManager extends BaseManager
{
    public static $tableName = '{{%modelhistory}}';

    /**
     * @var string
     */
    public static $db = 'db';

    /**
     * @param array $data
     * @param array $options
     */
    public function saveField($data)
    {

        self::getDB()->createCommand()
            ->insert($this::$tableName, $data)->execute();
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
