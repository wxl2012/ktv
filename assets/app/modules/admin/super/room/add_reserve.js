var submiting = false;

$(function () {

    if(_msg != undefined){
        if(_msg.status == 'err'){
            $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn().text(_msg.msg);
        }else{
            $('.alert').removeClass('alert-danger').addClass('alert-success').fadeIn().text('预约成功');
        }
    }


    $('#room_id,#reserve_date').change(function () {

        $.post('/api/room/reserve/get_rooms.json',
            {
                room_id: $('#room_id').val(),
                date: $('#reserve_date').val()
            },
            function (data) {
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }

                $('#reserveNum').text(data.data);
            }, 'json');
    });

    $('#btnSubmit').click(function () {
        var msg = '';
        if($('#name').val().length < 1){
            msg = '请填写预约人姓名';
        }else if($('#phone').val().length < 1){
            msg = '请填写预约人联系电话';
        }else if($('#reserve_date').val().length < 1){
            msg = '请填写预约日期';
        }else if($('#reserve_time').val().length < 1){
            msg = '请填写预约时间';
        }

        if(msg != ''){
            $('.alert').removeClass('alert-success').addClass('alert-danger').fadeIn().text(msg);
            hideAlert();
            return;
        }

        $('#frmReserve').submit();
    });

    $('#room_id').trigger('change');

});

function hideAlert() {
    setTimeout(function () {
        $('.alert').fadeOut();
    }, 5000);
}