<?php

namespace app\models;

use Psr\Log\LogLevel;
use Yii;
use Psr\Log\LoggerInterface;
/**
 * use Yii Logger component instead of EasyWechat default logger
 * @package yii\easyWechat
 */
class Logger implements LoggerInterface
{
    const CATEGORY = 'wechat';
    /**
     * @inheritdoc
     */
    public function emergency($message, array $context = array())
    {
        $ct = $this->format($message,$context);
        Yii::warning($ct,self::CATEGORY);
    }
    /**
     * @inheritdoc
     */
    public function alert($message, array $context = array())
    {
        $ct = $this->format($message,$context);
        Yii::warning($ct,self::CATEGORY);
    }
    /**
     * @inheritdoc
     */
    public function critical($message, array $context = array())
    {
        $ct = $this->format($message,$context);
        Yii::error($ct,self::CATEGORY);
    }
    /**
     * @inheritdoc
     */
    public function error($message, array $context = array())
    {
        $ct = $this->format($message,$context);
        Yii::error($ct,self::CATEGORY);
    }
    /**
     * @inheritdoc
     */
    public function warning($message, array $context = array())
    {
        $ct = $this->format($message,$context);
        Yii::warning($ct,self::CATEGORY);
    }
    /**
     * @inheritdoc
     */
    public function notice($message, array $context = array())
    {
        $ct = $this->format($message,$context);
        Yii::warning($ct,self::CATEGORY);
    }
    /**
     * @inheritdoc
     */
    public function info($message, array $context = array())
    {
        $ct = $this->format($message,$context);
        Yii::info($ct,self::CATEGORY);
    }
    /**
     * @inheritdoc
     */
    public function debug($message, array $context = array())
    {
        $ct = $this->format($message,$context);
        Yii::trace($ct,self::CATEGORY);
    }
    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = array())
    {
        $ct = $this->format($message,$context);
        switch ($level){
            case LogLevel::WARNING:
            case LogLevel::NOTICE:
            case LogLevel::ALERT:
                Yii::warning($ct,self::CATEGORY);
                break;
            case LogLevel::INFO:
                Yii::info($ct,self::CATEGORY);
                break;
            case LogLevel::DEBUG:
                Yii::trace($ct,self::CATEGORY);
                break;
            case LogLevel::ERROR:
            case LogLevel::CRITICAL:
            case LogLevel::EMERGENCY:
                Yii::error($ct,self::CATEGORY);
                break;
        }
    }
    /**
     * format the LoggerInterface params
     * @param $message
     * @param $context
     * @return string
     */
    private function format($message, $context){
        $context = json_encode($context);
        return "$message : $context";
    }
}
