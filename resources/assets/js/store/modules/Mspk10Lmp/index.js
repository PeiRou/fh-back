// import Mspk10Lmp from '../../../api/Mspk10Lmp' // 为页面的标题准备数据

import Mspk10Lmp_product from '../../../api/product/Mspk10Lmp_product'　// 为页面中的商品准备数据
import MssscZh_product from '../../../api/product/MssscZh_product.js' // 获取秒速时时彩商品数据
import Pk10Lmp_product from '../../../api/product/Pk10Lmp_product.js'
// 获取北京赛车商品数据
import JsftLmp_product from '../../../api/product/JsftLmp_product.js'
// 获取极速飞艇商品数据

import CqsscZh_product from '../../../api/product/CqsscZh_product.js'
// 获取重庆时时彩商品数据

import XjsscZh_product from '../../../api/product/XjsscZh_product.js'
// 获取新疆时时彩商品数据

import XyddXydd_product from '../../../api/product/XyddXydd_product.js'
// 获取幸运蛋蛋商品数据

import PcddPcdd_product from '../../../api/product/PcddPcdd_product.js'
// 获取PC蛋蛋商品数据

import Xykl8Lmp_product from '../../../api/product/Xykl8Lmp_product.js'
// 获取幸运快乐8商品数据

import Bjkl8Lmp_product from '../../../api/product/Bjkl8Lmp_product.js'
// 获取北京快乐8商品数据

import Jsk3Dxtb_product from '../../../api/product/Jsk3Dxtb_product.js'
// 获取江苏骰宝商品数据

import Gd11x5Lmp_product from '../../../api/product/Gd11x5Lmp_product.js'
// 广东11选5商品数据

import GdklsfLmp_product from '../../../api/product/GdklsfLmp_product.js'


import * as types from './../../mutation-types'
// import {_products} from "../../../../static/data/headerMiddle"; // for test

// getters
const getters = {
    // getMspk10LmpPlayCates: state => state.Mspk10LmpName,
    // getMspk10LmpPlays: state => state.Mspk10LmpInput,



    getMspk10LmpPlayCates: state => state.Mspk10LmpName.getPlayCates,
    getMspk10LmpPlays: state => state.Mspk10LmpInput.getPlays,


// 20180313 处理过滤开始

    // 之后将过滤、取数据的过程放在这里 获取 幸运快乐8 的title (中文title,第一球 第二球 第三球) (原来的title是 第1球-大 第1球-小 这种格式,要转化为 第一球 大 小)
    // 幸运快乐8 的 playCateId的是196 之后(如果有大量的这个模板)可以传入这个参数, 之前的那个productId就没有太大的用处了
    // 在这里处理所有的数据,然后再循环输出


    // 为了之后的整合,这里我们加入一个titleNo字段, 这样 titleNo->title  id->name<-titleNo id->otherContents<-titleNo
    // titleNo就是item, name的titleNo就是 item/4 四个对应一个 id就是id
    getXykl8LmpPlays_196_title: state => {

        // 首先将状态中的值清空
        state.Xykl8LmpProduct_1_title = []

        // 第一步,找到Xykl8LmpInput的相关数据(循环Input，然后通过playCateId取出数据) (将数据取出)

        let Xykl8LmpProduct_1_title_data = []

        for(let item in state.Mspk10LmpInput) {
            // console.log(item)
            if(state.Mspk10LmpInput[item].playCateId === 196){
                Xykl8LmpProduct_1_title_data.push(
                    state.Mspk10LmpInput[item]
                )}
        }
        // 第二步,取出相关的字段,处理好之后返回()
        let Xykl8LmpProduct_1_title_shuzi = []

        // 将第0个字符到倒数第二个字符之间的字符串赋值给Xykl8LmpProduct_1_title_zhuangzhongwen (将数字取出),然后将数字转成中文
        for(let item in Xykl8LmpProduct_1_title_data) {
            // 取出每个字符中的第0个位置到倒数第二个位置的所有的字符
            // Xykl8LmpProduct_1_title_zhuangzhongwen.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2))
            // 值如 第1球 第1球 第1球 第1球

            // Xykl8LmpProduct_1_title_shuzi.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))
            // 值如 1 1 1 1
            // state.Xykl8LmpProduct_1_title.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))

            // state.Xykl8LmpProduct_1_title.push(chinanum(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1)))
            // 值如 一 一 一 一

            let itemZuhe = "第" + chinanum(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1)) + "球"

            Xykl8LmpProduct_1_title_shuzi.push(itemZuhe);
            // state.Xykl8LmpProduct_1_title.push(itemZuhe);
            // 值如 第一球 第一球 第一球 第一球
        }

        // 数组排重,并赋值
        for(let item in getFilterArray(Xykl8LmpProduct_1_title_shuzi)) {
            state.Xykl8LmpProduct_1_title.push(
                {
                    "titleNo": item,
                    "title": getFilterArray(Xykl8LmpProduct_1_title_shuzi)[item]
                }
            )
            // 值如 第一球 第二球 第三球 第四球
        }

        // return state.Xykl8LmpProduct_1_title_data
        return state.Xykl8LmpProduct_1_title

        // return state.Mspk10LmpInput
    },

    getXykl8LmpPlays_196_content_name: state => {
        // 首先将状态中的值清空
        state.Xykl8LmpProduct_1_content_name = []


        // 第一步,找到Xykl8LmpInput的相关数据(循环Input，然后通过playCateId取出数据) (将数据取出)
        let Xykl8LmpProduct_1_content_data = []

        for(let item in state.Mspk10LmpInput) {
            // console.log(item)
            if(state.Mspk10LmpInput[item].playCateId === 196){
                Xykl8LmpProduct_1_content_data.push(
                    state.Mspk10LmpInput[item]
                )}
        }
        // 第二步,取出相关的字段,处理好之后返回()
        // let Xykl8LmpProduct_1_content_shuzi = []

        // 将第0个字符到倒数第二个字符之间的字符串赋值给Xykl8LmpProduct_1_title_zhuangzhongwen (将数字取出),然后将数字转成中文
        for(let item in Xykl8LmpProduct_1_content_data) {
            // 取出每个字符中的第0个位置到倒数第二个位置的所有的字符
            // Xykl8LmpProduct_1_title_zhuangzhongwen.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2))
            // 值如 第1球 第1球 第1球 第1球

            // Xykl8LmpProduct_1_title_shuzi.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))
            // 值如 1 1 1 1
            // state.Xykl8LmpProduct_1_title.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))

            // state.Xykl8LmpProduct_1_title.push(chinanum(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1)))
            // 值如 一 一 一 一

            // 取出倒数第一个的分类数字
            let itemZuhe = {
                "name": Xykl8LmpProduct_1_content_data[item].name.slice(-1),
                "titleNo": parseInt(item/4),
                "id": Xykl8LmpProduct_1_content_data[item].id
            }
            state.Xykl8LmpProduct_1_content_name.push(itemZuhe)


            // Xykl8LmpProduct_1_title_shuzi.push(itemZuhe);
            // state.Xykl8LmpProduct_1_title.push(itemZuhe);
            // 值如 第一球 第一球 第一球 第一球
        }

        // // 数组排重,并赋值
        // for(let item in getFilterArray(Xykl8LmpProduct_1_title_shuzi)) {
        //     state.Xykl8LmpProduct_1_title.push(getFilterArray(Xykl8LmpProduct_1_title_shuzi)[item])
        //
        //     // 值如 第一球 第二球 第三球 第四球
        // }

        // return state.Xykl8LmpProduct_1_title_data
        return state.Xykl8LmpProduct_1_content_name

        // return state.Mspk10LmpInput
    },


