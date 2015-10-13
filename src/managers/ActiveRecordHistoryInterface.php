<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh\managers;

interface ActiveRecordHistoryInterface
{

    /**
     * Event types of history to the AR object (insert, update, delete or update primary key)
     */
    const AR_INSERT = 0;
    const AR_UPDATE = 1;
    const AR_DELETE = 2;
    const AR_UPDATE_PK = 3;

    /**
     * Main method for save history.
     * @param integer $type Type of save (insert, update, delete or update primary key)
     * @param \yii\db\ActiveRecord $object
     */
    public function run($type, $object);

    /**
     * Method for save one changes of the AR model
     * @param array $data
     */
    public function saveField($data);

    /**
     * Set options for manager
     * @param array $options
     * @return $this
     */
    public function setOptions($options);

    /**
     * Set $this->updatedFields
     * @param array $attributes
     * @return $this
     */
    public function setUpdatedFields($attributes);


}