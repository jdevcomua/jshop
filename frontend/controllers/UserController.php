<?php

namespace frontend\controllers;

use common\models\User;
use common\models\WishList;
use VK\VK;
use Yii;
use common\models\LoginForm;

class UserController extends Controller
{

    const VK_APP_ID = '5231107';
    const VK_SECRET_KEY = 'bzvW6ULy2hUZhf7Nn48C';

    /**
     * View page of user
     * @return string
     */
    public function actionProfile()
    {
        if (!empty(Yii::$app->request->post('WishList'))) {
            $wishList = new WishList();
            $wishList->load(Yii::$app->request->post());
            $wishList->user_id = Yii::$app->user->id;
            $wishList->save();
        }
        $model = User::findOne(Yii::$app->user->getId());
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
        }
        return $this->render('profile', ['model' => $model, 'model1' => $model,]);
    }

    public function actionVkAuth()
    {
        $vk = new VK(self::VK_APP_ID, self::VK_SECRET_KEY);
        if (empty(Yii::$app->request->get('code'))) {
            return $this->redirect($vk->getAuthorizeUrl('email', 'http://frontend.dev/user/vk-auth'));
        }
        $token = $vk->getAccessToken(Yii::$app->request->get('code'), 'http://frontend.dev/user/vk-auth');
        $user = User::find()->andFilterWhere(['vk_id' => $token['user_id']])->one();
        if (!empty($user)) {
            Yii::$app->user->login($user, 3600*24);
        } else {
            $user = new User();
            $user->vk_id = $token['user_id'];
            $user->mail = $token['email'];
            $user_info = $vk->api('users.get', array(
                'user_ids' => $token['user_id']
            ));
            $user->name = $user_info['response'][0]['first_name'];
            $user->surname = $user_info['response'][0]['last_name'];
            $user->save();
            Yii::$app->user->login($user, 3600*24);
        }
        return $this->goBack();
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->urlHelper->to(['/']));
    }

    /**
     * View page of registration
     * @return string
     */
    public function actionRegister()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(Yii::$app->urlHelper->to(['login']));
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionWishlist($id)
    {
        $model = WishList::findOne($id);
        if (empty($model)) {
            return $this->redirect(Yii::$app->urlHelper->to(['/']));
        }
        return $this->render('wishlist', [
            'list' => $model
        ]);
    }

}