// 从一开始到最后结束的时候,只需要处理 state.Xykl8LmpProduct_1_filtered 就可以了,只是在这个过程中我们加入了 Xykl8LmpProduct_1_filtered_data_A Xykl8LmpProduct_1_filtered_data_B 来作为参考,这样就可以知道 state.Xykl8LmpProduct_1_filtered中间的值以及状态
    getXykl8LmpPlays_196_filtered: state => {
        // 首先,先清空数组
        state.Xykl8LmpProduct_1_filtered = []

        // 生成一个新的数组,循环前面的数组, 将title(例如: 第一球)作为键名, 空值作为键值生成一个新的数组(由于这个titleNo是从0开始自增的,所以之后,我们只需要循环新的数组,将titleNo为index(循环的时候的序列号)的放入相关的数组内,就ok了)
        // (1)加入之后,(2)在循环的过程中,如果titleNo相同,就加在那个


        // Xykl8LmpProduct_1_filtered_data_A
        // 先将内层的数据处理好 [{"name": "大", "odds": "1.995", "id": "8319605"},{"name": "小", "odds": "1.995", "id": "8319606"},{"name": "单", "odds": "1.995", "id": "8319607"},{"name": "双", "odds": "1.995", "id": "8319608"}]

        // Xykl8LmpProduct_1_filtered_data_B
        // 再将外层的数据处理好 {"第二球": [{"name": "大", "odds": "1.995", "id": "8319605"},{"name": "小", "odds": "1.995", "id": "8319606"},{"name": "单", "odds": "1.995", "id": "8319607"},{"name": "双", "odds": "1.995", "id": "8319608"}]}

        // 最后再将数据组合起来
        // Xykl8LmpProduct_1_filtered_data_C
        // [
        //     {"第一球": [{"name": "大", "odds": "1.995", "id": "8319601"},{"name": "小", "odds": "1.995", "id": "8319602"},{"name": "单", "odds": "1.995", "id": "8319603"},{"name": "双", "odds": "1.995", "id": "8319604"}]},
        //     {"第二球": [{"name": "大", "odds": "1.995", "id": "8319605"},{"name": "小", "odds": "1.995", "id": "8319606"},{"name": "单", "odds": "1.995", "id": "8319607"},{"name": "双", "odds": "1.995", "id": "8319608"}]}
        // ]

        // 第一步,找到Xykl8LmpInput的相关数据(循环Input，然后通过playCateId取出数据) (将数据取出)
        let Xykl8LmpProduct_1_filtered_data = []

        for(let item in state.Mspk10LmpInput) {
            // console.log(item)
            if(state.Mspk10LmpInput[item].playCateId === 196){
                Xykl8LmpProduct_1_filtered_data.push(
                    state.Mspk10LmpInput[item]
                )

                // state.Xykl8LmpProduct_1_filtered.push(
                //     state.Mspk10LmpInput[item]
                // )
            }
        }

        // 第二步,获取第一层数据 // 将name加入
        let Xykl8LmpProduct_1_filtered_data_A = []

        for(let item in Xykl8LmpProduct_1_filtered_data) {
            // 通过id将姓名加入 然后再加入其他的
            for(let itemInner in state.Xykl8LmpProduct_1_content_name) {
                if(state.Xykl8LmpProduct_1_content_name[itemInner][id] === Xykl8LmpProduct_1_filtered_data[itemInner][id]) {
                    Xykl8LmpProduct_1_filtered_data[itemInner][name] = state.Xykl8LmpProduct_1_content_name[itemInner][name]
                }
            }


            Xykl8LmpProduct_1_filtered_data_A.push({
                titleNo: parseInt(item/4),
                name: Xykl8LmpProduct_1_filtered_data[item].name.slice(-1),
                id: Xykl8LmpProduct_1_filtered_data[item].id,
                gameId: Xykl8LmpProduct_1_filtered_data[item].gameId,
                playCateId: Xykl8LmpProduct_1_filtered_data[item].playCateId,
                odds: Xykl8LmpProduct_1_filtered_data[item].odds,
                rebate: Xykl8LmpProduct_1_filtered_data[item].rebate,
                minMoney: Xykl8LmpProduct_1_filtered_data[item].minMoney,
                maxMoney: Xykl8LmpProduct_1_filtered_data[item].maxMoney,
                maxTurnMoney: Xykl8LmpProduct_1_filtered_data[item].maxTurnMoney
            })
            // state.Xykl8LmpProduct_1_filtered.push({
            //     titleNo: parseInt(item/4),
            //     name: Xykl8LmpProduct_1_filtered_data[item].name.slice(-1),
            //     id: Xykl8LmpProduct_1_filtered_data[item].id,
            //     gameId: Xykl8LmpProduct_1_filtered_data[item].gameId,
            //     playCateId: Xykl8LmpProduct_1_filtered_data[item].playCateId,
            //     odds: Xykl8LmpProduct_1_filtered_data[item].odds,
            //     rebate: Xykl8LmpProduct_1_filtered_data[item].rebate,
            //     minMoney: Xykl8LmpProduct_1_filtered_data[item].minMoney,
            //     maxMoney: Xykl8LmpProduct_1_filtered_data[item].maxMoney,
            //     maxTurnMoney: Xykl8LmpProduct_1_filtered_data[item].maxTurnMoney
            // })
        }

        // 第三步,获取第二层数据 // 将外层加入 加入一个键名


        let Xykl8LmpProduct_1_filtered_data_B = []
        //
        // // 准备好要用的数据 (将 第一球 放入state中)
        // // 第一步,将title放入
        // 没有用到这个函数,而是通过actions里面引入的
        // getXykl8LmpPlays_196_title_tools(state)
        // console.log(state.Xykl8LmpProduct_1_title)


        //
        for(let item in state.Xykl8LmpProduct_1_title) {
            //
            //     console.log(state.Xykl8LmpProduct_1_title[item].title)
            //
            //
            //     let keyName = state.Xykl8LmpProduct_1_title[item].title
            // console.log(keyName)
            let keyItem = {};
            keyItem[state.Xykl8LmpProduct_1_title[item].title] = [];
            // console.log(keyItem)
            //
            Xykl8LmpProduct_1_filtered_data_B.push(keyItem)
            state.Xykl8LmpProduct_1_filtered.push(keyItem)
        }

        // 值如 [ { "第一球": [] }, { "第二球": [] }, { "第三球": [] }, { "第四球": [] }, { "第五球": [] }, { "第六球": [] }, { "第七球": [] }, { "第八球": [] }, { "第九球": [] }, { "第十球": [] }, { "第十一球": [] }, { "第十二球": [] }, { "第十三球": [] }, { "第十四球": [] }, { "第十五球": [] }, { "第十六球": [] }, { "第十七球": [] }, { "第十八球": [] }, { "第十九球": [] }, { "第二十球": [] } ]


        for(let itemTitle in Xykl8LmpProduct_1_filtered_data_B) {

            // console.log(state.Xykl8LmpProduct_1_filtered[itemInner])
            // console.log(Object.keys(state.Xykl8LmpProduct_1_filtered[itemInner]))
            let keyName = Object.keys(Xykl8LmpProduct_1_filtered_data_B[itemTitle])
            // console.log(Xykl8LmpProduct_1_filtered_data_B[itemTitle][keyName])
            // 通过键名找到之后,然后再将键值传入

            // console.log(Xykl8LmpProduct_1_filtered_data_A)

            for(let itemContent in Xykl8LmpProduct_1_filtered_data_A) {
                // console.log(itemContent)
                // console.log(Xykl8LmpProduct_1_filtered_data_A[itemContent])
                let itemToBePushed = Xykl8LmpProduct_1_filtered_data_A[itemContent]
                // console.log(itemToBePushed)
                let itemContent = parseInt(itemContent / 4)
                // console.log(itemTitle)

                // 这里要用两个等于,这样不知道为什么用三个等于会报错.
                if (itemContent  == itemTitle) {
                    // Xykl8LmpProduct_1_filtered_data_B[itemTitle][keyName].push(itemToBePushed)
                    state.Xykl8LmpProduct_1_filtered[itemTitle][keyName].push(itemToBePushed)
                }

            }
        }

        return state.Xykl8LmpProduct_1_filtered

    },



    // 20180313 处理过滤结束


    // 20180313 处理过滤结束






    getMspk10LmpProduct_1: state => state.Mspk10LmpProduct_1,
    getMspk10LmpProduct_2_1: state => state.Mspk10LmpProduct_2_1,
    getMspk10LmpProduct_2_2: state => state.Mspk10LmpProduct_2_2,

    getMssscZh_product_1: state => state.MssscZh_product_1,
    getMssscZh_product_2: state => state.MssscZh_product_2,
    getMssscZh_product_3: state => state.MssscZh_product_3,

    // 从state中取出北京赛车数据
    getPk10LmpProduct_1: state => state.Pk10LmpProduct_1,
    getPk10LmpProduct_2_1: state => state.Pk10LmpProduct_2_1,
    getPk10LmpProduct_2_2: state => state.Pk10LmpProduct_2_2,

    // 从state中取出秒速飞艇数据
    getJsftLmpProduct_1: state => state.JsftLmpProduct_1,
    getJsftLmpProduct_2_1: state => state.JsftLmpProduct_2_1,
    getJsftLmpProduct_2_2: state => state.JsftLmpProduct_2_2,

    // 从state中取出重庆时时彩的数据
    getCqsscZh_Product_1: state => state.CqsscZhProduct_1,
    getCqsscZh_Product_2: state => state.CqsscZhProduct_2,
    getCqsscZh_Product_3: state => state.CqsscZhProduct_3,

    // 从state中取出新疆时时彩的数据
    getXjsscZh_Product_1: state => state.XjsscZhProduct_1,
    getXjsscZh_Product_2: state => state.XjsscZhProduct_2,
    getXjsscZh_Product_3: state => state.XjsscZhProduct_3,

    // 从state中取出幸运蛋蛋的数据
    getXyddXydd_Product_1: state => state.XyddXyddProduct_1,
    getXyddXydd_Product_2: state => state.XyddXyddProduct_2,
    getXyddXydd_Product_3: state => state.XyddXyddProduct_3,

    // 从state中取出幸运蛋蛋的数据
    getPcddPcdd_Product_1: state => state.PcddPcddProduct_1,
    getPcddPcdd_Product_2: state => state.PcddPcddProduct_2,
    getPcddPcdd_Product_3: state => state.PcddPcddProduct_3,

    // 从state中取出幸运快乐8的数据
    getXykl8Lmp_Product_1: state => state.Xykl8LmpProduct_1,
    getXykl8Lmp_Product_2: state => state.Xykl8LmpProduct_2,
    getXykl8Lmp_Product_3: state => state.Xykl8LmpProduct_3,
    getXykl8Lmp_Product_4: state => state.Xykl8LmpProduct_4,

    // 从state中取出北京快乐8的数据
    getBjkl8Lmp_Product_1: state => state.Bjkl8LmpProduct_1,
    getBjkl8Lmp_Product_2: state => state.Bjkl8LmpProduct_2,
    getBjkl8Lmp_Product_3: state => state.Bjkl8LmpProduct_3,
    getBjkl8Lmp_Product_4: state => state.Bjkl8LmpProduct_4,
    getBjkl8Lmp_Product_5: state => state.Bjkl8LmpProduct_5,

    // 从state中取出江苏骰宝的数据
    getJsk3Dxtb_Product_1: state => state.Jsk3DxtbProduct_1,
    getJsk3Dxtb_Product_2: state => state.Jsk3DxtbProduct_2,
    getJsk3Dxtb_Product_3: state => state.Jsk3DxtbProduct_3,
    getJsk3Dxtb_Product_4: state => state.Jsk3DxtbProduct_4,
    getJsk3Dxtb_Product_5: state => state.Jsk3DxtbProduct_5,
    getJsk3Dxtb_Product_6: state => state.Jsk3DxtbProduct_6,
    getJsk3Dxtb_Product_7: state => state.Jsk3DxtbProduct_7,

    // 从state中取出广东11选5的数据
    getGd11x5Lm_Product_1: state => state.Gd11x5LmProduct_1,
    getGd11x5Lm_Product_2: state => state.Gd11x5LmProduct_2,
    getGd11x5Lm_Product_3: state => state.Gd11x5LmProduct_3,
    // getGd11x5Lm_Product_4: state => state.Gd11x5LmProduct_4,

    // 从state中取出广东快乐十分的数据
    getGdklsfLmp_Product_1: state => state.GdklsfLmpProduct_1,
    getGdklsfLmp_Product_2: state => state.GdklsfLmpProduct_2,
    getGdklsfLmp_Product_3: state => state.GdklsfLmpProduct_3,


    // 获取modal messages
    getModalMessageFromStatic: state => state.modalMessageFromStatic.getModalMessage,
    // 获取footer messages
    getFooterMessageFromStatic: state => state.footerMessageFromStatic.getFooterMessage


}

