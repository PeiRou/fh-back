<form id="editUserLevelsForm" class="ui mini form" action="{{ url('/action/admin/editDrawingLevels') }}">
    <div class="field">
        <label>当前会员：{{ $user->username }}</label>
        <label>当前会员层级：{{ $levels->name }}</label>
    </div>
    <div class="field">
        <label>层级将要变更为</label>
        <div class="ui input icon">
            <select class="ui fluid dropdown" name="levels">
                @foreach($levelsData as $item)
                    <option @if($item->value == $user->rechLevel) selected @endif value="{{ $item->value }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="hidden" name="userid" value="{{ $user->id }}">
    <input type="hidden" name="rid" value="{{ $rid}}">
</form>
<script>
    $(function () {
        $('#editUserLevelsForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {}
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
                    }
                }
            });
        });
    })
</script>