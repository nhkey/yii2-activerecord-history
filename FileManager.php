<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh;

use Yii;
use yii\helpers\FileHelper;


/**
 * Class DBManager
 * @package nhkey\arh
 */
class FileManager extends BaseManager
{

    /**
     * @var string filePath
     */
    public static $filePath = './history/';

    /**
     * @param array $data
     * @param array $options
     */
    public static function saveField($data, $options = [])
    {
        $typeName = self::getTypeName($data['type']);
        $inFile = "{$data['date']} {$typeName}: {$data['field_name']}({$data['field_id']})\r\n";
        if ($data['type'] == self::AR_UPDATE || $data['type'] == self::AR_UPDATE_PK) {
            $inFile .= "Old Value: {$data['old_value']}\r\n";
            $inFile .= "New Value: {$data['new_value']}\r\n";
        }
        $inFile .= "------\r\n";
        (new FileHelper())->createDirectory($options['filename'] ?: self::$filePath);
        file_put_contents(self::$filePath . self::getFileName($data), $inFile, FILE_APPEND | LOCK_EX);
    }

    /**
     * @param $data
     * @return string
     */
    protected static function getFileName($data)
    {
        return $data['table'] . '.history';
    }

    /**
     * @param $type
     * @return string
     */
    protected static function getTypeName($type)
    {
        switch ($type) {
            case self::AR_INSERT:
                $result = 'INSERT';
                break;
            case self::AR_UPDATE:
                $result = 'UPDATE';
                break;
            case self::AR_DELETE:
                $result = 'DELETE';
                break;
            case self::AR_UPDATE_PK:
                $result = 'UPDATE PK';
                break;
            default:
                $result = 'UNKNOWN';
        }
        return $result;
    }

}