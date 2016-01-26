<?php

namespace backend\controllers;

use Yii;
use common\models\Kit;
use common\models\search\KitSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ItemCat;
use yii\helpers\ArrayHelper;
use common\models\KitItem;
use yii\data\ActiveDataProvider;

/**
 * KitController implements the CRUD actions for Kit model.
 */
class KitController extends Controller
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
     * Lists all Kit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Kit::find()->where('id = ' + $id)->joinWith('kitItems')->one();
        $items = new ActiveDataProvider([
            'query' => $model->getKitItems()->joinWith('item'),
        ]);
        return $this->render('view', [
            'model' => $model, 'items' => $items,
        ]);
    }

    /**
     * Creates a new Kit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kit();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $items = Yii::$app->request->post('items');
            if (!empty($items)) {
                foreach ($items as $item_id) {
                    $stockItem = new KitItem();
                    $stockItem->kit_id = $model->id;
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
                'model' => $model, 'arrayItems' => $arrayItems,
            ]);
        }
    }

    /**
     * Updates an existing Kit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $selected = $model->getKitItems()->indexBy('item_id')->asArray(true)->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $items = Yii::$app->request->post('items');
            if (!empty($items)) {
                foreach (array_diff(array_keys($selected), Yii::$app->request->post('items')) as $item_id) {
                    KitItem::find()->andFilterWhere(['item_id' => $item_id, 'kit_id' => $model->id])->one()->delete();
                }
                foreach (array_diff(Yii::$app->request->post('items'), array_keys($selected)) as $item_id) {
                    $stockItem = new KitItem();
                    $stockItem->kit_id = $model->id;
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
            return $this->render('update', [
                'model' => $model, 'arrayItems' => $arrayItems, 'selected' => array_keys($selected)
            ]);
        }
    }

    /**
     * Deletes an existing Kit model.
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
     * Finds the Kit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
