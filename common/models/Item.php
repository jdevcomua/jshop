<?php

namespace common\models;

use common\components\CartAdd;
use common\models\query\ItemQuery;
use dosamigos\transliterator\TransliteratorHelper;
use SplFileInfo;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $manufacturer_id
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
 * @property string $h1
 * @property string $image
 *
 * @property string $confirmText
 * @property string $additionText
 *
 * @property CharacteristicItem[] $characteristicItems
 * @property ItemCat $category
 * @property Manufacturer $manufacturer
 * @property OrderItem[] $orderItems
 * @property StockItem[] $stockItems
 * @property KitItem[] $kitItems
 * @property Vote[] $votes
 * @property Kit[] $kits
 * @property Image[] $images
 * @property Stock[] $stocks
 * @property string $url
 * @property string $tree
 */
class Item extends Model implements CartAdd
{
    const WEB_IMG = '/web/img/';
    const SIZE = '_400.';
    const IMG = '/img/';
    const CART_TYPE = 1;

    const METRIC_PIECES = 1;
    const METRIC_KG = 2;

    const ADDITION_BY_ADMIN = 0;
    const ADDITION_BY_PARSER = 1;

    const ACTIVE_YES = 1;
    const ACTIVE_NO = 0;

    /**
     * @var UploadedFile[]
     */
    public $imageFiles;
    public $count;
    public $image;
    public $h1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'count_of_views', 'top', 'active', 'best_seller', 'special', 'deal_week','tracker_of_addition','metric','manufacturer_id'], 'integer'],
            [['title', 'cost', 'category_id', 'self_cost'], 'required'],
            ['title', 'trim'],
            [['created_at','imageFiles','updated_at'], 'safe'],
            [['cost', 'self_cost', 'quantity','metro_cost'], 'number'],
            [['cost', 'self_cost', 'quantity'], 'compare', 'compareValue' => 0 , 'operator' => '>'],
            ['count_of_views', 'default', 'value' => 0],
            [['title', 'description', 'link'], 'string'],
            [['code', 'barcode'], 'string', 'max' => '20'],
            [['title'], 'string', 'max' => '63'],

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
            'tracker_of_addition'=>Yii::t('app', 'Добавлено'),
            'manufacturer_id'=>Yii::t('app', 'Manufacturer'),
            'manufacturerTitle'=>Yii::t('app', 'Manufacturer'),
            'category1'=>Yii::t('app', 'Категория 1'),
            'category2'=>Yii::t('app', 'Категория 2'),
            'category3'=>Yii::t('app', 'Категория 3'),
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
    public static function getConfirmTitles()
    {
        return [
            1 => 'Проверено',
            0 => 'Не Проверено',
        ];
    }

    public function getConfirmText()
    {
        return isset($this->confirm) && isset(self::getConfirmTitles()[$this->confirm])
            ? self::getConfirmTitles()[$this->confirm] : null;
    }

    public function getAdditionText()
    {
        return isset($this->tracker_of_addition) && isset(self::getAdditionTitles()[$this->tracker_of_addition])
            ? self::getAdditionTitles()[$this->tracker_of_addition] : null;
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
        return $this->hasMany(Kit::class, ['id' => 'kit_id'])->viaTable('kit_item', ['item_id' => 'id'])
            ->joinWith('kitItems')->where(['is_main_item' => true, 'item_id' => $this->id]);
    }

    /**
     * @return string
     */
    public function getCategoryTitle()
    {
        return $this->category->title;
    }

    public function getManufacturerTitle()
    {
        if (!empty($this->manufacturer)){
            return $this->manufacturer->name;
        }else{
            return null;
        }
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
    public function getImageUrls($size = '')
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
            $image = new Image();
            $image->name = $this->imageFiles;
            if($image->name){
                $image->item_id = $this->id;
                $image->save();
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            exit;
        }
    }

    public function beforeSave($insert)
    {
        if($this->getAttributes()['special'] = (int) true) Item::updateAll(['special' => (int) false]);
        $this->cost = self::roundUp($this->cost,1);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function urlRename()
    {
        return basename($this->imageFiles);
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
        return $this->hasMany(CharacteristicItem::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ItemCat::class, ['id' => 'category_id']);
    }

    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::class, ['id' => 'manufacturer_id'])??new Manufacturer();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockItems()
    {
        return $this->hasMany(StockItem::class, ['item_id' => 'id']);
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
        return $this->hasMany(Vote::class, ['item_id' => 'id'])->joinWith('user');
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
        return $this->hasMany(KitItem::class, ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::class, ['item_id' => 'id']);
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
        $url = Yii::$app->params['serverUrl']. '/item/' . $this->id . '-' . $this->getTranslit();
        $seo = Seo::findOne(['url'=>$url]);
        if(isset($seo)&& !empty($seo->new_url)){
            return Yii::$app->params['serverUrl'].'/item/' . $this->id . '-' . str_replace('.','',$this->strReplaceUrl($seo->new_url));
        }
        return Yii::$app->params['serverUrl'] . '/item/' . $this->id . '-' . str_replace('.','',$this->getTranslit());
    }

    public function strReplaceUrl($url){
        $new_url = str_replace(Yii::$app->params['serverUrl'], '',$url);
        $new_url = str_replace('/item/', '',$new_url);
        $new_url = str_replace( $this->id . '-', '',$new_url);
        $new_url = str_replace( '%', '',$new_url);
        return $new_url;
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
    public function getCategory1()
    {
        if (isset($this->category->parent->parent)){
            return $this->category->parent->parent->title;
        }elseif (isset($this->category->parent)){
            return $this->category->parent->title;
        }else{
            return $this->category->title;
        }
    }

    public function getCategory2()
    {
        if (isset($this->category->parent->parent)){
            return $this->category->parent->title;
        }elseif (isset($this->category->parent)){
            return $this->category->title;
        }else{
            return null;
        }
    }

    public function getCategory3()
    {
        if (isset($this->category->parent->parent)){
            return $this->category->title;
        }else{
            return null;
        }
    }

    protected function roundUp($cost, $precision)
    {
        $cost = round ($cost,$precision + 1);
        $cost = ceil($cost * pow(10, $precision)) / pow(10, $precision);
        $cost = round ($cost, $precision);
        return $cost;
    }
}
