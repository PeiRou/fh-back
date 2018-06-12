/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const CqsscZh_product_1 = [
    { 'playCateId': 1 }
]

const CqsscZh_product_2 = [
    { 'playCateId': 2 },
    { 'playCateId': 3 },
    { 'playCateId': 4 },
    { 'playCateId': 5 },
    { 'playCateId': 6 }
]

const CqsscZh_product_3 = [
    { 'playCateId': 7 },
    { 'playCateId': 8 },
    { 'playCateId': 9 },
]


export default {
    // 获取秒速时时彩商品
    getCqsscZh_product_1_for_component: (cb) => cb(CqsscZh_product_1),
    getCqsscZh_product_2_for_component: (cb) => cb(CqsscZh_product_2),
    getCqsscZh_product_3_for_component: (cb) => cb(CqsscZh_product_3),


}
