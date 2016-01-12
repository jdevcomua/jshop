<?php

namespace frontend\controllers;

use common\models\CharacteristicItem;
use common\models\Item;
use common\models\ItemCat;
use common\models\User;
use common\models\Wish;
use common\models\WishList;
use Yii;

class SiteController extends Controller
{

    /**
     * @return string
     */
    function actionIndex()
    {
        if (!empty(Yii::$app->request->get('id'))) {
            $item = Item::findOne(Yii::$app->request->get('id'));
            return $this->render('Item', ['item'=>$item]);
        }
        if (!empty(Yii::$app->request->get('category'))) {
            $id = Yii::$app->request->get('category');
        } else {
            $id = 0;
        }
        $selected = [];
        if (!empty(Yii::$app->request->post('CharacteristicItem'))) {
            $items = $this->filter();
            $selected = Yii::$app->request->post('CharacteristicItem');
        } else {
            $items = Item::find();
        }
        if (!isset($id) || ($id == 0) || (!is_int(+$id))) {
            $categoryTitle = 'all';
            $minCost = Item::find()->min('cost');
            $maxCost = Item::find()->max('cost');
        } else {
            /**@var ItemCat $category*/
            $category = ItemCat::findOne($id);
            $categoryTitle = $category->title;
            $items->andFilterWhere(['category_id' => $id]);
            $minCost = Item::find()->andFilterWhere(['category_id' => $id])->min('cost');
            $maxCost = Item::find()->andFilterWhere(['category_id' => $id])->max('cost');
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
        if (!empty(Yii::$app->request->post('left')) && !empty(Yii::$app->request->post('right'))) {
            $leftCost = Yii::$app->request->post('left');
            $rightCost = Yii::$app->request->post('right');
        } else {
            $leftCost = $minCost;
            $rightCost = $maxCost;
        }
        $items = $items->all();
        $characteristics = null;
        if ($id != '0') {
            $characteristics = ItemCat::findOne($id)->characteristics;
        }
        if (Yii::$app->user->isGuest) {
            $wishLists = [];
        } else {
            $wishLists = User::findOne(Yii::$app->user->getId())->wishLists;
        }
        return $this->render('index', ['items'=>$items, 'category_id'=>$id,
            'selected' => $selected, 'categoryTitle'=>$categoryTitle, 'count'=>count($items),
            'chars' => $characteristics, 'minCost' => $minCost, 'maxCost' => $maxCost, 'leftCost' => $leftCost,
            'rightCost' => $rightCost, 'wishLists' => $wishLists]);
    }

    /**
     * Adding item to cart
     * @param $item_id
     * @param $count
     */
    public function actionAjax($item_id, $count)
    {
        Yii::$app->cart->addItem($item_id, $count);
    }

    public function filter()
    {
        $query = Item::find();
        $char_ids = [];
        foreach (Yii::$app->request->post('CharacteristicItem') as $items) {
            if (isset($items['value'])) {
                $query1 = CharacteristicItem::find()->select('item_id');
                $query1->andFilterWhere(['characteristic_id' => $items['characteristic_id']]);
                $query1->where('`value` like :val', [':val'=> '%"' . $items['value'] . '"%']);
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
        $query->andFilterWhere(['between', 'cost', Yii::$app->request->post('left'), Yii::$app->request->post('right')]);
        return $query;
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

    public function actionDellist($list_id)
    {
        return WishList::findOne($list_id)->delete();
    }

    public function actionWish($item_id, $list_id)
    {
        if ($list_id == '0') {
            $wishList = new WishList();
            $wishList->user_id = Yii::$app->user->id;
            $wishList->title = Yii::$app->request->get('textt');
            $wishList->save();
            $list_id = $wishList->id;
        }
        $wish = new Wish();
        $wish->list_id = $list_id;
        $wish->item_id = $item_id;
        $wish->save();
    }

    public function actionDelwish($wish_id)
    {
        return Wish::findOne($wish_id)->delete();
    }
}