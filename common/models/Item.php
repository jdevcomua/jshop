<?php

namespace common\models;

use common\models\query\ItemQuery;
use Yii;
use common\components\CartAdd;
use yii\data\ActiveDataProvider;
use SplFileInfo;
use yii\web\UploadedFile;
use Aws\S3;
use Aws\Sdk;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use dosamigos\transliterator\TransliteratorHelper;
use Eventviva\ImageResize;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property double $cost
 * @property double $metro_cost
 * @property integer $count_of_views
 * @property string $created_at
 * @property string $updated_at
 * @property string $description
 * @property string $barcode
 * @property string $code
 * @property float $quantity
 * @property integer $metric
 * @property integer $active
 * @property integer $top
 * @property integer $tracker_of_addition
 * @property float $self_cost
 * @property float $best_seller
 * @property float $special
 * @property float $deal_week
 * @property string $link
 * @property string $image
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
    public $image;
    const WEB_IMG = '/web/img/';
    const SIZE = '_400.';
    const IMG = '/img/';
    const CART_TYPE = 1;
    const MY_SERVER = 'my_server';
    const AMAZON = 'amazon';
    const IMAGE_SMALL = 'small_';
    const METRIC_PIECES = 1;
    const METRIC_KG = 2;
    const ADDITION_BY_ADMIN = 0;
    const ADDITION_BY_PARSER = 1;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'count_of_views', 'top', 'active', 'best_seller', 'special', 'deal_week','tracker_of_addition','metric'], 'integer'],
            [['title', 'cost', 'category_id'], 'required'],
            ['title', 'trim'],
            [['created_at','imageFiles','updated_at'], 'safe'],
                [['cost', 'self_cost', 'quantity','metro_cost'], 'number'],
            [['cost', 'self_cost', 'quantity'], 'compare', 'compareValue' => 0 , 'operator' => '>'],
            ['count_of_views', 'default', 'value' => 0],
            [['title', 'description', 'link'], 'string'],
            [['code', 'barcode'], 'string', 'max' => '20']
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
            'created_at'=>Yii::t('app', 'Дата создание'),
            'updated_at'=>Yii::t('app', 'Дата обновления'),
            'metric' => Yii::t('app', 'Метрика измерения'),
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
            'best_seller' => Yii::t('app', 'Топ продаж'),
            'special' => Yii::t('app', 'Спец. предложение'),
            'deal_week' => Yii::t('app', 'Топ недели'),
            'quantity' => Yii::t('app', 'Количество '),
            'barcode' => Yii::t('app', 'Штрихкод'),
            'code' => Yii::t('app', 'Артикул'),
            'metro_cost' =>Yii::t('app', 'Цена метро'),
            'tracker_of_addition'=>Yii::t('app', 'Добавлено:')
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function getAdditionTitles()
    {
        return [
            static::ADDITION_BY_ADMIN => 'Админом',
            static::ADDITION_BY_PARSER => 'Через парсер',
        ];
    }
    public function getAdditionTitle()
    {
        $titles = static::getAdditionTitles();

        return key_exists($this->tracker_of_addition, $titles) ? $titles[$this->tracker_of_addition] : null;
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
            return Yii::$app->params['defaultKitImage'];
        }
    }

    /**
     * @inheritdoc
     */
    public function upload()
    {

            try {
//            foreach ($files as $file) {
                $image = new Image();
                $image->name = $this->imageFiles;
                if($image->name)
                $image->item_id = $this->id;
                $image->save();
//                }
            } catch (\Exception $exception) {
                var_dump($exception->getMessage());
                exit;
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
    public function urlRename()
    {
        return basename($this->imageFiles);
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
     * @param Image|null $image
     * @throws \Exception|\Throwable in case delete failed.
     */
    public function deleteImages($image)
    {
        if(!empty($image)){
            if (file_exists($this->pathToFile($image->name))) {
                unlink( $this->pathToFile($image->name));
            }

            if (file_exists($this->pathToFile($image->name, self::SIZE))) {
                unlink( $this->pathToFile($image->name, self::SIZE));
            }

            $image->delete();
        }
    }

    public function deleteImagesFromServer($imageName)
    {
        if (file_exists($this->pathToFile($imageName))){
            unlink( $this->pathToFile($imageName));
        }

        if (file_exists($this->pathToFile($imageName, self::SIZE))){
            unlink($this->pathToFile($imageName, self::SIZE));
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

    public function pathToFile($fileName, $size = null)
    {
        if(!empty($size)){
            $info = new SplFileInfo($fileName);
            $path_parts = pathinfo($fileName);
            return Yii::getAlias('@www') .self::WEB_IMG.$path_parts['filename'] . $size . $info->getExtension();
        }else{
            return Yii::getAlias('@www') .self::WEB_IMG.$fileName;
        }
    }

    public static function getMetrics()
    {
        return [
            static::METRIC_PIECES => 'шт.',
            static::METRIC_KG => 'кг',
        ];
    }

    public function getMetricTitle()
    {
        $titles = static::getMetrics();

        return key_exists($this->metric, $titles) ? $titles[$this->metric] : 'шт.';
    }
}
