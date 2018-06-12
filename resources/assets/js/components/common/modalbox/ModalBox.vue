<template>
	<div>
			<div class="notice-wrap" v-if="isTrue">
				<div class="mask"></div>
				<!--  -->
				<div class="bg lay-important" v-if="ModelBoole">
					<div class="close-btn" @click='next'>
						<a href="javascript:void(0)" >X</a>
					</div>
					<div class="notice-pager">
						<a href="javascript:void(0)" @click="last">&lt;&lt;</a> 
						<span class="indicator">{{page}}/{{maxPage}}</span>
						<a href="javascript:void(0)" @click="next">&gt;&gt;</a>
					</div>
					<div class="lay-notice-icon"><i class="notice-icon"></i>
						<a href="javascript:void(0)" class="more-btn" @click="ModelShow">更多</a>
					</div>
					<div class="notice-content lay-content">
						<p>{{modalMessageArrComputed[this.page-1]}}</p>
						<!--<p>{{modalMessage}}{{modalMessage.messageArr[this.page-1]['message']}}</p>-->
					</div>
					<div class="lay-notice-btn">
						<a href="javascript:void(0)" class="notice-btn" @click='next'>我知道了</a>
					</div>
				</div>
				<!-- 更多信息 -->
				<div class="bg lay-list" v-if="!ModelBoole">
					<div class="close-btn">
						<a href="javascript:void(0)" @click="gb">X</a>
					</div>
					<div class="lay-notice-icon">
						<i class="notice-icon"></i>
					</div>
					<div class="notice-content lay-content">
						<ul>
							<li v-for="item in modalMessage.messageArr">

								<h3>{{ item.title }}</h3>
								<p>{{ item.updateTime }}</p>
								<p>{{ item.message }}</p>
							</li>
							<!--<li>-->
								<!--<h3>尊敬的会员您好！【万象更新;年年如意。岁岁平安;财源广进。富贵吉祥;幸福安康。福禄满门;喜气洋洋】值此新春佳节到来之际、爱彩娱乐团队祝您在新的一年里：鸿运当头、一路长虹！【温馨提示：春节期间：秒速赛车、秒速飞艇、秒速时时彩、幸运蛋蛋、幸运六合彩-->
									<!--正常开盘下注。如有任何问题请随时与我们联系】</h3>-->
								<!--<p>2018-02-11 02:36:17</p>-->
								<!--<p>尊敬的会员您好！【万象更新;年年如意。岁岁平安;财源广进。富贵吉祥;幸福安康。福禄满门;喜气洋洋】值此新春佳节到来之际、爱彩娱乐团队祝您在新的一年里：鸿运当头、一路长虹！【温馨提示：春节期间：秒速赛车、秒速飞艇、秒速时时彩、幸运蛋蛋、幸运六合彩-->
									<!--正常开盘下注。如有任何问题请随时与我们联系】</p>-->
							<!--</li>-->
							<!--<li>-->
								<!--<h3>【紧急通知】微信入款【ac9807com】暂停收款！请添加最新收款微信【a9802com】发送红包进行充值，如需大额转账入款请添加微信【by55661】即可，感谢您的支持，谢谢</h3>-->
								<!--<p>2018-02-07 04:34:45</p>-->
								<!--<p>【紧急通知】微信入款【ac9807com】暂停收款！请添加最新收款微信【a9802com】发送红包进行充值，如需大额转账入款请添加微信【by55661】即可，感谢您的支持，谢谢</p>-->
							<!--</li>-->
						</ul>
					</div>
				</div>
			</div>
	</div>
</template>

<script>
// import { mapGetters } from 'vuex'


