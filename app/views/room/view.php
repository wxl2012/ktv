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
                <i class="fa fa-angle-left" style="font-size: 2em; color: #fff;"></i>
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
        <div class="col-xs-8">
            <span style="color: #06c1ae; font-size: 1.4em;"><?php echo $item->day; ?></span> 元
        </div>
        <div class="col-xs-4 text-right">
            <a class="btn btn-warning buy">立即预订</a>
        </div>
    </div>
    <hr style="height: 1px; border: none; border-top: 1px dashed #0066cc;">

    <div class="row" style="color: #aaa;">
        <div class="col-xs-12">
            <?php echo htmlspecialchars_decode($item->body);?>
        </div>
        <div class="col-xs-12">
            <?php if($item->sale_total){ ?>
                <i class="fa fa-shopping-cart"></i>
                已售 <?php echo $item->sale_total; ?>
            <?php } ?>

        </div>
    </div>
</div>

<a href="/room/reserve" class="btn btn-warning buy" style="width:100%; margin-bottom: 10px;">立即预订</a>

<script type="text/javascript" src="/assets/third-party/swiper/3.2.7/js/swiper.min.js"></script>
<script type="text/javascript">
    $(function(){
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            slidesPerView: 1,
            paginationClickable: true,
            spaceBetween: 30,
            autoplay: 2500,
            loop: true
        });
    });
</script>