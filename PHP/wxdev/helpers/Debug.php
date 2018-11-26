<?php

namespace common\helpers;

use Yii;

/**
 * 自定义实用工具类
 *
 * @author emhome<emhome@163.com>
 * @since 2.0
 */
class Debug {

    //调试输出
    public static function dump($data) {
        header('Content-type: text/html; charset=utf-8');
        echo '<pre class="debug">';
        if (is_array($data)) {
            print_r($data);
        } elseif (is_object($data)) {
            var_dump($data);
        } else {
            echo $data;
        }
        echo '</pre>';
    }

    public static function sql($query) {
        $sql = $query->createCommand()->getRawSql();
        Yii::error($sql);
        return $sql;
    }

}
