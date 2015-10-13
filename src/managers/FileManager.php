<?php
/**
 * @link http://mikhailmikhalev.ru
 * @author Mikhail Mikhalev
 */

namespace nhkey\arh\managers;

use yii\helpers\FileHelper;


/**
 * Class FileManager for save history in filesystem
 * @package nhkey\arh
 */
class FileManager extends BaseManager
{

    public $filePath = './history/';
    public $filename = 'filename';
    public $isGenerateFilename = true;


    /**
     * @inheritdoc
     */
    public function saveField($data)
    {
        $typeName = self::getTypeName($data['type']);
        if (!isset($data['user_id']))
            $data['user_id'] = '';
        $content = "{$data['date']} {$typeName} {$data['user_id']}: {$data['field_name']}({$data['field_id']})" . PHP_EOL;

        if ($data['type'] == self::AR_UPDATE || $data['type'] == self::AR_UPDATE_PK) {
            $content .= "Old Value: {$data['old_value']}" . PHP_EOL;
            $content .= "New Value: {$data['new_value']}" . PHP_EOL;
        }

        $content .= "------" . PHP_EOL;
        if (!$this->isGenerateFilename) {
            (new FileHelper())->createDirectory($this->filePath);
            $filename = $this->filename;
        }
        else
            $filename = $this->getFileName($data);
        file_put_contents($this->filePath . $filename, $content, FILE_APPEND | LOCK_EX);
    }

    /**
     * @param $data
     * @return string
     */
    protected function getFileName($data)
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