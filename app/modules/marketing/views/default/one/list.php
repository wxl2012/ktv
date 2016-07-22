<style type="text/css">
    body{
        background-color: #F5F5F5;
    }
    .progress{
        height: 10px;
        margin-bottom: 0px;
    }
    .list-group-item{
        font-size: 9pt;
        padding-bottom: 0px;
    }
    .fa-plus-circle{
        color: #db3652;
        font-size: 3em;
    }
    .subtitle{
        line-height: 30px;
        color: #aaa;
    }
    #items .list-group-item a{
        color: #4a5c63;
        font-size: 10pt;
    }
    #items .list-group-item:first-child{
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }
    #items .list-group-item:last-child{
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
</style>

<div class="container-fluid" style="margin-top: 10px; padding: 0px;">
    <div class="list-group" id="items">
    </div>
</div>

<script type="jquery-tmpl" id="item">
    <div class="list-group-item">
        <a href="/marketing/luck/one/view/${id}">
            <div class="row">
                <div class="col-xs-3" style="padding-right: 0px;">
                    <img src="${goods.thumbnail}" style="width: 100%;">
                </div>
                <div class="col-xs-9" style="padding-left: 5px;" data-endAt="${end}">
                    <p class="title">
                        ${parent.title}
                    </p>
                    <!-- 进度条 -->
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="${total - balance}" aria-valuemin="0" aria-valuemax="100" style="width: ${total - balance}%;"></div>
                    </div>
                    <div class="subtitle">
                        <span class="pull-left">总需${total}人次</span>
                        <span class="pull-right btnBuy">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        <span class="pull-right" style="margin-right: 10px">
                            剩余${balance}
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</script>

<script type="jquery-tmpl" id="item-empty">
    <div class="list-group-item text-center">未找到相关数据!</div>
</script>

<?php
$script = <<<js
js;

\Asset::js($script, [], 'before-script', true);
\Asset::js(['jquery-tmpl/jquery.tmpl.min.js', 'jquery-tmpl/jquery.tmplPlus.min.js', 'modules/marketing/list.js'], [], 'js-files', false);
?>