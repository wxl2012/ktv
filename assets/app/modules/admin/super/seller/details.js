$(function () {

    if(_msg != undefined){
        if(_msg.status == 'err'){
            $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn().text(_msg.msg);
        }else{
            $('.alert').removeClass('alert-danger').addClass('alert-success').fadeIn().text('操作成功');
        }
    }

    $('.btnSubmit').click(function(){
        var msg = '';
        if($('#name').val().length < 1){
            msg = '商户名称必须填写';
        }else if($('#tel').val().length < 1){
            msg = '商户电话必须填写';
        }else if($('#address').val().length < 1){
            msg = '商户地址必须填写';
        }

        if(msg){
            $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn().text(msg);
            setTimeout(function () {
                $('.alert').fadeOut();
            }, 5000);
            return false;
        }

        return true;
    });
});