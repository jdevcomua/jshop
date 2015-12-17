<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CharacteristicItem;

/**
 * CharacteristicItemSearch represents the model behind the search form about `common\models\CharacteristicItem`.
 */
class CharacteristicItemSearch extends CharacteristicItem
{

    public $characteristicTitle;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'characteristic_id'], 'integer'],
            [['value'], 'safe'],
            [['characteristicTitle'], 'safe']
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
        $query = CharacteristicItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'value',
                'characteristicTitle' => [
                    'asc' => ['characteristic.title' => SORT_ASC],
                    'desc' => ['characteristic.title' => SORT_DESC],
                    'label' => 'Characteristic Title'
                ]
            ]
        ]);

        if (!($this->validate() && $this->load($params))) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['characteristic']);
            $query->andFilterWhere([
                'item_id' => $params['item_id']
            ]);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'item_id' => $this->item_id,
            'characteristic_id' => $this->characteristic_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
