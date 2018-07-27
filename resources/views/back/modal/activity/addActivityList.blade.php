<link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css">
<script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<style>
    .txta{
        width: 700px;
        height: 200px;
        text-indent: 0;
    }
    .in-block{
        display: inline-block;
    }
</style>
<form id="editArticleForm" class="ui form" action="{{ url('/action/admin/activity/addActivity') }}">
    <div class="field">
        <label>活动名称</label>
        <div class="ui input icon">
            <input type="text" name="name" value=""/>
        </div>
    </div>
    <div class="field">
        <label>活动时间</label>
        <div class="ui calendar in-block" id="rangestart" style="width: 108px;">
            <div class="ui input left icon">
                <i class="calendar icon"></i>
                <input type="text" name="start_time" id="start_time" value="" placeholder="">
            </div>
        </div>
        <span> - </span>
        <div class="ui calendar in-block" id="rangeend" style="width: 108px;">
            <div class="ui input left icon">
                <i class="calendar icon"></i>
                <input type="text" name="end_time" id="end_time" value="" placeholder="">
            </div>
        </div>
    </div>
    <div class="field">
        <label>活动类型</label>
        <select class="ui dropdown" name="type" id="status" style='height:32px !important'>
            @foreach($activityType as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>活动说明</label>
        <div class="ui input icon">
            <textarea name="content" class="txta"></textarea>
        </div>
    </div>
</form>
<script>
$(function () {
    $('#editArticleForm').formValidation({
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
            data: $form.serialize(),
            success: function(result) {
                if(result.status == true){
                    jc1.close();
                    $('#capitalDetailsTable').DataTable().ajax.reload(null,false);
                }else{
                    Calert(result.msg,'red')
                }
            }
        });
    });
    $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#start_time'),
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
        }
    });
    $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#end_time'),
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
        }
    });
})
</script>