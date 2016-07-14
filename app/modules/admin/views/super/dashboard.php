
<hr class="whiter" />

<!-- Quick Stats -->
<div class="block-area">
    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats">
                <div id="stats-line-2" class="pull-left"></div>
                <div class="data">
                    <h2 data-value="<?= $today; ?>">0</h2>
                    <small>今日收入</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">
                <div id="stats-line-3" class="pull-left"></div>
                <div class="media-body">
                    <h2 data-value="<?= $week; ?>">0</h2>
                    <small>本周收入</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">

                <div id="stats-line-4" class="pull-left"></div>

                <div class="media-body">
                    <h2 data-value="<?= $month; ?>">0</h2>
                    <small>本月收入</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">
                <div id="stats-line" class="pull-left"></div>
                <div class="media-body">
                    <h2 data-value="<?= $total; ?>">0</h2>
                    <small>总收入</small>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
    \Asset::js([
        'charts/jquery.flot.js',
        'charts/jquery.flot.time.js',
        'charts/jquery.flot.animator.min.js',
        'charts/jquery.flot.resize.min.js',
        'sparkline.min.js',
        'easypiechart.js',
        'charts.js',
        'maps/jvectormap.min.js',
        'maps/usa.js',
        'icheck.js',
        'scroll.min.js',
    ], [], 'js-files', false);
?>