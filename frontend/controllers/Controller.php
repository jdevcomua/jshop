<?php

namespace frontend\controllers;

use Yii;
use yii\web\View;

class Controller extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/main';
    private $jsVars;

    const PAGE_SIZE = 12;

    public function beforeAction($action)
    {
        Yii::$app->language = Yii::$app->getRequest()->getQueryParam('language', 'ru');
        return parent::beforeAction($action);
    }

    public function render($view, $params = [])
    {
        $inlineScript = "\n";
        $this->addJSVar('isGuest', Yii::$app->user->isGuest);
        foreach($this->jsVars as $name=>$value) {
            switch($value){
                case is_bool($value): $value = $value ? 'true' : 'false'; break;
                case is_numeric($value): $value = (int)$value;break;
                default: $value = "'{$value}'";
            }
            $inlineScript .= "Shop.{$name} = {$value};\n";
        }
        $this->view->registerJs($inlineScript, View::POS_HEAD, 'js-vars');
        return parent::render($view, $params);
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