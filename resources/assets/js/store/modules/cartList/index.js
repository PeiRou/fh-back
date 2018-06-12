import * as types from "./../../mutation-types"
// 现在先将封盘与否的处理好
// 引入mspk10的购物车模块
// import mspk10CartList from './mspk10CartList'
// 由于不考虑交叉下注的情况，所以我们这暂时没有必要把购物车里分成不同的彩种

// 与用户有关的公共部分，例如money则放在这里，然后其他的模块里面的投注金额则放在外面
// init state

const state = {
    ifBankCard: false,
    currentWin: 0, // 当前彩种输赢


    money: 0, // 从authUser里面换过来的
    betAmount: 0,                // 设置全局投注金额
    cartList: [],                //
    orderList: [],               //
    contSider_show: false,       // 点击购买彩票，contSider显示出来，点击顶部，contSider隐藏
    // clearAllChecked_Mspk10: false  // 点击结算(cartList)的时候，将这个值变为true,监听这个值，如果变为false，则清空所有选中效果。然后点击购买商品的时候，这个值变为false.表示有选中的。不是所有的商品都为false。其实商品选中效果，最好是通过判断购物车中有没有这个商品来得直接 id是否在购物车中


    // 原来写的demo
    msscLmpOpenCodeData: {
        code: 'mssc',
        expect: '',
        opencode: '',
        servertime: 1521754796,
        opentimestamp: 1521754896
    },

    // 现在使用socket的demo (只与顶部的变化有关)
    msscOpenCodeData: {
        code: 'mssc',
        opencode: '',
        expect: '--',
    },
    bjpk10OpenCodeData: {
        code: 'bjpk10',
        opencode: '',
        expect: '--',
    },
    msftOpenCodeData: {
        code: 'msft',
        opencode: '',
        expect: '--',
    },
    mssscOpenCodeData: {
        code: 'msssc',
        opencode: '',
        expect: '--',
    },
    cqsscOpenCodeData: {
        code: 'cqssc',
        opencode: '',
        expect: '--',
    },
    // 目前的玩法代码，用于判断用户在哪个页面，现在可以用于更新头部数据，之后，可以用这个来更新相关的页面
    currentGameCode: 'jspk10',
    // 封盘与否
    // sealIsTrue: null,


    // // 1.秒速赛车
    mspk10LmpSealIsTrue: null,
    // 2.北京赛车
    pk10LmpSealIsTrue: null,
    // 3.秒速飞艇
    msftLmpSealIsTrue: null,
    // 4.秒速时时彩
    mssscComSealIsTrue: null,
    // // 5.重庆时时彩
    // cqsscComSealIsTrue: null,
    // 开盘 开启声音 ,
    // 是否打开声音选项
    openSoundAlways: true,
    openCodeSound: false,
    // 设置未结金额
    bettingTotal: 0.000,
}

