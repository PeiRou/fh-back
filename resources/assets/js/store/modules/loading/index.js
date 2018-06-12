import * as types from "../../mutation-types.js"

// initial state
const state = {
    loading: false
}

// getters
const getters = {
    loading(state) {
        return state.loading
    }
}

// actions
const actions = {
    hideLoading: ({ commit }) => {
        commit(types.HIDE_LOADING)
    },
    showLoading: ({ commit }) => {
        commit(types.SHOW_LOADING)
    }
}

// mutations
const mutations = {
    [types.HIDE_LOADING](state){
        state.loading = false
    },
    [types.SHOW_LOADING](state){
        state.loading = true
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}