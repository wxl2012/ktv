$(function () {

    $(function () {
        $('#btnUpload').uploadifive({
            height        : 30,
            uploader      : '/uploadify/uploadify.php',
            width         : 120
        });
    });

    $('#btnAddGallery').click(function(){
        
    });

    $('a[href=#modalGallery]').click(function () {
        $.get('/filemanager/images',
            function (data) {
                if(data.status == 'err'){
                    return;
                }

                $('#zone').empty();
                var items = data.data;
                for(var key in items){
                    $('#zone').append(imgItem, items[key], null);
                }


                /*if($('.pirobox_gall')[0]) {
                    //Fix IE
                    jQuery.browser = {};
                    jQuery.browser.msie = false;
                    jQuery.browser.version = 0;
                    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                        jQuery.browser.msie = true;
                        jQuery.browser.version = RegExp.$1;
                    }

                    //Lightbox
                    $().piroBox_ext({
                        piro_speed : 700,
                        bg_alpha : 0.5,
                        piro_scroll : true // pirobox always positioned at the center of the page
                    });
                }*/
            }, 'json');
    });

    $('#zone').on('click', '.thumbnail-select', function () {
        if($(this).find('img').hasClass('select')){
            $(this).find('img').removeClass('select');
        }else{
            $(this).find('img').addClass('select');
        }

    });

    $('#btnChioce').click(function () {
        var images = [];
        if($('.tab-content .active').attr('id') == 'zone'){
            $('#zone img').each(function(index, element){
                if($(element).hasClass('select')){
                    images[images.length] = {
                        id: $(element).parent().attr('data-id'),
                        url: $(element).attr('src')
                    };
                }
            });
            console.log(JSON.stringify(images));
        }else if($('.tab-content .active').attr('id') == 'local'){
            console.log('本地上传');
        }

        for (var i = 0; i < images.length; i ++){
            $('#gallery').prepend(imgItem, images[i], null);
        }
    });

});