<?php
    $to_url = '';
?>
<style type="text/css">
    .row .col-xs-3{
        padding-right: 0px;
    }
    body{
        background-color: #f1f1f1;
    }
</style>
<style type="text/css">
    .navbar-blue{
        background-color: #337ab7;
    }
    .row .col-xs-3{
        padding-right: 0px;
    }
    .list-group-item:first-child{
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }
    .list-group-item:last-child{
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }
</style>

<nav class="navbar navbar-blue">
    <div class="container-fluid">
        <div class="row" style="line-height: 50px; margin-left: 0px; margin-right: 0px;">
            <div class="col-xs-2">
                <a href="javascript:history.back();">
                    <i class="fa fa-angle-left" style="font-size: 2em; color: #fff;"></i>
                </a>
            </div>
            <div class="col-xs-8 text-center" style="color: #fff; font-size: 13pt; font-weight: 600;">
                订单支付
            </div>
            <div class="col-xs-2">
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="alert alert-warning text-center" style="font-weight: 600;">
        请在<span id="timeDownHour">00</span>小时<span id="timeDownMinute">00</span>分钟<span id="timeDownSecond">00</span>秒内完成支付!
    </div>
</div>
    包房信息
</div>
<ul class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
               商户名称
            </div>
            <div class="col-xs-9">
                <?php echo $reserve->seller->name; ?>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                包房类型
            </div>
            <div class="col-xs-9">
                <?php echo $reserve->room->category->name; ?>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                预订日期
            </div>
            <div class="col-xs-9">
                <?php echo date('Y-m-d', $reserve->begin_at) . ' ' . \Model_RoomReserve::$_maps['week'][date('w')] . ' ' . date('H:i', $reserve->begin_at); ?>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                预订人数
            </div>
            <div class="col-xs-9">
                <?php echo $reserve->people_num; ?>人
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                备注
            </div>
            <div class="col-xs-9">
                <?php echo $reserve->remark; ?>
            </div>
        </div>
    </li>
</ul>

<div>
    结算信息
</div>
<ul class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                总价
            </div>
            <div class="col-xs-9">
                <span id="totalFee"><?php echo $reserve->room->price; ?></span>元
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                优惠券
            </div>
            <div class="col-xs-8">
                0张可用,点击添加
            </div>
            <div class="col-xs-1" style="padding-left: 0px">
                <i class="fa fa-angle-right"></i>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                还需支付
            </div>
            <div class="col-xs-9">
                <span id="original_fee"><?php echo $reserve->room->price; ?></span>元
            </div>
        </div>
    </li>
</ul>

<div>
    付款方式
</div>
<ul class="list-group" style="margin-bottom: 10px;">
    <li class="list-group-item">
        <input type="radio" name="payment_type" id="payment_wxpay" value="wxpay" checked/>
        <label for="payment_wxpay" style="padding-left: 10px;">微信支付</label>
    </li>
    <li class="list-group-item hide">
        <input type="radio" name="payment_type" id="payment_credit_card" value="credit"/>
        <label for="payment_credit_card" style="padding-left: 10px;">信用卡支付</label>
    </li>
    <li class="list-group-item hide">
        <input type="radio" name="payment_type" id="payment_bank_card" value="bank"/>
        <label for="payment_bank_card" style="padding-left: 10px;">储蓄卡支付</label>
    </li>
</ul>

<div class="text-center" style="margin-bottom: 5px;">
    <i class="fa fa-exclamation-triangle" style="color: #f0ad4e;"></i> 请仔细核对订房信息, 成功后不支持退换
</div>

<div class="text-center">
    <a class="btn btn-danger" id="btnPay" style="width: 80%;">确认支付</a>
</div>
<div style="height: 20px;"></div>

<!-- 支付确认框 -->
<div class="modal fade alert" id="payStatusModal" tabindex="-1" role="dialog" aria-labelledby="payStatusModalLabel">
    <div class="modal-dialog text-center" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <strong>请在微信支付完成支付！</strong>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6 text-center"><a id="btnRetry" href="javascript:;">重试</a></div>
                        <div class="col-xs-6 text-center" style="border-left: 1px solid #E5E5E5;"><a href="javascript:;">完成支付</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$token = \Security::fetch_token();

$appId = '';
$timeStamp = '';
$nonceStr = '';
$package = '';
$signType = '';
$paySign = '';
$to_url = \Input::get('to_url', false) ? urldecode(\Input::get('to_url')) : $to_url;
$script = <<<js
    var _access_token = '';
    var _total_fee = {$reserve->room->price};
    var _original_fee = {$reserve->room->price};
    var _preferential_fee = 0;
    var _preferential = [];
    var _seller_id = {$reserve->seller_id};
    var _reserve_id = {$reserve->id};
    var _expire_at = {$reserve->created_at} + 60 * 30;
    var _to_url = '{$to_url}';
    var _app_id = '{$appId}';
    var _time_stamp = '{$timeStamp}';
    var _nonce_str = '{$nonceStr}';
    var _package = '{$package}';
    var _sign_type = '{$signType}';
    var _pay_sign = '{$paySign}';
    var _token = '{$token}';
js;

\Asset::js($script, [], 'before-script', true);
\Asset::js(['time_util.js', 'icheck/icheck.min.js', 'pay/pay_confirm.js', ], [], 'js-files', false);

\Asset::css(['icheck/skins/flat/orange.css'], [], 'css-files', false);

?>
