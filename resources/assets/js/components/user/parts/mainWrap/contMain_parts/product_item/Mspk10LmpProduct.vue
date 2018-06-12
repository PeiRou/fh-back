<template>
    <div>
        <div>
            <div class="cont-col3-bd">
                <!--{{info.product_1}}-->
                <Mspk10LmpProduct_1 v-for="(item,index) in info.product_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_1>
                <table class="cont-list1">
                    <!--{{info.product_2_1}}-->
                    <tbody>
                    <tr>
                        <!--{{info.product_2_2}}-->
                        <Mspk10LmpProduct_2 v-for="(item,index) in info.product_2_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_2>
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===142 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===142 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===143 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===143 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===144 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===144 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===145 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===145 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->


                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">冠军</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014101" class="name">大</td>-->
                        <!--<td data-id="8014101" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014101" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014102" class="name">小</td>-->
                        <!--<td data-id="8014102" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014102" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014103" class="name">单</td>-->
                        <!--<td data-id="8014103" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014103" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014104" class="name">双</td>-->
                        <!--<td data-id="8014104" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014104" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014105" class="name">龙</td>-->
                        <!--<td data-id="8014105" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014105" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014106" class="name">虎</td>-->
                        <!--<td data-id="8014106" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014106" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">亚军</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014201" class="name">大</td>-->
                        <!--<td data-id="8014201" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014201" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014202" class="name">小</td>-->
                        <!--<td data-id="8014202" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014202" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014203" class="name">单</td>-->
                        <!--<td data-id="8014203" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014203" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014204" class="name">双</td>-->
                        <!--<td data-id="8014204" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014204" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014205" class="name">龙</td>-->
                        <!--<td data-id="8014205" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014205" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014206" class="name">虎</td>-->
                        <!--<td data-id="8014206" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014206" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">第三名</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014301" class="name">大</td>-->
                        <!--<td data-id="8014301" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014301" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014302" class="name">小</td>-->
                        <!--<td data-id="8014302" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014302" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014303" class="name">单</td>-->
                        <!--<td data-id="8014303" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014303" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014304" class="name">双</td>-->
                        <!--<td data-id="8014304" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014304" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014305" class="name">龙</td>-->
                        <!--<td data-id="8014305" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014305" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014306" class="name">虎</td>-->
                        <!--<td data-id="8014306" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014306" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">第四名</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014401" class="name">大</td>-->
                        <!--<td data-id="8014401" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014401" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014402" class="name">小</td>-->
                        <!--<td data-id="8014402" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014402" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014403" class="name">单</td>-->
                        <!--<td data-id="8014403" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014403" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014404" class="name">双</td>-->
                        <!--<td data-id="8014404" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014404" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014405" class="name">龙</td>-->
                        <!--<td data-id="8014405" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014405" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014406" class="name">虎</td>-->
                        <!--<td data-id="8014406" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014406" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">第五名</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014501" class="name">大</td>-->
                        <!--<td data-id="8014501" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014501" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014502" class="name">小</td>-->
                        <!--<td data-id="8014502" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014502" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014503" class="name">单</td>-->
                        <!--<td data-id="8014503" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014503" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014504" class="name">双</td>-->
                        <!--<td data-id="8014504" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014504" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014505" class="name">龙</td>-->
                        <!--<td data-id="8014505" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014505" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014506" class="name">虎</td>-->
                        <!--<td data-id="8014506" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014506" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                    </tr>
                    </tbody>
                </table>
                <table class="cont-list1">
                    <tbody>
                    <tr>

                        <!--之后要循环的第二排-->
                        <Mspk10LmpProduct_2 v-for="(item,index) in info.product_2_2" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_2>
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===146 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===146 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===147 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===147 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===148 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===148 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===149 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===149 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3" v-for="item in Mspk10LmpName"-->
                                        <!--v-if="item.id===150 && isNaN(parseInt(item.code))">{{item.name}}-->
                                    <!--</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr v-for='(item,index) in Mspk10LmpInput'-->
                                    <!--v-if="item.playCateId===150 && isNaN(parseInt(item.code))">-->
                                    <!--<td :data-id="item.id" class="name">{{item.name}}</td>-->
                                    <!--<td :data-id="item.id" class="odds">-->
                                        <!--<span class="c-txt3">{{item.odds}}</span>-->
                                    <!--</td>-->
                                    <!--<td :data-id="item.id" class="amount">-->
                                        <!--<input type="text" ref="inp">-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</td>-->
                        <!--之后要循环的第二排结束-->



                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">第六名</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014601" class="name">大</td>-->
                        <!--<td data-id="8014601" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014601" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014602" class="name">小</td>-->
                        <!--<td data-id="8014602" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014602" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014603" class="name">单</td>-->
                        <!--<td data-id="8014603" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014603" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014604" class="name">双</td>-->
                        <!--<td data-id="8014604" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014604" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">第七名</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014701" class="name">大</td>-->
                        <!--<td data-id="8014701" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014701" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014702" class="name">小</td>-->
                        <!--<td data-id="8014702" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014702" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014703" class="name">单</td>-->
                        <!--<td data-id="8014703" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014703" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014704" class="name">双</td>-->
                        <!--<td data-id="8014704" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014704" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">第八名</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014801" class="name">大</td>-->
                        <!--<td data-id="8014801" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014801" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014802" class="name">小</td>-->
                        <!--<td data-id="8014802" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014802" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014803" class="name">单</td>-->
                        <!--<td data-id="8014803" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014803" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014804" class="name">双</td>-->
                        <!--<td data-id="8014804" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014804" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">第九名</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8014901" class="name">大</td>-->
                        <!--<td data-id="8014901" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014901" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014902" class="name">小</td>-->
                        <!--<td data-id="8014902" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014902" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014903" class="name">单</td>-->
                        <!--<td data-id="8014903" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014903" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8014904" class="name">双</td>-->
                        <!--<td data-id="8014904" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8014904" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--<table class="u-table2">-->
                        <!--<thead>-->
                        <!--<tr>-->
                        <!--<th colspan="3">第十名</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                        <!--<td data-id="8015001" class="name">大</td>-->
                        <!--<td data-id="8015001" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8015001" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8015002" class="name">小</td>-->
                        <!--<td data-id="8015002" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8015002" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8015003" class="name">单</td>-->
                        <!--<td data-id="8015003" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8015003" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--<tr>-->
                        <!--<td data-id="8015004" class="name">双</td>-->
                        <!--<td data-id="8015004" class="odds"><span class="c-txt3">1.995</span>-->
                        <!--</td>-->
                        <!--<td data-id="8015004" class="amount"><input type="text"-->
                        <!--style="">-->
                        <!--</td>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                        <!--</table>-->
                        <!--</td>-->
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    //　引入第一种商品
    import Mspk10LmpProduct_1 from './Mspk10LmpProduct_1/Mspk10LmpProduct_1'
    //　引入第二种商品
    import Mspk10LmpProduct_2 from './Mspk10LmpProduct_2/Mspk10LmpProduct_2'
    export default {
        name: "mspk10-lmp-product",
        props: {
            info: Object
        },
        components: {
            Mspk10LmpProduct_1,
            Mspk10LmpProduct_2: Mspk10LmpProduct_2,
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
</style>