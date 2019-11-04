<?php

namespace www\controllers;

use common\models\Banner;
use common\models\CharacteristicItem;
use common\models\Item;
use common\models\ItemCat;
use common\models\Letter;
use common\models\Orders;
use common\models\Seo;
use common\models\Slider;
use common\models\StaticPage;
use common\models\Stock;
use common\models\User;
use common\models\Wish;
use common\models\WishList;
use www\filters\ItemsFilter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{

    protected function getDefault($reload = null)
    {
        if($reload) {
            Yii::$app->session->set('page', ItemsFilter::PARAM_ITEMS_ON_CATALOG_PAGE_18);
            Yii::$app->session->set('listType', 'grid');
            Yii::$app->session->set('sort', 'date');
        }else{
            if(!Yii::$app->session->get('page')) Yii::$app->session->set('page', ItemsFilter::PARAM_ITEMS_ON_CATALOG_PAGE_18);
            if(!Yii::$app->session->get('listType')) Yii::$app->session->set('listType', 'grid');
            if(!Yii::$app->session->get('sort')) Yii::$app->session->set('sort', 'date');
        }
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            if(Yii::$app->request->post('modalId')) Yii::$app->session->set('modalId',Yii::$app->request->post('modalId'));
        }

        $catIds = null;
        $cat_sliders = [];
        do {
            $category = ItemCat::find()->andFilterWhere(['in', 'parent_id', $catIds])
                ->andFilterWhere(['active' => (int) true])->orderBy('slider_order')->andFilterWhere(['in_slider' => (int) true])->all();
            $catIds = null;
            if ($category && count($cat_sliders) <= 16 && count($cat_sliders) < count(ItemCat::find()->all())) {
                foreach ($category as $cat) {
                    $cat_sliders[] = $cat;
                    $catIds[] = $cat->id;
                    if (count($cat_sliders) > 16 && count($cat_sliders) >= count(ItemCat::find()->all())) break;
                }
            }
        } while ((count($cat_sliders) < 16 && count($cat_sliders) < count(ItemCat::find()->all())));

        $slider = Slider::find()->all();
        $special = Item::findOne(['special' => (int) true, 'active' => true]);
        $best_seller = Item::findAll(['active' => true, 'best_seller' => (int) true]);
        $deal_week = Item::findAll(['active' => true, 'deal_week' => (int) true]);
        $centerBanners = Banner::find()->where(['enable' => 1, 'position' => Banner::POSITION_INDEX_CENTER])->all();
        $centerBannersImages = [];
        /* @var $centerBanner Banner */
        foreach ($centerBanners as $centerBanner) {
            $centerBannersImages[] = Html::a(Html::img($centerBanner->getImageUrl()), $centerBanner->url);
        }

        $items = Item::find()->andWhere(['active' => true])->orderBy('created_at desc')
            ->limit(ItemsFilter::getParam(ItemsFilter::PARAM_ITEMS_ON_FIRST_PAGE));
        $salesItemsQuery = Item::find()->threeItems();
        $stocks = Stock::find()->current()->all();
        $itemsDataProvider = new ActiveDataProvider([
            'query' => $items,
            'pagination' => false,
        ]);
        return $this->render('index', [
            'itemsDataProvider' => $itemsDataProvider,
            'category_slider' => $cat_sliders,
            'special' => $special,
            'deal_week' => $deal_week,
            'best_seller' => $best_seller,
            'stocks' => $stocks,
            'saleItems' => $salesItemsQuery->all(),
            'salesCount' => $salesItemsQuery->count(),
            //'topItems' => Item::find()->top()->all(),
            'centerBanners' => $centerBannersImages,
            'slider' => $slider,
            'rightBanner' => Banner::findOne(['enable' => 1, 'position' => Banner::POSITION_INDEX_RIGHT]),
        ]);
    }

    /**
     * @param $sort string
     * @param $items \yii\db\ActiveQuery
     * @return \yii\db\ActiveQuery
     */
    protected function sorting($items, $sort)
    {
        switch ($sort) {
            case 'asc' : $items->orderBy('cost asc'); break;
            case 'desc' : $items->orderBy('cost desc'); break;
            case 'promo' : $items->join('inner join', 'stock_item', 'stock_item.item_id=item.id'); break;
            case 'date' : $items->orderBy('created_at desc'); break;
            case 'rating' : $items->join('inner join', 'vote', 'vote.item_id=item.id')
                ->groupBy('vote.item_id')->orderBy('avg(vote.rating) desc'); break;
            case 'top' : $items->join('inner join', 'order_item', 'order_item.item_id=item.id')
                ->groupBy('order_item.item_id')->orderBy('count(order_item.count) desc'); break;
            case 'new' : $items->orderBy('created_at desc'); break;
        }
    }

    /**
     * @param $search string
     * @param $category_id integer
     * @param $sort string
     * @return string
     */
    public function actionSearch($search = '')
    {
        $this->getDefault(Yii::$app->request->post('data'));
        $filter = new ItemsFilter(Yii::$app->request->post());
        $filter->addFilterData();

        $request = Yii::$app->request;
        $items = Item::find()->where(['like', 'title', $search]);

        $sort = (Yii::$app->session->get('sort')) ? Yii::$app->session->get('sort') : 'date';
        $this->sorting($items, $sort);

        //for filter by price
        $minCost =Item::find()->where(['like', 'title', $search])->min('cost');
        $maxCost = Item::find()->where(['like', 'title', $search])->max('cost');
        $countCosts[] = Item::find()->where(['like', 'title', $search])->andFilterWhere(['between', 'cost',0,99.99])->count();
        $countCosts[] = Item::find()->where(['like', 'title', $search])->andFilterWhere(['between', 'cost',100,499.99])->count();
        $countCosts[] = Item::find()->where(['like', 'title', $search])->andFilterWhere(['between', 'cost',500,999.99])->count();
        $countCosts[] = Item::find()->where(['like', 'title', $search])->andFilterWhere(['>=', 'cost',1000])->count();

        $left = Yii::$app->session->get('left');
        $right = Yii::$app->session->get('right');
        if (isset($left) && isset($right)){
            $items->andFilterWhere(['between', 'cost',$left,$right]);
        }

        if($manufacturer = Yii::$app->session->get('manufacturer')){
            $items->andFilterWhere(['in', 'manufacturer_id',$manufacturer]);
        }
        $items->with(['stockItems', 'images', 'stocks']);

//        var_dump($items->asArray()->all());

        $dataProvider = new ActiveDataProvider([
            'query' => $items->andWhere(['active' => true]),
            'pagination' => [
                'pageSize' => ItemsFilter::getParam((Yii::$app->session->get('page'))),
            ],
        ]);
        $mapData = [];
        foreach ($dataProvider->getModels() as $key => $model){
            $mapData[$model->id] = $key;
        }
//var_dump($modalId);
        $this->breadcrumbs = ['Search - ' . $search];


        return $this->render('search', [
            'sort' => $sort,
            'minCost' => $minCost,
            'maxCost' => $maxCost,
            'countCosts' => $countCosts,
            'dataProvider' => $dataProvider,
            'count' => $items->count(),
            'search' => $search
        ]);
    }

    /**
     * @param integer $id of category
     * @return string
     */
    public function actionCategory($id)
    {
        $this->getDefault(Yii::$app->request->post('data'));

        $id = explode('-', $id)[0];
        $data = Yii::$app->request->post();
        if(Yii::$app->session->get('currentCategoryId') !=$id){
            Yii::$app->session->set('currentCategoryId',$id);
            $data['currentCategoryId'] = true;
        }
        $filter = new ItemsFilter($data);
        $filter->addFilterData();
        $request = Yii::$app->request;
        $selected = $request->get('filter');
        $items = $this->filter($selected);
        $items->andFilterWhere(['category_id' => $id]);
        /**@var ItemCat $category*/
        $category = self::findItemCatModel($id);
        $category_ids = $category->getFamily();
        $items->orFilterWhere(['in','category_id',$category_ids]);
        $slider = Slider::find()->all();
        $seo = Seo::findOne(['new_url'=> $category->strReplaceUrl($category->getUrl())]);
        if(isset($seo) && !empty($seo->h1)){
            $category->h1 = $seo->h1;
        }else{
            $category->h1 = $category->title;
        }

        if ($search = $request->get('search')) {
            $items->andFilterWhere(['like', 'title', $search]);
        }
        $sort = (Yii::$app->session->get('sort')) ? Yii::$app->session->get('sort') : 'date';
        $quantity = $request->get('quantity', self::PAGE_SIZE);
        $this->sorting($items, $sort);

        //for filter by price
        $minCost = Item::find()->andFilterWhere(['category_id' => $category_ids])->min('cost');
        $maxCost = Item::find()->andFilterWhere(['category_id' => $category_ids])->max('cost');
        $countCosts[] = Item::find()->andFilterWhere(['category_id' => $category_ids])->andFilterWhere(['between', 'cost',0,99.99])->count();
        $countCosts[] = Item::find()->andFilterWhere(['category_id' => $category_ids])->andFilterWhere(['between', 'cost',100,499.99])->count();
        $countCosts[] = Item::find()->andFilterWhere(['category_id' => $category_ids])->andFilterWhere(['between', 'cost',500,999.99])->count();
        $countCosts[] = Item::find()->andFilterWhere(['category_id' => $category_ids])->andFilterWhere(['>=', 'cost',1000])->count();
        $left = Yii::$app->session->get('left');
        $right = Yii::$app->session->get('right');
        if (isset($left) && isset($right)){
            $items->andFilterWhere(['between', 'cost',$left,$right]);
        }

        if($manufacturer = Yii::$app->session->get('manufacturer')){
            $items->andFilterWhere(['in', 'manufacturer_id',$manufacturer]);
        }

        $items->with(['stockItems', 'images', 'stocks']);
        $filterCounts = CharacteristicItem::find()->select(['characteristic_id', 'count(characteristic_id) as count'])
            ->join('inner join', 'characteristic', 'characteristic_item.characteristic_id=characteristic.id')
            ->where(['category_id' => $id])->groupBy('characteristic_id')
            ->indexBy('characteristic_id')->asArray(true)->all();

        $dataProvider = new ActiveDataProvider([
            'query' => $items->andWhere(['active' => true]),
            'pagination' => [
                'pageSize' => ItemsFilter::getParam((Yii::$app->session->get('page'))),
            ],
        ]);
        $mapData = [];
        foreach ($dataProvider->getModels() as $key => $model){
            $mapData[$model->id] = $key;
        }


        $this->breadcrumbs = [$category->getUrl() => $category->title];



        return $this->render('category', [
            'selected' => empty($selected) ? [] : $selected,
            'sort' => $sort,
            'chars' => $category->characteristics,
            'filterCounts' => $filterCounts,
            'minCost' => $minCost,
            'maxCost' => $maxCost,
            'countCosts' => $countCosts,
            'dataProvider' => $dataProvider,
            'category' => $category,
            'count' => $items->count(),
            'quantity' => $quantity,
            'slider' => $slider,
            'mapData' => $mapData,
            'isajax' => false,
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
     * @param integer $id of promotion
     * @return string
     */
    public function actionPolitic()
    {
        return $this->render('politic');
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
            $query->andFilterWhere(['id', 'item.id', $filterWhere] );

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
    public function actionWish($item_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->user->isGuest){
            $html = Yii::t('app','Register for use Wish List');
            return ['html' => $html];
        }
        $wishList = WishList::findOne(['user_id'=>Yii::$app->user->id]);
        if (empty($wishList)){
            $wishList = new WishList();
            $wishList->user_id = Yii::$app->user->id;
            $wishList->save();
        }
        if(empty(Wish::findOne(['list_id' => $wishList->id, 'item_id' => $item_id]))) {
            $wish = new Wish();
            $wish->list_id = $wishList->id;
            $wish->item_id = $item_id;
            $wish->save();
            $html = Yii::t('app','New wish added');
        } else {
            $html = Yii::t('app','Item already are added at wish list');
        }
        return ['html' => $html];
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
    
    public function actionDelivery()
    {
        $page = StaticPage::findOne(['route' => Yii::$app->controller->route]);
        if ($page) {
            Yii::$app->view->title = $page->title;
            Yii::$app->view->params['breadcrumbs'][] = $page->title;
            return $this->render('delivery', ['page' => $page]);
        } else {
            throw new NotFoundHttpException('Страница не найдена');
        }
    }
    public function actionWhereIsMyOrder()
    {
        if(Yii::$app->request->post()){
            $order_id = Yii::$app->request->post('order_id');
            $model = self::findModelOrder($order_id);
            if(Yii::$app->user->id){
                if ($model->user_id == Yii::$app->user->id){
                    return $this->render('old_order', [
                        'model' => $model,
                    ]);
                }else{
                    return $this->redirect(Url::home());
                }
            }else{
                if(empty($model->user_id)){
                    return $this->render('old_order', [
                        'model' => $model,
                    ]);
                }else{
                    $this->redirect('/login');
                }
            }
        }
        return $this->render('whereIsMyOrder');
    }
    public function actionContactUs()
    {
        $model = new Letter();
        if(Yii::$app->request->post() && $model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'Письмо успешно отправлено');
            return $this->redirect(Url::home());
        }
        $user = User::findOne(Yii::$app->user->id);
        if ($user) {
            $model->email = $user->email;
            $model->phone = $user->phone;
            $model->name = $user->name . ' ' . $user->surname;
        }
        return $this->render('contactUs',compact('model'));
    }

    protected function findModelOrder($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findItemCatModel($id)
    {
        if (($model = ItemCat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
