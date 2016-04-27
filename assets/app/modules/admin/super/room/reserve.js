$(function () {

    $('a[role="action-use"]').click(function(){
        $.post('/admin/room/change_reserve_status',
            {
                id: $(this).parents('tr').attr('data-id'),
                status: 'USED'
            },
            function (data) {
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }
            }, 'json');
    });

});