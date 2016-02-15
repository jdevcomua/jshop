<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 19.01.16
 * Time: 0:06
 */

namespace rest\controllers;

use common\models\User;
use yii\rest\ActiveController;
use Yii;
use common\models\Item;
use common\models\Orders;

class RestController extends ActiveController
{

    public function init()
    {
        $token = Yii::$app->request->get('access-token');
        if (isset($token)) {
            Yii::$app->session->setId($token);
        }
    }

    /*public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['login'],
            'authMethods' => [
                QueryParamAuth::className(),
            ],

        ];
        return $behaviors;
    }*/

    public $modelClass = 'common\models\Item';

    public function actionAddToCart()
    {
        $token = Yii::$app->request->get('access-token');
        if (isset($token)) {
            $item_id = Yii::$app->request->post('item_id');
            $count = Yii::$app->request->post('count');
            if (isset($item_id) && isset($count)) {
                Yii::$app->cart->addItem(Item::findOne($item_id), $count);
            }
            return Yii::$app->cart->getModels();
        } else {
            return ['error'];
        }
    }

    public function actionCart()
    {
        $token = Yii::$app->request->get('access-token');
        if (isset($token)) {
            Yii::$app->session->setId($token);
            return Yii::$app->cart->getModels();
        }
    }

    public function actionOrder()
    {
        if (!empty(Yii::$app->request->post('id'))) {
            return Orders::findOne(Yii::$app->request->post('id'))->getOrderItems()->all();
        }
        $token = Yii::$app->request->get('access-token');
        if (isset($token)) {
            if (!empty(Yii::$app->cart->getArray())) {
                $model = new Orders();
                $model->user_id = Yii::$app->user->getId();
                $model->mail = Yii::$app->request->post('mail');
                $model->name = Yii::$app->request->post('name');
                $model->phone = Yii::$app->request->post('phone');
                if ($model->validate()) {
                    $model->sum = Yii::$app->cart->getSum();
                    if ($model->save()) {
                        Yii::$app->cart->saveOrder($model->id);
                        Yii::$app->cart->resetItems();
                        return $model;
                    }
                } else {
                    return $model;
                }
            }
        } else {
            return ['error'];
        }
    }

    public function actionGetId()
    {
        $id = str_replace('.', '', microtime(true));
        return $id;
    }

    public function actionLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        if (isset($username) && isset($password)) {
            $user = User::find()->andFilterWhere(['username' => $username, 'password' => $password])->one();
            if (!empty($user)) {
                $token = $this->actionGetId();
                $user->access_token = $token;
                if ($user->save()) {
                    return $token;
                } else {
                    return $user;
                }
            } else {
                return ['error'];
            }
        } else {
            return ['error'];
        }
    }

}