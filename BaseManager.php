<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh;

use Yii;


class BaseManager implements ActiveRecordHistoryInterface
{
    /**
     * @param integer $type
     * @param \yii\db\ActiveRecord $object
     * @param array $updatedFields
     * @return void
     */
    public static function run($type, $object, $updatedFields = [])
    {
        $pk = $object->getPrimaryKey(true);

        $data = [
            'table' => $object->tableName(),
            'field_id' => $object->getPrimaryKey(),
            'type' => $type,
            'date' => date('Y-m-d H:i:s', time()),
        ];

        switch ($type) {
            case self::AR_INSERT:
                $data['field_name'] = array_keys($pk)[0];
                static::saveField($data);
                break;
            case self::AR_UPDATE:
                foreach ($updatedFields as $updatedFieldKey => $updatedFieldValue) {
                    $data['field_name'] = $updatedFieldKey;
                    $data['old_value'] = $updatedFieldValue;
                    $data['new_value'] = $object->$updatedFieldKey;

                    static::saveField($data);
                }
                break;
            case self::AR_DELETE:
                $data['field_name'] = array_keys($pk)[0];
                static::saveField($data);
                break;
            case self::AR_UPDATE_PK:
                $data['field_name'] = array_keys($pk)[0];
                $data['old_value'] = $object->getOldPrimaryKey();
                $data['new_value'] = $object->$pk[0];
                static::saveField($data);
                break;
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public static function saveField($data)
    {
    }

}