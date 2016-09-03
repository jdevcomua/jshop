<?php

namespace backend\controllers;

use common\models\Item;
use common\models\Orders;
use common\models\User;
use common\models\Vote;
use Yii;
use common\models\LoginForm;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{

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
        $sales = Orders::find()->select('DAY(orders.timestamp) AS day, COUNT(orders.timestamp) AS count')
            ->innerJoin('order_item', 'order_item.order_id = orders.id')
            ->where('MONTH(orders.timestamp) = MONTH(NOW())')
            ->andWhere(['orders.payment_status' => 'Оплачен'])
            ->groupBy('DATE(orders.timestamp)')
            ->asArray(true)
            ->all();
        $salesArray = ArrayHelper::map($sales, 'day', 'count');
        $salesDays = array_keys($salesArray);
        $salesValues = array_values($salesArray);
        $newOrdersCount = Orders::find()->where(['order_status' => 'Новый'])->count();
        $salesCount = Orders::find()
            ->where(['payment_status' => 'Оплачен'])
            ->andWhere('MONTH(orders.timestamp) = MONTH(NOW())')
            ->count();
        $newVotesCount = Vote::find()->where(['checked' => Vote::STATUS_NOT_CHECKED])->count();
        $sales = Orders::find()->select('DAY(timestamp) AS day, SUM(sum) AS sum')
            ->where('MONTH(timestamp) = MONTH(NOW())')
            ->andWhere(['payment_status' => 'Оплачен'])
            ->groupBy('DATE(timestamp)')
            ->asArray(true)
            ->all();
        $salesArray = ArrayHelper::map($sales, 'day', 'sum');
        $salesValuesMoney = array_values($salesArray);

        $usersCount = User::find()->andWhere('MONTH(created) = MONTH(NOW())')->count();
        $latest = Item::find()->select(['item.*', 'count(order_item.id) as count'])
            ->leftJoin('order_item', 'order_item.item_id = item.id')
            ->groupBy('order_item.item_id')
            ->orderBy('addition_date desc')->limit(5)->all();
        return $this->render('index', [
            'salesDays' => $salesDays,
            'salesValues' => $salesValues,
            'newOrdersCount' => $newOrdersCount,
            'salesCount' => $salesCount,
            'newVotesCount' => $newVotesCount,
            'salesValuesMoney' => $salesValuesMoney,
            'latestItems' => $latest,
            'usersCount' => $usersCount,
        ]);
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
