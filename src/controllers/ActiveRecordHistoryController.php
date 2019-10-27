<?php

namespace nhkey\arh\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ActiveRecordHistoryController extends Controller
{
    public $module;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'roles' => $this->module->allowedPermissions,
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        $this->module = Yii::$app->getModule("arh");
        parent::init();
    }

    public function actionModelChanges($class, $field_id)
    {
        $model = $this->findModel($class, $field_id);
        $dataProvider = new ArrayDataProvider([
            'models' => $model->changes(),
        ]);
        return $this->renderAjax('model-changes', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $class
     * @param $field_id
     * @return ActiveRecord
     * @throws NotFoundHttpException
     */
    private function findModel($class, $field_id)
    {
        $model = $class::findOne($field_id);
        if (empty($model)) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

}