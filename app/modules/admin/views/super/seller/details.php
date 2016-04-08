<div class="block-area">
    <h3 class="block-title">基本信息</h3>
    <div class="tile p-15">
        <form role="form">
            <div class="form-group">
                <label for="room_no">商家名称</label>
                <input type="text" class="form-control input-sm" id="name" name="name" placeholder="请填写商家名称">
            </div>

            <div class="form-group">
                <label for="name">商家名称(简称)</label>
                <input type="text" class="form-control input-sm" id="short_name" name="short_name" placeholder="请填写商家名称">
            </div>

            <div class="form-group">
                <label for="title">商家店面</label>
                <input type="text" class="form-control input-sm" id="thumbnail" name="thumbnail" placeholder="店面图片地址">
            </div>

            <div class="form-group">
                <label for="title">简介</label>
                <textarea class="form-control" id="summary" name="summary" placeholder="商家介绍信息,显示于商家首页"></textarea>
            </div>
        </form>
    </div>
</div>

<hr class="whiter m-t-20">

<div class="block-area">
    <h3 class="block-title">联系信息</h3>
    <div class="tile p-15">
        <form role="form">
            <div class="form-group">
                <label for="day">地址</label>
                <input type="text" class="form-control input-sm" id="day" name="day" placeholder="请填写白天预订包房费用">
            </div>

            <div class="form-group">
                <label for="night">电话</label>
                <input type="text" class="form-control input-sm" id="night" name="night" placeholder="请填写晚上预订包房费用">
            </div>

            <div class="form-group">
                <label for="night">导航位置</label><br>
                <input type="text" class="form-control input-sm" style="display:inline; width: 100px;" id="lng" name="lng" placeholder="经度">
                <input type="text" class="form-control input-sm" style="display:inline; width: 100px;" id="lat" name="lat" placeholder="纬度">
                <a href="javscript:;" class="btn btn-sm" style="margin-top: -3px;">点选位置</a>
            </div>

            <button type="submit" class="btn btn-sm m-t-10">保存</button>
        </form>
    </div>
</div>

<hr class="whiter m-t-20">