export default {
  data() {
    return {
      page: 1,
      maxPage: 3,
      minPage: 1,
      isTrue: true,
//    allMsg: ["【通知】：如需人工微信入款请添加最新收款微信号：【we238665】谢谢！在线支付微信扫码100-5000恢复交易 由于交易流程更改 如下，1、扫码之前登陆微信，打开收付款，2、点击查看付款码数字，并记下数字。3、打开仁信微信扫码，扫码后出跳出支付页面，输入数字确认即可，（注意：记下付码数字后必需在一分钟内支付，否则会支付无效，要重新生成付款码)", "尊敬的会员您好！支付宝扫码入款【财付通 *晓】通道已经开启，扫码付款时需要备注支付宝认证姓名以便财务核实入款，感谢您的支持，谢谢！", "尊敬的会员您好！【万象更新;年年如意。岁岁平安;财源广进。富贵吉祥;幸福安康。福禄满门;喜气洋洋】值此新春佳节到来之际、爱彩娱乐团队祝您在新的一年里：鸿运当头、一路长虹、2018[發][發][發]！"],
	  currMsg: null,
	  ModelBoole:true,
		// 获取模态框
      modalMessage: {
          messageArr: []
	  }
    };
  },
  methods: {
	gb(){
			this.isTrue = false;
	},
    // 关闭模态框
    last() {
      if (this.page > this.minPage) {
        this.page--;
      }
      // this.currMsg = this.allMsg[this.page - 1];
    },
    next() {
      if (this.page < this.maxPage) {
        this.page++;
      } else {
        this.isTrue = false;
      }
      // this.currMsg = this.allMsg[this.page - 1];
	},
	ModelShow(){
			this.ModelBoole = !this.ModelBoole
	},
      // 获取公告数据同时算出公告的个数
    getModalMessageFromStatic: function () {
		  let count = 0
          let _this = this
          window.axios.get('/static/messages.js')
              .then(function (response) {
                  // 获取数据,要用双引号将数据包起来，才能
                  let str = response.data
                  let ModalMessageArr = JSON.parse(str.slice(15, -1))
				  let step = 0
                  // 将第二种消息压入有数据
				  if(step === 0){
                      for(let item in ModalMessageArr.type_4){

                          count ++

                          _this.modalMessage.messageArr.push(ModalMessageArr.type_4[item])
                      }
                      step ++
				  }
                  // 将第一种消息压入有数据
				  if(step === 1){
                      for(let item in ModalMessageArr.type_2){
                          count ++
                          _this.modalMessage.messageArr.push(ModalMessageArr.type_2[item])
                      }
                      step ++
				  }
                  if(step === 2){
                      _this.maxPage = count
                  }
       		})
      },
  },
	mounted(){
        this.getModalMessageFromStatic()
	},
	computed: {
      	modalMessageArrComputed: function () {
			let emptyArr = []
            for(let item in this.modalMessage.messageArr){
			    emptyArr.push(this.modalMessage.messageArr[item].message)
			}
			return emptyArr
        }
	}
}
</script>

<style scoped>
/* 公用样式和模态框样式 */
* {
  margin: 0;
  padding: 0;
}

