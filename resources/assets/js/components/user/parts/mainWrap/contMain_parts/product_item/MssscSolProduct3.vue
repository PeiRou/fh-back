<template>
    <div>
        <div>
            <div class="cont-col3-bd">
                <table class="u-table2">
                    <thead>
                    <tr>
                        <th style="width: 40px;">号</th>
                        <th style="width: 58px;">赔率</th>
                        <th>金额</th>
                        <th style="width: 40px;">号</th>
                        <th style="width: 58px;">赔率</th>
                        <th>金额</th>
                        <th style="width: 40px;">号</th>
                        <th style="width: 58px;">赔率</th>
                        <th>金额</th>
                        <th style="width: 40px;">号</th>
                        <th style="width: 58px;">赔率</th>
                        <th>金额</th>
                        <th width="40">号</th>
                        <th style="width: 58px;">赔率</th>
                        <th>金额</th>
                    </tr>
                    </thead>
                </table>
                <MssscCombProduct_3_2 v-for="(item,index) in info.product_2_1" :info="{ productId: item, productInfo: info}" :key="index" v-if="index === 2"></MssscCombProduct_3_2>

                <!--新加的-->
                <div style="margin-bottom: 10px"></div>
                <!--新加的-->

                <MssscCombProduct_1 v-for="(item,index) in info.product_1" :info="{ productId: item, productInfo: info}" :key="index"></MssscCombProduct_1>
                <!--<table class="u-table2">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="12">总和-龙虎和</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--<td data-id="1101" class="name">总和大</td>-->
                        <!--<td data-id="1101" class="odds"><span class="c-txt3">1.995</span></td>-->
                        <!--<td data-id="1101" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="1102" class="name">总和小</td>-->
                        <!--<td data-id="1102" class="odds"><span class="c-txt3">1.995</span></td>-->
                        <!--<td data-id="1102" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="1103" class="name">总和单</td>-->
                        <!--<td data-id="1103" class="odds"><span class="c-txt3">1.995</span></td>-->
                        <!--<td data-id="1103" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="1104" class="name">总和双</td>-->
                        <!--<td data-id="1104" class="odds"><span class="c-txt3">1.995</span></td>-->
                        <!--<td data-id="1104" class="amount"><input type="text" style=""></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="1105" class="name">龙</td>-->
                        <!--<td data-id="1105" class="odds"><span class="c-txt3">1.995</span></td>-->
                        <!--<td data-id="1105" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="1106" class="name">虎</td>-->
                        <!--<td data-id="1106" class="odds"><span class="c-txt3">1.995</span></td>-->
                        <!--<td data-id="1106" class="amount"><input type="text" style=""></td>-->
                        <!--<td data-id="1107" class="name">和</td>-->
                        <!--<td data-id="1107" class="odds"><span class="c-txt3">9</span></td>-->
                        <!--<td data-id="1107" class="amount"><input type="text" style=""></td>-->
                        <!--<td colspan="3" class="name not-event"></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
                <!--<table class="cont-list1">-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--&lt;!&ndash;<Mspk10LmpProduct_2 v-for="(item,index) in info.product_2_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_2>&ndash;&gt;-->
                        <!--<MssscCombProduct_2 v-for="(item,index) in info.product_2_1" :info="{ productId: item, productInfo: info}" :key="index"></MssscCombProduct_2>-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3">第一球</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1210" class="name">大</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1210" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1210" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1211" class="name">小</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1211" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1211" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1212" class="name">单</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1212" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1212" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1213" class="name">双</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1213" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1213" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1200" class="name"><span class="ball c-b1">0</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1200" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1200" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1201" class="name"><span class="ball c-b1">1</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1201" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1201" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1202" class="name"><span class="ball c-b1">2</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1202" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1202" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1203" class="name"><span class="ball c-b1">3</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1203" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1203" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1204" class="name"><span class="ball c-b1">4</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1204" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1204" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1205" class="name"><span class="ball c-b1">5</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1205" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1205" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1206" class="name"><span class="ball c-b1">6</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1206" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1206" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1207" class="name"><span class="ball c-b1">7</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1207" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1207" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1208" class="name"><span class="ball c-b1">8</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1208" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1208" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1209" class="name"><span class="ball c-b1">9</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1209" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1209" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3">第二球</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1310" class="name">大</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1310" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1310" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1311" class="name">小</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1311" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1311" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1312" class="name">单</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1312" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1312" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1313" class="name">双</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1313" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1313" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1300" class="name"><span class="ball c-b1">0</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1300" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1300" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1301" class="name"><span class="ball c-b1">1</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1301" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1301" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1302" class="name"><span class="ball c-b1">2</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1302" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1302" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1303" class="name"><span class="ball c-b1">3</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1303" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1303" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1304" class="name"><span class="ball c-b1">4</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1304" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1304" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1305" class="name"><span class="ball c-b1">5</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1305" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1305" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1306" class="name"><span class="ball c-b1">6</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1306" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1306" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1307" class="name"><span class="ball c-b1">7</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1307" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1307" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1308" class="name"><span class="ball c-b1">8</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1308" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1308" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1309" class="name"><span class="ball c-b1">9</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1309" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1309" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3">第三球</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1410" class="name">大</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1410" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1410" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1411" class="name">小</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1411" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1411" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1412" class="name">单</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1412" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1412" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1413" class="name">双</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1413" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1413" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1400" class="name"><span class="ball c-b1">0</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1400" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1400" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1401" class="name"><span class="ball c-b1">1</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1401" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1401" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1402" class="name"><span class="ball c-b1">2</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1402" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1402" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1403" class="name"><span class="ball c-b1">3</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1403" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1403" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1404" class="name"><span class="ball c-b1">4</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1404" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1404" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1405" class="name"><span class="ball c-b1">5</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1405" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1405" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1406" class="name"><span class="ball c-b1">6</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1406" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1406" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1407" class="name"><span class="ball c-b1">7</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1407" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1407" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1408" class="name"><span class="ball c-b1">8</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1408" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1408" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1409" class="name"><span class="ball c-b1">9</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1409" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1409" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3">第四球</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1510" class="name">大</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1510" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1510" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1511" class="name">小</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1511" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1511" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1512" class="name">单</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1512" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1512" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1513" class="name">双</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1513" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1513" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1500" class="name"><span class="ball c-b1">0</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1500" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1500" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1501" class="name"><span class="ball c-b1">1</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1501" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1501" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1502" class="name"><span class="ball c-b1">2</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1502" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1502" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1503" class="name"><span class="ball c-b1">3</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1503" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1503" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1504" class="name"><span class="ball c-b1">4</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1504" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1504" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1505" class="name"><span class="ball c-b1">5</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1505" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1505" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1506" class="name"><span class="ball c-b1">6</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1506" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1506" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1507" class="name"><span class="ball c-b1">7</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1507" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1507" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1508" class="name"><span class="ball c-b1">8</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1508" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1508" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1509" class="name"><span class="ball c-b1">9</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1509" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1509" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3">第五球</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1610" class="name">大</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1610" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1610" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1611" class="name">小</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1611" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1611" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1612" class="name">单</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1612" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1612" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1613" class="name">双</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1613" class="odds"><span class="c-txt3">1.995</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1613" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1600" class="name"><span class="ball c-b1">0</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1600" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1600" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1601" class="name"><span class="ball c-b1">1</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1601" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1601" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1602" class="name"><span class="ball c-b1">2</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1602" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1602" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1603" class="name"><span class="ball c-b1">3</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1603" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1603" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1604" class="name"><span class="ball c-b1">4</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1604" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1604" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1605" class="name"><span class="ball c-b1">5</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1605" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1605" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1606" class="name"><span class="ball c-b1">6</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1606" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1606" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1607" class="name"><span class="ball c-b1">7</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1607" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1607" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1608" class="name"><span class="ball c-b1">8</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1608" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1608" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1609" class="name"><span class="ball c-b1">9</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1609" class="odds"><span class="c-txt3">9.95</span></td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td data-id="1609" class="amount"><input type="text" style=""></td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
                <MssscCombProduct_3 v-for="(item,index) in info.product_2_2" :info="{ productId: item, productInfo: info}" :key="index" v-if="index === 0"></MssscCombProduct_3>
                <MssscCombProduct_3 v-for="(item,index) in info.product_2_2" :info="{ productId: item, productInfo: info}" :key="index" v-if="index === 1"></MssscCombProduct_3>
                <MssscCombProduct_3 v-for="(item,index) in info.product_2_2" :info="{ productId: item, productInfo: info}" :key="index" v-if="index === 2"></MssscCombProduct_3>
                <!--<table class="u-table2" style="margin-top: 10px;">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="15">前三</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<td data-id="1701" class="name">豹子</td>-->
                    <!--<td data-id="1701" class="odds"><span class="c-txt3">75</span></td>-->
                    <!--<td data-id="1701" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1702" class="name">顺子</td>-->
                    <!--<td data-id="1702" class="odds"><span class="c-txt3">14.5</span></td>-->
                    <!--<td data-id="1702" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1703" class="name">对子</td>-->
                    <!--<td data-id="1703" class="odds"><span class="c-txt3">3.3</span></td>-->
                    <!--<td data-id="1703" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1704" class="name">半顺</td>-->
                    <!--<td data-id="1704" class="odds"><span class="c-txt3">2.5</span></td>-->
                    <!--<td data-id="1704" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1705" class="name">杂六</td>-->
                    <!--<td data-id="1705" class="odds"><span class="c-txt3">3</span></td>-->
                    <!--<td data-id="1705" class="amount"><input type="text" style=""></td>-->
                    <!--</tbody>-->
                <!--</table>-->
                <!--<table class="u-table2" style="margin-top: 10px;">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="15">中三</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<td data-id="1801" class="name">豹子</td>-->
                    <!--<td data-id="1801" class="odds"><span class="c-txt3">75</span></td>-->
                    <!--<td data-id="1801" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1802" class="name">顺子</td>-->
                    <!--<td data-id="1802" class="odds"><span class="c-txt3">14.5</span></td>-->
                    <!--<td data-id="1802" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1803" class="name">对子</td>-->
                    <!--<td data-id="1803" class="odds"><span class="c-txt3">3.3</span></td>-->
                    <!--<td data-id="1803" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1804" class="name">半顺</td>-->
                    <!--<td data-id="1804" class="odds"><span class="c-txt3">2.5</span></td>-->
                    <!--<td data-id="1804" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1805" class="name">杂六</td>-->
                    <!--<td data-id="1805" class="odds"><span class="c-txt3">3</span></td>-->
                    <!--<td data-id="1805" class="amount"><input type="text" style=""></td>-->
                    <!--</tbody>-->
                <!--</table>-->
                <!--<table class="u-table2" style="margin-top: 10px;">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="15">后三</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<td data-id="1901" class="name">豹子</td>-->
                    <!--<td data-id="1901" class="odds"><span class="c-txt3">75</span></td>-->
                    <!--<td data-id="1901" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1902" class="name">顺子</td>-->
                    <!--<td data-id="1902" class="odds"><span class="c-txt3">14.5</span></td>-->
                    <!--<td data-id="1902" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1903" class="name">对子</td>-->
                    <!--<td data-id="1903" class="odds"><span class="c-txt3">3.3</span></td>-->
                    <!--<td data-id="1903" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1904" class="name">半顺</td>-->
                    <!--<td data-id="1904" class="odds"><span class="c-txt3">2.5</span></td>-->
                    <!--<td data-id="1904" class="amount"><input type="text" style=""></td>-->
                    <!--<td data-id="1905" class="name">杂六</td>-->
                    <!--<td data-id="1905" class="odds"><span class="c-txt3">3</span></td>-->
                    <!--<td data-id="1905" class="amount"><input type="text" style=""></td>-->
                    <!--</tbody>-->
                <!--</table>-->
            </div>
        </div>
    </div>
