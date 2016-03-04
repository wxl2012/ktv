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
</style>
<nav class="navbar navbar-blue">
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
</nav>

<ul class="list-group">
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
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                预订日期
            </div>
            <div class="col-xs-9">
                <?php $week = [0 => '星期天', 1 => '星期一', 2 => '星期二', 3 => '星期三', 4 => '星期四', 5 => '星期五', 6 => '星期六']; ?>
                <select class="form-control" id="arrival_date" name="arrival_date">
                    <?php $date = time(); ?>
                    <?php for($i = 0; $i < 10; $i ++){ ?>
                        <?php $date += (60 * 60 * 24); ?>
                        <option value="1"><?php echo date('Y-m-d', $date);?> <?php echo $week[date('w', $date)];?></option>
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
                <input type="text" value="" class="form-control" id="people" name="people" placeholder="人数" />
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
    <li class="list-group-item">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
            </ul>

            <div class="tab-content">
            </div>
        </div>
    </li>
    <li class="list-group-item text-center">
        <a class="btn btn-warning" href="/order/pay_confirm"> 提交预订 </a>
    </li>
</ul>

<script type="text/javascript" src="/assets/third-party/jquery-tmpl-master/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="/assets/third-party/jquery-tmpl-master/jquery.tmplPlus.min.js"></script>

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

<script type="text/javascript">
    $(function () {
        $('input[name=ckbAll]').click(function(){
            var checked = $(this).attr('checked');
            $(this).parents('table').find('input[name=ckbReserve]:checkbox').each(function(){
                console.log(checked);
                $(this).attr('checked', checked);
            });
        });

        $('#seller_id').change(getData);

        getData();
    });

    function getData(){
        $.get('http://www.ktv.ray/room/rooms/' + $('#seller_id').val(),
            function(data){
                if(data.status == 'err'){
                    return;
                }
                loadData(data.cats, data.data);
            }, 'json');
    }

    function loadData(cats, items){
        $('#myTab').empty();
        $('.tab-content').empty();
        for(var i = 0; i < cats.length; i ++){
            var list = [];
            for (var j = 0; j < items.length; j ++){
                if(cats[i].id == items[j].category_id){
                    list[list.length] = items[j];
                }
            }
            console.log(JSON.stringify(cats[i]));
            $('#myTab').append(navItem, cats[i], null);
            $('.tab-content').append(tabItem, {category_id: cats[i], items: items});
        }

    }
</script>
