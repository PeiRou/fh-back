
<style>

</style>
<form id="formData" class="ui form layui-form" action="{{ url('/action/admin/activity/addActivityCondition') }}">
    <div class="field">
        <label>层级</label>
        <select class="ui dropdown" name="level_id" id="level_id" style='height:32px !important'>
            @foreach($level as $value)
                <option @if(isset($data->level_id) && $data->level_id == $value->value) selected @endif value="{{ $value->value }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>最小金额</label>
        <div class="ui input icon">
            <input type="text" name="min_money"  oninput = "clearNoNum(this)"  value="{{ $data->min_money ?? null }}"/>
        </div>
    </div>
    <div class="field">
        <label>最大金额</label>
        <div class="ui input icon">
            <input type="text" name="max_money"  oninput = "clearNoNum(this)"  value="{{ $data->max_money ?? null }}"/>
        </div>
    </div>
    <div class="field">
        <label>概率(%)</label>
        <div class="ui input icon">
            <input type="text" name="probability" placeholder="写数字即可" oninput ="clearNoNum(this)"  value="{{ $data->probability ?? null }}"/>
        </div>
    </div>
    <div class="ui checked checkbox">
        <input type="checkbox" name="is_default" @if(isset($data->is_default) && $data->is_default == 1) checked @endif >
        <label>设为默认</label>
    </div>

    <input type="hidden" name="id" value="{{ $data->id ?? null }}">
{{--    <input type="hidden" name="activity_condition_hongbao_id" value="{{ $activity_condition_hongbao_id ?? 0 }}">--}}
</form>

<script>
    $(function () {
        $('#formData').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                level_id: {
                    validators: {
                        notEmpty: {
                            message: '请选择层级'
                        }
                    }
                },
                min_money: {
                    validators: {
                        notEmpty: {
                            message: '请输入最小金额'
                        }
                    }
                },
                max_money: {
                    validators: {
                        notEmpty: {
                            message: '请输入最大金额'
                        }
                    }
                },
                probability: {
                    validators: {
                        notEmpty: {
                            message: '请输入概率'
                        }
                    }
                },
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target),
                fv    = $form.data('formValidation');
            var obj = {
                activity_id : activity_id
            }
            var data = $form.serialize()+'&'+$.param(obj);
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: data,
                success: function(result) {
                    if(result.status == true){
                        jc1.close();
                        dataTable.ajax.reload(null,false);
                    }else{
                        Calert(result.msg,'red');
                    }
                }
            });
        });

    });
    function clearNoNum(obj){
        obj.value = obj.value.replace(/[^\d.]/g,"");  //清除“数字”和“.”以外的字符
        obj.value = obj.value.replace(/^\./g,"");  //验证第一个字符是数字而不是.
        obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的.
        obj.value = obj.value.replace(".","$#$")
            .replace(/\./g,"")
            .replace("$#$",".");
    }

</script>