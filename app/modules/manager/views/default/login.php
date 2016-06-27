<style>
    body{
        background-color: #F3F3F3;
    }
</style>
<div class="container">
    <div class="row" style="padding: 15px 0px; color: #A73D33;">
        <div class="col-xs-12">
            <form id="frmLogin" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">用户名</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="登录密码">
                </div>

                <div class="text-center">
                    <button type="button" id="btnSubmit" class="btn btn-success" style="width: 100%;">登录系统</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php

$script = <<<js
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js(['tool.js', 'modules/manager/default/login.js'], [], 'js-files', false);
?>