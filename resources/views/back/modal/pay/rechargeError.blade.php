<form id="addRechargeErrorForm" class="ui mini form" action="{{ url('/action/admin/addRechargeError') }}">
    <div class="field">
        <label>请具体说明充值失败原因</label>
        <div class="ui input icon">
            <input type="text" name="msg" value="很抱歉，您提交的充值申请资金未到账，请尽快联系在线客户咨询，谢谢！"/>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $id }}">
</form>
<script>
    $('#addRechargeErrorForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            msg:{
                validators: {
                    notEmpty: {
                        message: '请输入充值失败原因'
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
                    Calert('充值状态已更新','green');
                    $('#rechargeRecordTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(data.msg,'red')
                }
            }
        });
    });
</script>