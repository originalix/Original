<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\ProductCategory;

class AddCategoryForm extends Model
{
    public $category;
    public $test;

    public function rules()
    {
        return [
        ];
    }

    public function saveCategory($product_id)
    {
        foreach($this->category as $id) {
            $model = new ProductCategory();
            $model->product_id = $product_id;
            $model->category_id = $id;
            if (! $model->save()) {
                print_r($model->getFirstErrors());
                exit();
                return false;
            }
        }

        return true;
    }
}
