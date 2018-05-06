<?php

namespace common\models\mongodb;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\mongodb\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\mongodb\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'name', 'spu', 'sku', 'score', 'status', 'min_sales_qty', 'is_in_stock', 'visibility', 'url_key', 'stock', 'category', 'price', 'cost_price', 'final_price', 'meta_title', 'meta_keywords', 'meta_description', 'image', 'description', 'short_description', 'custom_option', 'package_number', 'created_at', 'updated_at', 'created_user_id', 'attr_group', 'reviw_rate_star_average', 'review_count', 'reviw_rate_star_info', 'favorite_count'], 'safe'],
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
        $query = Product::find();


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
        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'spu', $this->spu])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'score', $this->score])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'min_sales_qty', $this->min_sales_qty])
            ->andFilterWhere(['like', 'is_in_stock', $this->is_in_stock])
            ->andFilterWhere(['like', 'visibility', $this->visibility])
            ->andFilterWhere(['like', 'url_key', $this->url_key])
            ->andFilterWhere(['like', 'stock', $this->stock])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'cost_price', $this->cost_price])
            ->andFilterWhere(['like', 'final_price', $this->final_price])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'custom_option', $this->custom_option])
            ->andFilterWhere(['like', 'package_number', $this->package_number])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'created_user_id', $this->created_user_id])
            ->andFilterWhere(['like', 'attr_group', $this->attr_group])
            ->andFilterWhere(['like', 'reviw_rate_star_average', $this->reviw_rate_star_average])
            ->andFilterWhere(['like', 'review_count', $this->review_count])
            ->andFilterWhere(['like', 'reviw_rate_star_info', $this->reviw_rate_star_info])
            ->andFilterWhere(['like', 'favorite_count', $this->favorite_count]);

        return $dataProvider;
    }
}
