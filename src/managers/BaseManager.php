<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh\managers;

use Yii;


abstract class BaseManager implements ActiveRecordHistoryInterface
{

    public $updatedFields;

    public function setOptions($options){
        if (is_array($options)) {
            foreach ($options as $optionKey => $optionValue){
                if (property_exists(static::class, $this->{$optionKey}))
                    $this->{$optionKey} = $optionValue;
            }
        }
        return $this;
    }

    public function setUpdatedFields($attributes){
        $this->updatedFields = $attributes;
        return $this;
    }

    /**
     * @param integer $type
     * @param \yii\db\ActiveRecord $object
     * @param array $updatedFields
     * @param array $options
     */
    public function run($type, $object)
    {

        $pk = $object->primaryKey();
        $pk = $pk[0];

        $data = [
            'table' => $object->tableName(),
            'field_id' => $object->getPrimaryKey(),
            'type' => $type,
            'date' => date('Y-m-d H:i:s', time()),
        ];

        switch ($type) {
            case self::AR_INSERT:
                $data['field_name'] = $pk;
                $this->saveField($data);
                break;
            case self::AR_UPDATE:
                foreach ($this->updatedFields as $updatedFieldKey => $updatedFieldValue) {
                    $data['field_name'] = $updatedFieldKey;
                    $data['old_value'] = $updatedFieldValue;
                    $data['new_value'] = $object->$updatedFieldKey;

                    $this->saveField($data);
                }
                break;
            case self::AR_DELETE:
                $data['field_name'] = $pk;
                $this->saveField($data);
                break;
            case self::AR_UPDATE_PK:
                $data['field_name'] = $pk;
                $data['old_value'] = $object->getOldPrimaryKey();
                $data['new_value'] = $object->{$pk};
                $this->saveField($data);
                break;
        }
    }

}