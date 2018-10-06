<form id="editRechargeWayForm" class="ui mini form" action="{{ url('/action/admin/editRechType') }}">

    <div class="field">
        <label>描述</label>
        <div class="ui input icon">
            <textarea rows="3" name="remark" style="resize: none">{{ $remark }}</textarea>
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