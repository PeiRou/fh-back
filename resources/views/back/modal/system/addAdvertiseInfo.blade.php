<link rel="stylesheet" href="{{ asset('back/vendor/ueditor/themes/default/css/umeditor.css') }}">
<script src="{{ asset('back/vendor/ueditor/umeditor.config.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/umeditor.min.js') }}"></script>
<script src="{{ asset('back/vendor/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
<form id="addRoleForm" class="ui form" action="{{ route('ac.ad.addAdvertiseInfo') }}">

    <div class="field">
        <label>广告位</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="ad_id" id="adId" style='height:32px !important'>
                <option value="">请选择广告位</option>
                @foreach($aData as $iData)
                    <option value="{{ $iData->id }}">{{ $iData->title }}({{ $advertiseValue->advertiseType[$iData->type] }})</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="div-key">

    </div>

    <div class="field" style="margin-top: 10px;">
        <label>排序</label>
        <div class="ui input icon">
            <input type="text" name="sort" id="sort"/>
        </div>
    </div>
</form>

<script type="text/html" id="aJsKeyHtml">
    <div class="field">
        <label>键名</label>
        <div class="ui input icon">
            <input type="text" name="js_key" id="js_key"/>
        </div>
    </div>
</script>

<script>
    $(function () {
        $('#adId').on('change',function () {
            var ad_id = $(this).val();

            var html = '';
            $.ajax({
                url: '{{ route('ac.ad.getAdvertiseKey') }}',
                type: 'POST',
                data: {ad_id:ad_id},
                success: function (res) {
                    var result = res.data;
                    var info = res.info;
                    var array = new Array();
                    if(info.type == 3){
                        html += $('#aJsKeyHtml').html();
                    }
                    for (var i = 0;i < result.length;i++){
                        html += '<div class="field">';
                        html += '<label>'+result[i].js_key+'</label>';
                        html += '<div class="ui input icon">';
                        if(result[i].type == 1){
                            html += '<input type="text" name="'+result[i].js_key+'"/>';
                        }else if(result[i].type == 2){
                            html += '<input onchange="getBase64(this)" type="file" name="pic[]"/><input type="hidden" name="'+result[i].js_key+'"/>';
                        }else if(result[i].type == 3){
                            html += '<textarea type="text" name="'+result[i].js_key+'" id="'+result[i].js_key+'"></textarea>';
                            array.push(result[i].js_key);
                        }
                        html += '</div></div>';
                    }
                    $('#div-key').html(html);
                    getEditor(array);
                }
            });
        });

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
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    if(result.status == true){
                        jc.close();
                        $('#example').DataTable().ajax.reload(null,false);
                    }
                }
            });
        });
    });

    function getEditor(array) {
        if(array.length !== 0) {
            for(var i = 0;i < array.length;i++){
                window.um = UM.getEditor(array[i], {
                    initialFrameWidth: null
                });
            }
        }
    }

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

    function getBase64(e) {
        run(e,function (res) {
            $(e).siblings().val(res);
        });
    }

</script>