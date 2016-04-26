<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>登录 —— 祥盟娱乐</title>

    <!-- CSS -->
    <?php
    echo \Asset::css([
        'bootstrap.min.css',
        'form.css',
        'style.css',
        'animate.css',
        'generics.css'
    ]);
    ?>
</head>
<body id="skin-blur-violate">
<section id="login">
    <header>
        <h1>祥盟娱乐</h1>
        <p>KTV包房在线预订系统管理平台</p>
    </header>

    <div class="clearfix"></div>

    <!-- Login -->
    <form class="box tile animated active" id="box-login" method="post">
        <h2 class="m-t-0 m-b-15">登录</h2>
        <input type="text" class="login-control m-b-10" id="username" name="username" placeholder="请输入用户名或邮箱">
        <input type="password" class="login-control" id="password" name="password" placeholder="请输入登录密码">
        <div class="checkbox">
            <label>
                <input type="checkbox">
                记住密码
            </label>
        </div>

        <div style="color: red; margin-bottom: 10px;" id="errorMsgLogin">
            <?php
            $msg = \Session::get_flash('msg', false);
            if($msg){
                echo "{$msg['msg']}<br>";
                if(isset($msg['data'])){
                    foreach ($msg['data'] as $key => $value){
                        echo "{$key} {$value}<br>";
                    }
                }
            }
            ?>
        </div>

        <button class="btn btn-sm m-r-5" id="btnLogin">登录系统</button>

        <small>
            <a class="box-switcher" data-switch="box-register" href="javascript:;">您还没有帐户?</a> 或
            <a class="box-switcher" data-switch="box-reset" href="javascript:;">忘记密码?</a>
        </small>
    </form>

    <!-- Register -->
    <form class="box animated tile" id="box-register">
        <h2 class="m-t-0 m-b-15">帐户注册</h2>
        <input type="text" class="login-control m-b-10" placeholder="真实姓名">
        <input type="text" class="login-control m-b-10" placeholder="用户名">
        <input type="email" class="login-control m-b-10" placeholder="注册邮箱">
        <input type="password" class="login-control m-b-10" placeholder="登录密码">
        <input type="password" class="login-control m-b-20" placeholder="确认密码">

        <button class="btn btn-sm m-r-5">注册帐户</button>

        <small><a class="box-switcher" data-switch="box-login" href="javascript:;">您已经有一个帐户?</a></small>
    </form>

    <!-- Forgot Password -->
    <form class="box animated tile" id="box-reset">
        <h2 class="m-t-0 m-b-15">密码重置</h2>
        <p>如何您不记得您的密码,请填写您注册时填写的安全邮箱.我们将向您的安全邮箱发送一封临时密码邮件.</p>
        <input type="email" class="login-control m-b-20" placeholder="邮箱地址">

        <button class="btn btn-sm m-r-5">重置密码</button>

        <small><a class="box-switcher" data-switch="box-login" href="javascript:;">您已经有一个帐户?</a></small>
    </form>
</section>

<!-- Javascript Libraries -->
<?php
echo \Asset::js([
    'http://lib.sinaapp.com/js/jquery/1.10.2/jquery-1.10.2.min.js',
    'bootstrap.min.js',
    'icheck.js',
    'functions.js',
]);
?>

<script type="text/javascript">
    $(function () {
        $('#btnLogin').click(function(){
            var msg = '';

            if($('#username').val().length < 1){
                msg = '用户名不能为空!';
                $('#username').css('border', '1px solid red');
            }else if($('#password').val().length < 1){
                msg = '密码不能为空!';
                $('#password').css('border', '1px solid red');
            }

            if(msg != ''){
                $('#errorMsgLogin').text(msg);
                return false;
            }
        });

        $('#username, #password').click(function(){
            $('#username').css('border', '0px');
        });
    });
</script>
</body>
</html>
