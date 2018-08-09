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
<form id="editArticleForm" class="ui form" action="{{ url('/action/admin/promotion/addConfig') }}">
    <div class="field">
        <label>层级 : </label>
        <div class="ui input icon">
            <input type="text" name="level" value=""/>
        </div>
    </div>
    <div class="field">
        <label>达标投注额</label>
        <div class="ui input icon">
            <input type="text" name="money" value=""/>
        </div>
    </div>
    <div class="field">
        <label>提成比例</label>
        <div class="ui input icon">
            <input type="text" name="proportion" value=""/>
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
                    }
                }
            });
        });
    });

</script>