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
    <h3 class="block-title">包房管理</h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <thead>
            <tr>
                <th>房间名称</th>
                <th>预订费</th>
                <th>数量</th>
                <th>图库</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr data-id="0">
                <td><input type="text" class="form-control" name="name" value="<?php echo \Input::get('name', ''); ?>"></td>
                <td><input type="number" class="form-control" name="price" value="<?php echo \Input::get('price', ''); ?>"></td>
                <td><input type="number" class="form-control" name="total" value="<?php echo \Input::get('total', ''); ?>"></td>
                <td></td>
                <td>
                    <a href="javascript:;" class="btn btn-search" title="查询"><i class="fa fa-search"></i></a>
                    <a href="javascript:;" class="btn btn-plus" title="保存一个新包房"><i class="fa fa-plus"></i></a>
                </td>
            </tr>
            <?php foreach ($items as $item) { ?>
                <tr data-id="<?php echo $item->id; ?>">
                    <td><input type="text" class="form-control" name="name" value="<?php echo $item->name; ?>"></td>
                    <td><input type="number" class="form-control" name="price" value="<?php echo $item->price; ?>"></td>
                    <td><input type="number" class="form-control" name="total" value="<?php echo $item->total; ?>"></td>
                    <td class="text-center">
                        <?php echo $item->galleries ? "共有" . count($item->galleries) . "张图片<br>" : "点击管理图库<br>" ?>
                        <a href="/admin/room/save/<?= $item->id; ?>" class="btn"><?php echo "点击管理图库" ?></a>
                    </td>
                    <td>
                        <a href="javascript:;" class="btn btn-primary" title="保存"><i class="fa fa-check"></i></a>
                        <a href="javascript:;" class="btn btn-danger" title="删除"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php }?>
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
    \Asset::js(['url_util.js', 'modules/admin/super/room/index.js'], [], 'js-files', false);
?>