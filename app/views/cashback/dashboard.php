<style type="text/css">
    .pl0{
        padding-left: 0px;
    }
    .pr0{
        padding-right: 0px;
    }
    dl{
        margin: 0px;
    }
    .double-column .list-group-item{
        width: 50%;
        float: left;
    }
    .double-column .list-group-item .col-xs-3{
        line-height: 30px;
    }
    .double-column .list-group-item p{
        margin-bottom: 0px;
    }
    .list-group-item:first-child{
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }
    .list-group-item:last-child{
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
</style>
<ul class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3 pl0 pr0">
                <img src="http://img1.3lian.com/gif/more/11/201301/e47524afabdc211536e595743be46e92.jpg" alt="" style="width: 100%;"/>
            </div>
            <div class="col-xs-6">
                <dl>
                    <dt>张三</dt>
                    <dd>认&nbsp;&nbsp;&nbsp;&nbsp;证: <label class="label label-success"><i class="fa fa-check"></i> 已认证</label></dd>
                    <dd>级&nbsp;&nbsp;&nbsp;&nbsp;别: 普通代理</dd>
                    <dd>手机号: 185****3308</dd>
                </dl>
            </div>
            <div class="col-xs-3 text-right" style="line-height: 80px; pl0">
                <!--<i class="fa fa-qrcode" style="color: #aaa; font-size: 1.3em;"></i>-->
                <i class="fa fa-angle-right" style="font-size: 1.5em; color: #aaa;"></i>
            </div>
        </div>
    </li>
</ul>

<ul class="list-group clearfix double-column" id="item">
    <li class="list-group-item" original-url="cashback">
        <div class="row">
            <div class="col-xs-3">
                <div class="text-center" style="border-radius: 50%; background-color: #f0ad4e; color: #fff; width: 30px; height: 30px;">
                    <i class="fa fa-cny"></i>
                </div>
            </div>
            <div class="col-xs-9">
                <p>余额</p>
                <p>0.00</p>
            </div>
        </div>
    </li>
    <li class="list-group-item" style="border-left: 0px;" original-url="cashback">
        <div class="row">
            <div class="col-xs-3">
                <div class="text-center" style="border-radius: 50%; background-color: #f0ad4e; color: #fff; width: 30px; height: 30px;">
                    <i class="fa fa-cny"></i>
                </div>
            </div>
            <div class="col-xs-9">
                <p>未结算</p>
                <p>0.00</p>
            </div>
        </div>
    </li>
    <li class="list-group-item" original-url="members">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-users" style="font-size: 1.5em; color: #d9534f;"></i>
            </div>
            <div class="col-xs-9">
                <p>下级总数</p>
                <p>1个</p>
            </div>
        </div>
    </li>
    <li class="list-group-item" style="border-left: 0px;" original-url="orders">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-shopping-cart" style="font-size: 1.8em; color: #d9534f;"></i>
            </div>
            <div class="col-xs-9">
                <p>订单总数</p>
                <p>0.00</p>
            </div>
        </div>
    </li>
</ul>

<ul class="list-group double-column clearfix">
    <li class="list-group-item" original-url="cashback">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-qrcode" style="font-size: 2em; color: #5cb85c"></i>
            </div>
            <div class="col-xs-9">
                <p>会员二维码</p>
            </div>
        </div>
    </li>
    <li class="list-group-item" style="border-left: 0px;" original-url="cashback">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-qrcode" style="font-size: 2em; color: #5cb85c"></i>
            </div>
            <div class="col-xs-9">
                <p>推荐二维码</p>
            </div>
        </div>
    </li>
    <li class="list-group-item" original-url="cashback">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-qrcode" style="font-size: 2em; color: #5cb85c"></i>
            </div>
            <div class="col-xs-9">
                <p>收款二维码</p>
            </div>
        </div>
    </li>
    <li class="list-group-item" style="border-left: 0px;" original-url="cashback">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-qrcode" style="font-size: 2em; color: #5cb85c"></i>
            </div>
            <div class="col-xs-9">
                <p>付款二维码</p>
            </div>
        </div>
    </li>
</ul>

<ul class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-12">
                专属链接: <a href="/">点击进入</a>
            </div>
        </div>
    </li>
</ul>

<?php
\Asset::js(['cashback/dashboard.js'], [], 'js-files', false);
?>