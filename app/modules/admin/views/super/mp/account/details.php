<style type="text/css">
    .img-thumbnail{
        width: 60px;
    }
    .select{
        border: 2px dashed green
    }
    .uploadifive-queue-item{
        background-color: #333333 !important;
    }
</style>
<div class="block-area">
    <h3 class="block-title">基本信息</h3>
    <div class="tile p-15">
        <form role="form">
            <div class="form-group">
                <label for="room_no">公众号</label>
                <input type="text" class="form-control input-sm" id="room_no" name="room_no" placeholder="请填写包房号码">
            </div>

            <div class="form-group">
                <label for="name">OpenID</label>
                <input type="text" class="form-control input-sm" id="name" name="name" placeholder="请填写包房名称">
            </div>

            <div class="form-group">
                <label for="title">AppSecret</label>
                <input type="text" class="form-control input-sm" id="title" name="title" placeholder="请填写包房名称">
            </div>
        </form>
    </div>
</div>

<hr class="whiter m-t-20">

<div class="block-area">
    <h3 class="block-title">对接信息</h3>
    <div class="tile p-15">
        <div class="tile p-15">
            <form role="form">
                <div class="form-group">
                    <label for="room_no">URL地址</label>
                    <input type="text" class="form-control input-sm" id="room_no" name="room_no" placeholder="请填写包房号码">
                </div>

                <div class="form-group">
                    <label for="name">token</label>
                    <input type="text" class="form-control input-sm" id="name" name="name" placeholder="请填写包房名称">
                </div>

                <div class="form-group">
                    <label for="title">加解密字符串</label>
                    <input type="text" class="form-control input-sm" id="title" name="title" placeholder="请填写包房名称">
                </div>

                <div class="form-group">
                    <label for="name">接入状态</label>
                    <div class="row">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<hr class="whiter m-t-20">

<div class="block-area">
    <h3 class="block-title">登录信息</h3>
    <div class="tile p-15">
        <div class="tile p-15">
            <form role="form">
                <div class="form-group">
                    <label for="room_no">用户名</label>
                    <input type="text" class="form-control input-sm" id="room_no" name="room_no" placeholder="请填写包房号码">
                </div>

                <div class="form-group">
                    <label for="name">密码</label>
                    <input type="text" class="form-control input-sm" id="name" name="name" placeholder="请填写包房名称">
                </div>
            </form>
        </div>
    </div>
</div>

<?php

\Asset::js(['pirobox.min.js', 'modules/admin/super/room/details.js'], [], 'js-files', false);

?>