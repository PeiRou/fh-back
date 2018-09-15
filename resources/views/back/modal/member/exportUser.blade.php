<form id="addAgentForm" class="ui mini form" action="{{ url('/action/admin/member/returnVisit') }}" style="height: 320px;">
    <div class="field">
        <label>创建时间</label>
        <div class="ui input icon">
            <div class="ui calendar" id="rangestart" style="width: 40%;">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="startDay" name="startDay" placeholder="起始日期" value="">
                </div>
            </div>
            -
            <div class="ui calendar" id="rangeend" style="width: 40%;">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="endDay" name="endDay" placeholder="结束日期" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="field">
        <label>用户账号</label>
        <div class="ui input icon">
            <input type="text" name="username" id="username"/>
        </div>
    </div>
    <div class="field">
        <label>Google验证码</label>
        <div class="ui input icon">
            <input type="text" name="code" id="code"/>
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
            code:{
                validators: {
                    notEmpty: {
                        message: '请输入Google验证码'
                    }
                }
            },
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target),
            fv    = $form.data('formValidation');
        window.location.href = "{{ url('/action/admin/member/exportUser') }}?startTime="+$('#startDay').val()+"&endTime="+$('#endDay').val()+"&username="+$('#username').val()+"&code="+$('#code').val();
    });

    var today = new Date();
    $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend'),
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
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 99),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
    });
    $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart'),
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
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 99),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
    });
</script>