<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CharacteristicsForm extends Model
{
    public $inputs;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'inputs' => 'Characteristics',
        ];
    }

}
