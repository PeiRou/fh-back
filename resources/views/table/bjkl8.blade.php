<div>
    <table width="100%" class="info-table">
        <thead>
        <tr>
            <th colspan="2">玩法</th>
            <th>赔率</th>
            <th>退水</th>
            <th>单注最低</th>
            <th>单注最高</th>
            <th>单期最高</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="2">正码</td>
            <td>{{ $odds['ZM_odds']['key'] }}</td>
            <td>{{ $rebate['ZM_rebate']['key'] }}%</td>
            <td>{{ $odds['ZM_odds']['minMoney'] }}</td>
            <td>{{ $odds['ZM_odds']['maxMoney'] }}</td>
            <td>{{ $odds['ZM_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">两面</td>
            <td>{{ $odds['2face_odds']['key'] }}</td>
            <td>{{ $rebate['2face_rebate']['key'] }}%</td>
            <td>{{ $odds['2face_odds']['minMoney'] }}</td>
            <td>{{ $odds['2face_odds']['maxMoney'] }}</td>
            <td>{{ $odds['2face_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">总和和局</td>
            <td>{{ $odds['heju_odds']['key'] }}</td>
            <td>{{ $rebate['heju_rebate']['key'] }}%</td>
            <td>{{ $odds['heju_odds']['minMoney'] }}</td>
            <td>{{ $odds['heju_odds']['maxMoney'] }}</td>
            <td>{{ $odds['heju_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">总和过关</td>
            <td>{{ $odds['guoguan_odds']['key'] }}</td>
            <td>{{ $rebate['guoguan_rebate']['key'] }}%</td>
            <td>{{ $odds['guoguan_odds']['minMoney'] }}</td>
            <td>{{ $odds['guoguan_odds']['maxMoney'] }}</td>
            <td>{{ $odds['guoguan_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">前后和</td>
            <td>前（多）后（多）</td>
            <td>{{ $odds['qianhou_odds']['key'] }}</td>
            <td>{{ $rebate['qianhou_rebate']['key'] }}%</td>
            <td>{{ $odds['qianhou_odds']['minMoney'] }}</td>
            <td>{{ $odds['qianhou_odds']['maxMoney'] }}</td>
            <td>{{ $odds['qianhou_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>和</td>
            <td>{{ $odds['qianhouhe_odds']['key'] }}</td>
            <td>{{ $rebate['qianhouhe_rebate']['key'] }}%</td>
            <td>{{ $odds['qianhouhe_odds']['minMoney'] }}</td>
            <td>{{ $odds['qianhouhe_odds']['maxMoney'] }}</td>
            <td>{{ $odds['qianhouhe_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">单双和</td>
            <td>单（多）双（多）</td>
            <td>{{ $odds['danshuang_odds']['key'] }}</td>
            <td>{{ $rebate['danshuang_rebate']['key'] }}%</td>
            <td>{{ $odds['danshuang_odds']['minMoney'] }}</td>
            <td>{{ $odds['danshuang_odds']['maxMoney'] }}</td>
            <td>{{ $odds['danshuang_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>和</td>
            <td>{{ $odds['danshuanghe_odds']['key'] }}</td>
            <td>{{ $rebate['danshuanghe_rebate']['key'] }}%</td>
            <td>{{ $odds['danshuanghe_odds']['minMoney'] }}</td>
            <td>{{ $odds['danshuanghe_odds']['maxMoney'] }}</td>
            <td>{{ $odds['danshuanghe_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="3">五行</td>
            <td>金,土</td>
            <td>{{ $odds['jin_tu_odds']['key'] }}</td>
            <td>{{ $rebate['jin_tu_rebate']['key'] }}%</td>
            <td>{{ $odds['jin_tu_odds']['minMoney'] }}</td>
            <td>{{ $odds['jin_tu_odds']['maxMoney'] }}</td>
            <td>{{ $odds['jin_tu_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>木,火</td>
            <td>{{ $odds['mu_huo_odds']['key'] }}</td>
            <td>{{ $rebate['mu_huo_rebate']['key'] }}%</td>
            <td>{{ $odds['mu_huo_odds']['minMoney'] }}</td>
            <td>{{ $odds['mu_huo_odds']['maxMoney'] }}</td>
            <td>{{ $odds['mu_huo_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>水</td>
            <td>{{ $odds['shui_odds']['key'] }}</td>
            <td>{{ $rebate['shui_rebate']['key'] }}%</td>
            <td>{{ $odds['shui_odds']['minMoney'] }}</td>
            <td>{{ $odds['shui_odds']['maxMoney'] }}</td>
            <td>{{ $odds['shui_odds']['maxTurnMoney'] }}</td>
        </tr>
        </tbody>
    </table>
</div>
