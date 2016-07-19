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
    <h3 class="block-title">一元购活动列表</h3>
    <div class="table-responsive overflow">
        <?php if(isset($items) && $items){ ?>
            <table class="table table-bordered table-hover tile">
                <thead>
                <tr>
                    <th>标题</th>
                    <th>期号</th>
                    <th>总参与人数</th>
                    <th>已参与人数</th>
                    <th>包房</th>
                    <th>活动状态</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($items as $key => $value) { ?>
                    <tr data-id="<?= $value->parent->id;?>">
                        <td>
                            <?= $value->parent->title;?>
                        </td>
                        <td>
                            <?= $value->no;?>
                        </td>
                        <td>
                            <?= $value->total;?>
                        </td>
                        <td>
                            <?= $value->balance;?>
                        </td>
                        <td>
                            <?= $value->goods->name; ?>
                        </td>
                        <td>
                            <?= \Model_Marketing::$_maps['status'][$value->parent->status]; ?>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success" href="/admin/marketing/luck/save/<?= $value->id; ?>">
                                修改
                            </a>
                            <a class="btn btn-sm btn-danger" role="btnDel">
                                删除
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php if(isset($pagination) && $pagination){ ?>
                    <tfoot>
                    <tr>
                        <td colspan="9" style="text-align: right;">
                            <?php echo isset($pagination) && $pagination ? htmlspecialchars_decode($pagination) : ''; ?>
                        </td>
                    </tr>
                    </tfoot>
                <?php } ?>
            </table>
        <?php }else{ ?>
            <div style="border: 1px solid #e0e0e0; line-height: 300px; width: 100%; text-align: center;">
                未找到相关数据
            </div>
        <?php } ?>
    </div>
</div>
<?php
$script = <<<js
js;

\Asset::js($script, [], 'before-script', true);
\Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'modules/admin/super/marketing/luck/index.js'], [], 'js-files', false);

?>

<script type="text/x-jquery-tmpl" id="tr">
<tr data-id="0">
    <td class="center">
        <label class="pos-rel">
            <input type="checkbox" class="ace">
            <span class="lbl"></span>
        </label>
    </td>
    <td>
        <input type="text" name="title" value="" placeholder="活动标题">
    </td>
    <td>
        <input type="text" name="no" value="" placeholder="期号">
    </td>
    <td>
        <input type="text" name="total" value="" placeholder="总需金额" style="width: 80px;">
    </td>
    <td>
        <input type="text" name="balance" value="" placeholder="已参与金额" style="width: 80px;">
    </td>
    <td>
        <a href="javascript:;">选择商品</a>
    </td>
    <td>
        <select name="status">
            <option value="normal">正常</option>
            <option value="stop">停止</option>
        </select>
    </td>
    <td>
        <a class="btn btn-sm btn-success" role="btnSave">
            保存
        </a>
        <a class="btn btn-sm btn-danger" role="btnDel">
            删除
        </a>
    </td>
</tr>
</script>