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
            <td rowspan="9">和值</td>
            <td>大小单双</td>
            <td>{{ $odds['HZ_DXDS_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_DXDS_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_DXDS_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_DXDS_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_DXDS_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>3,18</td>
            <td>{{ $odds['HZ_318_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_318_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_318_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_318_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_318_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>4,17</td>
            <td>{{ $odds['HZ_417_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_417_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_417_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_417_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_417_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>5,16</td>
            <td>{{ $odds['HZ_516_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_516_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_516_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_516_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_516_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>6,15</td>
            <td>{{ $odds['HZ_615_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_615_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_615_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_615_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_615_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>7,14</td>
            <td>{{ $odds['HZ_714_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_714_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_714_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_714_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_714_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>8,13</td>
            <td>{{ $odds['HZ_813_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_813_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_813_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_813_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_813_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>9,12</td>
            <td>{{ $odds['HZ_912_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_912_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_912_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_912_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_912_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>10,11</td>
            <td>{{ $odds['HZ_1011_odds']['key'] }}</td>
            <td>{{ $rebate['HZ_1011_rebate']['key'] }}%</td>
            <td>{{ $odds['HZ_1011_odds']['minMoney'] }}</td>
            <td>{{ $odds['HZ_1011_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HZ_1011_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">三连号</td>
            <td>123,234,345,456</td>
            <td>{{ $odds['SLH_odds']['key'] }}</td>
            <td>{{ $rebate['SLH_rebate']['key'] }}%</td>
            <td>{{ $odds['SLH_odds']['minMoney'] }}</td>
            <td>{{ $odds['SLH_odds']['maxMoney'] }}</td>
            <td>{{ $odds['SLH_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>三连通选</td>
            <td>{{ $odds['SLH_SLTX_odds']['key'] }}</td>
            <td>{{ $rebate['SLH_SLTX_rebate']['key'] }}%</td>
            <td>{{ $odds['SLH_SLTX_odds']['minMoney'] }}</td>
            <td>{{ $odds['SLH_SLTX_odds']['maxMoney'] }}</td>
            <td>{{ $odds['SLH_SLTX_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="2">三同号</td>
            <td>111,222,333,444,555,666</td>
            <td>{{ $odds['STH_odds']['key'] }}</td>
            <td>{{ $rebate['STH_rebate']['key'] }}%</td>
            <td>{{ $odds['STH_odds']['minMoney'] }}</td>
            <td>{{ $odds['STH_odds']['maxMoney'] }}</td>
            <td>{{ $odds['STH_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>三同通选</td>
            <td>{{ $odds['STH_STTX_odds']['key'] }}</td>
            <td>{{ $rebate['STH_STTX_rebate']['key'] }}%</td>
            <td>{{ $odds['STH_STTX_odds']['minMoney'] }}</td>
            <td>{{ $odds['STH_STTX_odds']['maxMoney'] }}</td>
            <td>{{ $odds['STH_STTX_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">二同号</td>
            <td>{{ $odds['ETH_odds']['key'] }}</td>
            <td>{{ $rebate['ETH_rebate']['key'] }}%</td>
            <td>{{ $odds['ETH_odds']['minMoney'] }}</td>
            <td>{{ $odds['ETH_odds']['maxMoney'] }}</td>
            <td>{{ $odds['ETH_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="8">跨度</td>
            <td>0</td>
            <td>{{ $odds['KD_0_odds']['key'] }}</td>
            <td>{{ $rebate['KD_0_rebate']['key'] }}%</td>
            <td>{{ $odds['KD_0_odds']['minMoney'] }}</td>
            <td>{{ $odds['KD_0_odds']['maxMoney'] }}</td>
            <td>{{ $odds['KD_0_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>1,5</td>
            <td>{{ $odds['KD_15_odds']['key'] }}</td>
            <td>{{ $rebate['KD_15_rebate']['key'] }}%</td>
            <td>{{ $odds['KD_15_odds']['minMoney'] }}</td>
            <td>{{ $odds['KD_15_odds']['maxMoney'] }}</td>
            <td>{{ $odds['KD_15_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>2,4</td>
            <td>{{ $odds['KD_24_odds']['key'] }}</td>
            <td>{{ $rebate['KD_24_rebate']['key'] }}%</td>
            <td>{{ $odds['KD_24_odds']['minMoney'] }}</td>
            <td>{{ $odds['KD_24_odds']['maxMoney'] }}</td>
            <td>{{ $odds['KD_24_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>{{ $odds['KD_3_odds']['key'] }}</td>
            <td>{{ $rebate['KD_3_rebate']['key'] }}%</td>
            <td>{{ $odds['KD_3_odds']['minMoney'] }}</td>
            <td>{{ $odds['KD_3_odds']['maxMoney'] }}</td>
            <td>{{ $odds['KD_3_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>大</td>
            <td>{{ $odds['KD_DA_odds']['key'] }}</td>
            <td>{{ $rebate['KD_DA_rebate']['key'] }}%</td>
            <td>{{ $odds['KD_DA_odds']['minMoney'] }}</td>
            <td>{{ $odds['KD_DA_odds']['maxMoney'] }}</td>
            <td>{{ $odds['KD_DA_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>小</td>
            <td>{{ $odds['KD_XIAO_odds']['key'] }}</td>
            <td>{{ $rebate['KD_XIAO_rebate']['key'] }}%</td>
            <td>{{ $odds['KD_XIAO_odds']['minMoney'] }}</td>
            <td>{{ $odds['KD_XIAO_odds']['maxMoney'] }}</td>
            <td>{{ $odds['KD_XIAO_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>单</td>
            <td>{{ $odds['KD_DAN_odds']['key'] }}</td>
            <td>{{ $rebate['KD_DAN_rebate']['key'] }}%</td>
            <td>{{ $odds['KD_DAN_odds']['minMoney'] }}</td>
            <td>{{ $odds['KD_DAN_odds']['maxMoney'] }}</td>
            <td>{{ $odds['KD_DAN_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>双</td>
            <td>{{ $odds['KD_SHUANG_odds']['key'] }}</td>
            <td>{{ $rebate['KD_SHUANG_rebate']['key'] }}%</td>
            <td>{{ $odds['KD_SHUANG_odds']['minMoney'] }}</td>
            <td>{{ $odds['KD_SHUANG_odds']['maxMoney'] }}</td>
            <td>{{ $odds['KD_SHUANG_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="7">牌点</td>
            <td>1,10</td>
            <td>{{ $odds['PD_110_odds']['key'] }}</td>
            <td>{{ $rebate['PD_110_rebate']['key'] }}%</td>
            <td>{{ $odds['PD_110_odds']['minMoney'] }}</td>
            <td>{{ $odds['PD_110_odds']['maxMoney'] }}</td>
            <td>{{ $odds['PD_110_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>2.9</td>
            <td>{{ $odds['PD_29_odds']['key'] }}</td>
            <td>{{ $rebate['PD_29_rebate']['key'] }}%</td>
            <td>{{ $odds['PD_29_odds']['minMoney'] }}</td>
            <td>{{ $odds['PD_29_odds']['maxMoney'] }}</td>
            <td>{{ $odds['PD_29_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>{{ $odds['PD_3_odds']['key'] }}</td>
            <td>{{ $rebate['PD_3_rebate']['key'] }}%</td>
            <td>{{ $odds['PD_3_odds']['minMoney'] }}</td>
            <td>{{ $odds['PD_3_odds']['maxMoney'] }}</td>
            <td>{{ $odds['PD_3_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>4,7</td>
            <td>{{ $odds['PD_47_odds']['key'] }}</td>
            <td>{{ $rebate['PD_47_rebate']['key'] }}%</td>
            <td>{{ $odds['PD_47_odds']['minMoney'] }}</td>
            <td>{{ $odds['PD_47_odds']['maxMoney'] }}</td>
            <td>{{ $odds['PD_47_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>5,6</td>
            <td>{{ $odds['PD_56_odds']['key'] }}</td>
            <td>{{ $rebate['PD_56_rebate']['key'] }}%</td>
            <td>{{ $odds['PD_56_odds']['minMoney'] }}</td>
            <td>{{ $odds['PD_56_odds']['maxMoney'] }}</td>
            <td>{{ $odds['PD_56_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>8</td>
            <td>{{ $odds['PD_8_odds']['key'] }}</td>
            <td>{{ $rebate['PD_8_rebate']['key'] }}%</td>
            <td>{{ $odds['PD_8_odds']['minMoney'] }}</td>
            <td>{{ $odds['PD_8_odds']['maxMoney'] }}</td>
            <td>{{ $odds['PD_8_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>大小单双</td>
            <td>{{ $odds['PD_DXDS_odds']['key'] }}</td>
            <td>{{ $rebate['PD_DXDS_rebate']['key'] }}%</td>
            <td>{{ $odds['PD_DXDS_odds']['minMoney'] }}</td>
            <td>{{ $odds['PD_DXDS_odds']['maxMoney'] }}</td>
            <td>{{ $odds['PD_DXDS_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">不出号码</td>
            <td>{{ $odds['BUCHU_odds']['key'] }}</td>
            <td>{{ $rebate['BUCHU_rebate']['key'] }}%</td>
            <td>{{ $odds['BUCHU_odds']['minMoney'] }}</td>
            <td>{{ $odds['BUCHU_odds']['maxMoney'] }}</td>
            <td>{{ $odds['BUCHU_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">必出号码</td>
            <td>{{ $odds['BICHU_odds']['key'] }}</td>
            <td>{{ $rebate['BICHU_rebate']['key'] }}%</td>
            <td>{{ $odds['BICHU_odds']['minMoney'] }}</td>
            <td>{{ $odds['BICHU_odds']['maxMoney'] }}</td>
            <td>{{ $odds['BICHU_odds']['maxTurnMoney'] }}</td>
        </tr>
        </tbody>
    </table>
</div>
