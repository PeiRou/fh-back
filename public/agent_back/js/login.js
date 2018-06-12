$(document).ready(function() {
    $('#loginForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // You can set it to tooltip
            // The message then will be shown in Bootstrap popover
            container: 'popover'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: '代理账号必须填写'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '密码必须填写'
                    }
                }
            },
            vlicode: {
                validators: {
                    notEmpty: {
                        message: '验证码必须填写'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        // Prevent form submission
        e.preventDefault();

        var $form = $(e.target),
            fv    = $form.data('formValidation');

        // Use Ajax to submit form data
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {
                if(result.status === true){
                    window.location.href = '/agent/dash'
                } else {
                    $.alert({
                        icon: 'warning sign icon',
                        type: 'red',
                        title: '错误提示',
                        content: result.msg,
                        boxWidth: '20%',
                        buttons: {
                            ok:{
                                text:'确定'
                            }
                        }
                    });
                }
            }
        });
    });
});

function refreshCode() {
    $.ajax({
        url:'/web/getCaptcha',
        type:'get',
        success:function (result) {
            $('.captcha').attr("src",result);
        }
    })
}