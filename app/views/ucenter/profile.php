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
    .list-group-item .row div {
        line-height: 30px;
    }
    input[type=text], select {
        display: none;
    }
    .text-right{
        color: #aaa;
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
                个人资料
            </div>
            <div class="col-xs-2 text-right">
                <a><i class="fa fa-edit" style="color: #fff; font-size: 13pt;"></i></a>
            </div>
        </div>
    </div>
</nav>

<form mthod="post" id="frmReserve">
    <?php echo \Form::csrf();?>
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3" style="line-height: 60px;">
                    头像
                </div>
                <div class="col-xs-9 text-right">
                    <img src="http://img1.2345.com/duoteimg/qqTxImg/2013/04/22/13667045720.jpg" alt="" style="width: 60px; height: 60px;" class="img-circle"/>
                    <input type="text" value=""/>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    账号
                </div>
                <div class="col-xs-9 text-right">
                    <span><?php echo $item->user->username; ?></span>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    真实姓名
                </div>
                <div class="col-xs-9 text-right">
                    <span><?php echo "{$item->first_name}{$item->last_name}"; ?></span>
                    <input type="text" value="<?php echo $item->first_name; ?>"/>
                    <input type="text" value="<?php echo $item->last_name; ?>"/>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    性别
                </div>
                <div class="col-xs-9 text-right">
                    <span><?php echo \Model_People::$_maps['gender'][$item->gender]; ?></span>
                    <select id="gender" name="gender">
                        <option value="none"<?php echo $item->gender == 'none' ? ' selected' : ''; ?>>保密</option>
                        <option value="male"<?php echo $item->gender == 'male' ? ' selected' : ''; ?>>男</option>
                        <option value="female"<?php echo $item->gender == 'female' ? ' selected' : ''; ?>>女</option>
                    </select>
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    生日
                </div>
                <div class="col-xs-9 text-right">
                    <span><?php echo $item->birthday ? date('Y-m-d', $item->birthday) : '未设置'; ?></span>
                    <input type="hidden" value="<?php echo $item->birthday; ?>" id="birthday" name="birthday" />
                    <input type="text" value="<?php echo $item->birthday ? date('Y-m-d', $item->birthday) : ''; ?>" id="birthday_text" name="birthday_text" placeholder="点击选择生日" />
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
    </ul>

    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    所在地
                </div>
                <div class="col-xs-9 text-right">
                    <span>
                        <?php if($item->country || $item->province || $item->city || $item->county){ ?>
                            <?php echo $item->country ? $item->country->name : ''; ?>
                            <?php echo $item->province ? $item->province->name : ''; ?>
                            <?php echo $item->city ? $item->city->name : ''; ?>
                            <?php echo $item->county ? $item->county->name : ''; ?>
                        <?php }else{ ?>
                            未设置
                        <?php } ?>
                    </span>
                    <select id="country_id" name="country_id"></select>
                    <select id="province_id" name="province_id"></select>
                    <select id="city_id" name="city_id"></select>
                    <select id="county_id" name="county_id"></select>
                    <p class="help-block"></p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    联系电话
                </div>
                <div class="col-xs-9 text-right">
                    <span><?php echo $item->phone ? $item->phone : '未设置'; ?></span>
                    <input type="text" value=""/>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    身份证号
                </div>
                <div class="col-xs-9 text-right">
                    <span><?php echo $item->identity ? $item->identity : '未设置'; ?></span>
                    <input type="text" value=""/>
                </div>
            </div>
        </li>
    </ul>

    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-3">
                    银行卡
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
                    支付宝
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
                    微支付
                </div>
                <div class="col-xs-9">
                    <input type="text" value="" class="form-control" id="people_num" name="people_num" placeholder="人数" />
                    <p class="help-block"></p>
                </div>
            </div>
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
    var _seller_id = {$seller_id};
    var _room_id = {$room_id};
    var _dates = [];
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js([ 'jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'room/reserve.js'], [], 'js-files', false);
?>
