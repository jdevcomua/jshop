<?php

namespace frontend\widgets\category;

use yii\base\Widget;
use common\models\ItemCat;

class CategoriesView extends Widget
{
    private $categories;

    public function init()
    {
        parent::init();
        $this->categories = ItemCat::find()->andFilterWhere(['depth' => 0])->all();
    }

    public function run()
    {
        return $this->render('menu', ['allCategories' => $this->categories]);
    }
}