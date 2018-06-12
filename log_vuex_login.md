> 20180319 开始进行注册登录的状态管理

#  在agreement和game页面进行是否登录的状态管理(在这两个页面,同意页面以及下注页面)
> (1)在两个基本的组件页面判断用户是否登录(在这两个基本组件中判断之后,登录之后的所有页面都会在创建的时候,判断用户是否登录)
> F: resources/assets/js/components/user/agreement/Agreement.vue
> F: resources/assets/js/components/user/Game.vue

```
在页面创建的时候,就判断用户是否登录
F: resources/assets/js/components/user/agreement/Agreement.vue
F: resources/assets/js/components/user/Game.vue 

export default {
        .
	.
	.
        created() {
            this.$store.dispatch('setAuthUser')
        }

    }

```
> (2)在vuex中创建authUser模块,并且在store/index.js进行引入
> F: resources/assets/js/store/modules/authUser/index.js
> F: resources/assets/js/store/mutation-types.js
> F: resources/assets/js/store/index.js
```
F: resources/assets/js/store/modules/authUser/index.js

import * as types from './../../mutation-types'

// init state
const state = {
   authenticated: false,
}

// getters
const getters = {

}

// actions
const actions = {
    setAuthUser({commit, dispatch}) {
        // return axios.get('/api/user').then(response => {
            return axios.post('/api/init').then(response => { 	// 在 /api/init 里面提交SET_AUTH_USER的请求
            commit({
                type: types.SET_AUTH_USER,
                // user: response.data
            })
        }).catch(error => {
            console.log(error.response.status)
                if(error.response.status === 401) { //状态码是401表示没有token
                    location.href = '/'  // 跳转回首页
                }

            // dispatch('refreshToken')
        })
    },
}

// mutations
const mutations = {
    [types.SET_AUTH_USER](state, payload) {
        state.authenticated = true
        console.log(state.authenticated)
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}

```
```
F: resources/assets/js/store/mutation-types.js

.
.
.
// 开始进行登录注册的状态管理
export const SET_AUTH_USER = 'SET_AUTH_USER'
```
```
F: resources/assets/js/store/index.js

.
.
.

// 开始引入登录注册的状态管理
import authUser from './modules/authUser'

export default new Vuex.Store({
    modules: {
	.
	.
	.
        authUser
    }
});
```
> 接下来，我们使用vue-cookie或者js-cookie来取出cookie.特别要注意laravel框架中生成的cookie默认是http-only属性，要设置为false,这样我们才能读取出cookie值

