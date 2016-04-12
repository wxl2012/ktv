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