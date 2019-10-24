<?php

namespace backend\controllers;

use Yii;
use common\models\Letter;
use common\models\search\LetterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LetterController implements the CRUD actions for Letter model.
 */
class LetterController extends Controller
{
    /**
     * {@inheritdoc}
     */

    /**
     * Lists all Letter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LetterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Letter model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing Letter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDel()
    {
        if(isset(Yii::$app->request->post()['id'])){
            foreach (Yii::$app->request->post()['id'] as $id) {
                $model = $this->findModel($id);
                $model->delete();
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Letter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Letter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Letter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
