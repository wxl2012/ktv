<style type="text/css">
    .img-circle{
        background-color: green;
        width: 100px;
        height: 100px;
        line-height: 100px;
        padding-top: 13px;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div class="container">
    <div class="text-center" style="padding-top: 20px;">
        <?php $status = $order->order_status == 'PAYMENT_SUCCESS';?>
        <i class="fa fa-<?php echo $status ? 'check' : 'times'; ?>-circle" style="font-size: 8em; color: <?php echo $status ? '#5cb85c' : '#d9534f'; ?>"></i>
    </div>
    <div class="text-center" style="padding-top: 20px; font-size: 20pt;">
        <?php echo $status ? '支付完成' : '支付失败';?>
    </div>
    <div class="text-center" style="padding-top: 20px; font-size: 20pt;">
        <i class="fa fa-cny"></i>
        <?php echo $order->original_fee;?>
    </div>
    <div class="text-center" style="padding-top: 20px;">
        <a href="javascript:;" class="btn btn-success" style="width: 100%;">完成</a>
    </div>
</div>