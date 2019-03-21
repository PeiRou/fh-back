<form id="addNoticeForm" class="ui mini form" action="{{ url('/action/admin/editNotice') }}">
    <div class="field">
        <label>公告标题</label>
        <div class="ui input icon">
            <input type="text" name="title" id="title" value="{{ $iNotice->title }}"/>
        </div>
    </div>
    <div class="field">
        <label>公告内容</label>
        <div class="ui input icon">
            <textarea rows="5" name="content" id="content" style="resize: none">{{ $iNotice->content }}</textarea>
        </div>
    </div>
    <div class="field">
        <label>公告类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="type" id="type">
                @foreach($aStatus as $key => $iStatus)
                    <option @if($key == $iNotice->type) selected="selected" @endif value="{{ $key }}">{{ $iStatus }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field" id="level_Div" @if($iNotice->type == 3) style="display: none" @endif>
        <label>用户层级</label>
        @foreach($levels as $item)
            <div class="ui checkbox">
                <input type="checkbox" tabindex="0" @if(in_array($item->value,$iNotice->userLevel)) checked="checked" @endif value="{{ $item->value }}" name="level_id[]" class="hidden">
                <label>{{ $item->name }}</label>
            </div>
        @endforeach
    </div>
    <input type="hidden" name="id" id="id" value="{{ $iNotice->id }}">
</form>
<script>
    $(function () {
        $('.ui.checkbox').checkbox();
        $('#addNoticeForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                title:{
                    validators: {
                        notEmpty: {
                            message: '请输入公告标题'
                        }
                    }
                },
                content:{
                    validators: {
                        notEmpty: {
                            message: '请输入公告内容'
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
                        $('#noticeTable').DataTable().ajax.reload(null,false);
                    } else {
                        Calert(result.msg,'red');
                    }
                }
            });
        });

        $('#type').on('change',function () {
            if($(this).val() == 3){
                $('#level_Div').hide();
            }else{
                $('#level_Div').show();
            }
        })
    })
</script>