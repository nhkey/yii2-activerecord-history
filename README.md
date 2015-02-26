Yii2-ActiveRecord-History Extension for Yii 2
=========================

This extension adds storage history of changes to the AR model


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nhkey/yii2-activerecord-history "*"
```

or add

```json
"nhkey/yii2-activerecord-history": "*"
```

to the require section of your composer.json.

If you are using DBManager as Manager, you need to run

```
php yii migrate --migrationPath=@vendors/nhkey/yii2-activerecord-history/migrations
```

Usage
-----

To use this extension, simply change the parent class from \yii\db\ActiveRecord to \nhkey\arh\ActiveRecordHistory 

For example:

```php
    class MyClass extends ActiveRecord
```

change to

```php
    class MyClass extends ActiveRecordHistory
```

The model will have private property $_historyProvider, which replies with a call for the Manager. If the property is not specified, the default manager is DBManager.
In the extension is two managers: DBManager and FileManager. You can extend the class BaseManager.

Credits
-------

Author: Mikhail Mikhalev

Email: mail@mikhailmikhalev.ru


