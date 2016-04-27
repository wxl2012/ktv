<!-- Table Hover -->
<div class="block-area" id="tableHover">
    <h3 class="block-title">预订管理</h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <thead>
            <tr>
                <th>预订日期</th>
                <th>预订时间段</th>
                <th>预订状态</th>
                <th>房间名称</th>
                <th>预订人</th>
                <th>预订电话</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if($items){ ?>
                <?php foreach ($items as $item) { ?>
                    <tr data-id="<?php echo $item->id; ?>">
                        <td><?php echo date('Y-m-d', $item->begin_at); ?></td>
                        <td><?php echo date('H:i', $item->begin_at); ?></td>
                        <td>
                            <label class="label label-<?php echo \Model_RoomReserve::$_maps['label'][$item->status]; ?>">
                                <?php echo \Model_RoomReserve::$_maps['status'][$item->status]; ?>
                            </label>
                        </td>
                        <td><?php echo $item->room->name; ?></td>
                        <td><?php echo $item->name; ?></td>
                        <td><?php echo $item->phone; ?></td>
                        <td>
                            <?php if($item->status == 'TIMEOUT'){ ?>
                                <a href="javascript:;" class="btn btn-danger" title="删除预订"><i class="fa fa-trash-o"></i></a>
                            <?php }else if($item->status == 'NONE'){ ?>
                                <a href="javascript:;" class="btn btn-reply" title="撤消预订"><i class="fa fa-reply"></i></a>
                            <?php }else if($item->status == 'SUCCESS'){ ?>
                                <a href="javascript:;" class="btn btn-success-outline" title="消费" role="action-use"><i class="fa fa-check"></i></a>
                                <!--<a href="javascript:;" class="btn btn-success-outline" title="延缓消费时间"><i class="fa fa-clock-o"></i></a>
                                <a href="javascript:;" class="btn btn-reply" title="撤消预订"><i class="fa fa-reply"></i></a>-->
                            <?php } ?>
                        </td>
                    </tr>
                <?php }?>
            <?php }else{ ?>
                <tr>
                    <td colspan="7" class="text-center">没有相关记录</td>
                </tr>
            <?php } ?>

            </tbody>

            <?php if(isset($pagination) && $pagination) { ?>
                <tfoot>
                <tr>
                    <td colspan="7" class="text-right">
                        <?php echo htmlspecialchars_decode($pagination);?>
                    </td>
                </tr>
                </tfoot>
            <?php } ?>

        </table>
    </div>
</div>

<?php
\Asset::js(['modules/admin/super/room/reserve.js'], [], 'js-files', false);
?>