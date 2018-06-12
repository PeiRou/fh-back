<template>
    <div>
        <div id="lastBets" class="side_left" style="display: block;">
            <ul class="bets">
                <!--{{orderList}}-->
                <!--{{orderListWithGoodsName}}-->
                <!--<li v-for="item in orderList"><p>期号：<span class="bid">{{item.expect}}</span></p>-->
                <li v-for="item in this.orderListWithGoodsName"><p>期号：<span class="bid">{{item.expect}}</span></p>
                    <p>
                        <!--{{item}}-->
                        内容：<span class="text"> {{item.goodsName}}
                        <!----> <!----></span>@ <span class="odds">{{item.odds}}</span></p>
                    <p>金额：￥{{item.count}}</p></li>
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text"> 特单-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">1.97</span></p>-->
                <!--<p>金额：￥46</p></li>-->
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text"> 特合双-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">1.97</span></p>-->
                <!--<p>金额：￥5</p></li>-->
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text"> 特天肖-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">1.97</span></p>-->
                <!--<p>金额：￥5</p></li>-->
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text">特码B 11-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">48.6</span></p>-->
                <!--<p>金额：￥2</p></li>-->
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text"> 特单-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">1.97</span></p>-->
                <!--<p>金额：￥23</p></li>-->
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text"> 特大-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">1.97</span></p>-->
                <!--<p>金额：￥23</p></li>-->
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text"> 特单-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">1.97</span></p>-->
                <!--<p>金额：￥23</p></li>-->
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text"> 特单-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">1.97</span></p>-->
                <!--<p>金额：￥23</p></li>-->
                <!--<li><p>期号：<span class="bid">2018016</span></p>-->
                <!--<p>-->
                <!--内容：<span class="text">特码A 21-->
                <!--&lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;</span>@ <span class="odds">42.2</span></p>-->
                <!--<p>金额：￥23</p></li>-->
            </ul>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "order-list",
        data() {
            return {
                orderListFromBack: {}
            }
        },
        computed: {
            ...mapGetters({
                orderList: 'getOrderList',
                currentGameCode: 'getCurrentGameCode', // 从localStorage里面取出
                plays: 'getMspk10LmpPlays',
                playCates: 'getMspk10LmpPlayCates',
            }),
            currentGameCodeFromLocalStorage: {
                get: function () {
                    let code = window.localStorage.getItem('currentGameCode')
                    return code
                }

            },
            gameIdComputed: {
                get: function(){
                    switch (this.currentGameCodeFromLocalStorage){
                        case 'jspk10':
                            return '80'
                        case 'pk10':
                            return '50'
                        case 'jsft':
                            return '82'
                        case 'jsssc':
                            return '81'
                        case 'cqssc':
                            return '1'
                        default:
                            return '80'
                    }
                }
            },
            orderListWithGoodsName: {
                get: function () {

                    // 通过id获取名字，通过playCateId获取第二个参数
                    // return this.plays
                    let emptyArr = []
                    // this.cartList.forEach(cartItem => {
                    //     for(let item in this.plays) {
                    //         // console.log(item)
                    //         if(item == cartItem.id){
                    //             this.plays[item].count = cartItem.count
                    //             emptyArr.push(this.plays[item])
                    //         }
                    //     }
                    // })
                    // 存在于vuex里面的，只存id，之后需要什么数据，就取出什么数据
                    // //1. 将相关的信息从plays里面取出
                    // this.cartList.forEach(cartItem => {
                    //     for(let item in this.plays) {
                    //         // console.log(item)
                    //         if(item === cartItem.id){
                    //             cartItem.name         = this.plays[item].name
                    //             cartItem.playCateId   = this.plays[item].playCateId
                    //             cartItem.odds         = this.plays[item].odds
                    //             cartItem.rebate       = this.plays[item].rebate
                    //             cartItem.minMoney     = this.plays[item].minMoney
                    //             cartItem.maxMoney     = this.plays[item].maxMoney
                    //             cartItem.maxTurnMoney = this.plays[item].maxTurnMoney
                    //
                    //         }
                    //     }
                    // })
                    //
                    // //2. 将相关的信息(playCate 的名字)从playCates里面取出
                    // this.cartList.forEach(cartItem => {
                    //     for(let item in this.playCates) {
                    //         // console.log(item)
                    //         if(item === cartItem.playCateId){
                    //             cartItem.playCatesName        = this.playCates[item].name
                    //             // console.log(cartItem)
                    //         }
                    //     }
                    // })
                    //
                    // //3. 将名字组合起来
                    // this.cartList.forEach(cartItem => {
                    //     if(cartItem.playCateId === 1) {
                    //         cartItem.goodsName = cartItem.name
                    //     } else {
                    //         cartItem.goodsName = cartItem.playCatesName + ' ' + cartItem.name
                    //     }
                    // })
                    //
                    //4.将cart中的信息存入emptyArr
                    // this.cartList.forEach(cartItem => {
                    //     emptyArr.push(cartItem)
                    // })

                    // 将前面四步的内容合并在一起，这里特别要注意for循环是并行的要用if把这些for循环连接起来
                    let step = 0
                    this.orderList.forEach(cartItem => {
                        if (step === 0) {
                            for (let item in this.plays) {
                                //1. 将相关的信息从plays里面取出
                                if (item == cartItem.id) {
                                    cartItem.gameId = this.plays[item].gameId
                                    cartItem.name = this.plays[item].name
                                    cartItem.playCateId = this.plays[item].playCateId
                                    cartItem.odds = this.plays[item].odds
                                    cartItem.rebate = this.plays[item].rebate
                                    cartItem.minMoney = this.plays[item].minMoney
                                    cartItem.maxMoney = this.plays[item].maxMoney
                                    cartItem.maxTurnMoney = this.plays[item].maxTurnMoney

                                    // 加入开奖期数 通过当前页面获取相关的期数，先不考虑客户 多个彩种同时下注的情况

                                }
                            }
                            step++
                        }
                        if (step === 1) {
                            //2. 将相关的信息(playCate 的名字)从playCates里面取出
                            for (let item in this.playCates) {
                                // console.log(item)
                                if (item == cartItem.playCateId) {
                                    cartItem.playCatesName = this.playCates[item].name
                                    cartItem.playCateNameId = this.playCates[item].id
                                    // console.log(cartItem)
                                }
                            }
                            step++
                        }
                        if (step === 2) {
                            // console.log(cartItem.playCateNameId)
                            // 这里需要如果名字是总和-龙虎和，那么需要playCateName不用加上
                            if (cartItem.playCateNameId == 1) {
                                cartItem.goodsName = cartItem.name
                            } else {
                                cartItem.goodsName = cartItem.playCatesName + ' - ' + cartItem.name
                            }
                            step++
                        }
                        if (step === 3) {
                            //4.将cart中的信息存入emptyArr
                            emptyArr.push(cartItem)
                            //最后一步将step清0
                            step = 0
                        }
                    })
                    // console.log(_this.emptyArr)
                    // console.log(step)
                    return emptyArr;
                }
            }
        },
        mounted() {
            // 获取用户注单信息
            axios.get('/web/getOrders/' + this.gameIdComputed).then(response => {
                this.orderListFromBack = response.data
                // console.log('从后台获取的数据')
                // 这里获取的数据中的期数字段需要从 issue改成expect
                this.$store.dispatch('StoreOrderListFromBack', this.orderListFromBack)
            })
        }
    }
</script>

<style scoped>

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

    .sider-col2 {
        margin: 0 1px
    }

    #lastBets {
        display: none
    }

    #lastBets .bets {
        border-left: 1px solid #b9c2cb;
        border-right: 1px solid #b9c2cb;
        color: #000;
        width: 188px;
        overflow-y: auto;
        text-indent: 5px;
        text-align: left;
        margin: 4px 4px 0 4px;
        max-height: 300px
    }

    #betResultPanel li {
        background: #fff none repeat scroll 0 0;
        border-top: 1px solid;
        padding: 1px
    }

    #lastBets li {
        background: #fff none repeat scroll 0 0;
        padding: 1px
    }

    #lastBets li:nth-child(2n) {
        background: #efefef none repeat scroll 0 0
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

    .side_left li {
        position: relative
    }

    .side_left li a {
        display: block;
        width: 100%;
        height: 100%
    }

</style>