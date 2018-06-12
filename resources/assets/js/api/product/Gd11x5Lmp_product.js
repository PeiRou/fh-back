/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const Gd11x5Lm_product_1 = [
    { 'playCateId': 27 }
]

const Gd11x5Lm_product_2 = [
    { 'playCateId': 30 },
    { 'playCateId': 31 },
    { 'playCateId': 32 },
    { 'playCateId': 33 },
    { 'playCateId': 34 },
]

const Gd11x5Lm_product_3 = [
    { 'playCateId': 35 },
]

//　由于这里的第二种商品和第四种商品是一样的，广东11选5，广东11选5 两面用的是　字　单号用的是　数字　code

// const Gd11x5Lm_product_4 = [
//     { 'playCateId': 30 },
//     { 'playCateId': 31 },
//     { 'playCateId': 32 },
//     { 'playCateId': 33 },
//     { 'playCateId': 34 },
// ]


export default {
    // 获取广东11选5商品
    getGd11x5Lm_product_1_for_component: (cb) => cb(Gd11x5Lm_product_1),
    getGd11x5Lm_product_2_for_component: (cb) => cb(Gd11x5Lm_product_2),
    getGd11x5Lm_product_3_for_component: (cb) => cb(Gd11x5Lm_product_3),
    // getGd11x5Lm_product_4_for_component: (cb) => cb(Gd11x5Lm_product_4),


}