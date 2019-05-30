<?php

namespace backend\controllers;

use Yii;
use common\models\Orders;
use common\models\search\OrdersSearch;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use common\models\OrderItem;
use yii\data\Pagination;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(new Pagination(['pageSize' => Yii::$app->params['pageSize']]));
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws
     */
    public function actionView($id)
    {
        $orderItems = new ActiveDataProvider([
            'query' => OrderItem::find()->andFilterWhere(['order_id' => $id])->joinWith('item'),
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),  'orderItems' => $orderItems
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGroup()
    {
        if (!empty(Yii::$app->request->post()['id'])) {
            $models = Orders::find()->andFilterWhere(['in', 'id', Yii::$app->request->post()['id']])->all();
            if (Yii::$app->request->post('action') == 'paid') {
                foreach ($models as $model) {
                    /* @var $model Orders */
                    $model->payment_status = Orders::PAYMENT_STATUS_PAID;
                    $model->save();
                }
            } elseif(Yii::$app->request->post('action') == 'delete') {
                foreach ($models as $model) {
                    $model->delete();
                }
            } elseif(Yii::$app->request->post('action') == 'sent') {
                foreach ($models as $model) {
                    /* @var $model Orders */
                    $model->order_status = STATUS_SENT;
                    $model->save();
                }
            } elseif(Yii::$app->request->post('action') == 'delivered') {
                foreach ($models as $model) {
                    /* @var $model Orders */
                    $model->order_status = STATUS_SHIPPED;
                    $model->save();
                }
            } elseif(Yii::$app->request->post('action') == 'confirmed') {
                foreach ($models as $model) {
                    /* @var $model Orders */
                    $model->order_status = Orders::STATUS_CONFIRMED;
                    $model->save();
                }
            } elseif(Yii::$app->request->post('action') == 'canceled') {
                foreach ($models as $model) {
                    /* @var $model Orders */
                    $model->order_status = Orders::STATUS_CANCELED;
                    $model->save();
                }
            }
        }
        return $this->redirect(['index']);
    }

}
