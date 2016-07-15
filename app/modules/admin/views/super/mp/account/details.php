<form role="form" method="post">
    <?= \Form::csrf();?>
    <div class="block-area">
        <div class="alert alert-success" style="display: none;">
        </div>
        <h3 class="block-title">基本信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="nickname">公众号</label>
                <input type="text" class="form-control input-sm" id="nickname" name="nickname" value="<?= isset($item) && $item ? $item->nickname : ''; ?>" placeholder="公众号名称">
            </div>

            <div class="form-group">
                <label for="summary">描述</label>
                <textarea class="form-control" id="summary" name="summary" placeholder="公众号描述信息"><?= isset($item) && $item ? $item->summary : ''; ?></textarea>
            </div>

            <button class="btn btn-sm m-t-10 btnSubmit">保存</button>
        </div>
    </div>

    <hr class="whiter m-t-20">

    <div class="block-area">
        <h3 class="block-title">开发者信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="name">OpenID</label>
                <input type="text" class="form-control input-sm" id="open_id" name="open_id" value="<?= isset($item) && $item ? $item->open_id : ''; ?>" placeholder="应用ID">
            </div>

            <div class="form-group">
                <label for="title">AppSecret</label>
                <input type="text" class="form-control input-sm" id="app_secret" name="app_secret" value="<?= isset($item) && $item ? $item->app_secret : ''; ?>" placeholder="应用密钥">
            </div>

            <button class="btn btn-sm m-t-10 btnSubmit">保存</button>
        </div>
    </div>

    <hr class="whiter m-t-20">

    <div class="block-area">
        <h3 class="block-title">对接信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="url">URL地址</label>
                <input type="text" class="form-control input-sm" id="url" name="url" value="<?= isset($item) && $item ? \Config::get('base_url') . "wxapi/action/{$item->id}" : ''; ?>" placeholder="对接接口地址，保存后可查看" readonly>
            </div>

            <div class="form-group">
                <label for="token">token</label>
                <input type="text" class="form-control input-sm" id="token" name="token" value="<?= isset($item) && $item ? $item->token : md5(time()); ?>" placeholder="对接接口token" readonly>
            </div>

            <div class="form-group">
                <label for="encoding_ase_key">加解密字符串</label>
                <input type="text" class="form-control input-sm" id="encoding_ase_key" name="encoding_ase_key" placeholder="消息加解密字符串">
            </div>

            <div class="form-group">
                <label for="name">接入状态</label>
                <select class="form-control input-sm" id="status" name="status">
                    <?php foreach (\Model_WXAccount::$_maps['status'] as $k => $v){ ?>
                        <option value="<?= $k?>"<?= isset($item) && $item && $k == $item->status ? ' selected' : ''; ?>><?= $v; ?></option>
                    <?php } ?>
                </select>
            </div>

            <button class="btn btn-sm m-t-10 btnSubmit">保存</button>
        </div>
    </div>

    <hr class="whiter m-t-20">

    <div class="block-area">
        <h3 class="block-title">登录信息</h3>
        <div class="tile p-15">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" class="form-control input-sm" id="username" name="username" value="<?= isset($item) && $item ? $item->username : ''; ?>" placeholder="登录mp.weixin.qq.com的帐户（非必填）">
            </div>

            <div class="form-group">
                <label for="password">密码</label>
                <input type="text" class="form-control input-sm" id="password" name="password" value="<?= isset($item) && $item ? $item->password : ''; ?>" placeholder="登录mp.weixin.qq.com的密码（非必填）">
            </div>

            <div class="form-group">
                <label for="email">注册邮箱</label>
                <input type="email" class="form-control input-sm" id="email" name="email" value="<?= isset($item) && $item ? $item->email : ''; ?>" placeholder="绑定公众号的邮箱">
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
\Asset::js(['pirobox.min.js', 'modules/admin/super/room/details.js'], [], 'js-files', false);

?>