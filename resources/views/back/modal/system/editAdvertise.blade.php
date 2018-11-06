<style>
    .firstParam{display: flex;align-items: center;margin-bottom: 10px;}
    .firstInput{width: 20%!important;}
    .firstSpan{margin-left: 2%;}
    .firstSelect{width: 40%!important; height: 35px!important;}
</style>
<form id="addRoleForm" class="ui form" method="post" action="{{ route('ac.ad.editAdvertise') }}">

    <div class="field">
        <label>标题</label>
        <div class="ui input icon">
            <input type="text" name="title" id="title" value="{{ $iInfo->title }}"/>
        </div>
    </div>

    <div class="field" id="div-aParam">
        @foreach($aKeyData as $kKeyData => $iKeyData)
            <div class="ui input icon firstParam">
                <span>键名：</span>
                <input class="firstInput" type="text" name="paramKey[]" value="{{ $iKeyData->js_key }}"/>
                <span class="firstSpan">描述：</span>
                <input class="firstInput" type="text" name="paramDescription[]" value="{{ $iKeyData->description }}"/>
                <span class="firstSpan">类型：</span>
                <select name="paramType[]" class="firstSelect">
                    @foreach($aKeyModel->advertiseType as $key => $value)
                        <option @if($key == $iKeyData->type) selected="selected" @endif value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="paramId[]" value="{{ $iKeyData->id }}"/>
            </div>
        @endforeach
    </div>

    <input type="hidden" name="id" value="{{ $iInfo->id }}">
</form>

<script>
    $(function () {
        $('.ui.checkbox').checkbox();
        $('#addRoleForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: '请输入标题'
                        }
                    }
                },
                js_key: {
                    validators: {
                        notEmpty: {
                            message: '请输入键名'
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
                        $('#example').DataTable().ajax.reload(null,false);
                    }else{
                        alert(result.msg);
                        jc.close();
                    }
                }
            });
        });
    });
</script>