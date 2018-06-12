/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const Mspk10Lmp_product_1 = [
    { 'playCateId': 112 }
]

const Mspk10Lmp_product_2_1 = [
    { 'playCateId': 113 },
    { 'playCateId': 114 },
    { 'playCateId': 115 },
    { 'playCateId': 116 },
    { 'playCateId': 117 }
]

const Mspk10Lmp_product_2_2 = [
    { 'playCateId': 118 },
    { 'playCateId': 119 },
    { 'playCateId': 120 },
    { 'playCateId': 121 },
    { 'playCateId': 122 },
]

// const Pk10Lmp_product_1 = [
//     { 'playCateId': 10 }
// ]
//
// const Pk10Lmp_product_2_1 = [
//     { 'playCateId': 11 },
//     { 'playCateId': 12 },
//     { 'playCateId': 13 },
//     { 'playCateId': 14 },
//     { 'playCateId': 15 }
// ]
//
// const Pk10Lmp_product_2_2 = [
//     { 'playCateId': 16 },
//     { 'playCateId': 17 },
//     { 'playCateId': 18 },
//     { 'playCateId': 19 },
//     { 'playCateId': 20 }
// ]

export default {
    // 获取秒速赛车商品
    getMspk10LmpProduct_1_for_component: (cb) => cb(Mspk10Lmp_product_1),
    getMspk10LmpProduct_2_1_for_component: (cb) => cb(Mspk10Lmp_product_2_1),
    getMspk10LmpProduct_2_2_for_component: (cb) => cb(Mspk10Lmp_product_2_2),
    //
    // // 获取北京赛车商品
    // getPk10LmpProduct_1_for_component: (cb) => cb(Pk10Lmp_product_1),
    // getPk10LmpProduct_2_1_for_component: (cb) => cb(Pk10Lmp_product_2_1),
    // getPk10LmpProduct_2_2_for_component: (cb) => cb(Pk10Lmp_product_2_2),


}