
var pagination = false;

$(function () {

    $('.container').delegate('a[role="pay"]', 'click', function () {
        window.location.href = '/order/pay/' + $(this).parents('.list-group-item').attr('data-id');
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
        console.log('a');
        window.location.href = $(this).attr('original-href');
    });

    loadMoreData();
});

/**
 * 加载更多数据
 */
function loadMoreData() {
    $('#btnMore').html('<i class="fa fa-spin fa-spinner"></i>加载中...');
    $.get('/api/order/list',
        {
            access_token: 'MGE3MTYyYjIzODYzNjY5NDRiYzE2NTUwM2U2ZGQ5ODI=',
            start: pagination == false ? 1 : ++ pagination.current_page
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
                $('.list-group').append(orderItem, items[index], null);
            }
        }, 'json');
}