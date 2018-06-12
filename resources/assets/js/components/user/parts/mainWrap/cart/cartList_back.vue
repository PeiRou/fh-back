<template>
    <div class="el-dialog__wrapper">
        <!--test for element ui 结算页面-->
        <!-- Table -->
        <el-button type="text" @click="empty()">打开嵌套表格的 Dialog</el-button>

        <el-dialog title="下注明细（请确认注单）" :visible.sync="dialogTableVisible" :width="500">
            <el-table :data="gridData" style="top:15%">
                <el-table-column property="date" label="号码"></el-table-column>
                <el-table-column property="name" label="赔率"></el-table-column>
                <el-table-column property="address" label="金额"></el-table-column>
                <el-table-column property="address" label="确认"></el-table-column>
            </el-table>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "cart-list"
    }
</script>

<style scoped>

</style>