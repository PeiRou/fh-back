<form id="addAgentForm" class="ui mini form" action="{{ url('/action/admin/report/addReportCard') }}" style="height: 320px;">
    <div class="field" id="login_date-div">
        <label>时间</label>
        <div class="ui input icon">
            <div class="ui calendar" id="rangestart1">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="startDay" name="startDay" placeholder="起始日期" value="{{ date('Y-m-d',strtotime('-1 day')) }}">
                </div>
            </div>
    </div>
</form>
<script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
<link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
<script>
    $('#addAgentForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            startDay:{
                validators: {
                    notEmpty: {
                        message: '请选择时间'
                    }
                }
            },
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
                    // $('#reportUserTable').DataTable().ajax.reload(null,false);
                } else {
                    Calert(result.msg,'red');
                }
            }
        });
    });

    var today = new Date();
    $('#rangestart1').calendar({
        type: 'date',
        endCalendar: $('#rangeend1'),
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return year+'-'+month+'-'+day;
            }
        },
        text: {
            days: ['日', '一', '二', '三', '四', '五', '六'],
            months: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            today: '今天',
            now: '现在',
            am: 'AM',
            pm: 'PM'
        },
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1)
    });
</script>