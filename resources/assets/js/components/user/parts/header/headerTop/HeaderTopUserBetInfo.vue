<template>
    <div class="iframe-body" style="display: block;">
    <div class="member-info">
        <ul class="tab" style="margin-top: 20px">
            <li id="tm_tabs" class="tab_title02">
                <a id="GAME_80_TAB" type="80" href="javascript:;" :class="{on:ShowEle === 1}" @click="Show(1)">秒速赛车</a>
                <a id="GAME_50_TAB" type="50" href="javascript:;" :class="{on:ShowEle === 2}" @click="Show(2)">北京PK10</a>
                <a id="GAME_82_TAB" type="82" href="javascript:;" :class="{on:ShowEle === 3}" @click="Show(3)">秒速飞艇</a>
                <a id="GAME_81_TAB" type="81" href="javascript:;" :class="{on:ShowEle === 4}" @click="Show(4)">秒速时时彩</a>
                <a id="GAME_1_TAB" type="1" href="javascript:;" :class="{on:ShowEle === 5}" @click="Show(5)">重庆时时彩</a>
                <a id="GAME_70_TAB" type="70" href="javascript:;" :class="{on:ShowEle === 6}" @click="Show(6)">香港六合彩</a>
                <a id="GAME_84_TAB" type="84" href="javascript:;" :class="{on:ShowEle === 7}" @click="Show(7)">幸运蛋蛋</a>
                <a id="GAME_61_TAB" type="61" href="javascript:;" :class="{on:ShowEle === 8}" @click="Show(8)">重庆幸运农场</a>
                <a id="GAME_85_TAB" type="85" href="javascript:;" :class="{on:ShowEle === 9}" @click="Show(9)">幸运六合彩</a>
                <a id="GAME_83_TAB" type="83" href="javascript:;" :class="{on:ShowEle === 10}" @click="Show(10)">幸运快乐8</a>
                <a id="GAME_66_TAB" type="66" href="javascript:;" :class="{on:ShowEle === 11}" @click="Show(11)">PC蛋蛋</a>
                <a id="GAME_21_TAB" type="21" href="javascript:;" :class="{on:ShowEle === 12}" @click="Show(12)">广东11选5</a>
                <a id="GAME_10_TAB" type="10" href="javascript:;" :class="{on:ShowEle === 13}" @click="Show(13)">江苏骰宝(快3)</a>
                <a id="GAME_30_TAB" type="30" href="javascript:;" :class="{on:ShowEle === 14}" @click="Show(14)">福彩3D</a>
                <a id="GAME_65_TAB" type="65" href="javascript:;" :class="{on:ShowEle === 15}" @click="Show(15)">北京快乐8</a>
                <a id="GAME_60_TAB" type="60" href="javascript:;" :class="{on:ShowEle === 16}" @click="Show(16)">广东快乐十分</a>
                <a id="GAME_4_TAB" type="4" href="javascript:;" :class="{on:ShowEle === 17}" @click="Show(17)">新疆时时彩</a></li>
        </ul>
        <div id="user_bet_info_configs">
            <div id="GAME_80_PAGE" v-if="ShowEle===1">
                <table class="u-table2">
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
                    <tr play_id="8014107">
                        <td colspan="2">1-10车号</td>
                        <td type="odds">9.95</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">1</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014101">
                        <td colspan="2">两面</td>
                        <td type="odds">1.995</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">1</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014001">
                        <td rowspan="2">冠亚军和大小</td>
                        <td>大</td>
                        <td type="odds">2.19</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">1</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014002">
                        <td>小</td>
                        <td type="odds">1.78</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">1</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014003">
                        <td rowspan="2">冠亚军和单双</td>
                        <td>单</td>
                        <td type="odds">1.78</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">1</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014004">
                        <td>双</td>
                        <td type="odds">2.19</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">1</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014005">
                        <td rowspan="5">冠亚军和</td>
                        <td>3,4,18,19</td>
                        <td type="odds">42.5</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">5</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014007">
                        <td>5,6,16,17</td>
                        <td type="odds">21.5</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">5</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014009">
                        <td>7,8,14,15</td>
                        <td type="odds">14.5</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">5</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014011">
                        <td>9,10,12,13</td>
                        <td type="odds">10.5</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">5</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    <tr play_id="8014013">
                        <td>11</td>
                        <td type="odds">8.5</td>
                        <td type="rebate">0%</td>
                        <td type="minMoney">5</td>
                        <td type="maxMoney">500000</td>
                        <td type="maxTurnMoney">500000</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="GAME_50_PAGE" v-if="ShowEle===2">
                  <table class="u-table2">
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
                        <tr play_id="501107">
                            <td colspan="2">1-10车号</td>
                            <td type="odds">9.95</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501101">
                            <td colspan="2">两面</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501001">
                            <td rowspan="2">冠亚军和大小</td>
                            <td>大</td>
                            <td type="odds">2.19</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501002">
                            <td>小</td>
                            <td type="odds">1.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501003">
                            <td rowspan="2">冠亚军和单双</td>
                            <td>单</td>
                            <td type="odds">1.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501004">
                            <td>双</td>
                            <td type="odds">2.19</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501005">
                            <td rowspan="5">冠亚军和</td>
                            <td>3,4,18,19</td>
                            <td type="odds">42.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501007">
                            <td>5,6,16,17</td>
                            <td type="odds">21.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501009">
                            <td>7,8,14,15</td>
                            <td type="odds">14.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501011">
                            <td>9,10,12,13</td>
                            <td type="odds">10.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="501013">
                            <td>11</td>
                            <td type="odds">8.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="GAME_82_PAGE" v-if="ShowEle===3">
                 <table class="u-table2">
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
                        <tr play_id="8216107">
                            <td colspan="2">1-10车号</td>
                            <td type="odds">9.95</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8216101">
                            <td colspan="2">两面</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8216001">
                            <td rowspan="2">冠亚军和大小</td>
                            <td>大</td>
                            <td type="odds">2.19</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8216002">
                            <td>小</td>
                            <td type="odds">1.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8216003">
                            <td rowspan="2">冠亚军和单双</td>
                            <td>单</td>
                            <td type="odds">1.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8216004">
                            <td>双</td>
                            <td type="odds">2.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8216005">
                            <td rowspan="5">冠亚军和</td>
                            <td>3,4,18,19</td>
                            <td type="odds">42.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="8216007">
                            <td>5,6,16,17</td>
                            <td type="odds">21.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="8216009">
                            <td>7,8,14,15</td>
                            <td type="odds">14.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="8216011">
                            <td>9,10,12,13</td>
                            <td type="odds">10.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="8216013">
                            <td>11</td>
                            <td type="odds">8.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div id="GAME_81_PAGE" v-if="ShowEle===4">
                <table class="u-table2">
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
                        <tr play_id="8115200">
                            <td colspan="2">1-5球号</td>
                            <td type="odds">9.95</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8115101">
                            <td colspan="2">两面</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8115105">
                            <td rowspan="2">龙虎和</td>
                            <td>龙,虎</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8115107">
                            <td>和</td>
                            <td type="odds">9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8115701">
                            <td rowspan="5">前三中三后三</td>
                            <td>豹子</td>
                            <td type="odds">75</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8115702">
                            <td>顺子</td>
                            <td type="odds">14.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8115703">
                            <td>对子</td>
                            <td type="odds">3.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8115704">
                            <td>半顺</td>
                            <td type="odds">2.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="8115705">
                            <td>杂六</td>
                            <td type="odds">3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div id="GAME_1_PAGE" v-if="ShowEle===5">
               <table class="u-table2">
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
                        <tr play_id="1200">
                            <td colspan="2">1-5球号</td>
                            <td type="odds">9.95</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="1101">
                            <td colspan="2">两面</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="1105">
                            <td rowspan="2">龙虎和</td>
                            <td>龙,虎</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="1107">
                            <td>和</td>
                            <td type="odds">9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="1701">
                            <td rowspan="5">前三中三后三</td>
                            <td>豹子</td>
                            <td type="odds">75</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="1702">
                            <td>顺子</td>
                            <td type="odds">14.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="1703">
                            <td>对子</td>
                            <td type="odds">3.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="1704">
                            <td>半顺</td>
                            <td type="odds">2.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                        <tr play_id="1705">
                            <td>杂六</td>
                            <td type="odds">3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">500000</td>
                        </tr>
                    </tbody>
                </table>
            </div>    
            <div id="GAME_4_PAGE" v-if="ShowEle===17">
                <table class="u-table2">
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
                        <tr play_id="411600">
                            <td colspan="2">1-5球号</td>
                            <td type="odds">9.95</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">1000000</td>
                        </tr>
                        <tr play_id="411501">
                            <td colspan="2">两面</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">1000000</td>
                        </tr>
                        <tr play_id="411505">
                            <td rowspan="2">龙虎和</td>
                            <td>龙,虎</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">1000000</td>
                        </tr>
                        <tr play_id="411507">
                            <td>和</td>
                            <td type="odds">9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">1000000</td>
                        </tr>
                        <tr play_id="412101">
                            <td rowspan="5">前三中三后三</td>
                            <td>豹子</td>
                            <td type="odds">75</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="412102">
                            <td>顺子</td>
                            <td type="odds">14.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="412103">
                            <td>对子</td>
                            <td type="odds">3.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">1000000</td>
                        </tr>
                        <tr play_id="412104">
                            <td>半顺</td>
                            <td type="odds">2.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">1000000</td>
                        </tr>
                        <tr play_id="412105">
                            <td>杂六</td>
                            <td type="odds">3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">500000</td>
                            <td type="maxTurnMoney">1000000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
           <div id="GAME_84_PAGE" v-if="ShowEle===7">
                <table class="u-table2">
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
                        <tr play_id="8420201">
                            <td rowspan="4" style="width: 100px">混合</td>
                            <td style="width: 100px">大,小,单,双</td>
                            <td type="odds">1.981</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8420205">
                            <td>大单,大双，小单，小双</td>
                            <td type="odds">1.981</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8420209">
                            <td>极大,极小</td>
                            <td type="odds">10</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8420211">
                            <td>豹子</td>
                            <td type="odds">90</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">5000</td>
                            <td type="maxTurnMoney">5000</td>
                        </tr>
                        <tr play_id="8420301">
                            <td colspan="2">波色</td>
                            <td type="odds">2.96</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8420400">
                            <td rowspan="16" style="width: 100px">特码</td>
                            <td style="width: 100px">0</td>
                            <td type="odds">941</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100</td>
                            <td type="maxTurnMoney">100</td>
                        </tr>
                        <tr play_id="8420401">
                            <td>1，26</td>
                            <td type="odds">313</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">300</td>
                            <td type="maxTurnMoney">300</td>
                        </tr>
                        <tr play_id="8420402">
                            <td>2，25</td>
                            <td type="odds">156</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="8420403">
                            <td>3</td>
                            <td type="odds">64</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">3000</td>
                            <td type="maxTurnMoney">3000</td>
                        </tr>
                        <tr play_id="8420404">
                            <td>4，23</td>
                            <td type="odds">62</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">3000</td>
                            <td type="maxTurnMoney">3000</td>
                        </tr>
                        <tr play_id="8420405">
                            <td>5，22</td>
                            <td type="odds">44</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">5000</td>
                            <td type="maxTurnMoney">5000</td>
                        </tr>
                        <tr play_id="8420406">
                            <td>6，21</td>
                            <td type="odds">33</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">15000</td>
                            <td type="maxTurnMoney">15000</td>
                        </tr>
                        <tr play_id="8420407">
                            <td>7，20</td>
                            <td type="odds">26</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">15000</td>
                            <td type="maxTurnMoney">15000</td>
                        </tr>
                        <tr play_id="8420408">
                            <td>8，19</td>
                            <td type="odds">20.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="8420409">
                            <td>9，18</td>
                            <td type="odds">17.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="8420410">
                            <td>10，17</td>
                            <td type="odds">14.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="8420411">
                            <td>11，16</td>
                            <td type="odds">13.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="8420412">
                            <td>12，15</td>
                            <td type="odds">12.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="8420413">
                            <td>13，14</td>
                            <td type="odds">12.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="8420424">
                            <td>24</td>
                            <td type="odds">94</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">300</td>
                            <td type="maxTurnMoney">300</td>
                        </tr>
                        <tr play_id="8420427">
                            <td>27</td>
                            <td type="odds">941</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100</td>
                            <td type="maxTurnMoney">100</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="GAME_70_PAGE" v-if="ShowEle===6">
                 <table class="u-table2">
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
                        <tr play_id="708501">
                            <td rowspan="2">特码</td>
                            <td>特码A</td>
                            <td type="odds">42.2</td>
                            <td type="rebate">13%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708550">
                            <td>特码B</td>
                            <td type="odds">48.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708601">
                            <td colspan="2">两面</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="7092050">
                            <td colspan="2">正码两面</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708701">
                            <td rowspan="2">特码色波</td>
                            <td>红波</td>
                            <td type="odds">2.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708702">
                            <td>蓝波,绿波</td>
                            <td type="odds">2.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708706">
                            <td rowspan="4">特码半波大小</td>
                            <td>红大,蓝小,绿小</td>
                            <td type="odds">6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708707">
                            <td>红小</td>
                            <td type="odds">4.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708710">
                            <td>蓝大</td>
                            <td type="odds">4.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708714">
                            <td>绿大</td>
                            <td type="odds">4.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708704">
                            <td rowspan="3">特码半波单双</td>
                            <td>红单,蓝单,蓝双,绿单</td>
                            <td type="odds">5.4</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708705">
                            <td>红双</td>
                            <td type="odds">4.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708713">
                            <td>绿双</td>
                            <td type="odds">6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708716">
                            <td rowspan="3">特码半半波</td>
                            <td>红大单,蓝小单,绿小双</td>
                            <td type="odds">13.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708718">
                            <td>红小单,红小双,蓝大单</td>
                            <td type="odds">8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708717">
                            <td>红大双,蓝小双,蓝大双,绿大单,绿小单,绿大双</td>
                            <td type="odds">10.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708801">
                            <td rowspan="12">特码十二生肖</td>
                            <td>鼠</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708802">
                            <td>牛</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708803">
                            <td>虎</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708804">
                            <td>免</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708805">
                            <td>龙</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708806">
                            <td>蛇</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708807">
                            <td>马</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708808">
                            <td>羊</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708809">
                            <td>猴</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708810">
                            <td>鸡</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708811">
                            <td>狗</td>
                            <td type="odds">9.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708812">
                            <td>猪</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708902">
                            <td rowspan="10">特码合肖</td>
                            <td>2肖</td>
                            <td type="odds">5.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708903">
                            <td>3肖</td>
                            <td type="odds">3.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708904">
                            <td>4肖</td>
                            <td type="odds">2.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708905">
                            <td>5肖</td>
                            <td type="odds">2.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708906">
                            <td>6肖</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708907">
                            <td>7肖</td>
                            <td type="odds">1.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708908">
                            <td>8肖</td>
                            <td type="odds">1.4</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708909">
                            <td>9肖</td>
                            <td type="odds">1.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708910">
                            <td>10肖</td>
                            <td type="odds">1.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="708911">
                            <td>11肖</td>
                            <td type="odds">1.05</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709001">
                            <td rowspan="2">特码头数</td>
                            <td>0头</td>
                            <td type="odds">5.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709002">
                            <td>其它</td>
                            <td type="odds">4.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709015">
                            <td rowspan="2">特码尾数</td>
                            <td>0尾</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709006">
                            <td>其它</td>
                            <td type="odds">9.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709301">
                            <td rowspan="5">特码五行</td>
                            <td>金</td>
                            <td type="odds">4.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709302">
                            <td>木</td>
                            <td type="odds">4.35</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709303">
                            <td>水</td>
                            <td type="odds">4.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709304">
                            <td>火</td>
                            <td type="odds">4.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709305">
                            <td>土</td>
                            <td type="odds">5.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709101">
                            <td colspan="2">正码</td>
                            <td type="odds">7.21</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="7092001">
                            <td colspan="2">正码特</td>
                            <td type="odds">42</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="7092058">
                            <td rowspan="2">正码1-6色波</td>
                            <td>红波</td>
                            <td type="odds">2.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="7092059">
                            <td>蓝波,绿波</td>
                            <td type="odds">2.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709401">
                            <td rowspan="12">一肖</td>
                            <td>鼠</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709402">
                            <td>牛</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709403">
                            <td>虎</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709404">
                            <td>免</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709405">
                            <td>龙</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709406">
                            <td>蛇</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709407">
                            <td>马</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709408">
                            <td>羊</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709409">
                            <td>猴</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709410">
                            <td>鸡</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709411">
                            <td>狗</td>
                            <td type="odds">1.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709412">
                            <td>猪</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709413">
                            <td rowspan="2">尾数</td>
                            <td>0尾</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709414">
                            <td>其它</td>
                            <td type="odds">1.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709601">
                            <td rowspan="3">7色波</td>
                            <td>红波</td>
                            <td type="odds">2.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709602">
                            <td>蓝波,绿波</td>
                            <td type="odds">2.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709604">
                            <td>和局</td>
                            <td type="odds">23</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709701">
                            <td rowspan="8">总肖</td>
                            <td>2肖</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709702">
                            <td>3肖</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709703">
                            <td>4肖</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709704">
                            <td>5肖</td>
                            <td type="odds">3.06</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709705">
                            <td>6肖</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709706">
                            <td>7肖</td>
                            <td type="odds">5.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709707">
                            <td>单</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709708">
                            <td>双</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="7010001">
                            <td rowspan="2">三中二</td>
                            <td>中二</td>
                            <td type="odds">20</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="7010002">
                            <td>中三</td>
                            <td type="odds">100</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="7010003">
                            <td colspan="2">三全中</td>
                            <td type="odds">670</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="7010008">
                            <td colspan="2">四全中</td>
                            <td type="odds">9500</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="7010004">
                            <td colspan="2">二全中</td>
                            <td type="odds">60</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="7010005">
                            <td rowspan="2">二中特</td>
                            <td>中特</td>
                            <td type="odds">25.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="7010006">
                            <td>中二</td>
                            <td type="odds">50</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="7010007">
                            <td colspan="2">特串</td>
                            <td type="odds">150</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="709501">
                            <td rowspan="12">正肖</td>
                            <td>鼠</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709502">
                            <td>牛</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709503">
                            <td>虎</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709504">
                            <td>免</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709505">
                            <td>龙</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709506">
                            <td>蛇</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709507">
                            <td>马</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709508">
                            <td>羊</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709509">
                            <td>猴</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709510">
                            <td>鸡</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709511">
                            <td>狗</td>
                            <td type="odds">1.76</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709512">
                            <td>猪</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709901">
                            <td rowspan="12">二连肖</td>
                            <td>鼠</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709902">
                            <td>牛</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709903">
                            <td>虎</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709904">
                            <td>免</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709905">
                            <td>龙</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709906">
                            <td>蛇</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709907">
                            <td>马</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709908">
                            <td>羊</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709909">
                            <td>猴</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709910">
                            <td>鸡</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709911">
                            <td>狗</td>
                            <td type="odds">3.32</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709912">
                            <td>猪</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709913">
                            <td rowspan="12">三连肖</td>
                            <td>鼠</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709914">
                            <td>牛</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709915">
                            <td>虎</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709916">
                            <td>免</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709917">
                            <td>龙</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709918">
                            <td>蛇</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709919">
                            <td>马</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709920">
                            <td>羊</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709921">
                            <td>猴</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709922">
                            <td>鸡</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709923">
                            <td>狗</td>
                            <td type="odds">9.02</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709924">
                            <td>猪</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709925">
                            <td rowspan="12">四连肖</td>
                            <td>鼠</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709926">
                            <td>牛</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709927">
                            <td>虎</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709928">
                            <td>免</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709929">
                            <td>龙</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709930">
                            <td>蛇</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709931">
                            <td>马</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709932">
                            <td>羊</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709933">
                            <td>猴</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709934">
                            <td>鸡</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709935">
                            <td>狗</td>
                            <td type="odds">25.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709936">
                            <td>猪</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709937">
                            <td rowspan="12">五连肖</td>
                            <td>鼠</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709938">
                            <td>牛</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709939">
                            <td>虎</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709940">
                            <td>免</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709941">
                            <td>龙</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709942">
                            <td>蛇</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709943">
                            <td>马</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709944">
                            <td>羊</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709945">
                            <td>猴</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709946">
                            <td>鸡</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709947">
                            <td>狗</td>
                            <td type="odds">87</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709948">
                            <td>猪</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709949">
                            <td rowspan="2">二连尾</td>
                            <td>0尾</td>
                            <td type="odds">3.18</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709950">
                            <td>其它</td>
                            <td type="odds">3.18</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709959">
                            <td rowspan="2">三连尾</td>
                             <td>0尾</td>
                            <td type="odds">7.08</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709960">
                            <td>其它</td>
                            <td type="odds">7.08</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709969">
                            <td rowspan="2">四连尾</td>
                            <td>0尾</td>
                            <td type="odds">15.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709970">
                            <td>其它</td>
                            <td type="odds">15.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709979">
                            <td rowspan="2">五连尾</td>
                            <td>0尾</td>
                            <td type="odds">45</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709980">
                            <td>其它</td>
                            <td type="odds">40</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709805">
                            <td rowspan="8">自选不中</td>
                            <td>5不中</td>
                            <td type="odds">2.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709806">
                            <td>6不中</td>
                            <td type="odds">2.63</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709807">
                            <td>7不中</td>
                            <td type="odds">3.18</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709808">
                            <td>8不中</td>
                            <td type="odds">3.72</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709809">
                            <td>9不中</td>
                            <td type="odds">4.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709810">
                            <td>10不中</td>
                            <td type="odds">5.58</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709811">
                            <td>11不中</td>
                            <td type="odds">6.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="709812">
                            <td>12不中</td>
                            <td type="odds">8.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="GAME_85_PAGE" v-if="ShowEle===9">
                <table class="u-table2">
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
                        <tr play_id="8520501">
                            <td rowspan="2">特码</td>
                            <td>特码A</td>
                            <td type="odds">42.2</td>
                            <td type="rebate">13%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520550">
                            <td>特码B</td>
                            <td type="odds">48.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520601">
                            <td colspan="2">两面</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="85212050">
                            <td colspan="2">正码两面</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520701">
                            <td rowspan="2">特码色波</td>
                            <td>红波</td>
                            <td type="odds">2.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520702">
                            <td>蓝波,绿波</td>
                            <td type="odds">2.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520706">
                            <td rowspan="4">特码半波大小</td>
                            <td>红大,蓝小,绿小</td>
                            <td type="odds">6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520707">
                            <td>红小</td>
                            <td type="odds">4.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520710">
                            <td>蓝大</td>
                            <td type="odds">4.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520714">
                            <td>绿大</td>
                            <td type="odds">4.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520704">
                            <td rowspan="3">特码半波单双</td>
                            <td>红单,蓝单,蓝双,绿单</td>
                            <td type="odds">5.4</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520705">
                            <td>红双</td>
                            <td type="odds">4.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520713">
                            <td>绿双</td>
                            <td type="odds">6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520716">
                            <td rowspan="3">特码半半波</td>
                            <td>红大单,蓝小单,绿小双</td>
                            <td type="odds">13.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520718">
                            <td>红小单,红小双,蓝大单</td>
                            <td type="odds">8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520717">
                            <td>红大双,蓝小双,蓝大双,绿大单,绿小单,绿大双</td>
                            <td type="odds">10.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520801">
                            <td rowspan="12">特码十二生肖</td>
                            <td>鼠</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520802">
                            <td>牛</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520803">
                            <td>虎</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520804">
                            <td>免</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520805">
                            <td>龙</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520806">
                            <td>蛇</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520807">
                            <td>马</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520808">
                            <td>羊</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520809">
                            <td>猴</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520810">
                            <td>鸡</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520811">
                            <td>狗</td>
                            <td type="odds">9.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520812">
                            <td>猪</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520902">
                            <td rowspan="10">特码合肖</td>
                            <td>2肖</td>
                            <td type="odds">5.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520903">
                            <td>3肖</td>
                            <td type="odds">3.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520904">
                            <td>4肖</td>
                            <td type="odds">2.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520905">
                            <td>5肖</td>
                            <td type="odds">2.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520906">
                            <td>6肖</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520907">
                            <td>7肖</td>
                            <td type="odds">1.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520908">
                            <td>8肖</td>
                            <td type="odds">1.4</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520909">
                            <td>9肖</td>
                            <td type="odds">1.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520910">
                            <td>10肖</td>
                            <td type="odds">1.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8520911">
                            <td>11肖</td>
                            <td type="odds">1.05</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521001">
                            <td rowspan="2">特码头数</td>
                            <td>0头</td>
                            <td type="odds">5.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521002">
                            <td>其它</td>
                            <td type="odds">4.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521015">
                            <td rowspan="2">特码尾数</td>
                            <td>0尾</td>
                            <td type="odds">11.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521006">
                            <td>其它</td>
                            <td type="odds">9.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521301">
                            <td rowspan="5">特码五行</td>
                            <td>金</td>
                            <td type="odds">4.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521302">
                            <td>木</td>
                            <td type="odds">4.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521303">
                            <td>水</td>
                            <td type="odds">4.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521304">
                            <td>火</td>
                            <td type="odds">4.78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521305">
                            <td>土</td>
                            <td type="odds">5.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521101">
                            <td colspan="2">正码</td>
                            <td type="odds">7.21</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="85212001">
                            <td colspan="2">正码特</td>
                            <td type="odds">42</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="85212058">
                            <td rowspan="2">正码1-6色波</td>
                            <td>红波</td>
                            <td type="odds">2.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="85212059">
                            <td>蓝波,绿波</td>
                            <td type="odds">2.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521401">
                            <td rowspan="12">一肖</td>
                            <td>鼠</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521402">
                            <td>牛</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521403">
                            <td>虎</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521404">
                            <td>免</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521405">
                            <td>龙</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521406">
                            <td>蛇</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521407">
                            <td>马</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521408">
                            <td>羊</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521409">
                            <td>猴</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521410">
                            <td>鸡</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521411">
                            <td>狗</td>
                            <td type="odds">1.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521412">
                            <td>猪</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521413">
                            <td rowspan="2">尾数</td>
                            <td>0尾</td>
                            <td type="odds">2.09</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521414">
                            <td>其它</td>
                            <td type="odds">1.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521601">
                            <td rowspan="3">7色波</td>
                            <td>红波</td>
                            <td type="odds">2.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521602">
                            <td>蓝波,绿波</td>
                            <td type="odds">2.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521604">
                            <td>和局</td>
                            <td type="odds">23</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521701">
                            <td rowspan="8">总肖</td>
                            <td>2肖</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521702">
                            <td>3肖</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521703">
                            <td>4肖</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521704">
                            <td>5肖</td>
                            <td type="odds">3.06</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521705">
                            <td>6肖</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521706">
                            <td>7肖</td>
                            <td type="odds">5.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521707">
                            <td>单</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521708">
                            <td>双</td>
                            <td type="odds">1.97</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8522001">
                            <td rowspan="2">三中二</td>
                            <td>中二</td>
                            <td type="odds">20</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="8522002">
                            <td>中三</td>
                            <td type="odds">100</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="8522003">
                            <td colspan="2">三全中</td>
                            <td type="odds">670</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="8522008">
                            <td colspan="2">四全中</td>
                            <td type="odds">9500</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">2</td>
                            <td type="maxTurnMoney">2</td>
                        </tr>
                        <tr play_id="8522004">
                            <td colspan="2">二全中</td>
                            <td type="odds">60</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="8522005">
                            <td rowspan="2">二中特</td>
                            <td>中特</td>
                            <td type="odds">25.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="8522006">
                            <td>中二</td>
                            <td type="odds">50</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="8522007">
                            <td colspan="2">特串</td>
                            <td type="odds">150</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">1000</td>
                            <td type="maxTurnMoney">1000</td>
                        </tr>
                        <tr play_id="8521501">
                            <td rowspan="12">正肖</td>
                            <td>鼠</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521502">
                            <td>牛</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521503">
                            <td>虎</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521504">
                            <td>免</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521505">
                            <td>龙</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521506">
                            <td>蛇</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521507">
                            <td>马</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521508">
                            <td>羊</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521509">
                            <td>猴</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521510">
                            <td>鸡</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521511">
                            <td>狗</td>
                            <td type="odds">1.76</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521512">
                            <td>猪</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521901">
                            <td rowspan="12">二连肖</td>
                            <td>鼠</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521902">
                            <td>牛</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521903">
                            <td>虎</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521904">
                            <td>免</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521905">
                            <td>龙</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521906">
                            <td>蛇</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521907">
                            <td>马</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521908">
                            <td>羊</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521909">
                            <td>猴</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521910">
                            <td>鸡</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521911">
                            <td>狗</td>
                            <td type="odds">3.32</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521912">
                            <td>猪</td>
                            <td type="odds">4.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521913">
                            <td rowspan="12">三连肖</td>
                            <td>鼠</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521914">
                            <td>牛</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521915">
                            <td>虎</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521916">
                            <td>免</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521917">
                            <td>龙</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521918">
                            <td>蛇</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521919">
                            <td>马</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521920">
                            <td>羊</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521921">
                            <td>猴</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521922">
                            <td>鸡</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521923">
                            <td>狗</td>
                            <td type="odds">9.02</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521924">
                            <td>猪</td>
                            <td type="odds">11.12</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521925">
                            <td rowspan="12">四连肖</td>
                            <td>鼠</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521926">
                            <td>牛</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521927">
                            <td>虎</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521928">
                            <td>免</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521929">
                            <td>龙</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521930">
                            <td>蛇</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521931">
                            <td>马</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521932">
                            <td>羊</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521933">
                            <td>猴</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521934">
                            <td>鸡</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521935">
                            <td>狗</td>
                            <td type="odds">25.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521936">
                            <td>猪</td>
                            <td type="odds">31.2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521937">
                            <td rowspan="12">五连肖</td>
                            <td>鼠</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521938">
                            <td>牛</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521939">
                            <td>虎</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521940">
                            <td>免</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521941">
                            <td>龙</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521942">
                            <td>蛇</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521943">
                            <td>马</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521944">
                            <td>羊</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521945">
                            <td>猴</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521946">
                            <td>鸡</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521947">
                            <td>狗</td>
                            <td type="odds">87</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521948">
                            <td>猪</td>
                            <td type="odds">98</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521949">
                            <td rowspan="2">二连尾</td>
                            <td>0尾</td>
                            <td type="odds">3.18</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521950">
                            <td>其它</td>
                            <td type="odds">3.18</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521959">
                            <td rowspan="2">三连尾</td>
                             <td>0尾</td>
                            <td type="odds">7.08</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521960">
                            <td>其它</td>
                            <td type="odds">7.08</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521969">
                            <td rowspan="2">四连尾</td>
                            <td>0尾</td>
                            <td type="odds">15.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521970">
                            <td>其它</td>
                            <td type="odds">15.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521979">
                            <td rowspan="2">五连尾</td>
                            <td>0尾</td>
                            <td type="odds">45</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521980">
                            <td>其它</td>
                            <td type="odds">40</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521805">
                            <td rowspan="8">自选不中</td>
                            <td>5不中</td>
                            <td type="odds">2.17</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521806">
                            <td>6不中</td>
                            <td type="odds">2.63</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521807">
                            <td>7不中</td>
                            <td type="odds">3.18</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521808">
                            <td>8不中</td>
                            <td type="odds">3.72</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521809">
                            <td>9不中</td>
                            <td type="odds">4.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521810">
                            <td>10不中</td>
                            <td type="odds">5.58</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521811">
                            <td>11不中</td>
                            <td type="odds">6.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8521812">
                            <td>12不中</td>
                            <td type="odds">8.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
           
            <div id="GAME_61_PAGE" v-if="ShowEle===8">
                <table class="u-table2">
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
                        <tr play_id="616401">
                            <td colspan="2">1-8球号</td>
                            <td type="odds">19.86</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="616301">
                            <td>两面</td>
                            <td>0~9</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="616429">
                            <td colspan="2">1-8方位</td>
                            <td type="odds">3.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="616433">
                            <td>1-8中发白</td>
                            <td>中发</td>
                            <td type="odds">2.82</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="616435">
                            <td>1-8中发白</td>
                            <td>白</td>
                            <td type="odds">3.18</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="616303">
                            <td rowspan="1">总和单双</td>
                            <td>总单</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="616304">
                            <td colspan="2">总双</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="616305">
                            <td rowspan="2">总和尾数大小</td>
                            <td>总尾大</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="616306">
                            <td>总尾小</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="617301">
                            <td rowspan="6">连码</td>
                            <td>任选二</td>
                            <td type="odds">6.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="617302">
                            <td>选二连组</td>
                            <td type="odds">24</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="617303">
                            <td>任选三</td>
                            <td type="odds">19.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="617304">
                            <td>任选四</td>
                            <td type="odds">830</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">10000</td>
                            <td type="maxTurnMoney">10000</td>
                        </tr>
                        <tr play_id="617306">
                            <td>任选五</td>
                            <td type="odds">250</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="GAME_21_PAGE" v-if="ShowEle===12">
                <table class="u-table2">
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
                        <tr play_id="213001">
                            <td colspan="2">1-5球号</td>
                            <td type="odds">9.93</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="212701">
                            <td colspan="2">两面</td>
                            <td type="odds">1.993</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="212702">
                            <td rowspan="2">总和单双</td>
                            <td>总和单</td>
                            <td type="odds">1.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="212706">
                            <td>总和双</td>
                            <td type="odds">1.99</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="212703">
                            <td rowspan="2">总和尾数大小</td>
                            <td>总尾大</td>
                            <td type="odds">1.938</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="212707">
                            <td>总尾小</td>
                            <td type="odds">1.938</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="213501">
                            <td colspan="2">一中一</td>
                            <td type="odds">1.92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="213601">
                            <td rowspan="11">连码</td>
                            <td>任选二</td>
                            <td type="odds">5.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="213602">
                            <td>任选三</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="213603">
                            <td>任选四</td>
                            <td type="odds">50</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="213604">
                            <td>任选五</td>
                            <td type="odds">410</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="213605">
                            <td>任选六</td>
                            <td type="odds">60</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="213606">
                            <td>任选七</td>
                            <td type="odds">15</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="213607">
                            <td>任选八</td>
                            <td type="odds">6.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="213608">
                            <td>前二组选</td>
                            <td type="odds">41</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="213609">
                            <td>前三组选</td>
                            <td type="odds">143</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="213701">
                            <td>前二直选</td>
                            <td type="odds">92</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="213702">
                            <td>前三直选</td>
                            <td type="odds">895</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
