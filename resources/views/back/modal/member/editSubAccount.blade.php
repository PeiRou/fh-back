<form id="editSubAccountForm" class="ui mini form" action="{{ url('/action/admin/editSubAccount') }}">
    <div class="field">
        <label>账号</label>
        <div class="ui input icon">
            <input type="text" value="{{ $subAccount->account }}" readonly/>
        </div>
    </div>
    <div class="field">
        <label>名称</label>
        <div class="ui input icon">
            <input type="text" value="{{ $subAccount->name }}" readonly/>
        </div>
    </div>
    <div class="field">
        <label>登录密码</label>
        <div class="ui input icon">
            <input type="text" name="password" placeholder="留空不修改"/>
        </div>
    </div>
    <div class="field">
        <label>账号角色</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="role">
                @foreach($roles as $item)
                    <option @if($subAccount->role == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="hidden" name="sub_id" value="{{ $sub_id }}">
</form>
<script>
    $(function () {
        $('#editSubAccountForm').formValidation({
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
                        $('#subAccountTable').DataTable().ajax.reload(null,false);
                    }
                }
            });
        });
    })
</script>