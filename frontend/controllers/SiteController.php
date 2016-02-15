<?php

namespace frontend\controllers;

use common\models\CharacteristicItem;
use common\models\Item;
use common\models\ItemCat;
use common\models\Orders;
use common\models\Stock;
use common\models\User;
use common\models\Wish;
use common\models\WishList;
use Yii;

class SiteController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        $items = Item::find()->orderBy('addition_date desc')->limit(6);
        if (Yii::$app->user->isGuest) {
            $wishLists = [];
        } else {
            $wishLists = User::findOne(Yii::$app->user->getId())->wishLists;
        }
        return $this->render('index', ['items' => $items, 'wishLists' => $wishLists]);
    }

    /**
     * @param $items \yii\db\ActiveQuery
     * @return \yii\db\ActiveQuery
     */
    public function sorting($items)
    {
        switch (Yii::$app->request->get('sort')) {
            case 'asc' : $items->orderBy('cost asc'); break;
            case 'desc' : $items->orderBy('cost desc'); break;
            case 'promotions' : $items->join('inner join', 'stock_item', 'stock_item.item_id=item.id'); break;
            case 'date' : $items->orderBy('addition_date desc'); break;
            case 'rating' : $items->join('inner join', 'vote', 'vote.item_id=item.id')
                ->groupBy('vote.item_id')->orderBy('avg(vote.rating) desc'); break;
            case 'top' : $items->join('inner join', 'order_item', 'order_item.item_id=item.id')
                ->groupBy('order_item.item_id')->orderBy('count(order_item.count) desc'); break;
            case 'new' : $items->orderBy('addition_date desc'); break;
        }
    }

    /**
     * @param integer $id of category
     * @return string
     */
    public function actionCategory($id)
    {
        $id = explode('-', $id)[0];
        $items = $this->filter();

        $selected = [];
        if (!empty(Yii::$app->request->post('CharacteristicItem'))) {
            foreach (Yii::$app->request->post('CharacteristicItem') as $char) {
                if (isset($char['value'])) {
                    $selected[] = $char;
                }
            }
        }

        $category = ItemCat::findOne($id);
        $items->andFilterWhere(['category_id' => $id]);

        if (!empty(Yii::$app->request->get('search'))) {
            $items->andFilterWhere(['like', 'title', Yii::$app->request->get('search')]);
        }

        $this->sorting($items);

        //for filter by price
        $minCost = Item::find()->andFilterWhere(['category_id' => $id])->min('cost');
        $maxCost = Item::find()->andFilterWhere(['category_id' => $id])->max('cost');
        if (!empty(Yii::$app->request->post('left')) && !empty(Yii::$app->request->post('right'))) {
            $leftCost = Yii::$app->request->post('left');
            $rightCost = Yii::$app->request->post('right');
        } else {
            $leftCost = $minCost;
            $rightCost = $maxCost;
        }

        $items->with(['stockItems', 'images']);

        if (Yii::$app->user->isGuest) {
            $wishLists = [];
        } else {
            $wishLists = User::findOne(Yii::$app->user->getId())->wishLists;
        }
        return $this->render('category', ['items' => $items, 'selected' => $selected,
            'chars' => $category->characteristics, 'minCost' => $minCost, 'maxCost' => $maxCost, 'leftCost' => $leftCost,
            'rightCost' => $rightCost, 'wishLists' => $wishLists, 'category' => $category, 'count' => $items->count(),]);
    }

    /**
     * Adding item to cart
     * @param $item_id integer
     * @param $count integer
     */
    public function actionAjax($item_id, $count)
    {
        Yii::$app->cart->addItem($item_id, $count);
    }

    /**
     * @return string
     */
    public function actionPromotions()
    {
        $stocks = Stock::find()->current()->all();
        return $this->render('promotions', [
            'stocks' => $stocks,
        ]);
    }

    /**
     * @param integer $id of promotion
     * @return string
     */
    public function actionPromotion($id)
    {
        $model = Stock::findOne($id);
        return $this->render('promotion', [
            'model' => $model,
        ]);
    }

    /**
     * @param $item_id integer
     */
    public function actionCompare($item_id)
    {
        Yii::$app->compare->addItem(Item::findOne($item_id));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function filter()
    {
        $query = Item::find();
        $char_ids = [];
        if(!empty(Yii::$app->request->post('CharacteristicItem'))) {
            foreach (Yii::$app->request->post('CharacteristicItem') as $items) {
                if (isset($items['value'])) {
                    $query1 = CharacteristicItem::find()->select('item_id');
                    $query1->andFilterWhere(['characteristic_id' => $items['characteristic_id']]);
                    $query1->andFilterWhere(['like', 'value', $items['value']]);
                    //$query1->where('`value` like :val', [':val'=> '%"' . $items['value'] . '"%']);
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

    /**
     * @param $list_id integer
     * @return false|int
     */
    public function actionDellist($list_id)
    {
        return WishList::findOne($list_id)->delete();
    }

    /**
     * @param $item_id integer
     * @param $list_id integer
     */
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

    /**
     * @param $wish_id integer
     * @return false|int
     */
    public function actionDelwish($wish_id)
    {
        return Wish::findOne($wish_id)->delete();
    }
}