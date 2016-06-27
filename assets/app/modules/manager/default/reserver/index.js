
var pagination = false;

$(function () {

    $('.list-group').delegate('a[role="pay"]', 'click', function () {
        $.post('/manager/reserve/pay/' + $(this).parents('.list-group-item').attr('data-id'),
            function (data) {
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }

                alert('预约状态已变更');
            }, 'json');
    });

    $('.list-group').delegate('a[role="cancel"]', 'click', function () {
        $.post('/manager/reserve/cancel/' + $(this).parents('.list-group-item').attr('data-id'),
            function (data) {
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }

                alert('预约已取消');
            }, 'json');
    });

    $('.list-group').delegate('a[role="use"]', 'click', function () {
        $.post('/manager/reserve/use/' + $(this).parents('.list-group-item').attr('data-id'),
            function (data) {
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }

                alert('预约状态已变更');
            }, 'json');
    });

    $('.list-group').delegate('a[role="del"]', 'click', function () {
        $.post('/manager/reserve/delete/' + $(this).parents('.list-group-item').attr('data-id'),
            function (data) {
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }

                alert('预约已删除');
            }, 'json');
    });

    $('#btnMore').click(function(){
        console.log(pagination);
        if(pagination == false
            || parseInt(pagination.current_page) >= pagination.total_pages){
            $('#btnMore').text('已经是最后一页了');
            return;
        }

        loadMoreData();
    });

    $('.list-group').delegate('div[original-href]', 'click', function () {
        window.location.href = $(this).attr('original-href');
    });

    loadMoreData();
});

/**
 * 加载更多数据
 */
function loadMoreData() {
    $('#btnMore').html('<i class="fa fa-spin fa-spinner"></i>加载中...');
    
    $.get('/api/order/reserve/list',
        {
            access_token: _access_token,
            start: pagination == false ? 1 : ++ pagination.current_page,
            begin: _begin_at,
            end: _end_at,
        },
        function (data) {
            $('#btnMore').text('点击加载更多');
            if(data.status == 'err'){
                return;
            }
            pagination = data.data.pagination;
            var items = data.data.items;
            if(ObjectEmpty(items)){
                isNextPage = false;
                return;
            }

            for(var index in items){
                items[index].create_date = getLocalTime(items[index].created_at);
                items[index].reserve_date = getLocalTime(items[index].begin_at);
                items[index].reserve_time = getLocalTime(items[index].end_at);
                $('.list-group').append(orderItem, items[index], null);
            }
        }, 'json');
}