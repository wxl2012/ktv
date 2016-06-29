var submiting = false;
$(function () {

    $('#btnSubmit').click(function () {

        if(submiting){
            return;
        }
        submiting = true;

        $.post('',
            $('#frmReserve').serialize(),
            function (data) {
                submiting = false;
                if(data.status == 'err'){
                    $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn().text(msg);
                    hideAlert();
                    return;
                }

                $('.alert').removeClass('alert-danger').addClass('alert-success').fadeIn().text('预约成功');
            }, 'json');

    });

});

function hideAlert() {
    setTimeout(function () {
        $('.alert').fadeOut();
    }, 5000);
}