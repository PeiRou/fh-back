<template>
    <div class="cont-main">

        <cart-list :tableData="{ gridData: cartList }" :showChildCartList="showChildCartDialog"></cart-list>
        <!--{{Mspk10LmpProduct_1}}-->
        <!--{{cartList}}-->
        <!--{{Mspk10LmpProduct_1}}-->

        <!--{{Mspk10LmpProduct_2_1}}-->
        <!--{{Mspk10LmpProduct_2_2}}-->
        <div class="cont-col3">
            <div class="u-header play_tab_1 clearfix">
                <div class="fl"><span id="page_game_name">幸运蛋蛋</span>&nbsp;&nbsp;-&nbsp;&nbsp;<span
                        id="page_name">幸运蛋蛋</span> <span id="total_sum_money_text">
                                &nbsp;&nbsp;
                                当前彩种输赢：<span id="total_sum_money">{{currentWin}}</span></span>
                </div>
                <div class="fr"><span id="next_turn_num">{{currentExpect}}</span>&nbsp;期 距离封盘：
                    <span id="bet-date">{{seal | TimeFilter}}</span> 距离开奖：
                    <span id="open-date">{{openLottery | TimeFilter}}</span></div>
            </div>
            <div>
                <div class="cont-col3-hd clearfix">
                    <!--<div class="cont-col3-box2"><span> 金额 </span> <input type="number" class="bet-money" v-model="message">-->
                        <!--{{this.myState}}-->
                    <!--</div>-->
                        <div class="cont-col3-box2"><span> 金额 </span> <input type="number" class="bet-money" v-model="BET_AMOUNT">
                        <!--{{this.myState}}-->
                        <!--{{ this.BET_AMOUNT_myState }}-->
                        <a href="javascript:void(0)" class="u-btn1" @click="showCart()">确定</a>
                        <a href="javascript:void(0)" class="u-btn1" @click="resetCart()">重置</a>
                    </div>
                </div>

                <!--商品组件：里面包括两种商品：1.顶部 product_1; 2.下面 product_2_1 product_2_2,注意循环的时候, productId可以循环之后传入，productContent要传入之后，再循环，因为productContent有多个，键名会重复，必须最后一步循环．title对应的是id．content对应的是playCateId．传递的的过程中info要用json的形式，数据从api里面product获取，created的时候获取放入vuex中，然后再取出-->

                <Mspk10LmpProduct :info="{ productTitle: Mspk10LmpName, productContent: Mspk10LmpInput, product_1: Mspk10LmpProduct_1, product_2_1: Mspk10LmpProduct_2_1, product_2_2: Mspk10LmpProduct_2_2}"></Mspk10LmpProduct>

                <div class="cont-col3-hd clearfix" style="margin-top: 15px;">
                    <div class="cont-col3-box2"><span>金额 </span> <input type="number" class="bet-money" v-model="BET_AMOUNT">
                        <a href="javascript:void(0)" class="u-btn1" @click="showCart()">确定</a>
                        <a href="javascript:void(0)" class="u-btn1" @click="resetCart()">重置</a>
                    </div>
                </div>
                <!--<div class="el-dialog__wrapper" style="display: none;">-->
                <!--<div class="el-dialog el-dialog&#45;&#45;small changeBetResultStat-modal" style="top: 15%;">-->
                <!--<div class="el-dialog__header"><span-->
                <!--class="el-dialog__title">下注明细 (请确认注单)</span>-->
                <!--<button type="button" aria-label="Close" class="el-dialog__headerbtn"><i-->
                <!--class="el-dialog__close el-icon el-icon-close"></i></button>-->
                <!--</div>-->
                <!--&lt;!&ndash;&ndash;&gt;-->
                <!--&lt;!&ndash;&ndash;&gt;-->
                <!--</div>-->
                <!--</div>-->
            </div>
        </div>
        <div class="count-wrap">
            <table id="stat_qiu" class="u-table2">
                <thead>
                <tr>
                    <th class="u-tb3-th2" v-for="(v,k) in betResult" :class="{ select: selectedBetResult === k }"
                        @click="clickChangeBetResult(k)">{{ v.name }}
                    </th>


                    <!--<th class="u-tb3-th2 select">冠军</th>-->
                    <!--<th class="u-tb3-th2">亚军</th>-->
                    <!--<th class="u-tb3-th2">第三名</th>-->
                    <!--<th class="u-tb3-th2">第四名</th>-->
                    <!--<th class="u-tb3-th2">第五名</th>-->
                    <!--<th class="u-tb3-th2">第六名</th>-->
                    <!--<th class="u-tb3-th2">第七名</th>-->
                    <!--<th class="u-tb3-th2">第八名</th>-->
                    <!--<th class="u-tb3-th2">第九名</th>-->
                    <!--<th class="u-tb3-th2">第十名</th>-->
                </tr>
                </thead>
            </table>
            <table class="u-table4">
                <tbody>
                <tr>
                    <td class="f1 fwb">1</td>
                    <td class="f1 fwb">2</td>
                    <td class="f1 fwb">3</td>
                    <td class="f1 fwb">4</td>
                    <td class="f1 fwb">5</td>
                    <td class="f1 fwb">6</td>
                    <td class="f1 fwb">7</td>
                    <td class="f1 fwb">8</td>
                    <td class="f1 fwb">9</td>
                    <td class="f1 fwb">10</td>
                </tr>
                <tr>
                    <td>27</td>
                    <td>18</td>
                    <td>29</td>
                    <td>26</td>
                    <td>27</td>
                    <td>27</td>
                    <td>21</td>
                    <td>14</td>
                    <td>32</td>
                    <td>20</td>
                </tr>
                </tbody>
            </table>
            <table class="u-table2 mt5">
                <thead>
                <tr id="stat_type">
                    <th class="u-tb3-th2" v-for="(v,k) in changeBetResultStat"
                        :class="{ select: selectedBetResultStat === k }" @click="clickChangeBetResultStat(k)">
                        {{ v.name }}
                    </th>


                    <!--<th class="u-tb3-th2 select">-->
                    <!--冠军-->
                    <!--</th>-->
                    <!--<th class="u-tb3-th2">-->
                    <!--大小-->
                    <!--</th>-->
                    <!--<th class="u-tb3-th2">-->
                    <!--单双-->
                    <!--</th>-->
                    <!--<th class="u-tb3-th2">-->
                    <!--冠、亚军和-->
                    <!--</th>-->
                    <!--<th class="u-tb3-th2">-->
                    <!--冠、亚军和 大小-->
                    <!--</th>-->
                    <!--<th class="u-tb3-th2">-->
                    <!--冠、亚军和 单双-->
                    <!--</th>-->
                </tr>
                </thead>
            </table>
            <div>
                <table class="u-table4 table-td-valign-top">
                    <tbody>
                    <!--<tr class="stattd" v-html="stat_html">-->
                    <tr class="stattd">
                        <td>1</td>
                        <td>7</td>
                        <td>5</td>
                        <td>9<br>9</td>
                        <td>1</td>
                        <td>4</td>
                        <td>7</td>
                        <td>1<br>1</td>
                        <td>7</td>
                        <td>1</td>
                        <td>2</td>
                        <td>1<br>1</td>
                        <td>3</td>
                        <td>5</td>
                        <td>4</td>
                        <td>5</td>
                        <td>9</td>
                        <td>3<br>3</td>
                        <td>9</td>
                        <td>10</td>
                        <td>5</td>
                        <td>3</td>
                        <td>7</td>
                        <td>6</td>
                        <td>3</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    // 引入商品　投注页面
    import Mspk10LmpProduct from './product_item/XyddXyddProduct'
    import CartList from '../cart/cartList.vue'


    import { mapGetters, mapActions } from 'vuex'
    let timer

    export default {
        name: "cont-main",
        components: {
            Mspk10LmpProduct,
            CartList
        },
        data() {
            return {
                // 距离开奖时间
                openLottery: 0,
                // 距离封盘时间
                seal:0,
                // Mspk10LmpPlayCates: [8014001, 8014002, 8014003, 8014004, 8014005, 8014006, 8014101, 8014102, 8014103, 8014104, 8014105, 8014106, 8014201, 8014202, 8014203, 8014204, 8014205, 8014206, 8014301, 8014302, 8014303, 8014304, 8014305, 8014306, 8014401, 8014402, 8014403, 8014404, 8014405, 8014406, 8014501, 8014502, 8014503, 8014504, 8014505, 8014506, 8014601, 8014602, 8014603, 8014604, 8014701, 8014702, 8014703, 8014704, 8014801, 8014802, 8014803, 8014804, 8014901, 8014902, 8014903, 8014904, 8015001, 8015002, 8015003, 8015004],
                showChildCartDialog: {changeClass: false},

                // 底部中奖统计选中效果
                betResult: [
                    {'name': '冠军'},
                    {'name': '亚军'},
                    {'name': '第三名'},
                    {'name': '第四名'},
                    {'name': '第五名'},
                    {'name': '第六名'},
                    {'name': '第七名'},
                    {'name': '第八名'},
                    {'name': '第九名'},
                    {'name': '第十名'}
                ],
                selectedBetResult: 0,

                changeBetResultStat: [
                    {'name': '冠军'},
                    {'name': '大小'},
                    {'name': '单双'},
                    {'name': '冠、亚军和'},
                    {'name': '冠、亚军和 大小'},
                    {'name': '冠、亚军和 单双'}
                ],
                selectedBetResultStat: 0,
                // 底部中奖统计选中效果 结束
            }
        },
        computed: {
            ...mapGetters({
                           Mspk10LmpName: 'getMspk10LmpPlayCates',
                           Mspk10LmpInput: 'getMspk10LmpPlays',
                           Mspk10LmpProduct_1: 'getXyddXydd_Product_1',
                           Mspk10LmpProduct_2_1: 'getXyddXydd_Product_2',
                           Mspk10LmpProduct_2_2: 'getXyddXydd_Product_3',
                           // myState: 'getMyState',
                           BET_AMOUNT_myState: 'getBetAmount',
                           // 获取cartList里面的值,以便于在cartList中展示
                           cartList: 'getCartList',
                // 获取当前期数(3-1)
                currentGameCode: 'getCurrentGameCode',
                msscOpenCodeData: 'getMsscOpenCodeData',
                bjpk10OpenCodeData: 'getBjpk10OpenCodeData',
                msftOpenCodeData: 'getMsftOpenCodeData',
                mssscOpenCodeData: 'getMssscOpenCodeData',
                cqsscOpenCodeData: 'getCqsscOpenCodeData',
                currentWin: 'getCurrentWin'
                //　获取当前期数(3-1)
                       }),

            gameIdComputed: {
                get: function(){
                    switch (this.currentGameCode){
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
            // message: {
            //     get() {
            //         // alert (this.$store.getters.getMyState)
            //         return this.$store.getters.getMyState
            //     },
            //     set (value) {
            //         // alert(value)
            //         this.$store.commit('updateMyState',value)
            //     }
            //
            // },
            BET_AMOUNT: {
                get () {
                    // alert (this.$store.getters.getBetAmount)
                    return this.$store.getters.getBetAmount
                },
                set (value) {
                    // alert(value);
                    this.$store.dispatch('setBetAmount', value)
                }
            },
            // 获取当前期数(3-2)

            currentExpect: {
                get: function () {
                    // 这里直接用组件化后的形式
                    // 加入开奖期数 通过当前页面获取相关的期数，先不考虑客户 多个彩种同时下注的情况

                    // 从localStorage里面取currentGameCode出来
                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                    let currentGameCode = 'jspk10'
                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，




                    // alert(this.currentGameCode)
                    // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                    if (this.currentGameCode === 'jspk10') {
                        currentGameCode = 'jspk10' // vuex里面的值

                        let currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode') // 从localStorage里面取出的
                        if (currentGameCodeFromLocalStorage != null) {
                            currentGameCode = currentGameCodeFromLocalStorage
                        }

                    }
                    if (this.currentGameCode === 'pk10') {
                        currentGameCode = 'pk10'
                    }
                    if (this.currentGameCode === 'jsft') {
                        currentGameCode = 'jsft'
                    }
                    if (this.currentGameCode === 'jsssc') {
                        currentGameCode = 'jsssc'
                    }
                    if (this.currentGameCode === 'cqssc') {
                        currentGameCode = 'cqssc'
                    }

                    // 从localStorage里面取currentGameCode出来 end



                    switch (currentGameCode) {
                        case 'jspk10':
                            let currentExpect1 = parseInt(this.msscOpenCodeData.expect) + 1
                            return currentExpect1
                        case 'pk10':
                            let currentExpect2 = parseInt(this.bjpk10OpenCodeData.expect) + 1
                            return currentExpect2
                        case 'jsft':
                            let currentExpect3 = parseInt(this.msftOpenCodeData.expect) + 1
                            return currentExpect3
                        case 'jsssc':
                            let currentExpect4 = parseInt(this.mssscOpenCodeData.expect) + 1
                            return currentExpect4
                        case 'cqssc':
                            let currentExpect5 = parseInt(this.cqsscOpenCodeData.expect) + 1
                            return currentExpect5
                        default:
                            alert('路由里面没有这个值，请查看routes/index')
                            return '没有这个期数'
                            break
                        // console.log(cartItem)
                    }
                }
            }
            // 获取当前期数(3-2)
        },
        created() {
            // this.$store.dispatch('getMspk10LmpPlayCates')
            // this.$store.dispatch('getMspk10LmpPlays')

            this.$store.dispatch('getXyddXyddProduct_1')
            this.$store.dispatch('getXyddXyddProduct_2')
            this.$store.dispatch('getXyddXyddProduct_3')

            this.$store.dispatch('contSiderShowTrue')
        },
        methods: {
            initOrder() {
                this.$store.dispatch('initOrder')
            },
            initCart() {
                this.$store.dispatch('initCart')
            },
            // 如果购物车为空,不能下注
                    open_empty_cartList_error() {
                        this.$alert('没有购买任何彩票,下注失败', '提示', {
                            confirmButtonText: '确定',
                            callback: action => {
                                this.$message({
                                    type: 'danger',
                                    message: `action: ${ action }`
                                });
                            }
                        });
                    },

            //点击更换底部active效果
            clickChangeBetResult(k) {
                // alert(k);
                this.selectedBetResult = k
            },
            clickChangeBetResultStat(k) {
                // alert(k);
                this.selectedBetResultStat = k
            },
            showCart(){

                let step = 0
                // start (1)如果封盘，则不能下注

                if(step === 0) {
                    if(this.mspk10LmpSealIsTrue === true) {
                        this.$alert('已经封盘，请开盘后再投注', '无法投注', {
                            type: 'error',
                            confirmButtonText: '确定',
                            // callback: action => {
                            //     this.$message({
                            //         type: 'error',
                            //         message: `action: ${ action }`
                            //     });
                            // }
                        });
                        return
                    }

                    step ++
                }

                // end (1)如果封盘，则不能下注

                // start (2)处理购物车为0的情况，如果全部为0，则提示下注内容不正确。然后购物车弹出来的时候，我们需要将0筛选删除


                let ifAllZero = 0

                if(step === 1) {
                    for(let item in this.cartList) {
                        if(this.cartList[item].count !== 0) {
                            ifAllZero ++
                        }
                    }

                    step ++

                }

                if(step === 2) {
                    if (ifAllZero !== 0) {
                        step ++
                    } else {
                        this.$alert('下注内容不正确，请重新下注', '提示', {
                            confirmButtonText: '确定',
                            type: 'error',
                            // callback: action => {
                            //     this.$message({
                            //         // type: 'error',
                            //         // message: `action: ${ action }`
                            //     });
                            //
                            // }
                        });

                        return
                    }
                }
                // end (2)处理购物车为0的情况，如果全部为0，则提示下注内容不正确。然后购物车弹出来的时候，我们需要将0筛选删除




                if(step === 3) {

                    // alert('showCart');

                    // 点击确定的时候，从购物车中将count为0的删除
                    this.$store.dispatch('deleteCountZeroGoods')





                    // 购物车为空时,不能完成下注
                    if(this.cartList.length === 0) {
                        this.open_empty_cartList_error();
                    } else {
                        this.showChildCartDialog.changeClass = true;
                    }

                }
            },
            // 重置购物车
            resetCart(){
                this.$store.dispatch('resetCart')
            },
            // 获取接口数据
            getData () {

                let _this= this;
                window.axios.get("/api/getMssc").then(function (response) {
                    clearInterval(timer)
                    // console.log(_this.result);
                    // djs_param = response.data;
                    // console.log(_this.result);
                    var djs = parseInt(
                        //     // 75 - (res.servertime - res.opentimestamp)
                        //     // console.log(this.result)
                        75 - (response.data.servertime - response.data.opentimestamp)
                    )

                    timer = setInterval(() => {
                        //     // console.log(djs)
                        //     // console.log(res.servertime)
                        //     // console.log(res.opentimestamp)
                        _this.seal = djs - 15
                        // console.log("seal: " + _this.seal)
                        _this.openLottery = djs --
                        // console.log("openLottery: " + _this.openLottery)
                    }, 1000)

                }).catch(function (error) {

                    console.log(error);
                });

                // 将所有状态变为初始状态
                this.$store.dispatch('setSealIsTrueToFalse')



            }


        },
        watch: {
            seal: function (val) {
                if (val <= 0 || val == '已封盘') {

                    // this.sealIstrue = true;
                    this.$store.dispatch('setSealIsTrueToTrue')
                    this.seal = "已封盘"
                } else {
                    // this.mspk10LmpSealIsTrue = false;
                }
            },
            openLottery : function(val){
                if(val <= 0){
                    this.$store.dispatch('setOpenCodeSoundToTrue')
                    this.getData()

                    // 每次开奖的时候，从后台拉取当前彩种输赢
                    axios.get('/web/getCurrentWin/' + this.gameIdComputed).then(response => {
                        this.currentWin = response.data
                        // console.log('hello')
                        // console.log(this.currentWin)
                        this.$store.dispatch('storeCurrentWinFromBack', this.currentWin)
                    })
                }
            }
        },

        mounted(){
            // 初始化，订单变空，然后从后台拉去数据
            // 初始化订单
            this.initOrder()

            // 从后台拉取订单页面放入orderList
            // 获取用户注单信息
            axios.get('/web/getOrders/' + this.gameIdComputed).then(response => {
                this.orderListFromBack = response.data
                // console.log('从后台获取的数据')
                // 这里获取的数据中的期数字段需要从 issue改成expect
                this.$store.dispatch('StoreOrderListFromBack', this.orderListFromBack)
            })

            // 初始化，订单变空，然后从后台拉去数据 end

            // 初始化购物车
            this.initCart()
            // 获取数据
            this.getData()
        },
        filters:{
            TimeFilter(val){
                if(val < 10){
                    val = '00:0'+val
                }else if(val <= 60){
                    val = '00:'+val
                }else if(val > 60){
                    var minute = parseInt(val / 60)
                    var second = val % 60
                    if(minute < 10){
                        minute = '0' + minute
                    }
                    if(second < 10) {
                        second = '0' + second
                    }
                    val = minute +':'+second
                }
                return val
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
