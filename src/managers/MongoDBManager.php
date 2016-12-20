<?php

namespace nhkey\arh\managers;

use Yii;
use yii\mongodb\Connection;
use yii\di\Instance;

/**
 * Class MongoDBManager for save history in DB
 * @package nhkey\arh
 */
class MongoDBManager extends DBManager
{
    /**
     * @inheritdoc
     */
    public static $defaultTableName = 'modelhistory';

    /**
     * @inheritdoc
     */
    public static $db = 'mongodb';

    /**
     * @inheritdoc
     */
    public function saveField($data)
    {
        $table =  isset($this->tableName) ? $this->tableName : $this::$defaultTableName;

        $result = self::getDB()->createCommand()->insert($table, $data);
    }

    /**
     * @inheritdoc
     */
    private static function getDB()
    {
        return Instance::ensure(static::$db, Connection::className());
    }
}
