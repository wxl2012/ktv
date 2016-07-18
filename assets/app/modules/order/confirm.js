$(function () {

    $('input').iCheck({
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    $('input').on('ifChecked ifUnchecked', function (event) {
        if(event.type == 'ifChecked'){
            var payment = $(this).val() == 'wxpay' ? '微信支付' : '支付宝支付';
            var paymentImg = $(this).val() == 'wxpay' ? '/assets/img/wxpay.png' : '/assets/img/alipay.jpg';
            $('#btnChangePayment').prev().text(payment).prev().attr('src', paymentImg);
            $('#payments').fadeOut();
            _payment = $(this).val();
        }
    });

    $('#btnChangePayment').click(function () {
        $('#payments').fadeIn();
    });

    $('#btnPay').click(function () {
        if(_payment == 'wxpay'){
            wxpay();
        }else if(_payment == 'alipay'){
            alert('支付宝支付');
        }
    });

    var timer = setInterval(function () {
        var now = parseInt(new Date().getTime() / 1000);
        if(now > _end_at){
            $('.alert').removeClass('alert-warning').addClass('alert-danger').text('订单支付超时！');
            clearInterval(timer);
        }
        countDown(_end_at, undefined, 'timeDownHour', 'timeDownMinute', 'timeDownSecond')
    }, 1000);

    loadGoods();

    loadCoupon();

});

function loadGoods() {
    $.get('/api/order/marketing/get/' + _order_id + '.json',
        function (data) {
            if(data.status == 'err'){
                return;
            }

            var items = data.data.details;
            for(var key in items){
                $('#goodsItems').append(goodsItem, items[key], null);
            }

        }, 'json');
}

function loadCoupon() {
    $.get('/api/user/coupons/' + _user_id + '.json',
        function (data) {
            if(data.status == 'err'){
                return;
            }

            var items = data.data;
            if(items.length < 1){
                return;
            }

            for(var i = 0; i < items.length; i ++){
                $('#coupons .list-group').append(couponItem, items[i], null);
            }

        }, 'json');
}

function wxpay() {
    $.get('/wxpay',
        {
            account_id: _account_id,
            openid: _open_id,
            order_id: _order_id
        },
        function (data) {

            if(data.status == 'err'){
                alert(data.msg);
                window.location.href = '/ucenter/order';
                return;
            }

            var item = data.data;
            wx.chooseWXPay({
                appId: item.appId,
                timestamp: item.timeStamp,
                nonceStr: item.nonceStr,
                package: item.package,
                signType: item.signType,
                paySign: item.paySign,
                success: function (res) {
                    window.location.href = item.to_url;
                },
                cancel: function (res) {
                    window.location.href = item.to_url;
                },
                fail: function (res) {
                    alert('支付时发生异常,异常信息：' + JSON.stringify(res));
                    window.location.href = item.to_url;
                }
            });
        }, 'json');
}