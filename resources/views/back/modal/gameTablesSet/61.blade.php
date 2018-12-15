<!-- 重庆幸运农场 -->
<form id="game61Form" action="{{ url('/game/table/agent/odds/save/'.$gameId.'/'.$agentId) }}">
<table align="center" class="ui celled small table">
    <tbody>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">重庆幸运农场</td>
    </tr>
    <tr class="firstRow">
        <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-8球号</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['1_8_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['1_8_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="1_8_odds">
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
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">1-8方位</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['1_8_FW_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['1_8_FW_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="1_8_FW_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">1-8中发白</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">中发</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['zhongfa_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['zhongfa_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="zhongfa_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">白</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['bai_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['bai_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="bai_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">正码</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
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
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和单双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总单</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['zongdan_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['zongdan_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="zongdan_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总双</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['zongshuang_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['zongshuang_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="zongshuang_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">总和尾数大小</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾大</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['zongweida_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['zongweida_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="zongweida_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">总尾小</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['zongweixiao_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['zongweixiao_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="zongweixiao_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="6" align="center" class="deep-blue-td">连码</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选二</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['rx2_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['rx2_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="rx2_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">选二连组</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['x2lz_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['x2lz_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="x2lz_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选三</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['rx3_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['rx3_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="rx3_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">选三前组</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['x3qz_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['x3qz_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="x3qz_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选四</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['rx4_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['rx4_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="rx4_odds">
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">任选五</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="odds[]" value="{{ $odds['rx5_odds'] }}">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="rebate[]" value="{{ $rebate['rx5_rebate'] }}">
            </div>
        </td>
        <input type="hidden" name="code[]" value="rx5_odds">
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
        $('#game61Form').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {}
        }).on('success.form.fv', function(e) {
            loader(true);
            e.preventDefault();
            var $form = $(e.target),
                fv    = $form.data('formValidation');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                    if(result.status == true){
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