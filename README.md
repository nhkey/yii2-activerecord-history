Yii2 ActiveRecord History Extension for Yii 2
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
In the extension is two managers: [DBManager](https://github.com/nhkey/yii2-activerecord-history/blob/master/docs/en/managers.md#dbmanager) and [FileManager](https://github.com/nhkey/yii2-activerecord-history/blob/master/docs/en/managers.md#filemanager). You can extend the class BaseManager. 

There are two way how usage this extension:
 - [As behavior](https://github.com/nhkey/yii2-activerecord-history/blob/master/docs/en/usage-as-behavior.md)
 - [As extend the class ActiveRecord](https://github.com/nhkey/yii2-activerecord-history/blob/master/docs/en/usage-as-extend.md) **DEPRECATED**

Update to 1.1.2
-------
For update you need to run: 

```
php yii migrate --migrationPath=@vendor/nhkey/yii2-activerecord-history/migrations
```

Credits
-------

Author: Mikhail Mikhalev

Email: mail@mikhailmikhalev.ru


