<!-- 天津时时彩 -->
<form id="game5Form">
    <table align="center" class="ui celled small table">
        <tbody>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="4" align="center" class="blue-title-table">天津时时彩</td>
        </tr>
        <tr class="firstRow">
            <td valign="middle" rowspan="1" colspan="2" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">种类</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">赔率</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-title-table" style="font-size: 13px;padding: 4px !important;">退水</td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="deep-blue-td">1-5球号</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" width="200" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_5_odds" value="{{ $odds['1_5_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="1_5_rebate" value="{{ $rebate['1_5_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">两面</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="2face_odds" value="{{ $odds['2face_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="2face_rebate" value="{{ $rebate['2face_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">龙虎和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">龙，虎</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="longhu_odds" value="{{ $odds['longhu_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="longhu_rebate" value="{{ $rebate['longhu_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="he_odds" value="{{ $odds['he_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="he_rebate" value="{{ $rebate['he_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="5" align="center" class="deep-blue-td">前三中三后三</td>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">豹子</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_baozi_odds" value="{{ $odds['q3z3h3_baozi_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_baozi_rebate" value="{{ $rebate['q3z3h3_baozi_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">顺子</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_shunzi_odds" value="{{ $odds['q3z3h3_shunzi_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_shunzi_rebate" value="{{ $rebate['q3z3h3_shunzi_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">对子</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_duizi_odds" value="{{ $odds['q3z3h3_duizi_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_duizi_rebate" value="{{ $rebate['q3z3h3_duizi_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">半顺</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_banshun_odds" value="{{ $odds['q3z3h3_banshun_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_banshun_rebate" value="{{ $rebate['q3z3h3_banshun_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">杂六</td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_zaliu_odds" value="{{ $odds['q3z3h3_zaliu_odds'] }}" readonly="readonly">
                </div>
            </td>
            <td valign="middle" colspan="1" rowspan="1" align="center">
                <div class="ui input">
                    <input type="text" name="q3z3h3_zaliu_rebate" value="{{ $rebate['q3z3h3_zaliu_rebate'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</form>