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
            <td rowspan="4">混合</td>
            <td >大,小,单,双</td>
            <td>{{ $odds['HH_dxds_odds']['key'] }}</td>
            <td>{{ $rebate['HH_dxds_rebate']['key'] }}%</td>
            <td>{{ $odds['HH_dxds_odds']['minMoney'] }}</td>
            <td>{{ $odds['HH_dxds_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HH_dxds_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>大单,大双，小单，小双</td>
            <td>{{ $odds['HH_dd_ds_xd_xs_odds']['key'] }}</td>
            <td>{{ $rebate['HH_dd_ds_xd_xs_rebate']['key'] }}%</td>
            <td>{{ $odds['HH_dd_ds_xd_xs_odds']['minMoney'] }}</td>
            <td>{{ $odds['HH_dd_ds_xd_xs_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HH_dd_ds_xd_xs_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>极大,极小</td>
            <td>{{ $odds['HH_jd_jx_odds']['key'] }}</td>
            <td>{{ $rebate['HH_jd_jx_rebate']['key'] }}%</td>
            <td>{{ $odds['HH_jd_jx_odds']['minMoney'] }}</td>
            <td>{{ $odds['HH_jd_jx_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HH_jd_jx_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>豹子</td>
            <td>{{ $odds['HH_baozi_odds']['key'] }}</td>
            <td>{{ $rebate['HH_baozi_rebate']['key'] }}%</td>
            <td>{{ $odds['HH_baozi_odds']['minMoney'] }}</td>
            <td>{{ $odds['HH_baozi_odds']['maxMoney'] }}</td>
            <td>{{ $odds['HH_baozi_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td colspan="2">波色</td>
            <td>{{ $odds['BS_odds']['key'] }}</td>
            <td>{{ $rebate['BS_rebate']['key'] }}%</td>
            <td>{{ $odds['BS_odds']['minMoney'] }}</td>
            <td>{{ $odds['BS_odds']['maxMoney'] }}</td>
            <td>{{ $odds['BS_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td rowspan="16">特码</td>
            <td>0</td>
            <td>{{ $odds['TM_0_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>1，26</td>
            <td>{{ $odds['TM_0126_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0126_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0126_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0126_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0126_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr>
            <td>2，25</td>
            <td>{{ $odds['TM_0225_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0225_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0225_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0225_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0225_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611403">
            <td>3</td>
            <td>{{ $odds['TM_3_odds']['key'] }}</td>
            <td>{{ $rebate['TM_3_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_3_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_3_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_3_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611404">
            <td>4，23</td>
            <td>{{ $odds['TM_0423_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0423_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0423_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0423_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0423_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611405">
            <td>5，22</td>
            <td>{{ $odds['TM_0522_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0522_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0522_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0522_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0522_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611406">
            <td>6，21</td>
            <td>{{ $odds['TM_0621_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0621_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0621_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0621_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0621_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611407">
            <td>7，20</td>
            <td>{{ $odds['TM_0720_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0720_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0720_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0720_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0720_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611408">
            <td>8，19</td>
            <td>{{ $odds['TM_0819_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0819_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0819_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0819_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0819_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611409">
            <td>9，18</td>
            <td>{{ $odds['TM_0918_odds']['key'] }}</td>
            <td>{{ $rebate['TM_0918_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_0918_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_0918_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_0918_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611410">
            <td>10，17</td>
            <td>{{ $odds['TM_1017_odds']['key'] }}</td>
            <td>{{ $rebate['TM_1017_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_1017_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_1017_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_1017_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611411">
            <td>11，16</td>
            <td>{{ $odds['TM_1116_odds']['key'] }}</td>
            <td>{{ $rebate['TM_1116_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_1116_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_1116_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_1116_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611412">
            <td>12，15</td>
            <td>{{ $odds['TM_1215_odds']['key'] }}</td>
            <td>{{ $rebate['TM_1215_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_1215_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_1215_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_1215_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611413">
            <td>13，14</td>
            <td>{{ $odds['TM_1314_odds']['key'] }}</td>
            <td>{{ $rebate['TM_1314_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_1314_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_1314_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_1314_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611424">
            <td>24</td>
            <td>{{ $odds['TM_24_odds']['key'] }}</td>
            <td>{{ $rebate['TM_24_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_24_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_24_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_24_odds']['maxTurnMoney'] }}</td>
        </tr>
        <tr play_id="6611427">
            <td>27</td>
            <td>{{ $odds['TM_27_odds']['key'] }}</td>
            <td>{{ $rebate['TM_27_rebate']['key'] }}%</td>
            <td>{{ $odds['TM_27_odds']['minMoney'] }}</td>
            <td>{{ $odds['TM_27_odds']['maxMoney'] }}</td>
            <td>{{ $odds['TM_27_odds']['maxTurnMoney'] }}</td>
        </tr>
        </tbody>
    </table>
</div>
