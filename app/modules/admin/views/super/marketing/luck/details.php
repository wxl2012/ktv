<form role="form" method="post">
    <div class="block-area">
        <h3 class="block-title">活动详情</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="title">活动标题</label>
                <input type="text" class="form-control input-sm" id="title" name="title" placeholder="请填写活动标题" value="<?= isset($item) && $item ? $item->parent->title : ''; ?>">
            </div>

            <div class="form-group hide">
                <label for="start_at">活动开始时间</label>
                <input type="text" class="form-control input-sm" id="start_at" name="start_at" placeholder="请填写活动起始时间" value="<?= isset($item) && $item ? date('Y-m-d H:i:s', $item->parent->start_at) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="no">活动期号</label>
                <input type="text" class="form-control input-sm" id="no" name="no" placeholder="请填写活动期号" value="<?= isset($item) && $item ? $item->no : ''; ?>">
            </div>

            <div class="form-group">
                <label for="start_no">起始号码</label>
                <input type="text" class="form-control input-sm" id="start_no" name="start_no" value="10000000" placeholder="购买时发放的起始号码" value="<?= isset($item) && $item ? $item->parent->start_at : ''; ?>">
            </div>

            <div class="form-group">
                <label for="total">总人次</label>
                <input type="text" class="form-control input-sm" id="total" name="total" placeholder="总参与人数" value="<?= isset($item) && $item ? $item->total : ''; ?>">
            </div>
        </div>
    </div>

    <hr class="whiter m-t-20">

    <div class="block-area">
        <h3 class="block-title">活动商品</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="day">关联包房</label>
                <select class="form-control input-sm" id="goods_id" name="goods_id"></select>
            </div>

            <button type="submit" class="btn btn-sm m-t-10">发布活动</button>
        </div>
    </div>

    <hr class="whiter m-t-20">

    <div class="block-area">
        <h3 class="block-title">胜出信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="open_at">揭晓时间</label>
                <input class="form-control input-sm" value="<?= isset($item) && $item && $item->open_at ? date('Y-m-d', $item->open_at) : ''; ?>" readonly/>
            </div>

            <div class="form-group">
                <label for="win_no">胜出编号</label>
                <input class="form-control input-sm" value="<?= isset($item) && $item && $item->win_no ? $item->win_no : ''; ?>" readonly/>
            </div>

            <div class="form-group">
                <label for="win_user">胜出人</label>
                <input class="form-control input-sm" value="<?= isset($item) && $item && $item->win_user ? $item->win_user->nickname : ''; ?>" readonly/>
            </div>
        </div>
    </div>
</form>
<?php

$seller = \Session::get('seller');
$script = <<<js
    var _seller_id = {$seller->id};
js;

\Asset::js($script, [], 'before-script', true);
\Asset::js(['pirobox.min.js', 'modules/admin/super/marketing/luck/details.js'], [], 'js-files', false);

?>