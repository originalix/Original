<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\di\Instance;
use yii\caching\Cache as YiiCache;
/**
 * use Yii Cache component instead of EasyWechat default Cache
 * @package yii\easyWechat
 */
class Cache implements \Doctrine\Common\Cache\Cache
{
    /**
     * @var \yii\caching\Cache
     */
    private $cache = 'cache';
    function __construct($config)
    {
        if(!empty($config)){
            $this->cache = $config;
        }
        $this->cache = Instance::ensure($this->cache,YiiCache::className());
    }
    /**
     * @inheritdoc
     */
    public function fetch($id)
    {
        return $this->cache->get($id);
    }
    /**
     * @inheritdoc
     */
    public function contains($id)
    {
        return $this->cache->exists($id);
    }
    /**
     * @inheritdoc
     */
    public function save($id, $data, $lifeTime = 0)
    {
        return $this->cache->set($id,$data,$lifeTime);
    }
    /**
     * @inheritdoc
     */
    public function delete($id)
    {
        return $this->cache->delete($id);
    }
    /**
     * @inheritdoc
     */
    public function getStats()
    {
        throw new NotSupportedException('yii cache has not method : getStats');
    }
    public function getCache(){
        return $this->cache;
    }
}
