/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const GdklsfLmp_product_1 = [
    { 'playCateId': 74 }
]

const GdklsfLmp_product_2 = [
    { 'playCateId': 75 },
    { 'playCateId': 76 },
    { 'playCateId': 77 },
    { 'playCateId': 78 },
    { 'playCateId': 79 },
    { 'playCateId': 80 },
    { 'playCateId': 81 },
    { 'playCateId': 82 },
]

const GdklsfLmp_product_3 = [
    { 'playCateId': 83 },
]

//　由于这里的第二种商品和第四种商品是一样的，广东11选5，广东11选5 两面用的是　字　单号用的是　数字　code



export default {
    // 获取广东11选5商品
    getGdklsfLmp_product_1_for_component: (cb) => cb(GdklsfLmp_product_1),
    getGdklsfLmp_product_2_for_component: (cb) => cb(GdklsfLmp_product_2),
    getGdklsfLmp_product_3_for_component: (cb) => cb(GdklsfLmp_product_3),
    // getGd11x5Lm_product_4_for_component: (cb) => cb(Gd11x5Lm_product_4),


}