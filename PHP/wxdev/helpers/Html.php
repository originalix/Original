<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\helpers;

use Yii;
use yii\helpers\Url;

/**
 * Html provides a set of static methods for generating commonly used HTML tags.
 *
 * Nearly all of the methods in this class allow setting additional html attributes for the html
 * tags they generate. You can specify, for example, `class`, `style` or `id` for an html element
 * using the `$options` parameter. See the documentation of the [[tag()]] method for more details.
 *
 * For more details and usage information on Html, see the [guide article on html helpers](guide:helper-html).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Html extends \yii\helpers\BaseHtml {

    /**
     * Generates an image tag.
     */
    public static function img($src, $options = [], $cdn = false) {
        $remote = $cdn ? Yii::getAlias('@attachUrl') : '';
        return parent::img($remote . $src, $options);
    }

    /**
     * Generates an video tag.
     * <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="100%" height="320" data-setup='{"poster": "<?= $model->cover ?>"}'>
      <source src="http://7351.mpull.live.lecloud.com/live/<?php echo $model->id; ?>/desc.m3u8" type="application/x-mpegURL">
      </video>
     */
    public static function video($source = [], $options = []) {
        $sourceTag = static::tag('source', '', $source);
        return static::tag('video', $sourceTag, $options);
    }

    public static function ajaxModal($text, $url = null, $options = [], $content = []) {
        $options['label'] = $text;
        if ($url !== null) {
            $options['href'] = Url::to($url);
        }
        $configs = ['toggleButton' => $options];
        if (!empty($content)) {
            $configs = ArrayHelper::merge($configs, $content);
        }
        return \metronic\ModalActiveForm::widget($configs);
    }

    public static function normalModal($text, $url = null, $options = [], $content = []) {
        if ($url !== null) {
            $options['href'] = Url::to($url);
        }
        $options['label'] = $text;

        $toggleButton = [
            'toggleButton' => $options,
        ];
        if (empty($content)) {
            $content['closeButton'] = false;
            $content['header'] = null;
        }
        $configs = ArrayHelper::merge($toggleButton, $content);
        return \metronic\Modal::widget($configs);
    }

    public static function bootModal($text, $url = null, $options = [], $content = []) {
        if ($url !== null) {
            $options['href'] = Url::to($url);
        }
        $options['label'] = $text;

        $toggleButton = [
            'toggleButton' => $options,
        ];
        $configs = ArrayHelper::merge($toggleButton, $content);
        return \yii\bootstrap\Modal::widget($configs);
    }

}
