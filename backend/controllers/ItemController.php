<?php

namespace backend\controllers;

use common\models\Image;
use common\models\ItemCat;
use common\models\search\ItemSearch;
use common\models\Wish;
use yii\base\Model;
use Yii;
use common\models\Item;
use common\models\Characteristic;
use common\models\CharacteristicItem;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{

    public function actions()
    {
        return [
            'uploadPhoto' => [
                'class' => 'backend\widget\CropWidget\actions\UploadAction',
                'url' => Yii::$app->getRequest()->getHostInfo() . Item::IMG,
                'path' => '@www/web/img',
            ]
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(new Pagination(['pageSize' => Yii::$app->params['pageSize']]));
        $categories = Item::find()
            ->select(['i.title'])
            ->join('JOIN', 'item_cat i', 'item.category_id = i.id')
            ->distinct(true)
            ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filterByCategories' => ArrayHelper::map($categories, 'title', 'title'),
        ]);
    }

    /**
     * Delete group of Item model
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return \yii\web\Response
     */
    public function actionDel()
    {
        foreach (Yii::$app->request->post()['id'] as $id) {

            $model = $this->findModel($id);
            Wish::find()->where(['item_id'=>$id])->all()->delete();
            $image = Image::findOne(['item_id'=>$id]);
            if(isset($image)){
                $model->deleteImages($image);
            }
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $characteristics = new ActiveDataProvider([
            'query' => CharacteristicItem::find()->joinWith('characteristic')
                ->andFilterWhere(['characteristic_item.item_id' => $id])
                ->andFilterWhere(['!=', 'characteristic_item.value', '{"ru":""}'])
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id), 'characteristics' => $characteristics
        ]);
    }

    public function actionDeleteImage($id)
    {
        Image::findOne($id)->delete();
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Item(['active' => true]);

        if(Yii::$app->request->isAjax){
            $imageUrl = Yii::$app->request->post('src');
            $model->deleteImagesFromServer(basename($imageUrl));
            return null;
        }


        $categories = ItemCat::find()->select(['id', 'title'])->all();
        $categoriesArray = ArrayHelper::map($categories, 'id', 'title');
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            if ($model->save()) {
                $model->imageFiles= $model->urlRename();

                $model->upload();
                if ($request->post('action') == 'characteristics') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item/characteristics', 'id' => $model->id]));
                } else {
                    return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $model->id]));
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categoriesArray
        ]);

    }

    /**
     * Updates characteristics of Item.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id of item
     * @return string|\yii\web\Response
     */
    public function actionUpdateCharacteristics($id)
    {
        $item = Item::findOne($id);
        // значения характеристик товара
        $characteristics = $item->getCharacteristicItems()->indexBy('characteristic_id')->all();
        // все характеристики категории
        $categoryChars = Characteristic::find()->where(['category_id' => $item->category_id])->all();
        // если появились новые характеристики, для которых нет значения у этого товара
        if (count($categoryChars) > count($characteristics)) {
            $keys = array_keys($characteristics);
            /* @var $characteristic Characteristic */
            foreach ($categoryChars as $characteristic) {
                if (!in_array($characteristic->id, $keys)) {
                    $newChar = new CharacteristicItem(['item_id' => $id, 'characteristic_id' => $characteristic->id, 'value' => '']);
                    $newChar->save();
                    $characteristics[$characteristic->id] = $newChar;
                }
            }
        }
        if (Model::loadMultiple($characteristics, Yii::$app->request->post()) && Model::validateMultiple($characteristics)) {
            foreach ($characteristics as $characteristic) {
                $characteristic->save(false);
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $id]));
        }

        return $this->render('characteristics', ['characteristics' => $characteristics, 'item' => $item]);
    }

    /**
     * Create group of Characteristic models
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id of item
     * @return string|\yii\web\Response
     */
    public function actionCharacteristics($id)
    {
        $item = Item::findOne($id);
        $chars = Characteristic::find()->where(['category_id' => $item->category_id])->all();
        $characteristics = [];
        foreach ($chars as $char) {
            $char_item = new CharacteristicItem();
            /* @var $char Characteristic*/
            $char_item->item_id = $id;
            $char_item->characteristic_id = $char->id;

            $characteristics[] = $char_item;
        }
        if (Model::loadMultiple($characteristics, Yii::$app->request->post()) && Model::validateMultiple($characteristics)) {
            foreach ($characteristics as $characteristic) {
                $characteristic->save();
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $id]));
        }

        return $this->render('characteristics', ['characteristics' => $characteristics, 'item' => $item]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = ItemCat::find()->select(['id', 'title'])->all();
        $request = Yii::$app->request;
        $image = Image::findOne(['item_id'=>$id]);
        if($image == NULL){
            $image = new Image;
            $image->name = 'noimage';
        }else{
            $model->imageFiles = $image->name;
        }

        if(Yii::$app->request->isAjax){

            $image= Image::findOne(['item_id'=>$model->id]);
            if($image!=NULL){
                $model->deleteImages($image);
            }else{
                $imageUrl = Yii::$app->request->post('src');
                $model->deleteImagesFromServer(basename($imageUrl));
            }
            return null;
        }

        if ($model->load($request->post())) {
            if ($model->save()) {
                if($image->name !== $model->imageFiles){
                    $model->imageFiles = $model->urlRename();
                    $model->deleteImages($image);
                    $model->upload();
                }

                if ($request->post('action') == 'characteristics') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item/characteristics', 'id' => $model->id]));
                } else {
                    return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $model->id]));
                }
            }

            return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $id]));
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => ArrayHelper::map($categories, 'id', 'title'),
            ]);
        }
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
            $model = $this->findModel($id);
            $image = Image::findOne(['item_id'=>$id]);
            if(isset($image)){
                $model->deleteImages($image);
            }
            $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
