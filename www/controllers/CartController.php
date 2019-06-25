<?php

namespace www\controllers;

use common\models\Item;
use common\models\Kit;
use common\models\Orders;
use common\models\OrderItem;
use Yii;
use common\models\User;
use common\components\CartAdd;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Response;

class CartController extends Controller
{

    /**
     * Adding item to cart
     * @param $item_id
     * @param $count
     * @return array
     */
    public function actionAjax($item_id, $count)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        /**@var Item $item*/
        $item = Item::findOne($item_id);
        Yii::$app->cart->addItem($item, $count);
        /*return [
            'count' => Yii::$app->cart->getCount(),
            'price' => Yii::$app->cart->getSum(),
        ];*/
        
        return ['html' => $this->renderPartial('cartSuccess', ['model' => $item,
            'count' => $count]), 'title' => 'Корзина'];
    }

    public function actionOldOrder($order_id)
    {
        $model = Orders::findOne($order_id);
        $itemsDataProvider = new ActiveDataProvider([
            'query' => OrderItem::find()->where(['order_id' => $model->id]),
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);
        if ($model->user_id == Yii::$app->user->id)
        return $this->render('old_order', [
            'model' => $model,
            'itemsDataProvider' => $itemsDataProvider
        ]);
        else return $this->redirect(Url::home());
    }

    public function actionReorder($order_id)
    {
        $model = Orders::findOne($order_id);
        foreach ($model->orderItems as $orderItem)
        {
            Yii::$app->cart->addItem($orderItem->item, $orderItem->count);
        }

        return $this->redirect(Url::toRoute('cart/index'));
    }

    public function actionAjaxkit($item_id, $count)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->cart->addItem(Kit::findOne($item_id), $count);
        return ['html' => $this->renderPartial('cartItems', ['models' => Yii::$app->cart->getModels(),
            'sum' => Yii::$app->cart->getSum()]), 'title' => 'Корзина'];
    }

    public function actionAjaxReset()
    {
        Yii::$app->cart->resetItems();
        return true;
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
        $user = User::findOne(Yii::$app->user->id);
        if ($user) {
            $model->email = $user->email;
            $model->phone = $user->phone;
            $model->name = $user->name . ' ' . $user->surname;
            $model->address = $user->address;
        }

        if ( $model->load(Yii::$app->request->post()) && Yii::$app->request->post('send') == true) {
            $model->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;
            $model->sum = Yii::$app->cart->getSum();
            if ($model->save()) {
                Yii::$app->cart->saveOrder($model->id);
                Yii::$app->cart->resetItems();
                if ($model->email) {
                    Yii::$app->mailer
                        ->compose('order', [
                            'user' => Yii::$app->user->identity,
                            'order' => Orders::findOne($model->id)
                        ])
                        ->setFrom(Yii::$app->params['adminEmail'])
                        ->setTo($model->email)
                        ->setSubject('subject')
                        ->setHtmlBody('<br>das</br>')
                        ->send();
                }
                Yii::$app->session->setFlash('success','Success checkout!');
                Yii::$app->mailer
                    ->compose('order', [
                        'order' => Orders::findOne($model->id)
                    ])
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setTo(Yii::$app->params['orderEmail'])
                    ->setSubject('subject')
                    ->send();
                return $this->redirect((Yii::$app->user->isGuest) ? Yii::$app->urlHelper->to(['cart/index']) : Yii::$app->urlHelper->to(['user/dashboard']));
            }
        }
        $sum = Yii::$app->cart->getSum();

        return $this->render('order', [
            'models' => Yii::$app->cart->getModels(),
            'sum' => $sum,
            'model' => $model,
            'user' => $user
        ]);
    }

    /**
     * Open page of cart
     * @return string
     */
    public function actionIndex()
    {
        $sum = Yii::$app->cart->getSum();
        return $this->render('cart', [
            'models' => Yii::$app->cart->getModels(),
            'sum' => $sum,
        ]);
    }

    /**
     * Delete item from cart using ajax
     * @param $item_id
     * @param $cart_type
     * @return array
     */
    public function actionDelete($item_id, $cart_type)
    {
        Yii::$app->cart->deleteItem($item_id, $cart_type);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['sumAll' => Yii::$app->cart->getSum(), 'countAll' => Yii::$app->cart->getCount()];
    }

    /**
     * @param $id integer
     * @param $cart_type integer
     * @param $count integer
     * @return array
     */
    public function actionChange($id, $cart_type, $count)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->cart->setItem($id, $cart_type, $count);
        $sumItem = Yii::$app->cart->getSumForItem($id, $cart_type);
        return ['sumAll' => Yii::$app->cart->getSum(),
                'sumItem' => $sumItem['newPrice'],
                'countItem' => Yii::$app->cart->getCountForItem($id, $cart_type),
                'countAll' =>  Yii::$app->cart->getCount(),
                'oldPriceItem' => $sumItem['oldPrice']
        ];
    }

}