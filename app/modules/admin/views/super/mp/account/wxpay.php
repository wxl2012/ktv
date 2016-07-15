<form role="form" method="post">
    <?= \Form::csrf();?>
    <div class="block-area">
        <div class="alert alert-success" style="display: none;">
        </div>
        <h3 class="block-title">基本信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="email">公众号AppID</label>
                <input type="text" class="form-control input-sm" id="email" name="email" value="<?= isset($item) && $item ? $item->email : ''; ?>" placeholder="公众号App ID">
            </div>

            <div class="form-group">
                <label for="access_id">商户号</label>
                <input type="text" class="form-control input-sm" id="access_id" name="access_id" value="<?= isset($item) && $item ? $item->access_id : ''; ?>" placeholder="微信支付商户号">
            </div>

            <div class="form-group">
                <label for="access_key">支付密钥</label>
                <input type="text" class="form-control input-sm" id="access_key" name="access_key" value="<?= isset($item) && $item ? $item->access_key : ''; ?>" placeholder="微信支付密钥">
            </div>

            <div class="form-group">
                <label for="enable">是否启用</label>
                <select class="form-control" name="enable" id="enable">
                    <option value="NONE"<?= isset($item) && $item && $item->enable == 'NONE' ? ' selected' : '';?>>未设置</option>
                    <option value="ENABLE"<?= isset($item) && $item && $item->enable == 'ENABLE' ? ' selected' : '';?>>正常</option>
                    <option value="DISENABLE"<?= isset($item) && $item && $item->enable == 'DISENABLE' ? ' selected' : '';?>>禁用</option>
                </select>
            </div>

            <button class="btn btn-sm m-t-10 btnSubmit">保存</button>
        </div>
    </div>
</form>

<?php
$msg = \Session::get_flash('msg', false);
$msg = $msg ? json_encode($msg, JSON_UNESCAPED_UNICODE) : 'undefined';
$script = <<<js
    var _msg = {$msg};
js;

\Asset::js($script, [], 'before-script', true);
\Asset::js(['pirobox.min.js', 'modules/admin/super/wxaccount/wxpay.js'], [], 'js-files', false);

?>