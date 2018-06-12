<template>
	<div class="center-page">
		<div class="memberheader">
			<div class="useravatar floatleft"><img src="/static/images/skin/blue/userlogo.jpg" width="84" height="83" alt=""></div>
			<div class="memberinfo floatleft">
				<h1 class="floatleft">
                    {{NowTime}}, <span id="userName" class="blue">{{userName}}</span></h1>
				<div class="balance floatleft">
					<div class="balancevalue floatleft">
						中心钱包 : <span class="blue"><span class="balanceCount">{{money}}</span> 元</span>
					</div>
					<div class="floatright margintop7 marginright10 marginleft5 pointer">
						<a href="javascript:;"><img src="/static/images/skin/blue/btnrefresh.jpg" width="16" height="17" alt=""></a>
					</div>
				</div>
				<div class="gap5"></div>
				<p>彩票网投领导者·实力铸就品牌·诚信打造一切·相信品牌的力量</p>
				<p>最后登录：<span id="loginTime">2018-03-14 11:23:12</span></p>
			</div>
		</div>
		<div class="membersubnavi">
			<div class="subnavi blue">
				<router-link to="/frame/zxcz" class="active">充值</router-link>
				<div class="subnaviarrow" style="display: none;"></div>
			</div>
			<div class="subnavi blue">
				<router-link to="/frame/tk" class="active">提款</router-link>
				<div class="subnaviarrow" style="display: none;"></div>
			</div>
			<div class="subnavi blue">
				<router-link to="/financial" class="active">充值记录</router-link>
				<div class="subnaviarrow" style="display: none;"></div>
			</div>
			<div class="subnavi blue">
				<router-link to="/frame/tkjl" class="active">提款记录</router-link>
				<div class="subnaviarrow" style="display: none;"></div>
			</div>
			<div class="subnavi blue">
				<router-link to="/frame/other" class="active">其它记录</router-link>
				<div class="subnaviarrow" style=""></div>
			</div>
		</div>
		<div>
			<div class="search-bar">
				<ul>
					<li>类型：</li>
					<li>
						<select class="province floatleft  select1">
							<option value="" selected="selected">红包</option>
						</select>
					</li>
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
					<li><button type="button" class="btn">搜索</button></li>
				</ul>
			</div>
			<div class="records">
				<table class="table">
					<thead>
						<tr class="trcolor">
							<th style="width: 10%;">时间</th>
							<th style="width: 6%;">红包金额</th>
							<th style="width: 6%;">发起人</th>
							<th style="width: 12%;">状态</th>
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
			<div class="page_info">
				<div class="megas512" style="text-align: center; margin-top: 15px;">
					<div class="el-pagination el-pagination--small"><button type="button" class="btn-prev disabled"><i class="el-icon el-icon-arrow-left"></i></button>
						<ul class="el-pager">
							<!---->
							<!---->
							<!---->
							<!---->
						</ul><button type="button" class="btn-next disabled"><i class="el-icon el-icon-arrow-right"></i></button></div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
			value13: "",
			NowTime : ''
    };
  },
  created() {
		this.$store.dispatch("contSiderShowFalse");
		 let now = new Date();
    let hour = now.getHours();
    if (hour < 6) {
      this.NowTime = "凌晨好";
    } else if (hour < 9) {
      this.NowTime = "早上好";
    } else if (hour < 12) {
      this.NowTime = "上午好";
    } else if (hour < 14) {
      this.NowTime = "中午好";
    } else if (hour < 17) {
      this.NowTime = "下午好";
    } else if (hour < 19) {
      this.NowTime = "傍晚好";
    } else if (hour < 22) {
      this.NowTime = "晚上好";
    } else {
      this.NowTime = "夜里好";
    }
  },
  computed: {
    ...mapGetters({
      userName: "getUserName",
      money: "getMoney"
    })
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

.center-page .memberheader {
  height: 140px;
  border-bottom: 1px solid #cdcdcd;
  position: relative;
}

.center-page .floatleft {
  float: left;
}

.center-page .useravatar {
  width: 84px;
  height: 83px;
  margin: 25px 0 0 25px;
  float: left;
}

.center-page .memberinfo {
  margin: 22px 0 0 15px;
  width: 475px;
  float: left;
}

.center-page .memberinfo h1 {
  font-weight: 400;
  margin: 0;
  font-size: 28px;
}

.center-page .balancevalue {
  margin: 6px 0 0 40px;
}

.center-page .pointer {
  cursor: pointer;
}

.center-page .floatright {
  float: right;
}

.center-page .gap5 {
  height: 10px;
  width: 100%;
  overflow: hidden;
}

.center-page .marginright10 {
  margin-right: 10px;
}

.center-page .marginleft5 {
  margin-left: 5px;
}

.center-page .margintop7 {
  margin-top: 7px;
}

.center-page .memberinfo p {
  font-size: 12px;
}

.center-page .blue {
  color: #217eec;
}
/* 选项 */

.center-page .membersubnavi {
  position: absolute;
  top: 92px;
  right: 0;
}

.center-page .subnavi {
  padding: 0 20px;
  float: left;
  font-size: 17px;
  color: #217eec;
}

.center-page .subnavi a {
  color: #777f89;
}

.center-page .subnaviarrow {
  margin-top: 5px;
  background-image: url("/static/game/images/subnaviarrow.jpg");
  background-position: top center;
  height: 20px;
  background-repeat: no-repeat;
}

.center-page .search-bar {
  margin-top: 10px;
  padding: 10px 5px;
  overflow: hidden;
}

.center-page .search-bar li {
  float: left;
  margin-right: 5px;
  color: #787878;
  line-height: 26px;
}

.center-page .search-bar select {
  height: 26px;
  padding: 0 5px;
  -webkit-padding-end: 20px;
  border: 1px solid #ccc;
  color: #999;
  border-radius: 2px;
  box-shadow: 0 1px 2px 0 #e8e8e8 inset;
  -webkit-appearance: none;
  background: url("/static/game/images/dropdown_logo_2.png") no-repeat right
    #fff;
}

.el-date-editor--daterange.el-input {
  width: 220px;
}

.el-input {
  position: relative;
  font-size: 14px;
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

.center-page .search-bar input {
  padding: 0 5px;
  height: 34px;
  line-height: 34px;
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
  height: 28px;
  cursor: pointer;
  margin-left: 16px;
}

.center-page .records {
  padding: 0 5px;
}

.center-page .records table {
  width: 100%;
  border-collapse: collapse !important;
}

.center-page .trcolor {
  background-color: #f0f0f1;
}

.center-page .records table th {
  padding: 10px 0;
  font-weight: lighter;
  border: 1px solid #777f89;
  background-color: #777f89;
  color: #fff;
}

.center-page .trcolor {
  background-color: #f0f0f1;
}

.center-page .records table tr td:first-child,
.center-page .records table tr th:first-child {
  width: 40px;
}

.center-page .records table td {
  font-size: 12px;
  color: #777f89;
  text-align: center;
  padding: 10px 10px;
}

.center-page .records table td a {
  color: #0b8fff;
}

.el-pagination {
  white-space: nowrap;
  padding: 2px 5px;
  color: #48576a;
}

.el-pagination button.disabled {
  color: #e4e4e4;
  background-color: #fff;
  cursor: not-allowed;
}

.el-pagination .btn-next .el-icon,
.el-pagination .btn-prev .el-icon {
  display: block;
  font-size: 12px;
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

.el-pager li.active {
  border-color: #20a0ff;
  background-color: #20a0ff;
  color: #fff;
  cursor: default;
}

.el-pagination--small .el-pager li {
  border-radius: 2px;
}
</style>