// init state
const state = {
    Mspk10LmpName: {}, // 为了遍历页面
    Mspk10LmpInput: {}, // 为了遍历页面

    Mspk10LmpProduct_1: [], // 为组件化的第一种商品item提供数据
    Mspk10LmpProduct_2_1: [],  // 为组件化的第二种商品item提供数据
    Mspk10LmpProduct_2_2: [],  // 为组件化的第二种商品item提供数据

    MssscZh_product_1: [], // 秒速时时彩
    MssscZh_product_2: [],
    MssscZh_product_3: [],

    Pk10LmpProduct_1: [], // 为北京赛车的第一种商品item提供数据
    Pk10LmpProduct_2_1: [],  // 为北京赛车的第二种商品item提供数据
    Pk10LmpProduct_2_2: [],  // 为北京赛车的第二种商品item提供数据

    JsftLmpProduct_1: [], // 为秒速飞艇的第一种商品item提供数据
    JsftLmpProduct_2_1: [],  // 为秒速飞艇的第二种商品item提供数据
    JsftLmpProduct_2_2: [],  // 为秒速飞艇的第二种商品item提供数据

    CqsscZhProduct_1: [], // 为重庆时时彩的第一种商品item提供数据
    CqsscZhProduct_2: [],  // 为重庆时时彩的第二种商品item提供数据
    CqsscZhProduct_3: [],  // 为重庆时时彩的第二种商品item提供数据

    XjsscZhProduct_1: [], // 为新疆时时彩的第一种商品item提供数据
    XjsscZhProduct_2: [],  // 为新疆时时彩的第二种商品item提供数据
    XjsscZhProduct_3: [],  // 为新疆时时彩的第二种商品item提供数据

    XyddXyddProduct_1: [], // 为幸运蛋蛋的第一种商品item提供数据
    XyddXyddProduct_2: [],  // 为幸运蛋蛋的第二种商品item提供数据
    XyddXyddProduct_3: [],  // 为幸运蛋蛋的第二种商品item提供数据

    PcddPcddProduct_1: [], // 为PC蛋蛋的第一种商品item提供数据
    PcddPcddProduct_2: [],  // 为PC蛋蛋的第二种商品item提供数据
    PcddPcddProduct_3: [],  // 为PC蛋蛋的第二种商品item提供数据

    Xykl8LmpProduct_1: [], // 为幸运快乐8的第一种商品item提供数据 (原始数据)
    Xykl8LmpProduct_2: [],  // 为幸运快乐8的第二种商品item提供数据 (原始数据)
    Xykl8LmpProduct_3: [],  // 为幸运快乐8的第三种商品item提供数据 (原始数据)
    Xykl8LmpProduct_4: [],  // 为幸运快乐8的第四种商品item提供数据 ()

    Xykl8LmpProduct_1_title: [], // 幸运快乐8 第一种商品的名称  在最开始的时候,通过mounted () 方法 将处理之后的 title加入
    Xykl8LmpProduct_1_content_name: [], // 幸运快乐8 第一种商品的内容 这个是用来测试的
    Xykl8LmpProduct_1_filtered: [], // 幸运快乐8 第一种商品处理之后的.用于循环的 用键值对的形式进行存储

    Bjkl8LmpProduct_1: [], // 为北京快乐8的第一种商品item提供数据
    Bjkl8LmpProduct_2: [],  // 为北京快乐8的第二种商品item提供数据
    Bjkl8LmpProduct_3: [],  // 为北京快乐8的第三种商品item提供数据
    Bjkl8LmpProduct_4: [],  // 为北京快乐8的第四种商品item提供数据
    Bjkl8LmpProduct_5: [],  // 为北京快乐8的第五种商品item提供数据

    Jsk3DxtbProduct_1: [],  // 为江苏骰宝的第一种商品item提供数据
    Jsk3DxtbProduct_2: [],  // 为江苏骰宝的第二种商品item提供数据
    Jsk3DxtbProduct_3: [],  // 为江苏骰宝的第三种商品item提供数据
    Jsk3DxtbProduct_4: [],  // 为江苏骰宝的第四种商品item提供数据
    Jsk3DxtbProduct_5: [],  // 为江苏骰宝的第五种商品item提供数据
    Jsk3DxtbProduct_6: [],  // 为江苏骰宝的第六种商品item提供数据
    Jsk3DxtbProduct_7: [],  // 为江苏骰宝的第七种商品item提供数据

    Gd11x5LmProduct_1: [],  // 为广东11选5的第一种商品item提供数据
    Gd11x5LmProduct_2: [],  // 为广东11选5的第二种商品item提供数据
    Gd11x5LmProduct_3: [],  // 为广东11选5的第三种商品item提供数据
    // Gd11x5LmProduct_4: [],  // 为广东11选5的第四种商品item提供数据

    GdklsfLmpProduct_1: [],  // 为广东快乐十分的第一种商品item提供数据
    GdklsfLmpProduct_2: [],  // 为广东快乐十分的第二种商品item提供数据
    GdklsfLmpProduct_3: [],  // 为广东快乐十分的第三种商品item提供数据

    modalMessageFromStatic: {}, // 为modal 从static里面取出modal messages
    footerMessageFromStatic: {}, //为modal 从static里面取出footer messages

}

