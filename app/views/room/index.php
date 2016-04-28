<style type="text/css">
    .navbar-blue{
        background-color: #337ab7;
    }
    dl{
        margin-top: 0px;
        margin-bottom: 0px;
    }
    dl dt{
        color: #000;
    }
    dl dd{
        font-size: 9pt;
        color: #aaa;
    }
    #rooms .list-group-item{
        padding-top: 0px;
        padding-bottom: 0px;
    }
    .list-group-item:first-child{
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }
    .list-group-item:last-child{
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    a, a:hover{
        color: #666666;
        text-decoration: none;
    }
    #filterPanel, #sortPanel{
        margin-bottom: 0px;
    }
</style>

<nav class="navbar navbar-blue navbar-fixed-top" style="border-bottom: 1px solid #C6C0B3;">
    <div class="container-fluid">
        <div class="row" style="line-height: 50px; margin-left: 0px; margin-right: 0px;">
            <div class="col-xs-2">
                <i class="fa fa-angle-left" style="font-size: 2em; color: #fff;"></i>
            </div>
            <div class="col-xs-8 text-center" style="color: #fff; font-size: 13pt; font-weight: 600;">
                预订包房
            </div>
            <div class="col-xs-2">
            </div>
        </div>
    </div>
    <div class="container-fluid" style="background-color: #fff; border: 1px solid #C6C0B3; border-bottom: 0px;">
        <div class="row" style="line-height: 40px;">
            <div class="col-xs-6 text-center" style="padding: 0px;">
                <a href="javascript:;" role="filter">容量 <i class="fa fa-caret-<?php echo \Input::get('sort_field') == 'sale_count' && \Input::get('sort_value') == 'ASC' ? 'up' : 'down'; ?>"></i></a>
            </div>
            <div class="col-xs-6 text-center" style="padding: 0px; border-left: 1px solid #C6C0B3;">
                <a href="javascript:;" role="sort">按价格 <i class="fa fa-caret-<?php echo \Input::get('sort_field') == 'price' && \Input::get('sort_value') == 'ASC' ? 'up' : 'down'; ?>"></i></a>
            </div>
        </div>
        <ul class="list-group" id="filterPanel" style="display: none;">
            <?php foreach ($cats as $cat){ ?>
                <li class="list-group-item" data-id="<?php echo $cat->id; ?>">
                    <?php echo $cat->name; ?>
                </li>
            <?php } ?>
        </ul>
        <ul class="list-group" id="sortPanel" style="display: none;">
            <li class="list-group-item" data-sort="DESC">
                销量从高到低
            </li>
            <li class="list-group-item" data-sort="ASC">
                销量从低到高
            </li>
        </ul>
    </div>
</nav>

<div style="height: 92px;"></div>

<ul class="list-group" id="rooms">
    <?php if($items){ ?>
        <?php foreach($items as $item){ ?>
            <li class="list-group-item">
                <a href="/room/view/<?php echo $item->id;?>">
                    <div class="row">
                        <div class="col-xs-5" style="padding-left: 0px; padding-right: 0px;">
                            <img src="http://bpic.pic138.com/12/16/91/22bOOOPIC57_1024.jpg" alt="" style="width: 100%;"/>
                        </div>
                        <div class="col-xs-7">
                            <dl>
                                <dt><?php echo $item->name; ?></dt>
                                <dd class="hide">地址: 汉台区学院路29号天河商业广场5楼</dd>
                                <dd class="clearfix"><span class="pull-left">会员价折</span> <span class="pull-right">人均消费</span></dd>
                                <dd>免费WIFI/免费停车</dd>
                            </dl>
                        </div>
                    </div>
                </a>
            </li>
        <?php } ?>
    <?php } else { ?>
        <li class="list-group-item text-center" style="border: 0px; padding-top: 70px; color: #efefef;">
            <p><i class="fa fa-frown-o" style="font-size: 8em;"></i></p>
            <p style="font-size: 13pt;">未找到相关数据!</p>
        </li>
    <?php } ?>

</ul>

<div class="modal" style="z-index: 1029;background-color: #000; opacity: 0.5;"></div>

<?php

$script = <<<js
    
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js(['url_util.js', 'room/index.js'], [], 'js-files', false);
?>