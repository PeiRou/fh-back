<form id="addBankForm" class="ui mini form" action="<?php echo e(url('/action/admin/addBank')); ?>">
    <div class="field">
        <label>银行名称</label>
        <div class="ui input icon">
            <input type="text" name="name"/>
        </div>
    </div>
    <div class="field">
        <label>银行缩写标识</label>
        <div class="ui input icon">
            <input type="text" name="eng_name"/>
        </div>
    </div>
    <div class="field">
        <label>状态</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="status">
                <option value="1">开启</option>
                <option value="0">关闭</option>
            </select>
        </div>
    </div>
</form>
<script>
    $('#addBankForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            name:{
                validators: {
                    notEmpty: {
                        message: '请输入银行名称'
                    }
                }
            },
            eng_name: {
                validators: {
                    notEmpty: {
                        message: '请输入银行缩写标识'
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
                    $('#bankTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
</script>