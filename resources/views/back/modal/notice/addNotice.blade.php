<form id="addNoticeForm" class="ui mini form" action="{{ url('/action/admin/addNotice') }}">
    <div class="field">
        <label>公告标题</label>
        <div class="ui input icon">
            <input type="text" name="title" id="title"/>
        </div>
    </div>
    <div class="field">
        <label>公告内容</label>
        <div class="ui input icon">
            <textarea rows="5" name="content" id="content" style="resize: none"></textarea>
        </div>
    </div>
    <div class="field">
        <label>公告类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="type" id="type">
                <option value="1">1.最新消息(投注区底部公告)</option>
                <option value="2">2.最新消息(登录弹窗公告)</option>
                <option value="3">3.最新消息(手机未登录公告)</option>
                <option value="4">4.所有类型公告(包含：1、2)</option>
                <option value="5">5.代理专属公告</option>
            </select>
        </div>
    </div>
    <div class="field" id="level_Div">
        <label>用户层级</label>
        @foreach($levels as $item)
            <div class="ui checkbox">
                <input type="checkbox" tabindex="0" value="{{ $item->value }}" name="level_id[]" class="hidden">
                <label>{{ $item->name }}</label>
            </div>
        @endforeach
    </div>
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