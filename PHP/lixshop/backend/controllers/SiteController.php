<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Customer;
use yii\data\ActiveDataProvider;
use backend\queues\DownloadJob;

use common\models\Product;
use common\models\CustomOptionStock;
use common\models\ProductImage;
use common\models\ProductFlatStock;
use common\models\ProductCategory;
use common\models\Category;
use common\models\mongodb\Product as MongoProduct;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'rules' => [
            //         [
            //             'actions' => ['login', 'error'],
            //             'allow' => true,
            //         ],
            //         [
            //             'actions' => ['logout', 'index'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        // if (!Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionMongo()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        // Mongodb 插入
        // $cus = new Customer();
        // $cus->name = 'Lix';
        // $cus->email = 'lix@example.com';
        // $cus->address = '新雅堂公寓';
        // $cus->status = 1;
        // $cus->options = [
        //     'lix', 'PHP', 'javascript'
        // ];
        // $cus->save();

        // Mongodb 获取分页数据
        // $provider = new ActiveDataProvider([
        //     'query' => Customer::find(),
        //     'pagination' => [
        //         'pageSize' => 10,
        //     ]
        // ]);
        // $models = $provider->getModels();
            
        // Mongodb 更新数据
        // $customer = Customer::findOne([
        //     'name' => 'Lix',
        // ]);

        // $customer->options = [
        //     'Objective-C', 'Swift', 'Kotlin'
        // ];

        // $customer->save();

        // Mongodb ActiveRecord获取数据
        $models = Customer::find()->all();



        // return $this->render('mongo', [
        //     'models' => $models,
        // ]);
        return ['data' => $models];
    }

    public function actionQueue()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->queue->push(new DownloadJob([
            'url' => 'http://example.com/image.jpg',
            'file' => '/tmp/image.jpg',
        ]));
        return ['code' => 200, 'id' => $id];
    }

    public function actionProduct()
    {
        $product_id = 8;

        $mongoProduct = MongoProduct::find()
        ->where(['product_id' => 8])
        ->one();

        print_r($mongoProduct);
        exit();

        if (is_null($mongoProduct)) {
            $mongoProduct = new MongoProduct();
        }

        $imageArr = [];
        $categoryArr = [];
        $custom_option_arr = [];

        $product = Product::findOne($product_id);
        // $product->image;
        foreach($product->image as $imgModel) {
            // Yii::getAlias('@baseurl').'/backend/web'. $imageModel->path,
            $path = Yii::getAlias('@backendUrl'). $imgModel->path;
            array_push($imageArr, $path);
        }
        print_r($imageArr);
        echo "</br>";

        // $product->flatStock->stock;
        print_r($product->flatStock->stock);
        echo "</br>";

        // $product->category;
        foreach($product->category as $categoryModel) {
            $item = [
                'id' => $categoryModel->category->id,
                'name' => $categoryModel->category->category
            ];
            array_push($categoryArr, $item);
        }
        print_r($categoryArr);
        echo "</br>";
        // $product->customOptionStock;
        foreach($product->customOptionStock as $customOption) {
            $item = [
                'id' => $customOption->id,
                'key' => $customOption->custom_option_key,
                'stock' => $customOption->stock,
            ];
            array_push($custom_option_arr, $item);
        }
        print_r($custom_option_arr);
        echo "</br>";

        $mongoProduct->setAttributes($product->attributes, false);
        $mongoProduct->product_id = $product->id;
        $mongoProduct->image = $imageArr;
        $mongoProduct->stock = $product->flatStock->stock;
        $mongoProduct->custom_option = $custom_option_arr;
        $mongoProduct->category = $categoryArr;

        echo "</br>";
        // print_r($product->attributes);
        // echo "</br>";
        // // $mongoProduct->name = 'lix';
        print_r($mongoProduct->getAttributes());
        $mongoProduct->save();
    }
}