<div id="GAME_10_PAGE" v-if="ShowEle===13">
                <table class="u-table2">
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
                        <tr play_id="106101">
                            <td colspan="2">大小</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="105601">
                            <td colspan="2">三军</td>
                            <td type="odds">2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="105601">
                            <td colspan="2">围骰</td>
                            <td type="odds">2</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="106201">
                            <td colspan="2">全骰</td>
                            <td type="odds">26</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="105804">
                            <td rowspan="6">点数</td>
                            <td type="odds">58</td>
                            <td type="odds">58</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="105805">
                            <td type="odds">21</td>
                            <td type="odds">21</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="105806">
                            <td type="odds">18</td>
                            <td type="odds">18</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="105807">
                            <td type="odds">12.5</td>
                            <td type="odds">12.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="105808">
                            <td type="odds">9</td>
                            <td type="odds">9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="105809">
                            <td type="odds">7</td>
                            <td type="odds">7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
<div id="GAME_30_PAGE" v-if="ShowEle===14">
                <table class="u-table2">
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
                        <tr play_id="30180001">
                            <td colspan="2">主势盘</td>
                            <td type="odds">1.906</td>
                            <td type="rebate">4%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30181000">
                            <td>一字组合</td>
                            <td>0~9</td>
                            <td type="odds">3.02</td>
                            <td type="rebate">16%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30182000">
                            <td rowspan="2">二字组合</td>
                            <td>对子</td>
                            <td type="odds">28</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">30000</td>
                            <td type="maxTurnMoney">30000</td>
                        </tr>
                        <tr play_id="30182001">
                            <td>其它</td>
                            <td type="odds">14.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">40000</td>
                            <td type="maxTurnMoney">40000</td>
                        </tr>
                        <tr play_id="30183001">
                            <td rowspan="3">三字组合</td>
                            <td>对子</td>
                            <td type="odds">250</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">5000</td>
                            <td type="maxTurnMoney">5000</td>
                        </tr>
                        <tr play_id="30183000">
                            <td>豹子</td>
                            <td type="odds">740</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">5000</td>
                            <td type="maxTurnMoney">5000</td>
                        </tr>
                        <tr play_id="30183012">
                            <td>其它</td>
                            <td type="odds">134</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">10000</td>
                            <td type="maxTurnMoney">10000</td>
                        </tr>
                        <tr play_id="30184000">
                            <td colspan="2">一字定位</td>
                            <td type="odds">7.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30185001">
                            <td rowspan="3">二字定位</td>
                            <td>佰拾定位</td>
                            <td type="odds">78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30185002">
                            <td>佰个定位</td>
                            <td type="odds">78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30185003">
                            <td>拾个定位</td>
                            <td type="odds">78</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30186001">
                            <td colspan="2">三字定位</td>
                            <td type="odds">740</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">3000</td>
                            <td type="maxTurnMoney">3000</td>
                        </tr>
                        <tr play_id="30187000">
                            <td rowspan="7">二字和数</td>
                            <td>和数:0~4,14~18</td>
                            <td type="odds">5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30187005">
                            <td>和数:5,13</td>
                            <td type="odds">12.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30187006">
                            <td>和数:6,12</td>
                            <td type="odds">11</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30187007">
                            <td>和数:7,11</td>
                            <td type="odds">9.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30187008">
                            <td>和数:8,10</td>
                            <td type="odds">8.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30187009">
                            <td>和数:9</td>
                            <td type="odds">7.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30187020">
                            <td>尾数</td>
                            <td type="odds">7.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30188001">
                            <td rowspan="9">三字和数</td>
                            <td>和数:0~6,21~27</td>
                            <td type="odds">9.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30188007">
                            <td>和数:7,20</td>
                            <td type="odds">21.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30188008">
                            <td>和数:8,19</td>
                            <td type="odds">17.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">60000</td>
                            <td type="maxTurnMoney">60000</td>
                        </tr>
                        <tr play_id="30188009">
                            <td>和数:9,18</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30188010">
                            <td>和数:10,17</td>
                            <td type="odds">12.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30188011">
                            <td>和数:11,16</td>
                            <td type="odds">11.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30188012">
                            <td>和数:12,15</td>
                            <td type="odds">10.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30188013">
                            <td>和数:13,14</td>
                            <td type="odds">10.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30188030">
                            <td>尾数</td>
                            <td type="odds">7.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="30189005">
                            <td rowspan="6">组选三</td>
                            <td>5</td>
                            <td type="odds">12.95</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30189006">
                            <td>6</td>
                            <td type="odds">8.61</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30189007">
                            <td>7</td>
                            <td type="odds">6.15</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30189008">
                            <td>8</td>
                            <td type="odds">4.61</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30189009">
                            <td>9</td>
                            <td type="odds">3.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30189010">
                            <td>10</td>
                            <td type="odds">2.87</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30190004">
                            <td rowspan="5">组选六</td>
                            <td>4</td>
                            <td type="odds">32.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">30000</td>
                            <td type="maxTurnMoney">30000</td>
                        </tr>
                        <tr play_id="30190005">
                            <td>5</td>
                            <td type="odds">13</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30190006">
                            <td>6</td>
                            <td type="odds">6.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30190007">
                            <td>7</td>
                            <td type="odds">3.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30190008">
                            <td>8</td>
                            <td type="odds">2.35</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">80000</td>
                            <td type="maxTurnMoney">80000</td>
                        </tr>
                        <tr play_id="30191000">
                            <td rowspan="10">跨度</td>
                            <td>0</td>
                            <td type="odds">71</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="30191001">
                            <td>1</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30191002">
                            <td>2</td>
                            <td type="odds">7.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30191003">
                            <td>3</td>
                            <td type="odds">6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30191004">
                            <td>4</td>
                            <td type="odds">5.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30191005">
                            <td>5</td>
                            <td type="odds">5.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30191006">
                            <td>6</td>
                            <td type="odds">5.3</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30191007">
                            <td>7</td>
                            <td type="odds">6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30191008">
                            <td>8</td>
                            <td type="odds">7.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="30191009">
                            <td>9</td>
                            <td type="odds">14</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">40000</td>
                            <td type="maxTurnMoney">40000</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div id="GAME_60_PAGE" v-if="ShowEle===16">
                <table class="u-table2">
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
                        <tr play_id="607501">
                            <td colspan="2">1-8球号</td>
                            <td type="odds">19.86</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607401">
                            <td colspan="2">两面</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607529">
                            <td colspan="2">1-8方位</td>
                            <td type="odds">3.88</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607533">
                            <td rowspan="2">1-8中发白</td>
                            <td>中发</td>
                            <td type="odds">2.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607535">
                            <td>白</td>
                            <td type="odds">3.16</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="608301">
                            <td colspan="2">正码</td>
                            <td type="odds">2.46</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607403">
                            <td rowspan="2">总和单双</td>
                            <td>总单</td>
                            <td type="odds">1.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607404">
                            <td>总双</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607403">
                            <td rowspan="2">总和单双</td>
                            <td>总单</td>
                            <td type="odds">1.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607404">
                            <td>总双</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607405">
                            <td rowspan="2">总和尾数大小</td>
                            <td>总尾大</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="607406">
                            <td>总尾小</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="608401">
                            <td rowspan="6">连码</td>
                            <td>任选二</td>
                            <td type="odds">6.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="608402">
                            <td>选二连组</td>
                            <td type="odds">24</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="608403">
                            <td>任选三</td>
                            <td type="odds">19.6</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="608404">
                            <td>选三前组</td>
                            <td type="odds">830</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="608405">
                            <td>任选四</td>
                            <td type="odds">60</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="608406">
                            <td>任选五</td>
                            <td type="odds">250</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                </tbody></table>
            </div>
            <div id="GAME_65_PAGE" v-if="ShowEle===15">
                <table class="u-table2">
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
                        <tr play_id="652601">
                            <td colspan="2">正码</td>
                            <td type="odds">3.81</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652101">
                            <td colspan="2">两面</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652105">
                            <td colspan="2">总和和局</td>
                            <td type="odds">108</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="652106">
                            <td colspan="2">总和过关</td>
                            <td type="odds">3.75</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652301">
                            <td rowspan="2">前后和</td>
                            <td>前（多）后（多）</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652303">
                            <td>和</td>
                            <td type="odds">3.82</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652401">
                            <td rowspan="2">单双和</td>
                            <td>单（多）双（多）</td>
                            <td type="odds">1.99</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652403">
                            <td>和</td>
                            <td type="odds">3.82</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652501">
                            <td rowspan="3">五行</td>
                            <td>金,土</td>
                            <td type="odds">9.21</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652502">
                            <td>木,火</td>
                            <td type="odds">4.61</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="652503">
                            <td>水</td>
                            <td type="odds">2.41</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                </tbody></table>
            </div>
            <div id="GAME_83_PAGE" v-if="ShowEle===10">
                <table class="u-table2">
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
                        <tr play_id="8319801">
                            <td colspan="2">正码</td>
                            <td type="odds">3.81</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8319501">
                            <td colspan="2">两面</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8319505">
                            <td colspan="2">总和和局</td>
                            <td type="odds">108</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">2000</td>
                            <td type="maxTurnMoney">2000</td>
                        </tr>
                        <tr play_id="8319506">
                            <td colspan="2">总和过关</td>
                            <td type="odds">3.7</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8319701">
                            <td rowspan="3">五行</td>
                            <td>金,土</td>
                            <td type="odds">9.21</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8319702">
                            <td>木,火</td>
                            <td type="odds">4.61</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="8319703">
                            <td>水</td>
                            <td type="odds">2.41</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                </tbody></table>
            </div>
            <div id="GAME_66_PAGE" v-if="ShowEle===11">
                <table class="u-table2">
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
                        <tr play_id="6611201">
                            <td rowspan="4" style="width: 100px">混合</td>
                            <td style="width: 100px">大,小,单,双</td>
                            <td type="odds">1.995</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="6611205">
                            <td>大单,大双，小单，小双</td>
                            <td type="odds">3.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="6611209">
                            <td>极大,极小</td>
                            <td type="odds">10.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="6611211">
                            <td>豹子</td>
                            <td type="odds">90</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">5</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="6611301">
                            <td colspan="2">波色</td>
                            <td type="odds">2.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">100000</td>
                            <td type="maxTurnMoney">100000</td>
                        </tr>
                        <tr play_id="6611400">
                            <td rowspan="16" style="width: 100px">特码</td>
                            <td style="width: 100px">0</td>
                            <td type="odds">941</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">50</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611401">
                            <td>1，26</td>
                            <td type="odds">313</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">50</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611402">
                            <td>2，25</td>
                            <td type="odds">158</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">10</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611403">
                            <td>3</td>
                            <td type="odds">64</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611404">
                            <td>4，23</td>
                            <td type="odds">62</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611405">
                            <td>5，22</td>
                            <td type="odds">44</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611406">
                            <td>6，21</td>
                            <td type="odds">33</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611407">
                            <td>7，20</td>
                            <td type="odds">26</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611408">
                            <td>8，19</td>
                            <td type="odds">20.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611409">
                            <td>9，18</td>
                            <td type="odds">17.1</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611410">
                            <td>10，17</td>
                            <td type="odds">14.9</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="6611411">
                            <td>11，16</td>
                            <td type="odds">13.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="6611412">
                            <td>12，15</td>
                            <td type="odds">12.8</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="6611413">
                            <td>13，14</td>
                            <td type="odds">12.5</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">50000</td>
                            <td type="maxTurnMoney">50000</td>
                        </tr>
                        <tr play_id="6611424">
                            <td>24</td>
                            <td type="odds">65</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">1</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                        <tr play_id="6611427">
                            <td>27</td>
                            <td type="odds">941</td>
                            <td type="rebate">0%</td>
                            <td type="minMoney">50</td>
                            <td type="maxMoney">20000</td>
                            <td type="maxTurnMoney">20000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div></div>
