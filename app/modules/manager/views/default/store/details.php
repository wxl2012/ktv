<style type="text/css">
    .navbar-blue{
        background-color: #337ab7;
    }
    .list-group{
        margin-bottom: 0px;
    }
    input, select{
        padding-left: 5px !important;
        padding-right: 5px !important;
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
                店铺资料设置
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
                    <div class="col-xs-3 tit">名称</div>
                    <div class="col-xs-9">
                        <input type="text" id="name" name="name" value="<?= $seller->name; ?>" placeholder="店铺名称" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">简介</div>
                    <div class="col-xs-9">
                        <textarea name="summary" class="form-control" placeholder="店铺简介"><?= htmlspecialchars_decode($seller->summary); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">电话</div>
                    <div class="col-xs-9">
                        <input type="text" id="tel" name="tel" value="<?= $seller->tel; ?>" placeholder="预订电话" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">地址</div>
                    <div class="col-xs-9">
                        <input type="text" id="address" name="address" value="<?= $seller->address; ?>" placeholder="店铺地址" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">营业状态</div>
                    <div class="col-xs-9">
                        <select class="form-control" name="status">
                            <option value="OPEN"<?= $seller->status == 'OPEN' ? ' selected' : ''; ?>>营业中</option>
                            <option value="CLOSE"<?= $seller->status == 'CLOSE' ? ' selected' : ''; ?>>暂停营业</option>
                        </select>
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

\Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'tool.js', 'modules/manager/default/store/details.js'], [], 'js-files', false);
?>