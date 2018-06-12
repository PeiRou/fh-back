<form id="addRoleForm" class="ui form" method="post" action="/action/admin/addNewRole">
    <div class="field">
        <label>角色名称</label>
        <div class="ui input icon">
            <input type="text" name="role_name" id="role_name"/>
        </div>
    </div>
    <div class="field">
        @foreach($permissions as $item)
            <div class="ui checkbox">
                <input type="checkbox" tabindex="0" value="{{ $item->id }}" name="permission_id[]" class="hidden">
                <label>{{ $item->name }}</label>
            </div>
        @endforeach
    </div>
</form>

<script>
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
                role_name: {
                    validators: {
                        notEmpty: {
                            message: '请输入角色名称'
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

                }
            });
        });
    });
</script>