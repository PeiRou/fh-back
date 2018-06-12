<template>
    <div class="cp-box1">
        <div>
            <table class="u-table2">
                <thead>
                <tr>
                    <th class="u-tb3-th2" style="width: 110px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">定单号</th>
                    <th class="u-tb3-th2" style="width: 100px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">时间</th>
                    <th class="u-tb3-th2" style="width: 180px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">类型</th>
                    <th class="u-tb3-th2" style="width: 220px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">玩法</th>
                    <th class="u-tb3-th2" style="height: 26px; font-size: 13px; color: rgb(118, 45, 8);">下注金额</th>
                    <th class="u-tb3-th2" style="height: 26px; font-size: 13px; color: rgb(118, 45, 8);">退水</th>
                    <th class="u-tb3-th2" style="width: 100px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);"><span id="column_desc">可赢金额</span></th>
                </tr>
                </thead>
                <tbody>
                <tr class="trcolor">
                    <td colspan="7">
                        <div>
                            暂无数据
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "header-top-bet-list-unsettled",
        created () {
            this.$store.dispatch('contSiderShowFalse')
        }
    }
</script>

<style scoped>
   table {
            border-collapse: collapse;
            border-spacing: 0
        }
        .u-table2 {
            width: 100%;
            text-align: center
        }
        .u-table2 td {
            height: 28px;
            background: #fff;
            cursor: pointer
        }
        .cp-box1 .u-table2 td,
        .cp-box2 .u-table2 td,
        .member-info .u-table2 td {
            font-size: 12px;
            font-weight: 400
        }
        .cp-box1 {
            padding: 10px;
            width: 880px
        }
</style>