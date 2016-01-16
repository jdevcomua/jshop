<?php

namespace common\models;

use Yii;
use common\components\CartAdd;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property double $cost
 * @property string $image
 * @property integer $count_of_views
 *
 * @property CharacteristicItem[] $characteristicItems
 * @property ItemCat $category
 * @property OrderItem[] $orderItems
 * @property StockItem[] $stockItems
 * @property KitItem[] $kitItems
 * @property Vote[] $votes
 * @property Kit[] $kits
 */
class Item extends Model implements CartAdd
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    const CART_TYPE = 1;

    /**
     * @return array
     */
    public function getTranslateColumns()
    {
        return ['title'];
    }

    public function hasKit()
    {
        return !empty($this->kitItems);
    }

    public function getKits()
    {
        return $this->hasMany(Kit::className(), ['id' => 'kit_id'])->viaTable('kit_item', ['item_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getCategoryTitle()
    {
        return $this->category->title;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @return string of dir with images
     */
    public static function getPath()
    {
        return Yii::getAlias('@frontend') . '/web/img/';
    }

    /**
     * @return string image url
     */
    public function getImageUrl()
    {
        return 'http://frontend.dev/img/' . $this->image;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'count_of_views'], 'integer'],
            [['title', 'cost'], 'required'],
            [['cost'], 'number'],
            ['count_of_views', 'default', 'value' => 0],
            [['title'], 'string'],
            [['image'], 'string'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function upload()
    {
        if (isset($this->imageFile)) {
            $this->setAttribute('image', $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Категория'),
            'title' => Yii::t('app', 'Название'),
            'cost' => Yii::t('app', 'Стоимость'),
            'image' => Yii::t('app', 'Изображение'),
            'categoryTitle' => Yii::t('app', 'Категория'),
            'count_of_views' => Yii::t('app', 'Количество просмотров'),
            'newPrice' => Yii::t('app', 'Новая цена'),
        ];
    }

    /**
     * @return array
     */
    public function getAvgRating()
    {
        $average = Vote::find()->select(['avg(rating)', 'count(rating)'])
            ->andFilterWhere(['item_id' => $this->id])
            ->andFilterWhere(['checked' => 1])
            ->andFilterWhere(['>', 'rating', 0])
            ->asArray(true)->all();
        $average = $average[0];
        if ($average["count(rating)"] != 0) {
            return ['avg' => $average["avg(rating)"], 'count' => $average["count(rating)"]];
        } else {
            return ['avg' => 0, 'count' => 0];
        }
    }

    /**
     * @return bool
     */
    public function inWishList()
    {
        if (!Yii::$app->user->isGuest) {
            $wish = Wish::find()->andFilterWhere(['item_id' => $this->id]);
            $wish->joinWith(['list' => function ($q) {
                $q->where('wish_list.user_id = ' . Yii::$app->user->getId() . '');
            }]);
            return !(empty($wish->all()));
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicItems()
    {
        return $this->hasMany(CharacteristicItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ItemCat::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockItems()
    {
        return $this->hasMany(StockItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return bool
     */
    public function existDiscount()
    {
        return !(empty($this->getStockItems()->all()));
    }

    /**
     * @return Stock|int|mixed
     */
    public function getMaxDiscount()
    {
        if ($this->existDiscount()) {
            $stocks = $this->getStockItems()->all();
            $max = $stocks[0]->stock;
            /* @var $max Stock*/
            foreach ($stocks as $stockItem) {
                /* @var $stockItem StockItem*/
                $stock = $stockItem->stock;
                $disc1 = ($max->type == 1) ? ($this->cost * $max->value / 100) : $max->value;
                $disc2 = ($stock->type == 1) ? ($this->cost * $stock->value / 100) : $stock->value;
                if ($disc2 > $disc1) {
                    $max = $stock;
                }
            }
            return $max;
        } else {
            return 0;
        }
    }

    /**
     * @return float
     */
    public function getNewPrice()
    {
        if ($this->existDiscount()) {
            $stock = $this->getMaxDiscount();
            if ($stock->type == 1) {
                return $this->cost * (1 - ($stock->value / 100));
            } else {
                return $this->cost - $stock->value;
            }
        } else {
            return $this->cost;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::className(), ['item_id' => 'id'])->joinWith('user');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKitItems()
    {
        return $this->hasMany(KitItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return self::CART_TYPE;
    }

}
