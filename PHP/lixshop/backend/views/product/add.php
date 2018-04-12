<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '添加商品';
?>

<div class="page-header">
    <h1>
        商品管理
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            添加商品
        </small>
    </h1>
</div>
<!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="tabbable">
            <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#faq-tab-1">
                        <i class="blue ace-icon fa fa-question-circle bigger-120"></i>
                        General
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#faq-tab-2">
                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        Account
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#faq-tab-3">
                        <i class="orange ace-icon fa fa-credit-card bigger-120"></i>
                        Payments
                    </a>
                </li>

                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="purple ace-icon fa fa-magic bigger-120"></i>

                        Misc
                    </a>
                </li>
                <!-- /.dropdown -->
            </ul>

            <div class="tab-content no-border padding-24">
                <div id="faq-tab-1" class="tab-pane fade in active">
                    <h1>FAQ-TAB-1</h1>
                </div>
                <div id="faq-tab-2" class="tab-pane fade">
                </div>
                <div id="faq-tab-3" class="tab-pane fade">
                </div>
                <div id="faq-tab-4" class="tab-pane fade">
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
