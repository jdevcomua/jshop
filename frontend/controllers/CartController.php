<?php

namespace frontend\controllers;

use common\models\Orders;
use common\models\OrderItem;
use Yii;
use common\models\ItemCat;
use common\models\User;

class CartController extends Controller
{

    /**
     * Adding item to cart
     * @param $item_id
     * @param $count
     */
    public function actionAjax($item_id, $count)
    {
        Yii::$app->cart->addItem($item_id, $count);
    }

    public function actionOrder()
    {
        if (!empty(Yii::$app->request->get('id'))) {
            $order = Orders::findOne(Yii::$app->request->get('id'));
            $orderItems = OrderItem::find()->andFilterWhere(['order_id' => Yii::$app->request->get('id')])->joinWith('item')->all();
            return $this->render('view-order', ['orderItems' => $orderItems, 'order' => $order]);
        }
        $model = new Orders();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;
            $model->sum = Yii::$app->cart->getSum();
            if ($model->save()) {
                Yii::$app->cart->saveOrder($model->id);
                Yii::$app->cart->resetItems();
                return $this->redirect(Yii::$app->urlHelper->to(['cart/order', 'id' => $model->id]));
            }
        }
        $itemsCount = Yii::$app->cart->getItems();
        $items = Yii::$app->cart->getItemsModels();
        $sum = Yii::$app->cart->getSum();
        $user = User::findOne(Yii::$app->user->id);
        return $this->render('order', ['itemsCount' => $itemsCount, 'items' => $items,
            'sum' => $sum, 'model' => $model, 'user' => $user]);
    }

    /**
     * Open page of cart
     * @return string
     */
    public function actionIndex()
    {
        $itemsCount = Yii::$app->cart->getItems();
        $items = Yii::$app->cart->getItemsModels();
        $sum = Yii::$app->cart->getSum();
        return $this->render('cart', ['itemsCount' => $itemsCount, 'items' => $items,
            'sum' => $sum]);
    }

    /**
     * Delete item from cart using ajax
     * @param $item_id
     * @param $count  - item to delete, if 0 - delete all
     * @return array
     */
    public function actionDelete($item_id, $count = 0)
    {
        Yii::$app->cart->deleteItem($item_id, $count);
        if ($count == 0) {
            return '({"sumAll":' . Yii::$app->cart->getSum() . ', "countAll":' . Yii::$app->cart->getCount() . '})';
        } else {
            return '({"sumAll":' . Yii::$app->cart->getSum() . ', "sumItem":' . Yii::$app->cart->getSumForItem($item_id)
                . ', "countItem":' . Yii::$app->cart->getCountForItem($item_id) . ', "countAll":' .
                Yii::$app->cart->getCount() . '})';
        }
    }

    /**
     * @param $item_id
     * @param $count
     * @return string
     */
    public function actionAdd($item_id, $count)
    {
        Yii::$app->cart->addItem($item_id, $count);
        return '({"sumAll":' . Yii::$app->cart->getSum() . ', "sumItem":' .  Yii::$app->cart->getSumForItem($item_id)
            . ', "countItem":' .  Yii::$app->cart->getCountForItem($item_id) . ', "countAll":' .
            Yii::$app->cart->getCount() . '})';
    }

}