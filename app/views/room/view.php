<link rel="stylesheet" type="text/css" href="/assets/third-party/swiper/3.2.7/css/swiper.min.css">
<style type="text/css">
    .navbar-blue{
        background-color: #337ab7;
    }
</style>
<nav class="navbar navbar-blue navbar-fixed-top" style="border-bottom: 1px solid #C6C0B3;">
    <div class="container-fluid">
        <div class="row" style="line-height: 50px; margin-left: 0px; margin-right: 0px;">
            <div class="col-xs-2">
                <a href="javascript:history.back();">
                    <i class="fa fa-angle-left" style="font-size: 2em; color: #fff;"></i>
                </a>
            </div>
            <div class="col-xs-8 text-center" style="color: #fff; font-size: 13pt; font-weight: 600;">
                包房详情
            </div>
            <div class="col-xs-2">
            </div>
        </div>
    </div>
</nav>

<div class="container" style="margin-top: 52px; padding-top: 10px; padding-bottom: 15px; background-color: #fff;">
    <div class="row">
        <div class="col-xs-12">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($item->galleries as $key => $value) { ?>
                        <?php if( ! $value->attachment){ continue; }?>
                        <div class="swiper-slide">
                            <img src="<?php echo $value->attachment->url; ?>" alt="" style="width:100%;"/>
                        </div>
                    <?php } ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-6">
            <span style="color: #06c1ae; font-size: 1.4em;"><?php echo $item->day; ?></span> 元
        </div>
        <div class="col-xs-6 text-right" style="line-height: 28px;">
            <i class="fa fa-shopping-cart"></i>
            已售 <?php echo $item->sale_total; ?>
        </div>
    </div>
    <hr style="height: 1px; border: none; border-top: 1px dashed #0066cc;">

    <ul class="list-group">
        <li class="list-group-item active">
            商家信息
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-2" style="padding-right: 0px;">地址:</div>
                <div class="col-xs-10"><?php echo $item->seller->address; ?></div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-2" style="padding-right: 0px;">电话:</div>
                <div class="col-xs-10"><?php echo $item->seller->tel; ?></div>
            </div>
        </li>
    </ul>

    <hr style="height: 1px; border: none; border-top: 1px dashed #0066cc;">

    <div class="row" style="color: #aaa;">
        <div class="col-xs-12">
            <?php echo htmlspecialchars_decode($item->body);?>
        </div>
    </div>
</div>

<nav class="navbar navbar-default navbar-fixed-bottom" style="min-height: 0px; background-color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12" style="padding: 5px 15px;">
                <a href="/room/reserve?id=<?php echo $item->id; ?>" class="btn btn-warning buy" style="width:100%;">立即预订</a>
            </div>
        </div>
    </div>
</nav>

<?php
\Asset::js(['swiper/3.2.7/js/swiper.jquery.min.js', 'room/view.js'], [], 'js-files', false);
?>