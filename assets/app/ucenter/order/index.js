
var currentPageIndex = 1    ;

$(function () {
    loadMoreData();
});

/**
 * 加载更多数据
 */
function loadMoreData() {
    $.get('/api/order/list',
        {
            access_token: 'MGE3MTYyYjIzODYzNjY5NDRiYzE2NTUwM2U2ZGQ5ODI=',
            start: currentPageIndex
        },
        function (data) {

            /*flag = false;
            $('#pull-up').hide();
            $('#pull-up').find('i').removeClass('fa-spinner').removeClass('fa-spin').addClass('fa-arrow-up');
            $('#pull-up').find('span').text('上拉加载更多...');*/
            if(data.status == 'err'){
                return;
            }

            var items = data.data.items;
            if(ObjectEmpty(items)){
                return;
            }

            for(var index in items){
                $('.list-group').append(orderItem, items[index], null);
            }
        }, 'json');
}