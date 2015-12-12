<?php
namespace frontend\controllers;

use common\models\Item;
use common\models\ItemCat;
use Yii;
use yii\web\Controller;

class SiteController extends Controller{

    function actionIndex(){
        $result1 = ItemCat::find()->all();
        if(isset($_GET['id'])){
            $item = Item::findOne($_GET['id']);
            return $this->render('Item', ['result1'=>$result1, 'item'=>$item]);
        }
        if(isset($_GET['category'])){
	        $id = $_GET['category'];
        } else {
            $id = 0;
        }
        $result2 = Item::find();
        if($id == "0"){
            $category = "all";
        } else if(is_int(+$id)){
            /**@var ItemCat $result3*/
            $result3 = ItemCat::findOne($id);
            $category = $result3->title;
            $result2->where('category_id=:category_id',[':category_id' => $id]);
        }
        if(isset($_GET['search'])){
            $result2->where('title like :title', [':title' => '%'.$_GET['search'].'%']);
        }
        if(isset($_GET['sort'])){
            if($_GET['sort'] == "asc"){
                $result2->orderBy("cost asc");
            } else if($_GET['sort'] == "desc"){
                $result2->orderBy("cost desc");
            }
        }
        $result2 = $result2->all();
		return $this->render('View', ['result1'=>$result1, 'result2'=>$result2, 'category_id'=>$id, 'category'=>$category, 'count'=>sizeof($result2)]);
	}

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
}