<?php

namespace www\controllers;

use common\models\Orders;
use common\models\Seo;
use Yii;
use yii\web\View;

class Controller extends \yii\web\Controller
{
    private $jsVars;
    public $seo;
    public $breadcrumbs = [];

    const PAGE_SIZE = 12;

    public function beforeAction($action)
    {
        Yii::$app->language = Yii::$app->getRequest()->getQueryParam('language', 'ru');
        $this->seo = Seo::findOne(['url'=>rtrim($this->current_url(),'/')]);
         if(!isset($this->seo)){
            $newUrl = str_replace(Yii::$app->params['serverUrl'], '',rtrim($this->current_url(),'/'));
            $newUrl = str_replace('/item/', '',$newUrl);
            $newUrl = str_replace('/category/', '',$newUrl);
            $newUrl = str_replace( (int)$newUrl . '-', '',$newUrl);
            if ($newUrl){
                $this->seo = Seo::findOne(['new_url'=> $newUrl]);
            }
        }

        if(!isset($this->seo)){
            $this->seo = new Seo();
            $this->seo->title = 'Заказать продукты с бесплатной доставкой на дом или офис в Мариуполе | SDelivery';
            $this->seo->description = 'Бесплатная доставка продуктоы с 10:00 до 20:00 на дом и офис по районам Мариуполя, Левый берег, восточный, посёлок моряков';
            $this->seo->keywords = 'Доставка, Мариуполь, продукты, еда, вода';
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