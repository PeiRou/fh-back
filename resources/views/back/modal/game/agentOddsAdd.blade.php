<link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css">
<script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<form id="gameSettingForm" class="ui form" action="{{ url('/action/admin/addAgentOdds') }}">
    <div class="field">
        <label>层级</label>
        <div class="ui input icon">
            <input type="text" name="level" value="" placeholder="可不填"/>
        </div>
    </div>
    <div class="field">
        <label>赔率(不得高于{{ $iOdds }})</label>
        <div class="ui input icon">
            <input type="text" name="odds" value="" placeholder="请填写赔率,不得高于{{ $iOdds }}"/>
        </div>
    </div>
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
                }else{
                    alert(result.msg);
                }
            }
        });
    });
})
</script>