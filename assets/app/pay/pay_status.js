$(function () {
    $('#btnFinish').click(function () {
        if(_pay_status){
            wx.closeWindow();
        }else{
            window.location.href = '/ucenter/orders';
        }
    });
});