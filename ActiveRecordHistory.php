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
	$provider = ($this->_historyProvider) ? : $provider = 'nhkey\arh\DBManager';
        $type = $insert ? FileManager::AR_INSERT : FileManager::AR_UPDATE;

        if ($this->getOldPrimaryKey() != $this->getPrimaryKey())
            $type = $provider::AR_UPDATE_PK;
        $provider::run($type, $this, $changedAttributes);
        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $provider = ($this->_historyProvider) ? : $provider = 'nhkey\arh\DBManager';

        $provider::run($provider::AR_DELETE, $this);
        return parent::afterDelete();
    }


}
