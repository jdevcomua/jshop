<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vote;

/**
 * VoteSearch represents the model behind the search form about `common\models\Vote`.
 */
class VoteSearch extends Vote
{
    public $itemTitle;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'user_id', 'rating', 'checked'], 'integer'],
            [['timestamp', 'text', 'itemTitle'], 'safe'],
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
        $query = Vote::find()->orderBy(['timestamp' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'timestamp', 'title', 'rating', 'text',
                'itemTitle' => [
                    'asc' => ['item.title' => SORT_ASC],
                    'desc' => ['item.title' => SORT_DESC],
                    'label' => 'Item Title'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'item_id' => $this->item_id,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
            'rating' => $this->rating,
            'checked' => $this->checked,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        $query->joinWith(['item' => function ($q) {
            $q->where('item.title LIKE "%' . $this->itemTitle . '%"');
        }]);

        return $dataProvider;
    }
}
