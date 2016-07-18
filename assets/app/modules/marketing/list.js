$(function () {

    loadData();
});

function loadData() {

    $.get('/api/marketing/luck/list.json',
        function (data) {
            if(data.status == 'err'){
                return;
            }

            var items = data.data;

            for (var key in items){
                $('#items').append(item, items[key], null);
            }

        }, 'json');

}