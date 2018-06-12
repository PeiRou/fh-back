/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const PcddPcdd_product_1 = [
    { 'playCateId': 91 }
]

const PcddPcdd_product_2 = [
    { 'playCateId': 92 },
]

const PcddPcdd_product_3 = [
    { 'playCateId': 93 },
]


export default {
    // 获取秒速时时彩商品
    getPcddPcdd_product_1_for_component: (cb) => cb(PcddPcdd_product_1),
    getPcddPcdd_product_2_for_component: (cb) => cb(PcddPcdd_product_2),
    getPcddPcdd_product_3_for_component: (cb) => cb(PcddPcdd_product_3),


}
