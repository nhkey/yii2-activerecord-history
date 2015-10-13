#Usage extension as extend the class ActiveRecord

**DEPRECATED, NOT SUPPORTED NOW**
There is old method for use this extension and not supported after version 1.1.0
 

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

[FileManager](https://github.com/nhkey/yii2-activerecord-history/blob/master/docs/en/managers#filemanager):

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

[DBManager](https://github.com/nhkey/yii2-activerecord-history/blob/master/docs/en/managers#dbmanager):

```php
    class MyClass extends \nhkey\arh\ActiveRecordHistory
    {
        ...
    }
```