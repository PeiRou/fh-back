<!-- 北京快乐8 -->
<form id="game65Form" action="{{ url('/game/table/agent/odds/save/'.$gameId.'/'.$agentId) }}">
<table align="center" class="ui celled small table">
    <tbody>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">北京快乐8</td>
    </tr>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">正码</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['ZM_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['ZM_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="ZM_odds">
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
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">总和和局</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['heju_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['heju_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="heju_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">总和过关</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['guoguan_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['guoguan_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="guoguan_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">前后和</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前（多）后（多）</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['qianhou_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['qianhou_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="qianhou_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['qianhouhe_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['qianhouhe_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="qianhouhe_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">单双和</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单（多）双（多）</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['danshuang_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['danshuang_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="danshuang_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['danshuanghe_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['danshuanghe_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="danshuanghe_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">五行</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">金，土</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['jin_tu_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['jin_tu_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="jin_tu_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">木，火</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['mu_huo_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['mu_huo_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="mu_huo_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">水</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['shui_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['shui_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="shui_odds">
    </tr>
    </tbody>
    <div class="foot-submit">
        <button class="ui primary button" onclick="resetOdds()" type="button">重 置</button>
        <button class="ui primary button" onclick="saveOdds()">保 存</button>
        <button class="ui primary button" onclick="restore()" type="button">默 认</button>
    </div>
</table>
</form>
<script>
    function saveOdds() {
        $('#game65Form').formValidation({
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
                },
                error: function(data, status, xhr){
                    if(data.status == 403)
                    {
                        loader(false);
                        alert('您无权操作');
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
            },
            error: function(data, status, xhr){
                if(data.status == 403)
                {
                    loader(false);
                    alert('您无权操作');
                }
            }
        });
    }

    function resetOdds() {
        $('#first_content').load('/game/agent/tables/set/{{ $gameId }}/{{ $agentId }}',function () {
            loader(false);
        });
    }
</script>