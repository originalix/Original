<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\helpers;

use yii\helpers\BaseStringHelper;

/**
 * StringHelper.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Alex Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class StringHelper extends BaseStringHelper {

    /**
     * 屏蔽字符串的一部分字符为指定字符
     * @param string $content 检测内容
     * @param string $type 类型
     * @return boolean 检测状态
     */
    public static function maskChar($subject, $start = 3, $end = 4, $char = '*', $type = 'w') {
        $length = static::byteLength($subject);
        $masklength = $length - $start - $end;
        //\w
        $pattern_begin = '(\\' . $type . '{0,' . $start . '})';
        $pattern_end = '(\\' . $type . '{' . $end . '})';
        $pattern_body = '\\' . $type . '{' . $masklength . '}';
        $pattern = '/' . $pattern_begin . $pattern_body . $pattern_end . '/';
        $replacement = "\$1 " . str_pad('', $masklength, $char) . " \$2";
        return preg_replace($pattern, $replacement, $subject);
    }

}
