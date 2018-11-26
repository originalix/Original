<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ChargeOrder;

/**
 * ChargeOrderSearch represents the model behind the search form of `common\models\ChargeOrder`.
 */
class ChargeOrderSearch extends ChargeOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_status', 'customer_id', 'customer_group', 'enjoy_discounts'], 'integer'],
            [['trade_no', 'remote_ip', 'payment_method', 'txn_id', 'created_at', 'updated_at'], 'safe'],
            [['total_amount', 'discount_amount', 'real_amount'], 'number'],
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
        $query = ChargeOrder::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_status' => $this->order_status,
            'total_amount' => $this->total_amount,
            'discount_amount' => $this->discount_amount,
            'real_amount' => $this->real_amount,
            'customer_id' => $this->customer_id,
            'customer_group' => $this->customer_group,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'enjoy_discounts' => $this->enjoy_discounts,
        ]);

        $query->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'remote_ip', $this->remote_ip])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'txn_id', $this->txn_id]);

        return $dataProvider;
    }
}
