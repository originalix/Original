<?php  
  
  namespace backend\controllers;  
    
  use common\ToolBox\ToolExtend;  
  use Yii;  
  use yii\helpers\FileHelper;  
  use yii\helpers\Html;  
  use yii\helpers\Url;  
  use yii\imagine\Image;  
  use yii\web\Controller;  
  use yii\web\UploadedFile;  
    
  class UploadController extends Controller  
  {  
      public $enableCsrfValidation = false;//禁用Csrf验证  
    
    
      /** 
       * 上传图片到临时目录 
       * @return string 
       * @throws \yii\base\Exception 
       */  
      public function actionImage()  
      {  
          if (Yii::$app->request->isPost) {  
              $res = [];  
              $initialPreview = [];  
              $initialPreviewConfig = [];  
              $images = UploadedFile::getInstancesByName("UploadImage[image]");  
              if (count($images) > 0) {  
                  foreach ($images as $key => $image) {  
                      if ($image->size > 2048 * 1024) {  
                          $res = ['error' => '图片最大不可超过2M'];  
                          return json_encode($res);  
                      }  
                      if (!in_array(strtolower($image->extension), array('gif', 'jpg', 'jpeg', 'png'))) {  
                          $res = ['error' => '请上传标准图片文件, 支持gif,jpg,png和jpeg.'];  
                          return json_encode($res);  
                      }  
                      $dir = '/uploads/temp/';  
                      //生成唯一uuid用来保存到服务器上图片名称  
                      $pickey = ToolExtend::genuuid();  
                      $filename = $pickey . '.' . $image->getExtension();  
    
                      //如果文件夹不存在，则新建文件夹  
                      if (!file_exists(Yii::getAlias('@backend') . '/web' . $dir)) {  
                          FileHelper::createDirectory(Yii::getAlias('@backend') . '/web' . $dir, 777);  
                      }  
                      $filepath = realpath(Yii::getAlias('@backend') . '/web' . $dir) . '/';  
                      $file = $filepath . $filename;  
    
                      if ($image->saveAs($file)) {  
                          $imgpath = $dir . $filename;  
                          /*Image::thumbnail($file, 100, 100) 
                              ->save($file . '_100x100.jpg', ['quality' => 80]); 
  */  
                        //   array_push($initialPreview, "<img src='" . $imgpath . "' class='file-preview-image' alt='" . $filename . "' title='" . $filename . "'>");  
                          $config = [  
                              'caption' => $filename,  
                              'width' => '120px',  
                              'url' => '../upload/delete', // server delete action  
                              'key' => $pickey,  
                              'extra' => ['filename' => $filename]  
                          ];  
                          array_push($initialPreviewConfig, $config);  
    
                          $res = [  
                              "initialPreview" => $initialPreview,  
                              "initialPreviewConfig" => $initialPreviewConfig,  
                              "imgfile" => "<input name='image[]' id='" . $pickey . "' type='hidden' value='" . $imgpath . "'/>"  
                          ];  
                      }
                  }  
              }  
              return json_encode($res);  
          }  
      }  
    
      /** 
       * 删除上传到临时目录的图片 
       * @return string 
       */  
      public function actionDelete()  
      {
          $error = '';  
          if (Yii::$app->request->isPost) {  
              $dir = '/uploads/temp/';  
              $filename = yii::$app->request->post("filename");  
              $imgArr = yii::$app->request->post("imgArr");  
              $filename = $dir . $filename;  
              if (file_exists(Yii::getAlias('@backend') . '/web' . $filename)) {  
                  unlink(Yii::getAlias('@backend') . '/web' . $filename);  
              }  
    
              if (file_exists(Yii::getAlias('@backend') . '/web' . $filename . '_100x100.jpg')) {  
                  unlink(Yii::getAlias('@backend') . '/web' . $filename . '_100x100.jpg');  
              }  
          }  
        //   return json_encode($error);
        return json_encode(['code' => $imgArr]);  
      }  
  } 
