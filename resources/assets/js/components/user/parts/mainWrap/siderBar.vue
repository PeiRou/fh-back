<template>
	<div class="siderbar">
		<div class="side_left userctrl">
			<ul>
				<li>
					<div class="r-wrap r-nowrap1">账户信息</div>
					<div class="info">
						<div><label>账号：</label><span id="userinfo_name">{{userNameComputed}}</span></div>
						<div><label>账号余额：</label><span class="balance">{{moneyComputed}}</span></div>
						<div><label>未结金额：</label><span class="betting">{{bettingTotalComputed}}</span>
							<a href="javascript:void(0)" title="点击刷新消息"><img alt="点击刷新消息" src="/static/game/static/images/refresh.png" width="18" height="18" title="点击刷新消息"></a>
						</div>
					</div>
				</li>
				<!---->
				<!---->
				<li class="r-wrap r-nowrap1">
					<a href="javascript:;" target="_blank">开奖直播</a>
				</li>
				<li class="r-wrap r-nowrap1">
					<a href="javascript:;" target="_blank">手机APP下载</a>
				</li>
				<li class="r-wrap ">
					<div class="nowrap2">
						<router-link to="/frame/wechatchange" class="">在线充值</router-link>
					</div>
					<div class="nowrap2">
						<router-link to="/frame/tk" class="">在线提款</router-link>
					</div>
				</li>
				<li class="r-wrap r-nowrap1 link">
					<router-link to="/frame/Grzx" class="r-bg" @click.native="closeContSider()">个人中心</router-link> <img src="/static/game/static/images/msg_new2.png" class="new"></li>
				<li class="r-wrap r-nowrap1 link">
					<router-link to="/frame/Cjhd" class="r-bg">抽奖活动</router-link> <img src="/static/game/static/images/msg_new2.png" class="new"></li>
				<li class="r-wrap r-nowrap1">
					<div>最新注单</div>
				</li>
			</ul>
		</div>
		<div class="sider-col2">
			<!--<order-list v-if="!orderList.length"></order-list>-->
			<OrderList v-if="orderList.length"></OrderList>
			<!--{{orderList}}-->
		</div>

		<!--test element ui notification-->



	</div>
</template>

<script>
	import { mapActions, mapGetters } from "vuex";
	import OrderList from "./cart/orderList";

	export default {
		name: "sider-bar",
		data() {
			return {
                userMessage: {},
                orderListFromBack: {}
			}
		},
		components: {
			OrderList
		},
		computed: {
			...mapGetters({
				orderList: "getOrderList",
				userName: "getUserName",
				money: "getMoney",
				testFlag: "getTestFlag",
                bettingTotal: "getBettingTotal",
				currentGameCode: "getCurrentGameCode",
			}),
			userNameComputed:function () {
				if(this.testFlag === 1){
				    return "游客"
				} else {
				    // userMessage表示用户登录进来之后再刷新（后面的需要覆盖前面的）

					// this.userName是第一次登录进来之后获取的，这里我们直接将数据存入即可，之后每次更新先用vuex，然后每次开奖之后，用后台校验一次

					// 后端覆盖前段的数据
                    return this.userName
                    // if(this.userMessage !== {}){
						// return this.userMessage.user
                    // }else{
                    //
                    // }

				}
            },
            moneyComputed:function () {
                return this.money
                // if(this.userMessage !== {}){
                //     return this.userMessage.money
                // }else{
                //     return this.money
                // }
            },
            bettingTotalComputed:function () {
			    return this.bettingTotal

                // if(this.userMessage !== {}){
                //     return this.userMessage.sel_money
                // }else{
                //     return this.bettingTotal
                // }
            },

			// 这里我们取出从后台获取的数据

			gameIdComputed: {
			    get: function(){
                    switch (this.currentGameCodeFromLocalStorage){
                        case 'jspk10':
                            return '80'
                        case 'pk10':
                            return '50'
                        case 'jsft':
                            return '82'
                        case 'jsssc':
                            return '81'
                        case 'cqssc':
                            return '1'
                        default:
                            return '80'
                    }
				}

            },
            // orderListComputed: {
			 //    get: function () {
            //         if(this.orderListFromBack !== {}) {
            //             return this.orderListFromBack.orders
            //         }else{
            //             return this.orderList
            //         }
				// }
            // },
            currentGameCodeFromLocalStorage: {
			    get: function () {
                    let code = window.localStorage.getItem('currentGameCode')
                    return code
                }
			}
            // 这里我们取出从后台获取的数据
		},
		methods: {
			closeContSider: function() {
				// alert('closeContSider')
				this.$store.dispatch("contSiderShowFalse");
			},
		},
		mounted() {

		    // 获取用户信息
			axios.get('/web/getUser').then(response => {
                        this.userMessage = response.data
				// console.log(this.userMessage)
                this.$store.dispatch('refresh_sel_money',this.userMessage)
                    })

			// 获取用户注单信息
            axios.get('/web/getOrders/' + this.gameIdComputed).then(response => {
                		this.orderListFromBack = response.data
			})
		},

	}
