$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $(document).keyup(function(event){
        if(event.keyCode == 13){
            login();
        }
    });
});



function login() {
    var userName = $("#userName").val();
    var userPwd = $("#userPwd").val();
    var valiCode = $("#valiCode").val();

    if(!userName) {
        alert("请输入用户名");
        return false;
    }

    if(!userPwd) {
        alert("请输入密码");
        return false;
    }

    if(!valiCode) {
        alert("请输入验证码");
        return false;
    }

    $.ajax({
        type: 'POST',
        url: '/action/admin/login',
        data: {
            account: userName,
            pwdtext: userPwd,
            password: userPwd,
            otp: valiCode
        },
        dataType: 'json',
        success: function(result) {
            if(result.status === false){
                alert(result.msg || "系统错误");
            } else {
                // location.href = '/back/control/dash';
                location.href = '/back/control/dash?offer='+result.offer;
            }
        },
        error: function(result) {
            alert(result.msg || "系统错误");
        }
    });
}