<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "letter".
 *
 * @property int $id
 * @property string $letter
 * @property string $email
 * @property string $phone
 * @property string $name
 * @property int $order_id
 */
class Letter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'letter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['letter'], 'string'],
            [['letter'], 'required'],
            [['order_id'], 'integer'],
            [['email'], 'email'],
            [['email', 'phone', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'letter' => Yii::t('app','Письмо'),
            'email' => Yii::t('app','E-mail'),
            'phone' => Yii::t('app','Телефон'),
            'name' => Yii::t('app','ФИО'),
            'order_id' => Yii::t('app','Номер заказа'),
        ];
    }
}
