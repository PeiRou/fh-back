<form id="addSubAccountForm" class="ui form" action="{{ url('/action/admin/addSubAccount') }}">
    <div class="field">
        <label>账号</label>
        <div class="ui input icon">
            <input type="text" name="account" id="account"/>
        </div>
    </div>
    <div class="field">
        <label>名称</label>
        <div class="ui input icon">
            <input type="text" name="name" id="name"/>
        </div>
    </div>
    <div class="field">
        <label>登录密码</label>
        <div class="ui input icon">
            <input type="text" name="password" id="password"/>
        </div>
    </div>
    <div class="field">
        <label>角色</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="role">
                <option value="">请选择账号角色</option>
                @foreach($roles as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<script>
    $(function () {
        $('#addSubAccountForm').formValidation({
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
                            message: '账号必须填写'
                        },
                        stringLength: {
                            min: 5,
                            max: 30,
                            message: '账号的长度请控制在5-30位之间'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '账号只能是字母+数字的格式'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '请输入账号密码'
                        }
                    }
                },
                name: {
                    validators: {
                        notEmpty: {
                            message: '请输入账号名称'
                        }
                    }
                },
                role: {
                    validators: {
                        notEmpty: {
                            message: '请为账号指定一个角色权限'
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
                        $('#subAccountTable').DataTable().ajax.reload(null,false);
                    }else{
                        alert(result.msg);
                    }
                }
            });
        });
    })
</script>