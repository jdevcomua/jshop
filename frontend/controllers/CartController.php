<?php

namespace frontend\controllers;

use common\models\Item;
use common\models\Kit;
use common\models\Orders;
use common\models\OrderItem;
use Yii;
use common\models\User;
use common\components\CartAdd;

class CartController extends Controller
{

    /**
     * Adding item to cart
     * @param $item_id
     * @param $count
     */
    public function actionAjax($item_id, $count)
    {
        Yii::$app->cart->addItem(Item::findOne($item_id), $count);
    }

    public function actionAjaxkit($item_id, $count)
    {
        Yii::$app->cart->addItem(Kit::findOne($item_id), $count);
    }

    public function actionOrder()
    {
        $id = Yii::$app->request->get('id');
        if (!empty($id)) {
            $order = Orders::findOne($id);
            $orderItems = OrderItem::find()->andFilterWhere(['order_id' => $id])->joinWith('item')->all();
            return $this->render('view-order', ['orderItems' => $orderItems, 'order' => $order]);
        }
        $model = new Orders();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;
            $model->sum = Yii::$app->cart->getSum();
            if ($model->save()) {
                Yii::$app->cart->saveOrder($model->id);
                Yii::$app->cart->resetItems();
                Yii::$app->mailer
                    ->compose('order', [
                        'user' => Yii::$app->user->identity,
                        'order' => Orders::findOne($model->id)
                    ])
                    ->setFrom('litvinova.a95@gmail.com')
                    ->setTo($model->mail)
                    ->setSubject('subject')
                    ->send();
                return $this->redirect(Yii::$app->urlHelper->to(['cart/order', 'id' => $model->id]));
            }
        }
        $sum = Yii::$app->cart->getSum();
        $user = User::findOne(Yii::$app->user->id);
        return $this->render('order', ['models' => Yii::$app->cart->getModels(),
            'sum' => $sum, 'model' => $model, 'user' => $user]);
    }

    /**
     * Open page of cart
     * @return string
     */
    public function actionIndex()
    {
        $sum = Yii::$app->cart->getSum();
        return $this->render('cart', ['models' => Yii::$app->cart->getModels(),
            'sum' => $sum]);
    }

    /**
     * Delete item from cart using ajax
     * @param $item_id
     * @param $cart_type
     * @param int $count
     * @return string
     */
    public function actionDelete($item_id, $cart_type, $count = 0)
    {
        Yii::$app->cart->deleteItem($item_id, $cart_type, $count);
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

    /**
     * @param $id integer
     * @param $count integer
     * @return string
     */
    public function actionChange($id, $count)
    {
        Yii::$app->cart->setItem($id, Item::CART_TYPE, $count);
        return '({"sumAll":' . Yii::$app->cart->getSum() . ', "sumItem":' .  Yii::$app->cart->getSumForItem($id, Item::CART_TYPE)
            . ', "countItem":' .  Yii::$app->cart->getCountForItem($id, Item::CART_TYPE) . ', "countAll":' .
            Yii::$app->cart->getCount() . '})';
    }

}