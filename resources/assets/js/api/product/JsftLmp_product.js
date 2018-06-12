/**
 * Mocking products goods 不同的商品应该放在不同的数组里面,Mspk10Lmp页面有两种商品组件,所以这里准备两个商品数组.这个数组是我们自己手动添加的
 */

const JsftLmp_product_1 = [
    { 'playCateId': 132 }
]

const JsftLmp_product_2_1 = [
    { 'playCateId': 133 },
    { 'playCateId': 134 },
    { 'playCateId': 135 },
    { 'playCateId': 136 },
    { 'playCateId': 137 }
]

const JsftLmp_product_2_2 = [
    { 'playCateId': 138 },
    { 'playCateId': 139 },
    { 'playCateId': 140 },
    { 'playCateId': 141 },
    { 'playCateId': 142 },
]



export default {
    // 获取秒速飞艇商品


    getJsftLmpProduct_1_for_component: (cb) => cb(JsftLmp_product_1),
    getJsftLmpProduct_2_1_for_component: (cb) => cb(JsftLmp_product_2_1),
    getJsftLmpProduct_2_2_for_component: (cb) => cb(JsftLmp_product_2_2),
    //



}