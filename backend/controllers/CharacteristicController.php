<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use common\models\Characteristic;
use common\models\search\CharacteristicSearch;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use common\models\ItemCat;

/**
 * CharacteristicController implements the CRUD actions for Characteristic model.
 */
class CharacteristicController extends Controller
{

    /**
     * Updates group of existing Characteristic model.
     * If update is successful, the browser will be redirected to the 'index' page.
     */
    public function actionGroup(){
        if (isset(Yii::$app->request->post()['id'])) {
            if (Yii::$app->request->post()['action'] == 'del') {
                foreach (Yii::$app->request->post()['id'] as $id) {
                    $this->findModel($id)->delete();
                }
            } elseif (Yii::$app->request->post()['action'] == 'edit') {
                if(count(Yii::$app->request->post()['id']) == 1){
                    return $this->redirect(Yii::$app->urlHelper->to(['characteristic/update', 'id' => array_shift(Yii::$app->request->post()['id'])]));
                } else {
                    $query = Characteristic::find();
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
        $characteristics = Characteristic::find()->indexBy('id')->all();
        if (Model::loadMultiple($characteristics, Yii::$app->request->post()) && Model::validateMultiple($characteristics)) {
            foreach ($characteristics as $characteristic) {
                $characteristic->save(false);
            }
            return $this->redirect(Yii::$app->urlHelper->to(['characteristic/index']));
        }
        return $this->redirect(Yii::$app->urlHelper->to(['characteristic/index']));
    }

    /**
     * Lists all Characteristic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CharacteristicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(new Pagination(['pageSize' => Yii::$app->params['pageSize']]));
        $categories = Characteristic::find()
            ->select(['i.title'])
            ->join('JOIN', 'item_cat i', 'characteristic.category_id = i.id')
            ->distinct(true)
            ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => ArrayHelper::map($categories, 'title', 'title')
        ]);
    }

    /**
     * Displays a single Characteristic model.
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
     * Creates a new Characteristic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Characteristic();
        $categories = ItemCat::find()->distinct(true)->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->urlHelper->to(['characteristic/view', 'id' => $model->id]));
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => ArrayHelper::map($categories, 'id', 'title'),
            ]);
        }
    }

    /**
     * Updates an existing Characteristic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = ItemCat::find()->distinct(true)->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->urlHelper->to(['characteristic/view', 'id' => $id]));
        } else {
            return $this->render('update', [
                'model' => $model, 'count' => 'one',
                'categories' => ArrayHelper::map($categories, 'id', 'title'),
            ]);
        }
    }

    /**
     * Deletes an existing Characteristic model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->urlHelper->to(['characteristic/index']));
    }

    /**
     * Finds the Characteristic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Characteristic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Characteristic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
