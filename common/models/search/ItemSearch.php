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


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'count_of_views'], 'integer'],
            [['title'], 'safe'],
            [['cost'], 'number'],
            [['categoryTitle'], 'safe']
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
                'id', 'title', 'cost', 'count_of_views',
                'categoryTitle' => [
                    'asc' => ['item_cat.title' => SORT_ASC],
                    'desc' => ['item_cat.title' => SORT_DESC],
                    'label' => 'Category Title'
                ]
            ]
        ]);

        if (!($this->validate() && $this->load($params))) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['category']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'cost' => $this->cost,
        ]);

        $query->andFilterWhere(['like', 'item.title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image]);

        $query->joinWith(['category' => function ($q) {
            $q->where('item_cat.title LIKE "%' . $this->categoryTitle . '%"');
        }]);

        return $dataProvider;
    }
}
