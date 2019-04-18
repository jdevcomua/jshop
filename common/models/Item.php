<?php

namespace common\models;

use common\models\query\ItemQuery;
use Yii;
use common\components\CartAdd;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\web\UploadedFile;
use Aws\S3;
use Aws\Sdk;
use dosamigos\transliterator\TransliteratorHelper;
use Eventviva\ImageResize;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property double $cost
 * @property integer $count_of_views
 * @property string $addition_date
 * @property string $description
 * @property integer $active
 * @property integer $top
 * @property float $self_cost
 * @property float $best_seller
 * @property float $special
 * @property float $deal_week
 * @property string $link
 *
 * @property CharacteristicItem[] $characteristicItems
 * @property ItemCat $category
 * @property OrderItem[] $orderItems
 * @property StockItem[] $stockItems
 * @property KitItem[] $kitItems
 * @property Vote[] $votes
 * @property Kit[] $kits
 * @property Image[] $images
 * @property Stock[] $stocks
 */
class Item extends Model implements CartAdd
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public $count;

    const CART_TYPE = 1;
    const MY_SERVER = 'my_server';
    const AMAZON = 'amazon';
    const IMAGE_SMALL = 'small_';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'count_of_views', 'top', 'active', 'best_seller', 'special', 'deal_week'], 'integer'],
            [['title', 'cost', 'category_id'], 'required'],
            ['title', 'trim'],
            [['addition_date'], 'safe'],
            [['cost', 'self_cost'], 'number'],
            ['count_of_views', 'default', 'value' => 0],
            [['title', 'description', 'link'], 'string'],
            //[['imageFiles'], 'file', 'extensions' => 'png, jpg'],
        ];
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
            'description' => Yii::t('app', 'Описание'),
            'imageFiles' => Yii::t('app', 'Изображения'),
            'active' => Yii::t('app', 'Активно'),
            'top' => Yii::t('app', 'Топ'),
            'self_cost' => Yii::t('app', 'Себестоимость'),
            'link' => Yii::t('app', 'Ссылка'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    public function extraFields()
    {
        return ['category'];
    }

    /**
     * @return array
     */
    public function getTranslateColumns()
    {
        return ['title'];
    }

    public function getTranslit()
    {
        return str_replace(['/', ' '], '_', TransliteratorHelper::process($this->title, '', 'en'));
    }

    public function hasKit()
    {
        return !empty($this->kits);
    }

    public function getKits()
    {
        return $this->hasMany(Kit::className(), ['id' => 'kit_id'])->viaTable('kit_item', ['item_id' => 'id'])
            ->joinWith('kitItems')->where(['is_main_item' => true, 'item_id' => $this->id]);
    }

    /**
     * @return string
     */
    public function getCategoryTitle()
    {
        return $this->category->title;
    }

    /**
     * @return string path of dir with images
     */
    public static function getPath()
    {
        return Yii::getAlias('@www') . '/web/img/';
    }

    /**
     * @param string $size of image
     * @return array
     */
    public function getImageUrl($size = '')
    {
        $urls = [];
        foreach ($this->images as $image) {
            $urls[] = $image->getImageUrl($size);
        }
        
        return $urls;
    }

    /**
     * @return string|null
     */
    public function getOneImageUrl()
    {
        if (count($this->images) > 0) {
            $keys = array_keys($this->images);
            $firstKey = array_shift($keys);

            return $this->images[$firstKey]->getImageUrl();
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function upload()
    {
        if (Yii::$app->params['imageStorage'] == self::AMAZON) {
            $this->uploadToAmazon();
        } elseif (Yii::$app->params['imageStorage'] == self::MY_SERVER) {
            $files = UploadedFile::getInstances($this, 'imageFiles');
            foreach ($files as $file) {
                $fileName = $this->id . mt_rand() . '.' . $file->extension;
                $file->saveAs(Item::getPath() . $fileName);
                $image = new Image();
                $image->name = $fileName;
                $image->storage = self::MY_SERVER;
                $image->item_id = $this->id;

                $smallImage = new ImageResize(Item::getPath() . $fileName);
                $smallImage->quality_jpg = 100;
                $smallImage->quality_png= 100;
                $smallImage->resizeToBestFit(200, 160);
                $smallImage->save(Item::getPath() . self::IMAGE_SMALL . $fileName);

                $image->small = self::IMAGE_SMALL . $fileName;
                $image->save();
            }
        }
    }

    public function beforeSave($insert)
    {
        if($this->getAttributes()['special'] = (int) true) Item::updateAll(['special' => (int) false]);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function uploadToAmazon()
    {
        $client = $this->createAmazonClient();
        $files = UploadedFile::getInstances($this, 'imageFiles');
        foreach ($files as $file) {
            $fileName = $this->id . mt_rand() . '.' . $file->extension;
            $client->putObject([
                'Bucket' => Yii::$app->params['amazonBucket'],
                'Key' => $fileName,
                'Body' => fopen($file->tempName, 'r'),
                'ACL' => 'public-read',
            ]);
            $image = new Image();
            $image->name = $fileName;
            $image->storage = self::AMAZON;
            $image->item_id = $this->id;

            $smallImage = new ImageResize($image->getImageUrl());
            $smallImage->quality_jpg = 100;
            $smallImage->quality_png= 100;
            $smallImage->resizeToBestFit(200, 160);
            $client->putObject([
                'Bucket' => Yii::$app->params['amazonBucket'],
                'Key' => self::IMAGE_SMALL . $fileName,
                'Body' => $smallImage,
                'ACL' => 'public-read',
            ]);
            //$smallImage->save(Item::getPath() . self::SMALL_IMAGE . $fileName);

            $image->small = self::IMAGE_SMALL . $fileName;
            $image->save();
        }
    }

    /**
     * @return S3\S3Client
     */
    public function createAmazonClient()
    {
        $sharedConfig = [
            'region' => 'eu-central-1',
            'credentials' => [
                'key' => Yii::$app->params['amazonKey'],
                'secret' => Yii::$app->params['amazonSecret']
            ],
            'version' => 'latest'
        ];
        $sdk = new Sdk($sharedConfig);
        return $sdk->createS3();
    }

    /**
     * @param array $images
     */
    public function deleteImages($images = [])
    {
        if (empty($images)) {
            $images = $this->images;
        }
        foreach ($images as $image) {
            if ($image->storage == self::AMAZON) {
                $client = $this->createAmazonClient();
                $client->deleteObject([
                    'Bucket' => Yii::$app->params['amazonBucket'],
                    'Key' => $image->name
                ]);
            } elseif ($image->storage == self::MY_SERVER) {
                if (file_exists(Item::getPath() . $image->name)) {
                    unlink(Item::getPath() . $image->name);
                }
            }
            $image->delete();
        }
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
        return (count($this->stocks) > 0);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['id' => 'stock_id'])->viaTable('stock_item', ['item_id' => 'id'])
            ->andFilterWhere(['<', 'date_from', date('Y-m-d H:i:s')])
            ->andFilterWhere(['>', 'date_to', date('Y-m-d H:i:s')]);
    }

    /**
     * @return Stock|int|mixed
     */
    public function getMaxDiscount()
    {
        if ($this->existDiscount()) {
            $stocks = $this->getStocks()->all();
            $max = $stocks[0];
            /* @var $max Stock */
            foreach ($stocks as $stock) {
                /* @var $stock Stock */
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
                return (int) ($this->cost * (1 - ($stock->value / 100)));
            } else {
                return (int) ($this->cost - $stock->value);
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
     * @return ActiveDataProvider
     */
    public function getCheckedVotes()
    {
        $all_votes = Vote::find()->where(['item_id' => $this->id])->joinWith('user')->andFilterWhere(['>', 'rating', 0])->andWhere(['vote.checked' => 1]);
        $votes = new ActiveDataProvider([
            'query' => $all_votes,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $votes;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKitItems()
    {
        return $this->hasMany(KitItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['item_id' => 'id']);
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

    /**
     * @inheritdoc
     * @return ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemQuery(get_called_class());
    }

    public function getUrl()
    {
        return Yii::$app->urlHelper->to(['item/' . $this->id . '-' . $this->getTranslit()]);
    }
}
