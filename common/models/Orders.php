<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $timestamp
 * @property string $address
 * @property string $name
 * @property string $phone
 * @property string $delivery
 * @property string $mail
 * @property string $payment
 * @property double $sum
 * @property string $order_status
 * @property string $payment_status
 *
 * @property OrderItem[] $orderItems
 * @property User $user
 */
class Orders extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'mail', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['timestamp'], 'safe'],
            ['payment_status', 'default', 'value' => 'Не оплачен'],
            ['order_status', 'default', 'value' => 'Новый'],
            [['sum'], 'number'],
            [['mail'], 'email'],
            [['address', 'name', 'delivery', 'payment'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 15]
        ];
    }

    public function getCountItems(){
        return count($this->orderItems);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'timestamp' => 'Время создания',
            'address' => 'Адрес',
            'name' => Yii::t('app', 'Имя и фамилия'),
            'phone' => Yii::t('app', 'Телефон'),
            'delivery' => Yii::t('app', 'Способ доставки'),
            'mail' => 'E-mail',
            'payment' => Yii::t('app', 'Способ оплаты'),
            'sum' => 'Сумма',
            'order_status' => 'Статус заказа',
            'payment_status' => 'Статус оплаты',
            'countItems' => 'Товаров',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getTranslateColumns()
    {
        return [];
    }
}
