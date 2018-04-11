<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Customer;
use yii\data\ActiveDataProvider;

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
}
