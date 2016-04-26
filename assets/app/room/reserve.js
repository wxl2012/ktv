$(function () {

    $('#btnSubmit').click(function(){

        var msg = '';
        if($('#people_num').val().length < 1){
            msg = '请填写预订人数';
            $('#people_num').parent().addClass('has-error');
            $('#people_num').next().text(msg);
        }else if(isNaN($('#people_num').val())){
            msg = '预订人数必须是数字!';
            $('#people_num').parent().addClass('has-error');
            $('#people_num').next().text(msg);
        }

        if($('#name').val().length < 1){
            msg = '请填写预订人姓名';
            $('#name').parent().addClass('has-error');
            $('#name').next().text(msg);
        }
        if($('#phone').val().length < 1){
            msg = '请填写预订人联系电话';
            $('#phone').parent().addClass('has-error');
            $('#phone').next().text(msg);
        }else if(! ((/^1[3|4|5|8][0-9]\d{4,8}$/.test($('#phone').val())) && $('#phone').val().length == 11)){
            msg = '预订人联系电话有误';
            $('#phone').parent().addClass('has-error');
            $('#phone').next().text(msg);
        }

        if(msg != ''){
            return;
        }

        $.post('',
            $('#frmReserve').serialize(),
            function(data){
                if(data.status == 'err'){
                    alert(data.msg);
                    $('#form_fuel_csrf_token').val(data.token);
                    return;
                }
                
                window.location.href = '/order/pay_confirm/' + data.data.id;
            }, 'json');
    });
    
    $('#name,#phone,#people_num').click(function () {
        $(this).parent().removeClass('has-error');
        $(this).next().text('');
    });

    $('input[name=ckbAll]').click(function(){
        var checked = $(this).attr('checked');
        $(this).parents('table').find('input[name=ckbReserve]:checkbox').each(function(){
            console.log(checked);
            $(this).attr('checked', checked);
        });
    });

    $('#seller_id').change(getData);

    $('#arrival_date').change(function () {

        /*for(var i = 0; i < _dates.length; i ++){
            if($(this).val() == _dates[i].date){
                for(var h = 0; h < _dates[i].hour.length; h ++){
                    $('#arrival_date').append('<option value="' + _dates[i].hour[h].hour + '">' + _dates[i].hour[h].hour + '</option>');
                }
            }
        }*/
    });

    if(_room_id > 0){
        //loadRoomDate(_room_id);
    }

    getData();
});

function getData(){
    if($('#seller_id').val() != undefined){
        _seller_id = $('#seller_id').val();
    }
    $.get('/room/rooms/' + _seller_id,
        function(data){
            if(data.status == 'err'){
                return;
            }
            loadData(data.cats, data.data);
        }, 'json');
}

function loadData(cats, items){
    $('#myTab').empty();
    $('.tab-content').empty();
    for(var i = 0; i < cats.length; i ++){
        var list = [];
        for (var j = 0; j < items.length; j ++){
            if(cats[i].id == items[j].category_id){
                list[list.length] = items[j];
            }
        }
        $('#myTab').append(navItem, cats[i], null);
        $('.tab-content').append(tabItem, {category_id: cats[i], items: items});
    }
}

/**
 * 加载可选日期
 * @param id
 */
function loadRoomDate(id) {
    $.get('/api/room/dates',
        {
            access_token: _access_token,
            id: id
        },
        function (data) {
            if(data.status == 'err'){
                return;
            }
            _dates = data.data;
            for(var i = 0; i < _dates; i ++){
                $('#arrival_date').append('<option value="' + _dates[i].date + '">' + _dates[i].date + '</option>');
            }
        }, 'json');
}