<?php

namespace backend\controllers;

use backend\models\AssignmentForm;
use Yii;
use common\models\User;
use common\models\search\UserSearch;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UserController extends Controller
{

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(new Pagination(['pageSize' => Yii::$app->params['pageSize']]));
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
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
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        $model->setScenario('adminPass');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->password != '') {
                $model->setPassword($model->password);
                $model->save();
            }
            return $this->redirect(Yii::$app->urlHelper->to(['user/view', 'id' => $model->id]));
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->setScenario('adminPass');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->password != '') {
                $model->setPassword($model->password);
                $model->save();
            }
            return $this->redirect(Yii::$app->urlHelper->to(['user/view', 'id' => $id]));
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->urlHelper->to(['user/index']));
    }

    /**
     * Delete group of User model
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return \yii\web\Response
     */
    public function actionDel()
    {
        if(isset(Yii::$app->request->post()['id'])) {
            User::deleteAll(['in', 'id', Yii::$app->request->post()['id']]);
        }
        return $this->redirect(Yii::$app->urlHelper->to(['user/index']));
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPermissions($id)
    {
        $modelForm = new AssignmentForm();
        $modelForm->model = $this->findModel($id);

        if ($modelForm->load(Yii::$app->request->post()) && $modelForm->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'SUCCESS_UPDATE_PERMISSIONS'));
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('permissions', [
            'modelForm' => $modelForm
        ]);
    }
}
