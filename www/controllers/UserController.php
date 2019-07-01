<?php

namespace www\controllers;

use common\models\Item;
use common\models\Orders;
use common\models\User;
use common\models\WishList;
use common\models\Wish;

use www\models\ChangePassword;
use www\models\PasswordResetRequestForm;
use www\models\ResetPasswordForm;
use VK\VK;
use Yii;
use common\models\LoginForm;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\helpers\Url;

class UserController extends Controller
{
    /**
     * View page of user
     * @return string
     */
    public function actionProfile()
    {
        $user = Yii::$app->user;
        if ($user->isGuest) {
            return $this->redirect(Yii::$app->urlHelper->to(['login']));
        }
        $model = User::findOne($user->id);
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
        }
        return $this->render('profile', ['model' => $model]);
    }

    public function actionDashboard()
    {
        $user = Yii::$app->user;
        if ($user->isGuest) {
            return $this->redirect(Yii::$app->urlHelper->to(['login']));
        }

        $model = User::findOne($user->id);

        $orderDataProvider = new ActiveDataProvider([
            'query' => Orders::find()->where(['user_id' => $model->id])->orderBy('timestamp DESC')->limit(5),
            'pagination' => false
        ]);

        return $this->render('dashboard', ['model' => $model, 'orderDataProvider' => $orderDataProvider]);
    }

    public function actionOrderlist()
    {
        $model = User::findOne(Yii::$app->user->id);

        $dataProvider = new ActiveDataProvider([
            'query' => Orders::find()->where(['user_id' => $model->id])->orderBy('timestamp DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('orderlist', ['dataProvider' => $dataProvider]);
    }

    public function actionChangePassword()
    {
        $changePasswordModel = new ChangePassword();
        if ($changePasswordModel->load(Yii::$app->request->post())) {
            if ($changePasswordModel->validate() && $changePasswordModel->changePassword()) {
                Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
                $changePasswordModel = new ChangePassword();
            }
        }
        return $this->render('change-password', ['changePasswordModel' => $changePasswordModel]);
    }

    public function actionVkAuth()
    {
        $vk = new VK(Yii::$app->params['vkAppId'], Yii::$app->params['vkSecretKey']);
        if (empty(Yii::$app->request->get('code'))) {
            return $this->redirect($vk->getAuthorizeUrl('email,friends,wall', 'http://shop.loc/user/vk-auth'));
        }
        $token = $vk->getAccessToken(Yii::$app->request->get('code'), 'http://shop.loc/user/vk-auth');
        $user = User::find()->andFilterWhere(['vk_id' => $token['user_id']])->one();
        if (empty($user)) {
            $user = new User();
            $user->vk_id = $token['user_id'];
            $user->email = $token['email'];
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
        if($_SESSION == null)
            Yii::$app->session->open();
        $fb = new Facebook([
            'app_id' => Yii::$app->params['fbAppId'],
            'app_secret' => Yii::$app->params['fbSecretKey'],
            'default_graph_version' => 'v2.10',
        ]);

        var_dump($_SESSION );
        $helper = $fb->getRedirectLoginHelper();
        var_dump($_SESSION );
        try {
            var_dump($_SESSION );
            $accessToken = $helper->getAccessToken('https://sdelivery.dn.ua/user/facebook-auth');
            var_dump($_SESSION );
        } catch(FacebookResponseException $e) {
            var_dump('1' . $e->getMessage() );
            var_dump($_SESSION );
            exit;
        } catch(FacebookSDKException $e) {
            var_dump('2' . $e->getMessage());
            var_dump($_SESSION);
            exit;
        }
        var_dump($_SESSION . PHP_EOL);
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        if (! $accessToken->isLongLived()) {
// Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }

            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me?fields=id,name,email,first_name,last_name,gender', $_SESSION['fb_access_token']);
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $userNode = $response->getGraphUser();

        if (isset($userNode)) {
            $user = User::find()->andFilterWhere(['fb_id' => $userNode['id']])->one();
            if (empty($user)) {
                $user = new User();
                $user->fb_id = $userNode['id'];
                $user->name = explode(' ', $userNode['name'])[0];
                $user->surname = explode(' ', $userNode['name'])[3];
                $user->email = $userNode['email'];
                $user->save();
            }
            Yii::$app->user->login($user, 3600 * 24);
        }
        return $this->goBack();
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $fb = new Facebook([
            'app_id' => Yii::$app->params['fbAppId'],
            'app_secret' => Yii::$app->params['fbSecretKey'],
            'default_graph_version' => 'v2.10',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl(Yii::$app->getRequest()->getHostInfo() . '/user/facebook-auth', $permissions);
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
            'loginUrl' => $loginUrl
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Yii::$app->urlHelper->to(['site/index']));
    }

    /**
     * View page of registration
     * @return string
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();
        $model->setScenario('vPass');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword($model->password);
            $model->generateAuthKey();
            if ($model->save()) {
                if (Yii::$app->getUser()->login($model)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionWishlist()
    {
        if (Yii::$app->user->isGuest)
            return $this->redirect('user/login');
        if (Yii::$app->request->isPost && is_array(Yii::$app->request->post('qty')))
        {
            foreach (Yii::$app->request->post('qty') as $item_id => $count) {
                $item = Item::findOne($item_id);
                Yii::$app->cart->addItem($item, $count);
            }
        }
        $model = WishList::findOne(['user_id' => Yii::$app->user->id]);
        if (empty($model)) {
            $model = new  WishList();
            $model->user_id = Yii::$app->user->id;
            $model->save();
         }
        $wishDataProvider = new ActiveDataProvider([
            'query' => Wish::find()->where(['list_id' => $model->id])->with('item'),
            'pagination' => false,
        ]);
        return $this->render('wishlist', [
            'wishDataProvider' => $wishDataProvider,
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
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                if ($model->sendEmail()) {
                    Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для получения дальнейших инструкций');
                    return $this->redirect('login');
                } else {
                    Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Проверьте правильность вводимых даных.');
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

            return $this->redirect('login');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionEditWishList($id = null)
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('Page not found.');
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $user = Yii::$app->user;
        if ($user->isGuest) {
            return [
                'html' => $this->renderPartial('needLogin'),
                'title' => 'Необходимо авторизироваться'
            ];
        }

        if ($id && ($model = WishList::findOne($id))) {
            $title = 'Редактировать список';
        } else {
            $model = new WishList();
            $title = 'Создать список';
        }

        if ($model->load(Yii::$app->request->post())) {
            return [
                'success' => $model->save()
            ];
        } else {
            return ['html' => $this->renderPartial('wishListForm', [
                    'model' => $model,
                ]),
                'title' => $title,
            ];
        }
    }

}