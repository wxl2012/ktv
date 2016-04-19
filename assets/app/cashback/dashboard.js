$(function(){
    $('li[original-url]').click(function () {
        window.location.href = $(this).attr('original-url');
    });
});