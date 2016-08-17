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
 *
 * @property ItemCat $category
 * @property CharacteristicItem[] $characteristicItems
 */
class Characteristic extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristic';
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
            [['category_id'], 'integer'],
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
        ];
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
        if (key_exists($this->id, $filters)) {
            unset($filters[$this->id]);
        }
        if (empty($filters)) {
            $count = 'count(value)';
        } else {
            $filterWhere = SiteController::getItemIdsForFilter($filters);
            if (!$filterWhere) {
                $filterWhere = [0];
            }
            $count = 'sum(if(item_id in (' . implode(',', $filterWhere) . '), 1, 0))';
        }
        return $this->hasMany(CharacteristicItem::className(), ['characteristic_id' => 'id'])->addGroupBy(['value'])
            ->select(['characteristic_item.*, ' . $count . ' as count']);
    }
}
