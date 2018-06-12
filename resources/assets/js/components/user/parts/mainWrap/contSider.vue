<template>
    <div class="cont-sider">
        <div class="sider-box1 mt5">
            <table class="u-table2">
                <thead>
                <tr>
                    <th id="stat_play_list_desc">长龙排行榜</th>
                </tr>
                </thead>
            </table>
            <table class="u-table5">
                <tbody id="stat_play_list">
                <tr class="u-tb5-tr1">
                    <th>冠、亚军和 - 冠亚小</th>
                    <td class="statFont">5期</td>
                </tr>
                <tr class="u-tb5-tr2">
                    <th>亚军 - 小</th>
                    <td class="statFont">5期</td>
                </tr>
                <tr class="u-tb5-tr1">
                    <th>第五名 - 双</th>
                    <td class="statFont">4期</td>
                </tr>
                <tr class="u-tb5-tr2">
                    <th>冠军 - 虎</th>
                    <td class="statFont">3期</td>
                </tr>
                <tr class="u-tb5-tr1">
                    <th>第四名 - 单</th>
                    <td class="statFont">3期</td>
                </tr>
                <tr class="u-tb5-tr2">
                    <th>第七名 - 单</th>
                    <td class="statFont">3期</td>
                </tr>
                <tr class="u-tb5-tr1">
                    <th>第八名 - 双</th>
                    <td class="statFont">3期</td>
                </tr>
                <tr class="u-tb5-tr2">
                    <th>第十名 - 大</th>
                    <td class="statFont">3期</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "cont-sider"
    }
</script>

<style scoped>
    /*全局样式*/
    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
    }

    .main-body {
        position: absolute;
        overflow-x: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 30px;
    }

    .clearfix:after {
        content: "";
        height: 0;
        visibility: hidden;
        display: block;
        clear: both;
    }

    .clearfix {
        zoom: 1
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    .show{
        display: block;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0
    }

    /*与cont-sider有关的全局性样式*/



    /*与cont-sider有关的全局性样式结束*/

    /*skin_blue相关的全局性样式*/
    .skin_blue .u-table2 .hover {
        background: none repeat 0 0 #c3d9f1;
    }
    .skin_blue .u-table5 td,
    .skin_blue .u-table5 th {
        border: solid 1px #b9c2cb;
    }
    .skin_blue .u-tb5-tr1 {
        background: #fff;
    }
    .skin_blue .nowrap2 {
        border: solid 1px #f4521b;
        background: #ff9461;
        background: -moz-linear-gradient(top, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
        background: linear-gradient(to bottom, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%)
    }
    .skin_blue .u-table2 th {
        color: #4F4D4D;
        border: solid 1px #b9c2cb;
        background-color: #edf4fe;
    }

    .skin_blue .cont-sider thead th {
        background: #2161b3;
        color: #fff;
    }


    /*skin_blue相关的全局性样式结束*/

    /*全局样式结束 将顶部固定在了左上角*/

    /*skin_blue 样式 sidebar*/
    .skin_blue .cont-sider thead th {
        background: #2161b3;
        color: #fff;
    }


    /*skin_blue 样式 siderbar 结束*/

    /*与中间有关的样式*/


    /*与中间有关的样式结束*/

    /*与中间右边有关的样式*/
    .content-wrap {
        min-width: 1038px;
        overflow: hidden;
        font-size: 12px;
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        overflow-y: auto;
        left: 201px;
    }



    /*与中间右边有关的样式结束*/


    /*cont_sider 相关样式*/
    .cont-sider {
        float: left;
        width: 180px;
    }
    .cont-sider .u-table2 thead th {
        height: 30px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        border: none;
        font-size: 13px;
        letter-spacing: 1px;
    }


    /*cont_sider 相关样式结束*/

    /*与table有关的全局样式*/
    .u-table2 {
        width: 100%;
        text-align: center;
    }
    .u-table2 th {
        font-weight: 700;
        height: 23px;
    }
    .u-table2 thead th.select {
        background-position: 0 -59px;
    }
    .u-table2 td {
        height: 28px;
        background: #fff;
        cursor: pointer;
    }

    .u-table2 .name {
        width: 60px;
        min-width: 40px;
        font-weight: 700;
    }
    .u-table2.sevenrow .name{
        width: auto;
        min-width: auto;
    }
    .u-table2 .amount {
        width: 65px;
    }
    .u-table2.sevenrow .amount {
        width: 60px;
    }
    .u-table2 .odds {
        width: 50px;
        font-weight: 700;
    }
    .u-table5 {
        width: 100%;
    }
    .u-table5 .statFont {
        color: red;
    }
    .u-table5 td,
    .u-table5 th {
        height: 23px;
        padding: 0 5px;
        text-align: left;
        font-size: 12px;
        border: solid 1px #daa4a3;
        font-weight: 400;
        color: #4f4d4d;

    }

    .mt5 {
        margin-top: 4px;
    }

    /*与table有关的全局样式*/
</style>