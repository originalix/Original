<?php

namespace app\models;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Support\Log;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
/**
 * Wechat Component Access
 * @property Application $app
 * @package yii\wechat
 */
class Wechat extends Component
{
    /**
     * @var array 微信的配置
     */
    public $config = [];
    /**
     * @var Application
     */
    protected $app;
    public function init()
    {
        parent::init();
        if (!isset($this->config['app_id'], $this->config['secret'])) {
            throw new InvalidConfigException('Wechat config need appId and secret');
        }
        $this->app = $this->createEasyWechat($this->config);
    }
    /**
     * create EasyWecaht Application by config
     * @param $config
     * @return Application
     */
    public function createEasyWechat($config)
    {
        $app = new Application($config);
        if (!isset($config['log'])) {
            Log::setLogger(new Logger());
        } else {
            if (YII_DEBUG) {
                Log::notice('log component suggest use Yii Logger,it need config the log section!');
            }
        }
        if (isset($this->config['cache'])) {
            $cacheConfig = $this->config['cache'];
            unset($this->config['cache']);
        } else {
            $cacheConfig = 'cache';
        }
        $cache = new Cache($cacheConfig);
        $app->access_token->setCache($cache);
        return $app;
    }
    /**
     * get current EasyWechat Application
     * @return Application
     */
    public function getApp()
    {
        return $this->app;
    }
}
