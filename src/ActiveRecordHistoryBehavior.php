<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh;

use nhkey\arh\managers\BaseManager;
use yii\db\BaseActiveRecord;
use \yii\base\Behavior;


class ActiveRecordHistoryBehavior extends Behavior
{

    /**
     * @var BaseManager
     */
    public $manager ='nhkey\arh\managers\DBManager';

    /**
     * @var array
     */
    protected $managerOptions;

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_INSERT => 'saveHistory',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'saveHistory',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'saveHistory',
        ];
    }

    public function saveHistory($event){
        $manager = new $this->manager;

        switch ($event->name){
            case BaseActiveRecord::EVENT_AFTER_INSERT:
                $type = $manager::AR_INSERT;
                break;
            case BaseActiveRecord::EVENT_AFTER_UPDATE:
                $type =  $this->owner->getOldPrimaryKey() != $this->owner->getPrimaryKey()
                    ? $manager::AR_UPDATE_PK
                    : $manager::AR_UPDATE;
                break;
            case BaseActiveRecord::EVENT_AFTER_DELETE:
                $type = $manager::AR_DELETE;
                break;
            default:
                throw new \Exception('Not found event!');
        }
        $manager->setOptions($this->managerOptions)
                 ->setChangedAttributes($event->changedAttributes)
                 ->run($type, $this->owner);
    }


}
