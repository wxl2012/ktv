$(function(){

    var ispay = false;

    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-orange',
        radioClass: 'iradio_flat-orange'
    });

    $('#btnPay').click(function(){

        if(ispay){
            wxpay();
            return;
        }

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
        };

        $('#btnPay').addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i> 处理中...');
        $.post('', 
            params,
            function (data) {
                $('#btnPay').removeClass('disabled').html('确认支付');
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }

                ispay = true;
                $.get('/wxpay?order_id=' + data.data.id,
                    function (data) {
                        if(data.status == 'err'){
                            alert(data.msg);
                            return;
                        }
                        _app_id = data.data.appId;
                        _time_stamp = data.data.timeStamp;
                        _nonce_str = data.data.nonceStr;
                        _package = data.data.package;
                        _sign_type = data.data.signType;
                        _pay_sign = data.data.paySign;
                        _to_url = data.data.to_url;
                        wxpay();
                    }, 'json');

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
    $('#payStatusModal').modal('show');
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

function finish() {
    window.location.href = _to_url;
}