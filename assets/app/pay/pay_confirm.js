$(function(){

    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-orange',
        radioClass: 'iradio_flat-orange'
    });

    $('#btnPay').click(function(){
        var params = {
            total_fee: _total_fee,
            order_name: '支付包房预订费用',
            order_body: '支付包房预订费',
            remark: _reserve_id,
            payment_type: 'wxpay',
            preferential_fee: _preferential_fee,
            original_fee: _original_fee,
            from_id: _seller_id,
            order_type: 'RESERVE',
            fuel_csrf_token: _token
        }
        $.post('', 
            params,
            function (data) {
                if(data.status == 'err'){
                    return;
                }
                /*if($('input[name=payment_type]').val() == 'wxpay'){
                    wxpay();
                 }*/
                wxpay();
            }, 'json');

    });

    $('#btnRetry').click(function(){
        if($('input[name=payment_type]').val() == 'wxpay'){
            wxpay();
        }
    });

    var timerDown = setInterval(function(){

        var now = new Date().getTime() / 1000;
        now = parseInt(now);
        if(_expire_at <= now){
            clearInterval(timerDown);
            $.post('/room/cancel',
                {
                    id: _reserve_id,
                    action: 1,
                },
                function (data) {
                    if(data.status == 'err'){
                        return;
                    }
                    $('#timeDownHour').parents('.alert').removeClass('alert-warning').addClass('alert-danger').text('订单支付超时, 系统自动取消订单!');
                }, 'json');
            return;
        }

        countDown(_expire_at, undefined, 'timeDownHour', 'timeDownMinute', 'timeDownSecond');
    }, 1000);

});


function wxpay(){
    wx.ready(function(){
         wx.chooseWXPay({
             appId: _app_id,
             timestamp: _time_stamp,
             nonceStr: _nonce_str,
             package: _package,
             signType: _sign_type,
             paySign: _pay_sign,
             success: function (res) {
                window.location.href = _to_url;
             },
             cancel: function(res){
                 window.location.href = _to_url;
             },
             fail: function(res){
                alert('支付失败!');
             }
         });
     });
}