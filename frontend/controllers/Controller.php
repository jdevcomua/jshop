<?php

namespace frontend\controllers;

use Yii;
use yii\web\View;

class Controller extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/main';

    public function beforeAction($action)
    {
        Yii::$app->language = Yii::$app->getRequest()->getQueryParam('language', 'ru');
        $inlineScript = 'var countItems = ' . Yii::$app->cart->getCount() . ';';
        $this->view->registerJs($inlineScript, View::POS_HEAD, 'count-items');
        return parent::beforeAction($action);
    }

    /**
     * Changing the language
     * @param $lang string
     * @return \yii\web\Response
     */
    public function actionLanguage($lang)
    {
        Yii::$app->language = $lang;
        return $this->redirect(Yii::$app->urlHelper->to(['/']));
    }

}