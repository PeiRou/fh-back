<form id="addRoleForm" class="ui form" method="post" action="{{ route('ac.ad.editAdvertise') }}">
    <div class="field">
        <label>标题</label>
        <div class="ui input icon">
            <input type="text" name="title" id="title" value="{{ $iInfo->title }}"/>
        </div>
    </div>
    <div class="field">
        <label>键名</label>
        <div class="ui input icon">
            <input type="text" name="js_key" id="js_key" value="{{ $iInfo->js_key }}"/>
        </div>
    </div>
    <div class="field">
        <label>类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="type" id="type">
                @foreach($aData->advertiseType as $key => $value)
                    <option @if($key == $iInfo->type) selected="selected" @endif value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>状态</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="status" id="status">
                @foreach($aData->advertiseStatus as $key => $value)
                    <option @if($key == $iInfo->status) selected="selected" @endif value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
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
                    }
                }
            });
        });
    });
</script>