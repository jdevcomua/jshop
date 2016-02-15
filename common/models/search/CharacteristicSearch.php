<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Characteristic;

/**
 * CharacteristicSearch represents the model behind the search form about `common\models\Characteristic`.
 */
class CharacteristicSearch extends Characteristic
{
    public $categoryTitle;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['title'], 'safe'],
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
        $query = Characteristic::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id', 'title',
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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->joinWith(['category' => function ($q) {
            $q->where('item_cat.title LIKE "%' . $this->categoryTitle . '%"');
        }]);

        return $dataProvider;
    }
}
