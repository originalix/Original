<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SalesFlatOrder;

/**
 * OrderSearch represents the model behind the search form of `common\models\SalesFlatOrder`.
 */
class OrderSearch extends SalesFlatOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'increment_id', 'order_status', 'items_count', 'customer_id', 'customer_group', 'express_type'], 'integer'],
            [['total_amount', 'discount_amount', 'real_amount', 'express_amount'], 'number'],
            [['customer_name', 'remote_ip', 'coupon_code', 'payment_method', 'order_remark', 'txn_type', 'txn_id', 'created_at', 'updated_at', 'trade_no', 'userName', 'province', 'city', 'county', 'street', 'postal_code', 'tel_number', 'express_date', 'express_time'], 'safe'],
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
        $query = SalesFlatOrder::find();

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
            'increment_id' => $this->increment_id,
            'order_status' => $this->order_status,
            'items_count' => $this->items_count,
            'total_amount' => $this->total_amount,
            'discount_amount' => $this->discount_amount,
            'real_amount' => $this->real_amount,
            'customer_id' => $this->customer_id,
            'customer_group' => $this->customer_group,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'express_amount' => $this->express_amount,
            'express_type' => $this->express_type,
        ]);

        $query->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'remote_ip', $this->remote_ip])
            ->andFilterWhere(['like', 'coupon_code', $this->coupon_code])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'order_remark', $this->order_remark])
            ->andFilterWhere(['like', 'txn_type', $this->txn_type])
            ->andFilterWhere(['like', 'txn_id', $this->txn_id])
            ->andFilterWhere(['like', 'trade_no', $this->trade_no])
            ->andFilterWhere(['like', 'userName', $this->userName])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'county', $this->county])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'tel_number', $this->tel_number])
            ->andFilterWhere(['like', 'express_date', $this->express_date])
            ->andFilterWhere(['like', 'express_time', $this->express_time]);

        return $dataProvider;
    }
}
