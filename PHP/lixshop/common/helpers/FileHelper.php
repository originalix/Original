<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\helpers;

use Yii;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use common\helpers\Utils;

/**
 * File system helper.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Alex Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class FileHelper extends BaseFileHelper {

    //const IMAGE_TYPE = ['thumbnail', 'bmiddle', 'original'];

    public static $image_type = ['thumbnail', 'bmiddle', 'original'];

    const THUMBNAIL_TYPE = "thumbnail";
    const BMIDDLE_TYPE = "bmiddle";
    const ORIGINAL_TYPE = "original";

    /**
     * 上传文件并压缩到指定目录
     * @param	string	$ext    扩展名
     * @return	string	返回文件名
     */
    public static function upload($type = "default") {
        if (isset($_FILES)) {
            $uploadBasePath = Yii::getAlias('@uploads') . '/';
            $uploadPath = '/attachments/' . $type . '/' . date('Ym/d') . '/';
            $absolutePath = $uploadBasePath . $uploadPath;
            // print_r('看看绝对路径');
            // print_r($uploadBasePath);
            // print_r($absolutePath);
            // exit;
            self::dirCreate($absolutePath);

            $file = UploadedFile::getInstanceByName('image');
            $filename = self::generateUploadFileName($file->extension);
            $file->saveAs($absolutePath . $filename, false);

            if (!$file->getHasError()) {
                $imageInfo = FileHelper::imgCompress($absolutePath . $filename, $filename);
                return [
                    'status' => true,
                    'imgval' => $uploadPath . $filename,
                    'imgurls' => $imageInfo,
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
     * 压缩图片
     *
     * @param String $source 图片路径
     * @param String $filename 图片名称
     * @return Object
     */
    public static function imgCompress($source, $filename) {
        $imageUrls = array();

        $percent = 1;

        foreach (self::$image_type as $type) {
            $size = filesize($source) / 1024;
            // 大于100kb才压缩图片 否则使用原图
            if ($size > 100) {
                switch ($type) {
                    case self::THUMBNAIL_TYPE:
                        $percent = 0.3;
                        break;
                    case self::BMIDDLE_TYPE:
                        $percent = 0.5;
                        break;
                    case self::ORIGINAL_TYPE:
                        $percent = 1;
                        break;
                }
            }

            $uploadBasePath = Yii::getAlias('@uploads');
            $uploadPath = '/attachments/' . $type . '/' . date('Ym/d') . '/';
            $absolutePath = $uploadBasePath . $uploadPath;
            $absoluteUrl = Yii::getAlias('@attachUrl') . '/attachments/' . $type . '/' . date('Ym/d') . '/' . $filename;

            self::dirCreate($absolutePath);

            $imageInfo = (new ImageCompress($source, $percent, $absoluteUrl))->compressImg($absolutePath . $filename);

            $imageUrls[$type] = $imageInfo;
        }

        return $imageUrls;
    }

    /**
     * 生成上传文件的文件名
     *
     * @param	string	$ext    扩展名
     * @return	string	返回文件名
     */
    public static function generateUploadFileName($ext = false) {
        $tempname = Utils::random(32);
        if ($ext !== false) {
            return $tempname . '.' . $ext;
        }
        return $tempname;
    }

    /**
     * 远程文件是否存在
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
     * @param	string	$path	路径
     * @param	string	$mode	属性
     * @return	string	如果已经存在则返回true，否则为flase
     */
    public static function dirCreate($path, $mode = 0777) {
        if (is_dir($path)) {
            return true;
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
            // print_r($cur_dir);
            // exit;
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
            return false;
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

    public static function getExtension($file) {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    public static function gdExtension($full_path_to_image = '') {
        $extension = 'null';
        $image_type = exif_imagetype($full_path_to_image);
        if ($image_type) {
            $extension = image_type_to_extension($image_type, false);
        }
        $known_replacements = [
            'jpeg' => 'jpg',
            'tiff' => 'tif',
        ];
        $extension = '.' . str_replace(array_keys($known_replacements), array_values($known_replacements), $extension);

        return $extension;
    }

    /**
     * 阿里云OSS图片自动裁切
     * @param array $options
     * @param mixed $watermark
     * @param boolean $url
     * @return mixed
     */
    public static function remotePath($original) {
        if (!$original) {
            return null;
        }
        if (!Url::isRelative($original)) {
            return $original;
        }
        return Yii::getAlias('@attachUrl') . '/' . ltrim($original, '/');
    }

    /**
     * 获取远程图片的宽高和体积大小
     *
     * @param string $url 远程图片的链接
     * @param string $type 获取远程图片资源的方式, 默认为 curl 可选 fread
     * @param boolean $isGetFilesize 是否获取远程图片的体积大小, 默认false不获取, 设置为 true 时 $type 将强制为 fread 
     * @return false|array
     */
    public static function remoteImageSize($url, $type = 'curl', $isGetFilesize = false) {
        // 若需要获取图片体积大小则默认使用 fread 方式
        $type = $isGetFilesize ? 'fread' : $type;

        if ($type == 'fread') {
            // 或者使用 socket 二进制方式读取, 需要获取图片体积大小最好使用此方法
            $handle = fopen($url, 'rb');
            if (!$handle) {
                return false;
            }
            // 只取头部固定长度168字节数据
            $dataBlock = fread($handle, 168);
        } else {
            // 据说 CURL 能缓存DNS 效率比 socket 高
            $ch = curl_init($url);
            // 超时设置
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            // 取前面 168 个字符 通过四张测试图读取宽高结果都没有问题,若获取不到数据可适当加大数值
            curl_setopt($ch, CURLOPT_RANGE, '0-167');
            // 跟踪301跳转
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // 返回结果
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $dataBlock = curl_exec($ch);
            curl_close($ch);
            if (!$dataBlock) {
                return false;
            }
        }

        // 将读取的图片信息转化为图片路径并获取图片信息,经测试,这里的转化设置 jpeg 对获取png,gif的信息没有影响,无须分别设置
        // 有些图片虽然可以在浏览器查看但实际已被损坏可能无法解析信息 
        $size = getimagesize('data://image/jpeg;base64,' . base64_encode($dataBlock));
        if (empty($size)) {
            return false;
        }

        $result['width'] = $size[0];
        $result['height'] = $size[1];

        // 是否获取图片体积大小
        if ($isGetFilesize) {
            // 获取文件数据流信息
            $meta = stream_get_meta_data($handle);
            // nginx 的信息保存在 headers 里，apache 则直接在 wrapper_data 
            $dataInfo = isset($meta['wrapper_data']['headers']) ? $meta['wrapper_data']['headers'] : $meta['wrapper_data'];

            foreach ($dataInfo as $va) {
                if (preg_match('/length/iU', $va)) {
                    $ts = explode(':', $va);
                    $result['size'] = trim(array_pop($ts));
                    break;
                }
            }
        }

        if ($type == 'fread') {
            fclose($handle);
        }

        return $result;
    }

    /**
     * 阿里云OSS图片自动裁切
     * @param array $options
     * @param mixed $watermark
     * @param boolean $url
     * @return mixed
     */
    public static function imageResize($original, $options = [], $watermark = false, $url = false) {
        if (!$original) {
            return false;
        }
        $defaultOptions = [
            'width' => 300,
            'mode' => 'fill',
            'limit' => 0,
            'auto-orient' => 1,
            'quality' => 90,
            'format' => 'jpg',
        ];
        $options = ArrayHelper::merge($defaultOptions, $options);
        $configs = [];
        foreach ($options as $key => $vls) {
            if ($key == 'width') {
                $configs['resize'][] = 'w_' . $vls;
            } elseif ($key == 'height') {
                $configs['resize'][] = 'h_' . $vls;
            } elseif ($key == 'mode') {
                $configs['resize'][] = 'm_' . $vls;
            } elseif ($key == 'limit') {
                $configs['resize'][] = 'limit_' . $vls;
            } elseif ($key == 'quality') {
                $configs['quality'][] = 'q_' . $vls;
            } else {
                $configs[$key][] = $vls;
            }
        }
        //图片水印
        if ($watermark !== false) {
            $defaultWatermark = [
                'image' => 'cGFuZGEucG5nP3gtb3NzLXByb2Nlc3M9aW1hZ2UvcmVzaXplLHdfNTA=',
                't' => 90,
                'g' => 'se',
                'x' => 10,
                'y' => 10
            ];
            $watermark = ArrayHelper::merge($defaultWatermark, $watermark);
            foreach ($watermark as $key => $vls) {
                $configs['watermark'][] = $key . '_' . $vls;
            }
        }

        $original .= '?x-oss-process=image';
        foreach ($configs as $name => $conf) {
            $original .= '/' . $name . ',' . implode(',', $conf);
        }

        if ($url) {
            return $original;
        }

        $width = $options['width'];
        $height = isset($options['height']) ? $options['height'] : $width;

        if (!in_array($options['mode'], ['fill', 'pad', 'fixed'])) {
            list($width, $height) = getimagesize($original);
        }

        return [
            'url' => $original,
            'width' => $width,
            'height' => $height,
        ];
    }

}
