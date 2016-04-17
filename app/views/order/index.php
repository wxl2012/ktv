<style type="text/css">
    .list-group{
        margin-bottom: 0px;
    }
</style>
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

    <div class="row">
        <div class="col-xs-12 text-center">
            <a href="javascript:;" id="btnMore" style="line-height: 28px; color: #aaa; text-decoration: none;">点击加载更多</a>
        </div>
    </div>
</div>
<script type="text/x-jquery-tmpl" id="orderItem">
    <div class="list-group-item" original-href="/ucenter/order/${id}">
        <div class="row" style="font-size: 9pt;">
            <div class="col-xs-7" style="padding-left: 5px; padding-right: 0px;">
                {{if order_type == 'SELL'}}
                    <label class="label label-primary">商</label>
                {{else order_type == 'MARKET'}}
                    <label class="label label-primary">活</label>
                {{else order_type == 'GROUPBUY'}}
                    <label class="label label-primary">团</label>
                {{else order_type == 'RESERVE'}}
                    <label class="label label-primary">预</label>
                {{/if}}
                订单号:${order_no}
            </div>
            <div class="col-xs-5 text-right" style="padding-left:0px; padding-right: 5px;">
                ${created_at}
            </div>
        </div>
    </div>
    {{each(i, detail) details}}
    <div class="list-group-item" original-href="/room/view/${detail.goods.id}">
        <div class="row">
            <div class="col-xs-4" style="padding-left: 2px; padding-right: 0px;">
                {{if order_type == 'SELL' || order_type == 'MARKET' || order_type == 'GROUPBUY'}}
                    <img src="${detail.goods.thumbnail}" alt="${detail.goods.title}" style="width: 100%; height: 100%;">
                {{else order_type == 'RESERVE'}}
                    <img src="http://img.zcool.cn/community/01763c56cec9a76ac7252ce6703011.jpg" alt="${detail.reserve.room.name}" style="width: 100%; height: 100%;">
                {{/if}}
            </div>
            <div class="col-xs-8">
                <dl style="margin-top: 0px; margin-bottom: 0px;">
                    {{if order_type == 'SELL' || order_type == 'MARKET' || order_type == 'GROUPBUY'}}
                        <dt>${detail.goods.title}</dt>
                        <dd>数量: ${detail.num} <span style="padding-left: 5px">单价: ${detail.price}</span></dd>
                    {{else order_type == 'RESERVE'}}
                        <dt><i class="fa fa-home"></i> ${detail.reserve.room.name}</dt>
                        <dd><i class="fa fa-calendar"></i> ${detail.reserve.reserve_date}</dd>
                        <dd><i class="fa fa-clock-o"></i> ${detail.reserve.reserve_time}</dd>
                        <dt><i class="fa fa-user"></i> ${detail.reserve.name}{{if detail.reserve.gender == 'Male'}}先生{{else}}女士{{/if}}</dt>
                    {{/if}}

                </dl>
            </div>
        </div>
    </div>
    {{/each}}
    <div class="list-group-item" style="margin-bottom: 10px; padding-top: 5px; padding-bottom: 5px;">
        <div class="row">
            <div class="col-xs-3" style="padding-left: 5px; padding-right: 0px; line-height: 28px;">
                <label class="label label-${order_label}">${order_status_title}</label>
            </div>
            <div class="col-xs-9 text-right" style="padding-left:0px; padding-right: 5px;">
            {{if order_status == 'NONE' || order_status == 'FINISH' || order_status == 'SELLER_CANCEL' || order_status == 'BUYER_CANCEL'}}
                <a class="btn btn-sm btn-danger">删除订单</a>
            {{else order_status == 'WAIT_PAYMENT'}}
                <a class="btn btn-sm btn-danger">取消订单</a>
                <a class="btn btn-sm btn-warning">去支付</a>
            {{/if}}
            </div>
        </div>
    </div>
</script>

<?php
\Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'tool.js', 'ucenter/order/index.js'], [], 'js-files', false);

?>