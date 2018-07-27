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
<form id="editArticleForm" class="ui form" action="{{ url('/action/admin/activity/editPrize') }}">
    <div class="field">
        <label>奖品名称</label>
        <div class="ui input icon">
            <input type="text" name="name" value="{{ $prizeInfo->name }}"/>
        </div>
    </div>
    <div class="field">
        <label>活动类型</label>
        <select class="ui dropdown" name="type" id="status" style='height:32px !important'>
            @foreach($prizeType as $key => $value)
                <option @if($key == $prizeInfo->type) selected="selected" @endif value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>奖品规格</label>
        <div class="ui input icon">
            <input type="text" name="quantity" value="{{ $prizeInfo->quantity }}"/>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $prizeInfo->id }}">
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
})
</script>