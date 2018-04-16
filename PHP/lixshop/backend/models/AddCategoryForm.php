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
}
