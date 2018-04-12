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

                            <form>
                                <fieldset>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="用户名" />
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>
                                    </label>

                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control" placeholder="密码" />
                                            <i class="ace-icon fa fa-lock"></i>
                                        </span>
                                    </label>

                                    <div class="space"></div>

                                    <div class="clearfix">
                                        <label class="inline">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl">记住我</span>
                                        </label>

                                        <button type="button" class="width-35 pull-right btn btn-sm btn-primary">
                                            <i class="ace-icon fa fa-key"></i>
                                            <span class="bigger-110">登录</span>
                                        </button>
                                    </div>

                                    <div class="space-4"></div>
                                </fieldset>
                            </form>

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
                                <a href="#" data-target="#signup-box" class="user-signup-link">
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
