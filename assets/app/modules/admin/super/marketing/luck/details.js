$(function () {
    loadRoom();
});

function loadRoom() {
    $.get('/api/room/list.json?seller_id=' + _seller_id,
        function (data) {
            if(data.status == 'err'){
                alert(data.msg);
                return;
            }

            var items = data.data;
            for (var key in items){
                $('#goods_id').append('<option value="' + items[key].id + '">' + items[key].name + '</option>');
            }
        }, 'json');
}