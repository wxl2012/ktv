<style type="text/css">

    .list-group .list-group-item:first-child{
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }
    .list-group .list-group-item:last-child{
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    .list-group .list-group-item{
        float: left;
        width: 33.33%;
        text-align: center;
        line-height: 25px;
    }

    .list-group .list-group-item i{
        font-size: 1.8em;
    }
    .list-group .list-group-item p{
        margin-bottom: 0px;
    }

    .b0{
        border-right: 0px;
        border-left: 0px;
    }

    dl{
        margin-bottom: 0px;
        margin-top: 4px;
    }
    dl dt{
        font-size: 1.3em;
    }
</style>

<div class="container">
    <div class="row" style="padding: 15px 0px; background-color: #F3F3F3; color: #A73D33;">
        <div class="col-xs-4">
            <img src="http://img.25pp.com//ppnews/zixun_img/238/920/1462433478728327.jpg" class="img-circle" alt="" style="width: 100%;" />
        </div>
        <div class="col-xs-8">
            <dl style="margin-bottom: 0px">
                <dt>XXX XXX XXXX</dt>
                <dd>余额：<i class="fa fa-cny"></i> 0 </dd>
                <dd>预订：100/人次</dd>
            </dl>
        </div>
    </div>
</div>

<div style="height: 30px;"></div>

<div class="list-group">
    <div class="list-group-item" origal-url="/manager/reserve">
        <img src="/assets/img/clock.png" alt=""/>
        <p>所有预约</p>
    </div>
    <div class="list-group-item b0" origal-url="/manager/reserve?begin_at=<?= strtotime(date('Y-m-d')) ?>">
        <img src="/assets/img/clock.png" alt=""/>
        <p>今日到店</p>
    </div>
    <div class="list-group-item" origal-url="/manager/reserve/save">
        <img src="/assets/img/text_add.png" alt=""/>
        <p style="padding-top: 1px;">新增预约</p>
    </div>

    <div class="list-group-item" origal-url="/manager/room">
        <img src="/assets/img/room.png" alt=""/>
        <p>包间设置</p>
    </div>
    <div class="list-group-item b0" origal-url="/manager/store/save">
        <img src="/assets/img/store.png" alt=""/>
        <p>店铺设置</p>
    </div>
    <div class="list-group-item" origal-url="/manager/report">
        <img src="/assets/img/chart.png" alt=""/>
        <p>数据统计</p>
    </div>

    <!--<div class="list-group-item">
        <i class="fa fa-users"></i>
        <p>操作</p>
    </div>
    <div class="list-group-item b0">
        <i class="fa fa-users"></i>
        <p>操作</p>
    </div>
    <div class="list-group-item">
        <i class="fa fa-users"></i>
        <p>操作</p>
    </div>-->
</div>

<?php
$token = \Session::get('access_token', '');
$script = <<<js
    var _access_token = '{$token}';
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js(['tool.js', 'modules/manager/default/index.js'], [], 'js-files', false);
?>