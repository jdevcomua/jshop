<?php

namespace backend\controllers;

use common\models\Image;
use common\models\ItemCat;
use common\models\search\ItemSearch;
use yii\base\Model;
use Yii;
use common\models\Item;
use common\models\Characteristic;
use common\models\CharacteristicItem;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use common\models\search\CharacteristicItemSearch;
use yii\helpers\ArrayHelper;

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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(new Pagination(['pageSize' => PAGE_SIZE]));
        $categories = Item::find()
            ->select(['i.title'])
            ->join('JOIN', 'item_cat i', 'item.category_id = i.id')
            ->distinct(true)
            ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filterByCategories' => ArrayHelper::map($categories, 'title', 'title'),
        ]);
    }

    /**
     * Delete group of Item model
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return \yii\web\Response
     */
    public function actionDel()
    {
        foreach (Yii::$app->request->post()['id'] as $id) {
            $model = $this->findModel($id);
            $model->deleteImages();
            $model->delete();
        }
        return $this->redirect(['index']);
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

    public function actionDeleteImage($id)
    {
        Image::findOne($id)->delete();
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();
        $categories = ItemCat::find()->andFilterWhere(['level' => 1])->all();
        $categoriesArray = [];
        foreach ($categories as $category) {
            /* @var $category ItemCat*/
            if (!empty($category->getChildren()->all())) {
                $categoriesArray2 = [];
                foreach ($category->getChildren()->all() as $child) {
                    /* @var $child ItemCat*/
                    if (!empty($child->getChildren()->all())) {
                        $categoriesArray2['> ' . $child->title] = ArrayHelper::map($child->getChildren()->all(), 'id', 'title');
                    } else {
                        $categoriesArray2[$child->id] = $child->title;
                    }
                }
                $categoriesArray[$category->title] = $categoriesArray2;
            } else {
                $categoriesArray[$category->id] = $category->title;
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->upload();
                if (ItemCat::findOne($this->findModel($model->id)->category_id)->getCharacteristics()->count() > 0) {
                    return $this->redirect(Yii::$app->urlHelper->to(['item/characteristics', 'id' => $model->id]));
                } else {
                    return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $model->id]));
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $categoriesArray
        ]);
    }

    /**
     * Updates characteristics of Item.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id of item
     * @return string|\yii\web\Response
     */
    public function actionUpdateCharacteristics($id)
    {
        $characteristics = $this->findModel($id)->getCharacteristicItems()->indexBy('id')->all();
        if (Model::loadMultiple($characteristics, Yii::$app->request->post()) && Model::validateMultiple($characteristics)) {
            foreach ($characteristics as $characteristic) {
                $characteristic->save(false);
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $id]));
        }

        return $this->render('characteristics', ['characteristics' => $characteristics]);
    }

    /**
     * Create group of Characteristic models
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id of item
     * @return string|\yii\web\Response
     */
    public function actionCharacteristics($id)
    {
        $chars = ItemCat::findOne($this->findModel($id)->category_id)->getCharacteristics()->all();
        $characteristics = [];
        foreach ($chars as $char) {
            $char_item = new CharacteristicItem();
            /* @var $char Characteristic*/
            $char_item->item_id = $id;
            $char_item->characteristic_id = $char->id;

            $characteristics[] = $char_item;
        }
        if (Model::loadMultiple($characteristics, Yii::$app->request->post()) && Model::validateMultiple($characteristics)) {
            foreach ($characteristics as $characteristic) {
                $characteristic->save();
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $id]));
        }
        return $this->render('characteristics', ['characteristics' => $characteristics]);
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
        $categories = ItemCat::find()->distinct(true)->all();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->upload();
                if (ItemCat::findOne($this->findModel($model->id)->category_id)->getCharacteristics()->count() > 0) {
                    return $this->redirect(Yii::$app->urlHelper->to(['item/update-characteristics', 'id' => $model->id]));
                } else {
                    return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $model->id]));
                }
            }
            return $this->redirect(Yii::$app->urlHelper->to(['item/view', 'id' => $id]));
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => ArrayHelper::map($categories, 'id', 'title'),
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
        $model->deleteImages();
        $model->delete();
        return $this->redirect(Yii::$app->urlHelper->to(['item/index']));
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
