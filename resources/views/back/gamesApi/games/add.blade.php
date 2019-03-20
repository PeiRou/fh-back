<link rel="stylesheet" href="/vendor/zTree_v3/css/metroStyle/metroStyle.css">
<script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.excheck.js"></script>
<style>
    .firstParam{display: flex;align-items: center;margin-bottom: 10px;}
    .firstInput{width: 20%!important;}
    .firstSpan{margin-left: 2%;}
</style>
<form id="addPermissionAuthForm" class="ui form" action="/back/modal/addGamesApiList">
    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
    <div class="field">
        <label>父级栏目</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="pid" id="pid" style='height:32px !important'>
                <option value="0">无父级</option>
                @foreach($p as $v)
                    <option value="{{ $v['id'] }}" @if(isset($data->pid) && $v['id'] == $data->pid) selected = "selected" @endif>{{ '  |'.str_repeat('__', $v['level'] + 1) }}{{ $v['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>游戏名称</label>
        <div class="ui input icon">
            <input type="text" name="name" id="name"  value="{{ $data->name ?? '' }}"/>
        </div>
    </div>
    <div class="field">
        <label>使用接口</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="g_id" id="g_id" style='height:32px !important'>
                <option value="0">请选择</option>
                @foreach($apis as $v)
                    <option value="{{ $v['g_id'] }}" @if(isset($data->g_id) && $data->g_id == $v['g_id']) selected = "selected" @endif >{{ $v['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>类型</label>
        <div class="ui input icon">
            <input type="text" name="type" id="type" value="{{ $data->type ?? 1 }}"/>
        </div>
    </div>
    <div class="field">
        <label>开关</label>
        <div class="ui toggle checkbox" style="display: flex; align-items: center" >
            <input type="checkbox" id="chkOpenOpen" name="open" @if(isset($data) && $data->open == "1") checked="checked" @endif >
            <label></label>
            <span id="dvOpenOpenOn" class="green" @if(!isset($data) || $data->open != "1")style="display: none"@endif>开启中</span>
            <span id="dvOpenOpenUn" class="red" @if(isset($data) && $data->open == "1")style="display: none"@endif>关闭中</span>
        </div>
    </div>
    <div class="field" id="div-aParam" style="display: inline-block">
        <label>携带参数<button type="button" onclick="param()" style="margin-bottom: 10px;margin-top: 10px;margin-left: 30px;">添加参数</button></label>
        <div id="aParam">
            @if(!empty($data))
                @foreach(json_decode($data->param)??[] as $k=>$v)
                    <div class="ui input icon firstParam">
                        <span>参数：</span>
                        <input class="firstInput" type="text" name="paramKey[]" value="{{ $k }}"/>
                        <span class="firstSpan">值：</span>
                        <input class="firstInput" type="text" name="paramValue[]" value="{{ $v }}"/>
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
    </div>
</script>
<script>

    $('#chkOpenOpen').change(function () {
        if($(this).prop( "checked" )==true){
            $('#dvOpenOpenOn').show();
            $('#dvOpenOpenUn').hide();
        }else{
            $('#dvOpenOpenUn').show();
            $('#dvOpenOpenOn').hide();
        }
    });

    function param() {
        var html = $('#aParamHtml').html();
        $('#aParam').append(html);
    }

    $(function () {
        $('#addPermissionAuthForm').formValidation({
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
                            message: '请输入游戏名称'
                        }
                    }
                },
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target),
                fv = $form.data('formValidation');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (e) {
                    if(e.code == 0){
                        jc1.close();
                        dataTable.ajax.reload();
                    }else{
                        Calert(e.msg,'red')
                    }
                }
            });
        });
    });
</script>