// actions
const actions = {
    // 将幸运快乐8的title,处理好(阿拉伯数字变英文)之后,放入state中
    setXykl8LmpPlays_196_title({ commit }) {
        // alert(123)
        commit(types.SET_XYKL8_LMP_PLAYS_196_TITLE)

    },

    // 为页面的中的title获取数据(使用的是import方法)
    // getMspk10LmpPlayCates({ commit }) {
    //     Mspk10Lmp.getMspk10LmpName(items => {
    // console.log(items)
    // commit(types.GET_MSPK10_LMP_NAME, items)
    // })
    // },
    // getMspk10LmpPlays({ commit }) {
    //     Mspk10Lmp.getMspk10LmpInput(items => {
    // console.log(items)
    // commit(types.GET_MSPK10_LMP_INPUT, items)
    // })

    // },
    // 为页面的title和玩法通过axios获取数据,由于传入的过程,只有数据最好不要有变化,而且这个过程也取不出数据,所以我们在传数据之前,先处理好,再dispatch,然后取出的数据最好也是直接要取的数据,取出之后,再进行处理. getters的时候只能取出里面的一层的
    getPlayCatesFromGameDatas({ commit, state}, playCatesFromGameDatas) {
        // console.log(playCatesFromGameDatas.getPlayCatesFromGameDatas);
        commit(types.GET_PLAYCATES_FROM_GAMEDATAS, { playCatesFromGameDatas })
    },
    getPlaysFromGameDatas({ commit, state}, playsFromGameDatas) {
        // console.log(playsFromGameDatas.getPlaysFromGameDatas);
        commit(types.GET_PLAYS_FROM_GAMEDATAS, { playsFromGameDatas })
    },
    // 为页面的title和玩法通过axios获取数据,由于传入的过程,只有数据最好不要有变化,而且这个过程也取不出数据,所以我们在传数据之前,先处理好,再dispatch,然后取出的数据最好也是直接要取的数据,取出之后,再进行处理. getters的时候只能取出里面的一层的 end

    // 从static里面取出然后，放入vuex里面 type1: 底部，type2: 弹窗， type4，两个都要
    getModalMessageFromStatic({ commit, state}, modalMessageFromStatic) {
        // console.log(playsFromGameDatas.getPlaysFromGameDatas);
        commit(types.GET_MODAL_MESSAGE_FROM_STATIC, { modalMessageFromStatic })
    },
    getFooterMessageFromStatic({ commit, state}, footerMessageFromStatic) {
        // console.log(playsFromGameDatas.getPlaysFromGameDatas);
        commit(types.GET_FOOTER_MESSAGE_FROM_STATIC, { footerMessageFromStatic })
    },




    // getGameDatas({ commit, state }, gameDatas) {
    // 这里只用第一个参数
    // console.log(gameDatas.getGameDatas);
    // commit(types.GET_GAME_DATAS, { gameDatas })
    // },

    // 为最开始加载页面的时候，获取秒速赛车的数据
    getMspk10LmpProduct_1 ({ commit }) {
        Mspk10Lmp_product.getMspk10LmpProduct_1_for_component(products => {
            commit(types.GET_MSPK10_LMP_PRODUCT_1, { products })
        })
    },
    getMspk10LmpProduct_2_1 ({ commit }) {
        Mspk10Lmp_product.getMspk10LmpProduct_2_1_for_component(products => {
            commit(types.GET_MSPK10_LMP_PRODUCT_2_1, { products })
        })
    },
    getMspk10LmpProduct_2_2 ({ commit }) {
        Mspk10Lmp_product.getMspk10LmpProduct_2_2_for_component(products => {
            commit(types.GET_MSPK10_LMP_PRODUCT_2_2, { products })
        })
    },
    // 为最开始加载页面的时候，获取秒速时时彩的数据

    getMssscZhProduct_1 ({ commit }) {
        MssscZh_product.getMssscZh_product_1_for_component(products => {
            commit(types.GET_MSSSC_Zh_PRODUCT_1, { products })
        })
    },
    getMssscZhProduct_2 ({ commit }) {
        MssscZh_product.getMssscZh_product_2_for_component(products => {
            commit(types.GET_MSSSC_Zh_PRODUCT_2, { products })
        })
    },
    getMssscZhProduct_3 ({ commit }) {
        MssscZh_product.getMssscZh_product_3_for_component(products => {
            commit(types.GET_MSSSC_Zh_PRODUCT_3, { products })
        })
    },
    // 为最开始加载页面的时候，获取北京赛车的数据
    getPk10LmpProduct_1 ({ commit }) {
        Pk10Lmp_product.getPk10LmpProduct_1_for_component(products => {
            commit(types.GET_PK10_LMP_PRODUCT_1, { products })
        })
    },
    getPk10LmpProduct_2_1 ({ commit }) {
        Pk10Lmp_product.getPk10LmpProduct_2_1_for_component(products => {
            commit(types.GET_PK10_LMP_PRODUCT_2_1, { products })
        })
    },
    getPk10LmpProduct_2_2 ({ commit }) {
        Pk10Lmp_product.getPk10LmpProduct_2_2_for_component(products => {
            commit(types.GET_PK10_LMP_PRODUCT_2_2, { products })
        })
    },
    // 为最开始加载页面的时候，获取秒速飞艇的数据
    getJsftLmpProduct_1 ({ commit }) {
        JsftLmp_product.getJsftLmpProduct_1_for_component(products => {
            commit(types.GET_JSFT_LMP_PRODUCT_1, { products })
        })
    },
    getJsftLmpProduct_2_1 ({ commit }) {
        JsftLmp_product.getJsftLmpProduct_2_1_for_component(products => {
            commit(types.GET_JSFT_LMP_PRODUCT_2_1, { products })
        })
    },
    getJsftLmpProduct_2_2 ({ commit }) {
        JsftLmp_product.getJsftLmpProduct_2_2_for_component(products => {
            commit(types.GET_JSFT_LMP_PRODUCT_2_2, { products })
        })
    },
    // 为最开始加载页面的时候，获取重庆时时彩的数据
    getCqsscZhProduct_1 ({ commit }) {
        CqsscZh_product.getCqsscZh_product_1_for_component(products => {
            commit(types.GET_CQSSC_ZH_PRODUCT_1, { products })
        })
    },
    getCqsscZhProduct_2 ({ commit }) {
        CqsscZh_product.getCqsscZh_product_2_for_component(products => {
            commit(types.GET_CQSSC_ZH_PRODUCT_2, { products })
        })
    },
    getCqsscZhProduct_3 ({ commit }) {
        CqsscZh_product.getCqsscZh_product_3_for_component(products => {
            commit(types.GET_CQSSC_ZH_PRODUCT_3, { products })
        })
    },
    // 为最开始加载页面的时候,获取新疆时时彩的数据
    getXjsscZhProduct_1 ({ commit }) {
        XjsscZh_product.getXjsscZh_product_1_for_component(products => {
            commit(types.GET_XJSSC_ZH_PRODUCT_1, { products })
        })
    },
    getXjsscZhProduct_2 ({ commit }) {
        XjsscZh_product.getXjsscZh_product_2_for_component(products => {
            commit(types.GET_XJSSC_ZH_PRODUCT_2, { products })
        })
    },
    getXjsscZhProduct_3 ({ commit }) {
        XjsscZh_product.getXjsscZh_product_3_for_component(products => {
            commit(types.GET_XJSSC_ZH_PRODUCT_3, { products })
        })
    },
    // 为最开始加载页面的时候,获取幸运蛋蛋的数据
    getXyddXyddProduct_1 ({ commit }) {
        XyddXydd_product.getXyddXydd_product_1_for_component(products => {
            commit(types.GET_XYDD_XYDD_PRODUCT_1, { products })
        })
    },
    getXyddXyddProduct_2 ({ commit }) {
        XyddXydd_product.getXyddXydd_product_2_for_component(products => {
            commit(types.GET_XYDD_XYDD_PRODUCT_2, { products })
        })
    },
    getXyddXyddProduct_3 ({ commit }) {
        XyddXydd_product.getXyddXydd_product_3_for_component(products => {
            commit(types.GET_XYDD_XYDD_PRODUCT_3, { products })
        })
    },
    // 为最开始加载页面的时候,获取PC蛋蛋的数据
    getPcddPcddProduct_1 ({ commit }) {
        PcddPcdd_product.getPcddPcdd_product_1_for_component(products => {
            commit(types.GET_PCDD_PCDD_PRODUCT_1, { products })
        })
    },
    getPcddPcddProduct_2 ({ commit }) {
        PcddPcdd_product.getPcddPcdd_product_2_for_component(products => {
            commit(types.GET_PCDD_PCDD_PRODUCT_2, { products })
        })
    },
    getPcddPcddProduct_3 ({ commit }) {
        PcddPcdd_product.getPcddPcdd_product_3_for_component(products => {
            commit(types.GET_PCDD_PCDD_PRODUCT_3, { products })
        })
    },

    // 为最开始加载页面的时候,获取幸运快乐8的数据
    getXykl8LmpProduct_1 ({ commit }) {
        Xykl8Lmp_product.getXykl8Lmp_product_1_for_component(products => {
            commit(types.GET_XYKL8_LMP_PRODUCT_1, { products })
        })
    },
    getXykl8LmpProduct_2 ({ commit }) {
        Xykl8Lmp_product.getXykl8Lmp_product_2_for_component(products => {
            commit(types.GET_XYKL8_LMP_PRODUCT_2, { products })
        })
    },
    getXykl8LmpProduct_3 ({ commit }) {
        Xykl8Lmp_product.getXykl8Lmp_product_3_for_component(products => {
            commit(types.GET_XYKL8_LMP_PRODUCT_3, { products })
        })
    },
    getXykl8LmpProduct_4 ({ commit }) {
        Xykl8Lmp_product.getXykl8Lmp_product_4_for_component(products => {
            commit(types.GET_XYKL8_LMP_PRODUCT_4, { products })
        })
    },

    // 为最开始加载页面的时候,获取北京快乐8的数据
    getBjkl8LmpProduct_1 ({ commit }) {
        Bjkl8Lmp_product.getBjkl8Lmp_product_1_for_component(products => {
            commit(types.GET_BJKL8_LMP_PRODUCT_1, { products })
        })
    },
    getBjkl8LmpProduct_2 ({ commit }) {
        Bjkl8Lmp_product.getBjkl8Lmp_product_2_for_component(products => {
            commit(types.GET_BJKL8_LMP_PRODUCT_2, { products })
        })
    },
    getBjkl8LmpProduct_3 ({ commit }) {
        Bjkl8Lmp_product.getBjkl8Lmp_product_3_for_component(products => {
            commit(types.GET_BJKL8_LMP_PRODUCT_3, { products })
        })
    },
    getBjkl8LmpProduct_4 ({ commit }) {
        Bjkl8Lmp_product.getBjkl8Lmp_product_4_for_component(products => {
            commit(types.GET_BJKL8_LMP_PRODUCT_4, { products })
        })
    },
    getBjkl8LmpProduct_5 ({ commit }) {
        Bjkl8Lmp_product.getBjkl8Lmp_product_5_for_component(products => {
            commit(types.GET_BJKL8_LMP_PRODUCT_5, { products })
        })
    },
    // 为最开始加载页面的时候,获取江苏骰宝的数据
    getJsk3DxtbProduct_1 ({ commit }) {
        Jsk3Dxtb_product.getJsk3Dxtb_product_1_for_component(products => {
            commit(types.GET_JSK3_DXTB_PRODUCT_1, { products })
        })
    },
    getJsk3DxtbProduct_2 ({ commit }) {
        Jsk3Dxtb_product.getJsk3Dxtb_product_2_for_component(products => {
            commit(types.GET_JSK3_DXTB_PRODUCT_2, { products })
        })
    },
    getJsk3DxtbProduct_3 ({ commit }) {
        Jsk3Dxtb_product.getJsk3Dxtb_product_3_for_component(products => {
            commit(types.GET_JSK3_DXTB_PRODUCT_3, { products })
        })
    },
    getJsk3DxtbProduct_4 ({ commit }) {
        Jsk3Dxtb_product.getJsk3Dxtb_product_4_for_component(products => {
            commit(types.GET_JSK3_DXTB_PRODUCT_4, { products })
        })
    },
    getJsk3DxtbProduct_5 ({ commit }) {
        Jsk3Dxtb_product.getJsk3Dxtb_product_5_for_component(products => {
            commit(types.GET_JSK3_DXTB_PRODUCT_5, { products })
        })
    },
    getJsk3DxtbProduct_6 ({ commit }) {
        Jsk3Dxtb_product.getJsk3Dxtb_product_6_for_component(products => {
            commit(types.GET_JSK3_DXTB_PRODUCT_6, { products })
        })
    },
    getJsk3DxtbProduct_7 ({ commit }) {
        Jsk3Dxtb_product.getJsk3Dxtb_product_7_for_component(products => {
            commit(types.GET_JSK3_DXTB_PRODUCT_7, { products })
        })
    },
    // 为最开始加载页面的时候,获取广东11选5的数据
    getGd11x5LmProduct_1 ({ commit }) {
        Gd11x5Lmp_product.getGd11x5Lm_product_1_for_component(products => {
            commit(types.GET_GD11X5_LM_PRODUCT_1, { products })
        })
    },
    getGd11x5LmProduct_2 ({ commit }) {
        Gd11x5Lmp_product.getGd11x5Lm_product_2_for_component(products => {
            commit(types.GET_GD11X5_LM_PRODUCT_2, { products })
        })
    },
    getGd11x5LmProduct_3 ({ commit }) {
        Gd11x5Lmp_product.getGd11x5Lm_product_3_for_component(products => {
            commit(types.GET_GD11X5_LM_PRODUCT_3, { products })
        })
    },
    // 为最开始加载页面的时候,获取广东快乐十分的数据
    getGdklsfLmpProduct_1 ({ commit }) {
        GdklsfLmp_product.getGdklsfLmp_product_1_for_component(products => {
            commit(types.GET_GDKLSF_LMP_PRODUCT_1, { products })
        })
    },
    getGdklsfLmpProduct_2 ({ commit }) {
        GdklsfLmp_product.getGdklsfLmp_product_2_for_component(products => {
            commit(types.GET_GDKLSF_LMP_PRODUCT_2, { products })
        })
    },
    getGdklsfLmpProduct_3 ({ commit }) {
        GdklsfLmp_product.getGdklsfLmp_product_3_for_component(products => {
            commit(types.GET_GDKLSF_LMP_PRODUCT_3, { products })
        })
    },


}


