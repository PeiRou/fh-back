import Vue from 'vue'
import Vuex from 'vuex'
import loading from './modules/loading/'
import headerMiddle from './modules/headerMiddle'
import Mspk10Lmp from './modules/Mspk10Lmp'

import cartList from './modules/cartList'

import Test from './modules/test'

// 开始引入登录注册的状态管理
import authUser from './modules/authUser'
import login from './modules/login'


Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        loading,
        headerMiddle,
        Mspk10Lmp,
        cartList,
        Test,
        authUser,
        login
    }
});
