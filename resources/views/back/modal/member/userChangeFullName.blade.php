<form id="userChangeFullNameForm" class="ui mini form" action="{{ url('/action/admin/userChangeFullName') }}">
    <div class="field">
        <label>会员账号: <span style="color: #888;font-weight: normal;">{{ $user->username }}</span></label>
    </div>
    <div class="field">
        <label>真实姓名</label>
        <div class="ui input icon">
            <input type="text" name="fullName" value="{{ $user->fullName }}"/>
        </div>
    </div>
    <input type="hidden" name="uid" value="{{ $user->id }}">
</form>
<script>
    $(function () {
        $('#userChangeFullNameForm')
            .formValidation({
                framework: 'semantic',
                icon: {
                    valid: 'checkmark icon',
                    invalid: 'remove icon',
                    validating: 'refresh icon'
                },
                fields: {
                    fullName: {
                        validators: {
                            notEmpty: {
                                message: '真实姓名必须填写'
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
    })
</script>