// mutations
const mutations = {
    // [types.GET_MSPK10_LMP_NAME] (state, items) {
    //     state.Mspk10LmpName = items
    // },
    // [types.GET_MSPK10_LMP_INPUT] (state, items) {
    //     state.Mspk10LmpInput = items
    // },
    [types.GET_MSPK10_LMP_PRODUCT_1] (state, { products }) {
        state.Mspk10LmpProduct_1 = products
    },
    [types.GET_MSPK10_LMP_PRODUCT_2_1] (state, { products }) {
        state.Mspk10LmpProduct_2_1 = products
    },
    [types.GET_MSPK10_LMP_PRODUCT_2_2] (state, { products }) {
        state.Mspk10LmpProduct_2_2 = products
    },
    [types.GET_MSSSC_Zh_PRODUCT_1] (state, { products }) {
        state.MssscZh_product_1 = products
    },
    [types.GET_MSSSC_Zh_PRODUCT_2] (state, { products }) {
        state.MssscZh_product_2 = products
    },
    [types.GET_MSSSC_Zh_PRODUCT_3] (state, { products }) {
        state.MssscZh_product_3 = products
    },
    [types.GET_PK10_LMP_PRODUCT_1] (state, { products }) {
        state.Pk10LmpProduct_1 = products
    },
    [types.GET_PK10_LMP_PRODUCT_2_1] (state, { products }) {
        state.Pk10LmpProduct_2_1 = products
    },
    [types.GET_PK10_LMP_PRODUCT_2_2] (state, { products }) {
        state.Pk10LmpProduct_2_2 = products
    },
    [types.GET_JSFT_LMP_PRODUCT_1] (state, { products }) {
        state.JsftLmpProduct_1 = products
    },
    [types.GET_JSFT_LMP_PRODUCT_2_1] (state, { products }) {
        state.JsftLmpProduct_2_1 = products
    },
    [types.GET_JSFT_LMP_PRODUCT_2_2] (state, { products }) {
        state.JsftLmpProduct_2_2 = products
    },
    [types.GET_CQSSC_ZH_PRODUCT_1] (state, { products }) {
        state.CqsscZhProduct_1 = products
    },
    [types.GET_CQSSC_ZH_PRODUCT_2] (state, { products }) {
        state.CqsscZhProduct_2 = products
    },
    [types.GET_CQSSC_ZH_PRODUCT_3] (state, { products }) {
        state.CqsscZhProduct_3 = products
    },
    [types.GET_XJSSC_ZH_PRODUCT_1] (state, { products }) {
        state.XjsscZhProduct_1 = products
    },
    [types.GET_XJSSC_ZH_PRODUCT_2] (state, { products }) {
        state.XjsscZhProduct_2 = products
    },
    [types.GET_XJSSC_ZH_PRODUCT_3] (state, { products }) {
        state.XjsscZhProduct_3 = products
    },
    [types.GET_XYDD_XYDD_PRODUCT_1] (state, { products }) {
        state.XyddXyddProduct_1 = products
    },
    [types.GET_XYDD_XYDD_PRODUCT_2] (state, { products }) {
        state.XyddXyddProduct_2 = products
    },
    [types.GET_XYDD_XYDD_PRODUCT_3] (state, { products }) {
        state.XyddXyddProduct_3 = products
    },
    [types.GET_PCDD_PCDD_PRODUCT_1] (state, { products }) {
        state.PcddPcddProduct_1 = products
    },
    [types.GET_PCDD_PCDD_PRODUCT_2] (state, { products }) {
        state.PcddPcddProduct_2 = products
    },
    [types.GET_PCDD_PCDD_PRODUCT_3] (state, { products }) {
        state.PcddPcddProduct_3 = products
    },
    [types.GET_XYKL8_LMP_PRODUCT_1] (state, { products }) {
        state.Xykl8LmpProduct_1 = products
    },
    [types.GET_XYKL8_LMP_PRODUCT_2] (state, { products }) {
        state.Xykl8LmpProduct_2 = products
    },
    [types.GET_XYKL8_LMP_PRODUCT_3] (state, { products }) {
        state.Xykl8LmpProduct_3 = products
    },
    [types.GET_XYKL8_LMP_PRODUCT_4] (state, { products }) {
        state.Xykl8LmpProduct_4 = products
    },
    [types.SET_XYKL8_LMP_PLAYS_196_TITLE] (state) {
        // 第一步,找到Xykl8LmpInput的相关数据(循环Input，然后通过playCateId取出数据) (将数据取出)
        let Xykl8LmpProduct_1_title_data = []

        for(let item in state.Mspk10LmpInput) {
            // console.log(item)
            if(state.Mspk10LmpInput[item].playCateId === 196){
                Xykl8LmpProduct_1_title_data.push(
                    state.Mspk10LmpInput[item]
                )}
        }
        // 第二步,取出相关的字段,处理好之后返回()
        let Xykl8LmpProduct_1_title_shuzi = []

        // 将第0个字符到倒数第二个字符之间的字符串赋值给Xykl8LmpProduct_1_title_zhuangzhongwen (将数字取出),然后将数字转成中文
        for(let item in Xykl8LmpProduct_1_title_data) {
            // 取出每个字符中的第0个位置到倒数第二个位置的所有的字符
            // Xykl8LmpProduct_1_title_zhuangzhongwen.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2))
            // 值如 第1球 第1球 第1球 第1球

            // Xykl8LmpProduct_1_title_shuzi.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))
            // 值如 1 1 1 1
            // state.Xykl8LmpProduct_1_title.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))

            // state.Xykl8LmpProduct_1_title.push(chinanum(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1)))
            // 值如 一 一 一 一

            let itemZuhe = "第" + chinanum(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1)) + "球"

            Xykl8LmpProduct_1_title_shuzi.push(itemZuhe);
            // state.Xykl8LmpProduct_1_title.push(itemZuhe);
            // 值如 第一球 第一球 第一球 第一球
        }

        // 数组排重,并赋值
        for(let item in getFilterArray(Xykl8LmpProduct_1_title_shuzi)) {
            state.Xykl8LmpProduct_1_title.push(
                {
                    "titleNo": item,
                    "title": getFilterArray(Xykl8LmpProduct_1_title_shuzi)[item]
                }
            )
            // 值如 第一球 第二球 第三球 第四球
        }

        // return state.Xykl8LmpProduct_1_title_data

        // return state.Mspk10LmpInput

        // return state.state.Xykl8LmpProduct_1_title

        // console.log(state.Xykl8LmpProduct_1_title)
    },


    [types.GET_BJKL8_LMP_PRODUCT_1] (state, { products }) {
        state.Bjkl8LmpProduct_1 = products
    },
    [types.GET_BJKL8_LMP_PRODUCT_2] (state, { products }) {
        state.Bjkl8LmpProduct_2 = products
    },
    [types.GET_BJKL8_LMP_PRODUCT_3] (state, { products }) {
        state.Bjkl8LmpProduct_3 = products
    },
    [types.GET_BJKL8_LMP_PRODUCT_4] (state, { products }) {
        state.Bjkl8LmpProduct_4 = products
    },
    [types.GET_BJKL8_LMP_PRODUCT_5] (state, { products }) {
        state.Bjkl8LmpProduct_5 = products
    },
    [types.GET_JSK3_DXTB_PRODUCT_1] (state, { products }) {
        state.Jsk3DxtbProduct_1 = products
    },
    [types.GET_JSK3_DXTB_PRODUCT_2] (state, { products }) {
        state.Jsk3DxtbProduct_2 = products
    },
    [types.GET_JSK3_DXTB_PRODUCT_3] (state, { products }) {
        state.Jsk3DxtbProduct_3 = products
    },
    [types.GET_JSK3_DXTB_PRODUCT_4] (state, { products }) {
        state.Jsk3DxtbProduct_4 = products
    },
    [types.GET_JSK3_DXTB_PRODUCT_5] (state, { products }) {
        state.Jsk3DxtbProduct_5 = products
    },
    [types.GET_JSK3_DXTB_PRODUCT_6] (state, { products }) {
        state.Jsk3DxtbProduct_6 = products
    },
    [types.GET_JSK3_DXTB_PRODUCT_7] (state, { products }) {
        state.Jsk3DxtbProduct_7 = products
    },
    [types.GET_GD11X5_LM_PRODUCT_1] (state, { products }) {
        state.Gd11x5LmProduct_1 = products
    },
    [types.GET_GD11X5_LM_PRODUCT_2] (state, { products }) {
        state.Gd11x5LmProduct_2 = products
    },
    [types.GET_GD11X5_LM_PRODUCT_3] (state, { products }) {
        state.Gd11x5LmProduct_3 = products
    },
    [types.GET_GDKLSF_LMP_PRODUCT_1] (state, { products }) {
        state.GdklsfLmpProduct_1 = products
    },
    [types.GET_GDKLSF_LMP_PRODUCT_2] (state, { products }) {
        state.GdklsfLmpProduct_2 = products
    },
    [types.GET_GDKLSF_LMP_PRODUCT_3] (state, { products }) {
        state.GdklsfLmpProduct_3 = products
    },
    // [types.GET_GAME_DATAS] (state, { gameDatas }) {
    //     // console.log(gameDatas.getGameDatas)
    //     state.Mspk10LmpName = gameDatas
    //     state.Mspk10LmpInput = gameDatas
    // },
    [types.GET_PLAYCATES_FROM_GAMEDATAS] (state, { playCatesFromGameDatas }) {
        state.Mspk10LmpName = playCatesFromGameDatas.getPlayCatesFromGameDatas
        // console.log(playCatesFromGameDatas)
    },
    [types.GET_PLAYS_FROM_GAMEDATAS] (state, { playsFromGameDatas }) {
        // console.log(playsFromGameDatas.getPlaysFromGameDatas)
        state.Mspk10LmpInput = playsFromGameDatas.getPlaysFromGameDatas
    },
    [types.GET_MODAL_MESSAGE_FROM_STATIC] (state, { modalMessageFromStatic }) {
    // console.log(playsFromGameDatas.getPlaysFromGameDatas)
    state.modalMessageFromStatic = modalMessageFromStatic.getModalMessage
},
    [types.GET_FOOTER_MESSAGE_FROM_STATIC] (state, { footerMessageFromStatic }) {
        // console.log(playsFromGameDatas.getPlaysFromGameDatas)
        state.footerMessageFromStatic = footerMessageFromStatic.getFooterMessage
    },

}

