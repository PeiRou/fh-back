<form id="addLhcNewIssueForm" class="ui mini form" action="">
    <div class="field">
        <label>期号</label>
        <div class="ui input icon">
            <input type="text" name="issue"/>
        </div>
    </div>
    <div class="field">
        <label>封盘时间</label>
        <div class="ui input icon">
            <input type="text" name="end_time"/>
        </div>
    </div>
    <div class="field">
        <label>开奖时间</label>
        <div class="ui input icon">
            <input type="text" name="open_time"/>
        </div>
    </div>
</form>
<link rel="stylesheet" href="/js/daterangepicker.css">
<script src="/js/moment.min.js"></script>
<script src="/js/daterangepicker.js"></script>
<script>
    $('#addLhcNewIssueForm').formValidation({
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
                }
            }
        });
    });
</script>