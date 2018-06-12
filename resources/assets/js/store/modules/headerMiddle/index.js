// import headerMiddle from '../../../api/headerMiddle'
import * as types from './../../mutation-types.js'

// init state
const state = {
    headerMiddle: {},
    headerMiddleOrder: {},
    // headerMiddleOrder: [],
    orderedHeaderMiddle: []
}

// getters
const getters = {
            // getAllGames: state => state.headerMiddle,
    getAllGames: state => state.headerMiddle.getGameMap,
    getGamesOrder: state => state.headerMiddleOrde,
    getHeaderMiddleOrderStr: state => state.headerMiddleOrder.getGames,
    // getGamesOrder: state => state.headerMiddleOrder,
    // getOrderedHeaderMiddle: state => state.orderedHeaderMiddle,
    getOrderedHeaderMiddle: state => state.orderedHeaderMiddle.getOrderedHeaderMiddle
}

// actions
const actions = {
    // 为页面中的headerMiddle传入顺序和数据
    getGamesFromGameDatas({ commit, state}, gamesFromGameDatas) {
        // console.log(gamesFromGameDatas)
        commit(types.GET_GAMES_FROM_GAMEDATAS, { gamesFromGameDatas })
    },
    getGameMapFromGameDatas({ commit, state}, gameMapFromGameDatas) {
        // console.log(gameMapFromGameDatas)
        commit(types.GET_GAMEMAP_FROM_GAMEDATAS, { gameMapFromGameDatas })
    },

    // 为页面中的headerMiddle传入顺序和数据 end

    // getAllGames({ commit }) {
    //     headerMiddle.getHeaderMiddle(items => {
    //         commit(types.GET_HEADER_MIDDLE, items)
    //     })
    // },
    // getGameOrder({ commit }) {
    //     headerMiddle.getHeaderMiddleOrder(order => {
    //         commit(types.GET_HEADER_MIDDLE_ORDER, order)
    //     })
    // },
    getOrderedHeaderMiddle({ commit, state}, orderedHeaderMiddle) {
        commit(types.GET_ORDERED_HEADER_MIDDLE, { orderedHeaderMiddle })
    }
}

// mutations
const mutations = {
    [types.GET_GAMES_FROM_GAMEDATAS] (state, { gamesFromGameDatas }) {
        // console.log(gamesFromGameDatas.getGamesFromGameDatas)
        state.headerMiddleOrder = gamesFromGameDatas.getGamesFromGameDatas // 获取头部中间的顺序
    },
    [types.GET_GAMEMAP_FROM_GAMEDATAS] (state, { gameMapFromGameDatas })
    {
        state.headerMiddle = gameMapFromGameDatas.getGameMapFromGameDatas // 获取头部中间的数据
        // console.log(gameMapFromGameDatas.getGameMapFromGameDatas)
        // console.log(typeof gameMapFromGameDatas.getGameMapFromGameDatas)
    },
    [types.GET_HEADER_MIDDLE_ORDER] (state, items) {
        state.headerMiddleOrder = items
    },
    [types.GET_ORDERED_HEADER_MIDDLE] (state, { orderedHeaderMiddle }) {
        state.orderedHeaderMiddle = orderedHeaderMiddle.getOrderedHeaderMiddle


        // state.orderedHeaderMiddle = [] // 重排数组,由于取出的数据会按照键值进行升序排列

        // console.log(JSON.parse(JSON.stringify(state.headerMiddle))[1]) //用 JSON.parse(JSON.stringigy(jsonObj)) 可以取出我们想要的数据
        // console.log(state.headerMiddleOrder)
        // let headerMiddleOrderStr = this.$store.getHeaderMiddleOrderStr()
        // console.log(headerMiddleOrderStr)
        // headerMiddleOrderArr = headerMiddleOrderStr
        // console.log(state.headerMiddleOrder)

        // state.headerMiddleOrder.getGames.forEach((value,index,array) => { // 将item按照headerMiddleOrder(games)中的顺序一个一个地放入到orderHeaderMiddle中
        // console.log(value)
        // console.log(index)
        // console.log(array)
        // state.orderedHeaderMiddle.push(JSON.parse(JSON.stringify(state.headerMiddle))[value])
        // })
        // console.log(state.orderedHeaderMiddle)

    }


    // [types.ADD_TO_CART] (state, { id }) {
    //     state.headerMiddle.find(product => product.id === id).inventory--
    // }
}

export default {
    state,
    getters,
    actions,
    mutations
}