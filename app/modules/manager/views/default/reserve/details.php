<style type="text/css">
    .navbar-blue{
        background-color: #337ab7;
    }
    .list-group{
        margin-bottom: 0px;
    }
    .pr0{
        padding-right: 0px;
    }
    .pl0{
        padding-left: 0px;
    }
    input, select{
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
    .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active{
        color: #fff;
        background-color: #428bca;
        border-color: #428bca;
    }
    .tit{
        line-height: 27px;
        text-align: right;
        padding-right: 0px;
    }
</style>
<nav class="navbar navbar-blue navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-3" style="line-height: 50px;">
                <a href="javascript:history.back(-1);">
                    <i class="fa fa-angle-left" style="font-size: 2em; color: #fff;"></i>
                </a>
            </div>
            <div class="col-xs-6 text-center" style="color: #fff; font-size: 13pt; font-weight: 600;line-height: 50px;">
                新增预约信息
            </div>
            <div class="col-xs-3">
            </div>
        </div>
    </div>
</nav>

<div style="height: 55px"></div>
<div class="container-fluid">
    <form id="frmReserve">
        <input type="hidden" id="room_id" name="room_id" value="1">
        <input type="hidden" name="status" value="SUCCESS">
        <div class="list-group">

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">包间</div>
                    <div class="col-xs-9">
                        <div class="btn-group" role="group" aria-label="...">
                            <?php foreach ($rooms as $room){ ?>
                                <button type="button" class="btn btn-default" data-id="<?= $room->id; ?>"><?= $room->category->name; ?></button>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">姓名</div>
                    <div class="col-xs-9">
                        <input type="text" id="name" name="name" value="" class="form-control" placeholder="姓名">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">电话</div>
                    <div class="col-xs-9">
                        <input type="text" id="phone" name="phone" value="" class="form-control" placeholder="联系电话">
                    </div>
                </div>
            </div>

            <div class="list-group-item hide">
                <div class="row">
                    <div class="col-xs-3 pr0 tit">来电时间</div>
                    <div class="col-xs-3 pr0">
                        <select class="form-control">
                            <option>今日</option>
                        </select>
                    </div>
                    <div class="col-xs-3 pr0">
                        <select class="form-control">
                            <?php for ($h = 0; $h < 24; $h ++){ ?>
                                <option value="<?= $h < 10 ? "0{$h}" : $h;?>"><?= $h < 10 ? "0{$h}" : $h;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-3 pl0">
                        <select class="form-control">
                            <?php for ($m = 0; $m < 60; $m ++){ ?>
                                <option value="<?= $m < 10 ? "0{$m}" : $m;?>"><?= $m < 10 ? "0{$m}" : $m;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-3 tit">预约时间</div>
                    <div class="col-xs-6 pr0" style="line-height: 27px">
                        <select id="date" name="date" class="form-control">
                            <?php $date = time(); ?>
                            <?php for($i = 0; $i < 10; $i ++){ ?>
                                <?php $date += (60 * 60 * 24); ?>
                                <option value="<?php echo date('Y-m-d', $date);?>"><?php echo date('Y-m-d', $date);?> <?php echo \Model_RoomReserve::$_maps['week'][date('w', $date)];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-3" style="padding-left: 1px;">
                        <input type="text" id="time" name="time" class="form-control text-center" value="" name="" placeholder="时间" />
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-12">
                        <textarea class="form-control" id="remark" name="remark" placeholder="备注"></textarea>
                    </div>
                </div>
            </div>

        </div>
    </form>
    <div class="row" style="margin-top: 10px">
        <div class="col-xs-12">
            <div class="alert alert-danger" style="display: none;margin: 0px 15px;"></div>
        </div>
        <div class="col-xs-12 text-center" style="padding: 10px 0px;">
            <a id="btnSubmit" class="btn btn-info" style="width: 80%;">保存</a>
        </div>
    </div>
</div>

<?php
$token = \Session::get('access_token', '');
$script = <<<js
    var _access_token = '{$token}';
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'tool.js', 'modules/manager/default/reserver/details.js'], [], 'js-files', false);
?>