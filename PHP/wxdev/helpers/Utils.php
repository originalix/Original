<?php

namespace app\helpers;

use Yii;
use SoapClient;
use yii\helpers\StringHelper;
use phpseclib\Net\SFTP;
use phpseclib\Crypt\RSA;

/**
 * 自定义实用工具类
 *
 * @author emhome<emhome@163.com>
 * @since 2.0
 */
class Utils {

    /**
     * 产生随机字符串
     *
     * @param int $length 长度
     * @param boolean $numeric 是否返回数字
     * @return string 字符串
     */
    public static function random($length, $numeric = false) {
        $source = microtime();
        if (is_string($_SERVER['DOCUMENT_ROOT'])) {
            $source .= strval($_SERVER['DOCUMENT_ROOT']);
        }
        $hash = '';
        $string = '';
        if ($numeric) {
            $seed = base_convert(md5($source), 16, 10);
            $string = str_replace('0', '', $seed) . '012340567890';
        } else {
            $seed = base_convert(md5($source), 16, 35);
            $string = $seed . 'zZ' . strtoupper($seed);
            $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
            $length--;
        }
        $max = strlen($string) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $string{mt_rand(0, $max)};
        }
        return $hash;
    }

    /**
     * 正则表达式检测已有类型数据格式
     * @param string $array 检测内容
     * @param string $label 类型
     * @return boolean 检测状态
     */
    public static function formatFieldListLabel($array, $label = null) {
        if ($label != null) {
            foreach ($array as $key => $vls) {
                $array[$key] = '<b>' . $vls . '</b>' . $label;
            }
        }

        return $array;
    }

    /**
     * 正则表达式检测已有类型数据格式
     * @param string $content 检测内容
     * @param string $type 类型
     * @return boolean 检测状态
     */
    public static function formatContent($content, $type) {
        $formatPattern = Yii::$app->params['format_pattern'];
        if (isset($formatPattern[$type]) && preg_match($formatPattern[$type], $content)) {
            return true;
        }
        return false;
    }

    /**
     * 发送短信
     * @param string|array $mobile 手机号
     * @param string $content 短信内容
     * @return array $return 发送状态返回
     */
    public static function sendsms($mobile, $content) {
        $return = array('status' => false);
        if (is_array($mobile)) {
            $mobiles = [];
            foreach ($mobile as $item) {
                if (!self::formatContent($item, 'mobile')) {
                    $return['error'][] = [
                        'mobile' => $item,
                        'code' => '手机号格式错误！请输入正确的手机号。',
                    ];
                } else {
                    $mobiles[] = $item;
                }
            }
            if (!empty($mobiles)) {
                $mobile = implode(',', $mobiles);
            } else {
                $mobile = null;
            }
        } elseif (is_string($mobile)) {
            if (!self::formatContent($mobile, 'mobile')) {
                $return['code'] = '手机号格式错误！请输入正确的手机号。';
                return $return;
            }
        } else {
            $return['code'] = '内容格式错误！请输入正确的内容。';
            return $return;
        }

        if (!$mobile) {
            return $return;
        }

        $flag = 0;
        $argv = array(
            'sn' => 'SDK-BBX-010-20201', //序列号
            'pwd' => strtoupper(md5('SDK-BBX-010-20201' . '87-5a#1-')), //密码加密
            'mobile' => $mobile, //手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
            'content' => urlencode($content . '[山东鲁能]'), //短信内容
            'ext' => '',
            'rrid' => '', //默认空 如果空返回系统生成的标识串 如果传值保证值唯一 成功则返回传入的值
            'stime' => ''//定时时间 格式为2011-6-29 11:09:21
        );
        $params = '';
        foreach ($argv as $key => $value) {
            if ($flag != 0) {
                $params .= "&";
                $flag = 1;
            }
            $params .= $key . "=";
            $params .= urlencode($value);
            $flag = 1;
        }
        $length = strlen($params);
        //创建socket连接
        $fp = fsockopen("sdk.entinfo.cn", 8060, $errno, $errstr, 10);
        if (!$fp) {
            $return['code'] = $errstr . "--->" . $errno;
            return $return;
        }
        //构造post请求的头
        $header = "POST /webservice.asmx/mdSmsSend_u HTTP/1.1\r\n";
        $header .= "Host:sdk.entinfo.cn\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . $length . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        //添加post的字符串
        $header .= $params . "\r\n";
        //发送post的数据
        fputs($fp, $header);
        $inheader = 1;
        while (!feof($fp)) {
            $line = fgets($fp, 1024); //去除请求包的头只显示页面的返回数据
            if ($inheader && ($line == "\n" || $line == "\r\n")) {
                $inheader = 0;
            }
        }
        preg_match('/<string xmlns=\"http:\/\/tempuri.org\/\">(.*)<\/string>/', $line, $str);
        $result = explode("-", $str[1]);

        if (count($result) > 1) {
            $return['code'] = '发送失败返回值为:' . $line . "请查看webservice返回值";
            Yii::error(print_r($return, true));
        } else {
            $return['status'] = true;
        }

        return $return;
    }

    /**
     * 推入CDN
     * @param string $local 本地路径
     * @param string $remote 远端
     * @return boolean 检测状态
     */
    public static function pushCDN($local, $remote = null) {
        if (!YII_ENV_PROD) {
            return true;
        }
        $configs = Yii::$app->params['sftp'];

        $root = rtrim($configs['root'], '/');

        $sftp = new SFTP($configs['host']);
        $key = new RSA();
        $key->loadKey(file_get_contents($configs['private_key']));
        if (!$sftp->login($configs['user'], $key)) {
            return false;
        }
        $local_file = Yii::getAlias('@uploads') . $local;
        $remote_file = $root . '/' . trim($local, '/');

        $remote_path = $root . '/' . trim(dirname($local), '/');
        $sftp->mkdir($remote_path, 0777, true);

        if (!$sftp->put($remote_file, $local_file, SFTP::SOURCE_LOCAL_FILE)) {
            return false;
        }
        return true;
    }

    /**
     * GET 请求
     * @param string $url
     * @param string $returnType content|status|code
     */
    public static function httpGet($url, $returnType = 'content') {

        $ch = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $content = curl_exec($ch);
        $status = curl_getinfo($ch);

        if ($returnType == 'content') {
            if (intval($status["http_code"]) == 200) {
                return $content;
            } else {
                return false;
            }
        } elseif ($returnType == 'status') {
            return $status;
        } elseif ($returnType == 'code') {
            return $status["http_code"];
        } else {
            return compact('content', 'status');
        }
    }

    /**
     * POST 请求
     * @param string $url
     * @param array $param
     * @return string content
     */
    public static function httpPost($url, $param) {
        $ch = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strPOST);
        $sContent = curl_exec($ch);
        $aStatus = curl_getinfo($ch);
        curl_close($ch);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * 苹果支付检测
     * 
     * 21000 App Store不能读取你提供的JSON对象
     * 21002 receipt-data域的数据有问题
     * 21003 receipt无法通过验证
     * 21004 提供的shared secret不匹配你账号中的shared secret
     * 21005 receipt服务器当前不可用
     * 21006 receipt合法，但是订阅已过期。服务器接收到这个状态码时，receipt数据仍然会解码并一起发送
     * 21007 receipt是Sandbox receipt，但却发送至生产系统的验证服务
     * 21008 receipt是生产receipt，但却发送至Sandbox环境的验证服务
     */
    public static function httpAppleDetect($receipt_data, $sandbox = false) {
        //小票信息 JSON封装
        $POSTFIELDS = json_encode(["receipt-data" => $receipt_data]);
        //正式购买地址
        $url_buy = "https://buy.itunes.apple.com/verifyReceipt";
        //沙盒购买地址
        $url_sandbox = "https://sandbox.itunes.apple.com/verifyReceipt";

        $url = $sandbox ? $url_sandbox : $url_buy;

        $data = self::httpPost($url, $POSTFIELDS);

        if ($data != false) {
            return json_decode($data, 1);
        }

        return $data;
    }

    /**
     * 生成单场票单号
     * @param int $no
     * @return max | boolean or string
     */
    public static function buildTicketNo($no) {
        if ($bleacherid) {
            return sprintf("%06d", $no);
        }
        return false;
    }

    /**
     * 生成支付商户订单号
     * @param int $userid
     * @return max | boolean or string
     */
    public static function buildTradeNo($userid) {
        if ($userid) {
            return sprintf("%07d", $userid) . time() . self::random(4, 1);
        }
        return false;
    }

    /**
     * 生成上传文件的文件名
     *
     * @param	string	$ext    扩展名
     * @return	string	返回文件名
     */
    public static function buildUploadFileName($ext = false) {
        $tempname = self::random(6) . md5(Yii::$app->user->id . time() . self::random(4));
        if ($ext !== false) {
            return $tempname . '.' . $ext;
        }
        return $tempname;
    }

    

    /**
     * 十六进制转RGB
     * @param string
     * @return array
     */
    public static function hex2rgb($hexColor) {
        $color = str_replace('#', '', $hexColor);
        if (strlen($color) > 3) {
            $rgb = array(
                'r' => hexdec(substr($color, 0, 2)),
                'g' => hexdec(substr($color, 2, 2)),
                'b' => hexdec(substr($color, 4, 2))
            );
        } else {
            $color = $hexColor;
            $r = substr($color, 0, 1) . substr($color, 0, 1);
            $g = substr($color, 1, 1) . substr($color, 1, 1);
            $b = substr($color, 2, 1) . substr($color, 2, 1);
            $rgb = array(
                'r' => hexdec($r),
                'g' => hexdec($g),
                'b' => hexdec($b)
            );
        }
        return $rgb;
    }

    /**
     * 调用大麦WebService接口
     * @param string $data 发送数据
     * @param string $api 接口名称
     * @return boolean 状态
     */
    public static function sendToDamai($data, $api, &$msg = '') {
        if (!in_array($api, array('UpdateRfidInfo', 'SyncShowProjectRFID', 'SyncYearTicket', 'SyncUser'))) {
            return false;
        }
        $config = Yii::$app->params['webservice'];
        extract($config);
        try {
            $client = new SoapClient('http://webservice.lnts.cn/sdlu.asmx?WSDL');
            $applytime = time();
            $data['applytime'] = $applytime;
            $data['keycode'] = md5($authuser . $password . $applytime . $key);
            $soapRquest = $client->$api($data);
            $soapResultName = $api . 'Result';
            return $soapRquest->$soapResultName;
        } catch (SoapFault $e) {
            //记录失败数据
            $msg = 'SOAP ERROR:' . $e->getMessage();
            Yii::log($msg, 'error');
            return false;
        }
    }

    /**
     * func: getWeeks
     * 功能：获取一年内星期列表、每周起始时间
     */
    public static function getWeeks($format = "second", $year = null) {
        if ($year == null) {
            $year = date('Y');
        }
        $second_of_day = 24 * 3600;
        $year_start = $year . "-01-01 00:00:00";
        $year_end = $year . "-12-31 23:59:59";
        $startday = strtotime($year_start);
        $day_of_week = date('N', $startday);
        $first_week_start = $startday;
        $first_week_end = $startday + (7 - $day_of_week) * $second_of_day + $second_of_day - 1;
        $week_array[0] = array($first_week_start, $first_week_end);

        $endday = strtotime($year_end);
        $day_of_week = date('N', $endday);

        $last_week_start = $endday - $day_of_week * $second_of_day + 1;
        $last_week_end = $endday;
        $last_week = array($last_week_start, $last_week_end);

        $during = $last_week_start - $first_week_end;

        $during_total_week = intval($during / (7 * $second_of_day));

        for ($i = 0; $i < $during_total_week; $i++) {
            $week_array[$i + 1] = array($first_week_end + (7 * $i * $second_of_day) + 1, $first_week_end + (($i + 1) * $second_of_day * 7));
        }

        $week_array[$during_total_week + 1] = $last_week;

        if ($format != "second") {
            foreach ($week_array as $i => $week) {
                $week_array_of_date_format[$i] = array(date($format, $week[0]), date($format, $week[1]));
            }
            return $week_array_of_date_format;
        }

        return $week_array;
    }

    /**
     * func: getWeeks
     * 功能：获取一年内星期列表、每周起始时间
     */
    public static function tree($tree, $pid = 0, $pkname = 'pid') {
        $return = array();
        foreach ($tree as $leaf) {
            if ($leaf[$pkname] == $pid) {
                foreach ($tree as $subleaf) {
                    if ($subleaf[$pkname] == $leaf['id']) {
                        $leaf['children'] = self::tree($tree, $leaf['id'], $pkname);
                        break;
                    }
                }
                $return[] = $leaf;
            }
        }
        return $return;
    }

    /**
     * ---------------------------------------
     * 递归方式将tree结构转化为 表单中select可使用的格式
     * @param  array    $tree  树型结构的数组
     * @param  string $title 将格式化的字段
     * @param  int    $level 当前循环的层次,从0开始
     * @return array
     * ---------------------------------------
     */
    public static function formatTreeToList($tree, $level = 0, $title = null) {
        static $list = [];
        foreach ($tree as $value) {
            if ($title !== null) {
                /* 按层级格式的字符串 */
                $tmp_str = str_repeat("-", $level) . "└";
                if ($level == 0) {
                    $tmp_str = '';
                }
                $value[$title] = $tmp_str . $value[$title];
            }
            $value['level'] = $level;
            $temp = $value;
            if (isset($temp['children'])) {
                unset($temp['children']);
            }
            $list[] = $temp;
            if (array_key_exists('children', $value)) {
                self::formatTreeToList($value['children'], $level + 1, $title);
            }
        }
        return $list;
    }

    /**
     * func: getWeeks
     * 功能：获取一年内星期列表、每周起始时间
     */
    public static function select2tree($tree, $pid = 0, $pkname = 'pid') {
        $return = array();
        foreach ($tree as $leaf) {
            if ($leaf[$pkname] == $pid) {
                foreach ($tree as $subleaf) {
                    if ($subleaf[$pkname] == $leaf['id']) {
                        $leaf['children'] = self::select2tree($tree, $leaf['id'], $pkname);
                        break;
                    }
                }
                $return[$leaf['id']] = $leaf;
            }
        }
        return $return;
    }

    public static function formatRoute($data, &$result = []) {
        if (!is_array($data)) {
            return false;
        }
        foreach ($data as $key => $val) {
            $temp = [
                'label' => $val['label'],
                'url' => [$val['url']],
            ];
            if (isset($val['items']) && is_array($val['items'])) {
                self::formatRoute($val['items'], $temp['items']);
            }
            $result[] = $temp;
        }
    }

    public static function recursionFormat($data, &$result = []) {
        if (!is_array($data)) {
            return false;
        }
        foreach ($data as $key => $val) {
            $temp = [
                'label' => $val['name'],
                'url' => $val['route'],
            ];
            if (isset($val['children']) && is_array($val['children'])) {
                self::recursionFormat($val['children'], $temp['items']);
            }
            $result[] = $temp;
        }
    }

    public static function buildSwapCode($a) {
        for ($a = md5($a, true),
        $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
        $d = '',
        $f = 0; $f < 8; $g = ord($a[$f]),
        $d .= $s[( $g ^ ord($a[$f + 8]) ) - $g & 0x1F],
        $f++
        )
            ;
        $prefix = rand(0, 99);
        return sprintf('%02d', $prefix) . $d;
    }

    /**
     * UTF-8 aware parse_url() replacement.
     *
     * @return array
     */
    public static function mbParseUrl($url) {
        $enc_url = preg_replace_callback('%[^:/@?&=#]+%usD', function ($matches) {
            return urlencode($matches[0]);
        }, $url);
        $parts = parse_url($enc_url);
        if ($parts === false) {
            throw new \InvalidArgumentException('Malformed URL: ' . $url);
        }
        foreach ($parts as $name => $value) {
            $parts[$name] = urldecode($value);
        }
        return $parts;
    }

    

    public static function encrypt($string, $key = '563gs') {
        $key = md5($key);
        $key_length = strlen($key);
        $string = substr(md5($string . $key), 0, 8) . $string;
        $string_length = strlen($string);
        $rndkey = $box = array();
        $result = '';
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($key[$i % $key_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        return str_replace('=', '', base64_encode($result));
    }

    public static function decrypt($string, $key = '563gs') {
        $key = md5($key);
        $key_length = strlen($key);
        $string = base64_decode($string);
        $string_length = strlen($string);
        $rndkey = $box = array();
        $result = '';
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($key[$i % $key_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
            return substr($result, 8);
        }
        return '';
    }

}
