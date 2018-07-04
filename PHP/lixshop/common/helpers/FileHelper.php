<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\helpers;

use Yii;

/**
 * Url provides a set of static methods for managing URLs.
 *
 * For more details and usage information on Url, see the [guide article on url helpers](guide:helper-url).
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class Url extends \yii\helpers\BaseUrl {

    public static function h5($uri) {
        return 'http://h5.lunengsports.net/#/' . ltrim(static::to($uri), '/');
    }

    public static function share($uri) {
        return 'http://h5.lunengsports.net/#/' . ltrim(static::to($uri), '/');
    }

    /**
     * 阿里云OSS图片自动裁切
     * @param array $options
     * @param mixed $watermark
     * @param boolean $url
     * @return mixed
     */
    public static function toRemote($original, $host = null) {
        if (!$original) {
            return null;
        }
        if (!static::isRelative($original)) {
            return $original;
        }

        if (!$host || static::isRelative($host)) {
            $host = Yii::getAlias('@attachUrl');
        }
        return rtrim($host, '/') . '/' . ltrim($original, '/');
    }

}