// getters
const getters = {
    //获取是否绑定银行卡
    getIfBankCard: state=> state.ifBankCard,

    // 获取当前彩种的输赢
    getCurrentWin: state => state.currentWin,

    // 获取money(余额)
    getMoney: state => state.money,

    // 获取未结金额
    getBettingTotal: state => state.bettingTotal,

    // 获取开奖信息
    // 原来写的demo
    getMsscLmpOpenCodeData: state => state.msscLmpOpenCodeData,

    // 使用socket的demo
    getMsscOpenCodeData: state => state.msscOpenCodeData,
    getBjpk10OpenCodeData: state => state.bjpk10OpenCodeData,
    getMsftOpenCodeData: state => state.msftOpenCodeData,
    getMssscOpenCodeData: state => state.mssscOpenCodeData,
    getCqsscOpenCodeData: state => state.cqsscOpenCodeData,

    // 获取当前的页面
    getCurrentGameCode: state => state.currentGameCode,


    // 获取开奖信息结束

    // 获取封盘与否
    // getSealIsTrue: state => state.sealIsTrue,


    // 由于不考虑交叉下注的情况所以这里只需要一个封盘与否就足够了
    // 秒速赛车
    getMspk10LmpSealIsTrue: state => state.mspk10LmpSealIsTrue,
    // 北京赛车
    // getPk10LmpSealIsTrue: state => state.pk10LmpSealIsTrue,
    // 秒速飞艇
    // getMsftLmpSealIsTrue: state => state.msftLmpSealIsTrue,
    // 秒速时时彩
    // getMssscComSealIsTrue: state => state.mssscComSealIsTrue,
    // 重庆时时彩
    // getCqsscComSealIsTrue: state => state.cqsscComSealIsTrue,



    getBetAmount: state => state.betAmount,
    getCartList: state => state.cartList,
    // 获取用户总花费
    getSubtotal: state => {
        state.subtotal = 0
        state.cartList.forEach(item => {
            if (item.checked) {
                item.count = parseInt(item.count)
                state.subtotal += item.count
            }
        });
        // alert(state.subtotal);
        return state.subtotal
    },
    getOrderList: state => state.orderList,
    //从cartList里面取出相应id的值
    getBetAmountItem: (state, getters) => (id) => {
        let cartListItemIndex = state.cartList.findIndex(item => item.id === id)
        // console.log(id)
        // 如果这个商品不在购物车中
        if (cartListItemIndex === -1) {
            return
        } else {
            // 如果这个商品的这个属性不存在（其实这一步可以省略，这里只是调试时使用）
            if (typeof state.cartList[cartListItemIndex].count === 'undefined') {
                return
            } else {
                return state.cartList[cartListItemIndex].count
            }
        }
    },
    getContSiderShow: state => state.contSider_show,

    // 声音是否开启 (1) 声音是否开启  (2) 封盘的时候,声音关闭,开奖的时候,声音开启 两个都为true的时候，声音播放


    getOpenCodeSound: state => state.openCodeSound,
    getOpenSoundAlways: state => state.openSoundAlways

}

