<template>
    <table class="u-table2 table_ball">


            <Mspk10LmpProduct_1_title v-for="(item,index) in info.productInfo.productTitle" v-if="item.id === info.productId.playCateId && isNaN(parseInt(item.code))" :info="item" :key="item.id"></Mspk10LmpProduct_1_title>
            <!--<th colspan="3" v-for="item in Mspk10LmpName" v-if="item.id===140 && isNaN(parseInt(item.code))">{{item.name}}</th>-->
        <!--{{info.productInfo.productContent}}-->

        <!--这里通过 item.code不等于这些值 去除大单,大双,小单,小双-->
        <!--{{info.productInfo.productContent}}-->
        <!--{{info.productId.playCateId}}-->
        <!--{{info.productInfo.productContent}}-->

        <!--因为这里要纵向排列,所以我们这里要一个一个加上去-->

        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '1'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '21'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '41'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '61'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '2'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '22'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '42'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '62'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '3'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '23'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '43'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '63'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '4'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '24'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '44'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '64'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '5'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '25'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '45'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '65'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '6'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '26'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '46'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '66'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '7'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '27'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '47'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '67'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '8'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '28'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '48'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '68'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '9'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '29'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '49'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '69'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '10'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '30'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '50'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '70'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '11'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '31'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '51'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '71'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '12'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '32'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '52'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '72'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '13'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '33'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '53'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '73'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '14'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '34'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '54'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '74'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '15'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '35'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '55'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '75'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '16'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '36'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '56'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '76'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '17'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '37'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '57'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '77'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '18'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '38'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '58'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '78'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '19'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '39'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '59'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '79'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '20'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '40'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '60'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.code === '80'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <!---->
        <!--<tr v-for='(item,index) in Mspk10LmpInput' v-if="item.playCateId===140 && isNaN(parseInt(item.code))"  style="float:left; width: 25%">-->
        <!--<td :data-id="item.id" class="name" style="width: 8.7%">{{item.name}}</td>-->
        <!--<td :data-id="item.id" class="odds" style="width: 7.5%">-->
        <!--<span class="c-txt3">{{item.odds}}</span>-->
        <!--</td>-->
        <!--<td :data-id="item.id" class="amount" style="width: 9.3%">-->
        <!--<input type="text" ref="inp">-->
        <!--</td>-->
        <!--</tr>-->
    </table>
    <!--<table class="u-table2">-->
    <!--<thead>-->
    <!--<tr>-->
    <!--<Mspk10LmpProduct_1_title v-for="item in Mspk10LmpName"-->
    <!--v-if="item.id===140 && isNaN(parseInt(item.code))"-->
    <!--:info="item" :key="item.id"></Mspk10LmpProduct_1_title>-->
    <!--&lt;!&ndash;<th colspan="3" v-for="item in Mspk10LmpName" v-if="item.id===140 && isNaN(parseInt(item.code))">{{item.name}}</th>&ndash;&gt;-->
    <!--</tr>-->
    <!--</thead>-->
    <!--<Mspk10LmpProduct_1_content v-for="item in Mspk10LmpInput"-->
    <!--v-if="item.playCateId===140 && isNaN(parseInt(item.code))"-->
    <!--:info="item" :key="item.id"></Mspk10LmpProduct_1_content>-->
    <!--&lt;!&ndash;<tr v-for='(item,index) in Mspk10LmpInput' v-if="item.playCateId===140 && isNaN(parseInt(item.code))"  style="float:left; width: 25%">&ndash;&gt;-->
    <!--&lt;!&ndash;<td :data-id="item.id" class="name" style="width: 8.7%">{{item.name}}</td>&ndash;&gt;-->
    <!--&lt;!&ndash;<td :data-id="item.id" class="odds" style="width: 7.5%">&ndash;&gt;-->
    <!--&lt;!&ndash;<span class="c-txt3">{{item.odds}}</span>&ndash;&gt;-->
    <!--&lt;!&ndash;</td>&ndash;&gt;-->
    <!--&lt;!&ndash;<td :data-id="item.id" class="amount" style="width: 9.3%">&ndash;&gt;-->
    <!--&lt;!&ndash;<input type="text" ref="inp">&ndash;&gt;-->
    <!--&lt;!&ndash;</td>&ndash;&gt;-->
    <!--&lt;!&ndash;</tr>&ndash;&gt;-->
    <!--</table>-->

