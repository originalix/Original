<?php

/* @var $this yii\web\View */

$this->title = '注册';
?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">
            <div class="center">
                <h1>
                    <i class="ace-icon fa fa-leaf green"></i>
                    <span class="red">后台</span>
                    <span class="white grey" id="id-text2">管理系统</span>
                </h1>
                <h4 class="blue" id="id-company-text">&copy; 衣之恋</h4>
            </div>

            <div class="space-6"></div>

            <div class="position-relative">
                <div id="signup-box" class="signup-box widget-box no-border visible">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header green lighter bigger">
                                <i class="ace-icon fa fa-users blue"></i>
                                New User Registration
                            </h4>

                            <div class="space-6"></div>
                            <p> Enter your details to begin: </p>

                            <form>
                                <fieldset>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="email" class="form-control" placeholder="Email" />
                                            <i class="ace-icon fa fa-envelope"></i>
                                        </span>
                                    </label>

                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="Username" />
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>
                                    </label>

                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control" placeholder="Password" />
                                            <i class="ace-icon fa fa-lock"></i>
                                        </span>
                                    </label>

                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control" placeholder="Repeat password" />
                                            <i class="ace-icon fa fa-retweet"></i>
                                        </span>
                                    </label>

                                    <label class="block">
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl">
                                            I accept the
                                            <a href="#">User Agreement</a>
                                        </span>
                                    </label>

                                    <div class="space-24"></div>

                                    <div class="clearfix">
                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                            <i class="ace-icon fa fa-refresh"></i>
                                            <span class="bigger-110">Reset</span>
                                        </button>

                                        <button type="button" class="width-65 pull-right btn btn-sm btn-success">
                                            <span class="bigger-110">Register</span>

                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
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
