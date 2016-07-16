<?php
$seller = \Session::get('seller', false);
?>
<!-- Sidebar -->
<aside id="sidebar">

    <!-- Sidbar Widgets -->
    <div class="side-widgets overflow">
        <!-- Profile Menu -->
        <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
            <a href="javascript:;" data-toggle="dropdown">
                <img class="profile-pic animated" src="/assets/superadmin/img/profile-pic.jpg" alt="">
            </a>
            <ul class="dropdown-menu profile-menu">
                <!--<li><a href="javascript:;">我的资料</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                <li><a href="javascript:;">我的消息</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>-->
                <li><a href="javascript:;">修改密码</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                <li><a href="/admin/home/logout">安全退出</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
            </ul>
            <h4 class="m-0"><?php echo \Auth::check() ? \Auth::get_user()->username : ''; ?></h4>
            @<?php echo $seller ? $seller->name : '系统管理员'?>
        </div>

        <!-- Calendar -->
        <div class="s-widget m-b-25">
            <div id="sidebar-calendar"></div>
        </div>

        <!-- Feeds -->
        <div class="s-widget m-b-25">
            <h2 class="tile-title">
                最新预订消息
            </h2>

            <div class="s-widget-body">
                <div id="news-feed"></div>
            </div>
        </div>

        <!-- Projects -->
        <div class="s-widget m-b-25 hide">
            <h2 class="tile-title">
                今日包房概况
            </h2>

            <div class="s-widget-body">
                <div class="side-border">
                    <small>今天剩余包房</small>
                    <div class="progress progress-small">
                        <a href="#" data-toggle="tooltip" title="" class="progress-bar tooltips progress-bar-danger" style="width: 60%;" data-original-title="60%">
                            <span class="sr-only">60% Complete</span>
                        </a>
                    </div>
                </div>
                <div class="side-border">
                    <small>Opencart E-Commerce Website</small>
                    <div class="progress progress-small">
                        <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-info" style="width: 43%;" data-original-title="43%">
                            <span class="sr-only">43% Complete</span>
                        </a>
                    </div>
                </div>
                <div class="side-border">
                    <small>Social Media API</small>
                    <div class="progress progress-small">
                        <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-warning" style="width: 81%;" data-original-title="81%">
                            <span class="sr-only">81% Complete</span>
                        </a>
                    </div>
                </div>
                <div class="side-border">
                    <small>VB.Net Software Package</small>
                    <div class="progress progress-small">
                        <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-success" style="width: 10%;" data-original-title="10%">
                            <span class="sr-only">10% Complete</span>
                        </a>
                    </div>
                </div>
                <div class="side-border">
                    <small>Chrome Extension</small>
                    <div class="progress progress-small">
                        <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-success" style="width: 95%;" data-original-title="95%">
                            <span class="sr-only">95% Complete</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Side Menu -->
    <ul class="list-unstyled side-menu">
        <?php if(! (\Auth::check() && \Auth::get_user()->group_id == 6)){ ?>
        <li class="active">
            <a class="sa-side-home" href="/admin/room">
                <span class="menu-item">包房管理</span>
            </a>
        </li>
        <li class="dropdown">
            <a class="sa-side-calendar" href="">
                <span class="menu-item">预订管理</span>
            </a>
            <ul class="list-unstyled menu-item">
                <li><a href="/admin/room/add_reserve">新增预订</a></li>
                <li><a href="/admin/room/reserve">所有预订</a></li>
                <li><a href="/admin/room/reserve?date=today">今日到店</a></li>
                <li><a href="/admin/room/reserve?status=USED">已消费的预订</a></li>
                <li><a href="/admin/room/reserve?status=TIMEOUT">过期的预订</a></li>
            </ul>
        </li>
        <?php } ?>
        <li class="dropdown hide">
            <a class="sa-side-form" href="javascript:;">
                <span class="menu-item">订单管理</span>
            </a>
            <ul class="list-unstyled menu-item">
                <li><a href="/admin/order">所有订单</a></li>
                <li><a href="/admin/order/reserve?order_status=WAIT_PAYMENT">未付款的订单</a></li>
                <li><a href="/admin/order/reserve?order_status=PAYMENT_SUCCESS">未使用的订单</a></li>
                <li><a href="/admin/order/reserve?order_status=FINISH">已使用的订单</a></li>
            </ul>
        </li>
        <li>
            <a class="sa-side-chart hide" href="charts.html">
                <span class="menu-item">Charts</span>
            </a>
        </li>
        <li>
            <a class="sa-side-folder hide" href="file-manager.html">
                <span class="menu-item">File Manager</span>
            </a>
        </li>
        <li>
            <a class="sa-side-calendar hide" href="calendar.html">
                <span class="menu-item">Calendar</span>
            </a>
        </li>
        <li class="dropdown hide">
            <a class="sa-side-page" href="">
                <span class="menu-item">Pages</span>
            </a>
            <ul class="list-unstyled menu-item">
                <li><a href="list-view.html">List View</a></li>
                <li><a href="profile-page.html">Profile Page</a></li>
                <li><a href="messages.html">Messages</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="404.html">404 Error</a></li>
            </ul>
        </li>
        <?php if(\Auth::check() && \Auth::get_user()->group_id == 6){ ?>
            <li class="dropdown">
                <a href="javascript:;">
                    <span class="icon" style="font-size: 2.2em;"></span>
                    <span class="menu-item">财务数据统计</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="/admin/report">收入统计</a></li>
                    <!--<li><a href="/admin/report">收入明细</a></li>
                    <li><a href="messages.html">Messages</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="404.html">404 Error</a></li>-->
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:;">
                    <span class="icon" style="font-size: 2.4em;"></span>
                    <span class="menu-item">商户管理</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="/admin/seller/save">新增商户</a></li>
                    <li><a href="/admin/seller">所有商户</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="">
                    <span class="icon" style="font-size: 2em;"></span>
                    <span class="menu-item">微信设置</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="/admin/wxaccount">微信设置</a></li>
                    <li><a href="/admin/wxaccount/wxpay">微支付配置</a></li>
                    <li><a href="/admin/mp/function/menu">菜单设置</a></li>
                </ul>
            </li>
        <?php } else { ?>
            <li class="dropdown">
                <a href="">
                    <span class="icon" style="font-size: 2em;"></span>
                    <span class="menu-item">系统设置</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="/admin/seller/save/<?= \Session::get('seller')->id; ?>">基本信息设置</a></li>
                </ul>
            </li>
        <?php } ?>

    </ul>

</aside>