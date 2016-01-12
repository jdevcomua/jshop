<?php

namespace frontend\controllers;

use common\models\Vote;
use Yii;
use common\models\Item;
use common\models\ItemCat;

class ItemController extends Controller
{

    /**
     * Viwe page of item
     * @param $id  - id of item
     * @return string
     */
    public function actionItem($id)
    {
        $item = Item::findOne(Yii::$app->request->get('id'));
        $vote = new Vote();
        if ($vote->load(Yii::$app->request->post())) {
            $vote->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;
            $vote->item_id = $id;
            $vote->save();
            return $this->render('item', ['item'=>$item,
                'message' => 'Ваш отзыв отправлен и будет доступен после проверки модератора.']);
        }
        return $this->render('item', ['item'=>$item]);
    }

}