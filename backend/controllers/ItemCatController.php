<?php

namespace backend\controllers;

use common\models\Characteristic;
use Yii;
use yii\base\Model;
use common\models\ItemCat;
use common\models\search\ItemCatSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * ItemCatController implements the CRUD actions for ItemCat model.
 */
class ItemCatController extends Controller
{

    /**
     * Updates group of existing ItemCat model.
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
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/update', 'id' => array_shift(Yii::$app->request->post()['id'])]));
                } else {
                    $query = ItemCat::find();
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
        $categories = ItemCat::find()->indexBy('id')->all();
        if (Model::loadMultiple($categories, Yii::$app->request->post()) && Model::validateMultiple($categories)) {
            foreach ($categories as $category) {
                $category->save(false);
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item-cat/index']));
        }
        return $this->redirect(Yii::$app->urlHelper->to(['item-cat/index']));
    }

    /**
     * Lists all ItemCat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemCatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(new Pagination(['pageSize' => PAGE_SIZE]));
        $context = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];
        $deleted = Yii::$app->request->get('deleted');
        if (isset($deleted)) {
            $context['deleted'] = $deleted;
        }
        return $this->render('index', $context);
    }

    /**
     * Delete group of ItemCat model
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return \yii\web\Response
     */
    public function actionDel(){
        foreach (Yii::$app->request->post()['id'] as $id) {
            $this->findModel($id)->delete();
        }
        return $this->redirect(Yii::$app->urlHelper->to(['item-cat/index']));
    }

    /**
     * Displays a single ItemCat model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $characteristics = new ActiveDataProvider([
            'query' => ItemCat::findOne($id)->getCharacteristics()
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id), 'characteristics' => $characteristics
        ]);
    }

    /**
     * Creates a new ItemCat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemCat();
        if ($model->load(Yii::$app->request->post())) {
            $continue = false;
            if ($model->parent_id != 0) {
                $parent = ItemCat::findOne($model->parent_id);
                if ($parent) {
                    $continue = $model->appendTo($parent);
                }
            } else {
                unset($model->parent_id);
                $continue = $model->makeRoot();
            }
            if ($continue) {
                $model->upload();
                if (Yii::$app->request->post()['action'] == 'save') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/view', 'id' => $model->id]));
                } elseif (Yii::$app->request->post()['action'] == 'chars') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/characteristics', 'id' => $model->id]));
                }
            }
        }
        $categoriesArray = ArrayHelper::map(ItemCat::find()->all(), 'id', 'title');
        return $this->render('create', [
            'model' => $model, 'categories' => $categoriesArray
        ]);
    }

    /**
     * Updates an existing ItemCat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            $continue = false;
            if ($model->oldAttributes['parent_id']  != $model->parent_id) {
                $parent = ItemCat::findOne($model->parent_id);
                if ($parent) {
                    $continue = $model->appendTo($parent);
                }
            } else {
                $continue = $model->save();
            }
            if ($continue) {
                $model->upload();
                if ($request->post('action') == 'save') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/view', 'id' => $id]));
                } else if ($request->post('action') == 'chars') {
                    return $this->redirect(Yii::$app->urlHelper->to(['item-cat/characteristics', 'id' => $model->id]));
                }
            }
        }
        $categoriesArray = ArrayHelper::map(ItemCat::find()->all(), 'id', 'title');
        return $this->render('update', [
            'model' => $model, 'count' => 'one', 'categories' => $categoriesArray
        ]);
    }

    /**
     * Deletes an existing ItemCat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $category = $this->findModel($id);
        if ($category->getItems()->count() > 0) {
            $deleted = false;
        } else {
            $this->findModel($id)->delete();
            $deleted = true;
        }

        return $this->redirect(Yii::$app->urlHelper->to(['item-cat/index', 'deleted' => $deleted]));
    }

    /**
     * Finds the ItemCat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemCat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemCat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $id integer id of category
     * @return string|\yii\web\Response
     */
    public function actionCharacteristics($id)
    {
        $request = Yii::$app->request;
        $models = Characteristic::find()->where(['category_id' => $id])->indexBy('id')->all();

        if ($request->isPost) {
            $data = $request->post('Characteristic', []);
            $withId = [];
            //добавляем новые
            foreach ($data as $char) {
                if ($char['id'] == "") {
                    $newChar = new Characteristic(['category_id' => $id, 'title' => $char['title'], 'type' => $char['type']]);
                    $newChar->save();
                } else {
                    $withId[$char['id']] = ['title' => $char['title'], 'type' => $char['type']];
                }
            };
            //просматриваем старые
            $keys = array_keys($withId);
            /* @var $model Characteristic */
            foreach ($models as $model) {
                if (in_array($model->id, $keys)) {
                    $model->title = $withId[$model->id]['title'];
                    $model->type = $withId[$model->id]['type'];
                    $model->save();
                } else {
                    $model->delete();
                }
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item-cat/view', 'id' => $id]));
        }

        return $this->render('characteristics', [
            'models' => $models, 'category' => ItemCat::findOne($id)
        ]);
    }

}
