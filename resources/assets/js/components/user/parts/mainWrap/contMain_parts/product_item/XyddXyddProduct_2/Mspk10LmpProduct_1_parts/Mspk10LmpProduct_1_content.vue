<template>
    <tr style="float:left; width: 274.6px;">
        <!--{{info.id}}-->
        <!--<div>你好</div>-->
        <!--{{this.cartList}}-->
        <!--{{ this.info.id }}-->
        <!--{{ this.info.selected }}-->
        <!--将字符串转化为json格式的数据-->
        <!--{{this.id}}-->
        <!--{{typeof (this.infoData)}}-->
        <!--{{this.infoData.id}}-->
            <!--{{ info }}-->
        <!--{{ this.props.info }}-->
                <!--{{ this.info_Data }}-->
        <!--{{this.id}}-->
        <!--{{ typeof (this.info_Data) }}-->

        <!--{{ info_Data.itemId[info_Data.itemIdName].changeClass }}-->
        <!--123-->
        <!--{{ this.cartList }}-->
        <!--{{infoData.id}} {{infoData.itemId[itemIdName].changeClass}}-->
        <!--这里要监听，而且要用点击事件，出发class增加-->
        <!--itemId[itemIdName].changeClass-->

        <td :data-id="info.id" class="name" style="width: 93px;" @mouseover="addHover" @mouseleave="removeHover" :class="{'bg_yellow': mspk10LmpSealIsTrue ? false : changeClass === true, 'hover': hoverActive}" @click="!mspk10LmpSealIsTrue && addToCart(info.id)">{{info.name}}</td>
        <td :data-id="info.id" class="amount" style="width: 78px;" @mouseover="addHover" @mouseleave="removeHover" :class="{'bg_yellow': mspk10LmpSealIsTrue ? false : changeClass === true, 'hover': hoverActive}" @click="!mspk10LmpSealIsTrue && addToCart(info.id)">
            <span class="c-txt3">{{ mspk10LmpSealIsTrue ? '--' : info.odds}}</span>
        </td>
        <td :data-id="info.id" class="amount" style="width: 101px;" @mouseover="addHover" @mouseleave="removeHover" :class="{'bg_yellow': mspk10LmpSealIsTrue ? false : changeClass === true, 'hover': hoverActive}" @click="!mspk10LmpSealIsTrue && addToCart2(info.id)">
            <input type="text" ref="inp" v-model="mspk10LmpSealIsTrue ? sealInput :betAmountItem1" :disabled="mspk10LmpSealIsTrue">
          <!--{{betAmountItem1}}-->
        </td>
    </tr>
</template>

<script>
    import { mapActions,mapGetters } from 'vuex'
    // console.log(this.info_Data);

    // let infoData = {};
    // let info_Data = {};

    export default {
        props: {
            info: Object
        },
            // { "id": 8014001, "name": "冠亚大", "alias": null, "code": "GYD", "gameId": 80, "playCateId": 140, "odds": 2.19, "rebate": 0, "minMoney": 1, "maxMoney": 500000, "maxTurnMoney": 500000, "selected": false, "itemId": { "item8014001": { "changeClass": true } }, "itemIdName": "item8014001" }

          // return {
          //     // // 'bg_yellow' (ifItemInCart)　这个属性是为了如果click change 是用第二套方法所准备的
          //     // itemSelected: true
          //
          //

        methods: {
            addHover: function () {
                this.hoverActive = true
                // console.log('hover效果 ' + this.hoverActive)
            },
            removeHover: function () {
                this.hoverActive = false
                // console.log('hover效果 ' + this.hoverActive)
            },
            addToCart (item) {
                // alert(item);
                // this.changeClass =!this.changeClass;

                // alert(item)
                // console.log(itemId[itemIdName].changeClass)

                // 因为这里加入购物车，还要改变页面中的其他地方的值，所以这里
                // itemId[itemIdName].changeClass = !itemId[itemIdName].changeClass

                // console.log(itemId[itemIdName].changeClass)

                if (this.changeClass) {
                    // alert(item) 这里的betAmountItem1是从cartList里面取出，但是每次总体的betAmount变化的时候（用户在设置总体下注金额的时候），所有的的cartList的下注金额都要改变，所以这里我们虽然从cartList里面取值，但是我们命名为betAmountItem (betAmountItem1, betAmountItem2)
                    // if (isNaN(this.betAmount)) {
                    //     this.betAmountItem1 = ''
                    // } else {
                    //     this.betAmountItem1 = this.betAmount
                    // }
                    this.betAmountItem1 = this.betAmount

                } else {
                    this.betAmountItem1 = ''
                }


                // 购物车点击添加,再点击删除已经再vuex actions里面写好了
                this.$store.dispatch('addToCart',item)
            },
            addToCart2 (item) {
                if (this.changeClass === false) {
                    // this.changeClass = !this.changeClass
                    // alert(item)
                    if (this.changeClass) {
                        this.betAmountItem1 = this.betAmount
                    } else {
                        this.betAmountItem1 = ''
                    }

                    this.$store.dispatch('addToCart', item)
                }

            },

            // itemId_Obj (item) {
            //     return JSON.parse(item)
            // }

            // ...mapActions([
            //     'addToCart'
            // ])
        },
        name: "mspk10-lmp-product_1_content",
        // 'bg_yellow' (ifItemInCart)
        computed: {
            changeClass: {
                get: function () {
                    // let CartListItem = this.$store.getters.CartList
                    if (this.cartList) {
                        const isItemInCart = this.cartList.find(item => item.id === this.info.id)
                        if(isItemInCart) {
                            return true
                        } else {
                            return false
                        }
                    }
                    // console.log(CartListItem)
                    // let itemInCartList =
                    // return false
                }
            },
            // for test
            ...mapGetters({
                cartList: 'getCartList',
                betAmount: 'getBetAmount',
                // 封盘与否
                mspk10LmpSealIsTrue: 'getMspk10LmpSealIsTrue'
            }),
            //监听productItem input标签里面值的变化
            betAmountItem1: {
                get () {
                    return this.$store.getters.getBetAmountItem(this.info.id)
                },
                set (value) {
                    this.$store.dispatch('setBetAmountItem', { value:value, id: this.info.id })
                }
            }
            // info_Data: {
            //     // getter
            //     get: function () {
            //         return infoData
            //     },
            //     // setter
            //     set: function (newObject) {
            //         for(let item in newObject){
            //             infoData[item] = newObject[item]
            //             // infoData.shift()
            //         }
            //         return infoData
            //     }
            //
            //
            // }

            // for test end
            // 将分配过来的字符串itemId转成变量名
        },
        // mounted () {
        //     console.log([this.info.itemId][changeClass])
        // }
        // created () {
        //     // infoData =  this.info
        //     // console.log(infoData)
        //     // console.log(typeof (infoData))
        //     // infoData = this.deleteEmptyProperty(infoData)
        //     for(let item in this.info){
        //         infoData[item] = this.info[item]
        //         // infoData.shift()
        //     }
        //
        //     console.log(infoData)
        // },

        // data () {
        //     return {
        //         info_Data: infoData,
        //         betAmountItem1: ''
        //     }
        // },
        data () {
            return {
                // changeClass: false,
                hoverActive: false,
                sealInput: '封盘'
                // info_Data: infoData,
                // betAmountItem1: ''
            }
        },




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
