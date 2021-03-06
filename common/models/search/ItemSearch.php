<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Item;

/**
 * ItemSearch represents the model behind the search form about `common\models\Item`.
 */
class ItemSearch extends Item
{
    
    public $categoryTitle;
    public $manufacturerTitle;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'count_of_views','tracker_of_addition'], 'integer'],
            [['title','updated_at'], 'safe'],
            [['cost'], 'number'],
            [['categoryTitle','manufacturerTitle'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id', 'title', 'cost', 'count_of_views','updated_at','tracker_of_addition',
                'categoryTitle' => [
                    'asc' => ['item_cat.title' => SORT_ASC],
                    'desc' => ['item_cat.title' => SORT_DESC],
                    'label' => 'Category Title'
                ],
                'manufacturerTitle' => [
                    'asc' => ['manufacturer.name' => SORT_ASC],
                    'desc' => ['manufacturer.name' => SORT_DESC],
                    'label' => 'Manufacturer Title'
                ],
            ]
        ]);

        if (!($this->validate() && $this->load($params))) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['category']);
            $query->joinWith('manufacturer');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'item.id' => $this->id,
            'category_id' => $this->category_id,
            'tracker_of_addition' => $this->tracker_of_addition,
            ]);

        $query->andFilterWhere(['like', 'item.title', $this->title])
            ->andFilterWhere(['<', 'cost', $this->cost])
            ->andFilterWhere(['<', 'count_of_views', $this->count_of_views])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'manufacturer.name', $this->manufacturerTitle]);
        $query->joinWith(['category' => function ($q) {
            $q->where('item_cat.title LIKE "%' . $this->categoryTitle . '%"');
        }]);
        $query->joinWith('manufacturer');

        return $dataProvider;
    }
}
