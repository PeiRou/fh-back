<template>
    <tr style="float:left; width: 25%">

        <td :data-id="info.id" class="name" style="width: 69px;" @mouseover="addHover" @mouseleave="removeHover" :class="{'bg_yellow': mspk10LmpSealIsTrue ? false : changeClass === true, 'hover': hoverActive}" @click="!mspk10LmpSealIsTrue && addToCart(info.id)"><b :class="this.ballClass">{{info.name}}</b></td>
        <td :data-id="info.id" class="odds" style="width: 58px;" @mouseover="addHover" @mouseleave="removeHover" :class="{'bg_yellow': mspk10LmpSealIsTrue ? false : changeClass === true, 'hover': hoverActive}" @click="!mspk10LmpSealIsTrue && addToCart(info.id)"><span class="c-txt3">{{ mspk10LmpSealIsTrue ? '--' : info.odds}}</span>
        <td :data-id="info.id" class="amount" style="width: 80px;" @mouseover="addHover" @mouseleave="removeHover" :class="{'bg_yellow': mspk10LmpSealIsTrue ? false : changeClass === true, 'hover': hoverActive}" @click="!mspk10LmpSealIsTrue && addToCart2(info.id)"><input type="text" v-model="mspk10LmpSealIsTrue ? sealInput :betAmountItem1" :disabled="mspk10LmpSealIsTrue"></td>

        <!--<td :data-id="info.id" class="name" style="width: 69px;" :class="{'bg_yellow': this.changeClass === true}" @click="addToCart(info.id)">{{info.name}}</td>-->
        <!--<td :data-id="info.id" class="amount" style="width: 58px;" :class="{'bg_yellow': this.changeClass === true}" @click="addToCart(info.id)">-->
            <!--<span class="c-txt3">{{info.odds}}</span>-->
        <!--</td>-->
        <!--<td :data-id="info.id" class="amount" style="width: 80px;" :class="{'bg_yellow': this.changeClass === true}" @click="addToCart2(info.id)">-->
            <!--<input type="text" ref="inp" v-model="betAmountItem1">-->
          <!--&lt;!&ndash;{{betAmountItem1}}&ndash;&gt;-->
        <!--</td>-->
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
            ballClass: function () {
                if(this.info.name < 10 && this.info.name.length < 2){
                    this.info.name = "0" + this.info.name
                }
                let ballClassName = "b" + this.info.name
                return ballClassName
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

    /*需要精简的css样式，来自zm*/

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

    /*需要精简的css代码*/

    @charset "UTF-8";
    .el-fade-in-linear-enter-active,
    .el-fade-in-linear-leave-active,
    .fade-in-linear-enter-active,
    .fade-in-linear-leave-active {
        transition: opacity .2s linear
    }

    .el-fade-in-enter,
    .el-fade-in-leave-active,
    .el-fade-in-linear-enter,
    .el-fade-in-linear-leave,
    .el-fade-in-linear-leave-active,
    .fade-in-linear-enter,
    .fade-in-linear-leave,
    .fade-in-linear-leave-active {
        opacity: 0
    }

    .el-fade-in-enter-active,
    .el-fade-in-leave-active,
    .el-zoom-in-center-enter-active,
    .el-zoom-in-center-leave-active {
        transition: all .3s cubic-bezier(.55, 0, .1, 1)
    }

    .el-zoom-in-bottom-enter-active,
    .el-zoom-in-bottom-leave-active,
    .el-zoom-in-left-enter-active,
    .el-zoom-in-left-leave-active,
    .el-zoom-in-top-enter-active,
    .el-zoom-in-top-leave-active {
        transition: transform .3s cubic-bezier(.23, 1, .32, 1) .1s, opacity .3s cubic-bezier(.23, 1, .32, 1) .1s
    }

    .el-zoom-in-center-enter,
    .el-zoom-in-center-leave-active {
        opacity: 0;
        -ms-transform: scaleX(0);
        transform: scaleX(0)
    }

    .el-zoom-in-top-enter-active,
    .el-zoom-in-top-leave-active {
        opacity: 1;
        -ms-transform: scaleY(1);
        transform: scaleY(1);
        -ms-transform-origin: center top;
        transform-origin: center top
    }

    .el-zoom-in-top-enter,
    .el-zoom-in-top-leave-active {
        opacity: 0;
        -ms-transform: scaleY(0);
        transform: scaleY(0)
    }

    .el-zoom-in-bottom-enter-active,
    .el-zoom-in-bottom-leave-active {
        opacity: 1;
        -ms-transform: scaleY(1);
        transform: scaleY(1);
        -ms-transform-origin: center bottom;
        transform-origin: center bottom
    }

    .el-zoom-in-bottom-enter,
    .el-zoom-in-bottom-leave-active {
        opacity: 0;
        -ms-transform: scaleY(0);
        transform: scaleY(0)
    }

    .el-zoom-in-left-enter-active,
    .el-zoom-in-left-leave-active {
        opacity: 1;
        -ms-transform: scale(1, 1);
        transform: scale(1, 1);
        -ms-transform-origin: top left;
        transform-origin: top left
    }

    .el-zoom-in-left-enter,
    .el-zoom-in-left-leave-active {
        opacity: 0;
        -ms-transform: scale(.45, .45);
        transform: scale(.45, .45)
    }

    .collapse-transition {
        transition: .3s height ease-in-out, .3s padding-top ease-in-out, .3s padding-bottom ease-in-out
    }

    .horizontal-collapse-transition {
        transition: .3s width ease-in-out, .3s padding-left ease-in-out, .3s padding-right ease-in-out
    }

    .el-list-enter-active,
    .el-list-leave-active {
        transition: all 1s
    }

    .el-list-enter,
    .el-list-leave-active {
        opacity: 0;
        -ms-transform: translateY(-30px);
        transform: translateY(-30px)
    }

    .el-opacity-transition {
        transition: opacity .3s cubic-bezier(.55, 0, .1, 1)
    }


    [class*=" el-icon-"],
    [class^=el-icon-] {
        font-family: element-icons!important;
        speak: none;
        font-style: normal;
        font-weight: 400;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        vertical-align: baseline;
        display: inline-block;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale
    }

    .el-icon-arrow-down:before {
        content: "\e600"
    }

    .el-icon-arrow-left:before {
        content: "\e601"
    }

    .el-icon-arrow-right:before {
        content: "\e602"
    }

    .el-icon-arrow-up:before {
        content: "\e603"
    }

    .el-icon-caret-bottom:before {
        content: "\e604"
    }

    .el-icon-caret-left:before {
        content: "\e605"
    }

    .el-icon-caret-right:before {
        content: "\e606"
    }

    .el-icon-caret-top:before {
        content: "\e607"
    }

    .el-icon-check:before {
        content: "\e608"
    }

    .el-icon-circle-check:before {
        content: "\e609"
    }

    .el-icon-circle-close:before {
        content: "\e60a"
    }

    .el-icon-circle-cross:before {
        content: "\e60b"
    }

    .el-icon-close:before {
        content: "\e60c"
    }

    .el-icon-upload:before {
        content: "\e60d"
    }

    .el-icon-d-arrow-left:before {
        content: "\e60e"
    }

    .el-icon-d-arrow-right:before {
        content: "\e60f"
    }

    .el-icon-d-caret:before {
        content: "\e610"
    }

    .el-icon-date:before {
        content: "\e611"
    }

    .el-icon-delete:before {
        content: "\e612"
    }

    .el-icon-document:before {
        content: "\e613"
    }

    .el-icon-edit:before {
        content: "\e614"
    }

    .el-icon-information:before {
        content: "\e615"
    }

    .el-icon-loading:before {
        content: "\e616"
    }

    .el-icon-menu:before {
        content: "\e617"
    }

    .el-icon-message:before {
        content: "\e618"
    }

    .el-icon-minus:before {
        content: "\e619"
    }

    .el-icon-more:before {
        content: "\e61a"
    }

    .el-icon-picture:before {
        content: "\e61b"
    }

    .el-icon-plus:before {
        content: "\e61c"
    }

    .el-icon-search:before {
        content: "\e61d"
    }

    .el-icon-setting:before {
        content: "\e61e"
    }

    .el-icon-share:before {
        content: "\e61f"
    }

    .el-icon-star-off:before {
        content: "\e620"
    }

    .el-icon-star-on:before {
        content: "\e621"
    }

    .el-icon-time:before {
        content: "\e622"
    }

    .el-icon-warning:before {
        content: "\e623"
    }

    .el-icon-delete2:before {
        content: "\e624"
    }

    .el-icon-upload2:before {
        content: "\e627"
    }

    .el-icon-view:before {
        content: "\e626"
    }

    .el-icon-loading {
        animation: rotating 1s linear infinite
    }

    .el-icon--right {
        margin-left: 5px
    }

    .el-icon--left {
        margin-right: 5px
    }

    @keyframes rotating {
        0% {
            transform: rotateZ(0)
        }
        100% {
            transform: rotateZ(360deg)
        }
    }

    .v-modal-enter {
        animation: v-modal-in .2s ease
    }

    .v-modal-leave {
        animation: v-modal-out .2s ease forwards
    }

    @keyframes v-modal-in {
        0% {
            opacity: 0
        }
    }

    @keyframes v-modal-out {
        100% {
            opacity: 0
        }
    }

    .v-modal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: .5;
        background: #000
    }

    .el-dialog {
        position: absolute;
        left: 50%;
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        background: #fff;
        border-radius: 2px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .3);
        box-sizing: border-box;
        margin-bottom: 50px
    }

    .el-dialog--tiny {
        width: 30%
    }

    .el-dialog--small {
        width: 50%
    }

    .el-dialog--large {
        width: 90%
    }

    .el-dialog--full {
        width: 100%;
        top: 0;
        margin-bottom: 0;
        height: 100%;
        overflow: auto
    }

    .el-dialog__wrapper {
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        position: fixed;
        overflow: auto;
        margin: 0
    }

    .el-dialog__header {
        padding: 20px 20px 0
    }

    .el-dialog__headerbtn {
        float: right;
        background: 0 0;
        border: none;
        outline: 0;
        padding: 0;
        cursor: pointer
    }

    .el-dialog__headerbtn .el-dialog__close {
        color: #bfcbd9
    }

    .el-dialog__headerbtn:focus .el-dialog__close,
    .el-dialog__headerbtn:hover .el-dialog__close {
        color: #20a0ff
    }

    .el-dialog__title {
        line-height: 1;
        font-size: 16px;
        font-weight: 700;
        color: #1f2d3d
    }

    .el-dialog__body {
        padding: 30px 20px;
        color: #48576a;
        font-size: 14px
    }

    .el-dialog__footer {
        padding: 10px 20px 15px;
        text-align: right;
        box-sizing: border-box
    }

    .dialog-fade-enter-active {
        animation: dialog-fade-in .3s
    }

    .dialog-fade-leave-active {
        animation: dialog-fade-out .3s
    }

    @keyframes dialog-fade-in {
        0% {
            transform: translate3d(0, -20px, 0);
            opacity: 0
        }
        100% {
            transform: translate3d(0, 0, 0);
            opacity: 1
        }
    }

    @keyframes dialog-fade-out {
        0% {
            transform: translate3d(0, 0, 0);
            opacity: 1
        }
        100% {
            transform: translate3d(0, -20px, 0);
            opacity: 0
        }
    }

    .el-button,
    .el-input__inner {
        -webkit-appearance: none;
        line-height: 1;
        outline: 0
    }

    .el-button-group:after,
    .el-button-group:before {
        display: table;
        content: ""
    }

    .el-button,
    .el-button-group,
    .el-input,
    .el-input__inner {
        display: inline-block
    }

    .el-button-group:after {
        clear: both
    }

    .v-modal-enter {
        animation: v-modal-in .2s ease
    }

    .v-modal-leave {
        animation: v-modal-out .2s ease forwards
    }

    @keyframes v-modal-in {
        0% {
            opacity: 0
        }
    }

    @keyframes v-modal-out {
        100% {
            opacity: 0
        }
    }

    .v-modal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: .5;
        background: #000
    }

    .el-button {
        white-space: nowrap;
        cursor: pointer;
        background: #fff;
        border: 1px solid #c4c4c4;
        color: #1f2d3d;
        text-align: center;
        box-sizing: border-box;
        margin: 0;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        padding: 10px 15px;
        font-size: 14px;
        border-radius: 4px
    }

    .el-button+.el-button {
        margin-left: 10px
    }

    .el-button:focus,
    .el-button:hover {
        color: #20a0ff;
        border-color: #20a0ff
    }

    .el-button:active {
        color: #1d90e6;
        border-color: #1d90e6;
        outline: 0
    }

    .el-button::-moz-focus-inner {
        border: 0
    }

    .el-button [class*=el-icon-]+span {
        margin-left: 5px
    }

    .el-button.is-loading {
        position: relative;
        pointer-events: none
    }

    .el-button.is-loading:before {
        pointer-events: none;
        content: '';
        position: absolute;
        left: -1px;
        top: -1px;
        right: -1px;
        bottom: -1px;
        border-radius: inherit;
        background-color: rgba(255, 255, 255, .35)
    }

    .el-button.is-disabled,
    .el-button.is-disabled:focus,
    .el-button.is-disabled:hover {
        color: #bfcbd9;
        cursor: not-allowed;
        background-image: none;
        background-color: #eef1f6;
        border-color: #d1dbe5
    }

    .el-button.is-disabled.el-button--text {
        background-color: transparent
    }

    .el-button.is-disabled.is-plain,
    .el-button.is-disabled.is-plain:focus,
    .el-button.is-disabled.is-plain:hover {
        background-color: #fff;
        border-color: #d1dbe5;
        color: #bfcbd9
    }

    .el-button.is-active {
        color: #1d90e6;
        border-color: #1d90e6
    }

    .el-button.is-plain:focus,
    .el-button.is-plain:hover {
        background: #fff;
        border-color: #20a0ff;
        color: #20a0ff
    }

    .el-button.is-plain:active {
        background: #fff;
        border-color: #1d90e6;
        color: #1d90e6;
        outline: 0
    }

    .el-button--primary {
        color: #fff;
        background-color: #20a0ff;
        border-color: #20a0ff
    }

    .el-button--primary:focus,
    .el-button--primary:hover {
        background: #4db3ff;
        border-color: #4db3ff;
        color: #fff
    }

    .el-button--primary.is-active,
    .el-button--primary:active {
        background: #1d90e6;
        border-color: #1d90e6;
        color: #fff
    }

    .el-button--primary:active {
        outline: 0
    }

    .el-button--primary.is-plain {
        background: #fff;
        border: 1px solid #bfcbd9;
        color: #1f2d3d
    }

    .el-button--primary.is-plain:focus,
    .el-button--primary.is-plain:hover {
        background: #fff;
        border-color: #20a0ff;
        color: #20a0ff
    }

    .el-button--primary.is-plain:active {
        background: #fff;
        border-color: #1d90e6;
        color: #1d90e6;
        outline: 0
    }

    .el-button--success {
        color: #fff;
        background-color: #13ce66;
        border-color: #13ce66
    }

    .el-button--success:focus,
    .el-button--success:hover {
        background: #42d885;
        border-color: #42d885;
        color: #fff
    }

    .el-button--success.is-active,
    .el-button--success:active {
        background: #11b95c;
        border-color: #11b95c;
        color: #fff
    }

    .el-button--success:active {
        outline: 0
    }

    .el-button--success.is-plain {
        background: #fff;
        border: 1px solid #bfcbd9;
        color: #1f2d3d
    }

    .el-button--success.is-plain:focus,
    .el-button--success.is-plain:hover {
        background: #fff;
        border-color: #13ce66;
        color: #13ce66
    }

    .el-button--success.is-plain:active {
        background: #fff;
        border-color: #11b95c;
        color: #11b95c;
        outline: 0
    }

    .el-button--warning {
        color: #fff;
        background-color: #f7ba2a;
        border-color: #f7ba2a
    }

    .el-button--warning:focus,
    .el-button--warning:hover {
        background: #f9c855;
        border-color: #f9c855;
        color: #fff
    }

    .el-button--warning.is-active,
    .el-button--warning:active {
        background: #dea726;
        border-color: #dea726;
        color: #fff
    }

    .el-button--warning:active {
        outline: 0
    }

    .el-button--warning.is-plain {
        background: #fff;
        border: 1px solid #bfcbd9;
        color: #1f2d3d
    }

    .el-button--warning.is-plain:focus,
    .el-button--warning.is-plain:hover {
        background: #fff;
        border-color: #f7ba2a;
        color: #f7ba2a
    }

    .el-button--warning.is-plain:active {
        background: #fff;
        border-color: #dea726;
        color: #dea726;
        outline: 0
    }

    .el-button--danger {
        color: #fff;
        background-color: #ff4949;
        border-color: #ff4949
    }

    .el-button--danger:focus,
    .el-button--danger:hover {
        background: #ff6d6d;
        border-color: #ff6d6d;
        color: #fff
    }

    .el-button--danger.is-active,
    .el-button--danger:active {
        background: #e64242;
        border-color: #e64242;
        color: #fff
    }

    .el-button--danger:active {
        outline: 0
    }

    .el-button--danger.is-plain {
        background: #fff;
        border: 1px solid #bfcbd9;
        color: #1f2d3d
    }

    .el-button--danger.is-plain:focus,
    .el-button--danger.is-plain:hover {
        background: #fff;
        border-color: #ff4949;
        color: #ff4949
    }

    .el-button--danger.is-plain:active {
        background: #fff;
        border-color: #e64242;
        color: #e64242;
        outline: 0
    }

    .el-button--info {
        color: #fff;
        background-color: #50bfff;
        border-color: #50bfff
    }

    .el-button--info:focus,
    .el-button--info:hover {
        background: #73ccff;
        border-color: #73ccff;
        color: #fff
    }

    .el-button--info.is-active,
    .el-button--info:active {
        background: #48ace6;
        border-color: #48ace6;
        color: #fff
    }

    .el-button--info:active {
        outline: 0
    }

    .el-button--info.is-plain {
        background: #fff;
        border: 1px solid #bfcbd9;
        color: #1f2d3d
    }

    .el-button--info.is-plain:focus,
    .el-button--info.is-plain:hover {
        background: #fff;
        border-color: #50bfff;
        color: #50bfff
    }

    .el-button--info.is-plain:active {
        background: #fff;
        border-color: #48ace6;
        color: #48ace6;
        outline: 0
    }

    .el-button--large {
        padding: 11px 19px;
        font-size: 16px;
        border-radius: 4px
    }

    .el-button--small {
        padding: 7px 9px;
        font-size: 12px;
        border-radius: 4px
    }

    .el-button--mini {
        padding: 4px;
        font-size: 12px;
        border-radius: 4px
    }

    .el-button--text {
        border: none;
        color: #20a0ff;
        background: 0 0;
        padding-left: 0;
        padding-right: 0
    }

    .el-input__inner,
    .el-textarea__inner {
        box-sizing: border-box;
        background-image: none
    }

    .el-button--text:focus,
    .el-button--text:hover {
        color: #4db3ff
    }

    .el-button--text:active {
        color: #1d90e6
    }

    .el-button-group {
        vertical-align: middle
    }

    .el-button-group .el-button--primary:first-child {
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--primary:last-child {
        border-left-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--primary:not(:first-child):not(:last-child) {
        border-left-color: rgba(255, 255, 255, .5);
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--success:first-child {
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--success:last-child {
        border-left-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--success:not(:first-child):not(:last-child) {
        border-left-color: rgba(255, 255, 255, .5);
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--warning:first-child {
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--warning:last-child {
        border-left-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--warning:not(:first-child):not(:last-child) {
        border-left-color: rgba(255, 255, 255, .5);
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--danger:first-child {
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--danger:last-child {
        border-left-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--danger:not(:first-child):not(:last-child) {
        border-left-color: rgba(255, 255, 255, .5);
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--info:first-child {
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--info:last-child {
        border-left-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button--info:not(:first-child):not(:last-child) {
        border-left-color: rgba(255, 255, 255, .5);
        border-right-color: rgba(255, 255, 255, .5)
    }

    .el-button-group .el-button {
        float: left;
        position: relative
    }

    .el-button-group .el-button+.el-button {
        margin-left: 0
    }

    .el-button-group .el-button:first-child {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0
    }

    .el-button-group .el-button:last-child {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0
    }

    .el-button-group .el-button:not(:first-child):not(:last-child) {
        border-radius: 0
    }

    .el-button-group .el-button:not(:last-child) {
        margin-right: -1px
    }

    .el-button-group .el-button.is-active,
    .el-button-group .el-button:active,
    .el-button-group .el-button:focus,
    .el-button-group .el-button:hover {
        z-index: 1
    }

    .el-input {
        position: relative;
        font-size: 14px;
        width: 100%
    }

    .el-input-group__append .el-button,
    .el-input-group__append .el-input,
    .el-input-group__prepend .el-button,
    .el-input-group__prepend .el-input,
    .el-input__inner {
        font-size: inherit
    }

    .el-input.is-disabled .el-input__inner {
        background-color: #eef1f6;
        border-color: #d1dbe5;
        color: #bbb;
        cursor: not-allowed
    }

    .el-input.is-disabled .el-input__inner::-webkit-input-placeholder {
        color: #bfcbd9
    }

    .el-input.is-disabled .el-input__inner::-moz-placeholder {
        color: #bfcbd9
    }

    .el-input.is-disabled .el-input__inner:-ms-input-placeholder {
        color: #bfcbd9
    }

    .el-input.is-disabled .el-input__inner::placeholder {
        color: #bfcbd9
    }

    .el-input.is-active .el-input__inner {
        outline: 0;
        border-color: #20a0ff
    }

    .el-input__inner {
        -moz-appearance: none;
        appearance: none;
        background-color: #fff;
        border-radius: 4px;
        border: 1px solid #bfcbd9;
        color: #1f2d3d;
        height: 36px;
        padding: 3px 10px;
        transition: border-color .2s cubic-bezier(.645, .045, .355, 1);
        width: 100%
    }

    .el-input__inner::-webkit-input-placeholder {
        color: #97a8be
    }

    .el-input__inner::-moz-placeholder {
        color: #97a8be
    }

    .el-input__inner:-ms-input-placeholder {
        color: #97a8be
    }

    .el-input__inner::placeholder {
        color: #97a8be
    }

    .el-input__inner:hover {
        border-color: #8391a5
    }

    .el-input__inner:focus {
        outline: 0;
        border-color: #20a0ff
    }

    .el-input__icon {
        position: absolute;
        width: 35px;
        height: 100%;
        right: 0;
        top: 0;
        text-align: center;
        color: #bfcbd9;
        transition: all .3s
    }

    .el-input__icon:after {
        content: '';
        height: 100%;
        width: 0;
        display: inline-block;
        vertical-align: middle
    }

    .el-input__icon+.el-input__inner {
        padding-right: 35px
    }

    .el-input__icon.is-clickable:hover {
        cursor: pointer;
        color: #8391a5
    }

    .el-input__icon.is-clickable:hover+.el-input__inner {
        border-color: #8391a5
    }

    .el-input--large {
        font-size: 16px
    }

    .el-input--large .el-input__inner {
        height: 42px
    }

    .el-input--small {
        font-size: 13px
    }

    .el-input--small .el-input__inner {
        height: 30px
    }

    .el-input--mini {
        font-size: 12px
    }

    .el-input--mini .el-input__inner {
        height: 22px
    }

    .el-input-group {
        line-height: normal;
        display: inline-table;
        width: 100%;
        border-collapse: separate
    }

    .el-input-group>.el-input__inner {
        vertical-align: middle;
        display: table-cell
    }

    .el-input-group__append,
    .el-input-group__prepend {
        background-color: #fbfdff;
        color: #97a8be;
        vertical-align: middle;
        display: table-cell;
        position: relative;
        border: 1px solid #bfcbd9;
        border-radius: 4px;
        padding: 0 10px;
        width: 1px;
        white-space: nowrap
    }

    .el-input-group--prepend .el-input__inner,
    .el-input-group__append {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0
    }

    .el-input-group--append .el-input__inner,
    .el-input-group__prepend {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0
    }

    .el-input-group__append .el-button,
    .el-input-group__append .el-select,
    .el-input-group__prepend .el-button,
    .el-input-group__prepend .el-select {
        display: block;
        margin: -10px
    }

    .el-input-group__append button.el-button,
    .el-input-group__append div.el-select .el-input__inner,
    .el-input-group__append div.el-select:hover .el-input__inner,
    .el-input-group__prepend button.el-button,
    .el-input-group__prepend div.el-select .el-input__inner,
    .el-input-group__prepend div.el-select:hover .el-input__inner {
        border-color: transparent;
        background-color: transparent;
        color: inherit;
        border-top: 0;
        border-bottom: 0
    }

    .el-input-group__prepend {
        border-right: 0
    }

    .el-input-group__append {
        border-left: 0
    }

    .el-textarea {
        display: inline-block;
        width: 100%;
        vertical-align: bottom
    }

    .el-textarea.is-disabled .el-textarea__inner {
        background-color: #eef1f6;
        border-color: #d1dbe5;
        color: #bbb;
        cursor: not-allowed
    }

    .el-textarea.is-disabled .el-textarea__inner::-webkit-input-placeholder {
        color: #bfcbd9
    }

    .el-textarea.is-disabled .el-textarea__inner::-moz-placeholder {
        color: #bfcbd9
    }

    .el-textarea.is-disabled .el-textarea__inner:-ms-input-placeholder {
        color: #bfcbd9
    }

    .el-textarea.is-disabled .el-textarea__inner::placeholder {
        color: #bfcbd9
    }

    .el-textarea__inner {
        display: block;
        resize: vertical;
        padding: 5px 7px;
        line-height: 1.5;
        width: 100%;
        font-size: 14px;
        color: #1f2d3d;
        background-color: #fff;
        border: 1px solid #bfcbd9;
        border-radius: 4px;
        transition: border-color .2s cubic-bezier(.645, .045, .355, 1)
    }

    .el-textarea__inner::-webkit-input-placeholder {
        color: #97a8be
    }

    .el-textarea__inner::-moz-placeholder {
        color: #97a8be
    }

    .el-textarea__inner:-ms-input-placeholder {
        color: #97a8be
    }

    .el-textarea__inner::placeholder {
        color: #97a8be
    }

    .el-textarea__inner:hover {
        border-color: #8391a5
    }

    .el-textarea__inner:focus {
        outline: 0;
        border-color: #20a0ff
    }

    .el-message-box {
        text-align: left;
        display: inline-block;
        vertical-align: middle;
        background-color: #fff;
        width: 420px;
        border-radius: 3px;
        font-size: 16px;
        overflow: hidden;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden
    }

    .el-message-box__wrapper {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        text-align: center
    }

    .el-message-box__wrapper::after {
        content: "";
        display: inline-block;
        height: 100%;
        width: 0;
        vertical-align: middle
    }

    .el-message-box__header {
        position: relative;
        padding: 20px 20px 0
    }

    .el-message-box__headerbtn {
        position: absolute;
        top: 19px;
        right: 20px;
        background: 0 0;
        border: none;
        outline: 0;
        padding: 0;
        cursor: pointer
    }

    .el-message-box__headerbtn .el-message-box__close {
        color: #999
    }

    .el-message-box__headerbtn:focus .el-message-box__close,
    .el-message-box__headerbtn:hover .el-message-box__close {
        color: #20a0ff
    }

    .el-message-box__content {
        padding: 30px 20px;
        color: #48576a;
        font-size: 14px;
        position: relative
    }

    .el-message-box__input {
        padding-top: 15px
    }

    .el-message-box__input input.invalid,
    .el-message-box__input input.invalid:focus {
        border-color: #ff4949
    }

    .el-message-box__errormsg {
        color: #ff4949;
        font-size: 12px;
        min-height: 18px;
        margin-top: 2px
    }

    .el-message-box__title {
        padding-left: 0;
        margin-bottom: 0;
        font-size: 16px;
        font-weight: 700;
        height: 18px;
        color: #333
    }

    .el-message-box__message {
        margin: 0
    }

    .el-message-box__message p {
        margin: 0;
        line-height: 1.4
    }

    .el-message-box__btns {
        padding: 10px 20px 15px;
        text-align: right
    }

    .el-message-box__btns button:nth-child(2) {
        margin-left: 10px
    }

    .el-message-box__btns-reverse {
        -ms-flex-direction: row-reverse;
        flex-direction: row-reverse
    }

    .el-message-box__status {
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size: 36px!important
    }

    .el-message-box__status.el-icon-circle-check {
        color: #13ce66
    }

    .el-message-box__status.el-icon-information {
        color: #50bfff
    }

    .el-message-box__status.el-icon-warning {
        color: #f7ba2a
    }

    .el-message-box__status.el-icon-circle-cross {
        color: #ff4949
    }

    .msgbox-fade-enter-active {
        animation: msgbox-fade-in .3s
    }

    .msgbox-fade-leave-active {
        animation: msgbox-fade-out .3s
    }

    @keyframes msgbox-fade-in {
        0% {
            transform: translate3d(0, -20px, 0);
            opacity: 0
        }
        100% {
            transform: translate3d(0, 0, 0);
            opacity: 1
        }
    }

    @keyframes msgbox-fade-out {
        0% {
            transform: translate3d(0, 0, 0);
            opacity: 1
        }
        100% {
            transform: translate3d(0, -20px, 0);
            opacity: 0
        }
    }

    .el-tooltip__popper {
        position: absolute;
        border-radius: 4px;
        padding: 10px;
        z-index: 2000;
        font-size: 12px;
        line-height: 1.2
    }

    .el-tooltip__popper .popper__arrow,
    .el-tooltip__popper .popper__arrow::after {
        position: absolute;
        display: block;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid
    }

    .el-tooltip__popper .popper__arrow {
        border-width: 6px
    }

    .el-tooltip__popper .popper__arrow::after {
        content: " ";
        border-width: 5px
    }

    .el-tooltip__popper[x-placement^=top] {
        margin-bottom: 12px
    }

    .el-tooltip__popper[x-placement^=top] .popper__arrow {
        bottom: -6px;
        border-top-color: #1f2d3d;
        border-bottom-width: 0
    }

    .el-tooltip__popper[x-placement^=top] .popper__arrow::after {
        bottom: 1px;
        margin-left: -5px;
        border-top-color: #1f2d3d;
        border-bottom-width: 0
    }

    .el-tooltip__popper[x-placement^=bottom] {
        margin-top: 12px
    }

    .el-tooltip__popper[x-placement^=bottom] .popper__arrow {
        top: -6px;
        border-top-width: 0;
        border-bottom-color: #1f2d3d
    }

    .el-tooltip__popper[x-placement^=bottom] .popper__arrow::after {
        top: 1px;
        margin-left: -5px;
        border-top-width: 0;
        border-bottom-color: #1f2d3d
    }

    .el-tooltip__popper[x-placement^=right] {
        margin-left: 12px
    }

    .el-tooltip__popper[x-placement^=right] .popper__arrow {
        left: -6px;
        border-right-color: #1f2d3d;
        border-left-width: 0
    }

    .el-tooltip__popper[x-placement^=right] .popper__arrow::after {
        bottom: -5px;
        left: 1px;
        border-right-color: #1f2d3d;
        border-left-width: 0
    }

    .el-tooltip__popper[x-placement^=left] {
        margin-right: 12px
    }

    .el-tooltip__popper[x-placement^=left] .popper__arrow {
        right: -6px;
        border-right-width: 0;
        border-left-color: #1f2d3d
    }

    .el-tooltip__popper[x-placement^=left] .popper__arrow::after {
        right: 1px;
        bottom: -5px;
        margin-left: -5px;
        border-right-width: 0;
        border-left-color: #1f2d3d
    }

    .el-tooltip__popper.is-light {
        background: #fff;
        border: 1px solid #1f2d3d
    }

    .el-tooltip__popper.is-light[x-placement^=top] .popper__arrow {
        border-top-color: #1f2d3d
    }

    .el-tooltip__popper.is-light[x-placement^=top] .popper__arrow::after {
        border-top-color: #fff
    }

    .el-tooltip__popper.is-light[x-placement^=bottom] .popper__arrow {
        border-bottom-color: #1f2d3d
    }

    .el-tooltip__popper.is-light[x-placement^=bottom] .popper__arrow::after {
        border-bottom-color: #fff
    }

    .el-tooltip__popper.is-light[x-placement^=left] .popper__arrow {
        border-left-color: #1f2d3d
    }

    .el-tooltip__popper.is-light[x-placement^=left] .popper__arrow::after {
        border-left-color: #fff
    }

    .el-tooltip__popper.is-light[x-placement^=right] .popper__arrow {
        border-right-color: #1f2d3d
    }

    .el-tooltip__popper.is-light[x-placement^=right] .popper__arrow::after {
        border-right-color: #fff
    }

    .el-tooltip__popper.is-dark {
        background: #1f2d3d;
        color: #fff
    }

    .el-message {
        box-shadow: 0 2px 4px rgba(0, 0, 0, .12), 0 0 6px rgba(0, 0, 0, .04);
        min-width: 300px;
        padding: 10px 12px;
        box-sizing: border-box;
        border-radius: 2px;
        position: fixed;
        left: 50%;
        top: 20px;
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        background-color: #fff;
        transition: opacity .3s, transform .4s;
        overflow: hidden
    }

    .el-message .el-icon-circle-check {
        color: #13ce66
    }

    .el-message .el-icon-circle-cross {
        color: #ff4949
    }

    .el-message .el-icon-information {
        color: #50bfff
    }

    .el-message .el-icon-warning {
        color: #f7ba2a
    }

    .el-message__group {
        margin-left: 38px;
        position: relative;
        height: 20px;
        line-height: 20px;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center
    }

    .el-message__group p {
        font-size: 14px;
        margin: 0 34px 0 0;
        white-space: nowrap;
        color: #8391a5;
        text-align: justify
    }

    .el-message__group.is-with-icon {
        margin-left: 0
    }

    .el-message__img {
        width: 40px;
        height: 40px;
        position: absolute;
        left: 0;
        top: 0
    }

    .el-message__icon {
        vertical-align: middle;
        margin-right: 8px
    }

    .el-message__closeBtn {
        top: 3px;
        right: 0;
        position: absolute;
        cursor: pointer;
        color: #bfcbd9;
        font-size: 14px
    }

    .el-message__closeBtn:hover {
        color: #97a8be
    }

    .el-message-fade-enter,
    .el-message-fade-leave-active {
        opacity: 0;
        -ms-transform: translate(-50%, -100%);
        transform: translate(-50%, -100%)
    }

    .el-popover {
        position: absolute;
        background: #fff;
        min-width: 150px;
        border-radius: 2px;
        border: 1px solid #d1dbe5;
        padding: 10px;
        z-index: 2000;
        font-size: 12px;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .12), 0 0 6px 0 rgba(0, 0, 0, .04)
    }

    .el-popover .popper__arrow,
    .el-popover .popper__arrow::after {
        position: absolute;
        display: block;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid
    }

    .el-popover .popper__arrow {
        border-width: 6px
    }

    .el-popover .popper__arrow::after {
        content: " ";
        border-width: 6px
    }

    .el-popover[x-placement^=top] {
        margin-bottom: 12px
    }

    .el-popover[x-placement^=top] .popper__arrow {
        bottom: -6px;
        left: 50%;
        margin-right: 3px;
        border-top-color: #d1dbe5;
        border-bottom-width: 0
    }

    .el-popover[x-placement^=top] .popper__arrow::after {
        bottom: 1px;
        margin-left: -6px;
        border-top-color: #fff;
        border-bottom-width: 0
    }

    .el-popover[x-placement^=bottom] {
        margin-top: 12px
    }

    .el-popover[x-placement^=bottom] .popper__arrow {
        top: -6px;
        left: 50%;
        margin-right: 3px;
        border-top-width: 0;
        border-bottom-color: #d1dbe5
    }

    .el-popover[x-placement^=bottom] .popper__arrow::after {
        top: 1px;
        margin-left: -6px;
        border-top-width: 0;
        border-bottom-color: #fff
    }

    .el-popover[x-placement^=right] {
        margin-left: 12px
    }

    .el-popover[x-placement^=right] .popper__arrow {
        top: 50%;
        left: -6px;
        margin-bottom: 3px;
        border-right-color: #d1dbe5;
        border-left-width: 0
    }

    .el-popover[x-placement^=right] .popper__arrow::after {
        bottom: -6px;
        left: 1px;
        border-right-color: #fff;
        border-left-width: 0
    }

    .el-popover[x-placement^=left] {
        margin-right: 12px
    }

    .el-popover[x-placement^=left] .popper__arrow {
        top: 50%;
        right: -6px;
        margin-bottom: 3px;
        border-right-width: 0;
        border-left-color: #d1dbe5
    }

    .el-popover[x-placement^=left] .popper__arrow::after {
        right: 1px;
        bottom: -6px;
        margin-left: -6px;
        border-right-width: 0;
        border-left-color: #fff
    }

    .el-popover__title {
        color: #1f2d3d;
        font-size: 13px;
        line-height: 1;
        margin-bottom: 9px
    }

    .el-notification {
        width: 330px;
        padding: 20px;
        box-sizing: border-box;
        border-radius: 2px;
        position: fixed;
        right: 16px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, .12), 0 0 6px rgba(0, 0, 0, .04);
        transition: opacity .3s, transform .3s, right .3s, top .4s;
        overflow: hidden
    }

    .el-notification .el-icon-circle-check {
        color: #13ce66
    }

    .el-notification .el-icon-circle-cross {
        color: #ff4949
    }

    .el-notification .el-icon-information {
        color: #50bfff
    }

    .el-notification .el-icon-warning {
        color: #f7ba2a
    }

    .el-notification__group {
        margin-left: 0
    }

    .el-notification__group.is-with-icon {
        margin-left: 55px
    }

    .el-notification__title {
        font-weight: 400;
        font-size: 16px;
        color: #1f2d3d;
        margin: 0
    }

    .el-notification__content {
        font-size: 14px;
        line-height: 21px;
        margin: 10px 0 0;
        color: #8391a5;
        text-align: justify
    }

    .el-notification__icon {
        width: 40px;
        height: 40px;
        font-size: 40px;
        float: left;
        position: relative;
        top: 3px
    }

    .el-notification__closeBtn {
        top: 20px;
        right: 20px;
        position: absolute;
        cursor: pointer;
        color: #bfcbd9;
        font-size: 14px
    }

    .el-notification__closeBtn:hover {
        color: #97a8be
    }

    .el-notification-fade-enter {
        -ms-transform: translateX(100%);
        transform: translateX(100%);
        right: 0
    }

    .el-notification-fade-leave-active {
        opacity: 0
    }

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


    .u-btn17,
    .u-btn5,
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

    .u-btn5,
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

    .header .menu2 {
        line-height: 22px;
        font-size: 13px;
        position: absolute;
        left: 738px;
        top: 10px
    }

    .header .menu2 span {
        padding: 0 5px
    }

    .header .menu2 a {
        width: 5em
    }

    .header .menu4 {
        position: absolute;
        left: 1050px;
        top: 20px
    }



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



    .bet-modal .el-dialog__body {
        padding: 20px 20px 10px
    }

    .bet-modal input.invalid {
        border: 2px solid red;
        padding: 2px;
        border-radius: 2px
    }

    .bet-loading {
        margin: 10px auto;
        width: 145px
    }


    .bet-loading .txt {
        text-align: center;
        font-size: 12px
    }

    .group-detail .group {
        display: inline-block
    }

    .side-quick {
        position: absolute;
        left: 838px;
        top: 4px
    }

    .el-notification {
        box-shadow: 0 2px 4px rgba(0, 0, 0, .31), 0 0 6px rgba(0, 0, 0, .04)
    }

    .el-notification__title {
        font-weight: 400;
        font-size: 16px;
        color: #fff;
        margin: 0;
        padding: 3px 15px;
        display: inline-block
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

    .skin_blue .pay-dialog .el-dialog__title,
    .skin_blue .pay-dialog .el-message-box__title,
    .skin_blue.v2-dialog .el-dialog__title,
    .skin_blue.v2-dialog .el-message-box__title {
        background: #4274b3
    }

    .pay-confirm {
        width: 380px
    }

    .pay-confirm .el-dialog__body {
        padding: 0 20px 10px;
        margin-top: -7px
    }

    .pay-confirm .el-dialog__title {
        display: none!important
    }

    .transfer-confirm {
        width: 600px
    }

    .transfer-confirm .el-dialog__body {
        padding: 10px 20px 40px
    }

    .pay-dialog .el-dialog__title,
    .pay-dialog .el-message-box__title,
    .v2-dialog .el-dialog__title,
    .v2-dialog .el-message-box__title {
        color: #fff;
        padding: 6px 20px 8px 10px;
        line-height: 1.2;
        display: inline-block
    }

    .order-detail-table td {
        padding: 0 8px
    }

    .el-dialog__wrapper {
        overflow: auto!important
    }

    .iconfont {
        font-family: iconfont!important;
        font-size: 16px;
        font-style: normal;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale
    }

    .icon-trash:before {
        content: "\e600"
    }

    .icon-fangjian:before {
        content: "\e65c"
    }

    .icon-warning:before {
        content: "\e609"
    }

    .icon-close:before {
        content: "\e626"
    }

    .icon-kuanduzuidahua:before {
        content: "\e671"
    }

    .icon-guanbi:before {
        content: "\e621"
    }

    .icon-50:before {
        content: "\e632"
    }

    .icon-baequnzu:before {
        content: "\e6b9"
    }

    .icon-hongbao-copy:before {
        content: "\e61d"
    }

    .icon-tuichu:before {
        content: "\e615"
    }

    .icon-quit:before {
        content: "\e6f4"
    }

    .icon-liaotianjilu:before {
        content: "\e620"
    }

    .icon-duorenliaotian:before {
        content: "\e664"
    }

    .icon-hongbao:before {
        content: "\e613"
    }

    .icon-liaotianjiemiangengduo:before {
        content: "\e635"
    }

    .icon-qq:before {
        content: "\e614"
    }

    .icon-liaotianshanchu:before {
        content: "\e61b"
    }

    .icon-jinggao:before {
        content: "\e686"
    }

    .icon-shitufangdahengxiang:before {
        content: "\e6d3"
    }

    .icon-shitusuoxiaohengxiang:before {
        content: "\e6d4"
    }

    .icon-tuichu1:before {
        content: "\e655"
    }

    .icon-liaotianzhiding:before {
        content: "\e7f5"
    }

    .icon-qian:before {
        content: "\e681"
    }

    .icon-erjiyemian-liaotianduihua-danchuangtianjiatupian:before {
        content: "\e673"
    }

    .icon-chat-history:before {
        content: "\e69a"
    }

    .icon-liaotianbiaoqing:before {
        content: "\e60e"
    }

    .icon-yonghu-qunzu:before {
        content: "\e646"
    }

    .icon-tianjiaqunzu:before {
        content: "\e67a"
    }

    .icon-pchart-image:before {
        content: "\e64b"
    }

    .icon-zuixiaohua:before {
        content: "\e618"
    }

    .icon-tubiaozhizuomoban:before {
        content: "\e67c"
    }

    .icon-suoxiaopingmu:before {
        content: "\e705"
    }

    .icon-user:before {
        content: "\e65d"
    }

    .icon-qingchuliaotianjilu:before {
        content: "\e643"
    }

    .icon-announcement:before {
        content: "\e799"
    }

    .icon-popup:before {
        content: "\e79c"
    }

    .icon-Scroller-:before {
        content: "\e871"
    }


    /*需要精简的css代码*/

</style>
