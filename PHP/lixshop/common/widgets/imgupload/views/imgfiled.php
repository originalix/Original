<?php  
  
use kartik\file\FileInput;  
use yii\helpers\Url;  
use yii\bootstrap\ActiveForm;
?>  
  
<div class="form-group">  
    <div class="">
        <?= $form->field($model, $attribute)->label($label)->widget(FileInput::classname(), [
            'name' => 'ImgSelect',  
            'language' => 'zh-CN',  
            'options' => ['multiple' => true, 'accept' => 'image/*'],  
            'pluginOptions' => [  
                'initialPreview' => $initialPreview,  
                'initialPreviewConfig' => $initialPreviewConfig,  
                'allowedPreviewTypes' => ['image'],  
                'allowedFileExtensions' => ['jpg', 'gif', 'png'],  
                'previewFileType' => 'image',  
                'overwriteInitial' => false,  
                'browseLabel' => '选择图片',  
                'msgFilesTooMany' => "选择上传的图片数量({n}) 超过允许的最大图片数{m}！",  
                'maxFileCount' => 5,//允许上传最多的图片5张  
                'maxFileSize' => 2048,//限制图片最大200kB  
                'uploadUrl' => Url::to(['/upload/image']),  
                //'uploadExtraData' => ['testid' => 'listimg'],  
                'uploadAsync' => true,//配置异步上传还是同步上传  
            ],
            'pluginEvents' => [  
                'filepredelete' => "function(event, key) {  
                        return (!confirm('确认要删除'));  
                    }",  
                'fileuploaded' => 'function(event, data, previewId, index) {  
                        $(event.currentTarget.closest("form")).append(data.response.imgfile);  
                    }',  
                'filedeleted' => 'function(event, key) {  
                        $(event.currentTarget.closest("form")).find("#"+key).remove();  
                        return;
                    }',  
            ]
        ]); ?>
    </div>  
</div>  