</script>

<style scoped>
	/*全局样式*/
	
	body {
		font: 12px/1.5 "\5FAE\8F6F\96C5\9ED1", "\5b8b\4f53", Arial, Helvetica, sans-serif;
		overflow-y: hidden;
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
		zoom: 1;
	}
	
	a {
		text-decoration: none;
	}
	
	a:hover {
		text-decoration: none;
	}
	
	.show {
		display: block;
	}
	/*与sidebar有关的全局性样式*/
	/*与sidebar有关的全局性样式结束*/
	/*skin_blue相关的全局性样式*/
	/*skin_blue相关的全局性样式结束*/
	/*全局样式结束 将顶部固定在了左上角*/
	/*skin_blue 样式 sidebar*/
	
	.skin_blue .sub {
		color: #666;
		background: #e6e6e6;
		background: -moz-linear-gradient( top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
		background: -webkit-linear-gradient( top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
		background: linear-gradient( to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
		border-bottom: 1px solid #ccc;
	}
	
	.skin_blue .sub a {
		color: #666;
	}
	
	.skin_blue .sub .selected,
	.skin_blue .sub a:hover {
		color: #f98d5c;
	}
	
	.skin_blue .r-wrap,
	.skin_blue .r-wrap a {
		color: #fff;
	}
	
	.skin_blue .r-nowrap1 {
		background: #2161b3;
	}
	
	.skin_blue .nowrap2 {
		border: solid 1px #f4521b;
		background: #ff9461;
		background: -moz-linear-gradient( top, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
		background: -webkit-linear-gradient( top, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
		background: linear-gradient( to bottom, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);
	}
	
	.skin_blue .nowrap2:hover {
		background: url("/static/game/images/skin/blue/announce-bg.png") no-repeat center bottom;
	}
	
	.skin_blue li.link:hover {
		background: #346fb9;
		background: -moz-linear-gradient( top, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%);
		background: -webkit-linear-gradient( top, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%);
		background: linear-gradient( to bottom, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%);
	}
	/*skin_blue 样式 siderbar 结束*/
	/*与中间有关的样式*/
	
	.main-wrap {
		position: absolute;
		width: 100%;
		top: 137px;
		bottom: 0;
	}
	/*与中间有关的样式结束*/
	/*siderbar相关样式*/
	
	.siderbar {
		position: absolute;
		width: 200px;
		top: 0;
		left: 0;
		bottom: 0;
		background-color: #e6e6e6;
		text-align: center;
		border-right: solid 1px #ccc;
	}
	
	.side_left ul {
		list-style: outside none none;
		margin: 0;
		padding: 0;
	}
	
	.side_left li {
		position: relative;
	}
	
	.side_left li a {
		display: block;
		width: 100%;
		height: 100%;
	}
	
	.side_left p {
		display: block;
		line-height: 18px;
		margin: 0;
		white-space: nowrap;
	}
	
	.side_left {
		margin-bottom: 2px;
	}
	
	.side_left .r-wrap {
		width: 190px;
		font-weight: 700;
		margin: 4px 5px 0 5px;
		line-height: 16px;
		/*background: #2161b3;*/
	}
	
	.side_left .r-nowrap1 {
		font-size: 14px;
		height: 32px;
		line-height: 32px;
		text-align: center;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
	}
	
	.side_left .info {
		border: 1px solid #999;
		border-top: none;
		width: 188px;
		margin: -2px 5px 8px;
		line-height: 22px;
		background: #fff;
		border-bottom-left-radius: 4px;
		border-bottom-right-radius: 4px;
		text-align: left;
		text-indent: 25px;
		padding: 5px 0;
	}
	
	.side_left .info a {
		display: inline;
		margin-left: 5px;
	}
	
	.side_left .info a img {
		vertical-align: bottom;
	}
	
	.side_left .new {
		position: absolute;
		top: 10px;
		right: 15px;
	}
	
	.side_left .nowrap2 {
		display: inline-block;
		width: 88px;
		height: 34px;
		line-height: 34px;
		font-size: 12px;
		font-weight: 700;
		text-align: center;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
	/*siderbar相关样式结束*/
	/*orderList样式*/
	
	.sider-col2 {
		margin: 0 1px;
	}
</style>