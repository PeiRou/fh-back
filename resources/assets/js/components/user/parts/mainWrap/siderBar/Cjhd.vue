<template>
  <div class="promotion" style="background-color:#e7eef5;">
    <div class="promotion_header">
      <div class="pmo_header_txt">欢迎来到活动中心，我们更专注彩票，博彩乐趣都在这里。活动天天有，彩金天天拿，期期反水，日日返利，敬请关注我们彩票平台！
        <br>
        <!-- 您还可以利用此推广链接简单赚取高额佣金，轻松实现成功与财富梦想！<span id="intr_url"></span> -->
      </div>
      <ul class="pmo_huodong">
        <li id="acti_type_1" class="hide" style="display: list-item;">
          <div class="hd_img">
            <img src="/static/game/images/activity/qdyl.jpg">
          </div>
          <div class="hd_info">
            <h2 class="acti_name">连续充值签到抽奖活动</h2>
            <p>活动内容：
              <br>
              <span class="acti_desc">连续充值抽奖活动 活动内容： 1.所有玩家只需每天登录游戏，存款以及投注量达到对应要求，即可参与！ 2.如果中间间断一天，连续签到将被重置开始时间隔天计算。 3.活动统计时间为：北京时间当天04:30-隔天04:30
                活动时
              </span>
            </p>
            <p class="acti_time">活动时间:
              <span class="stime">2017-09-23 </span> ~
              <span class="etime">2018-12-31 </span>
            </p>
          </div>
          <div class="pmo_btn">
            <router-link class="acti_id" to="/frame/mrqd" acti-id="80">点击查看</router-link>
          </div>
        </li>
        <li id="acti_type_3" class="hide" style="display: list-item;">
          <div class="hd_img">
            <img src="/static/game/images/activity/dlyl.jpg">
          </div>
          <div class="hd_info">
            <h2 class="acti_name">登陆抽奖活动</h2>
            <p>活动内容：
              <br>
              <span class="acti_desc">登陆抽奖活动 活动内容： 1、每日可进行抽奖1次； 2、需要您在抽奖的前一天有过下注记录才可抽奖，中奖率高达85%。</span>
            </p>
            <p class="acti_time">活动时间:
              <span class="stime">2017-09-23 </span>
              <span class="etime">2018-12-31 </span>
            </p>
          </div>
          <div class="pmo_btn">
            <router-link class="acti_id" to="/frame/dlshl" acti-id="82">点击查看</router-link>
          </div>
        </li>
        <li>
          <img src="/static/game/images/activity/hd_more.jpg">
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
    export default {
        created () {
            this.$store.dispatch('contSiderShowFalse')
        }
    }
</script>

<style scoped>
ul,
li {
  list-style: none;
  margin: 0 0;
  padding: 0 0;
}

body {
  color: #626262;
  margin: 4px 0 0 5px;
  padding: 0;
  font-size: 13px;
  font-family: "\5FAE\8F6F\96C5\9ED1", "\5b8b\4f53", Arial, Helvetica,
    sans-serif;
  background-color: #e7eef5;
}

/*活动大厅*/
.pmo_btn .acti_id {
  margin-left: 45px;
  color: #fff;
  cursor: pointer;
}

.promotion_header {
  width: 1030px;
  background: url("/static/game/images/activity/promotion_header.png")
    right top no-repeat;
  min-height: 261px;
}

.pmo_header_txt {
  color: #949393;
  font-size: 14px;
  margin-left: 30px;
  padding-top: 120px;
  line-height: 20px;
  margin-top: -25px;
}

.pmo_huodong {
  margin-left: 30px;
}

.pmo_huodong li {
  width: 920px;
  height: 145px;
  margin: 10px 0;
  border: #fff 2px solid;
  background: url("/static/game/images/activity/hd_bg.jpg")
    repeat-x;
  position: relative;
}

.hd_img {
  float: left;
}

.hd_info {
  width: 444px;
  height: 145px;
  float: left;
  margin-left: 15px;
  font-family: "微软雅黑";
  position: relative;
}

.hd_info h2 {
  font-weight: bold;
  margin: 8px 0;
  font-size: 14px;
}

.hd_info p {
  font-size: 12px;
  padding-right: 4px;
  margin: 0;
  margin-top: -4px;
}

.hd_info .acti_desc {
  display: inline-block;
  width: 438.7px;
  height: 50px;
}

.acti_time {
  position: absolute;
  bottom: 0;
  left: 0;
  color: #fb3854;
  line-height: 26px;
}

.acti_time span {
  font-weight: bold;
}

.pmo_btn {
  width: 126px;
  height: 41px;
  background: url("/static/game/images/activity/button.png")
    no-repeat;
  position: absolute;
  bottom: 1px;
  right: 1px;
  color: #fff;
  font-weight: bold;
  line-height: 41px;
}

.pmo_btn a {
  margin-left: 45px;
  color: #fff;
}
</style>