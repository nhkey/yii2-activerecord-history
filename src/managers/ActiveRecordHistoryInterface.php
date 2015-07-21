<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh\managers;

interface ActiveRecordHistoryInterface
{

    const AR_INSERT = 0;
    const AR_UPDATE = 1;
    const AR_DELETE = 2;
    const AR_UPDATE_PK = 3;

    /**
     * @param integer $type
     * @param \yii\db\ActiveRecord $object
     * @param array $updatedFields
     * @param array $options
     */
    public function run($type, $object);

    /**
     * @param array $data
     * @param array $options
     */
    public function saveField($data);

    public function setOptions($options);
    public function setUpdatedFields($attributes);


}