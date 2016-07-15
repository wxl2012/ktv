<form role="form" method="POST">
    <?= \Form::csrf();?>
    <div class="block-area">
        <div class="alert alert-success" style="display: none;">
        </div>
        <h3 class="block-title">基本信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="room_no">商家名称</label>
                <input type="text" class="form-control input-sm" id="name" name="name" value="<?= isset($seller) && $seller ? $seller->name: ''; ?>" placeholder="请填写商家名称">
            </div>

            <div class="form-group">
                <label for="name">商家名称(简称)</label>
                <input type="text" class="form-control input-sm" id="short_name" name="short_name" value="<?= isset($seller) && $seller ? $seller->short_name: ''; ?>" placeholder="请填写商家名称">
            </div>

            <div class="form-group">
                <label for="title">商家店面</label>
                <input type="text" class="form-control input-sm" id="thumbnail" name="thumbnail" value="<?= isset($seller) && $seller ? $seller->thumbnail: ''; ?>" placeholder="店面图片地址">
            </div>

            <div class="form-group">
                <label for="title">简介</label>
                <textarea class="form-control" id="summary" name="summary" placeholder="商家介绍信息,显示于商家首页"><?= isset($seller) && $seller ? htmlspecialchars_decode($seller->summary) : ''; ?></textarea>
            </div>
        </div>
    </div>

    <hr class="whiter m-t-20">

    <div class="block-area">
        <h3 class="block-title">联系信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="day">地址</label>
                <input type="text" class="form-control input-sm" id="address" name="address" value="<?= isset($seller) && $seller ? $seller->address: ''; ?>" placeholder="详细地址">
            </div>

            <div class="form-group">
                <label for="night">电话</label>
                <input type="text" class="form-control input-sm" id="tel" name="tel" value="<?= isset($seller) && $seller ? $seller->tel: ''; ?>" placeholder="联系电话">
            </div>

            <div class="form-group hide">
                <label for="night">导航位置</label><br>
                <input type="text" class="form-control input-sm" style="display:inline; width: 100px;" id="lng" name="lng" placeholder="经度">
                <input type="text" class="form-control input-sm" style="display:inline; width: 100px;" id="lat" name="lat" placeholder="纬度">
                <a href="javscript:;" class="btn btn-sm" style="margin-top: -3px;">点选位置</a>
            </div>

            <button id="btnSubmit" class="btn btn-sm m-t-10">保存</button>
        </div>
    </div>
</form>

<hr class="whiter m-t-20">

<?php
$msg = \Session::get_flash('msg', false);
$msg = $msg ? json_encode($msg, JSON_UNESCAPED_UNICODE) : 'undefined';
$script = <<<js
    var _msg = {$msg};
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js(['modules/admin/super/seller/details.js'], [], 'js-files', false);

?>