// 幸运快乐8 重排数据开始

// 数字转中文的工具类函数
// function chinanum(num) {
//     let china = ['零','一','二','三','四','五','六','七','八','九']
//     let arr = []
//     let english = num.split("")
//     for(let i = 0; i < english.length; i++) {
//         arr[i] = china[english[i]];
//     }
//     return arr.join("")
// }

// 测试 将数字转化为中文
// var shuzi = '34562342'
// chinanum(shuzi)
// console.log(shuzi)

function chinanum(num) {
    switch (num)
    {
        case "0":
            return "零"
        case "1":
            return "一"
        case "2":
            return "二"
        case "3":
            return "三"
        case "4":
            return "四"
        case "5":
            return "五"
        case "6":
            return "六"
        case "7":
            return "七"
        case "8":
            return "八"
        case "9":
            return "九"
        case "10":
            return "十"
        case "11":
            return "十一"
        case "12":
            return "十二"
        case "13":
            return "十三"
        case "14":
            return "十四"
        case "15":
            return "十五"
        case "16":
            return "十六"
        case "17":
            return "十七"
        case "18":
            return "十八"
        case "19":
            return "十九"
        case "20":
            return "二十"
        default:
            break
    }
}

// 数组排重
function getFilterArray (array) {
    const res = [];
    const json = {};
    for (let i = 0; i < array.length; i++){
        const _self = array[i];
        if(!json[_self]){
            res.push(_self);
            json[_self] = 1;
        }
    }
    return res;
}

