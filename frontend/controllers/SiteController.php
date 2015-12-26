<?php

namespace frontend\controllers;

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
        if (isset($_GET['id'])) {
            $item = Item::findOne($_GET['id']);
            return $this->render('Item', ['allCategories'=>$allCategories, 'item'=>$item]);
        }
        if (isset($_GET['category'])) {
            $id = $_GET['category'];
        } else {
            $id = 0;
        }
        $items = Item::find();
        if ($id == '0') {
            $categoryTitle = 'all';
        } elseif (is_int(+$id)) {
            /**@var ItemCat $category*/
            $category = ItemCat::findOne($id);
            $categoryTitle = $category->title;
            $items->where('category_id=:category_id',[':category_id' => $id]);
        }
        if (isset($_GET['search'])) {
            $items->where('title like :title', [':title' => '%' . $_GET['search'] . '%']);
        }
        if (isset($_GET['sort'])) {
            if ($_GET['sort'] == 'asc') {
                $items->orderBy('cost asc');
            } elseif ($_GET['sort'] == 'desc') {
                $items->orderBy('cost desc');
            }
        }
        $items = $items->all();
        $characteristics = null;
        if($id != '0'){
            $characteristics = ItemCat::findOne($id)->characteristics;
        }
        return $this->render('index', ['allCategories'=>$allCategories, 'items'=>$items, 'category_id'=>$id, 'categoryTitle'=>$categoryTitle, 'count'=>count($items), 'chars' => $characteristics]);
    }

    public function actionAjax()
    {
        Yii::$app->cart->addItem(Yii::$app->request->get('item_id'), Yii::$app->request->get('count'));
    }

    public function actionSrch()
    {
        foreach (Yii::$app->request->post('CharacteristicItem') as $items) {
            var_dump($items['characteristic_id']);
        }
    }

    public function search($params)
    {
        $query = Item::find();

        $characteristics = ItemCat::findOne(8)->getCharacteristics()->innerJoin('characteristic_item')->groupBy('value')->all();

        if (Model::loadMultiple($characteristics, Yii::$app->request->post()) && Model::validateMultiple($characteristics)) {
            foreach ($characteristics as $characteristic) {
                $characteristic->save(false);
            }
        }

        /*
                $query->andFilterWhere([
                    'id' => $this->id,
                    'category_id' => $this->category_id,
                    'cost' => $this->cost,
                ]);
        */
        $query->innerJoin(['characteristicItems']);
        foreach ($params as $param) {
            $query->andFilterWhere(['characteristicItems.characteristic_id' => '']);
        }

        $query->andFilterWhere(['like', 'item.title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image]);

        $query->joinWith(['category' => function ($q) {
            $q->where('item_cat.title LIKE "%' . $this->categoryTitle . '%"');
        }]);

        return $query->all();
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