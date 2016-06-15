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
                <label for="room_no">包房编号</label>
                <input type="text" class="form-control input-sm" id="room_no" name="room_no" placeholder="请填写包房号码">
            </div>

            <div class="form-group">
                <label for="name">包房名称</label>
                <input type="text" class="form-control input-sm" id="name" name="name" placeholder="请填写包房名称">
            </div>

            <div class="form-group">
                <label for="title">标题</label>
                <input type="text" class="form-control input-sm" id="title" name="title" placeholder="请填写包房名称">
            </div>

            <div class="form-group">
                <label for="name">可容纳人数</label>
                <div class="row">
                    <div class="col-md-2">
                        <input type="number" class="form-control input-sm" id="name" name="name" placeholder="最小容纳人数">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control input-sm" id="name" name="name" placeholder="最大容纳人数">
                    </div>
                </div>
            </div>

            <p>可容纳人数,内容必须为正整数类型</p>
        </form>
    </div>
</div>

<hr class="whiter m-t-20">

<div class="block-area">
    <h3 class="block-title">价格信息</h3>
    <div class="tile p-15">
        <form role="form">
            <div class="form-group">
                <label for="day">预订费(白天)</label>
                <input type="text" class="form-control input-sm" id="day" name="day" placeholder="请填写白天预订包房费用">
            </div>

            <div class="form-group">
                <label for="night">预订费(晚上)</label>
                <input type="text" class="form-control input-sm" id="night" name="night" placeholder="请填写晚上预订包房费用">
            </div>

            <div class="form-group">
                <label for="minimum">最低消费</label>
                <input type="text" class="form-control input-sm" id="minimum" name="minimum" placeholder="请填写最低消费金额">
            </div>

            <button type="submit" class="btn btn-sm m-t-10">保存包房数据</button>
        </form>
    </div>
</div>

<hr class="whiter m-t-20">

<div class="block-area">
    <h3 class="block-title">图库</h3>
    <div class="tile p-15" id="gallery">
        <a href="/assets/superadmin/img/gallery/1.jpg" data-rel="gallery"  class="pirobox_gall img-popup" title="Lovely evening in Noreway">
            <img src="/assets/superadmin/img/images-doc/thumbnail.png" class="img-thumbnail m-r-10 m-b-10" alt="">
        </a>
        <a id="btnAddGallery" data-toggle="modal" href="#modalGallery" title="新增图片" style="border: 3px dashed #aaa; padding: 25px 40px; font-size: 3em;">
            +
        </a>
    </div>
</div>


<div class="modal fade" id="modalGallery" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">图片管理</h4>
            </div>
            <div class="modal-body" style="padding-bottom: 0px;">
                <div class="tab-container tile">
                    <ul class="nav tab nav-tabs">
                        <li class="active"><a href="#zone">图片空间</a></li>
                        <li class=""><a href="#local">本地上传</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="zone">
                        </div>
                        <div class="tab-pane" id="local">
                            本地上传图片
                            <a id="btnUpload" class="btn btn-default">上传图片</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" id="btnChioce" data-dismiss="modal">确定</button>
                <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>

<script type="text/x-jquery-tmpl" id="imgItem">
    <a href="javascript:;" data-rel="gallery"  class="thumbnail-select" datd-id="${id}">
        <img src="${url}" class="img-thumbnail m-r-10 m-b-10" alt="">
    </a>
</script>

<?php

    \Asset::css(['lightbox.css', 'uploadifive/css/uploadifive.css'], [], 'css-files', false);
    \Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'pirobox.min.js', 'modules/admin/super/room/details.js', 'uploadifive/js/jquery.uploadifive.min.js'], [], 'js-files', false);

?>