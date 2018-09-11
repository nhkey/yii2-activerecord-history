<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh\managers;

use const SORT_DESC;
use Yii;
use yii\db\Connection;
use yii\db\Query;
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

    public function __construct()
    {
        $this->tableName = isset($this->tableName) ? $this->tableName : $this::$defaultTableName;
    }

    /**
     * @inheritdoc
     */
    public function saveField($data)
    {
        self::getDB()->createCommand()
            ->insert($this->tableName, $data)->execute();
    }

    /**
     * Query for data record according to parameters
     * @param array $filter
     * @param array $order
     * @return array|false
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function getField(array $filter, array $order)
    {
        $query = new Query();
        $query->select('*')->from($this->tableName)->andWhere($filter)->orderBy($order);
        $res = $query->createCommand(self::getDB())->queryOne();
        return $res;
    }

    /**
     * @return Connection Return database connection
     * @throws \yii\base\InvalidConfigException
     */
    private static function getDB()
    {
        return Instance::ensure(self::$db, Connection::className());
    }
}
