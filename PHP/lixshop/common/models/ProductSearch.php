<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'min_sales_qty', 'is_in_stock', 'visibility', 'package_number', 'created_user_id', 'review_count', 'favorite_count'], 'integer'],
            [['name', 'spu', 'sku', 'url_key', 'meta_title', 'meta_keywords', 'meta_description', 'created_at', 'updated_at'], 'safe'],
            [['score', 'price', 'cost_price', 'final_price', 'reviw_rate_star_average'], 'number'],
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

        $query->with('image');
        $query->with('category');
        $query->with('customOptionStock');
        $query->with('flatStock');

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
            'score' => $this->score,
            'status' => $this->status,
            'min_sales_qty' => $this->min_sales_qty,
            'is_in_stock' => $this->is_in_stock,
            'visibility' => $this->visibility,
            'flatStock' => $this->flatStock,
            'image' => $this->image,
            'category' => $this->category,
            'customOptionStock' => $this->customOptionStock,
            'price' => $this->price,
            'cost_price' => $this->cost_price,
            'final_price' => $this->final_price,
            'package_number' => $this->package_number,
            'created_user_id' => $this->created_user_id,
            'reviw_rate_star_average' => $this->reviw_rate_star_average,
            'review_count' => $this->review_count,
            'favorite_count' => $this->favorite_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'spu', $this->spu])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'url_key', $this->url_key])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description]);

        return $dataProvider;
    }
}
