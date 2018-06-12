<form id="addAgentForm" class="ui mini form" action="{{ url('/action/admin/addAgent') }}">
    <div class="field">
        <label>上级总代理</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="gagent">
                <option value="">请选择</option>
                @foreach($info as $item)
                    <option value="{{ $item->ga_id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>代理账号</label>
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
        <label>代理名称</label>
        <div class="ui input icon">
            <input type="text" name="name" id="name"/>
        </div>
    </div>
    <div class="field">
        <label>开启赔率修改权限</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="editodds">
                <option value="0">关闭</option>
                <option value="1">开启</option>
            </select>
        </div>
    </div>
</form>
<script>
    $('#addAgentForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            gagent:{
                validators: {
                    notEmpty: {
                        message: '请选择上级总代理'
                    }
                }
            },
            account: {
                validators: {
                    notEmpty: {
                        message: '请输入代理账号'
                    }
                }
            },
            password:{
                validators: {
                    notEmpty: {
                        message: '请输入代理账号密码'
                    }
                }
            },
            name:{
                validators: {
                    notEmpty: {
                        message: '请输入代理名称'
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
                    $('#agentTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
</script>