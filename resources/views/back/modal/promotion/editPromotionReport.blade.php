<link rel="stylesheet" href="/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css">
<script src="/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<style>
    .fl50{
        width: 50%;
        float: left;
    }
    .fl50 button,
    .fl50 label,
    .fl50 span{
        display: inline-block;
    }
    .fl50 label{
        margin-right: 10px;
    }
</style>
<form id="editArticleForm" class="ui form" action="{{ url('/action/admin/promotion/editReport') }}">
    <div class="field">
        <label>投注总额 : </label>
        <div class="ui input icon">
            <input type="text" name="bet_money" value="{{ $iPromotionInfo->bet_money }}"/>
        </div>
    </div>
    <div class="field">
        <label>分红比 : </label>
        <div class="ui input icon">
            <input type="text" name="fenhong_prop" value="{{ $iPromotionInfo->fenhong_prop }}"/>
        </div>
    </div>
    <div class="field">
        <label>本月佣金 : </label>
        <div class="ui input icon">
            <input type="text" name="commission" value="{{ $iPromotionInfo->commission }}"/>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $iPromotionInfo->id }}">
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
    });

</script>