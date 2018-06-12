// init state
const state = {
    my_state: '测试2',  // 测试computed watch vuex

}

// getters
const getters = {
    getMyState: state => state.my_state,
}

// actions
const actions = {

}


// mutations
const mutations = {
    // 测试computed watch vuex
  updateMyState (state, message) {
      state.my_state = message
  }
}


export default {
    state,
    getters,
    actions,
    mutations
}
