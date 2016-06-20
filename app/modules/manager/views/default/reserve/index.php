<style type="text/css">
    .navbar-blue{
        background-color: #337ab7;
    }
    .list-group{
        margin-bottom: 0px;
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
                预订管理
            </div>
            <div class="col-xs-3">
            </div>
        </div>
    </div>
</nav>

<div style="height: 55px"></div>
<div class="container">
    <div class="list-group">
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <a href="javascript:;" id="btnMore" style="line-height: 28px; color: #aaa; text-decoration: none;">点击加载更多</a>
        </div>
    </div>
</div>
<script type="text/x-jquery-tmpl" id="orderItem">
    <div class="list-group-item" original-href="/reserver/view/${id}">
        <div class="row" style="font-size: 9pt;">
            <div class="col-xs-12" style="padding-left: 5px; padding-right: 0px;">
                下单时间:${create_date}
            </div>
        </div>
    </div>
    <div class="list-group-item" original-href="/reserver/view/${id}">
        <div class="row">
            <div class="col-xs-4" style="padding-left: 2px; padding-right: 0px;">
                <img src="http://img.zcool.cn/community/01763c56cec9a76ac7252ce6703011.jpg" alt="" style="width: 100%; height: 100%;">
            </div>
            <div class="col-xs-8">
                <dl style="margin-top: 0px; margin-bottom: 0px;">
                    <dt><i class="fa fa-home"></i> 大、中、小包间</dt>
                    <dd><i class="fa fa-calendar"></i> ${reserve_date}</dd>
                    <dd><i class="fa fa-clock-o"></i> ${reserve_time}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="list-group-item" style="margin-bottom: 10px; padding-top: 5px; padding-bottom: 5px;" data-id="${id}">
        <div class="row">
            <div class="col-xs-3" style="padding-left: 5px; padding-right: 0px; line-height: 28px;">
                {{if status == 'SUCCESS'}}
                    <label class="label label-success">预约成功</label>
                {{else status == 'TIMEOUT'}}
                    <label class="label label-warning">超时未使用</label>
                {{else status == 'USED'}}
                    <label class="label label-info">完成</label>
                {{/if}}
            </div>
            <div class="col-xs-9 text-right" style="padding-left:0px; padding-right: 5px;">
                {{if status == 'SUCCESS'}}
                    <a class="btn btn-sm btn-danger" role="cancel">取消预约</a>
                    <a class="btn btn-sm btn-primary" role="use">使用</a>
                {{else status == 'TIMEOUT'}}
                    <a class="btn btn-sm btn-danger" role="del">删除预约</a>
                {{else status == 'USED'}}
                {{/if}}
            </div>
        </div>
    </div>
</script>

<?php
$token = \Session::get('access_token', '');
$script = <<<js
    var _access_token = '{$token}';
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'tool.js', 'time_util.js', 'modules/manager/default/reserver/index.js'], [], 'js-files', false);

?>