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

    public static function numToWord($num) {
        $chiNum = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九');
        $chiUni = array('', '十', '百', '千', '万', '亿', '十', '百', '千');

        $chiStr = '';

        $num_str = (string) $num;

        $count = strlen($num_str);
        $last_flag = true; //上一个 是否为0
        $zero_flag = true; //是否第一个
        $temp_num = null; //临时数字

        $chiStr = ''; //拼接结果
        if ($count == 2) {//两位数
            $temp_num = $num_str[0];
            $chiStr = $temp_num == 1 ? $chiUni[1] : $chiNum[$temp_num] . $chiUni[1];
            $temp_num = $num_str[1];
            $chiStr .= $temp_num == 0 ? '' : $chiNum[$temp_num];
        } else if ($count > 2) {
            $index = 0;
            for ($i = $count - 1; $i >= 0; $i--) {
                $temp_num = $num_str[$i];
                if ($temp_num == 0) {
                    if (!$zero_flag && !$last_flag) {
                        $chiStr = $chiNum[$temp_num] . $chiStr;
                        $last_flag = true;
                    }
                } else {
                    $chiStr = $chiNum[$temp_num] . $chiUni[$index % 9] . $chiStr;

                    $zero_flag = false;
                    $last_flag = false;
                }
                $index ++;
            }
        } else {
            $chiStr = $chiNum[$num_str[0]];
        }
        return $chiStr;
    }

    public static function matchAt($content) {
        $pattern = "/\@([^\s|\/|:|\@]+)/";
        if (preg_match_all($pattern, $content, $matches)) {
            return $matches[1];
        }
        return [];
    }

    public static function matchTopic($content) {
        $pattern = "/\#([^\#]+)\#/";
        if (preg_match_all($pattern, $content, $matches)) {
            return $matches[1];
        }
        return [];
    }

    public static function matchEmoticon($content) {
        $pattern = "/\[([\x{4e00}-\x{9fa5}a-zA-Z0-9]+)\]/use";
        if (preg_match_all($pattern, $content, $matches)) {
            return $matches[1];
        }
        return [];
    }

}