// 将相应的数据放入

// 后面的这两个函数没有用,后来再commit里面然后

// Xykl8LmpProduct_1_title
function getXykl8LmpPlays_196_title_tools (state) {

    // 第一步,找到Xykl8LmpInput的相关数据(循环Input，然后通过playCateId取出数据) (将数据取出)
    let Xykl8LmpProduct_1_title_data = []

    for(let item in state.Mspk10LmpInput) {
        // console.log(item)
        if(state.Mspk10LmpInput[item].playCateId === 196){
            Xykl8LmpProduct_1_title_data.push(
                state.Mspk10LmpInput[item]
            )}
    }
    // 第二步,取出相关的字段,处理好之后返回()
    let Xykl8LmpProduct_1_title_shuzi = []

    // 将第0个字符到倒数第二个字符之间的字符串赋值给Xykl8LmpProduct_1_title_zhuangzhongwen (将数字取出),然后将数字转成中文
    for(let item in Xykl8LmpProduct_1_title_data) {
        // 取出每个字符中的第0个位置到倒数第二个位置的所有的字符
        // Xykl8LmpProduct_1_title_zhuangzhongwen.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2))
        // 值如 第1球 第1球 第1球 第1球

        // Xykl8LmpProduct_1_title_shuzi.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))
        // 值如 1 1 1 1
        // state.Xykl8LmpProduct_1_title.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))

        // state.Xykl8LmpProduct_1_title.push(chinanum(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1)))
        // 值如 一 一 一 一

        let itemZuhe = "第" + chinanum(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1)) + "球"

        Xykl8LmpProduct_1_title_shuzi.push(itemZuhe);
        // state.Xykl8LmpProduct_1_title.push(itemZuhe);
        // 值如 第一球 第一球 第一球 第一球
    }

    // 数组排重,并赋值
    for(let item in getFilterArray(Xykl8LmpProduct_1_title_shuzi)) {
        state.Xykl8LmpProduct_1_title.push(
            {
                "titleNo": item,
                "title": getFilterArray(Xykl8LmpProduct_1_title_shuzi)[item]
            }
        )
        // 值如 第一球 第二球 第三球 第四球
    }

    // return state.Xykl8LmpProduct_1_title_data

    // return state.Mspk10LmpInput

    // return state.state.Xykl8LmpProduct_1_title
}

