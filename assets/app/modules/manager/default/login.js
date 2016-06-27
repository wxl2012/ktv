$(function () {
    $('#btnSubmit').click(function () {

        var msg = '';
        if($('#username').val().length < 1){
            msg = '用户名不能为空!';
        }else if($('#password').val().length < 1){
            msg = '密码不能为空!';
        }

        if(msg != ''){
            alert(msg);
            return;
        }

        $.post('',
            $('#frmLogin').serialize(),
            function (data) {
                if(data.status == 'err'){
                    alert(data.msg);
                    return;
                }

                alert('登录成功!');
                window.location.href = '/manager';
            }, 'json');
    });
});