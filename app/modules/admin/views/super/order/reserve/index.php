<!-- Table Hover -->
<div class="block-area" id="tableHover">
    <h3 class="block-title">预订管理</h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <thead>
            <tr>
                <th>预订日期</th>
                <th>预订时间段</th>
                <th>房间名称</th>
                <th>预订人</th>
                <th>预订电话</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item) { ?>
                <tr>
                    <td><?php echo $item->name; ?></td>
                    <td><?php echo $item->price; ?></td>
                    <td><?php echo $item->price; ?></td>
                    <td><?php echo $item->day; ?></td>
                    <td><?php echo $item->night; ?></td>
                    <td><?php echo $item->minimum; ?></td>
                    <td></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>