body {
  font: 12px/1.5 "\5FAE\8F6F\96C5\9ED1", "\5b8b\4f53", Arial, Helvetica,
    sans-serif;
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
a {
  text-decoration: none;
}
.notice-wrap {
  position: fixed;
  width: 100%;
  height: 100%;
  z-index: 101;
}
.notice-wrap .bg {
  position: absolute;
  left: 50%;
  top: 50%;
  border-radius: 5px;
  z-index: 999;
}
.notice-wrap .mask {
  background: #000;
  opacity: 0.5;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: block;
}

.notice-wrap .notice-icon {
  display: block;
  width: 155px;
  height: 137px;
  background: url("/static/game/images/modalbox/notice_icon.png");
  background-position: -161px -14px;
  padding-bottom: 8px;
}
.notice-wrap .more-btn,
.notice-wrap .notice-btn {
  display: block;
  border-radius: 3px;
  font-size: 14px;
  text-align: center;
  transition: all 0.1s;
  -webkit-transition: all 0.1s;
}

.notice-wrap .more-btn:active,
.notice-wrap .notice-btn:active {
  border-bottom: none;
  transform: translate(0, 3px);
  -webkit-transform: translate(0, 3px);
}

.notice-wrap .notice-btn {
  display: block;
  color: #fff;
  padding: 10px 6px;
  border-bottom: 5px solid #d18922;
  background-color: #fec436;
}

.notice-wrap .more-btn {
  display: inline-block;
  color: red;
  padding: 0 8px;
  border-bottom: 3px solid #ccc;
  font-size: 12px;
  background-color: #fff;
}
.notice-wrap .notice-pager {
  text-align: center;
  font-size: 14px;
  color: #fff;
}
.notice-wrap .notice-pager a {
  color: #fff;
}
.notice-wrap .notice-pager .indicator {
  display: inline-block;
  padding: 2px 15px;
}
.notice-wrap .notice-content {
  line-height: 1.6;
  color: #fff;
  font-size: 13px;
  max-height: 300px;
  overflow-y: scroll;
}
.notice-wrap .notice-content::-webkit-scrollbar {
  width: 10px;
}
.notice-wrap .notice-content p {
  white-space: pre-wrap;
  word-break: break-all;
  text-align: left;
}
.notice-wrap .lay-important {
  width: 300px;
  min-height: 300px;
  margin: -210px 0 0 -200px;
}
.notice-wrap .lay-important .lay-content {
  padding: 10px 20px;
  margin: 0 10px;
  text-align: center;
}
.notice-wrap .lay-important .lay-notice-icon {
  width: 155px;
  padding-top: 20px;
  margin: 0 auto;
  position: relative;
}
.notice-wrap .lay-important .more-btn {
  position: absolute;
  right: -28px;
  top: 105px;
}

.notice-wrap .lay-notice-btn {
  width: 150px;
  margin: 20px auto 0;
  padding-bottom: 20px;
}
.notice-wrap .close-btn {
  width: 14px;
  height: 16px;
  position: absolute;
  right: 8px;
  top: 0;
  color: #fff;
  font-weight: 700;
  cursor: pointer;
}

.notice-wrap .close-btn a {
  display: block;
  color: #fff;
  padding: 5px;
}
.skin_blue .notice-wrap .bg {
  background: #1e5799;
  background: -moz-linear-gradient(
    top,
    rgba(30, 87, 153, 1) 0,
    rgba(0, 219, 255, 1) 0,
    rgba(0, 165, 255, 1) 100%
  );
  background: -webkit-linear-gradient(
    top,
    rgba(30, 87, 153, 1) 0,
    rgba(0, 219, 255, 1) 0,
    rgba(0, 165, 255, 1) 100%
  );
  background: linear-gradient(
    to bottom,
    rgba(30, 87, 153, 1) 0,
    rgba(0, 219, 255, 1) 0,
    rgba(0, 165, 255, 1) 100%
  );
}

/* 更多信息样式 */
.notice-wrap li:not(:last-child) {
    border-bottom: 1px solid rgba(255,255,255,.71);
}

.notice-wrap li {
    padding: 10px 0;
    font-size: 14px;
}

h3 {
    display: block;
    font-size: 1.17em;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    font-weight: bold;
	font-size: 100%;
}
p {
    display: block;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
}

.notice-wrap .lay-list {
	width: 600px;
	height: 330px;
	margin: -180px 0 0 -300px
}

.notice-wrap .lay-list .notice-icon {
	background-position: -5px 0;
	height: 142px
}

.notice-wrap .lay-list .lay-notice-icon {
	width: 155px;
	padding-top: 60px;
	margin-right: 20px;
	float: left;
	margin-left: 20px
}

.notice-wrap .lay-list .lay-content {
	overflow-y: auto;
	overflow-x: hidden;
	height: 280px;
	margin-top: 26px;
	margin-right: 20px
}

</style>
