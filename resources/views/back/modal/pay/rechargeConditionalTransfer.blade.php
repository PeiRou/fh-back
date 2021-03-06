<form id="addBankForm" class="ui mini form" action="{{ url('/action/admin/sectionExchangeLevel') }}">
    <div class="field">
        <label>迁移至</label>
        <div class="ui input icon">
            <select name="to_id" id="to_id">
                @foreach($aLevel as $iLevel)
                    <option value="{{ $iLevel->value }}"> {{ $iLevel->name }} </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>充值时间</label>
        <div class="ui input left icon">
            <div class="ui calendar" id="rangestart" style="width: 108px;">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="startTime" name="startTime" value="" placeholder="开始时间">
                </div>
            </div>
            <div style="line-height: 32px;"> &nbsp;&nbsp;-&nbsp;&nbsp; </div>
            <div class="ui calendar" id="rangeend" style="width: 108px;">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="endTime" name="endTime" value="" placeholder="结束时间">
                </div>
            </div>
        </div>
    </div>
    <div class="field">
        <label>用户充值金额</label>
        <div class="ui input icon left">
            <input type="text" name="money_min" style="width: 50px" placeholder="最少金额"/>
            <div style="line-height: 32px;"> &nbsp;&nbsp;-&nbsp;&nbsp; </div>
            <input type="text" name="money_max" style="width: 50px" placeholder="最多金额"/>
        </div>
    </div>
    <div class="field">
        <label>用户充值总次数</label>
        <div class="ui input icon">
            <input type="text" name="recharge" />
        </div>
    </div>
    <input value="{{ $iLevelInfo->value }}" name="form_id" id="form_id" type="hidden">
    <div>
        <button type="button" id="displayUser">显示转移用户</button>(请先显示用户在确定提交)
        <div id="username" style="min-height: 100px;">

        </div>
    </div>
</form>
<script>
    var userId = [];
    $('#addBankForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target),
            fv    = $form.data('formValidation');
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: {to_id:$('#to_id').val(),form_id:$('#form_id').val(),user_id:userId},
            success: function(result) {
                if(result.status == true){
                    Calert(result.msg,'green');
                    jc.close();
                    $('#bankTable').DataTable().ajax.reload(null,false);
                }else {
                    Calert(result.msg,'red');
                }
            }
        });
    });

    $('#displayUser').on('click',function () {
        $.ajax({
            url: '/action/admin/sectionDisplayLevel',
            type: 'POST',
            data: $('#addBankForm').serialize(),
            success: function(result) {
                if(result.status == true){
                    var html = '';
                    $.each(result.data.display,function (i,e) {
                        html += '<span style="display: inline-block;margin: 0 0 .28571429rem 0;color: rgba(0,0,0,.87);font-size: .92857143em;font-weight: 700;text-transform: none;margin-right: 10px;">'+ e.username + '</span>';
                    });
                    $('#username').html(html);
                    userId = result.data.userId;
                }else {
                    Calert(result.msg,'red');
                }
            }
        });
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