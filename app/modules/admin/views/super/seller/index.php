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
                        <td></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>