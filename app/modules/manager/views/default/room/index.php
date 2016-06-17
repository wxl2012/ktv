<style type="text/css">
    .navbar-blue{
        background-color: #337ab7;
    }
    .list-group{
        margin-bottom: 0px;
    }
    .tit{
        line-height: 27px;
        text-align: right;
        padding-right: 0px;
    }
</style>
<nav class="navbar navbar-blue navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-3" style="line-height: 50px;">
                <a href="javascript:history.back(-1);">
                    <i class="fa fa-angle-left" style="font-size: 2em; color: #fff;"></i>
                </a>
            </div>
            <div class="col-xs-6 text-center" style="color: #fff; font-size: 13pt; font-weight: 600;line-height: 50px;">
                包房设置
            </div>
            <div class="col-xs-3">
            </div>
        </div>
    </div>
</nav>

<div style="height: 55px"></div>
<div class="container-fluid">
    <form id="frmReserve">
        <div class="list-group">

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">大包</div>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" id="big_num" name="big_num" value="" placeholder="数量" class="form-control"/>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" id="big_fee" name="big_fee" value="" placeholder="金额" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">中包</div>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" id="big_num" name="big_num" value="" placeholder="数量" class="form-control"/>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" id="big_fee" name="big_fee" value="" placeholder="金额" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">小包</div>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" id="big_num" name="big_num" value="" placeholder="数量" class="form-control"/>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" id="big_fee" name="big_fee" value="" placeholder="金额" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
    <div class="row" style="margin-top: 10px">
        <div class="col-xs-12">
            <div class="alert alert-danger" style="display: none;margin: 0px 15px;"></div>
        </div>
        <div class="col-xs-12 text-center" style="padding: 10px 0px;">
            <a id="btnSubmit" class="btn btn-info" style="width: 80%;">保存</a>
        </div>
    </div>
</div>

<?php
$token = \Session::get('access_token', '');
$script = <<<js
    var _access_token = '{$token}';
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'tool.js', 'modules/manager/default/room/index.js'], [], 'js-files', false);
?>