<link rel="stylesheet" href="{{ asset('back/vendor/ueditor/themes/default/css/umeditor.css') }}">
<script src="{{ asset('back/vendor/ueditor/umeditor.config.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/umeditor.min.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/lang/zh-cn/zh-cn.js') }}"></script>

<form id="editArticleForm" class="ui mini form" action="{{ url('/action/admin/editArticle') }}">
    <div class="field">
        <label>文章标题</label>
        <div class="ui input icon">
            <input type="text" name="title" value="{{ $article->title }}"/>
        </div>
    </div>

    <div class="two fields">
        <div class="field">
            <label>类型</label>
            <div class="ui input icon">
                <select class="ui fluid dropdown" name="type">
                    <option @if($article->type == 1) selected @endif value="1">新闻</option>
                    <option @if($article->type == 2) selected @endif value="2">公告</option>
                    <option @if($article->type == 3) selected @endif value="3">经验</option>
                </select>
            </div>
        </div>
        <div class="field">
            <label>是否置顶</label>
            <div class="ui input icon">
                <select class="ui fluid dropdown" name="up">
                    <option @if($article->up == 0) selected @endif value="0">否</option>
                    <option @if($article->up == 1) selected @endif value="1">是</option>
                </select>
            </div>
        </div>
    </div>

    <input type="hidden" value="{{ $id }}" name="id">

    <div class="field">
        <div class="ui input icon">
            <textarea name="container" id="container" rows="10" style="width:100%">{{ $article->content }}</textarea>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(function(){
        window.um = UM.getEditor('container',{
            initialFrameWidth: null
        });

        $(function () {
            $('.ui.checkbox').checkbox();
            $('#noArea').select2();

            $('#editArticleForm')
                .formValidation({
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
                                    message: '文章标题不能为空'
                                }
                            }
                        }
                    }
                }).on('success.form.fv', function(e) {
                e.preventDefault();
                var $form = $(e.target),
                    fv    = $form.data('formValidation');

                if($('#container').val() == ""){
                    Calert('请输入文章内容','red');
                    return false;
                } else {
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
                }

            });
        });
    });
</script>