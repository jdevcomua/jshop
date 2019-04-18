<?php

namespace www\controllers;

use common\models\Vote;
use Yii;
use common\models\Item;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ItemController extends Controller
{

    /**
     * View page of item
     * @param $id - id of item
     * @return string
     */
    public function actionItem($id)
    {
        if (Yii::$app->request->isPost) {
            if(Yii::$app->request->post('modalId')) Yii::$app->session->set('lastQuickView',Yii::$app->request->post('modalId'));
        }

        $id = explode('-', $id)[0];
        $item = $this->findModel($id);
        $related = Item::find()->where(['category_id' => $item->category_id, 'active' => 1])->andFilterWhere(['!=', 'id', $item->id])->all();
        $message = null;
        $vote = new Vote();

        if ($vote->load(Yii::$app->request->post())) {
            $vote->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;
            $vote->item_id = $id;
            $vote->save();
            $message = 'Ваш отзыв отправлен и будет доступен после проверки модератора.';
        }

        /* @var $item Item */
        $item->count_of_views++;
        $item->save();

        return $this->render('item', [
            'vote' => $vote,
            'item' => $item,
            'related' => $related,
            'message' => $message,
        ]);
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
        if (($model = Item::findOne(['id' => $id, 'active' => true])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена.');
        }
    }

    public function actionQuickView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);
        if ($model) {
            return ['html' => $this->renderPartial('quickview', [
                'model' => $model,
            ])];
        } else {
            return false;
        }
    }

}