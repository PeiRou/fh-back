<link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css">
<script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<form id="editArticleForm" class="ui form" action="{{ url('/action/admin/agentSettle/editReport') }}">
    <div class="field">
        <label>代理账号</label>
        <div class="ui input icon">
            <input type="text" value="{{ $settleInfo->account }}" readonly="readonly"/>
        </div>
    </div>
    <div class="field">
        <label>实际输赢</label>
        <div class="ui input icon">
            <input type="text" name="real_bunko" value="{{ $settleInfo->real_bunko }}"/>
        </div>
    </div>
    <div class="field">
        <label>平台费用比</label>
        <div class="ui input icon">
            <input type="text" name="base_fee_prop" value="{{ $settleInfo->base_fee_prop }}"/>
        </div>
    </div>
    <div class="field">
        <label>纯赢利</label>
        <div class="ui input icon">
            <input type="text" name="fee_bunko" value="{{ $settleInfo->fee_bunko }}"/>
        </div>
    </div>
    <div class="field">
        <label>累计纯赢利</label>
        <div class="ui input icon">
            <input type="text" name="month3_fee_bunko" value="{{ $settleInfo->month3_fee_bunko }}"/>
        </div>
    </div>
    <div class="field">
        <label>代理分红比</label>
        <div class="ui input icon">
            <input type="text" name="fenhong_prop" value="{{ $settleInfo->fenhong_prop }}"/>
        </div>
    </div>
    <div class="field">
        <label>代理佣金</label>
        <div class="ui input icon">
            <input type="text" name="commission" value="{{ $settleInfo->commission }}"/>
        </div>
    </div>
    <div class="field">
        <label>累计佣金</label>
        <div class="ui input icon">
            <input type="text" name="month3_commission" value="{{ $settleInfo->month3_commission }}"/>
        </div>
    </div>
    <input type="hidden" name="agent_report_idx" value="{{ $settleInfo->agent_report_idx }}">
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
                    jc.close();
                    $('#capitalDetailsTable').DataTable().ajax.reload(null,false);
                }
            }
        });
    });
})
</script>