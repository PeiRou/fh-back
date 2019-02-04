<link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css">
<script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<style>
    .calendar{
        z-index: 99999999999999!important;
    }
</style>
<form id="gameSettingForm" class="ui form" action="{{ url('/action/admin/editGameSetting') }}">
    <div class="field">
        <label>游戏名称</label>
        <div class="ui input icon">
            <input type="text" value="{{ $game->game_name }}" readonly="readonly"/>
        </div>
    </div>
    <div class="input-daterange" style="
    /*overflow: hidden;  */
      margin-bottom: 15px;">
        <div class="field">
            <label>公休开始时间</label>
            <div class="ui calendar" id="holiday_start">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="rangeStart" name="holiday_start" value="{{ $game->holiday_start }}">
                </div>
            </div>
        </div>
        <div class="field">
            <label>公休结束时间</label>
            <div class="ui calendar" id="holiday_end">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="rangeEnd" name="holiday_end" value="{{ $game->holiday_end }}">
                </div>
            </div>
        </div>
    </div>
    <div class="field">
        <label>排序</label>
        <div class="ui input icon">
            <input type="text" name="order" value="{{ $game->order }}"/>
        </div>
    </div>
    <input type="hidden" name="g_id" value="{{ $game->g_id }}">
</form>
<script src="/vendor/Semantic-UI-Calendar/dist/calendar.min.js"></script>
<link rel="stylesheet" href="/vendor/Semantic-UI-Calendar/dist/calendar.min.css">
<script>
$(function () {
    // $('.input-daterange').datepicker({
    //     format: "yyyy-mm-dd",
    //     clearBtn: true,
    //     startDate: "-Infinity",
    //     todayBtn: "linked",
    //     language: "zh-CN",
    //     autoclose: true,
    //     todayHighlight: true
    // }).on('changeDate', function(e) {
    //     // Revalidate the date field
    //     $('#gameSettingForm').formValidation('revalidateField', 'holiday_start');
    //     $('#gameSettingForm').formValidation('revalidateField', 'holiday_end');
    // });

    $('#holiday_start').calendar({
        type: 'datetime',
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                return year+'-'+month+'-'+day+' '+hours+':'+minutes+':'+seconds;
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
        }
    });
    $('#holiday_end').calendar({
        type: 'datetime',
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                return year+'-'+month+'-'+day+' '+hours+':'+minutes+':'+seconds;
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
        }
    });

    $('#gameSettingForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            // holiday_start: {
            //     validators: {
            //         date: {
            //             // format: 'YYYY-MM-DD',
            //             message: '不是有效的日期格式'
            //         }
            //     }
            // },
            // holiday_end: {
            //     validators: {
            //         date: {
            //             // format: 'YYYY-MM-DD',
            //             message: '不是有效的日期格式'
            //         }
            //     }
            // },
            order: {
                validators: {
                    integer: {
                        message: '排序数字只能是整数',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: '.'
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
                    $('#gamesTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
})
</script>