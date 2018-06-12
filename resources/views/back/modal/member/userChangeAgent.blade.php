<form id="userChangeAgentForm" class="ui mini form" action="{{ url('/action/admin/userChangeAgent') }}">
    <div class="field">
        <label>当前会员: <span style="color: #888;font-weight: normal;">{{ $username }}</span></label>
    </div>
    <div class="field">
        <label>当前代理: <span style="color: #888;font-weight: normal;">{{ $agentAccount }} - {{ $agentName }}</span></label>
    </div>
    <div class="field">
        <label>上级代理</label>
        <div class="ui input icon">
            <select style="height: 40px;" id="agentSelect" name="agent">
            </select>
        </div>
    </div>
    <input type="hidden" name="uid" value="{{ $uid }}">
</form>
<style>
    .select2-container--open{
        z-index: 99999999 !important;
    }
</style>
<script>
    $(document).ready(function() {
        $('#agentSelect').select2();

        $('#userChangeAgentForm')
            .find('[name="agent"]')
            .select2({
                placeholder: '选择或搜索代理',
                theme: "classic",
                "language": {
                    "noResults": function(){
                        return "没有找到符合的结果";
                    }
                },
                escapeMarkup: function (markup) {
                    return markup;
                },
                ajax: {
                    url: "/web/api/select2/agents",//请求的API地址
                    dataType: 'json',//数据类型
                    data: function(params){
                        return {
                            q: params.term//此处是最终传递给API的参数
                        }
                    },
                    results : function(data){ return data;}//返回的结果s
                }
            })
            // Revalidate the color when it is changed
            .change(function(e) {
                $('#userChangeAgentForm').formValidation('revalidateField', 'agent');
            })
            .end()
            .formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                agent: {
                    validators: {
                        notEmpty: {
                            message: '请选择上级代理'
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
                data: $form.serialize(),
                success: function(result) {
                    if(result.status == true){
                        jc.close();
                        $('#userTable').DataTable().ajax.reload(null,false);
                    } else {
                        Calert(result.msg,'red');
                    }
                }
            });
        });
    });
</script>