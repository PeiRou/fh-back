<form id="editGeneralAgentForm" class="ui mini form" action="{{ url('/action/admin/editGeneralAgent') }}">
    <div class="field">
        <label>总代理账号</label>
        <div class="ui input icon">
            <input type="text" name="account" value="{{ $info->account }}" readonly/>
        </div>
    </div>
    <div class="field">
        <label>账号状态</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="status">
                <option @if($info->status == 1) selected @endif value="1">正常</option>
                <option @if($info->status == 2) selected @endif value="2">冻结</option>
                <option @if($info->status == 3) selected @endif value="3">停用</option>
            </select>
        </div>
    </div>
    <div class="field">
        <label>总代理账号密码</label>
        <div class="ui input icon">
            <input type="text" name="password" placeholder="留空视为不修改"/>
        </div>
    </div>
    <div class="field">
        <label>真实姓名</label>
        <div class="ui input icon">
            <input type="text" name="truename" value="{{ $info->truename }}"/>
        </div>
    </div>
    <div class="field">
        <label>微信</label>
        <div class="ui input icon">
            <input type="text" name="wechat" value="{{ $info->wechat }}"/>
        </div>
    </div>
    <div class="field">
        <label>手机</label>
        <div class="ui input icon">
            <input type="text" name="mobile" value="{{ $info->mobile }}"/>
        </div>
    </div>
    <div class="field">
        <label>邮箱</label>
        <div class="ui input icon">
            <input type="text" name="email" value="{{ $info->email }}"/>
        </div>
    </div>
    <div class="field">
        <label>QQ</label>
        <div class="ui input icon">
            <input type="text" name="qq" value="{{ $info->qq }}"/>
        </div>
    </div>
    <div class="field">
        <label>开启赔率修改权限</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="editodds">
                <option @if($info->edit_odds == 0) selected @endif value="0">关闭</option>
                <option @if($info->edit_odds == 1) selected @endif value="1">开启</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="ga_id" value="{{ $id }}">
</form>

<script>
    $(function () {
        $('#editGeneralAgentForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {}
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
    })
</script>