// actions
const actions = {


    storeCurrentWinFromBack({commit, state}, CurrentWin){
        commit(types.STORE_CURRENT_WIN_FROM_BACK)
    },
    refresh_sel_money({commit, state}, SelMoney){
        // console.log('获取从后台来的数据')
        // console.log(OrderListFromBack)
        commit(types.REFRESH_SEL_MONEY, {SelMoney})
    },


    StoreOrderListFromBack({commit, state}, OrderListFromBack){
        // console.log('获取从后台来的数据')
        // console.log(OrderListFromBack)
        commit(types.STORE_ORDER_LIST_FROM_BACK, {OrderListFromBack})
    },

    initOrder({commit}) {
        commit(types.INIT_ORDER)
    },
    initCart({commit}){
        commit(types.INIT_CART)
    },
    setAuthUser({commit, dispatch}) {
        // return axios.get('/api/user').then(response => {
        //let username = sessionStorage.getItem('name');
        return window.axios.post('/web/init').then(response => {
            if(response.data.login === false){
                location.href = '/'
            } else {
                commit({
                    type: types.SET_AUTH_USER_FOR_MONEY_IN_CARTLIST,
                    user: response.data
                })
            }
        }).catch(error => {
            // console.log(error.response.status)
            if(error.response.status === 401) {
                location.href = '/'
            }

            // dispatch('refreshToken')
        })
    },

    deleteCountZeroGoods: ({commit}) => {
        commit(types.DELETE_COUNT_ZERO_GOODS)
    },

    setOpenCodeSoundToTrue: ({commit}) => {
        commit(types.SET_OPEN_CODE_SOUND_TO_TRUE)
    },

    handleSoundAlways: ({commit}) => {
        commit(types.HANDLE_SOUND_ALWAYS)
    },
    // 处理封盘与否的部分
    // 根据currentGameCode与相关彩种的封盘与否，来判断当前页面是否封盘
    // setSealIsTrue({commit}) {
    //     commit(types.SET_SEAL_IS_TRUE)
    // },
    // 秒速赛车
    // 由于不考虑交叉下注的情况，所以我们这里也可以直接设定一个关于封盘的变量
    setSealIsTrueToFalse({commit}) {
        commit(types.SET_SEAL_IS_TRUE_TO_FALSE)

    },
    setSealIsTrueToTrue({commit}) {
        commit(types.SET_SEAL_IS_TRUE_TO_TRUE)
    },
    // setMspk10LmpSealIsTrueToFalse({commit, state}) {
    //     commit(types.SET_SEAL_IS_TRUE_TO_FALSE)
    // },
    // setMspk10LmpSealIsTrueToTrue({commit, state}) {
    //     // alert(types.SET_BET_AMOUNT)
    //     commit(types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_TRUE)
    // },
    // setPk10LmpSealIsTrueToFalse({commit, state}) {
    //     commit(types.SET_PK10_LMP_SEAL_IS_TRUE_TO_FALSE)
    // },
    // setPk10LmpSealIsTrueToTrue({commit, state}) {
    //     alert(types.SET_BET_AMOUNT)
        // commit(types.SET_PK10_LMP_SEAL_IS_TRUE_TO_TRUE)
    // },
    // setMsftLmpSealIsTrueToFalse({commit, state}) {
    //     commit(types.SET_MSFT_LMP_SEAL_IS_TRUE_TO_FALSE)
    // },
    // setMsftLmpSealIsTrueToTrue({commit, state}) {
    //     // alert(types.SET_BET_AMOUNT)
    //     commit(types.SET_MSFT_LMP_SEAL_IS_TRUE_TO_TRUE)
    // },
    // setMssscComSealIsTrueToFalse({commit, state}) {
    //     commit(types.SET_MSSSC_COM_SEAL_IS_TRUE_TO_FALSE)
    // },
    // setMssscComSealIsTrueToTrue({commit, state}) {
    //     // alert(types.SET_BET_AMOUNT)
    //     commit(types.SET_MSSSC_COM_SEAL_IS_TRUE_TO_TRUE)
    // },
    // setCqsscComSealIsTrueToFalse({commit, state}) {
    //     commit(types.SET_CQSSC_COM_SEAL_IS_TRUE_TO_FALSE)
    // },
    // setCqsscComSealIsTrueToTrue({commit, state}) {
    //     // alert(types.SET_BET_AMOUNT)
    //     commit(types.SET_CQSSC_COM_SEAL_IS_TRUE_TO_TRUE)
    // },
    // 处理封盘与否的部分
    storeMsscLmpOpenCodeData({commit, state}, MsscLmpOpenCodeData) {
        // alert(types.SET_BET_AMOUNT)
        commit(types.STORE_MSSC_LMP_OPENCODE_DATA, {MsscLmpOpenCodeData})
    },

    // 获取数据信息的改变头部的代码
    storeMsscOpenCodeData({commit, state}, MsscOpenCodeData) {
        // console.log(MsscOpenCodeData)
        // alert(types.SET_BET_AMOUNT)
        commit(types.STORE_MSSC_OPENCODE_DATA, {MsscOpenCodeData})
    },
    storeBjpk10OpenCodeData({commit, state}, Bjpk10OpenCodeData) {
// console.log(Bjpk10OpenCodeData)
        // alert(types.SET_BET_AMOUNT)
        commit(types.STORE_BJPK10_OPENCODE_DATA, {Bjpk10OpenCodeData})
    },
    storeMsftOpenCodeData({commit, state}, MsftOpenCodeData) {
        // console.log(MsftOpenCodeData)
        // alert(types.SET_BET_AMOUNT)
        commit(types.STORE_MSFT_OPENCODE_DATA, {MsftOpenCodeData})
    },
    storeMssscOpenCodeData({commit, state}, MssscOpenCodeData) {
        // console.log(MsftOpenCodeData)
        // alert(types.SET_BET_AMOUNT)
        commit(types.STORE_MSSSC_OPENCODE_DATA, {MssscOpenCodeData})
    },
    storeCqsscOpenCodeData({commit, state}, CqsscOpenCodeData) {
        // alert(types.SET_BET_AMOUNT)
        commit(types.STORE_CQSSC_OPENCODE_DATA, {CqsscOpenCodeData})
    },

    // 设定当前的gameCode
    setCurrentGameCode({commit, state}, currentGameCode) {
        // alert(productId);
        commit(types.SET_CURRENT_GAMECODE, {currentGameCode})
    },


    setBetAmount({commit, state}, betAmount) {
        // alert(types.SET_BET_AMOUNT)
        commit(types.SET_BET_AMOUNT, {betAmount})
    },
    addToCart({commit, state}, productId) {
        // alert(productId);
        commit(types.ADD_TO_CART, {productId})
    },
    deleteCartItem({commit, state}, productId) {
        // alert('delete'+ productId);
        commit(types.DELETE_CART_ITEM, {productId})
    },
    buy(context) {
        context.commit(types.EMPTY_CART);
    },
    setBetAmountItem({commit, state}, value_id) {
        commit(types.SET_BET_AMOUNT_ITEM, {value_id});
    },
    contSiderShowFalse: ({commit}) => {
        commit(types.CONT_SIDER_SHOW_FALSE)
    },
    contSiderShowTrue: ({commit}) => {
        commit(types.CONT_SIDER_SHOW_TRUE)
    },
    resetCart: ({commit}) => {
        commit(types.RESET_CART)
    }

}

