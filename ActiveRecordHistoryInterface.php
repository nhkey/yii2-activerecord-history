<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh;

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
     * @return void
     */
    public static function run($type, $object, $updatedFields = []);

    /**
     * @param array $data
     * @return void
     */
    public static function saveField($data);


}