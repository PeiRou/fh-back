<!-- 秒速七星彩 -->
<form id="game114Form" action="{{ url('/game/table/agent/odds/save/'.$gameId.'/'.$agentId) }}">
    <table align="center" class="ui celled small table">
        <tbody>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">秒速七星彩</td>
        </tr>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-7球号</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['1_7_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['1_7_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="1_7_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['2face_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['2face_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="2face_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">龙虎和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙，虎</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['longhu_odds'] }}" >
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['longhu_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="longhu_odds">
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="odds[]" value="{{ $odds['he_odds'] }}">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="rebate[]" value="{{ $rebate['he_rebate'] }}">
                </div>
            </td>
            <input type="hidden" name="code[]" value="he_odds">
        </tr>
        </tbody>
    </table>
    <div class="foot-submit">
        <button class="ui primary button" onclick="resetOdds()" type="button">重 置</button>
        <button class="ui primary button" onclick="saveOdds()">保 存</button>
        <button class="ui primary button" onclick="restore()" type="button">默 认</button>
    </div>
</form>
<script>
    function saveOdds() {
        $('#game114Form').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {}
        }).on('success.form.fv', function (e) {
            loader(true);
            e.preventDefault();
            var $form = $(e.target),
                fv = $form.data('formValidation');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    if (result.status == true) {
                        loader(false);
                    }
                }
            });
        });
    }

    function restore() {
        $.ajax({
            url: '{{ url('/game/table/agent/odds/restore/'.$gameId.'/'.$agentId) }}',
            type: 'POST',
            data: [],
            success: function (result) {
                if (result.status == true) {
                    resetOdds();
                }
            }
        });
    }

    function resetOdds() {
        $('#second_content').load('/game/agent/tables/set/{{ $gameId }}/{{ $agentId }}',function () {
            loader(false);
        });
    }
</script>