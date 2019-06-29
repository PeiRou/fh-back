<form id="addUserForm" class="ui mini form" action="{{ url('/action/admin/addUser') }}">
    <div class="field">
        <label>上级代理</label>
        <div class="ui input icon">
            <select style="height: 40px;" id="agentSelect" name="agent">
            </select>
        </div>
    </div>
    <div class="field">
        <label>会员账号</label>
        <div class="ui input icon">
            <input type="text" name="username"/>
        </div>
    </div>
    <div class="field">
        <label>登录密码</label>
        <div class="ui input icon">
            <input type="text" name="password"/>
        </div>
    </div>
    <div class="field">
        <label>会员名称</label>
        <div class="ui input icon">
            <input type="text" name="fullName" />
        </div>
    </div>
</form>
<style>
    .select2-container--open{
        z-index: 99999999 !important;
    }
</style>
<script>
    $(document).ready(function() {
        $('#agentSelect').select2({
            placeholder: '选择或搜索代理',
            theme: "classic",
            "language": {
                "noResults": function(){
                    return "没有找到符合的结果";
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            ajax: {
                url: "/web/api/select2/agents",//请求的API地址
                dataType: 'json',//数据类型
                data: function(params){
                    return {
                        q: params.term,//此处是最终传递给API的参数
                        type: "ins"//此处是最终传递给API的参数
                    }
                },
                results : function(data){ return data;}//返回的结果s
            }
        });

        $('#addUserForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: '会员用户名必须填写'
                        },
                        stringLength: {
                            min: 5,
                            max: 30,
                            message: '账号长度请控制在5-30位之间'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '用户名只能是字母+数字组合'
                        },
                        remote: {
                            url: '/web/api/check/user/username',
                            type: 'POST',
                            delay: 1000,
                            message:'用户名已被注册，请更换'
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
                fullName: {
                    validators: {
                        notEmpty: {
                            message: '真实姓名必须填写'
                        },
                        regexp: {
                            regexp: /^[\u4e00-\u9fa5]{2,15}$/,
                            message: '真实姓名必须为2到15个汉字'
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
                    if(result.status == true){
                        jc.close();
                        $('#userTable').DataTable().ajax.reload(null,false);
                    } else {
                        Calert(result.msg,'red');
                    }
                }
            });
        });
    });
</script>