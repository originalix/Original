<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\web\HttpException;

class Mail extends Model
{
    public function send()
    {
        //controller代码 
        $mail = Yii::$app->mailer->compose('@app/mail/test', ['title' => '测试邮件发送哦哦哦']) 
            ->setTo('77252102@qq.com') 
            ->setSubject('Message subject') 
            ->send(); 
    }
}
