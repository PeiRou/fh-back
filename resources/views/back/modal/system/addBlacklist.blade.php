<link rel="stylesheet" href="{{ asset('back/vendor/ueditor/themes/default/css/umeditor.css') }}">
<script src="{{ asset('back/vendor/ueditor/umeditor.config.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/umeditor.min.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/lang/zh-cn/zh-cn.js') }}"></script>

<form id="addArticleForm" class="ui mini form" action="{{ url('/action/admin/editBlacklist') }}">
    <div class="field">
        <label>类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="type" id="type" >
                <option value="">请选择</option>
                @foreach(\App\Blacklist::$types as $k=>$v)
                    <option value="{{ $k }}" @if(isset($info->type) && $info->type == $k) selected @endif>{{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>参数</label>
        <div class="ui input icon">
            <input type="text" name="value" value="{{ $info->value ?? '' }}"/>
        </div>
    </div>
    <div class="field">
        <label>备注</label>
        <div class="ui input icon">
            <input type="text" name="content" value="{{ $info->content ?? '' }}"/>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
</form>

<script type="text/javascript">
    $(function(){
        $(function () {
            $('#addArticleForm')
                .formValidation({
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
                        if(result.code == 0){
                            jc.close();
                            $('#articleTable').DataTable().ajax.reload(null,false);
                        } else {
                            Calert(result.msg,'red');
                        }
                    }
                });

            });
        });
    });
</script>