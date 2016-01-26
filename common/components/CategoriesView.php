<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 13.01.16
 * Time: 1:13
 */

namespace common\components;

use yii\base\Widget;
use common\models\ItemCat;

class CategoriesView extends Widget
{

    public $categories;

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