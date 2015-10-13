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
     * @var BaseManager This is manager for save history in some storage
     * Default value: DBManager.
     */
    public $manager ='nhkey\arh\managers\DBManager';

    /**
     * @var array This fields don't save in your storage
     */
    public $ignoreFields = [];

    /**
     * @var array options for manager
     */
    public $managerOptions;

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_INSERT => 'saveHistory',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'saveHistory',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'saveHistory',
        ];
    }

    /**
     * @param Event $event
     * @throws \Exception
     */
    public function saveHistory($event)
    {
        $manager = new $this->manager;
        $manager->setOptions($this->managerOptions);

        switch ($event->name){
            case BaseActiveRecord::EVENT_AFTER_INSERT:
                $type = $manager::AR_INSERT;
                $manager->setUpdatedFields($event->changedAttributes);
                break;

            case BaseActiveRecord::EVENT_AFTER_UPDATE:
                $changedAttributes = $event->changedAttributes;
                foreach ($this->ignoreFields as $ignoreField)
                    if (isset($changedAttributes[$ignoreField]))
                        unset($changedAttributes[$ignoreField]);

                $type = $this->owner->getOldPrimaryKey() != $this->owner->getPrimaryKey()
                    ? $manager::AR_UPDATE_PK
                    : $manager::AR_UPDATE;

                $manager->setUpdatedFields($changedAttributes);
                break;

            case BaseActiveRecord::EVENT_AFTER_DELETE:
                $type = $manager::AR_DELETE;
                break;

            default:
                throw new \Exception('Not found event!');
        }
        $manager->run($type, $this->owner);
    }


}
