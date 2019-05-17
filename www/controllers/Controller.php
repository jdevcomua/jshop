<?php

namespace www\controllers;

use Yii;
use yii\web\View;

class Controller extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/main';
    private $jsVars;
    public $breadcrumbs = [];

    const PAGE_SIZE = 12;

    public function beforeAction($action)
    {
        Yii::$app->language = Yii::$app->getRequest()->getQueryParam('language', 'ru');
        return parent::beforeAction($action);
    }

    protected function addJSVar($name, $value)
    {
        $this->jsVars[$name] = $value;
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