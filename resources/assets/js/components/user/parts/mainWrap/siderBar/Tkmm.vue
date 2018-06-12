<template>
	<div class="content-wrap"style="left: 0;">
		<div class="content">
			<div class="sub-wrap clearfix">
				<div class="center-page">
					<div class="memberheader">
						<div class="useravatar floatleft"><img src="/static/images/skin/blue/userlogo.jpg" width="84" height="83" alt=""></div>
						<div class="memberinfo floatleft">
							<h1 class="floatleft">
                    晚上好, <span id="userName" class="blue">{{userName}}</span></h1>
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
							<p>最后登录：<span id="loginTime">2018-03-14 18:50:14</span></p>
						</div>
					</div>
					<div class="membersubnavi">
								<div class="subnavi blue">
									<router-link to="/frame/grzx">消息中心</router-link>
									<div class="subnaviarrow" style="display: none;"></div>
								</div>
								<div class="subnavi blue">
									<router-link to="/frame/mmsz">密码设置</router-link>
									<div class="subnaviarrow" style="display: none;"></div>
								</div>
								<div class="subnavi blue">
									<router-link to="/frame/tkmm">提款密码</router-link>
									<div class="subnaviarrow" style=""></div>
								</div>
					</div>
					<div class="subcontent1 margintop20">
						<form class="el-form formpanel margintop20">
							<!---->
							<div class="el-form-item wd-row is-required">
								<!---->
								<div class="el-form-item__content">
									<div class="wd-col1">当前提款密码：</div>
									<div class="wd-col2"><input type="password" class="textfield1"></div>
									<!---->
								</div>
							</div>
							<div class="el-form-item wd-row is-required">
								<!---->
								<div class="el-form-item__content">
									<div class="wd-col1">提款密码：</div>
									<div class="wd-col2"><input type="password" class="textfield1"></div>
									<!---->
								</div>
							</div>
							<div class="el-form-item wd-row is-required">
								<!---->
								<div class="el-form-item__content">
									<div class="wd-col1">重复密码：</div>
									<div class="wd-col2"><input type="password" class="textfield1"></div>
									<!---->
								</div>
							</div>
							<div class="wd-row" style="text-align: center;">
								<div><input type="submit" value="提交" class="c-button"></div>
							</div>
						</form>
					</div>
				</div>
				<div class="cont-sider">
					<!---->
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        created() {
            this.$store.dispatch('contSiderShowFalse')
        },
        computed: {
            ...mapGetters({
                userName: 'getUserName',
                money: 'getMoney'
            })

        }
    }
</script>

