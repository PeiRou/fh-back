<link rel="stylesheet" href="{{ asset('back/vendor/ueditor2/themes/default/css/ueditor.css') }}">
<script src="{{ asset('back/vendor/ueditor2/ueditor.config.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor2/ueditor.all.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor2/lang/zh-cn/zh-cn.js') }}"></script>
<style>
    .edui-popup-content{
        z-index: 9999999999999999999999;
    }
    #edui251{
        z-index: 999999999!important;
    }
    .jconfirm{
        z-index: 1000;
    }
</style>
<form id="addRoleForm" class="ui form" action="{{ route('ac.ad.editAdvertiseInfo') }}">

    @foreach($aData as $kData => $iData)
        <div class="field">
            <label>{{ $iData->description }}({{ $iData->js_key }})</label>
            <div class="ui icon">
                @if($iData->type == 1)
                    <input type="text" name="{{ $iData->js_key }}" data-id="{{ $iData->id }}" value="{{ $iData->js_value }}"/>
                @elseif($iData->type == 2)
                    <input type="file" name="pic" onchange="getBase64(this,'{{ $iData->js_key }}')"/>
                    <input type="hidden" name="{{ $iData->js_key }}" data-id="{{ $iData->id }}" value="{{ $iData->js_value }}"/>
                    <img src="{{ $iData->js_value }}" style="margin-top: 10px;">
                @elseif($iData->type == 3)
                    <script id="{{ $iData->js_key }}" name="{{ $iData->js_key }}" type="text/plain">
                        {!! htmlspecialchars_decode($iData->js_value) !!}
                    </script>
{{--                    <textarea name="{{ $iData->js_key }}" data-id="{{ $iData->id }}" id="{{ $iData->js_key }}">{{ $iData->js_value }}</textarea>--}}
                @endif
            </div>
        </div>
    @endforeach
    @if($type == 3)
        <div class="field">
            <label>键名</label>
            <div class="ui input icon">
                <input type="text" name="js_key" id="js_key" value="{{ $iInfo->js_key }}"/>
            </div>
        </div>
    @endif
    <input type="hidden" name="info_id" value="{{ $iInfo->id }}">
</form>

<script>

    $(function () {
        @foreach($aData as $kData => $iData)
            @if($iData->type == 3)
                var ue = UE.getEditor('{{ $iData->js_key }}',{
            initialFrameHeight : 320
        });
                {{--window.um = UM.getEditor('{{ $iData->js_key }}',{--}}
                    {{--initialFrameWidth: null,--}}
                    {{--// imageUrl:'/back/vendor/ueditor/php/imageUp.php',--}}
                    {{--// imagePath:'/back/vendor/ueditor/php/',--}}
                    {{--// imageFieldName:'upload/'--}}
                {{--});--}}
                var lang = ue.getOpt('lang');
            @endif
        @endforeach

        $('#addRoleForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {

            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target),
                fv = $form.data('formValidation');
            var data = $form.serialize();


            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: data,
                success: function (result) {
                    if(result.status == true){
                        jc.close();
                        $('#example').DataTable().ajax.reload(null,false);
                    }else{
                        alert(result.msg);
                        jc.close();
                    }
                }
            });
        });
    });

    function run(input_file,get_data){
        /*input_file：文件按钮对象*/
        /*get_data: 转换成功后执行的方法*/
        if ( typeof(FileReader) === 'undefined' ){
            alert("抱歉，你的浏览器不支持 FileReader，不能将图片转换为Base64，请使用现代浏览器操作！");
        } else {
            try{
                /*图片转Base64 核心代码*/
                var file = input_file.files[0];
                if(file !== undefined) {
                    //这里我们判断下类型如果不是图片就返回 去掉就可以上传任意文件
                    if (!/image\/\w+/.test(file.type)) {
                        alert("请确保文件为图像类型");
                        return false;
                    }
                    var reader = new FileReader();
                    reader.onload = function () {
                        get_data(this.result);
                    };
                    reader.readAsDataURL(file);
                }else{
                    get_data('');
                }
            }catch (e){
                alert('图片转Base64出错啦！'+ e.toString())
            }
        }
    }

    function getBase64(e,key) {
        run(e,function (res) {
            $(e).siblings("input[name="+key+"]").val(res);
            $(e).siblings("img").attr('src',res);
        });
    }

</script>