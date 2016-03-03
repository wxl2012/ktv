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

<div class="container">
    <div class="alert alert-warning text-center" style="font-weight: 600;">
        请在10分钟20秒内完成支付!
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
                商户1
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                包房类型
            </div>
            <div class="col-xs-9">
                大包(1~6人)
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                预订日期
            </div>
            <div class="col-xs-9">
                2016-03-09 星期五 22:00
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                预订人数
            </div>
            <div class="col-xs-9">
                11人
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                备注
            </div>
            <div class="col-xs-9">

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
                132元
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
                132元
            </div>
        </div>
    </li>
</ul>

<div>
    付款方式
</div>
<ul class="list-group" style="margin-bottom: 10px;">
    <li class="list-group-item">
        <input type="radio" name="payment_type" id="payment_wxpay" value="wxpay"/>
        <label for="payment_wxpay" style="padding-left: 10px;">微信支付</label>
    </li>
    <li class="list-group-item hide">
        <input type="radio" name="payment_type" id="payment_credit_card" value="wxpay"/>
        <label for="payment_credit_card" style="padding-left: 10px;">信用卡支付</label>
    </li>
    <li class="list-group-item hide">
        <input type="radio" name="payment_type" id="payment_bank_card" value="wxpay"/>
        <label for="payment_bank_card" style="padding-left: 10px;">储蓄卡支付</label>
    </li>
</ul>

<div class="text-center" style="margin-bottom: 5px;">
    <i class="fa fa-exclamation-triangle" style="color: #f0ad4e;"></i> 请仔细核对订房信息, 成功后不支持退换
</div>

<div class="text-center">
    <a class="btn btn-danger" id="btnPay" style="width: 80%;">确认支付</a>
</div>

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

<?php \Request::forge('/common/mp/jssdk')->execute();?>

<script type="text/javascript">

    $(function(){
        $('#btnPay').click(function(){
            if($('input[name=payment_type]').val() == 'wxpay'){
                wxpay();
            }
        });

        $('#btnRetry').click(function(){
            if($('input[name=payment_type]').val() == 'wxpay'){
                wxpay();
            }
        });
    });


    function wxpay(){
        /*wx.ready(function(){
            wx.chooseWXPay({
                appId: "<?php //echo $appId; ?>",
                timestamp: "<?php //echo $timeStamp; ?>",
                nonceStr: "<?php //echo $nonceStr; ?>",
                package: "<?php //echo $package; ?>",
                signType: "<?php //echo $signType; ?>",
                paySign: "<?php //echo $paySign; ?>",
                success: function (res) {
                    window.location.href = "<?php echo \Input::get('to_url', false) ? urldecode(\Input::get('to_url')) : $to_url; ?>";
                },
                cancel: function(res){
                    window.location.href = "<?php echo \Input::get('to_url', false) ? urldecode(\Input::get('to_url')) : $to_url; ?>";
                },
                fail: function(res){
                    alert('支付失败!');
                }
            });
        });*/
    }

</script>
