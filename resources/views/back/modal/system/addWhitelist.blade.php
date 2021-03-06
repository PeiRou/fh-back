<link rel="stylesheet" href="{{ asset('back/vendor/ueditor/themes/default/css/umeditor.css') }}">
<script src="{{ asset('back/vendor/ueditor/umeditor.config.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/umeditor.min.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/lang/zh-cn/zh-cn.js') }}"></script>

<form id="addArticleForm" class="ui mini form" action="{{ url('/action/admin/addWhitelist') }}">
    <div class="field">
        <label>IP</label>
        <div class="ui input icon">
            <input type="text" name="ip"/>
        </div>
    </div>
    <div class="field">
        <label>备注</label>
        <div class="ui input icon">
            <input type="text" name="content"/>
        </div>
    </div>
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
                        if(result.status == true){
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