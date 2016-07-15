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
        if($('#access_id').val().length < 1){
            msg = '商户号必须填写';
        }else if($('#access_key').val().length < 1){
            msg = '支付密钥必须填写';
        }else if($('#email').val().length < 1){
            msg = '公众号APP ID必须填写';
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