</template>

<script>
export default {
  name: "header-top-user-bet-info",
  data() {
    return {
      ShowEle: 1
    }
  },
  methods: {
    // 根据每个元素点击传入ID
    Show: function(id) {
      this.ShowEle = id;
    }
  },
    created () {
        this.$store.dispatch('contSiderShowFalse')
    }
}
</script>

<style scoped>
* {
  padding: 0;
  margin: 0;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

body {
  font: 12px/1.5 "\5FAE\8F6F\96C5\9ED1", "\5b8b\4f53", Arial, Helvetica,
    sans-serif;
  overflow-y: hidden;
}

.u-table2 {
  width: 100%;
  text-align: center;
}
.u-table2 th {
  font-weight: 700;
  height: 23px;
}

.u-table2 td {
  height: 28px;
  background: #fff;
  cursor: pointer;
}

.hide {
  display: none;
}

.show {
  display: block;
}

.tab {
  padding: 0;
  width: 100%;
  height: 70px;
}

.tab_title02 {
  height: 29px;
  line-height: 29px;
}

.tab_title02 a {
  background: url("/static/game/images/skin/blue/tab_bg10.png") no-repeat scroll
    left -29px;
  color: #7d7d7d;
  display: block;
  float: left;
  font-size: 12px;
  font-weight: 700;
  height: 29px;
  margin: 5px 5px 0 0;
  text-align: center;
  text-decoration: none;
  text-shadow: 1px 1px 0 #fff;
  width: 88px;
}

.member-info {
  margin: 10px;
  width: 880px;
}
</style>