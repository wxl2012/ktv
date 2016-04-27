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
                预订包房
            </div>
            <div class="col-xs-2">
            </div>
        </div>
    </div>
</nav>

<form mthod="post" id="frmReserve">
    <?php echo \Form::csrf();?>
    <ul class="list-group">
        <?php if(! \Input::get('id', false)) { ?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    预订商家
                </div>
                <div class="col-xs-9">
                    <select class="form-control" id="seller_id" name="seller_id">
                        <option value="0">请选择KTV商户</option>
                        <?php foreach ($sellers as $seller) { ?>
                            <option value="<?php echo $seller->id; ?>"><?php echo $seller->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </li>
        <?php }else{ ?>
            <input type="hidden" id="room_id" name="room_id" value="<?php echo \Input::get('id'); ?>" />
        <?php } ?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    预订日期
                </div>
                <div class="col-xs-9">
                    <select class="form-control" id="arrival_date" name="arrival_date">
                        <?php $date = time(); ?>
                        <?php for($i = 0; $i < 10; $i ++){ ?>
                            <?php $date += (60 * 60 * 24); ?>
                            <option value="<?php echo date('Y-m-d', $date);?>"><?php echo date('Y-m-d', $date);?> <?php echo \Model_RoomReserve::$_maps['week'][date('w', $date)];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    开始时间
                </div>
                <div class="col-xs-4">
                    <select class="form-control" id="arrival_hour" name="arrival_hour">
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                    </select>
                </div>
                <div class="col-xs-5">
                    <select class="form-control" id="arrival_minute" name="arrival_minute">
                        <option value="00">00</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    预订人数
                </div>
                <div class="col-xs-9">
                    <input type="text" value="" class="form-control" id="people_num" name="people_num" placeholder="人数" />
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    您的称呼
                </div>
                <div class="col-xs-6">
                    <input type="text" value="" class="form-control" id="name" name="name" placeholder="姓名" />
                    <p class="help-block"></p>
                </div>
                <div class="col-xs-3" style="padding-right: 15px; padding-left: 0px;">
                    <select class="form-control" id="gender" name="gender">
                        <option value="male">先生</option>
                        <option value="female">女士</option>
                    </select>
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
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    备注信息
                </div>
                <div class="col-xs-9">
                    <textarea class="form-control" placeholder="备注" id="remark" name="remark"></textarea>
                </div>
            </div>
        </li>
        <li class="list-group-item hide">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                </ul>

                <div class="tab-content">
                </div>
            </div>
        </li>
        <li class="list-group-item text-center">
            <a class="btn btn-warning" href="javascript:;" id="btnSubmit"> 提交预订 </a>
        </li>
    </ul>
</form>

<script type="text/x-jquery-tmpl" id="navItem">
<li class="active">
    <a data-toggle="tab" href="#tab${id}">
        <i class="green icon-home bigger-110"></i>
        ${name}
    </a>
</li>
</script>

<script type="text/x-jquery-tmpl" id="tabItem">
<div id="tab${category_id}" class="tab-pane in active">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>包房号</th>
                <th>包房名称</th>
                <th>价格</th>
                <th><input type="checkbox" name="ckbAll" value="all"></th>
            </tr>
        </thead>
        <tbody>
            {{each(i, item) items}}
            <tr>
                <th scope="row">${item.no}</th>
                <td>${item.name}</td>
                <td>${item.price}</td>
                <td>
                    <input type="checkbox" name="ckbReserve" value="${item.id}">
                </td>
            </tr>
            {{/each}}
        </tbody>
    </table>
</div>
</script>

<?php
$room_id = \Input::get('id', 0);
$seller_id = \Input::get('seller_id', 0);
$script = <<<js
    var _access_token = '';
    var _seller_id = {$seller_id};
    var _room_id = {$room_id};
    var _dates = [];
js;

    \Asset::js($script, [], 'before-script', true);

    \Asset::js([ 'jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'room/reserve.js'], [], 'js-files', false);
?>
