/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const MssscZh_product_1 = [
    { 'playCateId': 123 }
]

const MssscZh_product_2 = [
    { 'playCateId': 124 },
    { 'playCateId': 125 },
    { 'playCateId': 126 },
    { 'playCateId': 127 },
    { 'playCateId': 128 }
]

const MssscZh_product_3 = [
    { 'playCateId': 129 },
    { 'playCateId': 130 },
    { 'playCateId': 131 },
]


export default {
    // 获取秒速时时彩商品
    getMssscZh_product_1_for_component: (cb) => cb(MssscZh_product_1),
    getMssscZh_product_2_for_component: (cb) => cb(MssscZh_product_2),
    getMssscZh_product_3_for_component: (cb) => cb(MssscZh_product_3),


}