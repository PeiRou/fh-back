
<form id="editAgentSettleDomain" class="ui form" action="{{ url('/action/admin/agentSettle/editAgentSettleDomain') }}">
    <div class="field">
        <label>代理域名</label>
        <div class="ui input icon">
            <input type="text"  name="url"  value="{{ $data->url }}" readonly="readonly"/>
        </div>
    </div>
    <div class="field">
        <label>代理帐号</label>
        <div class="ui input icon">
            <input type="text"  name="name"  value="{{ $data->name }}" />
        </div>
    </div>

    <input type="hidden" name="agent_domain_id" value="{{ $data->id }}">
</form>
<script>
    $(function () {
        $('.ui.checkbox').checkbox();
        $('#noArea').select2();

        $('#editAgentSettleDomain')
            .formValidation({
                framework: 'semantic',
                icon: {
                    valid: 'checkmark icon',
                    invalid: 'remove icon',
                    validating: 'refresh icon'
                },
                fields: {
                    url: {
                        validators: {
                            notEmpty: {
                                message: '域名必须填写'
                            }
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {
                                message: '名称必须填写'
                            }
                        }
                    },
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
                        $('#editArticleForm').DataTable().ajax.reload(null,false);
                    } else {
                        Calert(result.msg,'red');
                    }
                }
            });
        });
    });
</script>