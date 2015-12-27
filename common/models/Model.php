<?php
/**
 * Created by PhpStorm.
 * User: umo4ka
 * Date: 19.12.15
 * Time: 17:12
 */

namespace common\models;

use Yii;

abstract class Model extends \yii\db\ActiveRecord
{

    public abstract function getTranslateColumns();

    public function __get($name)
    {
        if (in_array($name, $this->getTranslateColumns())) {
            $json = parent::__get($name);
            if (is_array(json_decode($json,true))) {
                $array = json_decode($json, true);
                $language = Yii::$app->language;
                if (isset($array[$language])) {
                    return $array[$language];
                } else {
                    return array_shift($array);
                }
            } else {
                return $json;
            }
        } else {
            return parent::__get($name);
        }
    }

    public function __set($title, $value)
    {
        if (in_array($title, $this->getTranslateColumns())) {
            $json = parent::__get($title);
            $array = (array)json_decode($json, true);
            $language = Yii::$app->language;
            $array[$language] = $value;
            $json = json_encode($array, JSON_UNESCAPED_UNICODE);
            //$json = json_encode($array);
            parent::__set($title, $json);
        } else {
            parent::__set($title, $value);
        }
    }

}
