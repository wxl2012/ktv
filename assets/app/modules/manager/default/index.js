$(function () {

    $('.list-group-item').click(function () {
        if($(this).attr('origal-url') == undefined){
            return;
        }

        window.location.href = $(this).attr('origal-url');
    });
});