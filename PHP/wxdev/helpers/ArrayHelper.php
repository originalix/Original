<?php

namespace common\helpers;

use yii\helpers\BaseArrayHelper;

/**
 * 数组扩展工具类
 *
 * @author emhome<emhome@163.com>
 * @since 2.0
 */
class ArrayHelper extends BaseArrayHelper {

    /**
     * 数组转成字符串
     * @param string $array 待转数组
     * @param string $retainKey 是否保留键值
     * @return string
     */
    public static function toString($array, $retainKey = true) {
        $string = [];
        if (!is_array($array) || empty($array)) {
            return '';
        }
        foreach ($array as $key => $value) {
            $temp = '';
            if (is_array($value)) {
                $temp .= '[' . self::toString($value, $retainKey) . ']';
            } elseif (strval($value)) {
                $temp .= $value;
            } else {
                continue;
            }
            $comkey = '';
            if ($retainKey) {
                if (!is_numeric($key)) {
                    $comkey = $key . ':';
                }
            }
            $string[] = $comkey . $temp;
        }
        return implode("\n", $string);
    }

    /**
     * 按天生成日期范围数组
     * @param date $start 开始日期
     * @param date $end 结束日期
     * @return array 日期数组
     */
    public static function dateRange($start, $end) {
        $step = 86400;
        $starttime = strtotime($start);
        $endtime = strtotime($end);
        if ($starttime > $endtime) {
            $step *= -1;
        }
        if (abs($endtime - $starttime) <= $step) {
            $temp = date("Y-m-d", $starttime);
            return [$temp];
        }
        $format = function($value) {
            return date("Y-m-d", $value);
        };
        return array_map($format, range($starttime, $endtime, $step));
    }

    /**
     * 比较两个数组差集
     * @param array $array_1 数组1
     * @param array $array_2 数组2
     * @return array 差集数组
     */
    public static function diffrent($array_1, $array_2) {
        $src = $array_1;
        $dst = $array_2;
        if (count($array_1) < count($array_2)) {
            $src = $array_2;
            $dst = $array_1;
        }
        $dst = array_flip($dst);
        foreach ($src as $key => $item) {
            if (isset($dst[$item])) {
                unset($src[$key]);
            }
        }
        return $src;
    }

    /**
     * 数组批量追加键名
     * @param array $array 原始数组
     * @param string $string 追加内容
     * @param boolean $pos 追加位置 true前|false后
     * @return array 更改键名后的数组
     */
    public static function appendKeyname($array, $string, $pos = true) {
        $data = [];
        array_walk($array, function($v, $k) use (&$data) {
            $key = $pos == true ? $string . $k : $k . $string;
            $data[$key] = $v;
        });
        return $data;
    }

    /**
     * ------------------------------------------
     * 把返回的数据集转换成Tree
     * @param array $list 要转换的数据集
     * @param string $pk 主键
     * @param string $pid parent标记字段
     * @param string $child
     * @param int $root
     * @return array
     * ------------------------------------------
     */
    public static function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
        // 创建Tree
        $tree = [];
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = & $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] = & $list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent = & $refer[$parentId];
                        $parent[$child][] = & $list[$key];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * ---------------------------------------------------
     * 将list_to_tree的树还原成列表
     * @param  array $tree  原来的树
     * @param  string $child 孩子节点的键
     * @param  string $order 排序显示的键，一般是主键 升序排列
     * @param  array  $list  过渡用的中间数组，
     * @return array        返回排过序的列表数组
     * ---------------------------------------------------
     */
    public static function tree_to_list($tree, $child = '_child', $order = 'id', &$list = []) {
        if (is_array($tree)) {
            $refer = [];
            foreach ($tree as $key => $value) {
                $reffer = $value;
                if (isset($reffer[$child])) {
                    unset($reffer[$child]);
                    static::tree_to_list($value[$child], $child, $order, $list);
                }
                $list[] = $reffer;
            }
            $list = static::list_sort_by($list, $order, $sortby = 'asc');
        }
        return $list;
    }

    /**
     * --------------------------------------------------
     * 对查询结果集进行排序
     * @access public
     * @param array $list 查询结果
     * @param string $field 排序的字段名
     * @param string $sortby 排序类型 asc正向排序 desc逆向排序 nat自然排序
     * @return array|boolean
     * --------------------------------------------------
     */
    public static function list_sort_by($list, $field, $sortby = 'asc') {
        if (is_array($list)) {
            $refer = $resultSet = array();
            foreach ($list as $i => $data)
                $refer[$i] = &$data[$field];
            switch ($sortby) {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc':// 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val)
                $resultSet[] = &$list[$key];
            return $resultSet;
        }
        return false;
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
    public static function format_tree($tree, $title = 'title', $level = 0) {
        static $list;
        /* 按层级格式的字符串 */
        $tmp_str = str_repeat("　", $level) . "└";
        $level == 0 && $tmp_str = '';

        foreach ($tree as $key => $value) {
            $value[$title] = $tmp_str . $value[$title];
            $arr = $value;
            if (isset($arr['_child']))
                unset($arr['_child']);
            $list[] = $arr;
            if (array_key_exists('_child', $value)) {
                static::format_tree($value['_child'], $title, $level + 1);
            }
        }
        return $list;
    }

    /**
     * ---------------------------------------
     * 获取dropDownList的data数据，主要是二级栏目及以上数据，一级栏目可以用ArrayHelper::map()生成
     * 示例：ArrayHelper::listDataLevel(\backend\models\Menu::find()->asArray()->all(), 'id', 'title', 'id', 'pid')
     * @param $list array 由findAll或->all()生成的数据
     * @param $key string dropDownList的data数据的key
     * @param $value string dropDownList的data数据的value
     * @param string $pk 主键字段名
     * @param string $pid 父id字段名
     * @param int $root 根ID
     * @return array
     * ---------------------------------------
     */
    public static function listDataLevel($list, $key, $value, $pk = 'id', $pid = 'pid', $root = 0) {
        if (!is_array($list) || empty($list)) {
            return [];
        }
        $_tmp = $list;
        /* 判断$list是否由findAll生成的数据 */
        if (array_shift($_tmp) instanceof \yii\base\Model) {
            $list = array_map(function($record) {
                return $record->attributes;
            }, $list);
        }
        unset($_tmp);
        $tree = static::list_to_tree($list, $pk, $pid, '_child', $root);
        return static::map(static::format_tree($tree, $value), $key, $value);
    }

    /**
     * Fetch a flattened array of a nested array element.
     *
     * @param  array   $array
     * @param  string  $key
     * @return array
     */
    public static function array_fetch($array, $key) {
        foreach (explode('.', $key) as $segment) {
            $results = array();

            foreach ($array as $value) {
                if (array_key_exists($segment, $value = (array) $value)) {
                    $results[] = $value[$segment];
                }
            }

            $array = array_values($results);
        }

        return array_values($results);
    }

}
