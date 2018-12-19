<form id="addAgentSettleDomain" class="ui mini form" action="{{ url('/action/admin/agentSettle/addAgentSettleDomain') }}">
    <div class="field">
        <label>代理域名</label>
        <div class="ui input icon">
            <input type="text" name="url"  placeholder=""/>
        </div>
    </div>
    <div class="field">
        <label>代理帐号</label>
        <div class="ui input icon">
            <input type="text" name="name"  placeholder=""/>
        </div>
    </div>

</form>

<style>
    .select2-search__field{border: none !important;}
    .select2-container{z-index: 9999999999 !important;}
</style>

<script>
    $(function () {
        $('.ui.checkbox').checkbox();
        $('#noArea').select2();

        $('#addAgentSettleDomain')
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