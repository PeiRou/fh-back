<style>
    .firstParam{display: flex;align-items: center;margin-bottom: 10px;}
    .firstInput{width: 20%!important;}
    .firstSpan{margin-left: 2%;}
    .firstSelect{width: 40%!important; height: 35px!important;}
</style>
<link rel="stylesheet" href="{{ asset('back/vendor/ueditor/themes/default/css/umeditor.css') }}">
<script src="{{ asset('back/vendor/ueditor/umeditor.config.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/umeditor.min.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
<form id="formBox" class="ui form" method="post" action="{{ route('ac.ad.GamesApi.edit') }}">
    <input type="hidden" name="g_id" value="{{ $g_id }}">
    <div class="field">
        <label>名称</label>
        <div class="ui input icon">
            <input type="text" name="name" id="name" value="{{ $data->name ?? '' }}"/>
        </div>
    </div>

    <div class="field" id="div-description">
        <label>描述</label>
        <div class="ui input icon">
            <input type="text" name="description" id="description" value="{{ $data->description ?? '' }}"/>
        </div>
    </div>

    <div class="field">
        <label>类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="type_id" id="type">
                <option value="111">棋牌游戏</option>
                {{--@foreach($aData->advertiseType as $key => $value)--}}
                    {{--<option value="{{ $key }}">{{ $value }}</option>--}}
                {{--@endforeach--}}
            </select>
        </div>
    </div>
    <div class="field" id="div-aParam" style="">
        <label>携带参数<button type="button" onclick="param()" style="margin-bottom: 10px;margin-top: 10px;margin-left: 30px;">添加参数</button></label>
        <div id="aParam">
            @if(!empty($paramArr))
                @foreach($paramArr as $k=>$v)
                    <div class="ui input icon firstParam">
                        <span>参数：</span>
                        <input class="firstInput" type="text" name="paramKey[]" value="{{ $v->key }}"/>
                        <span class="firstSpan">值：</span>
                        <input class="firstInput" type="text" name="paramValue[]" value="{{ $v->value }}"/>
                        <span class="firstSpan">描述：</span>
                        <input class="firstInput" type="text" name="paramDescribes[]" value="{{ $v->description }}"/>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</form>
<script type="text/html" id="aParamHtml">
    <div class="ui input icon firstParam">
        <span>参数：</span>
        <input class="firstInput" type="text" name="paramKey[]"/>
        <span class="firstSpan">值：</span>
        <input class="firstInput" type="text" name="paramValue[]"/>
        <span class="firstSpan">描述：</span>
        <input class="firstInput" type="text" name="paramDescribes[]"/>
    </div>
</script>
<script>
    function param() {
        var html = $('#aParamHtml').html();
        $('#aParam').append(html);
    }
    $(function () {
        $('#formBox').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: '请输入名称'
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
                dataType:'json',
                data: $form.serialize(),
                success: function(result) {
                    if(result.code == 0){
                        jc.close();
                        dataTable.ajax.reload(null,false);
                    }else{
                        dataTable.ajax.reload(null,false)
                        Calert(result.msg,'red')
                    }
                }
            });
        });
    });
</script>