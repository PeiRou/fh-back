<template>
    <div>
        <div>
            <div class="cont-col3-bd">
                <Mspk10LmpProduct_1 v-for="(item,index) in info.product_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_1>
                <!--<table class="u-table2">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="12">三军、大小</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--<td data-id="105601" class="name">-->
                            <!--<div class="K3Term ball-container1"><b class="b1">1</b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105601" class="odds"><span class="c-txt3">2</span></td>-->
                        <!--<td data-id="105601" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105602" class="name">-->
                            <!--<div class="K3Term ball-container1"><b class="b2">2</b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105602" class="odds"><span class="c-txt3">2</span></td>-->
                        <!--<td data-id="105602" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105603" class="name">-->
                            <!--<div class="K3Term ball-container1"><b class="b3">3</b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105603" class="odds"><span class="c-txt3">2</span></td>-->
                        <!--<td data-id="105603" class="amount"><input type="text"></td>-->
                        <!--<td data-id="106101" class="name">大</td>-->
                        <!--<td data-id="106101" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="106101" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105604" class="name">-->
                            <!--<div class="K3Term ball-container1"><b class="b4">4</b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105604" class="odds"><span class="c-txt3">2</span></td>-->
                        <!--<td data-id="105604" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105605" class="name">-->
                            <!--<div class="K3Term ball-container1"><b class="b5">5</b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105605" class="odds"><span class="c-txt3">2</span></td>-->
                        <!--<td data-id="105605" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105606" class="name">-->
                            <!--<div class="K3Term ball-container1"><b class="b6">6</b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105606" class="odds"><span class="c-txt3">2</span></td>-->
                        <!--<td data-id="105606" class="amount"><input type="text"></td>-->
                        <!--<td data-id="106102" class="name">小</td>-->
                        <!--<td data-id="106102" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="106102" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
                <Mspk10LmpProduct_2 v-for="(item,index) in info.product_2_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_2>
                <!--<table class="u-table2 mt5">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="9">围骰、全骰</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--<td data-id="105701" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b1"></b><b-->
                                    <!--class="b1"></b><b class="b1"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105701" class="odds"><span class="c-txt3">168</span>-->
                        <!--</td>-->
                        <!--<td data-id="105701" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105702" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b2"></b><b-->
                                    <!--class="b2"></b><b class="b2"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105702" class="odds"><span class="c-txt3">168</span>-->
                        <!--</td>-->
                        <!--<td data-id="105702" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105703" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b3"></b><b-->
                                    <!--class="b3"></b><b class="b3"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105703" class="odds"><span class="c-txt3">168</span>-->
                        <!--</td>-->
                        <!--<td data-id="105703" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105704" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b4"></b><b-->
                                    <!--class="b4"></b><b class="b4"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105704" class="odds"><span class="c-txt3">168</span>-->
                        <!--</td>-->
                        <!--<td data-id="105704" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105705" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b5"></b><b-->
                                    <!--class="b5"></b><b class="b5"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105705" class="odds"><span class="c-txt3">168</span>-->
                        <!--</td>-->
                        <!--<td data-id="105705" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105706" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b6"></b><b-->
                                    <!--class="b6"></b><b class="b6"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105706" class="odds"><span class="c-txt3">168</span>-->
                        <!--</td>-->
                        <!--<td data-id="105706" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="106201" class="name">全骰</td>-->
                        <!--<td data-id="106201" class="odds"><span class="c-txt3">26</span>-->
                        <!--</td>-->
                        <!--<td data-id="106201" class="amount"><input type="text"></td>-->
                        <!--<td colspan="6" class="name not-event"></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
                <Mspk10LmpProduct_3 v-for="(item,index) in info.product_2_2" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_3>
                <!--<table class="u-table2 mt5">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="12">点数</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--<td data-id="105804" class="name">4点</td>-->
                        <!--<td data-id="105804" class="odds"><span class="c-txt3">58</span>-->
                        <!--</td>-->
                        <!--<td data-id="105804" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105805" class="name">5点</td>-->
                        <!--<td data-id="105805" class="odds"><span class="c-txt3">21</span>-->
                        <!--</td>-->
                        <!--<td data-id="105805" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105806" class="name">6点</td>-->
                        <!--<td data-id="105806" class="odds"><span class="c-txt3">18</span>-->
                        <!--</td>-->
                        <!--<td data-id="105806" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105807" class="name">7点</td>-->
                        <!--<td data-id="105807" class="odds"><span class="c-txt3">12.5</span>-->
                        <!--</td>-->
                        <!--<td data-id="105807" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105808" class="name">8点</td>-->
                        <!--<td data-id="105808" class="odds"><span class="c-txt3">9</span></td>-->
                        <!--<td data-id="105808" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105809" class="name">9点</td>-->
                        <!--<td data-id="105809" class="odds"><span class="c-txt3">7</span></td>-->
                        <!--<td data-id="105809" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105810" class="name">10点</td>-->
                        <!--<td data-id="105810" class="odds"><span class="c-txt3">7</span></td>-->
                        <!--<td data-id="105810" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105811" class="name">11点</td>-->
                        <!--<td data-id="105811" class="odds"><span class="c-txt3">7</span></td>-->
                        <!--<td data-id="105811" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105812" class="name">12点</td>-->
                        <!--<td data-id="105812" class="odds"><span class="c-txt3">7</span></td>-->
                        <!--<td data-id="105812" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105813" class="name">13点</td>-->
                        <!--<td data-id="105813" class="odds"><span class="c-txt3">9</span></td>-->
                        <!--<td data-id="105813" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105814" class="name">14点</td>-->
                        <!--<td data-id="105814" class="odds"><span class="c-txt3">12.5</span>-->
                        <!--</td>-->
                        <!--<td data-id="105814" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105815" class="name">15点</td>-->
                        <!--<td data-id="105815" class="odds"><span class="c-txt3">18</span>-->
                        <!--</td>-->
                        <!--<td data-id="105815" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105816" class="name">16点</td>-->
                        <!--<td data-id="105816" class="odds"><span class="c-txt3">21</span>-->
                        <!--</td>-->
                        <!--<td data-id="105816" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105817" class="name">17点</td>-->
                        <!--<td data-id="105817" class="odds"><span class="c-txt3">58</span>-->
                        <!--</td>-->
                        <!--<td data-id="105817" class="amount"><input type="text"></td>-->
                        <!--<td colspan="6" class="name not-event"></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
                <Mspk10LmpProduct_4 v-for="(item,index) in info.product_2_3" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_4>
                <!--<table class="u-table2 mt5">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="9">长牌</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--<td data-id="105912" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b1"></b><b-->
                                    <!--class="b2"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105912" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105912" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105913" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b1"></b><b-->
                                    <!--class="b3"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105913" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105913" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105914" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b1"></b><b-->
                                    <!--class="b4"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105914" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105914" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105915" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b1"></b><b-->
                                    <!--class="b5"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105915" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105915" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105916" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b1"></b><b-->
                                    <!--class="b6"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105916" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105916" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105923" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b2"></b><b-->
                                    <!--class="b3"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105923" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105923" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105924" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b2"></b><b-->
                                    <!--class="b4"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105924" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105924" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105925" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b2"></b><b-->
                                    <!--class="b5"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105925" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105925" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105926" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b2"></b><b-->
                                    <!--class="b6"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105926" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105926" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105934" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b3"></b><b-->
                                    <!--class="b4"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105934" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105934" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105935" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b3"></b><b-->
                                    <!--class="b5"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105935" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105935" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105936" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b3"></b><b-->
                                    <!--class="b6"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105936" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105936" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="105945" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b4"></b><b-->
                                    <!--class="b5"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105945" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105945" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105946" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b4"></b><b-->
                                    <!--class="b6"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105946" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105946" class="amount"><input type="text"></td>-->
                        <!--<td data-id="105956" class="name">-->
                            <!--<div class="K3Term ball-container2"><b class="b5"></b><b-->
                                    <!--class="b6"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="105956" class="odds"><span class="c-txt3">6</span></td>-->
                        <!--<td data-id="105956" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
                <Mspk10LmpProduct_4 v-for="(item,index) in info.product_2_4" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_4>
                <!--<table class="u-table2 mt5">-->
                    <!--<thead>-->
                    <!--<tr>-->
                        <!--<th colspan="9">短牌</th>-->
                    <!--</tr>-->
                    <!--</thead>-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--<td data-id="106011" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b1"></b><b-->
                                    <!--class="b1"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="106011" class="odds"><span class="c-txt3">11</span>-->
                        <!--</td>-->
                        <!--<td data-id="106011" class="amount"><input type="text"></td>-->
                        <!--<td data-id="106022" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b2"></b><b-->
                                    <!--class="b2"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="106022" class="odds"><span class="c-txt3">11</span>-->
                        <!--</td>-->
                        <!--<td data-id="106022" class="amount"><input type="text"></td>-->
                        <!--<td data-id="106033" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b3"></b><b-->
                                    <!--class="b3"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="106033" class="odds"><span class="c-txt3">11</span>-->
                        <!--</td>-->
                        <!--<td data-id="106033" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                        <!--<td data-id="106044" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b4"></b><b-->
                                    <!--class="b4"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="106044" class="odds"><span class="c-txt3">11</span>-->
                        <!--</td>-->
                        <!--<td data-id="106044" class="amount"><input type="text"></td>-->
                        <!--<td data-id="106055" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b5"></b><b-->
                                    <!--class="b5"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="106055" class="odds"><span class="c-txt3">11</span>-->
                        <!--</td>-->
                        <!--<td data-id="106055" class="amount"><input type="text"></td>-->
                        <!--<td data-id="106066" class="name">-->
                            <!--<div class="K3Term ball-container3"><b class="b6"></b><b-->
                                    <!--class="b6"></b></div>-->
                        <!--</td>-->
                        <!--<td data-id="106066" class="odds"><span class="c-txt3">11</span>-->
                        <!--</td>-->
                        <!--<td data-id="106066" class="amount"><input type="text"></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
            </div>
        </div>
    </div>

    <!--<div>-->
        <!--<div>-->
            <!--<div class="cont-col3-bd">-->
                <!--&lt;!&ndash;{{info.product_1}}&ndash;&gt;-->
                <!--<Mspk10LmpProduct_1 v-for="(item,index) in info.product_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_1>-->
                <!--<table class="cont-list1">-->
                    <!--&lt;!&ndash;{{info.product_2_1}}&ndash;&gt;-->
                    <!--<tbody>-->
                    <!--<tr>-->
                        <!--&lt;!&ndash;{{info.product_2_2}}&ndash;&gt;-->
                        <!--<Mspk10LmpProduct_2 v-for="(item,index) in info.product_2_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_2>-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3" v-for="item in Mspk10LmpName"&ndash;&gt;-->
                                        <!--&lt;!&ndash;v-if="item.id===142 && isNaN(parseInt(item.code))">{{item.name}}&ndash;&gt;-->
                                    <!--&lt;!&ndash;</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr v-for='(item,index) in Mspk10LmpInput'&ndash;&gt;-->
                                    <!--&lt;!&ndash;v-if="item.playCateId===142 && isNaN(parseInt(item.code))">&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="name">{{item.name}}</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="odds">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<span class="c-txt3">{{item.odds}}</span>&ndash;&gt;-->
                                    <!--&lt;!&ndash;</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="amount">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<input type="text" ref="inp">&ndash;&gt;-->
                                    <!--&lt;!&ndash;</td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3" v-for="item in Mspk10LmpName"&ndash;&gt;-->
                                        <!--&lt;!&ndash;v-if="item.id===143 && isNaN(parseInt(item.code))">{{item.name}}&ndash;&gt;-->
                                    <!--&lt;!&ndash;</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr v-for='(item,index) in Mspk10LmpInput'&ndash;&gt;-->
                                    <!--&lt;!&ndash;v-if="item.playCateId===143 && isNaN(parseInt(item.code))">&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="name">{{item.name}}</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="odds">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<span class="c-txt3">{{item.odds}}</span>&ndash;&gt;-->
                                    <!--&lt;!&ndash;</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="amount">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<input type="text" ref="inp">&ndash;&gt;-->
                                    <!--&lt;!&ndash;</td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3" v-for="item in Mspk10LmpName"&ndash;&gt;-->
                                        <!--&lt;!&ndash;v-if="item.id===144 && isNaN(parseInt(item.code))">{{item.name}}&ndash;&gt;-->
                                    <!--&lt;!&ndash;</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr v-for='(item,index) in Mspk10LmpInput'&ndash;&gt;-->
                                    <!--&lt;!&ndash;v-if="item.playCateId===144 && isNaN(parseInt(item.code))">&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="name">{{item.name}}</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="odds">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<span class="c-txt3">{{item.odds}}</span>&ndash;&gt;-->
                                    <!--&lt;!&ndash;</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="amount">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<input type="text" ref="inp">&ndash;&gt;-->
                                    <!--&lt;!&ndash;</td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                            <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                                <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<th colspan="3" v-for="item in Mspk10LmpName"&ndash;&gt;-->
                                        <!--&lt;!&ndash;v-if="item.id===145 && isNaN(parseInt(item.code))">{{item.name}}&ndash;&gt;-->
                                    <!--&lt;!&ndash;</th>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                                <!--&lt;!&ndash;<tr v-for='(item,index) in Mspk10LmpInput'&ndash;&gt;-->
                                    <!--&lt;!&ndash;v-if="item.playCateId===145 && isNaN(parseInt(item.code))">&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="name">{{item.name}}</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="odds">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<span class="c-txt3">{{item.odds}}</span>&ndash;&gt;-->
                                    <!--&lt;!&ndash;</td>&ndash;&gt;-->
                                    <!--&lt;!&ndash;<td :data-id="item.id" class="amount">&ndash;&gt;-->
                                        <!--&lt;!&ndash;<input type="text" ref="inp">&ndash;&gt;-->
                                    <!--&lt;!&ndash;</td>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                                <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                            <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->


                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                        <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<th colspan="3">冠军</th>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014101" class="name">大</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014101" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014101" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014102" class="name">小</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014102" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014102" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014103" class="name">单</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014103" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014103" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014104" class="name">双</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014104" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014104" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014105" class="name">龙</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014105" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014105" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014106" class="name">虎</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014106" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014106" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                        <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<th colspan="3">亚军</th>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014201" class="name">大</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014201" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014201" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014202" class="name">小</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014202" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014202" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014203" class="name">单</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014203" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014203" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014204" class="name">双</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014204" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014204" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014205" class="name">龙</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014205" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014205" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014206" class="name">虎</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014206" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014206" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                        <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<th colspan="3">第三名</th>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014301" class="name">大</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014301" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014301" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014302" class="name">小</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014302" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014302" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014303" class="name">单</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014303" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014303" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014304" class="name">双</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014304" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014304" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014305" class="name">龙</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014305" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014305" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014306" class="name">虎</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014306" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014306" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                        <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<th colspan="3">第四名</th>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014401" class="name">大</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014401" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014401" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014402" class="name">小</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014402" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014402" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014403" class="name">单</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014403" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014403" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014404" class="name">双</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014404" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014404" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014405" class="name">龙</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014405" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014405" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014406" class="name">虎</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014406" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014406" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<table class="u-table2">&ndash;&gt;-->
                        <!--&lt;!&ndash;<thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<th colspan="3">第五名</th>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</thead>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014501" class="name">大</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014501" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014501" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014502" class="name">小</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014502" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014502" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014503" class="name">单</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014503" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014503" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014504" class="name">双</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014504" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014504" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014505" class="name">龙</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014505" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014505" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014506" class="name">虎</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014506" class="odds"><span class="c-txt3">1.995</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;<td data-id="8014506" class="amount"><input type="text"&ndash;&gt;-->
                        <!--&lt;!&ndash;style="">&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tr>&ndash;&gt;-->
                        <!--&lt;!&ndash;</tbody>&ndash;&gt;-->
                        <!--&lt;!&ndash;</table>&ndash;&gt;-->
                        <!--&lt;!&ndash;</td>&ndash;&gt;-->
                    <!--</tr>-->
                    <!--</tbody>-->
                <!--</table>-->
                <!--<div style="margin-top: 10px"></div>-->
                <!--<XyddXyddProduct_3 v-for="(item,index) in info.product_2_2" :info="{ productId: item, productInfo: info}" :key="index"></XyddXyddProduct_3>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
