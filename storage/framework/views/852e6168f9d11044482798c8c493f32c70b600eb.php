<link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css">
<script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<form id="gameSettingForm" class="ui form" action="<?php echo e(url('/action/admin/editGameSetting')); ?>">
    <div class="field">
        <label>游戏名称</label>
        <div class="ui input icon">
            <input type="text" value="<?php echo e($game->game_name); ?>" readonly="readonly"/>
        </div>
    </div>
    <div class="input-daterange" style="overflow: hidden;    margin-bottom: 15px;">
        <div class="field">
            <label>公休开始时间</label>
            <div class="ui calendar">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="rangeStart" name="holiday_start" value="<?php echo e(date('Y-m-d',strtotime($game->holiday_start))); ?>">
                </div>
            </div>
        </div>
        <div class="field">
            <label>公休结束时间</label>
            <div class="ui calendar">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" id="rangeEnd" name="holiday_end" value="<?php echo e(date('Y-m-d',strtotime($game->holiday_end))); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="field">
        <label>排序</label>
        <div class="ui input icon">
            <input type="text" name="order" value="<?php echo e($game->order); ?>"/>
        </div>
    </div>
    <input type="hidden" name="g_id" value="<?php echo e($game->g_id); ?>">
</form>
<script>
$(function () {
    $('.input-daterange').datepicker({
        format: "yyyy-mm-dd",
        clearBtn: true,
        startDate: "-Infinity",
        todayBtn: "linked",
        language: "zh-CN",
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function(e) {
        // Revalidate the date field
        $('#gameSettingForm').formValidation('revalidateField', 'holiday_start');
        $('#gameSettingForm').formValidation('revalidateField', 'holiday_end');
    });

    $('#gameSettingForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            holiday_start: {
                validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: '不是有效的日期格式'
                    }
                }
            },
            holiday_end: {
                validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: '不是有效的日期格式'
                    }
                }
            },
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