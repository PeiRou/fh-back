/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const Bjkl8Lmp_product_1 = [
    { 'playCateId': 21 }
]

const Bjkl8Lmp_product_2 = [
    { 'playCateId': 22 }
]

const Bjkl8Lmp_product_3 = [
    { 'playCateId': 23 }
]

const Bjkl8Lmp_product_4 = [
    { 'playCateId': 24 }
]

const Bjkl8Lmp_product_5 = [
    { 'playCateId': 25 }
]


export default {
    // 获取秒速时时彩商品
    getBjkl8Lmp_product_1_for_component: (cb) => cb(Bjkl8Lmp_product_1),
    getBjkl8Lmp_product_2_for_component: (cb) => cb(Bjkl8Lmp_product_2),
    getBjkl8Lmp_product_3_for_component: (cb) => cb(Bjkl8Lmp_product_3),
    getBjkl8Lmp_product_4_for_component: (cb) => cb(Bjkl8Lmp_product_4),
    getBjkl8Lmp_product_5_for_component: (cb) => cb(Bjkl8Lmp_product_5),
}
