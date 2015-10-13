<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh;

use nhkey\arh\managers\BaseManager;
use Yii;

/**
 * Class ActiveRecordHistory
 * @package nhkey\arh
 * @deprecated
 */
class ActiveRecordHistory extends \yii\db\ActiveRecord
{

    /**
     * @var BaseManager
     */
    protected $_historyManager = 'nhkey\arh\managers\DBManager';

    /**
     * @var array
     */
    protected $_optionsHistoryManager;


    public function afterSave($insert, $changedAttributes)
    {
        $manager = new $this->_historyManager;

        $type = $insert ? $manager::AR_INSERT : $manager::AR_UPDATE;

        if ($this->getOldPrimaryKey() != $this->getPrimaryKey())
            $type = $manager::AR_UPDATE_PK;

        $manager->setOptions($this->_optionsHistoryManager)
                 ->setUpdatedFields($changedAttributes)
                 ->run($type, $this);
        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $manager = new $this->_historyManager;

        $manager->setOptions($this->_optionsHistoryManager)
            ->run($manager::AR_DELETE, $this);
        return parent::afterDelete();
    }


}