</template>

<script>
    // 引入第一种商品，因为第一种商品和秒速赛车是一样的，所以这里，我们使用秒速赛车的模板和秒速时时彩的数据
    import MssscCombProduct_1 from './Mspk10LmpProduct_1/Mspk10LmpProduct_1'

    // 引入第一种商品，因为第一种商品和秒速赛车是一样的，所以这里，我们使用秒速赛车的模板和秒速时时彩的数据(取数据的时候，不用取出v-if中的isNaN的值)(由于前面这个括号里面的原因，所以，这里我们在Mspk10LmpProduct_2的基础上，复制出来，然后改一改，之后，再做一个数据的过滤，然后就可以用一套模板了)　// 然后再模板中加入一个　.ball的class类 (如果这还不行，就重新再做一套秒速时时彩的模板)

    // import MssscCombProduct_2 from './MssscCombProduct_2/Mspk10LmpProduct_2'
    // import Mspk10LmpProduct_2 from './Mspk10LmpProduct_2/Mspk10LmpProduct_2'

    //　引入第三种商品 (加入index　用三个　index分别是　0 1 2) (第三种用　秒速赛车第一种的模板)
    import MssscCombProduct_3 from './MssscCombProduct_3/Mspk10LmpProduct_1'


    //引入最开始的地方的商品，模板修改一下
    import MssscCombProduct_3_2 from './MssscCombProduct_3/Mspk10LmpProduct_1_2'

    export default {
        name: "msssc-comb-product",
        props: {
            info: Object
        },
        components: {
            MssscCombProduct_1,
            // MssscCombProduct_2,
            // Mspk10LmpProduct_2,
            // Mspk10LmpProduct_1
            MssscCombProduct_3,
            MssscCombProduct_3_2

        }
    }
