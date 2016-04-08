$(function(){
    $('a[role=sort]').click(function(){
        $('#filterPanel').hide();
        var a = $(this);
        $('#sortPanel').slideToggle(function(){
            if($('#sortPanel').is(':visible')){
                $('.modal').show();
                $(a).find('i').removeClass('fa fa-caret-down').addClass('fa fa-caret-up');
                $('a[role=filter]').find('i').removeClass('fa fa-caret-up').addClass('fa fa-caret-down');
            }else{
                $('.modal').hide();
                $(a).find('i').removeClass('fa fa-caret-up').addClass('fa fa-caret-down');
            }
        });
    });

    $('a[role=filter]').click(function(){
        $('#sortPanel').hide();
        var a = $(this);
        $('#filterPanel').slideToggle(function(){
            if($('#filterPanel').is(':visible')){
                $('.modal').show();
                $(a).find('i').removeClass('fa fa-caret-down').addClass('fa fa-caret-up');
                $('a[role=sort]').find('i').removeClass('fa fa-caret-up').addClass('fa fa-caret-down');
            }else{
                $('.modal').hide();
                $(a).find('i').removeClass('fa fa-caret-up').addClass('fa fa-caret-down');
            }
        });
    });

    $('#filterPanel .list-group-item').click(function(){
        var url = window.location.href;
        url = replaceParamVal(url, 'category_id', $(this).attr('data-id'));
        window.location.href = url;
    });

    $('#sortPanel .list-group-item').click(function(){
        var url = window.location.href;
        url = replaceParamVal(url, 'sort_field', 'price');
        url = replaceParamVal(url, 'sort_value', $(this).attr('data-sort'));
        window.location.href = url;
    });
});