<template>
    <div>
        <div>
            <div class="cont-col3-bd">
                <!--{{info.product_1}}-->
                <XyddXyddProduct_3 v-for="(item,index) in info.product_2_2" :info="{ productId: item, productInfo: info}" :key="index"></XyddXyddProduct_3>
            </div>
        </div>
    </div>
</template>

<script>
    // 引入第一种商品
    import Mspk10LmpProduct_1 from './XyddXyddProduct_1/Mspk10LmpProduct_1'
    // 引入第二种商品
    import Mspk10LmpProduct_2 from './XyddXyddProduct_2/Mspk10LmpProduct_1'
    // 引入第三种商品
    import XyddXyddProduct_3 from './Xykl8ZmProduct_1/Mspk10LmpProduct_1'
    export default {
        name: "mspk10-lmp-product",
        props: {
            info: Object
        },
        components: {
            Mspk10LmpProduct_1,
            Mspk10LmpProduct_2,
            XyddXyddProduct_3
        }
    }
</script>

<style scoped>
    /* 表格之间的空间*/
    .cont-list1 {
        margin-top: 10px;
        width: 100%
    }
    /* 表格之间的空间结束　*/
</style>