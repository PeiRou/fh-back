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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="/js/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<style>
    .daterangepicker{
        display: none;
        z-index: 99999999 !important;
    }
</style>
<script>
    $('input[name="end_time"]').daterangepicker({
        "singleDatePicker": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerSeconds": true,
        locale: {
            format: 'YYYY-MM-DD hh:mm:ss',
            "applyLabel": "确认",
            "cancelLabel": "取消",
            "daysOfWeek": [
                "日",
                "一",
                "二",
                "三",
                "四",
                "五",
                "六"
            ],
            "monthNames": [
                "一月",
                "二月",
                "三月",
                "四月",
                "五月",
                "六月",
                "七月",
                "八月",
                "九月",
                "十月",
                "十一月",
                "十二月"
            ]
        }
    });

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