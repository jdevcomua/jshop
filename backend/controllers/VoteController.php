<?php

namespace backend\controllers;

use Yii;
use common\models\Vote;
use common\models\search\VoteSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * VoteController implements the CRUD actions for Vote model.
 */
class VoteController extends Controller
{

    /**
     * Lists all Vote models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(new Pagination(['pageSize' => PAGE_SIZE]));
        $notChecked = new ActiveDataProvider([
            'query' => Vote::find()->andFilterWhere(['checked' => Vote::STATUS_NOT_CHECKED])->orderBy('timestamp')
        ]);
        $notChecked->setPagination(new Pagination(['pageSize' => PAGE_SIZE]));
        $hidden = new ActiveDataProvider([
            'query' => Vote::find()->andFilterWhere(['checked' => Vote::STATUS_HIDDEN])->orderBy('timestamp')
        ]);
        $hidden->setPagination(new Pagination(['pageSize' => PAGE_SIZE]));
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notChecked' => $notChecked,
            'hidden' => $hidden,
        ]);
    }

    /**
     * Displays a single Vote model.
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
     * Creates a new Vote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vote();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
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
     * Deletes an existing Vote model.
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
     * Finds the Vote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vote::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGroup()
    {
        if (isset(Yii::$app->request->post()['id'])) {
            $models = Vote::find()->andFilterWhere(['in', 'id', Yii::$app->request->post()['id']])->all();
            if (Yii::$app->request->post()['action'] == '1') {
                foreach ($models as $vote) {
                    /* @var $vote Vote*/
                    $vote->checked = 1;
                    $vote->save();
                }
            } elseif (Yii::$app->request->post()['action'] == '-1') {
                foreach ($models as $vote) {
                    /* @var $vote Vote*/
                    $vote->checked = -1;
                    $vote->save();
                }
            }
        }
        return $this->redirect(['index']);
    }
}
