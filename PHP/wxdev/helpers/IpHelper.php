<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\helpers;

use yii\helpers\BaseIpHelper;

/**
 * Class IpHelper provides a set of IP-related static methods.
 *
 * Methods expect correct IP addresses.
 * To validate IP addresses use [[\yii\validators\IpValidator|IpValidator]].
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 * @since 2.0.14
 */
class IpHelper extends BaseIpHelper {

    /**
     * IP地址转换成长整型格式
     * @param type $ip
     * @param type $unsigned
     * @return int
     */
    public static function ip2long($ip, $unsigned = true) {
        $long = ip2long($ip);
        if ($unsigned == true) {
            return sprintf('%u', $long);
        }
        return $long;
    }

    /**
     * 长整型数字格式成IP地址
     * @param type $long
     * @return IP string
     */
    public static function long2ip($long) {
        return long2ip($long);
    }

}
