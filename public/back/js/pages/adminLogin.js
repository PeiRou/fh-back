/**
 * Created by vincent on 2018/1/23.
 */
particlesJS.load('particles-js', '/assets/particles.json', function() {
    console.log('callback - particles.js config loaded');
});
$(document).ready(function() {
    $('#loginForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            account: {
                validators: {
                    notEmpty: {
                        message: '请输入账号'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '请输入密码'
                    }
                }
            },
            otp: {
                validators: {
                    notEmpty: {
                        message: '请输入Google OTP验证码'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target),
            fv    = $form.data('formValidation');
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {
                if(result.status == false)
                {
                    Calert(result.msg,'red')
                } else {
                    location.href = '/back/control/dash'
                }
            }
        });
    });
});