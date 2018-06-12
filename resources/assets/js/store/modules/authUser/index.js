import * as types from './../../mutation-types'

// init state
const state = {
   authenticated: false,
   // username:null,

    token:null,
    serverTime: "2018-03-21 02:45:30",
    userId: 0,
    userName: null,
    fullName: '张三',
    loginTime: "2018-01-22 15:20:05",
    lastLoginTime: "2018-01-22 12:11:27",
    // money: 0,
    email: 'qqq@qq.com',
    rechLevel: '0',
    hasFundPwd: true,
    testFlag: 0,
    updatePw: 0,
    updatePayPw: 0,
    state: 1,


}

// getters
const getters = {
//
    getUserId: state=>state.userId,
    getUserName: state => state.userName,
    // getMoney: state => state.money,
     getServerTime: state => state.serverTime,
    getTestFlag: state => state.testFlag,

    // getAuthenticated: state => state.authenticated,
// 
//     getUserName: state => state.userName
// >>>>>>> bd4e824d36b4ecbf285b2011a36168a164fa5cd2
}

// actions
const actions = {
    storeIfBankCard({commit}){
        commit({
            type: types.STORE_IF_BANK_CARD
        })
    },
    setAuthUser({commit, dispatch}) {
        // return axios.get('/api/user').then(response => {
            //let username = sessionStorage.getItem('name');
            return window.axios.post('/web/init').then(response => {
                if(response.data.login === false){
                    location.href = '/'
                } else {
                    commit({
                        type: types.SET_AUTH_USER,
                        user: response.data
                    })
                }
        }).catch(error => {
            console.log(error.response.status)
                if(error.response.status === 401) {
                    location.href = '/'
                }

            // dispatch('refreshToken')
        })
    },
    unsetAuthUser({commit}) {
        commit({
            type: types.UNSET_AUTH_USER
        })
    },
    refreshToken({commit, dispatch}) {
        return axios.post(/*获取token的方法*/).then(response => {
            dispatch('loginSuccess',response.data)
        }).catch(error => {
            dispatch('logoutRequest')
        })
    }

}

// mutations
const mutations = {


    [types.SET_AUTH_USER](state, payload) {


        state.authenticated = true
        // console.log(payload)

        // 将用户登录成功后获取的信息，存入vuex
        // state.token         = payload.user.token
        state.serverTime    = payload.user.serverTime
        state.userId        = payload.user.userId
        state.userName      = payload.user.userName
        state.loginTime     = payload.user.loginTime
        state.lastLoginTime = payload.user.lastLoginTime
        state.money         = payload.user.money
        state.email         = payload.user.email
        state.rechLevel     = payload.user.rechLevel
        state.hasFundPwd    = payload.user.hasFundPwd
        state.testFlag      = payload.user.testFlag
        state.updatePw      = payload.user.updatePw
        state.updatePayPw   = payload.user.updatePayPw
        state.state         = payload.user.state


        // token:null,
        //     serverTime: "2018-03-21 02:45:30",
        //     userId: 0,
        //     userName: null,
        //     fullName: '张三',
        //     loginTime: "2018-01-22 15:20:05",
        //     lastLoginTime: "2018-01-22 12:11:27",
        //     money: 0,
        //     email: 'qqq@qq.com',
        //     rechLevel: '0',
        //     hasFundPwd: true,
        //     testFlag: 0,
        //     updatePw: 0,
        //     updatePayPw: 0,
        //     state: 1,

        // state.name = payload.user.name
        // console.log(state.authenticated)
    },
    [types.UNSET_AUTH_USER](state) {
        state.authenticated = false
        state.serverTime    = null
        state.userId        = null
        state.userName      = null
        state.loginTime     = null
        state.lastLoginTime = null
        state.money         = null
        state.email         = null
        state.rechLevel     = null
        state.hasFundPwd    = null
        state.testFlag      = null
        state.updatePw      = null
        state.updatePayPw   = null
        state.state         = null
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}


