<form id="gameSettingForm" class="ui form" action="{{ url('/action/admin/editKillSetting') }}">
    <div class="field">
        <label>游戏名称</label>
        <div class="ui input icon">
            <input type="text" value="{{ $game->game_name }}" readonly="readonly"/>
        </div>
    </div>
    <div class="field">
        <label>平台保留营利比</label>
        <div class="ui input icon">
{{--            <input type="text" name="kill_rate" value="{{ floatval($game->kill_rate) }}"/>--}}
            <select class="ui fluid dropdown" name="kill_rate">
                @foreach($statusArr as $key => $value)
                    <option  @if(floatval($game->kill_rate) == $key) selected = "selected" @endif value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $id }}">
</form>
<script>
$(function () {
    $('#gameSettingForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {
            order: {
                kill_rate: {
                    numeric: {
                        message: '营利比只能是数字',
                        thousandsSeparator: '',
                        decimalSeparator: '.'
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
                    $('#gamesTable').DataTable().ajax.reload(null,false);
                }else{
                    Calert(result.msg,'red')
                }
            }
        });
    });
})
</script>