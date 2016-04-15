<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-3" style="line-height: 50px;">
                <a href="javascript:history.back(-1);"><i class="fa fa-angle-left" style="font-size: 1.5em;"></i></a>
            </div>
            <div class="col-xs-6 text-center" style="line-height: 50px;">
                我的订单
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
</div>
<script type="text/x-jquery-tmpl" id="orderItem">
    <div class="list-group-item">
        <div class="row">
            <div class="col-xs-7" style="padding-left: 5px; padding-right: 0px;">
                订单号:${order_no}
            </div>
            <div class="col-xs-5 text-right" style="padding-left:0px; padding-right: 5px;">
                ${created_at}
            </div>
        </div>
    </div>
    {{each(i, detail) details}}
    <div class="list-group-item">
        <div class="row">
            <div class="col-xs-4" style="padding-left: 2px; padding-right: 0px;">
                <img src="${detail.goods.thumbnail}" alt="${detail.goods.title}" style="width: 100%; height: 100%;">
            </div>
            <div class="col-xs-8">
                <dl style="margin-top: 0px; margin-bottom: 0px;">
                    <dt>${detail.goods.title}</dt>
                    <dd>数量: ${detail.num} <span style="padding-left: 5px">单价: ${detail.price}</span></dd>
                </dl>
            </div>
        </div>
    </div>
    {{/each}}
    <div class="list-group-item" style="margin-bottom: 10px; padding-top: 5px; padding-bottom: 5px;">
        <div class="row">
            <div class="col-xs-3" style="padding-left: 5px; padding-right: 0px; line-height: 28px;">
                <label class="label label-danger">${order_status}</label>
            </div>
            <div class="col-xs-9 text-right" style="padding-left:0px; padding-right: 5px;">
                <a class="btn btn-sm btn-danger">关闭订单</a>
                <a class="btn btn-sm btn-danger">删除订单</a>
                <a class="btn btn-sm btn-warning">去支付</a>
            </div>
        </div>
    </div>
</script>

<?php
\Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'tool.js', 'ucenter/order/index.js'], [], 'js-files', false);

?>