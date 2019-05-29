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
 * @property string comment
 *
 * @property OrderItem[] $orderItems
 * @property User $user
 */
class Orders extends Model
{

    const STATUS_NEW = 1;
    const STATUS_SENT = 2;
    const STATUS_SHIPPED = 3;
    const STATUS_CANCELED = 4;
    const STATUS_CONFIRMED = 5;
    
    const PAYMENT_STATUS_PAID = 1;
    const PAYMENT_STATUS_NOT_PAID = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'name', 'address'], 'required'],
            [['user_id'], 'integer'],
            [['timestamp'], 'safe'],
            ['payment_status', 'default', 'value' => Orders::PAYMENT_STATUS_NOT_PAID],
            ['order_status', 'default', 'value' => Orders::STATUS_NEW],
            [['sum'], 'number'],
            [['mail'], 'email'],
            [['address', 'name', 'delivery', 'payment', 'phone', 'comment'], 'string'],
        ];
    }

    public function getCountItems()
    {
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
            'comment' => 'Комментарий',
        ];
    }

    /**
     * @return array
     */
    public static function getStatusTitles()
    {
        return [
            static::STATUS_NEW => 'Новый',
            static::STATUS_CONFIRMED => 'Подтвержден',
            static::STATUS_SENT => 'Отправлен',
            static::STATUS_SHIPPED => 'Доставлен',
            static::STATUS_CANCELED => 'Отменен',
        ];
    }
    
    /**
     * @return array
     */
    public static function getPaymentStatusTitles()
    {
        return [
            static::PAYMENT_STATUS_NOT_PAID => 'Не оплачен',
            static::PAYMENT_STATUS_PAID => 'Оплачен',
        ];
    }

    /**
     * @return string|null
     */
    public function getStatusTitle()
    {
        $titles = static::getStatusTitles();
        
        return key_exists($this->order_status, $titles) ? $titles[$this->order_status] : null;
    }

    /**
     * @return string|null
     */
    public function getPaymentStatusTitle()
    {
        $titles = static::getPaymentStatusTitles();
        
        return key_exists($this->payment_status, $titles) ? $titles[$this->payment_status] : null;
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
