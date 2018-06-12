<template>
    <div>
        <div>
            <div class="cont-col3-bd">
                <table class="cont-list1 clearfix">
                    <tbody>
                    <tr>
                        <!--<Mspk10LmpProduct_2 v-for="(item,index) in info.product_2_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10LmpProduct_2>-->
                        <Mspk10SolProduct_1 v-for="(item,index) in info.product_2_1" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10SolProduct_1>
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3">冠军</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014107" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014107" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014107" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014108" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014108" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014108" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014109" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014109" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014109" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014110" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014110" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014110" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014111" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014111" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014111" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014112" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014112" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014112" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014113" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014113" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014113" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014114" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014114" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014114" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014115" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014115" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014115" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014116" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014116" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014116" class="amount"><input type="text"></td>-->
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
                                    <!--<td data-id="8014207" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014207" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014207" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014208" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014208" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014208" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014209" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014209" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014209" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014210" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014210" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014210" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014211" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014211" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014211" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014212" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014212" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014212" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014213" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014213" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014213" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014214" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014214" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014214" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014215" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014215" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014215" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014216" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014216" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014216" class="amount"><input type="text"></td>-->
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
                                    <!--<td data-id="8014307" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014307" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014307" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014308" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014308" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014308" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014309" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014309" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014309" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014310" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014310" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014310" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014311" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014311" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014311" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014312" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014312" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014312" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014313" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014313" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014313" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014314" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014314" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014314" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014315" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014315" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014315" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014316" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014316" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014316" class="amount"><input type="text"></td>-->
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
                                    <!--<td data-id="8014407" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014407" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014407" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014408" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014408" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014408" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014409" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014409" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014409" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014410" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014410" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014410" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014411" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014411" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014411" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014412" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014412" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014412" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014413" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014413" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014413" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014414" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014414" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014414" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014415" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014415" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014415" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014416" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014416" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014416" class="amount"><input type="text"></td>-->
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
                                    <!--<td data-id="8014507" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014507" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014507" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014508" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014508" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014508" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014509" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014509" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014509" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014510" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014510" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014510" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014511" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014511" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014511" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014512" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014512" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014512" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014513" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014513" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014513" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014514" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014514" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014514" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014515" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014515" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014515" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014516" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014516" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014516" class="amount"><input type="text"></td>-->
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
                        <Mspk10SolProduct_1 v-for="(item,index) in info.product_2_2" :info="{ productId: item, productInfo: info}" :key="index"></Mspk10SolProduct_1>
                        <!--<td>-->
                            <!--<table class="u-table2">-->
                                <!--<thead>-->
                                <!--<tr>-->
                                    <!--<th colspan="3">第六名</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014607" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014607" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014607" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014608" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014608" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014608" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014609" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014609" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014609" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014610" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014610" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014610" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014611" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014611" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014611" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014612" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014612" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014612" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014613" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014613" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014613" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014614" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014614" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014614" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014615" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014615" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014615" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014616" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014616" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014616" class="amount"><input type="text"></td>-->
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
                                    <!--<td data-id="8014707" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014707" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014707" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014708" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014708" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014708" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014709" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014709" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014709" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014710" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014710" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014710" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014711" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014711" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014711" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014712" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014712" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014712" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014713" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014713" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014713" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014714" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014714" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014714" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014715" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014715" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014715" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014716" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014716" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014716" class="amount"><input type="text"></td>-->
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
                                    <!--<td data-id="8014807" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014807" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014807" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014808" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014808" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014808" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014809" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014809" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014809" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014810" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014810" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014810" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014811" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014811" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014811" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014812" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014812" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014812" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014813" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014813" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014813" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014814" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014814" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014814" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014815" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014815" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014815" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014816" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014816" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014816" class="amount"><input type="text"></td>-->
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
                                    <!--<td data-id="8014907" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8014907" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014907" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014908" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8014908" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014908" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014909" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8014909" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014909" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014910" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8014910" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014910" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014911" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8014911" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014911" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014912" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8014912" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014912" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014913" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8014913" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014913" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014914" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8014914" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014914" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014915" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8014915" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014915" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8014916" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8014916" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8014916" class="amount"><input type="text"></td>-->
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
                                    <!--<td data-id="8015007" class="name"><span class="ball c-n1"></span></td>-->
                                    <!--<td data-id="8015007" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015007" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015008" class="name"><span class="ball c-n2"></span></td>-->
                                    <!--<td data-id="8015008" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015008" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015009" class="name"><span class="ball c-n3"></span></td>-->
                                    <!--<td data-id="8015009" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015009" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015010" class="name"><span class="ball c-n4"></span></td>-->
                                    <!--<td data-id="8015010" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015010" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015011" class="name"><span class="ball c-n5"></span></td>-->
                                    <!--<td data-id="8015011" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015011" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015012" class="name"><span class="ball c-n6"></span></td>-->
                                    <!--<td data-id="8015012" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015012" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015013" class="name"><span class="ball c-n7"></span></td>-->
                                    <!--<td data-id="8015013" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015013" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015014" class="name"><span class="ball c-n8"></span></td>-->
                                    <!--<td data-id="8015014" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015014" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015015" class="name"><span class="ball c-n9"></span></td>-->
                                    <!--<td data-id="8015015" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015015" class="amount"><input type="text"></td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td data-id="8015016" class="name"><span class="ball c-n10"></span></td>-->
                                    <!--<td data-id="8015016" class="odds"><span class="c-txt3">9.95</span></td>-->
                                    <!--<td data-id="8015016" class="amount"><input type="text"></td>-->
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
    // 单号 1~10只有一种商品
    import Mspk10SolProduct_1 from './Mspk10SolProduct_1/Mspk10SolProduct_1.vue'

    export default {
        name: "mspk10-sol-product",
        props: {
            info: Object
        },
        components: {
            Mspk10SolProduct_1,
        }
    }
