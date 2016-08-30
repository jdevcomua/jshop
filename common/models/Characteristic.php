<?php

namespace common\models;

use frontend\controllers\SiteController;
use Yii;

/**
 * This is the model class for table "characteristic".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property integer $type of displaying in filters
 *
 * @property ItemCat $category
 * @property CharacteristicItem[] $characteristicItems
 */
class Characteristic extends Model
{

    const TYPE_NONE = 0;
    const TYPE_CHECKBOXES = 1;
    const TYPE_RANGE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristic';
    }

    public function getTypeTitle()
    {
        return self::getTypesArray()[$this->type];
    }

    /**
     * @return array
     */
    public function getTranslateColumns()
    {
        return ['title'];
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
    public function rules()
    {
        return [
            [['category_id', 'type'], 'integer'],
            [['type'], 'default', 'value' => self::TYPE_NONE],
            [['title'], 'string'],
            [['title'], 'required']
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
            'categoryTitle' => Yii::t('app', 'Категория'),
            'type' => Yii::t('app', 'Вид в фильтрах'),
            'typeTitle' => Yii::t('app', 'Вид в фильтрах'),
        ];
    }
    
    public static function getTypesArray()
    {
        return [Characteristic::TYPE_NONE => 'Не показывать', Characteristic::TYPE_CHECKBOXES => 'Чекбоксы', 
            Characteristic::TYPE_RANGE => 'Диапазон'];
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
    public function getCharacteristicItems()
    {
        $filters = Yii::$app->request->get('filter');
        if (empty($filters)) {
            $count = 'count(value)';
        } else {
            if (key_exists($this->id, $filters)) {
                unset($filters[$this->id]);
            }
            $filterWhere = SiteController::getItemIdsForFilter($filters);
            if (count($filterWhere) > 0) {
                if (!is_array($filterWhere)) {
                    $filterWhere = [0];
                }
                $count = 'sum(if(item_id in (' . implode(',', $filterWhere) . '), 1, 0))';
            } else {
                $count = 'count(value)';
            }
        }
        return $this->hasMany(CharacteristicItem::className(), ['characteristic_id' => 'id'])->addGroupBy(['value'])
            ->select(['characteristic_item.*, ' . $count . ' as count']);
    }
}
