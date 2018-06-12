/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const Xykl8Lmp_product_1 = [
    { 'playCateId': 155 }
]

const Xykl8Lmp_product_2 = [
    { 'playCateId': 156 }
]

const Xykl8Lmp_product_3 = [
    { 'playCateId': 157 }
]

const Xykl8Lmp_product_4 = [
    { 'playCateId': 158 }
]


export default {
    // 获取秒速时时彩商品
    getXykl8Lmp_product_1_for_component: (cb) => cb(Xykl8Lmp_product_1),
    getXykl8Lmp_product_2_for_component: (cb) => cb(Xykl8Lmp_product_2),
    getXykl8Lmp_product_3_for_component: (cb) => cb(Xykl8Lmp_product_3),
    getXykl8Lmp_product_4_for_component: (cb) => cb(Xykl8Lmp_product_4),
}
