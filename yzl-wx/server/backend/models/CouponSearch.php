<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Coupon;

/**
 * CouponSearch represents the model behind the search form of `common\models\Coupon`.
 */
class CouponSearch extends Coupon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'users_per_customer', 'times_used', 'type', 'conditions', 'discount'], 'integer'],
            [['created_person', 'coupon_name', 'coupon_description', 'coupon_code', 'expiration_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = Coupon::find();

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
            'expiration_date' => $this->expiration_date,
            'users_per_customer' => $this->users_per_customer,
            'times_used' => $this->times_used,
            'type' => $this->type,
            'conditions' => $this->conditions,
            'discount' => $this->discount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'created_person', $this->created_person])
            ->andFilterWhere(['like', 'coupon_name', $this->coupon_name])
            ->andFilterWhere(['like', 'coupon_description', $this->coupon_description])
            ->andFilterWhere(['like', 'coupon_code', $this->coupon_code]);

        return $dataProvider;
    }
}