<style>
	.center-page .margintop5 {
		margin-top: 5px
	}
	
	.center-page .margintop7 {
		margin-top: 7px
	}
	
	.center-page .margintop8 {
		margin-top: 8px
	}
	
	.center-page .margintop10 {
		margin-top: 10px
	}
	
	.center-page .margintop15 {
		margin-top: 15px
	}
	
	.center-page .margintop20 {
		margin-top: 20px
	}
	
	.center-page .margintop25 {
		margin-top: 25px
	}
	
	.center-page .margintop30 {
		margin-top: 30px
	}
	
	.center-page .margintop35 {
		margin-top: 35px
	}
	
	.center-page .margintop40 {
		margin-top: 40px
	}
	
	.center-page .margintop50 {
		margin-top: 50px
	}
	
	.center-page .alignleft {
		text-align: left
	}
	
	.center-page .alignright {
		text-align: right
	}
	
	.center-page .aligncenter {
		text-align: center
	}
	
	.center-page .floatleft {
		float: left
	}
	
	.center-page .floatright {
		float: right
	}
	
	.center-page .blue {
		color: #217eec
	}
	
	.center-page .red {
		color: #ff9797
	}
	
	.center-page .gray {
		color: #a2a2a2
	}
	
	.center-page .smalltxt {
		font-size: 12px
	}
	
	.center-page .bigtxt {
		font-size: 24px
	}
	
	.center-page .pointer {
		cursor: pointer
	}
	
	.center-page .gap5 {
		height: 10px;
		width: 100%;
		overflow: hidden
	}
	
	.wrap-main {
		padding: 0;
		margin: 0
	}
	
	.wrap-header {
		border-bottom: 1px solid #cdcdcd;
		padding: 20px 0 10px 10px;
		font-size: 18px;
		background-color: #fde6eb
	}
	
	.wrap-title {
		border-bottom: 1px solid #cdcdcd;
		padding: 20px 0 10px 20px;
		font-size: 18px;
		color: #313131
	}
	
	.wrap-body {
		padding: 20px
	}
	
	.wrap-main .info label {
		margin-right: 20px;
		color: #892122
	}
	
	.wrap-main .form-ul {
		width: 96%;
		margin: 0 auto
	}
	
	.wrap-main .form-ul li {
		font-size: 16px;
		line-height: 30px;
		color: #898989;
		margin: 0 0 18px 0;
		overflow: hidden
	}
	
	.wrap-main .form-ul span {
		display: block;
		width: 140px;
		font-size: 18px;
		color: #313131;
		text-align: right;
		float: left
	}
	
	.wrap-main input,
	.wrap-main select {
		border: 1px solid #b8b8b8;
		margin: 0 15px 0 0;
		float: left;
		width: 300px;
		height: 30px;
		font-size: 16px;
		line-height: 30px;
		text-indent: 5px
	}
	
	.wrap-main .w-small {
		width: 60px
	}
	
	.center-page .memberheader {
		height: 140px;
		border-bottom: 1px solid #cdcdcd;
		position: relative
	}
	
	.center-page .useravatar {
		width: 84px;
		height: 83px;
		margin: 25px 0 0 25px;
		float: left
	}
	
	.center-page .memberinfo {
		margin: 22px 0 0 15px;
		width: 475px;
		float: left
	}
	
	.center-page .memberinfo h1 {
		font-weight: 400;
		margin: 0;
		font-size: 28px
	}
	
	.center-page .memberinfo p {
		font-size: 12px
	}
	
	.center-page .balancevalue {
		margin: 6px 0 0 40px
	}
	
	.center-page .membersubnavi {
		position: absolute;
		top: 92px;
		right: 0
	}
	
	.center-page .subnavi {
		padding: 0 20px;
		float: left;
		font-size: 17px;
		color: #217eec
	}
	
	.center-page .subnavi a {
		color: #777f89
	}
	
	.center-page .subnaviarrow {
		margin-top: 5px;
		background-image: url(/static/images/subnaviarrow.jpg);
		background-position: top center;
		height: 20px;
		background-repeat: no-repeat
	}
	
	.center-page .records table {
		width: 100%;
		border-collapse: collapse!important
	}
	
	.center-page .records table th {
		padding: 10px 0;
		font-weight: lighter;
		border: 1px solid #777f89;
		background-color: #777f89;
		color: #fff
	}
	
	.center-page .records table td {
		font-size: 12px;
		color: #777f89;
		text-align: center;
		padding: 10px 10px
	}
	
	.center-page .records table td a {
		color: #0b8fff;
		margin-left: 19px;
	}
	
	.center-page .records table td a:hover {
		text-decoration: underline
	}
	
	.new_user_notice_msg {
		height: 11px;
		width: 27px;
		background-image: url(/static/game/static/images/msg_new2.png);
		background-repeat: no-repeat;
		display: inline-block;
		font-style: normal;
		float: right;
		margin: 3px 12px 0 27px;
		position: absolute;
		overflow: hidden;
		vertical-align: middle;
	}
	
	.center-page .trcolor {
		background-color: #f0f0f1
	}
	
	.center-page .search-bar {
		margin-top: 10px;
		padding: 10px 5px
	}
	
	.jc-info {
		border-radius: 3px;
		border: 1px solid #b9b9b9;
		overflow: visible;
		margin-top: 34px;
		height: 82px
	}
	
	.green {
		color: #66c75c
	}
	
	.copy {
		color: #217eec;
		cursor: pointer
	}
	
	.bank-info img {
		margin-top: 20px;
		margin-left: 20px
	}
	
	.col-left .table tr {
		height: 35px
	}
	
	.col-left .table .trs {
		height: 30px
	}
	
	.button:focus {
		outline: 0 none
	}
	
	.hide {
		display: none
	}
	
	.corg {
		color: #f60
	}
	
	.el-pager,
	.el-pager li {
		vertical-align: top;
		display: inline-block;
		margin: 0
	}
	
	.el-pager {
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		list-style: none;
		font-size: 0;
		padding: 0
	}
	
	.el-pager li {
		padding: 0 4px;
		border: 1px solid #d1dbe5;
		border-right: 0;
		background: #fff;
		font-size: 13px;
		min-width: 28px;
		height: 28px;
		line-height: 28px;
		box-sizing: border-box;
		text-align: center
	}
	
	.el-pager li:last-child {
		border-right: 1px solid #d1dbe5
	}
	
	.el-pager li.btn-quicknext,
	.el-pager li.btn-quickprev {
		line-height: 28px;
		color: #97a8be
	}
	
	.el-pager li.active+li {
		border-left: 0;
		padding-left: 5px
	}
	
	.el-pager li:hover {
		color: #20a0ff
	}
	
	.el-pager li.active {
		border-color: #20a0ff;
		background-color: #20a0ff;
		color: #fff;
		cursor: default
	}
	/*这个是后面补加的css*/
	
	.center-page .records table th {
		padding: 10px 0;
		font-weight: lighter;
		border: 1px solid #777f89;
		background-color: #777f89;
		color: #fff;
		font-size: 12px;
	}
	
	a {
		text-decoration: none;
	}
	
	.center-page .c-button {
		width: 122px;
		height: 36px;
		font-size: 14px;
		line-height: 35px;
		text-align: center;
		background-color: #eda220;
		border: medium none;
		border-radius: 2px;
		color: #fff;
		font-family: inherit;
		padding: 0 16px;
		text-decoration: none;
		cursor: pointer;
		margin-top: 20px;
	}
	
	.center-page .formpanel {
		width: 365px;
		margin: 0 auto;
	}
	
	.center-page .margintop20 {
		margin-top: 20px;
	}
	
	.center-page .wd-col1 {
		padding-top: 4px;
		float: left;
		width: 110px;
		min-height: 10px;
		text-align: right;
	}
	
	.formpanel div {
		overflow: visible;
	}
	
	input {
		margin-top: 10px;
		width: 172px;
		height: 26px;
		line-height: 26px;
		margin-left: 5px;
	}
	
	.el-form-item__content {
		line-height: 36px;
		position: relative;
		font-size: 14px;
	}
	
	.center-page .wd-col1 {
		padding-top: 6px;
		float: left;
		width: 110px;
		min-height: 10px;
		text-align: right;
	}
</style>