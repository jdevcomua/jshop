<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 10.01.16
 * Time: 18:26
 */

namespace frontend\controllers;

use Yii;

class Controller extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        Yii::$app->language = Yii::$app->getRequest()->getQueryParam('language', 'ru');
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