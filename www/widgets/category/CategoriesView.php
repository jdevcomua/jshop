<?php

namespace www\widgets\category;

use Yii;
use yii\base\Widget;
use common\models\ItemCat;

class CategoriesView extends Widget
{
    private $categories;

    public $view = 'menu';

    public function init()
    {
        parent::init();
        $this->categories = ItemCat::find()->andWhere(['depth' => 0, 'active' => true])->all();
    }

    public function run()
    {
        if (Yii::$app->controller->route == 'site/category') {
            $idArray = explode('-', Yii::$app->request->get('id', ''));
            $inCategory = array_shift($idArray);
            if ($inCategory != '') {
                /**@var ItemCat $category*/
                $category = ItemCat::findOne($inCategory);
                if ($category->depth > 0) {
                    $parent = ItemCat::findOne(['tree' => $category->tree, 'depth' => 0]);
                    if ($parent) {
                        $inCategory = $parent->id;
                    }
                }
            }
        } else {
            $inCategory = null;
        }
        return $this->render($this->view, ['allCategories' => $this->categories, 'inCategory' => $inCategory]);
    }
}