<?php

namespace www\widgets\breadcrumb;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Breadcrumbs extends Widget
{
    public $class = 'breadcrumb';

    public function run()
    {
        $breadcrumbs = Yii::$app->controller->breadcrumbs;
        $html = '';
        if (!empty($breadcrumbs)) {
            $breadcrumbs = array_merge(['/' => '<i class="fa fa-home"></i>'], $breadcrumbs);
            foreach($breadcrumbs as $link => $text){
                $link = Html::a($text, $link);
                $html .= Html::tag('li', $link);
            }
            $html = Html::tag('ul', $html,['class' => $this->class]);
        }
        return $html;
    }
}