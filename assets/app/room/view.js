requirejs.config({
    baseUrl: '/assets/app',
    paths: {
        jquery: 'http://lib.sinaapp.com/js/jquery/1.10.2/jquery-1.10.2.min',
        swiper: '/assets/third-party/swiper/3.2.7/js/swiper.min'
    }
});

requirejs(['jquery', 'swiper'], function(jquery, swiper) {

    $(function(){

        $('.buy').click(function(){
            console.log('buy button');
        });

        var swiperContainer = new Swiper('.swiper-container', {
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

});