let soundTimer
// mutations


const mutations = {
    [types.STORE_IF_BANK_CARD] (state){
        state.ifBankCard = true
    },

    [types.STORE_CURRENT_WIN_FROM_BACK] (state, {CurrentWin}) {
    // console.log('hello')
    // console.log(SelMoney)
    state.currentWin = CurrentWin.money
},


    [types.REFRESH_SEL_MONEY] (state, {SelMoney}) {
        // console.log('hello')
        // console.log(SelMoney)
        state.money = SelMoney.money
        state.bettingTotal = SelMoney.sel_money
    },
    [types.INIT_ORDER] (state){
        state.orderList = []
    },



    [types.STORE_ORDER_LIST_FROM_BACK](state, {OrderListFromBack}) {
        state.orderList = OrderListFromBack.orders
     },
    [types.INIT_CART] (state){
        state.cartList = []
    },
    [types.SET_AUTH_USER_FOR_MONEY_IN_CARTLIST](state, payload) {


    // state.authenticated = true
    // console.log(payload)

    // 将用户登录成功后获取的信息，存入vuex
    // state.token         = payload.user.token
    // state.serverTime    = payload.user.serverTime
    // state.userId        = payload.user.userId
    // state.userName      = payload.user.userName
    // state.loginTime     = payload.user.loginTime
    // state.lastLoginTime = payload.user.lastLoginTime
    state.money         = payload.user.money
    // state.email         = payload.user.email
    // state.rechLevel     = payload.user.rechLevel
    // state.hasFundPwd    = payload.user.hasFundPwd
    // state.testFlag      = payload.user.testFlag
    // state.updatePw      = payload.user.updatePw
    // state.updatePayPw   = payload.user.updatePayPw
    // state.state         = payload.user.state

},




    [types.DELETE_COUNT_ZERO_GOODS](state) {
        for(let i = 0; i < state.cartList.length; i++) {
            // console.log(item)
            // console.log(state.cartList[item].count)

            if(state.cartList[i].count === 0){
                // console.log(item)
                state.cartList.splice(i,1)
                i--
            }
        }
        // const toDeleteIndex = state.cartList.findIndex(item => item.id === productId)
        // state.cartList.splice(toDeleteIndex, 1)
    },


    [types.HANDLE_SOUND_ALWAYS](state){
        state.openSoundAlways = !state.openSoundAlways
    },
    [types.SET_OPEN_CODE_SOUND_TO_TRUE](state) {
        state.openCodeSound = true
        clearInterval(soundTimer)

        soundTimer = setInterval(function () {
            state.openCodeSound = false
        },2000)
    },
    [types.SET_CURRENT_GAMECODE](state, {currentGameCode}) {
        state.currentGameCode = currentGameCode

    },

    // 开奖的时候，会把封盘设置为false，这里我们orderList进行清空，然后在购买的时候，就不清空，这样顾客可以连续购买，专门弄一个清空orderList的部分，不同的模块，用不同的orderList，然后将所有的orderList在这里汇总
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_FALSE](state) {
    //
    //     state.orderList = []
    //     state.mspk10LmpSealIsTrue = false
    // },
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_TRUE](state) {
    //     state.mspk10LmpSealIsTrue = true
    //     // state.openCodeSound = false
    // },
    // 整体的状态不需要计算，只需要设置就好了
    //
    //     [types.SET_SEAL_IS_TRUE](state) {
    //         // 通过当前游戏码来设定封盘与否
    //     switch (state.currentGameCode) {
    //     case 'jspk10':
    //         state.sealIsTrue = state.mspk10LmpSealIsTrue
    //         break
    //     case 'pk10':
    //         state.sealIsTrue = state.pk10LmpSealIsTrue
    //         break
    //     case 'jsft':
    //         state.sealIsTrue = state.msftLmpSealIsTrue
    //         break
    //     case 'jsssc':
    //         state.sealIsTrue = state.mssscComSealIsTrue
    //         break
    //     case 'cqssc':
    //         state.sealIsTrue = state.cqsscComSealIsTrue
    //         break
    //
    //     default:
    //         alert('当前彩种的封盘还没有设置好，请到store/modules/cartList/index.js里面进行设置')
    //         break
    //
    //         // console.log(cartItem)
    //     }
    //     state.mspk10LmpSealIsTrue = false
    // },
    // 这里将封盘重新开启，相当于重新开启

    [types.SET_SEAL_IS_TRUE_TO_TRUE](state) {

        state.mspk10LmpSealIsTrue = true
    },
    [types.SET_SEAL_IS_TRUE_TO_FALSE](state) {
        // 清空余额
        state.bettingTotal = 0
        // 将左下角的已结订单清空
        state.orderList = []

        state.mspk10LmpSealIsTrue = false
    },


    // 由于不考虑交叉下注的情况，所以这里我们只用一个设置封盘与否的即可

    //
    // [types.SET_PK10_LMP_SEAL_IS_TRUE_TO_FALSE](state) {
    //
    //     state.orderList = []
    //     state.mspk10LmpSealIsTrue = false
    // },
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_TRUE](state) {
    //     state.mspk10LmpSealIsTrue = true
    //     // state.openCodeSound = false
    // },
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_FALSE](state) {
    //
    //     state.orderList = []
    //     state.mspk10LmpSealIsTrue = false
    // },
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_TRUE](state) {
    //     state.mspk10LmpSealIsTrue = true
    //     // state.openCodeSound = false
    // },
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_FALSE](state) {
    //
    //     state.orderList = []
    //     state.mspk10LmpSealIsTrue = false
    // },
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_TRUE](state) {
    //     state.mspk10LmpSealIsTrue = true
    //     // state.openCodeSound = false
    // },
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_FALSE](state) {
    //
    //     state.orderList = []
    //     state.mspk10LmpSealIsTrue = false
    // },
    // [types.SET_MSPK10_LMP_SEAL_IS_TRUE_TO_TRUE](state) {
    //     state.mspk10LmpSealIsTrue = true
    //     // state.openCodeSound = false
    // },

    // 处理封盘与否的部分

    [types.STORE_MSSC_LMP_OPENCODE_DATA](state, {MsscLmpOpenCodeData}) {
         //console.log(MsscLmpOpenCodeData)
        state.msscLmpOpenCodeData.code = MsscLmpOpenCodeData.openCode.code
        state.msscLmpOpenCodeData.expect = MsscLmpOpenCodeData.openCode.expect
        state.msscLmpOpenCodeData.opencode = MsscLmpOpenCodeData.openCode.opencode
        state.msscLmpOpenCodeData.servertime = MsscLmpOpenCodeData.openCode.servertime
        state.msscLmpOpenCodeData.opentimestamp = MsscLmpOpenCodeData.openCode.opentimestamp
    },

    // 更新开奖数据,用于更新头部信息
    [types.STORE_MSSC_OPENCODE_DATA](state, {MsscOpenCodeData}) {
         //console.log(MsscOpenCodeData)
        state.msscOpenCodeData.code = MsscOpenCodeData.openCode.code
        state.msscOpenCodeData.opencode = MsscOpenCodeData.openCode.opencode
        state.msscOpenCodeData.expect = MsscOpenCodeData.openCode.expect
    },
    [types.STORE_BJPK10_OPENCODE_DATA](state, {Bjpk10OpenCodeData}) {
         //console.log(Bjpk10OpenCodeData)
        state.bjpk10OpenCodeData.code = Bjpk10OpenCodeData.openCode.code
        state.bjpk10OpenCodeData.opencode = Bjpk10OpenCodeData.openCode.opencode
        state.bjpk10OpenCodeData.expect = Bjpk10OpenCodeData.openCode.expect
    },
    [types.STORE_MSFT_OPENCODE_DATA](state, {MsftOpenCodeData}) {
        //console.log(MsftOpenCodeData)
        state.msftOpenCodeData.code = MsftOpenCodeData.openCode.code
        state.msftOpenCodeData.opencode = MsftOpenCodeData.openCode.opencode
        state.msftOpenCodeData.expect = MsftOpenCodeData.openCode.expect
    },
    [types.STORE_MSSSC_OPENCODE_DATA](state, {MssscOpenCodeData}) {
         //console.log(MssscOpenCodeData)
        state.mssscOpenCodeData.code = MssscOpenCodeData.openCode.code
        state.mssscOpenCodeData.opencode = MssscOpenCodeData.openCode.opencode
        state.mssscOpenCodeData.expect = MssscOpenCodeData.openCode.expect
    },
    [types.STORE_CQSSC_OPENCODE_DATA](state, {CqsscOpenCodeData}) {
         //console.log(CqsscOpenCodeData)
        state.cqsscOpenCodeData.code = CqsscOpenCodeData.openCode.code
        state.cqsscOpenCodeData.opencode = CqsscOpenCodeData.openCode.opencode
        state.cqsscOpenCodeData.expect = CqsscOpenCodeData.openCode.expect
    },

    // updateContSiderShow (state, message) {
    //     state.contSider_show = message
    // },
    [types.SET_BET_AMOUNT](state, {betAmount}) {
        // alert(types.SET_BET_AMOUNT+'测试')
        // alert(betAmount)
        state.betAmount = betAmount
        // 当用户改变betAmount里面的值的时候(就是设置总体交易金额的时候,同时改变所有的input的betAmountItem CartList)
        state.cartList.forEach(item => {
            if (state.betAmount === '') {
                item.count = 0
            } else {
                item.count = state.betAmount
            }
        })

    },
    [types.ADD_TO_CART](state, {productId}) {
        // alert(productId);

        // 这里要注意，传入的betAmount是字符串

        // 先判断购物车是否已有，如果有，数量+1
        // 这里与一般的购物车不一样，如果已有isAdded,　就清空对应的商品
        const isAdded = state.cartList.find(item => item.id === productId)
        if (isAdded) {
            // isAdded.count += id_and_betAmount[1]
            // 这里与一般的购物车不一样，如果已有isAdded，就清空对应的商品
            const toDeleteIndex = state.cartList.findIndex(item => item.id === productId)
            state.cartList.splice(toDeleteIndex, 1)
        } else {
            state.cartList.push({
                id: productId,
                //　直接取出投注的金额
                count: state.betAmount,
                checked: true
            })
        }
        // console.log(state.cartList)
    },
    // 删除商品
    [types.DELETE_CART_ITEM](state, {id}) {
        const index = state.cartList.findIndex(item => item.id === id)
        state.cartList.splice(index, 1)
    },
    // 清空购物车
    [types.EMPTY_CART](state) {
        // 用户余额


        // console.log(state.cartList)


        state.cartList.forEach(item => {
            if (item.checked) {
                // 计算投注的未结金额
                state.bettingTotal += item.count
                // console.log(item)
                state.orderList.push(item)
            }
        })

        // // 更新账户余额
        state.money -= state.bettingTotal

        state.cartList = []
    },
    // // 设定相关商品item数量
    [types.SET_BET_AMOUNT_ITEM](state, {value_id}) {
        const index = state.cartList.findIndex(item => item.id === value_id.id)
        // 如果是第一次点击，cartList里面没有这个值的话，就把betAmount的值传到这个input里面
        if (index === -1) {
            return
        } else {
            // 如果存在，就修改中间的值
            // console.log(index);
            if (value_id.value === '') {
                state.cartList[index].count = 0
            } else {
                state.cartList[index].count = value_id.value
            }
        }
    },
    [types.CONT_SIDER_SHOW_FALSE](state) {
        state.contSider_show = false
    },
    [types.CONT_SIDER_SHOW_TRUE](state) {
        state.contSider_show = true
    },
    [types.RESET_CART](state) {
        state.betAmount = 0
        state.cartList = []
    }

}

// // 初始化所有的变量
// function cartListInit() {
//     betAmount = 0
//     cartList  = []
// }


export default {
    // modules: {
    //     mspk10CartList
    // },
    state,
    getters,
    actions,
    mutations
}
