<?php

namespace frontend\controllers;

use common\models\Characteristic;
use common\models\CharacteristicItem;
use common\models\Item;
use common\models\ItemCat;
use common\models\Stock;
use common\models\User;
use common\models\Wish;
use common\models\WishList;
use Yii;
use yii\data\ActiveDataProvider;

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
        $salesItemsQuery = Item::find()->threeItems();
        $salesDataProvider = new \yii\data\ActiveDataProvider([
            'query' => $salesItemsQuery
        ]);
        $topDataProvider = new \yii\data\ActiveDataProvider([
            'query' => Item::find()->top()
        ]);
        $stocks = Stock::find()->current()->all();
        return $this->render('index', ['items' => $items, 'wishLists' => $wishLists, 'stocks' => $stocks,
            'salesDataProvider' => $salesDataProvider, 'salesCount' => $salesItemsQuery->count(),
            'topDataProvider' => $topDataProvider
        ]);
    }

    /**
     * @param $sort string
     * @param $items \yii\db\ActiveQuery
     * @return \yii\db\ActiveQuery
     */
    public function sorting($items, $sort)
    {
        switch ($sort) {
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
     * @param $text string
     * @param $category_id integer
     * @return string
     */
    public function actionSearch($text, $category_id = null, $sort = null)
    {
        $items = Item::find()->where(['like', 'item.title', $text])->andFilterWhere(['category_id' => $category_id]);
        $categories = ItemCat::find()->select(['item_cat.id', 'item_cat.title', 'count(item_cat.id) as count'])
            ->innerJoin('item', 'item.category_id = item_cat.id')->where(['like', 'item.title', $text])
            ->groupBy('item_cat.id')->all();
        $this->sorting($items, $sort);
        $dataProvider = new ActiveDataProvider([
            'query' => $items
        ]);
        return $this->render('search', ['dataProvider' => $dataProvider, 'count' => $items->count(), 'text' => $text,
            'categories' => $categories, 'category_id' => $category_id]);
    }

    /**
     * @param integer $id of category
     * @return string
     */
    public function actionCategory($id)
    {
        $id = explode('-', $id)[0];
        $request = Yii::$app->request;
        $selected = $request->get('filter');
        $items = $this->filter($selected);

        $category = ItemCat::findOne($id);
        $items->andFilterWhere(['category_id' => $id]);

        if ($search = $request->get('search')) {
            $items->andFilterWhere(['like', 'title', $search]);
        }
        $sort = $request->get('sort');
        $this->sorting($items, $sort);

        //for filter by price
        $minCost = Item::find()->andFilterWhere(['category_id' => $id])->min('cost');
        $maxCost = Item::find()->andFilterWhere(['category_id' => $id])->max('cost');
        if ($left = $request->get('left') && $right = $request->get('right')) {
            $leftCost = $left;
            $rightCost = $right;
        } else {
            $leftCost = $minCost;
            $rightCost = $maxCost;
        }

        $items->with(['stockItems', 'images']);

        $filterCounts = CharacteristicItem::find()->select(['characteristic_id', 'count(characteristic_id) as count'])
            ->join('inner join', 'characteristic', 'characteristic_item.characteristic_id=characteristic.id')
            ->where(['category_id' => $id])->groupBy('characteristic_id')
            ->indexBy('characteristic_id')->asArray(true)->all();

        if (Yii::$app->user->isGuest) {
            $wishLists = [];
        } else {
            $wishLists = User::findOne(Yii::$app->user->getId())->wishLists;
        }
        return $this->render('category', ['items' => $items, 'selected' => empty($selected) ? [] : $selected, 'sort' => $sort,
            'chars' => $category->characteristics, 'filterCounts' => $filterCounts,
            'minCost' => $minCost, 'maxCost' => $maxCost, 'leftCost' => $leftCost,
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
     * @param $filters array
     * @return \yii\db\ActiveQuery
     */
    public function filter($filters)
    {
        $query = Item::find();
        $char_ids = [];
        if(!empty($filters)) {
            foreach ($filters as $key => $items) {
                $count = count($items);
                if (is_array($items) && $count > 0) {
                    $query1 = CharacteristicItem::find()->select('item_id');
                    $query1->andFilterWhere(['characteristic_id' => $key]);
                    $query1->andFilterWhere(['like', 'value', array_shift($items)]);
                    if ($count > 1) {
                        for ($i = 1; $i < $count; $i++) {
                            $query1->orFilterWhere(['like', 'value', array_shift($items)]);
                        }
                    }
                    //$query1->where('`value` like :val', [':val'=> '%"' . $items['value'] . '"%']);
                    $item_ids = [];
                    foreach ($query1->asArray()->all() as $item) {
                        $item_ids[] = $item['item_id'];
                    }
                    if (in_array($key, $char_ids)) {
                        $query->orFilterWhere(['in', 'item.id', $item_ids]);
                    } else {
                        $char_ids[] = $key;
                        $query->andFilterWhere(['in', 'item.id', $item_ids]);
                    }
                }
            }
        }
        $query->andFilterWhere(['between', 'cost', Yii::$app->request->get('left'), Yii::$app->request->get('right')]);
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