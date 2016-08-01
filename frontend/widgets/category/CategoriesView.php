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
        $this->categories = ItemCat::find()->andFilterWhere(['level' => 1])->all();
    }

    public function run()
    {
        return $this->render('menu', ['allCategories' => $this->categories]);
    }
}