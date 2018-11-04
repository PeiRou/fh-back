<style>
    .firstParam{display: flex;align-items: center;margin-bottom: 10px;}
    .firstInput{width: 20%!important;}
    .firstSpan{margin-left: 2%;}
    .firstSelect{width: 40%!important; height: 35px!important;}
</style>
<form id="addRoleForm" class="ui form" method="post" action="{{ route('ac.ad.addAdvertise') }}">
    <div class="field">
        <label>标题</label>
        <div class="ui input icon">
            <input type="text" name="title" id="title"/>
        </div>
    </div>

    <div class="field">
        <label>键名</label>
        <div class="ui input icon">
            <input type="text" name="js_key" id="js_key"/>
        </div>
    </div>

    <div class="field">
        <label>类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="type" id="type">
                @foreach($aData->advertiseType as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="field" id="div-category">
        <label>键值分类</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="category" id="category">
                @foreach($aData1->advertiseType as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="field" id="div-value">
        <label>键值</label>
        <div class="ui input icon">
            <input type="text" name="value1" id="value1"/>
            <input style="display: none;" type="file" name="value2" id="value2"/>
        </div>
    </div>

    <div class="field" id="div-aParam" style="display: none">
        <label>携带参数<button type="button" onclick="param()" style="margin-bottom: 10px;margin-top: 10px;margin-left: 30px;">添加参数</button></label>
        <div id="aParam">

        </div>
    </div>
</form>

<script type="text/html" id="aParamHtml">
    <div class="ui input icon firstParam">
        <span>键名：</span>
        <input class="firstInput" type="text" name="paramKey"/>
        <span class="firstSpan">类型：</span>
        <select name="paramType" class="firstSelect">
            @foreach($aData1->advertiseType as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
</script>
<script>
    var ready = false;
    var data1 = new Object();
    $(function () {

        $('.ui.checkbox').checkbox();
        $('#addRoleForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: '请输入标题'
                        }
                    }
                },
                js_key: {
                    validators: {
                        notEmpty: {
                            message: '请输入键名'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            getData();
            check();
        });

        $('#type').on('change',function () {
            var value = $(this).val();
            if(value == 1){
                $('#div-category').show();
                $('#div-value').show();
                $('#div-aParam').hide();
            }else if(value == 2){
                $('#div-category').hide();
                $('#div-value').hide();
                $('#div-aParam').show();
            }else if(value == 3){
                $('#div-category').hide();
                $('#div-value').hide();
                $('#div-aParam').show();
            }
        })

        $('#category').on('change',function () {
            var value = $(this).val();
            if(value == 1){
                $('#value1').show();
                $('#value2').hide();
            }else if(value == 2){
                $('#value1').hide();
                $('#value2').show();
            }
        });
    });

    function param() {
        var html = $('#aParamHtml').html();
        $('#aParam').append(html);
    }

    function getData() {
        console.log(1);
        data1.title = $('#title').val();
        data1.js_key = $('#js_key').val();
        data1.type = $('#type').val();
        data1.category = $('#category').val();
        data1.value1 = $('#value1').val();
        data1.aParamkey = $('#aParamkey').val();
        var paramKey = new Array();
        $('input[name=paramKey]').each(function () {
            paramKey.push($(this).val());
        });
        data1.paramKey = paramKey;
        var paramType = new Array();
        $('select[name=paramType]').each(function () {
            paramType.push($(this).val());
        });
        data1.paramType = paramType;
        run($('#value2')[0],function (res) {
            console.log(2);
            data1.value2 = res;
            ready = true;
        });
        return data1;
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

    function check() {
        if (ready === true) {
            // do what you want with the result variable
            console.log(data1);
            $.ajax({
                url: '{{ route('ac.ad.addAdvertise') }}',
                type: 'POST',
                data: data1,
                success: function(result) {
                    if(result.status == true){
                        jc.close();
                        $('#example').DataTable().ajax.reload(null,false);
                    }else{
                        alert(result.msg);
                    }
                }
            });
        }else{
            setTimeout(check, 1000);
        }
    };
</script>