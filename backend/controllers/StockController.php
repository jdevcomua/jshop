<?php

namespace backend\controllers;

use common\models\ItemCat;
use common\models\StockItem;
use Yii;
use common\models\Stock;
use common\models\search\StockSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

/**
 * StockController implements the CRUD actions for Stock model.
 */
class StockController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stock model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Stock::find()->andFilterWhere(['stock.id' => $id])->joinWith('stockItems')->one();
        $items = new ActiveDataProvider([
            'query' => $model->getStockItems()->joinWith('item'),
        ]);
        return $this->render('view', [
            'model' => $model,
            'items' => $items,
        ]);
    }

    /**
     * Creates a new Stock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stock();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload();
            $items = Yii::$app->request->post('items');
            if (!empty($items)) {
                foreach ($items as $item_id) {
                    $stockItem = new StockItem();
                    $stockItem->stock_id = $model->id;
                    $stockItem->item_id = $item_id;
                    $stockItem->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $arrayItems = [];
            $categories = ItemCat::find()->joinWith('items')->all();
            foreach ($categories as $category) {
                /* @var $category ItemCat*/
                if (!empty($category->items)) {
                    $arrayItems[$category->title] = ArrayHelper::map($category->items, 'id', 'title');
                }
            }
            return $this->render('create', [
                'model' => $model,
                'arrayItems' => $arrayItems,
            ]);
        }
    }

    /**
     * Updates an existing Stock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $selected = $model->getStockItems()->indexBy('item_id')->asArray(true)->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload();
            $items = Yii::$app->request->post('items');
            if (!empty($items)) {
                foreach (array_diff(array_keys($selected), Yii::$app->request->post('items')) as $item_id) {
                    StockItem::find()->andFilterWhere(['item_id' => $item_id, 'stock_id' => $model->id])->one()->delete();
                }
                foreach (array_diff(Yii::$app->request->post('items'), array_keys($selected)) as $item_id) {
                    $stockItem = new StockItem();
                    $stockItem->stock_id = $model->id;
                    $stockItem->item_id = $item_id;
                    $stockItem->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $arrayItems = [];
            $categories = ItemCat::find()->joinWith('items')->all();
            foreach ($categories as $category) {
                /* @var $category ItemCat*/
                $arrayItems[$category->title] = ArrayHelper::map($category->items, 'id', 'title');
            }
            return $this->render('update', [
                'model' => $model,'selected' => array_keys($selected), 'arrayItems' => $arrayItems,
            ]);
        }
    }

    /**
     * Deletes an existing Stock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
