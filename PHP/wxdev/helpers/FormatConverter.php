<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\helpers;

use yii\helpers\BaseFormatConverter;

/**
 * FormatConverter provides functionality to convert between different formatting pattern formats.
 *
 * It provides functions to convert date format patterns between different conventions.
 *
 * @author Carsten Brandt <mail@cebe.cc>
 * @author Enrica Ruedin <e.ruedin@guggach.com>
 * @since 2.0
 */
class FormatConverter extends BaseFormatConverter {

    /**
     * 输出xml微信需要的字符串
     * 问候一句微信开发你麻痹还自定义xml返回，草
     */
    public static function toWechatXml($data) {
        $xml = "<xml>";
        foreach ($data as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

}
