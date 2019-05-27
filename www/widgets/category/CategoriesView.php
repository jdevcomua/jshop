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
        return $this->render($this->view, ['allCategories' => $this->categories]);
    }
}