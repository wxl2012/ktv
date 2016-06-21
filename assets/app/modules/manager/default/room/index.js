$(function () {
    $('#btnSubmit').click(function () {

        $.post('',
            $('#frmReserve').serialize(),
            function (data) {
                if(data.status == 'err'){
                    alert(data.status);
                    return;
                }

                alert('操作成功');
            }, 'json');

    });
});