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
                <select class="form-control">
                    <option value="0">请选择KTV商户</option>
                    <option value="1">商家1</option>
                    <option value="2">商家2</option>
                    <option value="3">商家3</option>
                    <option value="4">商家4</option>
                    <option value="5">商家5</option>
                    <option value="6">商家6</option>
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
                <select class="form-control">
                    <?php $date = time(); ?>
                    <?php for($i = 0; $i < 10; $i ++){ ?>
                        <?php $date += (60 * 60 * 24); ?>
                        <option value="1"><?php echo date('Y-m-d', $date);?></option>
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
                <select class="form-control">
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                </select>
            </div>
            <div class="col-xs-5">
                <select class="form-control">
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
                <input type="text" value="" class="form-control" placeholder="人数" />
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                您的称呼
            </div>
            <div class="col-xs-6">
                <input type="text" value="" class="form-control" placeholder="姓名" />
            </div>
            <div class="col-xs-3" style="padding-right: 15px; padding-left: 0px;">
                <select class="form-control">
                    <option value="famil">先生</option>
                    <option value="a">女士</option>
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
                <input type="number" value="" class="form-control" placeholder="联系电话" />
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-3">
                备注信息
            </div>
            <div class="col-xs-9">
                <textarea class="form-control" placeholder="备注"></textarea>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#home">
                        <i class="green icon-home bigger-110"></i>
                        小包
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#profile">
                        中包
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#dropdown1">
                        大包
                        <span class="badge badge-danger">0</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane in active">
                    <p>可容纳1-6人</p>
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
                        <tr>
                            <th scope="row">1</th>
                            <td>玫瑰苑</td>
                            <td>280/3小时</td>
                            <td>
                                <input type="checkbox" name="ckbReserve" value="1">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>桃花源</td>
                            <td>580/3小时</td>
                            <td>
                                <input type="checkbox" name="ckbReserve" value="2">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>红豆阁</td>
                            <td>880/3小时</td>
                            <td>
                                <input type="checkbox" name="ckbReserve" value="3">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div id="profile" class="tab-pane">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                </div>

                <div id="dropdown1" class="tab-pane">
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
                </div>
            </div>
        </div>
    </li>
    <li class="list-group-item text-center">
        <a class="btn btn-warning" href="/order/pay_confirm"> 提交预订 </a>
    </li>
</ul>

<script type="text/javascript">
    $(function () {
        $('input[name=ckbAll]').click(function(){
            var checked = $(this).attr('checked');
            $(this).parents('table').find('input[name=ckbReserve]:checkbox').each(function(){
                console.log(checked);
                $(this).attr('checked', checked);
            });
        });
    });
</script>
