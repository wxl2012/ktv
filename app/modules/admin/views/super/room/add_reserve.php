<form method="post" id="frmReserve">
    <?= \Form::csrf();?>
    <div class="block-area">
        <div class="alert alert-success" style="display: none;">
        </div>
        <h3 class="block-title">包间信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="room_no">包房类型</label>
                <select class="form-control input-sm" id="room_id" name="room_id">
                    <?php foreach ($items as $item){ ?>
                        <option value="<?= $item->id; ?>" <?= $item->id == \Input::post('room_id', 0) ? ' selected' : ''; ?>><?= $item->name; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="reserve_date">预约时间</label>
                <div>
                    <select class="form-control input-sm" id="reserve_date" name="reserve_date" style="width: 200px; display: inline;">
                        <?php $date = time(); ?>
                        <?php for($i = 0; $i < 10; $i ++){ ?>
                            <?php $date += (60 * 60 * 24); ?>
                            <option value="<?= date('Y-m-d', $date);?>" <?= date('Y-m-d', $date) == \Input::post('reserve_date', '') ? ' selected' : ''; ?>><?= date('Y-m-d', $date);?> <?= \Model_RoomReserve::$_maps['week'][date('w', $date)];?></option>
                        <?php } ?>
                    </select>
                    <select class="form-control input-sm" id="reserve_time" name="reserve_time" style="width: 80px; display: inline;">
                        <?php $times = ['10:00', '14:00', '19:00']; ?>
                        <?php foreach ($times as $time){ ?>
                            <option value="<?= $time;?>" <?= $time == \Input::post('time', '') ? ' selected' : ''; ?>> <?= $time;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="date">可预订</label>
                <span id="reserveNum" style="color: red; font-size: 15pt;">0</span>
                <span>间</span>
            </div>
        </div>
    </div>

    <hr class="whiter m-t-20">

    <div class="block-area">
        <h3 class="block-title">联系信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="name">姓名</label>
                <input type="text" class="form-control input-sm" id="name" name="name" placeholder="请填写预订人姓名">
            </div>

            <div class="form-group">
                <label for="phone">电话</label>
                <input type="text" class="form-control input-sm" id="phone" name="phone" placeholder="请填写联系人电话">
            </div>

            <div class="form-group">
                <label for="phone">备注</label>
                <textarea name="remark" class="form-control input-sm" id="remark" placeholder="备注信息"></textarea>
            </div>

            <button type="button" id="btnSubmit" class="btn btn-sm m-t-10">保存预订</button>
        </div>
    </div>

    <hr class="whiter m-t-20">
</form>

<?php
$msg = \Session::get_flash('msg', false);
$msg = $msg ? json_encode($msg, JSON_UNESCAPED_UNICODE) : 'undefined';
$script = <<<js
    var _msg = {$msg};
js;

\Asset::js($script, [], 'before-script', true);

\Asset::css(['lightbox.css', 'uploadifive/css/uploadifive.css'], [], 'css-files', false);
\Asset::js(['modules/admin/super/room/add_reserve.js'], [], 'js-files', false);

?>