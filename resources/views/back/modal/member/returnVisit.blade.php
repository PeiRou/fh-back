<form id="addAgentForm" class="ui mini form" action="{{ url('/action/admin/member/returnVisit') }}" style="height: 320px;">
    <div class="field">
        <label>未登录方式</label>
        <div class="ui input icon">
            <select id="login_type" name="login_type">
                <option value="1">未登录天数</option>
                <option value="2">未登录时间</option>
            </select>
        </div>
    </div>
    <div class="field" id="login_day-div">
        <label>未登录天数</label>
        <div class="ui input icon">
            <input type="text" name="day" id="day"/>
        </div>
    </div>
    <div class="field" id="login_date-div" style="display: none;">
        <label>未登录天数</label>
        <div class="ui input icon">
            <div class="ui calendar" id="rangestart" style="width: 40%;">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="startDay" name="startDay" placeholder="起始日期" value="{{ date('Y-m-d',time()) }}">
                </div>
            </div>
            -
            <div class="ui calendar" id="rangeend" style="width: 40%;">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="endDay" name="endDay" placeholder="结束日期" value="{{ date('Y-m-d',time()) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="field">
        <label>存款金额</label>
        <div class="ui input icon">
            <input type="text" name="money" id="money"/>
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
            login_type:{
                validators: {
                    notEmpty: {
                        message: '请选择未登录方式'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target),
            fv    = $form.data('formValidation');
        window.location.href = "{{ url('/action/admin/member/returnVisit') }}?startDay="+$('#startDay').val()+"&endDay="+$('#endDay').val()+"&money="+$('#money').val()+"&login_type="+$('#login_type').val()+"&day="+$('#day').val();
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
    $('#login_type').on('change',function () {
        var type = $(this).val();
        if(type == 1){
            $('#login_day-div').show();
            $('#login_date-div').hide();
        }else if(type == 2){
            $('#login_day-div').hide();
            $('#login_date-div').show();
        }
    });
</script>