<form id="addNoticeForm" class="ui mini form" action="{{ url('/action/admin/addSendMessage') }}">
    <div class="field">
        <label>公告标题</label>
        <div class="ui input icon">
            <input type="text" name="title" id="title"/>
        </div>
    </div>
    <div class="field">
        <label>公告内容</label>
        <div class="ui input icon">
            <textarea rows="5" name="content" id="content" style="resize: none"></textarea>
        </div>
    </div>
    <div class="field">
        <label>用户类型</label>
        <div class="ui input icon">
            <select id="user_type" class="ui fluid dropdown" name="user_type">
                <option value="">请选择一个用户</option>
                <option value="1">1.部分用户</option>
                <option value="2">2.在线用户</option>
                <option value="3">3.所有用户</option>
                <option value="4">4.支付层级</option>
            </select>
        </div>
    </div>
    <div class="field">
        {{--<label>用户层级</label>--}}
        <div class="ui input icon" id="user_input">
        </div>
        <select class="ui fluid dropdown" id="user_level_data" name="user_level" style="display: none">
        </select>
    </div>
    </div>

    <div class="field">
        <label>消息类型</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="message_type">
                <option value="">请选择消息类型</option>
                <option value="1">1.发送至用户消息中心</option>
                <option value="2">2.右下角弹出提示</option>
                <option value="3">3.页面中央弹出提示</option>
            </select>
        </div>
    </div>
</form>
<script>
    $(function () {
        $('.ui.checkbox').checkbox();
        $('#addNoticeForm').formValidation({
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
                            message: '请输入公告标题'
                        }
                    }
                },
                content: {
                    validators: {
                        notEmpty: {
                            message: '请输入公告内容'
                        }
                    }
                },
                user_type: {
                    validators: {
                        notEmpty: {
                            message: '请输入用户类型'
                        }
                    }
                },
                message_type:{
                    validators: {
                        notEmpty: {
                            message: '请输入消息类型'
                        }
                    }
                }
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
                    if (result.status == true) {
                        jc.close();
                        $('#noticeTable').DataTable().ajax.reload(null, false);
                    } else {
                        Calert(result.msg, 'red');
                    }
                }
            });
        });
    });
    $('#user_type').change(function () {
        if ($('#user_type').get(0).selectedIndex == 1) {
            var node = '<input type="text" name="user_str[]" id="title" placeholder="多个用户使用逗号,分隔"/>';
            $('#user_input').append(node);
        }else{
            $('#user_input').html('');
        }

        if ($('#user_type').get(0).selectedIndex == 4) {
            if ($('#user_level_data').css('display', 'block')) {
                $.ajax({
                    url: '/getLevel',
                    type: 'get',
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        $('#user_level_data').html('');
                        for (var i = 0; i < data.data.length; i++) {
                            var node = '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                            $('#user_level_data').append(node);
                        }
                    }
                });
            } else {
                $('#user_level_data').css('display', 'none');
                $('#user_level_data').html('');
            }
        } else {
            $('#user_level_data').html('');
            $('#user_level_data').css('display', 'none');
        }
    });
</script>