Yii2-ActiveRecord-History Extension for Yii 2
=========================

This extension adds storage history of changes to the AR model


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require nhkey/yii2-activerecord-history "*"
```

or add

```json
"nhkey/yii2-activerecord-history": "*"
```

to the require section of your composer.json.

If you are using DBManager as Manager, you need to run

```
php yii migrate --migrationPath=@vendor/nhkey/yii2-activerecord-history/migrations
```

Usage
-----

If the property is not specified, the default manager is DBManager.
In the extension is two managers: DBManager and FileManager. You can extend the class BaseManager.

### 1) As extend the class ActiveRecord
To use this extension, simply change the parent class from \yii\db\ActiveRecord to \nhkey\arh\ActiveRecordHistory 

For example:

```php
    class MyClass extends ActiveRecord
```

change to

```php
    class MyClass extends ActiveRecordHistory
```

The model will have private property $_historyManager, which replies with a call for the Manager.

#### Example 1

FileManager:

```php
    class MyClass extends \nhkey\arh\ActiveRecordHistory
    {
        $_historyManager = '\nhkey\arh\managers\FileManager'
        $_optionsHistoryManager = [
            'filename' => '/home/user/MyClass.log',
            ];
        ...
    }
```

#### Example 2

DBManager:

```php
    class MyClass extends \nhkey\arh\ActiveRecordHistory
    {
        ...
    }
```


### 2) As behavior

Easy way:
 
```php
    class MyClass extends ActiveRecord {
     public function behaviors(){
            return [
                'history' => [
                    'class' => \nhkey\arh\ActiveRecordHistoryBehavior::className(),
                ],
                ...
            ];
        }
```

If you want use not default manager or set options for manager, you may use this construction: 

```php
    class MyClass extends ActiveRecord {
     public function behaviors(){
            return [
                'history' => [
                    'class' => \nhkey\arh\ActiveRecordHistoryBehavior::className(),
                    'manager' => 'ManagerName',
                    'managerOptions' => [
                        ...
                    ],
                ],
                ...
            ];
        }
```

#### Example 1

FileManager: 

```php
    class MyClass extends ActiveRecord {
     public function behaviors(){
            return [
                'history' => [
                    'class' => \nhkey\arh\ActiveRecordHistoryBehavior::className(),
                    'manager' => '\nhkey\arh\managers\FileManager',
                    'managerOptions' => [
                        'filePath' => '/home/logs/',
                        'isGenerateFilename' => true
                    ],
                ],
                ...
            ];
        }
```
or

```php
    class MyClass extends ActiveRecord {
     public function behaviors(){
            return [
                'history' => [
                    'class' => \nhkey\arh\ActiveRecordHistoryBehavior::className(),
                    'manager' => '\nhkey\arh\managers\FileManager',
                    'managerOptions' => [
                        'filename' => '/home/user/logs_app/MyClass.log',
                    ],
                ],
                ...
            ];
        }
```



#### Example 2

DBManager: 

```php
    class MyClass extends ActiveRecord {
     public function behaviors(){
            return [
                'history' => [
                    'class' => \nhkey\arh\ActiveRecordHistoryBehavior::className(),
                    'manager' => '\nhkey\arh\managers\DBManager',
                    'managerOptions' => [
                        'tableName' => 'MyLogTable',
                    ],
                ],
                ...
            ];
        }
```


Credits
-------

Author: Mikhail Mikhalev

Email: mail@mikhailmikhalev.ru


