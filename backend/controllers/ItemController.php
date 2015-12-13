<?php

namespace backend\controllers;

use Yii;
use common\models\Item;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{

    public $layout = 'main3';

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->upload();
            if($model->save()){
                $filename = $model->imageFile->baseName ;
                if(file_exists(Item::getPath() . $model->imageFile->baseName . '.' . $model->imageFile->extension)) {
                    $filename = $filename.rand(1, 20);
                }
                $model->imageFile->saveAs(Item::getPath().$filename.'.'.$model->imageFile->extension);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
            return $this->render('create', [
                'model' => $model,
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
                $filename = $model->imageFile->baseName ;
                if(file_exists(Item::getPath() . $model->imageFile->baseName . '.' . $model->imageFile->extension)) {
                    $filename = $filename.rand(1, 20);
                }
                $model->imageFile->saveAs(Item::getPath().$filename.'.'.$model->imageFile->extension);
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
