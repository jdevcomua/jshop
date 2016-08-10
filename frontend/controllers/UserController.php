<?php

namespace frontend\controllers;

use common\models\User;
use common\models\WishList;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use VK\VK;
use Yii;
use common\models\LoginForm;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class UserController extends Controller
{

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
        $vk = new VK(Yii::$app->params['vkAppId'], Yii::$app->params['vkSecretKey']);
        if (empty(Yii::$app->request->get('code'))) {
            return $this->redirect($vk->getAuthorizeUrl('email,friends,wall', 'http://frontend.dev/user/vk-auth'));
        }
        $token = $vk->getAccessToken(Yii::$app->request->get('code'), 'http://frontend.dev/user/vk-auth');
        $user = User::find()->andFilterWhere(['vk_id' => $token['user_id']])->one();
        if (empty($user)) {
            $user = new User();
            $user->vk_id = $token['user_id'];
            $user->mail = $token['email'];
            $user_info = $vk->api('users.get', array(
                'user_ids' => $token['user_id']
            ));
            $user->name = $user_info['response'][0]['first_name'];
            $user->surname = $user_info['response'][0]['last_name'];
            $user->save();
        }
        Yii::$app->user->login($user, $token['expires_in']);
        return $this->goBack();
    }

    public function actionFacebookAuth()
    {
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        }
        $fb = new Facebook([
            'app_id' => Yii::$app->params['fbAppId'],
            'app_secret' => Yii::$app->params['fbSecretKey'],
            'default_graph_version' => 'v2.5',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
            $userNode = $fb->get('/me', $accessToken)->getGraphUser();
        } catch(FacebookResponseException $e) {
            return $this->redirect($helper->getLoginUrl('http://frontend.dev/user/facebook-auth', ['user_friends,public_profile,email']));
        } catch(FacebookSDKException $e) {
            return $this->redirect($helper->getLoginUrl('http://frontend.dev/user/facebook-auth', ['user_friends,public_profile,email']));
        }
        $user = User::find()->andFilterWhere(['fb_id' => $userNode['id']])->one();
        if (empty($user)) {
            $user = new User();
            $user->fb_id = $userNode['id'];
            $user->name = explode(' ', $userNode['name'])[0];
            $user->surname = explode(' ', $userNode['name'])[2];
            $user->save();
        }
        Yii::$app->user->login($user, 3600*24);
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
            'model' => $model, 'passwordResetForm' => new PasswordResetRequestForm()
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

    /**
     * Requests password reset.
     * 
     * @return string
     */
    public function actionForgotPassword()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('forgotPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}