<template>
    <td>
        <table class="u-table2">
            <!--{{info}}-->
            <Mspk10LmpProduct_2_title :info="info"></Mspk10LmpProduct_2_title>
            <!--<thead>-->
            <!--<tr>-->
                <!--<th colspan="3">第三球</th>-->
            <!--</tr>-->
            <!--</thead>-->
            <Mspk10LmpProduct_2_content :info="info"></Mspk10LmpProduct_2_content>
        </table>
    </td>
</template>

<script>
  import { mapGetters } from 'vuex'
    // 引入第二种商品名称和内容
    import Mspk10LmpProduct_2_title from './Mspk10LmpProduct_2_parts/Mspk10LmpProduct_2_title'
    import Mspk10LmpProduct_2_content from './Mspk10LmpProduct_2_parts/Mspk10LmpProduct_2_content'

    export default {
        name: "mspk10-lmp-product_2_1",
        props: {
            info: Object
        },
        components: {
            Mspk10LmpProduct_2_title,
            Mspk10LmpProduct_2_content,
        },
        computed: {
            ...mapGetters({
                Xykl8LmpTitle: 'getXykl8LmpPlays_196_title'
            })
        }
      // computed: {
      //   getXykl8Lmp_Product_1
      // }
    }
</script>

<style scoped>
    /*全局样式*/

    table {
        border-collapse: collapse;
        border-spacing: 0
    }


    input {
        font-family: '\5FAE\8F6F\96C5\9ED1'
    }

    input:disabled {
        border: 1px solid #ddd;
        background-color: #f5f5f5;
        color: #bebdbd
    }

    /*新加的结束*/

    /*与cont-sider有关的全局性样式*/

    /*与cont-sider有关的全局性样式结束*/

    /*skin_blue相关的全局性样式*/

    /*skin_blue相关的全局性样式结束*/

    /*全局样式结束 将顶部固定在了左上角*/

    /*skin_blue 样式 contMain*/

    /*skin_blue 样式 contMain 结束*/

    /*skin_blue 与 table有关的*/

    /*skin_blue 与table 有关的*/
    /*与中间有关的样式*/

    /*与中间有关的样式结束*/

    /*与中间右边有关的样式*/

    /*与中间右边有关的样式结束*/

    /*cont_main 相关样式*/


    .c-txt3 {
        color: red;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        padding: 0 4px
    }

    .cont-sider .u-table2 thead th {
        height: 30px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        border: none;
        font-size: 13px;
        letter-spacing: 1px
    }


    /*cont_main 相关样式结束*/

    /*与table有关的全局样式*/

    .u-table2 {
        width: 100%;
        text-align: center
    }

    .u-table2 th {
        font-weight: 700;
        height: 23px
    }

    .u-table2 thead th.select {
        background-position: 0 -59px
    }

    .u-table2 td {
        height: 28px;
        background: #fff;
        cursor: pointer
    }

    .u-table2 .name {
        width: 60px;
        min-width: 40px;
        font-weight: 700
    }

    .u-table2.sevenrow .name {
        width: auto;
        min-width: auto
    }

    .u-table2 .amount {
        width: 65px
    }

    .u-table2.sevenrow .amount {
        width: 60px
    }

    .u-table2 .amount > input {
        width: 80%;
        min-width: 40px;
        height: 15px;
        background: url(/static/game/images/skin/blue/text_input.gif) repeat-x left top;
        border: #b9c2cb 1px solid;
        padding: 0 2px
    }

    .u-table2 .odds {
        width: 50px;
        font-weight: 700
    }

    .u-table2 .qiu {
        text-align: left;
        padding-left: 10px
    }



    .u-table4 {
        width: 100%;
        table-layout: fixed;
        text-align: center
    }

    .u-table4 td {
        height: 28px;
        background: #fff
    }

    .cont-col3-box2 {
        text-align: center
    }

    .cont-col3-box2 span {
        margin-right: 6px;
        font-weight: 700;
        font-size: 13px
    }

    .u-header {
        height: 30px;
        border-radius: 4px;
        line-height: 30px;
        font-weight: 700;
        font-size: 13px
    }

    .u-table4 td.f1 {
        background-color: #fff
    }

    /*与table有关的全局样式*/

</style>
