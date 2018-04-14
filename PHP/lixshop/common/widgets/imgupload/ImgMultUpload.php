<?php  
namespace common\widgets\imgupload;  
  
use yii\base\Widget;  
use yii\helpers\Html;  
  
class ImgMultUpload extends Widget  
{  
    //标签名称  
    public $label;  
  
    //初始化图片数组  
    public $imgarr;  
  
    //图片存储文件夹目录  
    public $imagedir;  

    public $model;
    public $attribute;
    public $form;
  
    private $initialPreview = [];  
    private $initialPreviewConfig = [];  
  
    public function init()  
    {  
        parent::init();  
        if ($this->label === null) {  
            $this->label = '上传图片';
        }  
  
        if (is_array($this->imgarr) && count($this->imgarr) > 0) {  
            foreach ($this->imgarr as $key => $value) {  
                $config = ['caption' => $value,  
                    'width' => '120px',  
                    'url' => '../upload/delete', // server delete action  
                    'key' => $value,  
                    'extra' => ['filename' => $value]];  
                array_push($this->initialPreview, Html::img($this->imagedir . $value, [  
                    'class' => 'file-preview-image',
                    'alt' => 'Image',
                    'title' => 'Image'
                    ]));
                array_push($this->initialPreviewConfig, $config);
            }
            
        }  
    }  
  
    public function run()  
    {  
        return $this->render('imgfiled', [  
            'form' => $this->form,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'label' => $this->label,  
            'initialPreview' => $this->initialPreview,  
            'initialPreviewConfig' => $this->initialPreviewConfig  
        ]);  
    }
} 
