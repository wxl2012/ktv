<style type="text/css">
    body{
        background-color: #F5F5F5;
        font-size: 9pt;
    }
    .list-group-item:first-child{
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }
    .list-group-item:last-child{
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    #goodsItems .list-group-item .col-xs-2{
        padding: 0px;
    }
    #goodsItems .list-group-item{
        color: #aaa;
    }
    .title{
        font-size: 10pt;
        font-weight: 600;
        color: #333 !important;
    }
    .section-title{
        padding-left: 10px;
        font-size: 11pt;
    }
</style>
<div style="height: 10px;">
</div>
<div class="container">
    <div class="alert alert-warning text-center" style="font-weight: 600;">
        请在
        <span id="timeDownHour">00</span>小时
        <span id="timeDownMinute">00</span>分钟
        <span id="timeDownSecond">00</span>秒内完成支付!
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-xs-12">
            <div class="section-title">购物清单</div>
            <ul class="list-group" id="goodsItems">
                <li class="list-group-item title">
                    <div class="row">
                        <div class="col-xs-6">
                            项目
                        </div>
                        <div class="col-xs-2">
                            数量
                        </div>
                        <div class="col-xs-2">
                            单价
                        </div>
                        <div class="col-xs-2">
                            小计
                        </div>
                    </div>
                </li>
            </ul>

            <div class="section-title">结算信息</div>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-4">
                            应付金额
                        </div>
                        <div class="col-xs-8 text-right" id="labTotalFee">
                            0
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-4">
                            优惠金额
                        </div>
                        <div class="col-xs-8 text-right" id="labPreferentialFee">
                            0
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-4">
                            实付金额
                        </div>
                        <div class="col-xs-8 text-right" id="labOriginalFee">
                            0
                        </div>
                    </div>
                </li>
            </ul>

            <div id="coupons" style="display:none;">
                <div class="section-title">优惠券</div>
                <ul class="list-group">

                </ul>
            </div>

            <div class="text-center" style="margin-bottom: 10px;">
                <a id="btnPay" class="btn btn-danger" style="width: 90%;">立即支付</a>
            </div>

            <div class="text-center">
                <img src="/assets/img/wxpay.png" alt="" style="width: 15px;" />
                <span style="color: #aaa;">微信支付</span>
                <a href="javascript:;" id="btnChangePayment">更换</a>
            </div>

            <div class="list-group" id="payments" style="display: none;">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-xs-12">
                            支付方式
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-xs-1" style="padding-right: 0px; line-height: 45px;">
                            <input type="radio" name="payment" value="wxpay" checked/>
                        </div>
                        <div class="col-xs-3">
                            <img src="/assets/img/wxpay.png" alt="" style="width: 100%;" />
                        </div>
                        <div class="col-xs-8" style="padding-left: 0px;">
                            <p>微信支付</p>
                            <p style="color: #e0e0e0;">推荐开通微信支付的用户使用</p>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-xs-1" style="padding-right: 0px; line-height: 45px;">
                            <input type="radio" name="payment" value="alipay"/>
                        </div>
                        <div class="col-xs-3">
                            <img src="/assets/img/alipay.jpg" alt="" style="width: 100%;" />
                        </div>
                        <div class="col-xs-8" style="padding-left: 0px;">
                            <p>微信支付</p>
                            <p style="color: #e0e0e0;">推荐开通支付宝的用户使用</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script id="couponItem" type="text/x-jquery-tmpl">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-2">
                <input type="checkbox" value="">
            </div>
            <div class="col-xs-8">
                满100减10元
            </div>
            <div class="col-xs-2 text-right">
                100
            </div>
        </div>
    </li>
</script>

<script id="goodsItem" type="text/x-jquery-tmpl">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-6">
                ${goods.name}
            </div>
            <div class="col-xs-2">
                ${num}
            </div>
            <div class="col-xs-2">
                ${price}
            </div>
            <div class="col-xs-2">
                ${num * price}
            </div>
        </div>
    </li>
</script>

<?php
$uid = \Auth::check() ? \Auth::get_user()->id : 0;
$createdAt = $order->created_at;

$account = \Session::get('WXAccount', false);
$account_id = $account ? $account->id : 0;
$openid = \Session::get('OpenID', false);
$open_id = $openid ? $openid->openid : '';

$script = <<<js
    var _order_id = {$order->id};
    var _user_id = {$uid};
    var _payment = 'wxpay';
    var _end_at = {$createdAt} + 60 * 60 * 24;
    var _account_id = {$account_id};
    var _open_id = '{$open_id}';
js;

\Asset::js($script, [], 'before-script', true);
\Asset::js(['tools.js', 'icheck/icheck.min.js', 'jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'modules/order/confirm.js'], [], 'js-files', false);
\Asset::css(['icheck/skins/square/blue.css'], [], 'css-files', false);
?>