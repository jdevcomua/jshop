<?php

namespace common\models;

use common\models\query\ItemCatQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use SplFileInfo;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use dosamigos\transliterator\TransliteratorHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "item_cat".
 *
 * @property integer $id
 * @property string $title
 * @property integer $adult
 * @property integer $parent_id
 * @property string $image
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $tree
 * @property integer $active
 * @property integer $slider_order
 * @property integer $in_slider
 * @property string $h1
 *
 * @property Characteristic[] $characteristics
 * @property Item[] $items
 * @property ItemCat[] $children
 * @property ItemCat $parent
 * @property string $imageUrl
 * @property Parse[] $parse
 * @method integer|false deleteWithChildren()
 * @method boolean makeRoot(boolean $runValidation = true, array $attributes = null)
 * @method boolean appendTo(ActiveRecord $node, boolean $runValidation = true, array $attributes = null)
 */
class ItemCat extends ModelWithImage
{
    public $treeDepth;
    public $count;
    public $h1;
    public $dir = 'categories';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_cat';
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $maxSliderOrder = ItemCat::find()->max('slider_order');
            $this->slider_order =$maxSliderOrder + 1;
        }
        return true;
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'image'], 'string'],
            [['parent_id', 'active','adult'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'parent_id' => 'Родительская категория',
            'image' => 'Изображение',
            'imageFile' => 'Изображение',
            'active' => 'Активно',
            'parse_url' => 'URL для парсинга',
            'adult' => 'Для совершеннолетних 18+'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['category_id' => 'id']);
    }

    public function urlRename()
    {

        return basename($this->image);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristics()
    {
        return $this->hasMany(Characteristic::class, ['category_id' => 'id'])->indexBy('id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(ItemCat::class, ['parent_id' => 'id'])->andWhere(['active' => true])
            ->orderBy(['slider_order' =>SORT_ASC]);
    }

    /**
     * @inheritdoc
     * @return ItemCatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemCatQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ItemCat::className(), ['id' => 'parent_id']);
    }

    public function getParse()
    {
        return $this->hasMany(Parse::className(), ['category_id' => 'id']);
    }

    public function setParse($value)
    {
        return $this->parse = $value;
    }
    /**
     * Return url to this category
     *
     * @return string
     */
    public function getUrl()
    {
        $url = Yii::$app->params['serverUrl']. '/category/' . $this->id . '-' . $this->getTranslit();
        $seo = Seo::findOne(['url'=>$url]);
        if(isset($seo)&& !empty($seo->new_url)){
            return Yii::$app->urlHelper->to(['/category/' . $this->id . '-' . $this->strReplaceUrl($seo->new_url)]);
        }
        return Yii::$app->urlHelper->to(['/category/' . $this->id . '-' . $this->getTranslit()]);
    }

    public function strReplaceUrl($url)
    {
        $new_url = str_replace(Yii::$app->params['serverUrl'], '',$url);
        $new_url = str_replace('/category/', '',$new_url);
        $new_url = str_replace( $this->id . '-', '',$new_url);
        return $new_url;
    }

    /**
     * @return array
     */
    public function getFamily()
    {
        $childrenIdList[] = $this->id;
        $main_children = $this->children;
        foreach ($main_children as $child)
        {
            $childrenIdList[] = $child->id;
            if ($child->children)
                foreach ($child->children as $grandchild) {
                    $childrenIdList[] = $grandchild->id;
                }
        }
        return $childrenIdList;
    }

    public function getImageUrl()
    {
        $info = new SplFileInfo($this->image);
        $path_parts = pathinfo($this->image);
        if(file_exists(Yii::getAlias('@www') . '/web'. Item::IMG . $path_parts['filename']. Item::SIZE. $info->getExtension())){
            return Yii::$app->params['serverUrl'] . Item::IMG . $path_parts['filename']. Item::SIZE. $info->getExtension();
        }else{
            return Yii::$app->params['defaultKitImage'];
        }

    }

    public static function getItemFilterByName()
    {
        $categories = ItemCat::find()
            ->select(['item_cat.title'])
            ->join('JOIN', 'item', 'item.category_id = item_cat.id')
            ->distinct(true)
            ->all();
        return ArrayHelper::map($categories, 'title', 'title');
    }
}
