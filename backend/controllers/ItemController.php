<?php

namespace backend\controllers;

use common\models\search\ItemSearch;
use Yii;
use common\models\Item;
use backend\models\CharacteristicsForm;
use common\models\CharacteristicItem;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\search\CharacteristicItemSearch;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        /*$dataProvider = new ActiveDataProvider([
            'query' => Item::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);*/
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new CharacteristicItemSearch();
        $searchModel->item_id = $id;
        $characteristics = $searchModel->search([
            'item_id' => $id,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id), 'characteristics' => $characteristics
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post())) {
            if(isset($model->imageFile)){
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->upload();
            }
            if($model->save()){
                if(isset($model->imageFile)) {
                    $filename = $model->imageFile->baseName;
                    if (file_exists(Item::getPath() . $model->imageFile->baseName . '.' . $model->imageFile->extension)) {
                        $filename = $filename . rand(1, 20);
                    }
                    $model->imageFile->saveAs(Item::getPath() . $filename . '.' . $model->imageFile->extension);
                }
                /*return $this->render('characteristics', [
                    'model' => $model,
                ]);*/
                return $this->redirect(['characteristics', 'id' => $model->id]);
            }
        }
            return $this->render('create', [
                'model' => $model,
            ]);

    }

    public function actionCharacteristics($id){
        if (Yii::$app->request->post()) {
            foreach(Yii::$app->request->post() as $value){
                if(is_array($value)) {
                    foreach ($value as $v) {
                        if(is_array($v)) {
                            foreach($v as $v2){
                                /* @var $newCh CharacteristicItem*/
                                $newCh = new CharacteristicItem();
                                $newCh->characteristic_id = $v2[0];
                                $newCh->item_id = $v2[1];
                                $newCh->value = $v2[2];
                                $newCh->save();
                            }
                        }
                    }
                }
            }
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('characteristics', [
            'item' => $this->findModel($id), 'model' => new CharacteristicsForm()
        ]);
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
        if ($model->load(Yii::$app->request->post())) {
            if(isset($model->imageFile)){
                $lastImage = $model->image;
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->upload();
            }
            if($model->save()){
                if(isset($model->imageFile)) {
                    $filename = $model->imageFile->baseName;
                    if (file_exists(Item::getPath() . $model->imageFile->baseName . '.' . $model->imageFile->extension)) {
                        $filename = $filename . rand(1, 20);
                    }
                    $model->imageFile->saveAs(Item::getPath() . $filename . '.' . $model->imageFile->extension);
                }
                if(isset($lastImage)){
                    if(file_exists(Item::getPath().$lastImage)){
                        unlink(Item::getPath().$lastImage);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        if(file_exists(Item::getPath().$model->image)){
            unlink(Item::getPath().$model->image);
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
