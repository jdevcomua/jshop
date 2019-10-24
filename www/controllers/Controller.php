<?php

namespace www\controllers;

use common\models\Orders;
use common\models\Seo;
use Yii;
use yii\web\View;

class Controller extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/main';
    private $jsVars;
    public $seo;
    public $breadcrumbs = [];

    const PAGE_SIZE = 12;

    public function beforeAction($action)
    {
        Yii::$app->language = Yii::$app->getRequest()->getQueryParam('language', 'ru');
        $this->seo = Seo::findOne(['url'=>rtrim($this->current_url(),'/')]);
         if(!isset($this->seo)){
            $new_url = str_replace(Yii::$app->params['serverUrl'], '',rtrim($this->current_url(),'/'));
            $new_url = str_replace('/item/', '',$new_url);
            $new_url = str_replace('/category/', '',$new_url);
            $new_url = str_replace( (int)$new_url . '-', '',$new_url);
            $this->seo = Seo::findOne(['new_url'=> $new_url]);
        }

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

    function current_url()
    {
        return Yii::$app->params['serverUrl'] . Yii::$app->request->url;
    }

}