<style>
    body {
        background-color: #F5F5F5;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color:#000;
        margin: 0;
        padding: 0;
    }
    .swiper-container {
        width: 100%;
        height: 300px;
        margin: 0px auto;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    .swiper-slide img{
        width: 100%;
    }
    .label-default{
        background-color: #eee;
        margin-bottom: 50px;
    }
    .list-group-item a{
        color: #333;
    }
    .tel a{
        color: #ffffff !important;
    }
    .userinfo p{
        margin-top: 0px;
        margin-bottom: 0px;
    }
    .date-no{
        font-size:13px;
        color: #999;
        margin-bottom: 0px;
    }
    .title{
        font-size: 10pt;
        color: #4a5c63;
    }
    .progress{
        height: 10px;
        margin-bottom: 5px;
    }
    .custom-btn{
        line-height: 50px;
        color: #fff;
        font-size: 1.5em;
        background-color:#d9534f;
    }
    .nav-menu .list-group-item:first-child{
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }
    .nav-menu .list-group-item:last-child{
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .nos{
        background-color: #eee;
        margin: 3px 3px 10px 3px;
        font-size: 13px;
        color: #aaa;
    }
    .no-panel{
        margin-bottom: 0px;
        color: #333 !important;
        height: 50px;
        overflow: auto;
    }
    .no-panel div{
        width: 25%;
        color: #333;
        float: left;
    }
</style>

<div class="text-center" style="width: 100%; background-color: #fff; padding: 10px;">
    <?php if(count($item->luck->goods->galleries) > 1){ ?>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach ($item->luck->goods->galleries as $key => $value) { ?>
                    <div class="swiper-slide">
                        <img src="<?= $value->attachment->url; ?>" alt="" style="width:100%;"/>
                    </div>
                <?php } ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    <?php }else if(count($item->luck->goods->galleries) > 0){ ?>
        <img src="<?= current($item->luck->goods->galleries)->attachment->url; ?>" alt="" style="width: 90%;"/>
    <?php }else{ ?>
        <img src="<?= $item->luck->goods->thumbnail; ?>" alt="" style="width: 100%;"/>
    <?php } ?>
</div>
<div class="container" style="background-color: #fff;">
    <h4 class="title"><?= $item->luck->goods->name; ?></h4>
    <p class="date-no">
        期号：<?= $item->luck->no; ?>
    </p>
    <?php if($item->luck->total > $item->luck->balance){ //筹集中?>
        <?php $progressValue = $item->luck->balance ? $item->luck->balance / $item->luck->total * 100 : 0; ?>
        <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?= $progressValue; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progressValue; ?>%">
                <span class="sr-only"><?= $progressValue; ?>% Complete (warning)</span>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <p style="font-size:13px; color: #999;">总需<?= intval($item->luck->total); ?>人次</p>
            </div>
            <div class="col-xs-6">
                <p style="font-size:13px; color: #999;" class="text-right">剩余<a><?= $item->luck->total - $item->luck->balance; ?></a></p>
            </div>
        </div>
    <?php }else if($item->luck->open_at > 0 && $item->luck->open_at > time()){ //开始倒计时?>
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="text-center" style="line-height: 50px; width: 70%; border: 1px solid #fff; background-color: #d9534f; margin: 0px auto; color: #fff;">
                    揭晓倒计时: <span id="timeHour">00</span>:<span id="timeMinute">00</span>:<span id="timeSecond">00</span>
                    <a class="label label-default hide" style="background-color: #fff; color: #d9534f;">查看计算详情</a>
                </div>
            </div>
        </div>
    <?php }else{ //中奖人信息?>
        <div class="row" style="border: 1px solid #ddd; margin: 10px 2px; padding-top: 10px;font-size: 12px; color: #aaa;">
            <?php
            $win_user = $item->luck->win_user;
            $nickname = $win_user->nickname;
            if( ! $nickname && ($win_user->first_name || $win_user->last_name)){
                $nickname = "{$win_user->first_name}{$win_user->last_name}";
            }else if($win_user->wechat->nickname){
                $nickname = $win_user->wechat->nickname;
            }

            $photo = $win_user->photo;
            if( ! $photo && $win_user->wechat->headimgurl){
                $photo = $win_user->wechat->headimgurl;
            }
            ?>
            <div class="col-xs-4">
                <img src="<?= $photo; ?>" alt="" style="width: 100%;" />
            </div>
            <div class="col-xs-8 userinfo" style="padding-left: 0px;">
                <p>获奖者：<?= $nickname; ?></p>
                <p>用户ID：<?= $win_user->user_id; ?></p>
                <p>本期参与：
                    <span class="no-count"><i class="fa fa-spinner fa-span"></i></span>人次
                    <a href="javscript:;" data-toggle="modal" data-target="#noModal">查看Ta的号码</a></p>
                <p style="margin-bottom:10px;">揭晓时间：<?= date('Y-m-d H:i:s', $item->luck->open_at); ?></p>
            </div>
            <div class="col-xs-12 text-center tel" style="background-color: #d9534f; line-height:50px; color: #fff; font-size: 15px;">
                本期幸运号码：<span style="font-size: 1.5em; color:#fff !important;"><?= $item->luck->win_no; ?></span> <a></a>
            </div>
        </div>
    <?php } ?>
    <div class="row nos" style="display: none;">
        <div class="col-xs-12" style="padding: 10px 20px 15px 20px;">
            <p style="margin-bottom: 0px;">
                您参与了：<span class="no-count" style="color: #d9534f"><i class="fa fa-spinner fa-span"></i></span>次
                <div>夺宝号码：</div>
            </p>
            <p class="no-panel">

            </p>
        </div>
    </div>
    <div class="row non-empty" style="display: none;">
        <div class="col-x-12 text-center" style="margin: 10px 0px;">
            <div class="text-center" style="line-height: 50px; width: 95%; border: 1px solid #fff; background-color: #eee; margin: 0px auto; color: #aaa;">
                您没有参与本次夺宝哦!
            </div>
        </div>
    </div>
</div>

<div class="list-group nav-menu" style="margin-top: 10px;">
    <a class="list-group-item" href="/marketing/luck/one/goods_view/<?= $item->luck->goods_id; ?>">
        图文详情
        <span class="pull-right">
            <i class="fa fa-angle-right"></i>
        </span>
    </a>
    <a class="list-group-item" href="/marketing/luck/one/history?goods_id=<?= $item->luck->goods_id?>">
        往期揭晓
        <span class="pull-right">
            <i class="fa fa-angle-right"></i>
        </span>
    </a>
    <a class="list-group-item" href="/marketing/luck/one/comment/<?= $item->id; ?>">
        晒单分享
        <span class="pull-right">
            <i class="fa fa-angle-right"></i>
        </span>
    </a>
</div>

<div class="hide">
    <ul class="list-group">
        <li class="list-group-item">
            <a>所有参与记录（自2015-12-15 20:00:00开始）</a>
        </li>
    </ul>
</div>

<div style="height: 50px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 text-center">
                <?php if($item->luck->open_at > 0 && $item->luck->open_at < time()){ ?>
                    <div data-id="<?= $item->luck->goods_id?>" class="col-xs-12 text-center custom-btn" style="background-color:#eeeeee; color: #aaa;">
                        活动已结束
                    </div>
                <?php }else if($item->luck->open_at > 0 && $item->luck->open_at > time()){ ?>
                    <div data-id="<?= $item->luck->goods_id?>" class="col-xs-12 text-center custom-btn" style="background-color:#f0ad4e;">
                        等待开奖
                    </div>
                <?php }else{ ?>
                    <div id="btnSubmit" data-id="<?= $item->luck->goods_id?>" class="text-center custom-btn">
                        立即参与
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="noModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">中奖人参与号码列表</h4>
            </div>
            <div class="modal-body" style="padding: 5px; margin-bottom: 0px;">
                <p class="no-panel" style="height: 150px;">

                </p>
            </div>
            <div class="modal-footer" style="margin-top: 5px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="marketingModal" tabindex="-1" role="dialog" aria-labelledby="marketingModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="marketingModalLabel">参与次数</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="number" class="form-control" id="num" placeholder="参与次数" aria-describedby="basic-addon2">
                    <span class="input-group-addon" id="basic-addon2">人次/1元</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>

<script type="jquery-tmpl" id="item-empty">
    <div class="list-group-item text-center">未找到相关数据!</div>
</script>

<?php
$buyer_id = \Auth::get_user()->id;
$no = $item->luck->win_no;
$script = <<<js
    var _win_no = '{$no}';
    var _buyer_id = {$buyer_id};
    var _marketing_id = {$item->id};
    var _num = 1;
    var _seller_id = {$item->seller_id};
js;

\Asset::js($script, [], 'before-script', true);

\Asset::css(['swiper/3.2.7/css/swiper.min.css'], [], 'css-files', false);
\Asset::js(['modules/marketing/view.js'], [], 'js-files', false);
?>