<form id="addDrawingErrorForm" class="ui mini form" action="{{ url('/action/admin/addDrawingError') }}">
    <div class="field">
        <label>请具体说明提款失败原因</label>
        <div class="ui input icon">
            <input type="text" name="msg" value="提款申请未通过,如有疑问，请咨询在线客服"/>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $id }}">
</form>
<script>
    $('#addDrawingErrorForm').formValidation({
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
                        message: '请输入提款失败原因'
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
                    Calert('提款状态已更新','green');
                    $('#drawingRecordTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(data.msg,'red')
                }
            }
        });
    });
</script>