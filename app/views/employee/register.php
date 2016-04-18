<style type="text/css">
    .navbar-blue{
        background-color: #337ab7;
    }
    .row .col-xs-3{
        padding-right: 0px;
    }
    .list-group-item:first-child{
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }
    .list-group-item:last-child{
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .help-block{
        margin-bottom: 0px;
        font-size: 9pt;
        color: #c20202;
    }
    .list-group-item .row .col-xs-3:first-child{
        line-height: 30px;
    }
</style>
<nav class="navbar navbar-blue">
    <div class="container-fluid">
        <div class="row" style="line-height: 50px; margin-left: 0px; margin-right: 0px;">
            <div class="col-xs-2">
                <a href="javascript:history.back();">
                    <i class="fa fa-angle-left" style="font-size: 2em; color: #fff;"></i>
                </a>
            </div>
            <div class="col-xs-8 text-center" style="color: #fff; font-size: 13pt; font-weight: 600;">
                注册成为分销人员
            </div>
            <div class="col-xs-2">
            </div>
        </div>
    </div>
</nav>

<form mthod="post" id="frmReserve">
    <?php echo \Form::csrf();?>
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    用&nbsp;&nbsp;户&nbsp;&nbsp;名
                </div>
                <div class="col-xs-9">
                    <input type="text" value="" class="form-control" id="username" name="username" placeholder="登录系统的用户名" />
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码
                </div>
                <div class="col-xs-9">
                    <input type="password" value="" class="form-control" id="password" name="password" placeholder="登录系统的密码" />
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    真实姓名
                </div>
                <div class="col-xs-3">
                    <input type="text" value="" class="form-control" id="first_name" name="first_name" placeholder="姓"/>
                </div>
                <div class="col-xs-6">
                    <input type="text" value="" class="form-control" id="last_name" name="last_name" placeholder="名" />
                </div>
                <div class="col-xs-12">
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    身份证号
                </div>
                <div class="col-xs-9">
                    <input type="number" value="" class="form-control" placeholder="身份证号" id="identity" name="identity" />
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    联系电话
                </div>
                <div class="col-xs-9">
                    <input type="number" value="" class="form-control" placeholder="联系电话" id="phone" name="phone" />
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
        <li class="list-group-item text-center">
            <a class="btn btn-success" href="javascript:;" id="btnSubmit"> 提交注册信息 </a>
        </li>
    </ul>
</form>

<?php
\Asset::js(['employee/register.js'], [], 'js-files', false);
?>
