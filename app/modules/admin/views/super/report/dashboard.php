<style type="text/css">
    td input{
        width: 100px !important;
    }
    .succ td input{
        border: 1px solid green;
        color: green;
    }
    .err td input{
        border: 1px solid red;
        color: red;
    }
</style>
<!-- Table Hover -->
<div class="block-area" id="tableHover">
    <div>
        <h3 class="block-title">
            收入统计
        </h3>
        <div class="pull-right">
            <select id="createAt" name="createAt" class="form-control input-sm">
                <option value="7">过去7天</option>
                <option value="15">过去15天</option>
                <option value="30">过去30天</option>
                <option value="3m">过去三个月</option>
            </select>
        </div>
    </div>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <thead>
            <tr>
                <th>店名</th>
                <th>统计时段</th>
                <th>收入总金额</th>
                <th>实际收总金额</th>
                <th>优惠总金额</th>
            </tr>
            </thead>
            <tbody>
            <?php if(isset($items) && $items){ ?>
                <?php foreach ($items as $item) { ?>
                    <tr data-id="<?php echo $item->id; ?>">
                        <td><?= $item['name']; ?></td>
                        <td><?= '7日内'; ?></td>
                        <td><?= $item['total_fee']; ?></td>
                        <td><?= $item['original_fee']; ?></td>
                        <td><?= $item['preferential_fee']; ?></td>
                    </tr>
                <?php }?>
            <?php }else{ ?>
                <tr>
                    <td colspan="5" class="text-center">
                        当前时段内无收入数据
                    </td>
                </tr>
            <?php } ?>

            </tbody>
            <tfoot style="display: none">
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
<?php
\Asset::js(['url_util.js', 'modules/admin/super/report/index.js'], [], 'js-files', false);
?>