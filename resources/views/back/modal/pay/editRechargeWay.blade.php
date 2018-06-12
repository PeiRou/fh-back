<form id="editRechargeWayForm" class="ui mini form" action="{{ url('/action/admin/editRechargeWay') }}">
    <div class="field">
        <label>充值类型</label>
        <div class="ui input icon">
            <input type="text" name="type" value="{{ $info->type }}"/>
        </div>
    </div>

    <div class="field">
        <label>类型值</label>
        <div class="ui input icon">
            <input type="text" name="value" value="{{ $info->value }}"/>
        </div>
    </div>

    <div class="field">
        <label>描述</label>
        <div class="ui input icon">
            <textarea rows="3" name="content" style="resize: none">{{ $info->content }}</textarea>
        </div>
    </div>

    <div class="field">
        <label>状态</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="status">
                <option @if($info->status == 1) selected @endif value="1">正常</option>
                <option @if($info->status == 0) selected @endif value="0">停用</option>
            </select>
        </div>
    </div>

    <input type="hidden" name="id" value="{{ $id }}">
</form>
<script>
    $('#editRechargeWayForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            type:{
                validators: {
                    notEmpty: {
                        message: '请输入充值类型'
                    }
                }
            },
            value:{
                validators: {
                    notEmpty: {
                        message: '请输入类型值'
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
                    $('#rechargeWayTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red');
                }
            }
        });
    });
</script>