</template>

<script>
    import { mapGetters } from 'vuex'

    // 引入第一种商品名称和内容
    import Mspk10LmpProduct_1_title from './Mspk10LmpProduct_1_parts/Mspk10LmpProduct_1_title'
    import Mspk10LmpProduct_1_content from './Mspk10LmpProduct_1_parts/Mspk10LmpProduct_1_content'

    export default {
        props: {
            info: Object
        },
        components: {
            Mspk10LmpProduct_1_title,
            Mspk10LmpProduct_1_content,
        },
        name: "mspk10-lmp-product_1",
        computed: {
            // 将选中的放入info
            ...mapGetters({
                cartList: 'getCartList'
            }),
            // info_item_selected: function () {
                // 用两个循环完成，第一个加两个属性，第二个改第一个属性
                // 1.在这里加入两个属性　selected(cookie相关)　itemId 例如item8014001(与点击相关)
                // for(let item in this.info.productInfo.productContent) {
                //     默认　没有选中
                    // this.info.productInfo.productContent[item].selected = false
                    // this.info.productInfo.productContent[item].itemId = '{ "item' + this.info.productInfo.productContent[item].id+'": { "changeClass": true }}'
                    //  { "item8014001": { "changeClass": true } } string
                    // this.info.productInfo.productContent[item].itemId = JSON.parse(this.info.productInfo.productContent[item].itemId)
                    // { "item8014001": { "changeClass": true } } object
                    // this.info.productInfo.productContent[item].itemIdName =
                    //     'item' + this.info.productInfo.productContent[item].id
                //
                // }

                // 2.判断购物车中是否有这个item
                // for(let item in this.info.productInfo.productContent) {

                    // 之后，从cookie中判断用户是否有没有结算的东西(cookie还没有写)
                    // console.log(this.info.productInfo.productContent[item])
                    // this.cartList.forEach(cartListItem => {
                        //             console.log(item)
                        // console.log(cartListItem)
                        // 将购物车中有的商品的id的那个值设为true
                        // this.info.productInfo.productContent[item].selected = this.info.productInfo.productContent[item].id === cartListItem.id
                    // })
                // }
                // return this.info
            // }


        },
        // mounted () {
        //     alert('准备将cartList中是否选中的信息加入info')
            // console.log(this.info.productInfo.productContent)

            // }
    }
</script>

