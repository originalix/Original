<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '登录';
?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">
            <?= $this->render('center'); ?>

            <div class="space-6"></div>

            <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header blue lighter bigger">
                                <i class="ace-icon fa fa-coffee green"></i>
                                请输入你的账号信息
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
                                <?= $form->field($model, 'username', getTemplate('fa-user'))->input('mobile', ['placeholder' => "用户名"]); ?>
                                <?= $form->field($model, 'password', getTemplate('fa-lock'))->passwordInput(['placeholder' => "密码"]) ?>
                            
                                <div class="space"></div>

                                <div class="clearfix">
                                    <label class="inline">
                                        <?= $form->field($model, 'rememberMe', [
                                            'template' => '{input}',
                                            'inputOptions' => [
                                                'class' => 'ace',
                                            ],
                                        ])->checkbox([
                                            'label' => '记住我',
                                        ]) ?>
                                    </label>
                                    
                                    <?= Html::submitButton('登录', [
                                        'class'=>'width-35 pull-right btn btn-sm btn-primary',
                                        'name' =>'submit-button',
                                        'template' => '<i class="ace-icon fa fa-key"></i>'
                                        ])?>

                                </div>

                                <div class="space-4"></div>

                            </fieldset>
                            <?php ActiveForm::end(); ?>
                            
                        </div>
                        <!-- /.widget-main -->

                        <div class="toolbar clearfix">
                            <div>
                                <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    忘记密码？
                                </a>
                            </div>

                            <div>
                                <a href="./signup" data-target="#signup-box" class="user-signup-link">
                                    注册
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.login-box -->
            </div>
            <!-- /.position-relative -->
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
