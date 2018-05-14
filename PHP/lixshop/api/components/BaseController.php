<?php

namespace api\components;

use Yii;
use yii\web\Response;
use yii\helpers\Inflector;
use api\filters\HttpApiAuth;
use yii\filters\auth\CompositeAuth;

use common\models\Customer;

class BaseController extends \yii\rest\Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
        'linksEnvelope'  => 'links',
        'metaEnvelope' => 'meta',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // if (!YII_ENV_DEV) {
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpApiAuth::className(),
            ],
        ];
        // } else {
        //     // gxKehPvizQbscvKMBgtaDdfT8dJMQFw9   iMac
        //     // vLVX_pf8-Vb73fIqZOT7qboVBDw3UhHn
        //     $identity = Customer::loginByAccessToken('vLVX_pf8-Vb73fIqZOT7qboVBDw3UhHn', get_class($this));
        //     Yii::$app->user->login($identity);
        // }

        $behaviors['contentNegotiator']['formats'] = [];
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    protected function verbs() {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    /**
     * 记录日志
     */
    public static function log($prefix, $content) {
        $message = Inflector::id2camel($prefix);
        Yii::info($message);
        Yii::info($content);
    }

    public function getUser()
    {
        return Yii::$app->user->identity;
    }
}