</script>

<style scoped>
    table {
        border-collapse: collapse;
        border-spacing: 0
    }
    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
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

    .u-table2 .amount>input {
        width: 80%;
        min-width: 40px;
        height: 15px;
        background: url(/src/assets/userimg/043contMain_sol/images/skin/blue/text_input.gif) repeat-x left top;
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
        background: url(/src/assets/userimg/043contMain_sol/images/skin/blue/text_input.gif) repeat-x left top;
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

    .cont-list1>tbody>tr>td {
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

    #bet-date {
        color: red;
        font-size: 14px;
        padding: 2px 5px;
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px
    }

    #open-date {
        color: #26d026;
        font-size: 14px;
        padding: 2px 5px;
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px
    }
    .page a {
        display: inline-block;
        width: 28px;
        height: 28px;
        line-height: 28px;
        margin: 0 2px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #e2e1e1;
        background: #fff;
        font-size: 14px;
        font-family: arial;
        color: #4c4c4c
    }
    .page a.cur,
    .page a:hover {
        background: #ff3e3e;
        border-color: #ff3e3e;
        color: #fff;
        text-decoration: none
    }
    .page .page-next,
    .page .page-prev {
        width: auto;
        padding: 0 10px
    }
    .page .ipt-page,
    .page span {
        margin: 0 2px;
        vertical-align: middle
    }
    .page .ipt-page {
        width: 28px;
        height: 18px;
        padding: 5px 0;
        text-align: center;
        border: 1px solid #e2e1e1;
        background: #fff
    }
    .bg_yellow {
        background-color: #ffc214!important
    }

    .td_f1 {
        color: #e6b3be
    }

    .hide {
        display: none
    }
    .show {
        display: block
    }
    .mr1 {
        margin-right: 1px
    }
    .mr2 {
        margin-right: 2px
    }
    .not-event {
        cursor: auto!important
    }
    .uipt1-disable {
        background: #e3e3d3!important
    }
    .checkbox_td>input {
        cursor: pointer
    }
    .radio_td {
        cursor: pointer
    }
    .member-info {
        margin: 10px;
        width: 880px
    }
    .skinbtn {
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857;
        margin-bottom: 0;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        width: 100px;
        height: 30px;
        margin: 0 5px
    }
    .pop-detail {
        padding: 20px
    }
    .pop-detail p {
        font-size: 14px;
        line-height: 25px
    }

    .mask {
        display: none;
        position: fixed;
        z-index: 998;
        width: 100%;
        top: 0;
        bottom: 0;
        background: #000;
        opacity: .5
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
    .btn-pop-close {
        position: absolute;
        right: 10px;
        top: 6px;
        line-height: 1;
        color: #000;
        font-size: 18px;
        font-family: '\5b8b\4f53'
    }
    .btn-pop-close:hover {
        text-decoration: none
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
    .skin_blue .lotterys .show>a:hover {
        color: #143679;
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%)
    }
    .skin_blue .lotterys.menu-editMode .show>a:hover {
        background: 0 0;
        color: #fff
    }
    .skin_blue .header-top {
        background: url(/src/assets/userimg/043contMain_sol/images/skin/blue/main_bg.jpg) no-repeat 0 0
    }
    .skin_blue #skinPanel:hover .skin_blue .skinHover ul,
    .skin_blue #skinPanel:hover ul,
    .skin_blue .skinHover {
        background: #234b95
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
    .skin_blue li.link:hover {
        background: #346fb9;
        background: -moz-linear-gradient(top, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%);
        background: linear-gradient(to bottom, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%)
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

    .skin_blue .header .lotterys .more-game.selected>a,
    .skin_blue .header .lotterys .more-game:hover>a,
    .skin_blue .header .lotterys.menu-editMode .more-game>a {
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        border-bottom: 1px solid #e6e6e6;
        color: #143679
    }
    .skin_blue .header .lotterys .more-game:hover>a,
    .skin_blue .header .lotterys.menu-editMode .more-game>a {
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
    .menu1 .T_KL8 {
        width: 320px;
        word-wrap: break-word;
        display: inline-block
    }
    /*不能动*/
    .ball {
        display: inline-block;
        vertical-align: middle;
        background: url(/static/game/images/ball/ball-sprites.png) no-repeat 0 0
    }
    .r-9 {
        width: 39px;
        height: 43px
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
    .c-b2,
    .c-g2,
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
    .c-n1,
    .c-n10,
    .c-n2,
    .c-n3,
    .c-n4,
    .c-n5,
    .c-n6,
    .c-n7,
    .c-n8,
    .c-n9 {
        width: 23px;
        height: 23px
    }
    /*不能动*/
    .c-n1 {
        background-position: -142px -138px
    }

    .c-n2 {
        background-position: -142px 0
    }

    .c-n3 {
        background-position: -142px -115px
    }

    .c-n4 {
        background-position: -142px -184px
    }

    .c-n5 {
        background-position: -142px -92px
    }

    .c-n6 {
        background-position: -142px -161px
    }

    .c-n7 {
        background-position: -142px -207px
    }

    .c-n8 {
        background-position: -142px -23px
    }

    .c-n9 {
        background-position: -142px -69px
    }

    .c-n10 {
        background-position: -142px -46px
    }
    /*不能*/
</style>