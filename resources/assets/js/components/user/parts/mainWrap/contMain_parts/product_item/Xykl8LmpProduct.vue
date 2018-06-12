<template>
    <div>

        <!--{{Xykl8LmpPlays_filtered}}-->

        <div>
            <div>
                <table class="cont-list1">
                    <tbody>
                    <tr>
                        <Xykl8LmpProduct_2 v-for="(value, index) in Xykl8LmpPlays_filtered_0_5" :info="value" :key="index"></Xykl8LmpProduct_2>

                    </tr>
                    </tbody>
                </table>
                <table class="cont-list1">
                    <tbody>
                    <tr>
                        <Xykl8LmpProduct_2 v-for="(value, index) in Xykl8LmpPlays_filtered_6_10" :info="value" :key="index"></Xykl8LmpProduct_2>
                    </tr>
                    </tbody>
                </table>
                <table class="cont-list1">
                    <tbody>
                    <tr>
                        <Xykl8LmpProduct_2 v-for="(value, index) in Xykl8LmpPlays_filtered_11_15" :info="value" :key="index"></Xykl8LmpProduct_2>
                    </tr>
                    </tbody>
                </table>
                <table class="cont-list1">
                    <tbody>
                    <tr>
                        <Xykl8LmpProduct_2 v-for="(value, index) in Xykl8LmpPlays_filtered_16_20" :info="value" :key="index"></Xykl8LmpProduct_2>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    //　引入第一种商品
    //　引入第二种商品
    import Xykl8LmpProduct_2 from './Xykl8LmpProduct_1/Mspk10LmpProduct_2'
    export default {
        name: "mspk10-lmp-product",
      computed: {
        ...mapGetters({
          // Xykl8LmpProduct_1: 'getXykl8Lmp_Product_1',
            Xykl8LmpPlays_title: 'getXykl8LmpPlays_196_title',
            Xykl8LmpPlays_content_name: 'getXykl8LmpPlays_196_content_name',
            Xykl8LmpPlays_filtered: 'getXykl8LmpPlays_196_filtered',
            // Xykl8LmpPlays_filtered_0_5: 'getXykl8LmpPlays_196_filtered_0_5'
        }),
          Xykl8LmpPlays_filtered_0_5: function () {
            return this.Xykl8LmpPlays_filtered.slice(0,5)
          },
          Xykl8LmpPlays_filtered_6_10: function () {
            return this.Xykl8LmpPlays_filtered.slice(5,10)
          },
          Xykl8LmpPlays_filtered_11_15: function () {
              return this.Xykl8LmpPlays_filtered.slice(10,15)
          },
          Xykl8LmpPlays_filtered_16_20: function () {
              return this.Xykl8LmpPlays_filtered.slice(15,20)
          }

      },
        props: {
            info: Object
        },
        components: {
            Xykl8LmpProduct_2
        },
        created() {
            this.$store.dispatch('setXykl8LmpPlays_196_title')
        }
        // 由于这里的名字的问题,我们将相关的title放入state中,通过商品的playCateId,处理幸运快乐8的数据,主要是 title的数据, 例如"第1球-大" 然后放入state中

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
