<form id="openLhc" class="ui mini form" action="{{ url('/action/admin/openLhc') }}">
    <div class="field">
        <label>期号</label>
        <div class="ui input icon">
            <input type="text" name="issue" value="{{ $lhc->issue }}" readonly/>
        </div>
    </div>
    <div class="field">
        <label>开奖号码</label>
        <div class="ui input icon">
            <input type="text" name="end_time" value=""/>
        </div>
        <div class="ui input icon">
            <input type="text" name="end_time" value=""/>
        </div>
        <div class="ui input icon">
            <input type="text" name="end_time" value=""/>
        </div>
        <div class="ui input icon">
            <input type="text" name="end_time" value=""/>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $lhc->id }}">
</form>

<script>
    $('#openLhc').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            issue:{
                validators: {
                    notEmpty: {
                        message: '请输入期号'
                    }
                }
            },
            end_time: {
                validators: {
                    notEmpty: {
                        message: '请输入封盘时间'
                    }
                }
            },
            open_time: {
                validators: {
                    notEmpty: {
                        message: '请输入开奖时间'
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
                    $('#lhcHistoryTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red');
                    jc.close();
                    $('#lhcHistoryTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
</script>