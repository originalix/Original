<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Review;

/**
 * ReviewSearch represents the model behind the search form of `common\models\Review`.
 */
class ReviewSearch extends Review
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rate_star', 'customer_id', 'status'], 'integer'],
            [['product_id', 'product_custom_option_key', 'name', 'ip', 'summary', 'review_content', 'review_data', 'audit_user', 'audit_date'], 'safe'],
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
        $query = Review::find();

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
            'rate_star' => $this->rate_star,
            'customer_id' => $this->customer_id,
            'review_data' => $this->review_data,
            'status' => $this->status,
            'audit_date' => $this->audit_date,
        ]);

        $query->andFilterWhere(['like', 'product_id', $this->product_id])
            ->andFilterWhere(['like', 'product_custom_option_key', $this->product_custom_option_key])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'review_content', $this->review_content])
            ->andFilterWhere(['like', 'audit_user', $this->audit_user]);

        return $dataProvider;
    }
}
