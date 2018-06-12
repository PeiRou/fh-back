/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const Jsk3Dxtb_product_1 = [
    { 'playCateId': 35 }
]

const Jsk3Dxtb_product_2 = [
    { 'playCateId': 36 },
]

const Jsk3Dxtb_product_3 = [
    { 'playCateId': 37 },
]

const Jsk3Dxtb_product_4 = [
    { 'playCateId': 38 },
]

const Jsk3Dxtb_product_5 = [
    { 'playCateId': 39 },
]

const Jsk3Dxtb_product_6 = [
    { 'playCateId': 40 },
]

const Jsk3Dxtb_product_7 = [
    { 'playCateId': 41 },
]


export default {
    // 获取江苏骰宝商品
    getJsk3Dxtb_product_1_for_component: (cb) => cb(Jsk3Dxtb_product_1),
    getJsk3Dxtb_product_2_for_component: (cb) => cb(Jsk3Dxtb_product_2),
    getJsk3Dxtb_product_3_for_component: (cb) => cb(Jsk3Dxtb_product_3),
    getJsk3Dxtb_product_4_for_component: (cb) => cb(Jsk3Dxtb_product_4),
    getJsk3Dxtb_product_5_for_component: (cb) => cb(Jsk3Dxtb_product_5),
    getJsk3Dxtb_product_6_for_component: (cb) => cb(Jsk3Dxtb_product_6),
    getJsk3Dxtb_product_7_for_component: (cb) => cb(Jsk3Dxtb_product_7),


}
