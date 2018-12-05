<!-- 北京快乐8 -->
<form id="game65Form">
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
                <input type="text" name="ZM_odds" value="{{ $odds['ZM_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="ZM_rebate" value="{{ $rebate['ZM_rebate'] }}" readonly="readonly">
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
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">总和和局</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="heju_odds" value="{{ $odds['heju_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="heju_rebate" value="{{ $rebate['heju_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="deep-blue-td">总和过关</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td"></td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="guoguan_odds" value="{{ $odds['guoguan_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="guoguan_rebate" value="{{ $rebate['guoguan_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">前后和</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">前（多）后（多）</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="qianhou_odds" value="{{ $odds['qianhou_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="qianhou_rebate" value="{{ $rebate['qianhou_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="qianhouhe_odds" value="{{ $odds['qianhouhe_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="qianhouhe_rebate" value="{{ $rebate['qianhouhe_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="2" align="center" class="deep-blue-td">单双和</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">单（多）双（多）</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="danshuang_odds" value="{{ $odds['danshuang_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="danshuang_rebate" value="{{ $rebate['danshuang_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">和</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="danshuanghe_odds" value="{{ $odds['danshuanghe_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="danshuanghe_rebate" value="{{ $rebate['danshuanghe_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="3" align="center" class="deep-blue-td">五行</td>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">金，土</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="jin_tu_odds" value="{{ $odds['jin_tu_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="jin_tu_rebate" value="{{ $rebate['jin_tu_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">木，火</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="mu_huo_odds" value="{{ $odds['mu_huo_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="mu_huo_rebate" value="{{ $rebate['mu_huo_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    <tr>
        <td valign="middle" colspan="1" rowspan="1" align="center" class="blue-td">水</td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="shui_odds" value="{{ $odds['shui_odds'] }}" readonly="readonly">
            </div>
        </td>
        <td valign="middle" colspan="1" rowspan="1" align="center">
            <div class="ui input">
                <input type="text" name="shui_rebate" value="{{ $rebate['shui_rebate'] }}" readonly="readonly">
            </div>
        </td>
    </tr>
    </tbody>
</table>
</form>