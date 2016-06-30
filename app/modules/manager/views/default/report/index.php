<div class="row">
    <div class="col-xs-12 text-center" style="padding: 10px 0px; font-size: 16pt;">
        数据统计图表
        <hr style="width: 90%; margin-bottom: 0px; border: 1px dashed; color: #aaa;">
    </div>
</div>

<canvas id="chartOrder"></canvas>

<canvas id="chartReserve"></canvas>

<?php
$seller = \Session::get('seller', false);
$sid = $seller ? $seller->id : 0;
$token = \Session::get('access_token', '');

$script = <<<js
    var _access_token = '{$token}';
    var _seller_id = {$sid};
js;

\Asset::js($script, [], 'before-script', true);

\Asset::js(['http://cdn.bootcss.com/Chart.js/2.1.6/Chart.bundle.min.js', 'modules/manager/default/report/index.js'], [], 'js-files', false);
?>