<style scoped>
    /*全局样式*/
    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
    }

    .main-body {
        position: absolute;
        overflow-x: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 30px
    }

    .clearfix:after {
        content: "";
        height: 0;
        visibility: hidden;
        display: block;
        clear: both;
    }

    .clearfix {
        zoom: 1
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    .show {
        display: block;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0
    }

    .fl {
        float: left;
    }

    .fr {
        float: right;
    }

    /*新加的*/

    a,
    b,
    blockquote,
    body,
    caption,
    dd,
    div,
    dl,
    dt,
    em,
    form,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    i,
    iframe,
    img,
    input,
    label,
    li,
    object,
    ol,
    p,
    span,
    strong,
    table,
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr,
    u,
    ul {
        padding: 0;
        margin: 0
    }

    table {
        border-collapse: collapse;
        border-spacing: 0
    }

    fieldset,
    img {
        border: 0
    }

    img {
        -ms-interpolation-mode: bicubic
    }

    input,
    select,
    textarea {
        font-family: Arial, Helvetica, sans-serif
    }

    ol,
    ul {
        list-style: none
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-size: 100%
    }

    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
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

    /*位置*/
    .fl {
        float: left
    }

    .fr {
        float: right
    }

    input {
        font-family: '\5FAE\8F6F\96C5\9ED1'
    }

    input:disabled {
        border: 1px solid #ddd;
        background-color: #f5f5f5;
        color: #bebdbd
    }

    /*新加的结束*/

    /*与cont-sider有关的全局性样式*/

    /*与cont-sider有关的全局性样式结束*/

    /*skin_blue相关的全局性样式*/

    /*skin_blue相关的全局性样式结束*/

    /*全局样式结束 将顶部固定在了左上角*/

    /*skin_blue 样式 contMain*/

    /*skin_blue 样式 contMain 结束*/

    /*skin_blue 与 table有关的*/

    /*skin_blue 与table 有关的*/
    /*与中间有关的样式*/
    .main-wrap {
        position: absolute;
        width: 100%;
        top: 137px;
        bottom: 0
    }

    /*与中间有关的样式结束*/

    /*与中间右边有关的样式*/
    .content-wrap {
        min-width: 1038px;
        overflow: hidden;
        font-size: 12px;
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        overflow-y: auto;
        left: 201px
    }

    /*与中间右边有关的样式结束*/

    /*cont_main 相关样式*/

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

    .c-txt3 {
        color: red;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        padding: 0 4px
    }

    .cont-main {
        overflow: hidden;
        width: 839px;
        float: left
    }

    .cont-col3 {
        margin-top: 4px;
        padding: 0 5px 10px
    }

    .cont-col3-hd {
        padding: 8px 0;
        color: #310a07
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

    .count-wrap {
        padding: 0 5px 5px
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

    /*cont_main 相关样式结束*/

    /*与table有关的全局样式*/

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

    .u-header {
        height: 30px;
        border-radius: 4px;
        line-height: 30px;
        font-weight: 700;
        font-size: 13px
    }

    .u-table4 td.f1 {
        background-color: #fff
    }

    /*与table有关的全局样式*/

    /*.skin_blue样式*/

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

    .skin_blue .u-table2 thead th.select {
        background: #dee9f3;
        background: -moz- linear-gradient(top, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        background: -webkit- linear-gradient(top, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        background: linear-gradient(to bottom, #dee9f3 0, #dee9f3 50%, #cfd9e3 51%, #cfd9e3 100%);
        color: #000;
        font-weight: 700
    }

    .skin_blue .megas512 span.current {
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
        font-weight: 700;
    }

    /*.skin_blue样式结束*/

    /*选中后item背景变黄色*/
    .bg_yellow {
        background: #ffc214 !important
    }

    /*选中后item背景变黄色结束*/

    /*测试使用的css样式*/
    .cart {
        margin: 32px;
        background: #fff;
        border: 1px solid #dddee1;
        border-radius: 10px;
    }

    .cart-header-title {
        padding: 16px 32px;
        border-bottom: 1px solid #dddee1;
        border-radius: 10px 10px 0 0;
        background: #f8f8f9;
    }

    .cart-header-main {
        padding: 8px 32px;
        overflow: hidden;
        border-bottom: 1px solid #dddee1;
        background: #eee;
        overflow: hidden;
    }

    .cart-empty {
        text-align: center;
        padding: 32px;
    }

    .cart-header-main div {
        text-align: center;
        float: left;
        font-size: 14px;
    }

    div.cart-info {
        width: 60%;
        text-align: left;
    }

    .cart-price {
        width: 10%;
    }

    .cart-count {
        width: 10%;
    }

    .cart-cost {
        width: 10%;
    }

    .cart-delete {
        width: 10%;
    }

    .cart-content-main {
        padding: 0 32px;
        height: 60px;
        line-height: 60px;
        text-align: center;
        border-bottom: 1px dashed #e9eaec;
        overflow: hidden;
    }

    .cart-content-main div {
        float: left;
    }

    .cart-content-main img {
        width: 40px;
        height: 40px;
        position: relative;
        top: 10px;
    }

    .cart-control-minus,
    .cart-control-add {
        display: inline-block;
        margin: 0 4px;
        width: 24px;
        height: 24px;
        line-height: 22px;
        text-align: center;
        background: #f8f8f9;
        border-radius: 50%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .2);
        cursor: pointer;
    }

    .cart-control-delete {
        cursor: pointer;
        color: #2d8cf0;
    }

    .cart-promotion {
        padding: 16px 32px;
    }

    .cart-control-promotion,
    .cart-control-order {
        display: inline-block;
        padding: 8px 32px;
        border-radius: 6px;
        background: #2d8cf0;
        color: #fff;
        cursor: pointer;
    }

    .cart-control-promotion {
        padding: 2px 6px;
        font-size: 12px;
        border-radius: 3px;
    }

    .cart-footer {
        padding: 32px;
        text-align: right;
    }

    .cart-footer-desc {
        display: inline-block;
        padding: 0 16px;
    }

    .cart-footer-desc span {
        color: #f2352e;
        font-size: 20px;
    }

    /*测试使用的css样式结束*/

    /*ball背景*/
    .T_KL8 b,
    .table_ball b {
        background: url(/static/game/images/ball/ball_5.png) no-repeat scroll 0 0;
        display: inline-block;
        height: 27px;
        margin-top: 4px;
        text-indent: -99999px;
        width: 27px
    }

    .T_KL8 .b01,
    .table_ball .b01 {
        background-position: 0 0
    }

    .T_KL8 .b02,
    .table_ball .b02 {
        background-position: 0 -27px
    }

    .T_KL8 .b03,
    .table_ball .b03 {
        background-position: 0 -54px
    }

    .T_KL8 .b04,
    .table_ball .b04 {
        background-position: 0 -81px
    }

    .T_KL8 .b05,
    .table_ball .b05 {
        background-position: 0 -108px
    }

    .T_KL8 .b06,
    .table_ball .b06 {
        background-position: 0 -135px
    }

    .T_KL8 .b07,
    .table_ball .b07 {
        background-position: 0 -162px
    }

    .T_KL8 .b08,
    .table_ball .b08 {
        background-position: 0 -189px
    }

    .T_KL8 .b09,
    .table_ball .b09 {
        background-position: 0 -216px
    }

    .T_KL8 .b10,
    .table_ball .b10 {
        background-position: 0 -243px
    }

    .T_KL8 .b11,
    .table_ball .b11 {
        background-position: 0 -270px
    }

    .T_KL8 .b12,
    .table_ball .b12 {
        background-position: 0 -297px
    }

    .T_KL8 .b13,
    .table_ball .b13 {
        background-position: 0 -324px
    }

    .T_KL8 .b14,
    .table_ball .b14 {
        background-position: 0 -351px
    }

    .T_KL8 .b15,
    .table_ball .b15 {
        background-position: 0 -378px
    }

    .T_KL8 .b16,
    .table_ball .b16 {
        background-position: 0 -405px
    }

    .T_KL8 .b17,
    .table_ball .b17 {
        background-position: 0 -432px
    }

    .T_KL8 .b18,
    .table_ball .b18 {
        background-position: 0 -459px
    }

    .T_KL8 .b19,
    .table_ball .b19 {
        background-position: 0 -486px
    }

    .T_KL8 .b20,
    .table_ball .b20 {
        background-position: 0 -513px
    }

    .T_KL8 .b21,
    .table_ball .b21 {
        background-position: 0 -540px
    }

    .T_KL8 .b22,
    .table_ball .b22 {
        background-position: 0 -567px
    }

    .T_KL8 .b23,
    .table_ball .b23 {
        background-position: 0 -594px
    }

    .T_KL8 .b24,
    .table_ball .b24 {
        background-position: 0 -621px
    }

    .T_KL8 .b25,
    .table_ball .b25 {
        background-position: 0 -648px
    }

    .T_KL8 .b26,
    .table_ball .b26 {
        background-position: 0 -675px
    }

    .T_KL8 .b27,
    .table_ball .b27 {
        background-position: 0 -702px
    }

    .T_KL8 .b28,
    .table_ball .b28 {
        background-position: 0 -729px
    }

    .T_KL8 .b29,
    .table_ball .b29 {
        background-position: 0 -756px
    }

    .T_KL8 .b30,
    .table_ball .b30 {
        background-position: 0 -783px
    }

    .T_KL8 .b31,
    .table_ball .b31 {
        background-position: 0 -810px
    }

    .T_KL8 .b32,
    .table_ball .b32 {
        background-position: 0 -837px
    }

    .T_KL8 .b33,
    .table_ball .b33 {
        background-position: 0 -864px
    }

    .T_KL8 .b34,
    .table_ball .b34 {
        background-position: 0 -891px
    }

    .T_KL8 .b35,
    .table_ball .b35 {
        background-position: 0 -918px
    }

    .T_KL8 .b36,
    .table_ball .b36 {
        background-position: 0 -945px
    }

    .T_KL8 .b37,
    .table_ball .b37 {
        background-position: 0 -972px
    }

    .T_KL8 .b38,
    .table_ball .b38 {
        background-position: 0 -999px
    }

    .T_KL8 .b39,
    .table_ball .b39 {
        background-position: 0 -1026px
    }

    .T_KL8 .b40,
    .table_ball .b40 {
        background-position: 0 -1053px
    }

    .T_KL8 .b41,
    .table_ball .b41 {
        background-position: 0 -1080px
    }

    .T_KL8 .b42,
    .table_ball .b42 {
        background-position: 0 -1107px
    }

    .T_KL8 .b43,
    .table_ball .b43 {
        background-position: 0 -1134px
    }

    .T_KL8 .b44,
    .table_ball .b44 {
        background-position: 0 -1161px
    }

    .T_KL8 .b45,
    .table_ball .b45 {
        background-position: 0 -1188px
    }

    .T_KL8 .b46,
    .table_ball .b46 {
        background-position: 0 -1215px
    }

    .T_KL8 .b47,
    .table_ball .b47 {
        background-position: 0 -1242px
    }

    .T_KL8 .b48,
    .table_ball .b48 {
        background-position: 0 -1269px
    }

    .T_KL8 .b49,
    .table_ball .b49 {
        background-position: 0 -1296px
    }

    .T_KL8 .b50,
    .table_ball .b50 {
        background-position: 0 -1323px
    }

    .T_KL8 .b51,
    .table_ball .b51 {
        background-position: 0 -1350px
    }

    .T_KL8 .b52,
    .table_ball .b52 {
        background-position: 0 -1377px
    }

    .T_KL8 .b53,
    .table_ball .b53 {
        background-position: 0 -1404px
    }

    .T_KL8 .b54,
    .table_ball .b54 {
        background-position: 0 -1431px
    }

    .T_KL8 .b55,
    .table_ball .b55 {
        background-position: 0 -1458px
    }

    .T_KL8 .b56,
    .table_ball .b56 {
        background-position: 0 -1485px
    }

    .T_KL8 .b57,
    .table_ball .b57 {
        background-position: 0 -1512px
    }

    .T_KL8 .b58,
    .table_ball .b58 {
        background-position: 0 -1539px
    }

    .T_KL8 .b59,
    .table_ball .b59 {
        background-position: 0 -1566px
    }

    .T_KL8 .b60,
    .table_ball .b60 {
        background-position: 0 -1593px
    }

    .T_KL8 .b61,
    .table_ball .b61 {
        background-position: 0 -1620px
    }

    .T_KL8 .b62,
    .table_ball .b62 {
        background-position: 0 -1647px
    }

    .T_KL8 .b63,
    .table_ball .b63 {
        background-position: 0 -1674px
    }

    .T_KL8 .b64,
    .table_ball .b64 {
        background-position: 0 -1701px
    }

    .T_KL8 .b65,
    .table_ball .b65 {
        background-position: 0 -1728px
    }

    .T_KL8 .b66,
    .table_ball .b66 {
        background-position: 0 -1755px
    }

    .T_KL8 .b67,
    .table_ball .b67 {
        background-position: 0 -1782px
    }

    .T_KL8 .b68,
    .table_ball .b68 {
        background-position: 0 -1809px
    }

    .T_KL8 .b69,
    .table_ball .b69 {
        background-position: 0 -1836px
    }

    .T_KL8 .b70,
    .table_ball .b70 {
        background-position: 0 -1863px
    }

    .T_KL8 .b71,
    .table_ball .b71 {
        background-position: 0 -1890px
    }

    .T_KL8 .b72,
    .table_ball .b72 {
        background-position: 0 -1917px
    }

    .T_KL8 .b73,
    .table_ball .b73 {
        background-position: 0 -1944px
    }

    .T_KL8 .b74,
    .table_ball .b74 {
        background-position: 0 -1971px
    }

    .T_KL8 .b75,
    .table_ball .b75 {
        background-position: 0 -1998px
    }

    .T_KL8 .b76,
    .table_ball .b76 {
        background-position: 0 -2025px
    }

    .T_KL8 .b77,
    .table_ball .b77 {
        background-position: 0 -2052px
    }

    .T_KL8 .b78,
    .table_ball .b78 {
        background-position: 0 -2079px
    }

    .T_KL8 .b79,
    .table_ball .b79 {
        background-position: 0 -2106px
    }

    .T_KL8 .b80,
    .table_ball .b80 {
        background-position: 0 -2133px
    }

    /*ball背景结束*/

</style>