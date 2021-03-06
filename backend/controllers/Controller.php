<?php
/**
 * Created by PhpStorm.
 * User: umo4ka
 * Date: 12.12.15
 * Time: 14:23
 */

namespace backend\controllers;

use common\models\Orders;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;


class Controller extends \yii\web\Controller
{

    //public $layout = 'main3';
    public $countNewOrder;

    public function beforeAction($action)
    {
        Yii::$app->language = Yii::$app->getRequest()->getQueryParam('language', 'ru');
        $action->controller->countNewOrder = Orders::find()->where(['order_status' => Orders::STATUS_NEW])->count();
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'logout'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

}
