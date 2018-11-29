<style>
    .firstParam{display: flex;align-items: center;margin-bottom: 10px;}
    .firstInput{width: 20%!important;}
    .firstSpan{margin-left: 2%;}
    .firstSelect{width: 40%!important; height: 35px!important;}
    /* 支付配置修改的css文件 修改样式 */
    .ui.form .field{
        display: flex;
    }
    .ui.form .field>label{
        min-width: 88px;
        display: flex;
        align-items: center;
    }
    .ui.checkbox input.hidden+label {
        margin-right: 5px;
    }
    .ui.form .field {
        clear: both;
        margin: 0 0 0.4em;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        height: 1px;
    }
    .select2-container--default .select2-selection--multiple {
        height: 1px;
    }
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
    <div class="field" id="div-description">
        <label>别名</label>
        <div class="ui input icon">
            <input type="text" name="alias" id="class_name" value="{{ $data->alias ?? '' }}"/>
        </div>
    </div>
    <div class="field" id="div-description">
        <label>类名</label>
        <div class="ui input icon">
            <input type="text" name="class_name" id="class_name" value="{{ $data->class_name ?? '' }}"/>
        </div>
    </div>
    <div class="field">
        <label>类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="type_id" id="type">
                <option value="0">游戏类型</option>
                @foreach($statusArr as $key => $value)
                    <option  @if(isset($data->type_id) && $data->type_id == $key) selected = "selected" @endif value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>开关</label>
        <div class="ui toggle checkbox" style="display: flex; align-items: center" >
            <input type="checkbox" id="chkOpenStatus" name="status" @if($data && $data->status == "1") checked="checked" @endif >
            <label></label>
            <span id="dvOpenStatusOn" class="green" @if(!$data || $data->status != "1")style="display: none"@endif>开启中</span>
            <span id="dvOpenStatusUn" class="red" @if($data && $data->status == "1")style="display: none"@endif>关闭中</span>
        </div>
    </div>
    <div class="field" id="div-aParam" style="display: inline-block">
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
    $('#chkOpenStatus').change(function () {
        if($(this).prop( "checked" )==true){
            $('#dvOpenStatusOn').show();
            $('#dvOpenStatusUn').hide();
        }else{
            $('#dvOpenStatusUn').show();
            $('#dvOpenStatusOn').hide();
        }
    });
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