<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '注册';
?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">
            <?= $this->render('center'); ?>

            <div class="space-6"></div>

            <div class="position-relative">
                <div id="signup-box" class="signup-box widget-box no-border visible">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header green lighter bigger">
                                <i class="ace-icon fa fa-users blue"></i>
                                新用户注册
                            </h4>

                            <div class="space-6"></div>

                            <?php
                                function getTemplate($icon)
                                {
                                    return [
                                        'template' => '<label class="block clearfix"><span class="block input-icon input-icon-right">{input}<i class="ace-icon fa ' . $icon . '"></i></span></label>{error}',
                                        'labelOptions' => ['class' => 'block clearfix'],
                                        'inputOptions' => ['class' => 'form-control'],
                                    ];
                                }
                            ?>

                            <?php
                                $form = ActiveForm::begin([
                                    'options' => ['enctype' => 'multipart/form-data', 'id' => 'login-form'],
                                    'method' => 'post',
                                ]);
                                
                            ?>
                            
                            <fieldset>
                                <?= $form->field($model, 'mobile', getTemplate('fa-phone'))->input('mobile', ['placeholder' => "手机号码"]); ?>
                                <?= $form->field($model, 'username', getTemplate('fa-user'))->input('username', ['placeholder' => "用户名"]); ?>
                                <?= $form->field($model, 'password', getTemplate('fa-lock'))->passwordInput(['placeholder' => "密码"]) ?>
                                <?= $form->field($model, 're_password', getTemplate('fa-retweet'))->passwordInput(['placeholder' => "确认密码"]) ?>
                                
                                <label class="block">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl">
                                        我自愿接受
                                        <a href="#">用户协议</a>
                                    </span>
                                </label>

                                <div class="space-24"></div>

                                <div class="clearfix">
                                    <button type="reset" class="width-30 pull-left btn btn-sm">
                                        <i class="ace-icon fa fa-refresh"></i>
                                        <span class="bigger-110">Reset</span>
                                    </button>

                                    <?= Html::submitButton('提交', ['class'=>'width-65 pull-right btn btn-sm btn-success','name' =>'submit-button'])?>

                                </div>
                            </fieldset>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.signup-box -->
            </div>
            <!-- /.position-relative -->

        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
