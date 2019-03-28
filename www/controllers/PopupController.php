<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 14.08.16
 * Time: 14:52
 */

namespace www\controllers;

use common\models\Item;
use common\models\ItemCat;
use common\models\User;
use Yii;
use yii\web\Response;

class PopupController extends Controller
{

    public function actionAddToWish()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $user = Yii::$app->user;
        if ($user->isGuest) {
            return ['html' => $this->renderPartial('needLogin'), 'title' => 'Необходимо авторизироваться'];
        } else {
            $wishLists = User::findOne($user->getId())->wishLists;
            return ['html' => $this->renderPartial('addToWish', ['wishLists' => $wishLists]),
                'title' => 'Выбор cписка желаний'];
        }
    }

}