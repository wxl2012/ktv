<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>后台管理——KTV在线预订系统</title>

    <!-- CSS -->
    <?php
    echo \Asset::css([
        'bootstrap.min.css',
        'animate.min.css',
        'font-awesome.min.css',
        'form.css',
        'calendar.css',
        'style.css',
        'icons.css',
        'generics.css'
    ]);
    ?>
</head>
<body id="<?php echo \Auth::check() && isset(\Auth::get_user()->default_theme) && \Auth::get_user()->default_theme ? \Auth::get_user()->default_theme : 'skin-blur-violate'; ?>">

<header id="header" class="media">
    <a href="" id="menu-toggle"></a>
    <a class="logo pull-left" href="/admin">
        <!--KTV RESERVE 1.0-->
        KTV在线预订系统1.0
    </a>

    <div class="media-body">
        <div class="media" id="top-menu">
            <div class="pull-left tm-icon">
                <a data-drawer="messages" class="drawer-toggle" href="javascript:;">
                    <i class="sa-top-message"></i>
                    <!--<i class="n-count animated">5</i>-->
                    <span>系统消息</span>
                </a>
            </div>
            <div class="pull-left tm-icon">
                <a data-drawer="notifications" class="drawer-toggle" href="javascript:;">
                    <i class="sa-top-updates"></i>
                    <!--<i class="n-count animated">9</i>-->
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

    <?php echo render('super/public/ooops'); ?>
</section>

<!-- Javascript Libraries -->
<!-- jQuery -->
<?php
echo \Asset::render('css-files');
echo \Asset::render('before-script');
echo \Asset::js([
    'http://lib.sinaapp.com/js/jquery/1.10.2/jquery-1.10.2.min.js',
    'jquery-ui.min.js',
    'jquery.easing.1.3.js',
    'bootstrap.min.js',
]);
echo \Asset::render('js-files');
echo \Asset::render('after-script');
?>



<!-- Other -->
<script src="/assets/superadmin/js/calendar.min.js"></script> <!-- Calendar -->
<!--<script src="/assets/superadmin/js/feeds.min.js"></script> <!-- News Feeds -->


<!-- All JS functions -->
<script src="/assets/superadmin/js/functions.js"></script>



</body>
</html>