</template>

<script>
    // 引入第一种商品
    // import Mspk10LmpProduct_1 from './Mspk10LmpProduct_1/Mspk10LmpProduct_1'
    import Mspk10LmpProduct_1 from './Jsk3DxtbProduct_1/Mspk10LmpProduct_1'
    // 引入第二种商品
    // import Mspk10LmpProduct_2 from './XyddXyddProduct_2/Mspk10LmpProduct_1'
    import Mspk10LmpProduct_2 from './Jsk3DxtbProduct_2/Mspk10LmpProduct_1'

    // 引入第三种商品
    // import Mspk10LmpProduct_1 from './Mspk10LmpProduct_1/Mspk10LmpProduct_1'
    import Mspk10LmpProduct_3 from './Jsk3DxtbProduct_3/Mspk10LmpProduct_1'

    // 引入第四种商品
    // import Mspk10LmpProduct_2 from './XyddXyddProduct_2/Mspk10LmpProduct_1'
    // import Mspk10LmpProduct_2 from './Jsk3DxtbProduct_2/Mspk10LmpProduct_1'
    import Mspk10LmpProduct_4 from './Jsk3DxtbProduct_4/Mspk10LmpProduct_1'


    import XyddXyddProduct_3 from './XyddXyddProduct_3/Mspk10LmpProduct_1'
    export default {
        name: "mspk10-lmp-product",
        props: {
            info: Object
        },
        components: {
            Mspk10LmpProduct_1,
            Mspk10LmpProduct_2,
            XyddXyddProduct_3,
            Mspk10LmpProduct_3,
            Mspk10LmpProduct_4
        }
    }
