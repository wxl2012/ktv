$(function () {

    $('#btnSubmit').click(function(){

        $.post('',
            $('#frmReserve').serialize(),
            function(data){
                if(data.status == 'err'){
                    return;
                }
                
                window.location.href = '/order/pay_confirm/' + data.data.id;
            }, 'json');
    });

    $('input[name=ckbAll]').click(function(){
        var checked = $(this).attr('checked');
        $(this).parents('table').find('input[name=ckbReserve]:checkbox').each(function(){
            console.log(checked);
            $(this).attr('checked', checked);
        });
    });

    $('#seller_id').change(getData);

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