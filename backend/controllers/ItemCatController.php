<?php

namespace backend\controllers;

use common\models\Characteristic;
use common\models\Parse;
use common\models\Seo;
use Yii;
use yii\base\Model;
use common\models\ItemCat;
use common\models\search\ItemCatSearch;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * ItemCatController implements the CRUD actions for ItemCat model.
 */
class ItemCatController extends Controller
{

    /**
     * Updating or deleting group of existing ItemCat model.
     * If updating or deleting is successful, the browser will be redirected to the 'index' page.
     */
    public function actionGroup()
    {
        if (isset(Yii::$app->request->post()['id'])) {
            if (Yii::$app->request->post()['action'] == 'del') {
                foreach (Yii::$app->request->post()['id'] as $id) {
                    $model = ItemCat::findOne($id);
                    if ($model) {
                        $model->deleteWithChildren();
                    }
                }
            } elseif (Yii::$app->request->post()['action'] == 'edit') {
                if(count(Yii::$app->request->post()['id']) == 1){
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/update', 'id' => array_shift(Yii::$app->request->post()['id'])]));
                } else {
                    $query = ItemCat::find();
                    foreach (Yii::$app->request->post()['id'] as $id) {
                        $query->orWhere(['id' => $id]);
                    }
                    $models = $query->indexBy('id')->all();
                    return $this->render('update', [
                        'models' => $models, 'count' => 'many',
                    ]);
                }
            }
        }
        $categories = ItemCat::find()->indexBy('id')->all();
        if (Model::loadMultiple($categories, Yii::$app->request->post()) && Model::validateMultiple($categories)) {
            foreach ($categories as $category) {
                $category->save(false);
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item-cat/index']));
        }
        return $this->redirect(Yii::$app->urlHelper->to(['item-cat/index']));
    }

    /**
     * Lists all ItemCat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemCatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(new Pagination(['pageSize' =>Yii::$app->params['pageSize']]));
        $context = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];
        $deleted = Yii::$app->request->get('deleted');
        if (isset($deleted)) {
            $context['deleted'] = $deleted;
        }
        return $this->render('index', $context);
    }

    private function getChildrenItemCat(&$models, ItemCat $parent, $depth)
    {
        $parent->treeDepth = $depth;
        $models[$parent->id] = $parent;
        foreach ($parent->getChildren()->orderBy('slider_order')->all() as $model){
            $this->getChildrenItemCat($models, $model, $depth + 1);
        }
    }

    /**
     * Lists all ItemCat models.
     * @return mixed
     */
    public function actionIndexTree()
    {
        $models = [];
        foreach (ItemCat::find()->andWhere(['parent_id' => null])->orderBy('slider_order')->all() as $root){
            $this->getChildrenItemCat($models, $root, 1);
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
        return $this->render('index-tree', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single ItemCat model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        if(Yii::$app->request->isAjax){
            $parseId = Yii::$app->request->post('id');
            Parse::findOne($parseId)->delete();
            return null;
        }
        $characteristics = new ActiveDataProvider([
            'query' => ItemCat::findOne($id)->getCharacteristics()
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id), 'characteristics' => $characteristics,'parsers'=>Parse::find()->where(['category_id'=>$id])->all(),
        ]);
    }

    /**
     * Creates a new ItemCat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemCat(['active' => true]);
        $model->parse = [new Parse()];
        $seo = new Seo();
        if(Yii::$app->request->isAjax){
            $model->image = Yii::$app->request->post('src');
            $model->deleteImage($model->urlRename());
            return null;
        }
        if ($model->load(Yii::$app->request->post())) {
            if(isset($model->image)){
                $model->image= $model->urlRename();
            }
            $continue = false;
            if ($model->parent_id != 0) {
                $parent = ItemCat::findOne($model->parent_id);
                if ($parent) {
                    $continue = $model->appendTo($parent);
                }
            } else {
                unset($model->parent_id);
                $continue = $model->makeRoot();
            }
            if ($continue) {
                if (Yii::$app->request->post()['action'] == 'save') {
                    if($seo->load(Yii::$app->request->post())){
                        $seo->url = Yii::$app->params['serverUrl'] . '/category/' . $model->id . '-' . $model->getTranslit();
                        $seo->save();
                    }
                    $id = ItemCat::findOne(['title'=>$model->title])->id;
                    $data = Yii::$app->request->post('Parse', []);
                    foreach (array_keys($data) as $index) {
                        $parses[$index] = new Parse();
                    }
                    Model::loadMultiple($parses, Yii::$app->request->post());
                    $this->saveParses($parses,$id);
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/view', 'id' => $model->id]));
                } elseif (Yii::$app->request->post()['action'] == 'chars') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/characteristics', 'id' => $model->id]));
                }
            }
        }
        $categoriesArray = ArrayHelper::map(ItemCat::find()->all(), 'id', 'title');
        return $this->render('create', [
            'model' => $model, 'categories' => $categoriesArray,'seo'=>$seo,
        ]);
    }
    public function actionAddParseUrl($id)
    {
        $model = new Parse();
        if ($model->load(Yii::$app->request->post())) {
            $model->category_id = $id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        return $this->render('addParseUrl', [
            'model' => $model,
        ]);
    }

    /**
     * @param Parse[] $parses
     * @param integer $id
     */
    public function saveParses($parses, $id){
        foreach ($parses as $parse){
            $parse->url = trim($parse->url);
            $p = Parse::findOne(['category_id'=>$id,'url'=>$parse->url]);
            if(!isset($p) && $parse->url!==''){
                $parse->category_id = $id;
                $parse->save();
            }
        }
    }

    /**
     * Updates an existing ItemCat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        if($model->parse==[])
            $model->parse = [new Parse()];
        $seo = Seo::findOne(['url'=>Yii::$app->params['serverUrl'] . '/category/' . $model->id . '-' . $model->getTranslit()]);
        if(!isset($seo))
            $seo = new Seo();
        if(Yii::$app->request->isAjax){
            $model->image = Yii::$app->request->post('src');
            $model->deleteImage($model->urlRename());
            $model->save();
            return null;
        }
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            $data = Yii::$app->request->post('Parse', []);
            foreach (array_keys($data) as $index) {
                $parses[$index] = new Parse();
            }
            Model::loadMultiple($parses, Yii::$app->request->post());
            $oldParses = Parse::find()->where(['category_id'=>$id])->all();
            foreach ($oldParses as $oldParse){
                $oldParse->delete();
            }
            $this->saveParses($parses,$id);
            if($model->isAttributeChanged('image')){
                $model->image= $model->urlRename();
            }
            $continue = false;
            if ($model->parent_id && $model->isAttributeChanged('parent_id', false)) {
                $parent = ItemCat::findOne($model->parent_id);
                if ($parent) {
                    $continue = $model->appendTo($parent);
                }
            } else {
                $continue = $model->save();
            }
            if($seo->load($request->post())){
                $seo->url = Yii::$app->params['serverUrl'] . '/category/' . $model->id . '-' . $model->getTranslit();
                $seo->save();
            }
            if ($continue) {
                if ($request->post('action') == 'save') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/view', 'id' => $id]));
                } else if ($request->post('action') == 'chars') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/characteristics', 'id' => $model->id]));
                }
            }
        }
        $categoriesArray = ArrayHelper::map(ItemCat::find()->all(), 'id', 'title');
        return $this->render('update', [
            'model' => $model,
            'categories' => $categoriesArray,
            'seo'=>$seo,
        ]);
    }

    /**
     * Deletes an existing ItemCat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Exception|\Throwable
     */
    public function actionDelete($id)
    {
        $category = $this->findModel($id);
        if ($category->getItems()->count() > 0) {
            $deleted = false;
        } else {
            $category->delete();
            $deleted = true;
        }

        return $this->redirect(Yii::$app->urlHelper->to(['item-cat/index', 'deleted' => $deleted]));
    }

    /**
     * Finds the ItemCat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemCat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemCat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $id integer id of category
     * @return string|\yii\web\Response
     */
    public function actionCharacteristics($id)
    {
        $request = Yii::$app->request;
        $models = Characteristic::find()->where(['category_id' => $id])->indexBy('id')->all();

        if ($request->isPost) {
            $data = $request->post('Characteristic', []);
            $withId = [];
            //добавляем новые
            foreach ($data as $char) {
                if ($char['id'] == "") {
                    $newChar = new Characteristic(['category_id' => $id, 'title' => $char['title'], 'type' => $char['type']]);
                    $newChar->save();
                } else {
                    $withId[$char['id']] = ['title' => $char['title'], 'type' => $char['type']];
                }
            };
            //просматриваем старые
            $keys = array_keys($withId);
            /* @var $model Characteristic */
            foreach ($models as $model) {
                if (in_array($model->id, $keys)) {
                    $model->title = $withId[$model->id]['title'];
                    $model->type = $withId[$model->id]['type'];
                    $model->save();
                } else {
                    $model->delete();
                }
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item-cat/view', 'id' => $id]));
        }

        if (count($models) == 0) {
            $models[] = new Characteristic();
        }

        return $this->render('characteristics', [
            'models' => $models, 'category' => ItemCat::findOne($id)
        ]);
    }

    public function actionSetInSlider()
    {
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            $model = self::findModel($post['id']);
            $model->in_slider = filter_var($post['checked'], FILTER_VALIDATE_BOOLEAN);
            return $model->save();
        }else{
            return false;
        }
    }

    public function actionOrderUp()
    {
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            $model = self::findModel($post['id']);
            $modelPrev = ItemCat::find()->where(['<', 'slider_order', $model->slider_order])
                ->orderBy(['slider_order' => SORT_DESC])
                ->one();
            $prev = $modelPrev->slider_order;
            $modelPrev->slider_order = $model->slider_order;
            $modelPrev->save();
            $model->slider_order = $prev;
            return $model->save();
        }else{
            return false;
        }
    }

    public function actionOrderDown()
    {
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            $model = self::findModel($post['id']);
            $modelNext = ItemCat::find()->where(['>', 'slider_order', $model->slider_order])
                ->orderBy(['slider_order' => SORT_ASC])
                ->one();
            $next = $modelNext->slider_order;
            $modelNext->slider_order = $model->slider_order;
            $modelNext->save();
            $model->slider_order = $next;
            return $model->save();
        }else{
            return false;
        }
    }

}
