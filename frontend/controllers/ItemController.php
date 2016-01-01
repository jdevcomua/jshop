<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Item;
use common\models\ItemCat;

class ItemController extends Controller
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

    /**
     * Viwe page of item
     * @param $id  - id of item
     * @return string
     */
    public function actionItem($id)
    {
        $allCategories = ItemCat::find()->all();
        $item = Item::findOne(Yii::$app->request->get('id'));
        return $this->render('item', ['allCategories'=>$allCategories, 'item'=>$item]);
    }

}