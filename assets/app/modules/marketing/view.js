$(function () {

    $('#btnSubmit').click(function () {
        if($('#num').val().length < 1){
            $('#marketingModal').modal('show');
            return;
        }

        isExists();

    });

    $('#num').change(function () {
        _num = $(this).val();
    });

    $('#marketingModal').on('hidden.bs.modal', function (e) {
        isExists();
    });

    loadRecordData();

});

function loadRecordData() {
    $.get('/api/marketing/luck/records/' + _marketing_id + '.json?access_token=',
        function (data) {
            if(data.status == 'err'){
                return;
            }

            if(data.total_count > 0){
                $('.nos').show();
            }else{
                $('.non-empty').show();
            }

            $('.no-count').text(data.total_count);
            var items = data.data;
            for(var key in items){


                var color = items[key].no == _win_no ? 'style="color: #d9534f;"' : '';
                $('.no-panel').append('<div' + color + '>' + items[key].no + '</div>');
            }

        }, 'json');
}

function isExists() {
    $.get('/api/order/marketing/exists.json?access_token=',
        {
            buyer_id: _buyer_id
        },
        function (data) {
            if(data.status == 'err'){
                alert(data.msg);
                return;
            }

            createOrder();
        }, 'json');
}

function createOrder() {
    var marketing = [
        {
            id: _marketing_id,
            num: _num,
            price: 1
        }
    ];

    $.post('/api/order/marketing/create.json?access_token=',
        {
            marketings: marketing,
            order_name: '参与1元购活动',
            order_body: '参与' + _num + '次' + _marketing_id + '号活动',
            buyer_id: _buyer_id,
            from_id: _seller_id
        },
        function (data) {
            if(data.status == 'err'){
                return;
            }

            window.location.href = '/order/confirm?order_id=' + data.data.id;
        }, 'json');
}