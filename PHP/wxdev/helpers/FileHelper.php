<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\helpers;

use Yii;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use app\helpers\Utils;

/**
 * File system helper.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Alex Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class FileHelper extends BaseFileHelper {

    /**
     * 上传文件
     * @param	string	$ext    扩展名
     * @return	string	返回文件名
     */
    public static function upload($type = "default") {
        if (isset($_FILES)) {
            $uploadBasePath = Yii::getAlias('@uploads') . '/';
            $uploadPath = '/attachments/' . $type . '/' . date('Ym/d') . '/';
            $absolutePath = $uploadBasePath . $uploadPath;
            self::dirCreate($absolutePath);
            $file = UploadedFile::getInstanceByName('image');
            $filename = self::generateUploadFileName($file->extension);
            $file->saveAs($absolutePath . $filename);
            if (!$file->getHasError()) {
                // $this->remotePath = $uploadPath . $filename;
                return [
                    'status' => true,
                    'imgval' => $uploadPath . $filename,
                    'imgurl' => Yii::getAlias('@attachUrl') . $uploadPath . $filename
                ];
            } else {
                return [
                    'status' => false,
                    'msg' => $file->error
                ];
            }
        } else {
            return [
                'status' => false,
                'msg' => '未上传图片'
            ];
        }
    }

    /**
     * 生成上传文件的文件名
     *
     * @param	string	$ext    扩展名
     * @return	string	返回文件名
     */
    public static function generateUploadFileName($ext = false) {
        $tempname = Utils::random(6) . md5(Yii::$app->user->id . time() . Utils::random(4));
        if ($ext !== false) {
            return $tempname . '.' . $ext;
        }
        return $tempname;
    }

    /**
     * 远程图片是否存在
     *
     * @param string $url 远程文件url地址
     * @return boolean
     */
    public static function remoteFileExists($url) {
        $file_headers = get_headers($url);
        if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            return false;
        }
        return true;
    }

    /**
     * 转化 \ 为 /
     * 
     * @param	string	$path	路径
     * @return	string	路径
     */
    public static function dirPath($path) {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') {
            $path = $path . '/';
        }
        return $path;
    }

    /**
     * 创建目录
     * 
     * @param	string	$path	路径
     * @param	string	$mode	属性
     * @return	string	如果已经存在则返回true，否则为flase
     */
    public static function dirCreate($path, $mode = 0777) {
        if (is_dir($path)) {
            return TRUE;
        }
        $path = self::dirPath($path);
        $temp = explode('/', $path);
        $cur_dir = '';
        $max = count($temp) - 1;
        for ($i = 0; $i < $max; $i++) {
            $cur_dir .= $temp[$i] . '/';
            if (is_dir($cur_dir)) {
                continue;
            }
            mkdir($cur_dir, 0777, true);
            chmod($cur_dir, 0777);
        }
        return is_dir($path);
    }

    /**
     * 拷贝目录及下面所有文件
     * 
     * @param	string	$fromdir	原路径
     * @param	string	$todir		目标路径
     * @return	string	如果目标路径不存在则返回false，否则为true
     */
    public static function dirCopy($fromdir, $todir) {
        $fromdir = self::dirPath($fromdir);
        $todir = self::dirPath($todir);
        if (!is_dir($fromdir)) {
            return FALSE;
        }
        if (!is_dir($todir)) {
            self::dirCreate($todir);
        }
        $list = glob($fromdir . '*');
        if (!empty($list)) {
            foreach ($list as $v) {
                $path = $todir . basename($v);
                if (is_dir($v)) {
                    self::dirCopy($v, $path);
                } else {
                    copy($v, $path);
                    chmod($path, 0777);
                }
            }
        }
        return TRUE;
    }

    /**
     * 转换目录下面的所有文件编码格式
     * 
     * @param	string	$in_charset		原字符集
     * @param	string	$out_charset	目标字符集
     * @param	string	$dir			目录地址
     * @param	string	$fileexts		转换的文件格式
     * @return	string	如果原字符集和目标字符集相同则返回false，否则为true
     */
    public static function dirIconv($in_charset, $out_charset, $dir, $fileexts = 'php|html|htm|shtml|shtm|js|txt|xml') {
        if ($in_charset == $out_charset) {
            return false;
        }
        $list = self::dirList($dir);
        foreach ($list as $v) {
            if (pathinfo($v, PATHINFO_EXTENSION) == $fileexts && is_file($v)) {
                file_put_contents($v, iconv($in_charset, $out_charset, file_get_contents($v)));
            }
        }
        return true;
    }

    /**
     * 列出目录下所有文件
     * 
     * @param	string	$path		路径
     * @param	string	$exts		扩展名
     * @param	array	$list		增加的文件列表
     * @return	array	所有满足条件的文件
     */
    public static function dirList($path, $exts = '', $list = array()) {
        $path = self::dirPath($path);
        $files = glob($path . '*');
        foreach ($files as $v) {
            if (!$exts || pathinfo($v, PATHINFO_EXTENSION) == $exts) {
                $list[] = $v;
                if (is_dir($v)) {
                    $list = self::dirList($v, $exts, $list);
                }
            }
        }
        return $list;
    }

    /**
     * 设置目录下面的所有文件的访问和修改时间
     * 
     * @param	string	$path		路径
     * @param	int		$mtime		修改时间
     * @param	int		$atime		访问时间
     * @return	array	不是目录时返回false，否则返回 true
     */
    public static function dirTouch($path, $mtime = TIME, $atime = TIME) {
        if (!is_dir($path)) {
            return false;
        }
        $path = self::dirPath($path);
        if (!is_dir($path)) {
            touch($path, $mtime, $atime);
        }
        $files = glob($path . '*');
        foreach ($files as $v) {
            is_dir($v) ? self::dirTouch($v, $mtime, $atime) : touch($v, $mtime, $atime);
        }
        return true;
    }

    /**
     * 目录列表
     * 
     * @param	string	$dir		路径
     * @param	int		$parentid	父id
     * @param	array	$dirs		传入的目录
     * @return	array	返回目录列表
     */
    public static function dirTree($dir, $parentid = 0, $dirs = array()) {
        global $id;
        if ($parentid == 0) {
            $id = 0;
        }
        $list = glob($dir . '*');
        foreach ($list as $v) {
            if (is_dir($v)) {
                $id++;
                $dirs[$id] = array('id' => $id, 'parentid' => $parentid, 'name' => basename($v), 'dir' => $v . '/');
                $dirs = self::dirTree($v . '/', $id, $dirs);
            }
        }
        return $dirs;
    }

    /**
     * 删除目录及目录下面的所有文件
     * 
     * @param	string	$dir		路径
     * @return	bool	如果成功则返回 TRUE，失败则返回 FALSE
     */
    public static function dirDelete($dir) {
        $dir = self::dirPath($dir);
        if (!is_dir($dir)) {
            return FALSE;
        }
        $list = glob($dir . '*');
        foreach ($list as $v) {
            is_dir($v) ? self::dirDelete($v) : @unlink($v);
        }
        return rmdir($dir);
    }

}