</script>

<style scoped>
    table {
        border-collapse: collapse;
        border-spacing: 0
    }

    h6 {
        font-size: 100%
    }

    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
    }

    .wrap {
        position: relative
    }

    .clearfix:after {
        content: "";
        height: 0;
        visibility: hidden;
        display: block;
        clear: both
    }

    .clearfix {
        zoom: 1
    }

    .clear {
        clear: both
    }

    .pr {
        position: relative
    }

    .dib {
        display: inline-block
    }

    .hdn {
        display: none
    }

    .vm {
        vertical-align: middle
    }

    .t-left {
        text-align: left
    }

    .t-center {
        text-align: center
    }

    .t-right {
        text-align: right
    }

    .fl {
        float: left
    }

    .fr {
        float: right
    }

    .db {
        display: block
    }

    .main-body {
        position: absolute;
        overflow-x: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 30px
    }

    .iframe-body {
        overflow-x: hidden;
        overflow-y: auto;
        background-color: #fff;
        display: none
    }

    a {
        text-decoration: none
    }

    a:hover {
        text-decoration: none
    }

    .trial-cls {
        display: none
    }

    .icon1 {
        width: 16px;
        height: 8px
    }

    .icon2 {
        width: 18px;
        height: 18px;
        background-position: 0 -9px
    }

    .u-btn1 {
        display: inline-block;
        width: 56px;
        height: 20px;
        line-height: 20px;
        text-align: center;
        vertical-align: bottom;
        border-radius: 3px;
        font-size: 12px;
        margin-left: 3px
    }

    .u-btn {
        display: inline-block;
        vertical-align: middle;
        cursor: pointer;
        overflow: hidden;
        border: none
    }

    .u-btn2:hover {
        text-decoration: none
    }

    .u-btn6 {
        min-width: 55px;
        padding: 0 5px;
        height: 20px;
        line-height: 20px;
        vertical-align: top;
        text-align: center;
        background: #dd4814;
        color: #fff
    }

    .u-btn6 {
        min-width: 100px;
        height: 30px;
        line-height: 30px;
        border-radius: 3px
    }

    .u-btn6 {
        background: #aea79f
    }

    .u-btn17:hover {
        text-decoration: none
    }

    .c-txt3 {
        color: red;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        padding: 0 4px
    }

    .fs-1 {
        font-size: 14px
    }

    .u-ipt1 {
        width: 138px;
        height: 18px;
        line-height: 18px;
        padding: 3px 5px;
        vertical-align: middle;
        border: 1px solid #af3230;
        background: #fff
    }

    .u-ipt2-1 {
        width: 88px
    }

    input {
        font-family: '\5FAE\8F6F\96C5\9ED1'
    }

    .header {
        position: absolute;
        color: #fff;
        min-width: 1240px;
        width: 100%
    }

    .header .menu1 {
        width: 490px;
        position: absolute;
        left: 230px;
        top: 0
    }

    .header a {
        color: #fff;
        text-align: center
    }

    .header-top {
        height: 67px;
        position: relative
    }

    .menu1 .draw_number {
        position: absolute;
        left: 15px;
        top: 5px
    }

    .menu1 .draw_number div {
        height: 22px;
        line-height: 22px;
        text-align: center
    }

    #result_balls {
        position: absolute;
        left: 130px;
        top: 10px
    }

    .header .more-game-drop .actionBtn.action-cancel {
        background: #bbb;
        display: none
    }

    .header .lotterys.menu-editMode .more-game-drop .action-cancel {
        display: inline-block
    }

    .side_left ul {
        list-style: outside none none;
        margin: 0;
        padding: 0
    }

    .side_left p {
        display: block;
        line-height: 18px;
        margin: 0;
        white-space: nowrap
    }

    #left_user_new_notice {
        vertical-align: middle;
        cursor: pointer;
        margin: 0 0 22px 6px;
        width: 27px;
        height: 11px;
        display: none
    }

    .logo2 {
        height: 57px;
        width: 190px;
        text-align: center;
        position: absolute;
        left: 7px;
        top: 5px
    }

    .logo a {
        display: block;
        height: 100%;
        color: #fff;
        font-size: 20px;
        text-decoration: none
    }

    .logo img {
        max-width: 100%
    }

    .service {
        display: block;
        margin-bottom: 20px;
        text-align: center
    }

    .service img {
        vertical-align: top
    }

    .u-table1 {
        width: 100%;
        table-layout: fixed;
        text-align: center
    }

    .u-table1 th {
        height: 26px;
        background: #e0cec8;
        font-size: 12px;
        color: #310a07
    }

    .u-table1 td {
        padding: 2px
    }

    .guide-list {
        margin-left: 2px
    }

    .subnav-box .more {
        padding: 0 17px;
        color: #fff;
        cursor: pointer
    }

    .cont-main {
        overflow: hidden;
        width: 839px;
        float: left
    }

    .cont-box1 {
        margin-top: 12px
    }

    .cont-col1,
    .cont-col2 {
        float: left;
        width: 44%;
        height: 116px;
        background: #892122;
        color: #f5e8c4
    }

    .cont-col2 {
        float: right;
        width: 55%
    }

    .cur-term {
        position: relative
    }

    .cur-term dt {
        position: absolute;
        left: 26px;
        top: 20px;
        font-size: 20px;
        color: #fff
    }

    .cur-term dt span {
        color: #ffc80a
    }

    .cur-term .cur-term-col1 {
        height: 66px;
        padding: 13px 0 0 185px;
        line-height: 24px;
        border-bottom: 1px solid #9b2727
    }

    .cur-term .cur-term-col2,
    .next-term .next-term-col2 {
        line-height: 36px;
        padding: 0 18px 0 26px;
        overflow: hidden;
        border-top: 1px solid #6f0c0d
    }

    .next-term dd,
    .next-term dt {
        padding-left: 20px
    }

    .next-term dt {
        height: 30px;
        line-height: 30px
    }

    .next-term .next-term-col1 {
        height: 46px;
        padding-left: 2%;
        padding-top: 3px;
        font-size: 0;
        white-space: nowrap;
        border-bottom: 1px solid #9b2727
    }

    .next-term .next-term-col2 {
        padding-left: 20px;
        color: #fff
    }

    .cont-col3 {
        margin-top: 4px;
        padding: 0 5px 10px
    }

    .cont-col3-hd {
        padding: 8px 0;
        color: #310a07
    }

    .cont-col3-box1 {
        float: left;
        width: 222px;
        padding-left: 10px
    }

    .cont-col3-box1 a {
        display: inline-block;
        height: 20px;
        line-height: 20px;
        padding: 0 7px;
        vertical-align: middle;
        background: #fbdada;
        color: #310a07;
        border: 1px solid #af3230;
        border-radius: 3px
    }

    .cont-col3-box1 a:hover {
        background: #f9b1b0;
        text-decoration: none
    }

    .cont-col3-box1 a.cur {
        background: #f59593
    }

    .u-table2 {
        width: 100%;
        text-align: center
    }

    .u-table2 th {
        font-weight: 700;
        height: 23px
    }

    .u-table2 thead th.select {
        background-position: 0 -59px
    }

    .u-table2 td {
        height: 28px;
        background: #fff;
        cursor: pointer
    }

    .u-table2 .name {
        width: 60px;
        min-width: 40px;
        font-weight: 700
    }

    .u-table2.sevenrow .name {
        width: auto;
        min-width: auto
    }

    .u-table2 .amount {
        width: 65px
    }

    .u-table2.sevenrow .amount {
        width: 60px
    }

    .u-table2 .amount > input {
        width: 80%;
        min-width: 40px;
        height: 15px;
        background: url(/static/game/images/skin/blue/text_input.gif) repeat-x left top;
        border: #b9c2cb 1px solid;
        padding: 0 2px
    }

    .u-table2 .odds {
        width: 50px;
        font-weight: 700
    }

    .u-table2 .qiu {
        text-align: left;
        padding-left: 10px
    }

    .bet-money {
        width: 70px;
        height: 18px;
        background: url(/static/game/images/skin/blue/text_input.gif) repeat-x left top;
        border: #b9c2cb 1px solid;
        text-align: center
    }

    .cont-list1 {
        margin-top: 10px;
        width: 100%
    }

    .cont-list1 li {
        float: left;
        width: 19.6%;
        margin-right: .5%
    }

    .cont-list1 li:last-child {
        margin-right: 0
    }

    .cont-list1 > tbody > tr > td {
        padding: 0 1px
    }

    .cont-btnbox1 {
        padding: 20px 0;
        text-align: center
    }

    .u-table3 {
        width: 100%;
        table-layout: fixed;
        border: 1px solid #eac0bf;
        border-bottom: none
    }

    .u-table3 th {
        height: 39px;
        font-size: 16px;
        color: #310a07
    }

    .u-tb3-th2 {
        cursor: pointer
    }

    .u-table4 {
        width: 100%;
        table-layout: fixed;
        text-align: center
    }

    .u-table4 td {
        height: 28px;
        background: #fff
    }

    .cont-col3-box2 {
        text-align: center
    }

    .cont-col3-box2 span {
        margin-right: 6px;
        font-weight: 700;
        font-size: 13px
    }

    .cont-sider {
        float: left;
        width: 180px
    }

    .cont-sider .u-table2 thead th {
        height: 30px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        border: none;
        font-size: 13px;
        letter-spacing: 1px
    }

    .sider-box1-bd,
    .sider-box1-ft,
    .sider-box1-hd {
        background-color: #ececec
    }

    .sider-box1-hd {
        height: 42px;
        line-height: 42px;
        padding: 0 18px;
        font-size: 14px;
        color: #fff
    }

    .sider-box1-bd {
        background-position: -180px 0;
        background-repeat: repeat-y
    }

    .sider-box1-ft {
        height: 14px;
        background-position: -360px bottom
    }

    .u-table5 {
        width: 100%
    }

    .u-table5 .statFont {
        color: red
    }

    .u-table5 td,
    .u-table5 th {
        height: 23px;
        padding: 0 5px;
        text-align: left;
        font-size: 12px;
        border: 1px solid #daa4a3;
        font-weight: 400;
        color: #4f4d4d
    }

    .u-tb5-tr1 {
        background: #f7ebeb
    }

    .count-wrap {
        padding: 0 5px 5px
    }

    .u-header {
        height: 30px;
        border-radius: 4px;
        line-height: 30px;
        font-weight: 700;
        font-size: 13px
    }

    #page_game_name {
        margin-left: 1em
    }

    #open-date {
        margin-right: 1em
    }

    #total_sum_money {
        font-size: 14px;
        color: red;
        padding: 2px 5px;
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px
    }

    .tab {
        padding: 0;
        width: 100%;
        height: 70px
    }

    .tab li {
        list-style: outside none none;
        margin: 0
    }

    .multiple ul {
        background: #fff none repeat scroll 0 0;
        margin: 0;
        padding: 5px;
        text-indent: 1em
    }

    .multiple li {
        float: left;
        font-size: 12px
    }

    .multiple li .nums {
        color: #00f
    }

    .multiple li .xu {
        color: #892122
    }

    .record-box {
        padding: 10px;
        width: 980px
    }

    .record-box .u-table2 {
        table-layout: auto
    }

    .record-box .u-table2 td {
        padding: 5px;
        font-weight: 400;
        font-size: 12px !important
    }

    .rule-box {
        margin: 10px;
        width: 900px
    }

    .member-info {
        margin: 10px;
        width: 880px
    }

    .side_left .bets .bid {
        color: #119400
    }

    .side_left .bets .text {
        color: #0017c7
    }

    .side_left .bets .odds {
        color: red;
        font-family: Arial, Helvetica, Verdana, Geneva, sans-serif;
        font-weight: 700
    }

    .btn-pop-close {
        position: absolute;
        right: -5px;
        top: -5px;
        line-height: 1;
        color: #4c4c4c;
        font-size: 20px;
        font-family: '\5b8b\4f53'
    }

    .btn-pop-close:hover {
        text-decoration: none;
        color: #f03838
    }

    input:disabled {
        border: 1px solid #ddd;
        background-color: #f5f5f5;
        color: #bebdbd
    }

    .table-td-valign-top td {
        vertical-align: top
    }

    .skin_blue .sub {
        color: #666;
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        border-bottom: 1px solid #ccc
    }

    .skin_blue .sub a {
        color: #666
    }

    .skin_blue .sub .selected,
    .skin_blue .sub a:hover {
        color: #f98d5c
    }

    .skin_blue .lotterys .selected,
    .skin_blue .lotterys .show > a:hover {
        color: #143679;
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%)
    }

    .skin_blue .lotterys.menu-editMode .show > a:hover {
        background: 0 0;
        color: #fff
    }

    .skin_blue .header-top {
        background: url(/static/game/images/skin/blue/main_bg.jpg) no-repeat 0 0
    }

    .skin_blue #skinPanel:hover .skin_blue .skinHover ul,
    .skin_blue #skinPanel:hover ul,
    .skin_blue .skinHover {
        background: #234b95
    }

    .skin_blue .header .menu3 a {
        background-color: #2f97f7
    }

    .skin_blue .side_left .info label {
        color: #36639d
    }

    .skin_blue .content {
        background-color: #fff
    }

    .skin_blue .cont-col3 {
        background: #fff
    }

    .skin_blue .u-table2 .name {
        background-color: #edf4fe
    }

    .skin_blue .u-table2 td,
    .skin_blue .u-table4 td {
        border: 1px solid #b9c2cb;
        color: #35406d
    }

    .skin_blue .u-table2 .hover {
        background: none repeat 0 0 #c3d9f1
    }

    .skin_blue .u-table5 td,
    .skin_blue .u-table5 th {
        border: 1px solid #b9c2cb
    }

    .skin_blue .u-tb5-tr1 {
        background: #fff
    }

    .skin_blue .u-table2 thead th.select {
        background: #dee9f3;
        background: -moz- linear-gradient(top, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        background: -webkit- linear-gradient(top, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        background: linear-gradient(to bottom, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        color: #000;
        font-weight: 700
    }

    .skin_blue .u-table10 thead th {
        border: 1px solid #b9c2cb;
        background-color: #edf4fe;
        color: #35406d
    }

    .skin_blue .u-table10 td {
        border: 1px solid #b9c2cb;
        background: #fff;
        color: #35406d
    }

    .skin_blue .u-header {
        background-color: #2161b3;
        color: #fff
    }

    .skin_blue .u-table2 th {
        color: #4f4d4d;
        border: 1px solid #b9c2cb;
        background-color: #edf4fe
    }

    .skin_blue .cont-col3-box2 span {
        color: #38539a
    }

    .skin_blue .u-btn1 {
        background: #5b8ac7;
        background: -moz-linear-gradient(top, #5b8ac7 0, #2765b5 100%);
        background: -webkit-linear-gradient(top, #5b8ac7 0, #2765b5 100%);
        background: linear-gradient(to bottom, #5b8ac7 0, #2765b5 100%);
        border: 1px solid #1e57a0;
        color: #fff
    }

    .skin_blue .u-btn1:hover {
        color: #f98d5c;
        font-weight: 700
    }

    .skin_blue .cont-sider thead th {
        background: #2161b3;
        color: #fff
    }

    .skin_blue .header .lotterys .more-game {
        border-left: 1px solid #2161b3
    }

    .skin_blue .header .more-game-drop a {
        color: #fff
    }

    .skin_blue .header .more-game-drop a:hover {
        background: #143679;
        color: #fff
    }

    .skin_blue .header .lotterys .more-game.selected > a,
    .skin_blue .header .lotterys .more-game:hover > a,
    .skin_blue .header .lotterys.menu-editMode .more-game > a {
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        border-bottom: 1px solid #e6e6e6;
        color: #143679
    }

    .skin_blue .header .lotterys .more-game:hover > a,
    .skin_blue .header .lotterys.menu-editMode .more-game > a {
        color: #143679
    }

    .skin_blue .header .more-game-drop {
        background-color: #e7e7e7;
        border: 1px solid #2161b3
    }

    .skin_blue .header .gamebox a {
        background: #2161b3
    }

    .skin_blue .header .actionBtn {
        background: #2161b3
    }

    .skin_blue .notice-wrap .bg {
        background: #1e5799;
        background: -moz-linear-gradient(top, rgba(30, 87, 153, 1) 0, rgba(0, 219, 255, 1) 0, rgba(0, 165, 255, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(30, 87, 153, 1) 0, rgba(0, 219, 255, 1) 0, rgba(0, 165, 255, 1) 100%);
        background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(0, 219, 255, 1) 0, rgba(0, 165, 255, 1) 100%)
    }

    .menu1 a span {
        display: block;
        float: left
    }

    .menu1 a b {
        display: block;
        width: 27px;
        height: 27px;
        font-size: 0;
        text-indent: -99999px;
        margin-top: 10px
    }

    .menu1 a i {
        display: block;
        text-align: center;
        font-style: normal;
        font-weight: bolder;
        color: #fff
    }

    .skin_gray .menu1 a i {
        color: #000
    }

    .ball {
        display: inline-block;
        vertical-align: middle;
        background: url(/static/game/images/ball/ball-sprites.png) no-repeat 0 0
    }

    .c-b1,
    .c-r1 {
        width: 24px;
        height: 25px;
        line-height: 26px;
        text-align: center;
        background-position: -117px -26px;
        font-size: 12px;
        color: #000
    }

    .c-r1 {
        background-position: -117px 0
    }

    .c-r2 {
        width: 27px;
        height: 27px;
        line-height: 27px;
        text-align: center;
        background-position: -187px 0;
        font-size: 12px;
        color: #000
    }

    .c-b2 {
        background-position: -187px -54px
    }

    .c-r2 {
        background-position: -187px -27px
    }

    .c-n9 {
        width: 23px;
        height: 23px
    }

    .menu1 span {
        display: block;
        float: left
    }

    .menu1 b {
        display: block;
        height: 27px;
        margin-top: 10px;
        text-indent: -99999px;
        width: 27px
    }

    .menu1 i {
        color: #fff;
        display: block;
        font-style: normal;
        font-weight: bolder;
        text-align: center
    }

    .button {
        -moz-user-select: none;
        cursor: pointer;
        display: inline-block;
        line-height: normal;
        margin-left: 2px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap
    }

    .button::-moz-focus-inner {
        border: 0 none;
        padding: 0
    }

    .button {
        background-color: #eda220;
        border: medium none;
        border-radius: 2px;
        color: #fff;
        font-family: inherit;
        font-size: 100%;
        line-height: 24px;
        padding: 0 16px;
        text-decoration: none
    }

    .button-hover,
    .button:focus,
    .button:hover {
        background-image: linear-gradient(transparent, rgba(0, 0, 0, .05) 40%, rgba(0, 0, 0, .1))
    }

    .button:focus {
        outline: 0 none
    }

    .skin_red .el-notification__title {
        background: #d87c86
    }

    .skin_red .el-notification__content {
        color: #6a1f2d
    }

    .skin_red .t-qi {
        color: #6a1f2d
    }

    .skin_red .pay-dialog .el-dialog__title,
    .skin_red .pay-dialog .el-message-box__title,
    .skin_red.v2-dialog .el-dialog__title,
    .skin_red.v2-dialog .el-message-box__title {
        background: #d87c86
    }

    .skin_blue .el-notification__title {
        background: #4274b3
    }

    .skin_blue .el-notification__content {
        color: #0c325f
    }

    .skin_blue .t-qi {
        color: #2161b3
    }

    .skin_blue.v2-dialog .el-message-box__title {
        background: #4274b3
    }

    .v2-dialog .el-message-box__title {
        color: #fff;
        padding: 6px 20px 8px 10px;
        line-height: 1.2;
        display: inline-block
    }

    .order-detail-table td {
        padding: 0 8px
    }

    .iconfont {
        font-family: iconfont !important;
        font-size: 16px;
        font-style: normal;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale
    }

</style>