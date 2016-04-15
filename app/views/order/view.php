<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-3" style="line-height: 50px;">
                <a href="javascript:history.back(-1);"><i class="fa fa-angle-left" style="font-size: 1.5em;"></i></a>
            </div>
            <div class="col-xs-6 text-center" style="line-height: 50px;">
                订单详情
            </div>
            <div class="col-xs-3">
            </div>
        </div>
    </div>
</nav>

<div class="container" style="margin-top: 60px; padding-left: 5px;padding-right: 5px;">
    <div class="list-group">
        <div class="list-group-item">
            订&nbsp;&nbsp;单&nbsp;&nbsp;号: <?php echo $item->order_no;?>
        </div>
        <div class="list-group-item">
            订单状态: <label class="label label-<?php echo \Model_Order::$_maps['labels'][$item->order_status];?>"><?php echo \Model_Order::$_maps['status'][$item->order_status];?></label>
        </div>
        <div class="list-group-item">
            支付方式: <?php echo $item->payment ? $item->payment->name : '-';?>
        </div>
        <div class="list-group-item">
            下单时间: <?php echo date('Y-m-d H:i:s', $item->created_at); ?>
        </div>
        <div class="list-group-item">
            付款时间: <?php echo $item->pay_at ? date('Y-m-d H:i:s', $item->pay_at) : '-'; ?>
        </div>
        <div class="list-group-item">
            备注信息: <?php echo $item->remark;?>
        </div>
        <?php foreach ($item->details as $detail){ ?>
            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-4" style="padding-left: 2px; padding-right: 0px;">
                        <img src="<?php echo $detail->goods->thumbnail; ?>" alt="<?php echo $detail->goods->title; ?>" style="width: 100%; height: 100%;"/>
                    </div>
                    <div class="col-xs-8">
                        <dl style="margin-top: 0px; margin-bottom: 0px;">
                            <dt><?php echo $detail->goods->title; ?></dt>
                            <dd>数量: <?php echo $detail->num; ?> <span style="padding-left: 5px">单价: <?php echo $detail->price; ?></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="list-group-item text-right" style="margin-bottom: 10px; padding-top: 5px; padding-bottom: 5px;">
            <?php if($item->order_status == 'NONE'){ ?>
                <a class="btn btn-sm btn-danger">取消订单</a>
            <?php } ?>
            <?php if($item->order_status == 'WAIT_PAYMENT'){ ?>
                <a class="btn btn-sm btn-warning">去支付</a>
            <?php }?>
        </div>
    </div>

</div>