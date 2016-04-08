$(function () {
    $('td .btn-primary').click(function () {
        var tr = $(this).parents('tr');
        var params = {
            name: tr.find('input[name=name]').val(),
            price: tr.find('input[name=price]').val(),
            day: tr.find('input[name=day]').val(),
            night: tr.find('input[name=night]').val(),
            minimum: tr.find('input[name=minimum]').val(),
        };

        $.post('/admin/room/save/' + tr.attr('data-id'),
            params,
            function (data) {
                if(data.status == 'err'){
                    $(tr).addClass('err');
                    return;
                }
                $(tr).addClass('succ');
            }, 'json');
    });

    $('td .btn-danger').click(function () {
        var tr = $(this).parents('tr');
        $.get('?id=' + tr.attr('data-id'),
            params,
            function (data) {
                if(data.status == 'err'){
                    $(tr).addClass('err');
                    return;
                }
                tr.remove();
            }, 'json');
    });

    $('td .btn-search').click(function () {
        var url = window.location.href;
        var tr = $(this).parents('tr');
        $(tr).find('input').each(function(index, element){
            if($(element).val().length < 1){
                url = replaceParamVal(url, $(element).attr('name'), '');
                return;
            }
            url = replaceParamVal(url, $(element).attr('name'), $(element).val());
        });

        window.location.href = url;
    });

    $('td .btn-plus').click(function () {
        var tr = $(this).parents('tr');
        $.delete('?id=' + tr.attr('data-id'),
            params,
            function (data) {
                if(data.status == 'err'){
                    $(tr).addClass('err');
                    return;
                }
                tr.remove();
            }, 'json');
    });
});