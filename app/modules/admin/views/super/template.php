<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>Super Admin Responsive Template</title>

    <!-- CSS -->
    <link href="/assets/superadmin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/superadmin/css/animate.min.css" rel="stylesheet">
    <link href="/assets/superadmin/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/superadmin/css/form.css" rel="stylesheet">
    <link href="/assets/superadmin/css/calendar.css" rel="stylesheet">
    <link href="/assets/superadmin/css/style.css" rel="stylesheet">
    <link href="/assets/superadmin/css/icons.css" rel="stylesheet">
    <link href="/assets/superadmin/css/generics.css" rel="stylesheet">
</head>
<body id="skin-blur-violate">

<header id="header" class="media">
    <a href="" id="menu-toggle"></a>
    <a class="logo pull-left" href="index.html">
        <!--KTV RESERVE 1.0-->
        KTV在线预订系统1.0
    </a>

    <div class="media-body">
        <div class="media" id="top-menu">
            <div class="pull-left tm-icon">
                <a data-drawer="messages" class="drawer-toggle" href="">
                    <i class="sa-top-message"></i>
                    <i class="n-count animated">5</i>
                    <span>系统消息</span>
                </a>
            </div>
            <div class="pull-left tm-icon">
                <a data-drawer="notifications" class="drawer-toggle" href="">
                    <i class="sa-top-updates"></i>
                    <i class="n-count animated">9</i>
                    <span>更新内容</span>
                </a>
            </div>



            <div id="time" class="pull-right">
                <span id="hours"></span>
                :
                <span id="min"></span>
                :
                <span id="sec"></span>
            </div>

            <div class="media-body">
                <input type="text" class="main-search">
            </div>
        </div>
    </div>
</header>

<div class="clearfix"></div>

<section id="main" class="p-relative" role="main">

    <?php echo render('super/public/menu'); ?>

    <!-- Content -->
    <section id="content" class="container">

        <?php echo $content; ?>

    </section>

    <!-- Older IE Message -->
    <!--[if lt IE 9]>
    <div class="ie-block">
        <h1 class="Ops">Ooops!</h1>
        <p>You are using an outdated version of Internet Explorer, upgrade to any of the following web browser in order to access the maximum functionality of this website. </p>
        <ul class="browsers">
            <li>
                <a href="https://www.google.com/intl/en/chrome/browser/">
                    <img src="img/browsers/chrome.png" alt="">
                    <div>Google Chrome</div>
                </a>
            </li>
            <li>
                <a href="http://www.mozilla.org/en-US/firefox/new/">
                    <img src="img/browsers/firefox.png" alt="">
                    <div>Mozilla Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com/computer/windows">
                    <img src="img/browsers/opera.png" alt="">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="http://safari.en.softonic.com/">
                    <img src="img/browsers/safari.png" alt="">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/downloads/ie-10/worldwide-languages">
                    <img src="img/browsers/ie.png" alt="">
                    <div>Internet Explorer(New)</div>
                </a>
            </li>
        </ul>
        <p>Upgrade your browser for a Safer and Faster web experience. <br/>Thank you for your patience...</p>
    </div>
    <![endif]-->
</section>

<!-- Javascript Libraries -->
<!-- jQuery -->
<script src="/assets/superadmin/js/jquery.min.js"></script> <!-- jQuery Library -->
<script src="/assets/superadmin/js/jquery-ui.min.js"></script> <!-- jQuery UI -->
<script src="/assets/superadmin/js/jquery.easing.1.3.js"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->

<!-- Bootstrap -->
<script src="/assets/superadmin/js/bootstrap.min.js"></script>

<!-- Charts -->
<script src="/assets/superadmin/js/charts/jquery.flot.js"></script> <!-- Flot Main -->
<script src="/assets/superadmin/js/charts/jquery.flot.time.js"></script> <!-- Flot sub -->
<script src="/assets/superadmin/js/charts/jquery.flot.animator.min.js"></script> <!-- Flot sub -->
<script src="/assets/superadmin/js/charts/jquery.flot.resize.min.js"></script> <!-- Flot sub - for repaint when resizing the screen -->

<script src="/assets/superadmin/js/sparkline.min.js"></script> <!-- Sparkline - Tiny charts -->
<script src="/assets/superadmin/js/easypiechart.js"></script> <!-- EasyPieChart - Animated Pie Charts -->
<script src="/assets/superadmin/js/charts.js"></script> <!-- All the above chart related functions -->

<!-- Map -->
<script src="/assets/superadmin/js/maps/jvectormap.min.js"></script> <!-- jVectorMap main library -->
<script src="/assets/superadmin/js/maps/usa.js"></script> <!-- USA Map for jVectorMap -->

<!--  Form Related -->
<script src="/assets/superadmin/js/icheck.js"></script> <!-- Custom Checkbox + Radio -->

<!-- UX -->
<script src="/assets/superadmin/js/scroll.min.js"></script> <!-- Custom Scrollbar -->

<!-- Other -->
<script src="/assets/superadmin/js/calendar.min.js"></script> <!-- Calendar -->
<script src="/assets/superadmin/js/feeds.min.js"></script> <!-- News Feeds -->


<!-- All JS functions -->
<script src="/assets/superadmin/js/functions.js"></script>
</body>
</html>
