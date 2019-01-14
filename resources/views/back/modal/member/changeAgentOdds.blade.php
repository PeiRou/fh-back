<form id="addAgentForm" class="ui mini form" action="{{ url('/action/admin/changeAgentOdds') }}">
    @foreach($aAgentOdds as $iAgentOdds)
        <div class="field">
            <label>{{ $iAgentOdds->title }}提成</label>
            <div class="ui input icon">
                <select class="ui fluid dropdown" name="odds_level[]" id="odds_level">
                    @foreach($iAgentOdds->info as $iInfo)
                        <option @if($aOddsArray[$iAgentOdds->odds_category_id] == $iInfo->id) selected="selected" @endif value="{{ $iInfo->id }}">{{ $iInfo->odds }} %</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endforeach
    <input type="hidden" name="agent_id" value="{{ $agentId }}">
</form>
<script>

    $('#addAgentForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon'
        },
        fields: {

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
                    $('#agentTable').DataTable().ajax.reload(null,false);
                }else{
                    alert(result.msg);
                }
            }
        });
    });
</script>