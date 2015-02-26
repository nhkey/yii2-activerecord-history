<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh;

use Yii;


class ActiveRecordHistory extends \yii\db\ActiveRecord
{

    /**
     * @var BaseManager
     */
    protected $_historyProvider;


    public function afterSave($insert, $changedAttributes)
    {
        $this->_historyProvider = $this->_historyProvider;


	$provider = ($this->_historyProvider) ? : $provider = 'DBManager';
        $type = $insert ? FileManager::AR_INSERT : FileManager::AR_UPDATE;

        if ($this->getOldPrimaryKey() != $this->getPrimaryKey())
            $type = $provider::AR_UPDATE_PK;
        $provider::run($type, $this, $changedAttributes);
        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->_historyProvider = $this->_historyProvider;
        $provider = ($this->_historyProvider) ? : $provider = 'DBManager';

        $provider::run($provider::AR_DELETE, $this);
        return parent::afterDelete();
    }


}
