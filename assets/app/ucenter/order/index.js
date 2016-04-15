var scroll;
var currentDirection;
var flag = false;
var currentPageIndex = 1;   //当前页面
var lastId = 0;             //最后的一个ID
$(function () {

    scroll = new IScroll('#wrapper', {
        probeType: 3,
        mouseWheel: true
    });

    scroll.on('scroll', function () {
        if(this.directionY == 1){
            scrollUp();
        }else if(this.directionY == -1){
            scrollDown();
        }
    });
    scroll.on('scrollEnd', function () {
        var flag = currentDirection.attr('id') == 'pull-down';
        var params = {'padding-top': '10px'};
        if( ! flag){
            params = {
                'padding-bottom' : '10px'
            };
        }
        currentDirection.animate(params, function () {

            currentDirection.find('span').text('数据加载中...');
            currentDirection.find('i').removeClass('fa-arrow-up').addClass('fa-spinner fa-spin');

            if(flag){
                loadNewData();
            }else{
                loadMoreData();
            }

        });
    });

    document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

    loadMoreData();
});

/**
 * 刷新数据
 */
function scrollDown() {
    currentDirection = $('#pull-down');
    currentDirection.show();
    var height = currentDirection.css('padding-top').replace('px', '');
    height ++;
    if(height > 20){
        if(flag){
            return;
        }
        flag = true;
        currentDirection.find('i').removeClass('fa-arrow-down').addClass('fa-arrow-up');
        currentDirection.find('span').text('松手开始刷新...');
    }
    currentDirection.css('padding-top', height + 'px');
}

/**
 * 更多数据
 */
function scrollUp() {

    currentDirection = $('#pull-up');
    if(scroll.y < (scroll.maxScrollY - 55)){
        currentDirection.show();
        if(scroll.y < (scroll.maxScrollY - 30)){
            if(flag){
                return;
            }
            flag = true;
            currentDirection.find('i').removeClass('fa-arrow-down').addClass('fa-arrow-up');
            currentDirection.find('span').text('松手开始加载...');
        }
    }
}

/**
 * 加载新数据
 */
function loadNewData() {
    $.get('/api/order/list',
        {
            access_token: 'MGE3MTYyYjIzODYzNjY5NDRiYzE2NTUwM2U2ZGQ5ODI=',
            last_id: lastId
        },
        function (data) {

            flag = false;
            $('#pull-down').hide();
            $('#pull-down').find('i').removeClass('fa-spinner').removeClass('fa-spin').addClass('fa-arrow-down');
            $('#pull-down').find('span').text('下拉刷新数据...');

            if(data.status == 'err'){
                return;
            }

            var items = data.data.items;
            if(ObjectEmpty(items)){
                return;
            }
            
            for(var index in items){
                $('.list-group').prepend(orderItem, items[index], null);
            }
            
        }, 'json');
}

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

            flag = false;
            $('#pull-up').hide();
            $('#pull-up').find('i').removeClass('fa-spinner').removeClass('fa-spin').addClass('fa-arrow-up');
            $('#pull-up').find('span').text('上拉加载更多...');
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