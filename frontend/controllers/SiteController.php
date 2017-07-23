<?php

namespace frontend\controllers;

use common\components\Theme;
use common\models\Banner;
use common\models\CharacteristicItem;
use common\models\Item;
use common\models\ItemCat;
use common\models\Stock;
use common\models\Wish;
use common\models\WishList;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Json;

class SiteController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        $centerBanners = Banner::find()->where(['enable' => 1, 'position' => Banner::POSITION_INDEX_CENTER])->all();
        $centerBannersImages = [];
        /* @var $centerBanner Banner */
        foreach ($centerBanners as $centerBanner) {
            $centerBannersImages[] = Html::a(Html::img($centerBanner->getImageUrl()), $centerBanner->url);
        }
        $items = Item::find()->orderBy('addition_date desc')->limit(Theme::getParam(Theme::PARAM_ITEMS_ON_FIRST_PAGE));
        $salesItemsQuery = Item::find()->threeItems();
        $stocks = Stock::find()->current()->all();
        $itemsDataProvider = new ActiveDataProvider([
            'query' => $items,
            'pagination' => false,
        ]);
        return $this->render('index', [
            'itemsDataProvider' => $itemsDataProvider,
            'stocks' => $stocks,
            'saleItems' => $salesItemsQuery->all(),
            'salesCount' => $salesItemsQuery->count(),
            'topItems' => Item::find()->top()->all(),
            'centerBanners' => $centerBannersImages,
            'rightBanner' => Banner::findOne(['enable' => 1, 'position' => Banner::POSITION_INDEX_RIGHT]),
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
     * @param $sort string
     * @return string
     */
    public function actionSearch($text, $category_id = null, $sort = null)
    {
        $items = Item::find()->where(['like', 'item.title', addcslashes($text, '"')])->andFilterWhere(['category_id' => $category_id]);
        $categories = ItemCat::find()->select(['item_cat.id', 'item_cat.title', 'count(item_cat.id) as count'])
            ->innerJoin('item', 'item.category_id = item_cat.id')->where(['like', 'item.title', addcslashes($text, '"')])
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

        /**@var ItemCat $category*/
        $category = ItemCat::findOne($id);
        $items->andFilterWhere(['category_id' => $id]);

        if ($search = $request->get('search')) {
            $items->andFilterWhere(['like', 'title', $search]);
        }
        $sort = $request->get('sort');
        $quantity = $request->get('quantity', self::PAGE_SIZE);
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

        $items->with(['stockItems', 'images', 'stocks']);

        $filterCounts = CharacteristicItem::find()->select(['characteristic_id', 'count(characteristic_id) as count'])
            ->join('inner join', 'characteristic', 'characteristic_item.characteristic_id=characteristic.id')
            ->where(['category_id' => $id])->groupBy('characteristic_id')
            ->indexBy('characteristic_id')->asArray(true)->all();

        $dataProvider = new ActiveDataProvider([
            'query' => $items,
            'pagination' => [
                'pageSize' => $quantity,
            ]
        ]);

        $this->breadcrumbs = [$category->getUrl() => $category->title];

        return $this->render('category', [
            'items' => $items,
            'selected' => empty($selected) ? [] : $selected,
            'sort' => $sort,
            'chars' => $category->characteristics,
            'filterCounts' => $filterCounts,
            'minCost' => $minCost,
            'maxCost' => $maxCost,
            'leftCost' => $leftCost,
            'dataProvider' => $dataProvider,
            'rightCost' => $rightCost,
            'category' => $category,
            'count' => $items->count(),
            'quantity' => $quantity,
        ]);
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
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getItems()
        ]);
        return $this->render('promotion', [
            'model' => $model, 'dataProvider' => $dataProvider,
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
     * Returns ids of item which passed filters or false if it empty
     * @param $filters array
     * @return array|bool
     */
    public static function getItemIdsForFilter($filters)
    {
        $filterWhere = [];
        if(!empty($filters)) {
            $left = Yii::$app->request->get('left');
            $right = Yii::$app->request->get('right');
            $filterCount = 0;
            foreach ($filters as $key => $items) {
                $count = count($items);
                if (is_array($items) && $count > 0) {
                    $rightSet = key_exists('right', $items);
                    $leftSet = key_exists('left', $items);
                    $query1 = CharacteristicItem::find()->select('item_id');
                    if ($rightSet || $leftSet) {
                        if ($leftSet) {
                            $query1->andFilterWhere(['>=', 'float_value', $items['left']]);
                        }
                        if ($rightSet) {
                            $query1->andFilterWhere(['<=', 'float_value', $items['right']]);
                        }
                    } else {
                        $query1->andFilterWhere(['like', 'value', array_shift($items)]);
                        if ($count > 1) {
                            for ($i = 1; $i < $count; $i++) {
                                $query1->orFilterWhere(['like', 'value', array_shift($items)]);
                            }
                        }
                    }
                    $query1->andFilterWhere(['characteristic_id' => $key])
                        ->innerJoin('item', 'characteristic_item.item_id=item.id')
                        ->andFilterWhere(['between', 'cost', $left, $right]);
                    //$query1->where('`value` like :val', [':val'=> '%"' . $items['value'] . '"%']);
                    $item_ids = [];
                    foreach ($query1->asArray()->all() as $item) {
                        $item_ids[] = $item['item_id'];
                    }
                    $filterWhere = $filterCount == 0 ? $item_ids : array_intersect($filterWhere, $item_ids);
                    $filterCount++;
                }
            }
            if (empty($filterWhere) && $filterCount > 0) {
                return false;
            }
        }
        return $filterWhere;
    }

    /**
     * @param $filters array
     * @return \yii\db\ActiveQuery
     */
    public function filter($filters)
    {
        $query = Item::find();
        $filterWhere = self::getItemIdsForFilter($filters);
        if (is_array($filterWhere)) {
            $query->andFilterWhere(['in', 'item.id', $filterWhere]);
        } else {
            $query->where('false');
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
    
    public function actionSearchHint($q = null) {
        /*$query = new Query;

        $query->select('name')
            ->from('country')
            ->where('name LIKE "%' . $q .'%"')
            ->orderBy('name');
        $command = $query->createCommand();
        $data = $command->queryAll();*/
        $data = Item::find()->select('title')->where(['like', 'title', $q])->all();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['value' => $d->title];
        }
        
        echo Json::encode($out);
    }
}