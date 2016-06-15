var submiting = false;

$(function () {

    $('.btn-group button').click(function () {
        $('.btn-group button').removeClass('active');
        $(this).addClass('active');
    });

    $('#btnSubmit').click(function () {
        var msg = '';
        if($('#name').val().length < 1){
            msg = '请填写预约人姓名';
        }else if($('#phone').val().length < 1){
            msg = '请填写预约人联系电话';
        }else if($('#date').val().length < 1){
            msg = '请填写预约日期';
        }else if($('#time').val().length < 1){
            msg = '请填写预约时间';
        }

        if(msg != ''){
            $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn().text(msg);
            hideAlert();
            return;
        }

        if(submiting){
            return;
        }
        submiting = true;

        $.post('',
            $('#frmReserve').serialize(),
            function (data) {
                submiting = false;
                if(data.status == 'err'){
                    $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn().text(data.msg);
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