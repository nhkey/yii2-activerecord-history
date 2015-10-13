#Managers

##Intro

Managers are saving your ActiveRecord-object's history in some storage. For example, DBManager  

##Default properties

- **saveUserId** - flag for saving userId in history log.


##DBManager
DBManager is manager for saving your ActiveRecord-object's history in database. It's default manager in extension.
 
For use you need run 

```
php yii migrate --migrationPath=@vendor/nhkey/yii2-activerecord-history/migrations
```



##FileManager
FileManager is manager for saving your ActiveRecord-object's history in filesystem.
 
###Properties

- **filePath** - path for saving your files with history log;
- **isGenerateFilename** - flag for autogenerate filename; if value if 'true' then property "filename" is ignore.
- **filename** - filename for file with history log;


[Back To Main page](https://github.com/nhkey/yii2-activerecord-history/blob/master/README.md)