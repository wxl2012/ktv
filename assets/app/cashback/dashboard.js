$(function(){
    $('li[original-url]').click(function () {
        console.log('aa');
        console.log($(this).attr('original-url'));
    });
});