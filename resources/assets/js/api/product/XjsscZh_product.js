/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const XjsscZh_product_1 = [
    { 'playCateId': 94 }
]

const XjsscZh_product_2 = [
    { 'playCateId': 95 },
    { 'playCateId': 96 },
    { 'playCateId': 97 },
    { 'playCateId': 98 },
    { 'playCateId': 99 }
]

const XjsscZh_product_3 = [
    { 'playCateId': 100 },
    { 'playCateId': 101 },
    { 'playCateId': 102 },
]


export default {
    // 获取秒速时时彩商品
    getXjsscZh_product_1_for_component: (cb) => cb(XjsscZh_product_1),
    getXjsscZh_product_2_for_component: (cb) => cb(XjsscZh_product_2),
    getXjsscZh_product_3_for_component: (cb) => cb(XjsscZh_product_3),


}
