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
            <td colspan="2">1-8球号</td>
            <td>{{ $odds['1_8_odds']['key'] }}</td>
            <td>{{ $rebate['1_8_rebate']['key'] }}%</td>
            <td>{{ $odds['1_8_odds']['minMoney'] }}</td>
            <td>{{ $odds['1_8_odds']['maxMoney'] }}</td>
            <td>{{ $odds['1_8_odds']['maxTurnMoney'] }}</td>
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
            <td colspan="2">1-8方位</td>
            <td>{{ $odds['1_8_FW_odds']['key'] }}</td>
            <td>{{ $rebate['1_8_FW_rebate']['key'] }}%</td>
            <td>{{ $odds['1_8_FW_odds']['minMoney'] }}</td>
            <td>{{ $odds['1_8_FW_odds']['maxMoney'] }}</td>
            <td>{{ $odds['1_8_FW_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">1-8中发白</td>
            <td>中发</td>
            <td>{{ $odds['zhongfa_odds']['key'] }}</td>
            <td>{{ $rebate['zhongfa_rebate']['key'] }}%</td>
            <td>{{ $odds['zhongfa_odds']['minMoney'] }}</td>
            <td>{{ $odds['zhongfa_odds']['maxMoney'] }}</td>
            <td>{{ $odds['zhongfa_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>白</td>
            <td>{{ $odds['bai_odds']['key'] }}</td>
            <td>{{ $rebate['bai_rebate']['key'] }}%</td>
            <td>{{ $odds['bai_odds']['minMoney'] }}</td>
            <td>{{ $odds['bai_odds']['maxMoney'] }}</td>
            <td>{{ $odds['bai_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">正码</td>
            <td>{{ $odds['ZM_odds']['key'] }}</td>
            <td>{{ $rebate['ZM_rebate']['key'] }}%</td>
            <td>{{ $odds['ZM_odds']['minMoney'] }}</td>
            <td>{{ $odds['ZM_odds']['maxMoney'] }}</td>
            <td>{{ $odds['ZM_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">总和单双</td>
            <td>总单</td>
            <td>{{ $odds['zongdan_odds']['key'] }}</td>
            <td>{{ $rebate['zongdan_rebate']['key'] }}%</td>
            <td>{{ $odds['zongdan_odds']['minMoney'] }}</td>
            <td>{{ $odds['zongdan_odds']['maxMoney'] }}</td>
            <td>{{ $odds['zongdan_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>总双</td>
            <td>{{ $odds['zongshuang_odds']['key'] }}</td>
            <td>{{ $rebate['zongshuang_rebate']['key'] }}%</td>
            <td>{{ $odds['zongshuang_odds']['minMoney'] }}</td>
            <td>{{ $odds['zongshuang_odds']['maxMoney'] }}</td>
            <td>{{ $odds['zongshuang_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">总和尾数大小</td>
            <td>总尾大</td>
            <td>{{ $odds['zongweida_odds']['key'] }}</td>
            <td>{{ $rebate['zongweida_rebate']['key'] }}%</td>
            <td>{{ $odds['zongweida_odds']['minMoney'] }}</td>
            <td>{{ $odds['zongweida_odds']['maxMoney'] }}</td>
            <td>{{ $odds['zongweida_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>总尾小</td>
            <td>{{ $odds['zongweixiao_odds']['key'] }}</td>
            <td>{{ $rebate['zongweixiao_rebate']['key'] }}%</td>
            <td>{{ $odds['zongweixiao_odds']['minMoney'] }}</td>
            <td>{{ $odds['zongweixiao_odds']['maxMoney'] }}</td>
            <td>{{ $odds['zongweixiao_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="6">连码</td>
            <td>任选二</td>
            <td>{{ $odds['rx2_odds']['key'] }}</td>
            <td>{{ $rebate['rx2_rebate']['key'] }}%</td>
            <td>{{ $odds['rx2_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx2_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx2_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>选二连组</td>
            <td>{{ $odds['x2lz_odds']['key'] }}</td>
            <td>{{ $rebate['x2lz_rebate']['key'] }}%</td>
            <td>{{ $odds['x2lz_odds']['minMoney'] }}</td>
            <td>{{ $odds['x2lz_odds']['maxMoney'] }}</td>
            <td>{{ $odds['x2lz_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选三</td>
            <td>{{ $odds['rx3_odds']['key'] }}</td>
            <td>{{ $rebate['rx3_rebate']['key'] }}%</td>
            <td>{{ $odds['rx3_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx3_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx3_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>选三前组</td>
            <td>{{ $odds['x3qz_odds']['key'] }}</td>
            <td>{{ $rebate['x3qz_rebate']['key'] }}%</td>
            <td>{{ $odds['x3qz_odds']['minMoney'] }}</td>
            <td>{{ $odds['x3qz_odds']['maxMoney'] }}</td>
            <td>{{ $odds['x3qz_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选四</td>
            <td>{{ $odds['rx4_odds']['key'] }}</td>
            <td>{{ $rebate['rx4_rebate']['key'] }}%</td>
            <td>{{ $odds['rx4_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx4_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx4_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>任选五</td>
            <td>{{ $odds['rx5_odds']['key'] }}</td>
            <td>{{ $rebate['rx5_rebate']['key'] }}%</td>
            <td>{{ $odds['rx5_odds']['minMoney'] }}</td>
            <td>{{ $odds['rx5_odds']['maxMoney'] }}</td>
            <td>{{ $odds['rx5_odds']['maxTurnMoney'] }}</td>
        </tr>
        </tbody>
    </table>
</div>
