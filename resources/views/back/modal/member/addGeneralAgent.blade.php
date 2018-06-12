<form id="addGeneralAgentForm" class="ui mini form" action="{{ url('/action/admin/addGeneralAgent') }}">
    <div class="field">
        <label>总代理账号</label>
        <div class="ui input icon">
            <input type="text" name="account" id="account"/>
        </div>
    </div>
    <div class="field">
        <label>账号密码</label>
        <div class="ui input icon">
            <input type="text" name="password" id="password"/>
        </div>
    </div>
    <div class="field">
        <label>总代理名称</label>
        <div class="ui input icon">
            <input type="text" name="name" id="name"/>
        </div>
    </div>
</form>
<script>
    $('#addGeneralAgentForm').formValidation({
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
                        message: '请输入总代理账号'
                    }
                }
            },
            password:{
                validators: {
                    notEmpty: {
                        message: '请输入总代理账号密码'
                    }
                }
            },
            name:{
                validators: {
                    notEmpty: {
                        message: '请输入总代理名称'
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
                    $('#generalAgentTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
</script>