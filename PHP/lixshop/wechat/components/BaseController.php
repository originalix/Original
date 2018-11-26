<?php

namespace wechat\components;

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
}
