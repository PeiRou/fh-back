<template>
    <table class="u-table2">


            <Mspk10LmpProduct_1_title v-for="(item,index) in info.productInfo.productTitle" v-if="item.id === info.productId.playCateId && isNaN(parseInt(item.code))" :info="item" :key="item.id"></Mspk10LmpProduct_1_title>
            <!--<th colspan="3" v-for="item in Mspk10LmpName" v-if="item.id===140 && isNaN(parseInt(item.code))">{{item.name}}</th>-->
        <!--{{info.productInfo.productContent}}-->

        <!--这里通过 item.code不等于这些值 去除大单,大双,小单,小双-->
        <!--{{info.productInfo.productContent}}-->
        <!--{{info.productId.playCateId}}-->
        <!--{{info.productInfo.productContent}}-->

        <!--因为这里要纵向排列,所以我们这里要一个一个加上去-->

        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '0'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '7'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '14'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '21'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '1'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '8'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '15'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '22'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '2'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '9'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '16'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '23'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '3'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '10'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '17'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '24'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '4'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '11'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '18'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '25'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '5'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '12'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '19'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '26'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '6'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '13'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '20'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>
        <Mspk10LmpProduct_1_content v-for="item in info.productInfo.productContent" v-if="item.playCateId === info.productId.playCateId && item.name === '27'" :info="item" :key="item.id"></Mspk10LmpProduct_1_content>

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

</style>