</script>

<style scoped>
    /* 表格之间的空间*/
    .cont-list1 {
        margin-top: 10px;
        width: 100%
    }
    /* 表格之间的空间结束　*/
    .K3Term b {
        display: block;
        height: 27px;
        text-indent: -99999px;
        width: 27px;
        background: url(/static/game/images/ball/ball_4.png) no-repeat scroll 0 0;
        float: left
    }

    .K3Term b.b1 {
        background-position: 0 0
    }

    .K3Term b.b2 {
        background-position: 0 -27px
    }

    .K3Term b.b3 {
        background-position: 0 -54px
    }

    .K3Term b.b4 {
        background-position: 0 -81px
    }

    .K3Term b.b5 {
        background-position: 0 -108px
    }

    .K3Term b.b6 {
        background-position: 0 -135px
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

    .button-hover, .button:focus, .button:hover {
        background-image: linear-gradient(transparent, rgba(0, 0, 0, .05) 40%, rgba(0, 0, 0, .1))
    }

    .button:focus {
        outline: 0 none
    }

    .ball-container1 {
        width: 27px;
        margin: 1px auto 0
    }

    .ball-container2 {
        width: 54px;
        margin: 1px auto 0
    }

    .ball-container3 {
        width: 81px;
        margin: 1px auto 0
    }

    .bet-modal.el-dialog--small {
        width: 500px
    }

    .bet-modal .el-dialog__body {
        padding: 20px 20px 10px
    }

    .bet-modal input.invalid {
        border: 2px solid red;
        padding: 2px;
        border-radius: 2px
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

    .skin_blue .pay-dialog .el-dialog__title, .skin_blue .pay-dialog .el-message-box__title, .skin_blue.v2-dialog .el-dialog__title, .skin_blue.v2-dialog .el-message-box__title {
        background: #4274b3
    }
    .pay-confirm .el-dialog__title {
        display: none !important
    }

    .pay-dialog .el-dialog__title, .pay-dialog .el-message-box__title, .v2-dialog .el-dialog__title, .v2-dialog .el-message-box__title {
        color: #fff;
        padding: 6px 20px 8px 10px;
        line-height: 1.2;
        display: inline-block
    }
    .el-dialog__wrapper {
        overflow: auto !important
    }
</style>