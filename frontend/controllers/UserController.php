<?php

namespace frontend\controllers;

use common\models\User;
use common\models\WishList;
use Yii;
use common\models\LoginForm;

class UserController extends Controller
{

    /**
     * View page of user
     * @return string
     */
    public function actionProfile()
    {
        //var_dump(Yii::$app->request->post());die();
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