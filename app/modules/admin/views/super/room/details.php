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