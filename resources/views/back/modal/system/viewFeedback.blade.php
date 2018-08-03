<link rel="stylesheet" href="{{ asset('back/vendor/ueditor/themes/default/css/umeditor.css') }}">
<script src="{{ asset('back/vendor/ueditor/umeditor.config.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/umeditor.min.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
<style>
    .playerQ{
        position: relative;
        border: 1px solid #333;
        padding: 10px;
        overflow: hidden;
        min-height: 80px;
        background-color: #F2F2F2;
    }
    .playerQ label{
        display: inline-block;
        position: absolute;
        top: 10px;
        left: 10px;
    }
    .playerQ .huifuren,
    .neironghui .huifuren{
        display: inline-block;
        position: absolute;
        right: 10px;
        bottom: 10px;
    }
    .neironghui{
        position: relative;
        border: 1px solid #E8D68C;
        padding: 10px;
        overflow: hidden;
        min-height: 80px;
        background-color: #ffffcb;
    }
    .neironghui label{
        display: inline-block;
        position: absolute;
        top: 10px;
        left: 10px;
    }
    .huifuCon{

    }
</style>
<form id="addArticleForm" class="ui mini form" action="{{ url('/action/admin/replyFeedback') }}">
    <div class="field">
        <label>问题类型 : {{ $iFeedback->typeName }}</label>
    </div>
    @foreach($aMessage as $iMessage)
        @if($iMessage->type == 1)
            <div class="field playerQ">
                <label>玩家问题 ：{{ $iMessage->content }}</label>
                <div class="huifuren">
                    <span>回复人 ： {{ $iMessage->account }} </span>
                    <span>回复时间 ： {{ $iMessage->created_at }}</span>
                </div>
            </div>
        @elseif($iMessage->type == 2)
            <div class="field neironghui">
                <label>内容回复 ：{{ $iMessage->content }}</label>
                <div class="huifuren">
                    <span>回复人 ： {{ $iMessage->account }} </span>
                    <span>回复时间 ： {{ $iMessage->created_at }}</span>
                </div>
            </div>
        @endif
    @endforeach
    <div class="field">
        <label>问题回复 ：</label>
        <textarea name="content" rows="1"></textarea>
    </div>
    <input type="hidden" name="feedback_id" value="{{ $iFeedback->id }}">
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
                            jc1.close();
                            $('#example').DataTable().ajax.reload(null,false);
                        } else {
                            Calert(result.msg,'red');
                        }
                    }
                });

            });
        });
    });
</script>