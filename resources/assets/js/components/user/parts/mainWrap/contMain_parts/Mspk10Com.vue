<template>
    <div class="cont-main">

        <cart-list :tableData="{ gridData: cartList }" :showChildCartList="showChildCartDialog"></cart-list>
        <!--{{Mspk10LmpProduct_1}}-->
        <!--{{cartList}}-->

        <!--{{Mspk10LmpProduct_2_1}}-->
        <!--{{Mspk10LmpProduct_2_2}}-->
        <div class="cont-col3">
            <div class="u-header play_tab_1 clearfix">
                <div class="fl"><span id="page_game_name">秒速赛车</span>&nbsp;&nbsp;-&nbsp;&nbsp;<span
                        id="page_name">冠亚组合</span> <span id="total_sum_money_text">
                                &nbsp;&nbsp;
                                当前彩种输赢：<span id="total_sum_money">{{currentWin}}</span></span>
                </div>
                <div class="fr"><span id="next_turn_num">{{currentExpect}}</span>&nbsp;期 距离封盘：
                    <span id="bet-date">{{seal | TimeFilter}}</span> 距离开奖：
                    <span id="open-date">{{openLottery | TimeFilter}}</span></div>
            </div>
            <audio src="/static/assets/win.mp3" autoplay v-if="openSoundAlways && openCodeSound"></audio>
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
                <Mspk10ComProduct :info="{ productTitle: Mspk10LmpName, productContent: Mspk10LmpInput, product_1: Mspk10LmpProduct_1, product_2_1: Mspk10LmpProduct_2_1, product_2_2: Mspk10LmpProduct_2_2}"></Mspk10ComProduct>

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
    import Mspk10ComProduct from './product_item/Mspk10ComProduct'
    import CartList from '../cart/cartList.vue'


    import { mapGetters, mapActions } from 'vuex'
    let timer

    export default {
        name: "cont-main",
        components: {
            Mspk10ComProduct,
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
                           Mspk10LmpProduct_1: 'getMspk10LmpProduct_1',
                           Mspk10LmpProduct_2_1: 'getMspk10LmpProduct_2_1',
                           Mspk10LmpProduct_2_2: 'getMspk10LmpProduct_2_2',
                           // myState: 'getMyState',
                           BET_AMOUNT_myState: 'getBetAmount',
                           // 获取cartList里面的值,以便于在cartList中展示
                           cartList: 'getCartList',
                // 开奖声因
                openCodeSound: 'getOpenCodeSound',
                openSoundAlways: 'getOpenSoundAlways',
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
            this.$store.dispatch('getMspk10LmpProduct_1')
            this.$store.dispatch('getMspk10LmpProduct_2_1')
            this.$store.dispatch('getMspk10LmpProduct_2_2')

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


                    var _data = JSON.parse(response.data);
                    clearInterval(timer)
                    // console.log(_this.result);
                    // djs_param = response.data;
                    // console.log(_this.result);
                    var djs = parseInt(
                        //     // 75 - (res.servertime - res.opentimestamp)
                        //     // console.log(this.result)
                        75 - (_data.servertime - _data.opentimestamp)
                    )
                    // 将数据存入vuex
                    _this.$store.dispatch('storeMsscOpenCodeData', {openCode: _data})

                    //　设置定时器
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
    .icon {
        display: inline-block;
        vertical-align: middle;
        overflow: hidden;
        /*background: url(/src/assets/userimg/044contMain_gy/images/icon-sprites.png) no-repeat 0 0*/
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
    .c-txt3 {
        color: red;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        padding: 0 4px
    }

    .fs-1 {
        font-size: 14px
    }
    input {
        font-family: '\5FAE\8F6F\96C5\9ED1'
    }
    #result_balls {
        position: absolute;
        left: 130px;
        top: 10px
    }
    .main-wrap {
        position: absolute;
        width: 100%;
        top: 137px;
        bottom: 0
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
    .arrow {
        display: inline-block;
        vertical-align: middle;
        margin-left: 5px;
        margin-top: 3px;
        width: 0;
        height: 0;
        overflow: hidden;
        border-style: solid;
        border-width: 5px;
        border-color: #fff transparent transparent transparent
    }

    .subnav-box li.other {
        padding: 0 5px
    }

    .subnav-box li.other:hover {
        text-decoration: none;
        background: #660901
    }

    .more-extend {
        display: none;
        position: absolute;
        left: -1px;
        top: 56px;
        width: 100%;
        background: #660901;
        border: 1px solid #660901
    }

    .subnav-box li .more-extend a {
        display: block;
        height: 34px;
        line-height: 34px;
        padding: 0 10px;
        border: none;
        white-space: nowrap
    }

    .subnav-box li .more-extend a:hover {
        background: #9e040a
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
        /*background: url(/src/assets/userimg/044contMain_gy/images/skin/blue/text_input.gif) repeat-x left top;*/
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
        /*background: url(/src/assets/userimg/044contMain_gy/images/skin/blue/text_input.gif) repeat-x left top;*/
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
    .u-table4 td.f1 {
        background-color: #fff
    }

    .bg_td {
        background-color: #f7ebeb!important
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


    .not-event {
        cursor: auto!important
    }

    .u-ipt1-disable {
        background: #e3e3d3!important
    }

    .checkbox_td>input {
        cursor: pointer
    }

    .radio_td {
        cursor: pointer
    }
    .history-main {
        background: 0 0;
        overflow-x: hidden;
        min-width: auto
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

    .side_left .r-wrap {
        width: 190px;
        font-weight: 700;
        margin: 4px 5px 0 5px;
        line-height: 16px
    }

    .side_left .r-nowrap1 {
        font-size: 14px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px
    }

    .side_left .nowrap2 {
        display: inline-block;
        width: 88px;
        height: 34px;
        line-height: 34px;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px
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
    #skinPanel {
        display: inline-block;
        color: #fff;
        cursor: pointer
    }

    #skinPanel ul {
        padding: 0 0 10px 0;
        margin-left: -5px;
        list-style: none;
        position: absolute;
        width: 62px;
        z-index: 999;
        display: none
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
        /*background: url(/src/assets/userimg/044contMain_gy/images/skin/blue/main_bg.jpg) no-repeat 0 0*/
    }

    .skin_blue #skinPanel:hover .skin_blue .skinHover ul,
    .skin_blue #skinPanel:hover ul,
    .skin_blue .skinHover {
        background: #234b95
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
    .skin_blue .bet-bottom {
        border: 1px solid #b9c2cb
    }

    .skin_blue .bet-bottom .bcount {
        border-right: 1px solid #b9c2cb
    }

    .skin_blue .skinbtn {
        background-color: #4987d7;
        color: #fff
    }

    .skin_blue .skin-font-color {
        color: #35406d
    }

    .skin_blue #lastBets li {
        border-top: 1px solid #b9c2cb
    }

    .skin_blue .pop-tips {
        border: 1px solid #4092f6
    }

    .skin_blue .pop-tips-hd {
        background: #4987d7;
        color: #fff
    }

    .skin_blue .r-wrap,
    .skin_blue .r-wrap a {
        color: #fff
    }

    .skin_blue .r-nowrap1 {
        background: #2161b3
    }

    .skin_blue .nowrap2 {
        border: 1px solid #f4521b;
        background: #ff9461;
        background: -moz-linear-gradient(top, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
        background: linear-gradient(to bottom, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%)
    }

    .skin_blue .nowrap2:hover {
        /*background: url(/src/assets/userimg/044contMain_gy/images/skin/blue/announce-bg.png) no-repeat center bottom*/
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


</style>
