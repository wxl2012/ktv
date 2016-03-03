<!-- Table Hover -->
<div class="block-area" id="tableHover">
    <h3 class="block-title">包房管理</h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <thead>
            <tr>
                <th>房间名称</th>
                <th>房费(白天)</th>
                <th>房费(夜晚)</th>
                <th>预订费(白天)</th>
                <th>预订费(夜晚)</th>
                <th>最低消费</th>
                <th>已售</th>
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
                    <td><?php echo $item->sale_total; ?></td>
                    <td></td>
                </tr>
            <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="text-right">
                        <ul class="pagination">
                            <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>