<?php

namespace backend\controllers;

use Yii;
use backend\models\AddProductForm;
use backend\controllers\BaseController;
use backend\models\UploadImage;
use common\models\Product;
use common\models\ProductImage;
use common\models\CustomOptionStock;
use common\models\ProductCategory;
use common\models\Category;
use backend\models\AddCategoryForm;

class ProductController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }

    public function actionTest()
    {
        // $this->layout = false;
        $model = new AddProductForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                print_r(Yii::$app->request->post());
                $model->category = Yii::$app->request->post('AddProductForm');
                print_r($model->category);
                print_r('验证通过');
                exit();
            } else {
                print_r('验证失败');
                exit();
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new AddProductForm();
        $imgModel = new UploadImage();
        if ($model->load(Yii::$app->request->post())) {
            $model->image = Yii::$app->request->post('image', []);
            
            if ($product = $model->createProduct()) {
                if ($model->saveImage($product->id)) {
                    return $this->redirect(['product/custom', 'id' => $product->id]);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'imgModel' => $imgModel,
        ]);
    }

    public function actionCustom()
    {
        $product_id = Yii::$app->request->get('id');
        $add_category_form = new AddCategoryForm();
        $category = Category::find()->all();
        $models = [];

        if ($add_category_form->load(Yii::$app->request->post())) {
            $category_maps= Yii::$app->request->post('AddCategoryForm');
            $add_category_form->category = $category_maps['category'];
            if ($add_category_form->saveCategory($product_id)) {
                return $this->redirect(['home/index']);
            }
        }

        $models = CustomOptionStock::find()->where(['product_id' => $product_id])->all();

        return $this->render('_create_category', [
            'models' => $models,
            'id' => $product_id,
            'category' => $add_category_form,
            'category_models' => $category,
        ]);
    }

    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = new AddProductForm();
        $imgModel = new UploadImage();
        $category = Category::find()->all();
        $add_category_form = new AddCategoryForm();
        // 自定义属性models数组
        $models = [];
        if (! is_null($id)) {
            // 获取产品信息
            $product = Product::findOne($id);
            $data = $product->attributes;
            $model->setAttributes($data);
            $model->image = $product->image;
            // 获取自定义属性信息
            $models = CustomOptionStock::find()->where(['product_id' => $id])->all();
            // 获取分类信息 并赋值给AddCategoryForm模型
            $product_categroies = ProductCategory::find()->where(['product_id' => $id])->all();
            $category_id_maps = [];
            foreach($product_categroies as $product_category) {
                array_push($category_id_maps, $product_category->category_id);
            }
            $add_category_form->category = $category_id_maps;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->image = Yii::$app->request->post('image', []);
            
            if ($product = $model->updateProduct($id)) {
                if ($model->saveImage($product->id)) {
                    $category_maps= Yii::$app->request->post('AddCategoryForm');
                    // category_maps['category] 以及 category_id_maps 去重
                    
                    $add_category_form->category = $category_maps['category'];
                    if ($add_category_form->saveCategory($id)) {
                        return $this->redirect(['home/index']);
                    }
                }
            }
        }

        return $this->render('update', [
            'id' => $id,
            'model' => $model,
            'imgModel' => $imgModel,
            'category_models' => $category,
            'category' => $add_category_form,
            'models' => $models
        ]);
    }

    public function actionPjax()
    {
        $product_id = 0;
        $model = new CustomOptionStock();
        $models = [];

        if (Yii::$app->request->isPost) {
            print_r(Yii::$app->request->post());
            $model->product_id = Yii::$app->request->post('product_id');
            $product_id = $model->product_id;
            $model->custom_option_key = Yii::$app->request->post('custom_option_key');
            $model->stock = Yii::$app->request->post('stock');
            $model->save();
        }

        if ($product_id !== 0) {
            $models = CustomOptionStock::find()->where(['product_id' => $product_id])->all();
        }
        
        return $this->render('custom_option_form', [
            'product_id' => $product_id,
            'models' => $models,
        ]);
    }
}
