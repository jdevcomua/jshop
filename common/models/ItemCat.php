<?php

namespace common\models;

use common\models\query\ItemCatQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use SplFileInfo;
use Yii;
use yii\web\NotFoundHttpException;
use dosamigos\transliterator\TransliteratorHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "item_cat".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $image
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $tree
 * @property integer $active
 *
 * @property Characteristic[] $characteristics
 * @property Item[] $items
 * @property ItemCat[] $children
 * @property ItemCat $parent
 * @property string $imageUrl
 * 
 * @method integer|false deleteWithChildren()
 * @method boolean makeRoot(boolean $runValidation = true, array $attributes = null)
 * @method boolean appendTo(ActiveRecord $node, boolean $runValidation = true, array $attributes = null)
 */
class ItemCat extends ModelWithImage
{
    
    public $count;
    public $dir = 'categories';
    const ALCOHOL = 'Алкогольные напитки';
    const TOBACOO = 'Табачные изделия';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_cat';
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
            [['parent_id', 'active'], 'integer']
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
            'parse_url'=>'URL для парсинга'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id']);
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
        return $this->hasMany(Characteristic::className(), ['category_id' => 'id'])->indexBy('id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(ItemCat::className(), ['parent_id' => 'id'])->andWhere(['active' => true]);
    }
    public function slug()
    {
        $i=0;
        $slugs = [];
        $parsers = Parse::find()->where(['category_id'=>$this->id])->all();
        foreach ($parsers as $parser){
            $slugs[$i]=$parser->slug;
        }

        return $slugs;
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

    /**
     * Return url to this category
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::$app->urlHelper->to(['category/' . $this->id . '-' . $this->getTranslit()]);
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
    public function findModel($id)
    {
        if (($model = ItemCat::findOne(['id' => $id, 'active' => true])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена.');
        }
    }
}
