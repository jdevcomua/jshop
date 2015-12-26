<?php

namespace frontend\controllers;

use common\models\CharacteristicItem;
use common\models\Item;
use common\models\ItemCat;
use frontend\models\UrlHelper;
use yii\base\Model;
use common\models\LoginForm;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionLanguage($lang)
    {
        Yii::$app->language = $lang;
        return $this->redirect(UrlHelper::to(['/']));
    }

    function actionIndex()
    {
        Yii::$app->language = Yii::$app->getRequest()->getQueryParam('language', 'ru');
        $allCategories = ItemCat::find()->all();
        if (!empty(Yii::$app->request->get('id'))) {
            $item = Item::findOne(Yii::$app->request->get('id'));
            return $this->render('Item', ['allCategories'=>$allCategories, 'item'=>$item]);
        }
        if (!empty(Yii::$app->request->get('category'))) {
            $id = Yii::$app->request->get('category');
        } else {
            $id = 0;
        }
        $selected = [];
        if (!empty(Yii::$app->request->post('CharacteristicItem'))) {
            $items = $this->search();
            $selected = Yii::$app->request->post('CharacteristicItem');
        } else {
            $items = Item::find();
        }
        if ($id == '0') {
            $categoryTitle = 'all';
        } elseif (is_int(+$id)) {
            /**@var ItemCat $category*/
            $category = ItemCat::findOne($id);
            $categoryTitle = $category->title;
            $items->andFilterWhere(['category_id' => $id]);
        }
        if (!empty(Yii::$app->request->get('search'))) {
            $items->andFilterWhere(['like', 'title', Yii::$app->request->get('search')]);
        }
        if (!empty(Yii::$app->request->get('sort'))) {
            if (Yii::$app->request->get('sort') == 'asc') {
                $items->orderBy('cost asc');
            } elseif (Yii::$app->request->get('sort') == 'desc') {
                $items->orderBy('cost desc');
            }
        }
        $items = $items->all();
        $characteristics = null;
        if($id != '0'){
            $characteristics = ItemCat::findOne($id)->characteristics;
        }
        return $this->render('index', ['allCategories'=>$allCategories, 'items'=>$items, 'category_id'=>$id, 'selected' => $selected, 'categoryTitle'=>$categoryTitle, 'count'=>count($items), 'chars' => $characteristics]);
    }

    public function actionAjax()
    {
        Yii::$app->cart->addItem(Yii::$app->request->get('item_id'), Yii::$app->request->get('count'));
    }

    public function search()
    {
        $query = Item::find();
        $char_ids = [];
        foreach (Yii::$app->request->post('CharacteristicItem') as $items) {
            if (isset($items['value'])) {
                $query1 = CharacteristicItem::find()->select('item_id');
                $query1->andFilterWhere(['characteristic_id' => $items['characteristic_id']]);
                $query1->andFilterWhere(['like', 'value', $items['value']]);
                $item_ids = [];
                foreach ($query1->asArray()->all() as $item) {
                    $item_ids[] = $item['item_id'];
                }
                if (in_array($items['characteristic_id'], $char_ids)) {
                    $query->orFilterWhere(['in', 'id', $item_ids]);
                } else {
                    $char_ids[] = $items['characteristic_id'];
                    $query->andFilterWhere(['in', 'id', $item_ids]);
                }
            }

        }
        return $query;
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'main3';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(UrlHelper::to(['/']));
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}