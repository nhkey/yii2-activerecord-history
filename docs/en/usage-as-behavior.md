#Usage extension as behavior

Easy way:
 
```php
    class MyClass extends ActiveRecord {
     public function behaviors(){
            return [
                \nhkey\arh\ActiveRecordHistoryBehavior::className(),
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

If you don't want to save some fields, you can use property ignoreFields (example, field "updated_at" if you use TimestampBehavior, [Issue #1](https://github.com/nhkey/yii2-activerecord-history/issues/1))

```php
    class MyClass extends ActiveRecord {
     public function behaviors(){
            return [
                'history' => [
                    'class' => \nhkey\arh\ActiveRecordHistoryBehavior::className(),
                    'ignoreFields' => ['updated_at', 'some_other_field'],
                ],
                ...
            ];
        }
```

## Properties

- **manager** - set manager for save history in storage.
- **ignoreFields** - set array of fields that do not need to save in history log
- **eventsList** - set array of events that do need to save in history log. 

##Events codes const
- BaseManager::AR_INSERT - Create new ActiveRecord-object 
- BaseManager::AR_UPDATE - Update your ActiveRecord-object 
- BaseManager::AR_DELETE - Remove your ActiveRecord-object 
- BaseManager::AR_UPDATE_PK - Update primary key for your ActiveRecord-object 

## Examples

### Example 1

[FileManager](https://github.com/nhkey/yii2-activerecord-history/blob/master/docs/en/managers.md#filemanager): 

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

[DBManager](https://github.com/nhkey/yii2-activerecord-history/blob/master/docs/en/managers.md#dbmanager): 

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


[Back To Main page](https://github.com/nhkey/yii2-activerecord-history/blob/master/README.md)
