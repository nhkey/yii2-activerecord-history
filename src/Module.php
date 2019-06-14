<?php
/**
 * Created by PhpStorm.
 * User: liviucalin
 * Date: 2019-06-13
 * Time: 12:59
 */

namespace nhkey\arh;

use yii\base\Module AS BaseModule;


class Module extends BaseModule
{
    public $controllerNamespace = 'nhkey\arh\controllers';

    public $allowedPermissions = [];
}