function getXykl8LmpPlays_196_content_name_tools(state) {

    // 第一步,找到Xykl8LmpInput的相关数据(循环Input，然后通过playCateId取出数据) (将数据取出)
    let Xykl8LmpProduct_1_content_data = []

    for(let item in state.Mspk10LmpInput) {
        // console.log(item)
        if(state.Mspk10LmpInput[item].playCateId === 196){
            Xykl8LmpProduct_1_content_data.push(
                state.Mspk10LmpInput[item]
            )}
    }
    // 第二步,取出相关的字段,处理好之后返回()
    // let Xykl8LmpProduct_1_content_shuzi = []

    // 将第0个字符到倒数第二个字符之间的字符串赋值给Xykl8LmpProduct_1_title_zhuangzhongwen (将数字取出),然后将数字转成中文
    for(let item in Xykl8LmpProduct_1_content_data) {
        // 取出每个字符中的第0个位置到倒数第二个位置的所有的字符
        // Xykl8LmpProduct_1_title_zhuangzhongwen.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2))
        // 值如 第1球 第1球 第1球 第1球

        // Xykl8LmpProduct_1_title_shuzi.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))
        // 值如 1 1 1 1
        // state.Xykl8LmpProduct_1_title.push(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1))

        // state.Xykl8LmpProduct_1_title.push(chinanum(Xykl8LmpProduct_1_title_data[item].name.slice(0,-2).slice(1,-1)))
        // 值如 一 一 一 一

        // 取出倒数第一个的分类数字
        let itemZuhe = {
            "name": Xykl8LmpProduct_1_content_data[item].name.slice(-1),
            "titleNo": parseInt(item/4),
            "id": Xykl8LmpProduct_1_content_data[item].id
        }
        state.Xykl8LmpProduct_1_content_name.push(itemZuhe)


        // Xykl8LmpProduct_1_title_shuzi.push(itemZuhe);
        // state.Xykl8LmpProduct_1_title.push(itemZuhe);
        // 值如 第一球 第一球 第一球 第一球
    }

    // // 数组排重,并赋值
    // for(let item in getFilterArray(Xykl8LmpProduct_1_title_shuzi)) {
    //     state.Xykl8LmpProduct_1_title.push(getFilterArray(Xykl8LmpProduct_1_title_shuzi)[item])
    //
    //     // 值如 第一球 第二球 第三球 第四球
    // }

    // return state.Xykl8LmpProduct_1_title_data

    // return state.Mspk10LmpInput

    // return state.Xykl8LmpProduct_1_content_name


}
// Xykl8LmpProduct_1_content_name


// 幸运快乐8 重新组合数据结束




export default {
    state,
    getters,
    actions,
    mutations
}