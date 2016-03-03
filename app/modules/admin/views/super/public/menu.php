<!-- Sidebar -->
<aside id="sidebar">

    <!-- Sidbar Widgets -->
    <div class="side-widgets overflow">
        <!-- Profile Menu -->
        <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
            <a href="" data-toggle="dropdown">
                <img class="profile-pic animated" src="img/profile-pic.jpg" alt="">
            </a>
            <ul class="dropdown-menu profile-menu">
                <li><a href="">My Profile</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                <li><a href="">Messages</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                <li><a href="">Settings</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                <li><a href="">Sign Out</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
            </ul>
            <h4 class="m-0">张三</h4>
            @金碧辉煌
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
        <li class="active">
            <a class="sa-side-home" href="index.html">
                <span class="menu-item">包房管理</span>
            </a>
            <ul class="list-unstyled menu-item">
                <li><a href="/admin/room/save">添加包房</a></li>
                <li><a href="/admin/room">所有包房</a></li>
                <li><a href="/admin/room/category">包房房型</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="sa-side-calendar" href="">
                <span class="menu-item">预订管理</span>
            </a>
            <ul class="list-unstyled menu-item">
                <li><a href="/admin/order/reserve">空闲包房</a></li>
                <li><a href="/admin/order/reserve?order_status=WAIT_PAYMENT">未付款的预订</a></li>
                <li><a href="/admin/order/reserve?order_status=PAYMENT_SUCCESS">未使用的预订</a></li>
                <li><a href="/admin/order/reserve?order_status=FINISH">已使用的预订</a></li>
            </ul>
        </li>
        <li class="dropdown hide">
            <a class="sa-side-form" href="">
                <span class="menu-item">订单管理</span>
            </a>
            <ul class="list-unstyled menu-item">
                <li><a href="form-elements.html">Basic Form Elements</a></li>
                <li><a href="form-components.html">Form Components</a></li>
                <li><a href="form-examples.html">Form Examples</a></li>
                <li><a href="form-validation.html">Form Validation</a></li>
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
                <a class="sa-side-ui" href="">
                    <span class="menu-item">商户管理</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="buttons.html">Buttons</a></li>
                    <li><a href="labels.html">Labels</a></li>
                    <li><a href="images-icons.html">Images &amp; Icons</a></li>
                    <li><a href="alerts.html">Alerts</a></li>
                    <li><a href="media.html">Media</a></li>
                    <li><a href="components.html">Components</a></li>
                    <li><a href="other-components.html">Others</a></li>
                </ul>
            </li>
        <?php } ?>

    </ul>

</aside>