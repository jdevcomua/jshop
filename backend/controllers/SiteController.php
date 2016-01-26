<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use Aws\S3;
use Aws\Sdk;

class SiteController extends Controller
{

    const AMAZON_KEY = 'AKIAIR2NVD2HK4P7BW4Q';
    const AMAZON_SECRET = '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';
    const AMAZON_BUCKET = 'umo4ka';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Changing the language
     * @param string $lang new language
     * @return \yii\web\Response
     */
    public function actionLanguage($lang)
    {
        Yii::$app->language = $lang;
        return $this->redirect(Yii::$app->urlHelper->to(['/']));
    }

    public function actionIndex()
    {
        return $this->render('index');
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
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->render('index');
    }

}
