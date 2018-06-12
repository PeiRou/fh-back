<template>
    <div class="cp-box1 center-page">
        <div class="search-bar">
            <ul>
                <li class="marginleft10">起止日期：</li>
                <li>
                    <el-date-picker
      v-model="value13"
      type="daterange"
      size='mini'
      start-placeholder="开始日期"
      end-placeholder="结束日期"
      :default-time="['00:00:00', '23:59:59']">
    </el-date-picker>
                </li>
                <li><button type="button" class="btn">查询</button></li>
            </ul>
        </div>
        <table id="preWeekTable" class="u-table2 play_tab_10">
            <thead>
            <tr>
                <th width="16%">日期</th>
                <th width="16%">注数</th>
                <th width="16%">下注金额</th>
                <th width="16%">返水</th>
                <th width="16%">盈亏</th>
                <th width="">查看注单</th>
            </tr>
            </thead>
            <tbody>
            <tr class="trcolor">
                <td colspan="6">
                    <div>
                        暂无数据
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="page_info">
            <div class="megas512" style="text-align: center; margin-top: 15px;">
                <div class="el-pagination el-pagination--small"><button type="button" class="btn-prev disabled"><i class="el-icon el-icon-arrow-left"></i></button>
                    <ul class="el-pager">
                    </ul><button type="button" class="btn-next disabled"><i class="el-icon el-icon-arrow-right"></i></button></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      value13: ""
    };
  }
};
</script>

<style scoped>
.el-date-editor--daterange.el-input__inner {
  width: 200px;
  height: 28px;
  border-radius: 0;
}
ul,
li {
  list-style: none;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
}
[class*=" el-icon-"],
[class^="el-icon-"] {
  font-family: element-icons !important;
  font-style: normal;
  font-weight: 400;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  vertical-align: baseline;
  display: inline-block;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.u-table2 {
  width: 100%;
  text-align: center;
}
.u-table2 td {
  height: 28px;
  background: #fff;
  cursor: pointer;
}
.cp-box1 .u-table2 td,
.cp-box2 .u-table2 td,
.member-info .u-table2 td {
  font-size: 12px;
  font-weight: 400;
}
.cp-box1 {
  padding: 10px;
  width: 880px;
}
.center-page .search-bar {
  margin-top: 10px;
  padding: 10px 5px;
}
.center-page .search-bar li {
  float: left;
  margin-right: 5px;
  color: #787878;
  line-height: 26px;
}
.center-page .marginleft10 {
  margin-left: 10px;
}
.el-date-editor--daterange.el-input {
  width: 220px;
}
.el-input__icon {
  position: absolute;
  width: 35px;
  height: 100%;
  right: 0;
  top: 0;
  text-align: center;
  color: #bfcbd9;
  transition: all 0.3s;
}

.center-page .search-bar {
  margin-top: 10px;
  padding: 10px 5px;
  overflow: hidden;
}

.center-page .search-bar input {
  padding: 0 5px;
  height: 26px;
  line-height: 26px;
  border: 1px solid #ccc;
  border-width: 1px;
  border-radius: 2px;
  box-shadow: 0 1px 2px 0 #e8e8e8 inset;
}
.center-page .search-bar .btn {
  font-size: 14px;
  text-align: center;
  background-color: #777f89;
  border: medium none;
  border-radius: 2px;
  color: #fff;
  font-family: inherit;
  padding: 0 10px;
  text-decoration: none;
  height: 26px;
  cursor: pointer;
  margin-top: 1px;
}
</style>