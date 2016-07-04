<!-- Table Hover -->
<div class="block-area" id="tableHover">
    <h3 class="block-title">商家管理</h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <thead>
            <tr>
                <th>ID</th>
                <th>商家名称</th>
                <th>联系电话</th>
                <th>联系地址</th>
                <th>开业状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) { ?>
                    <tr>
                        <td><?php echo $item->id; ?></td>
                        <td><?php echo $item->short_name; ?></td>
                        <td><?php echo $item->tel; ?></td>
                        <td><?php echo $item->address; ?></td>
                        <td><?php echo $item->status; ?></td>
                        <td>
                            <a class="btn btn-default" data-toggle="modal" data-target="#myModal">绑定职员</a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">生成绑定码</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">所属商户</label>
                        <input type="text" class="form-control" id="seller_id" name="seller_id" placeholder="所属商户" value="" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">绑定码</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="绑定码" value="" />
                    </div>

                    <p class="help-block">绑定码</p>

                    <button type="submit" class="btn btn-default">生成绑定码</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>