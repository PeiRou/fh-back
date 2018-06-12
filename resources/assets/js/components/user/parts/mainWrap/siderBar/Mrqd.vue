<template>
<div>
   <div class="promotion">
    <div class="qiandao">
      <div class="qiandao_top">
        <div class="qiandao_rule">
          <p>活动规则：</p>
          <p>所有玩家只需要每天登录平台，充值达到相应的金额并且达到相应投注量即可参与抽奖活动</p>
          <p>每天充值和投注量以及获得的抽奖机会列表：</p>
          <ul id="cont">
            <li>第1天 充值100元 投注量500元 获得1次抽奖机会</li>
            <li>第2天 充值500元 投注量3000元 获得1次抽奖机会</li>
            <li>第3天 充值2000元 投注量5000元 获得1次抽奖机会</li>
            <li>第4天 充值5000元 投注量10000元 获得1次抽奖机会</li>
            <li>第5天 充值10000元 投注量50000元 获得1次抽奖机会</li>
            <li>第6天 充值20000元 投注量60000元 获得1次抽奖机会</li>
            <li>第7天 充值50000元 投注量150000元 获得1次抽奖机会</li>
          </ul>
          <p>
            <span>如果中间间断一天，连续签到将被重置开始时间隔天计算。连续天数越大抽奖获得的奖品更丰厚，具体奖品请点击下面的宝箱查看。</span>
          </p>
        </div>
        <div class="qiandao_tit">
          <span>连续签到</span> &nbsp;&nbsp; 可砸到更丰厚的奖品 已连续
          <b id="maxDay">0</b> 天</div>
        <div id="calendar">
          <div class="c_header">
            <h1>2018年3月</h1>
            <span class="pre"></span>
            <span class="next"></span>
            <ol>
              <li>日</li>
              <li>一</li>
              <li>二</li>
              <li>三</li>
              <li>四</li>
              <li>五</li>
              <li>六</li>
            </ol>
          </div>
          <ul class="c_body">
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
            <li class="grey">1</li>
            <li class="grey">2</li>
            <li class="grey">3</li>
            <li class="grey">4</li>
            <li class="grey">5</li>
            <li class="grey">6</li>
            <li class="grey">7</li>
            <li class="grey">8</li>
            <li class="grey">9</li>
            <li class="grey">10</li>
            <li class="grey">11</li>
            <li class="active">12</li>
            <li class="">13</li>
            <li class="">14</li>
            <li class="">15</li>
            <li class="">16</li>
            <li class="">17</li>
            <li class="">18</li>
            <li class="">19</li>
            <li class="">20</li>
            <li class="">21</li>
            <li class="">22</li>
            <li class="">23</li>
            <li class="">24</li>
            <li class="">25</li>
            <li class="">26</li>
            <li class="">27</li>
            <li class="">28</li>
            <li class="">29</li>
            <li class="">30</li>
            <li class="">31</li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
          </ul>
        </div>
      </div>
      <div class="qiandao_prize">
        <ul id="qiandaoBox">
          <li acti-id="6" egg-flag="0">
            <div class="prize"></div>
            <p>连续签到1天</p>
            <div class="prize_btn grey">查看奖品</div>
          </li>
          <li acti-id="7" egg-flag="0">
            <div class="prize"></div>
            <p>连续签到2天</p>
            <div class="prize_btn grey">查看奖品</div>
          </li>
          <li acti-id="8" egg-flag="0">
            <div class="prize"></div>
            <p>连续签到3天</p>
            <div class="prize_btn grey">查看奖品</div>
          </li>
          <li acti-id="77" egg-flag="0">
            <div class="prize"></div>
            <p>连续签到4天</p>
            <div class="prize_btn grey">查看奖品</div>
          </li>
          <li acti-id="78" egg-flag="0">
            <div class="prize"></div>
            <p>连续签到5天</p>
            <div class="prize_btn grey">查看奖品</div>
          </li>
          <li acti-id="79" egg-flag="0">
            <div class="prize"></div>
            <p>连续签到6天</p>
            <div class="prize_btn grey">查看奖品</div>
          </li>
          <li acti-id="80" egg-flag="0">
            <div class="prize"></div>
            <p>连续签到7天</p>
            <div class="prize_btn grey">查看奖品</div>
          </li>
        </ul>
      </div>
      <div class="qiandao-tips">当天达到条件后，第二天可以获得1次抽奖机会，获得抽奖机会后请及时参与抽奖，抽奖机会将在次日凌晨5点重置</div>
    </div>
  </div>
  <div class="cd-popup4">
    <div class="cd-popup-container4">
      <div class="cd-popup-close"></div>
      <div class="cd-buttons">
        <div class="zd_cont">
          <div class="star_icon"></div>
          <b>奖品内容</b>
          <div class="zd_info">
            <table>
              <tbody>
                <tr class="prize-header">
                  <td class="left-td">名次</td>
                  <td>内容</td>
                </tr>
                <tr class="border-top">
                  <td class="left-td">第1名</td>
                  <td>iPhone7 Plus</td>
                </tr>
                <tr class="border-top">
                  <td class="left-td">第2名</td>
                  <td>iPhone7</td>
                </tr>
                <tr class="border-top">
                  <td class="left-td">第3名</td>
                  <td>5000元现金</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
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
      font-family: '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
      background-color: #e7eef5;
    }

    /*签到活动*/

    .qiandao {
      width: 985px;
      height: 808px;
      background: url('/static/game/images/activity/qdbg.jpg') no-repeat;
    }

    .qiandao_top {
      width: 945px;
      height: 285px;
      position: relative;
      padding: 200px 0 0 35px;
    }

    .qiandao_rule {
      width: 430px;
      height: 278px;
      border: #c7d4e0 2px solid;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      color: #35517b;
      float: left;
    }

    .qiandao_rule p {
      margin: 6px 8px;
      line-height: 18px;
    }

    .qiandao_rule ul {
      margin-left: 8px;
    }

    .qiandao_rule ul li {
      line-height: 18px
    }

    .qiandao_rule span {
      color: #f60e10;
    }

    .qiandao_tit {
      float: left;
      background: url('/static/game/images/activity/bg_1.png') no-repeat;
      width: 397px;
      height: 52px;
      line-height: 52px;
      text-align: center;
      font-size: 16px;
      color: #fff;
      font-family: "方正准圆简体", "微软雅黑";
      margin-left: 50px;
    }

    .qiandao_tit span {
      color: #ffeb00;
    }

    .qiandao_tit b {
      font-size: 22px;
      color: #ffeb00;
    }

    /*签到日历*/

    #calendar {
      width: 460px;
      height: 220px;
      overflow: hidden;
      border: 1px solid #dadada;
      position: absolute;
      margin-left: 460px;
      margin-top: 60px;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
    }

    .c_header {
      width: 460px;
      height: 46px;
      background-color: #35517b;
      position: relative;
    }

    .c_header h1 {
      color: #ffffff;
      font-size: 17px;
      font-family: "微软雅黑";
      text-align: center;
      line-height: 46px;
      margin: 0 0;
    }

    .c_header span {
      width: 20px;
      height: 20px;
      line-height: 20px;
      color: #ffffff;
      text-align: center;
      position: absolute;
      top: 5px;
      border-radius: 50%;
      background-image: linear-gradient(to bottom, #83d8e7, #abe5ef);
      cursor: pointer;
    }

    .c_header span.pre {
      left: 145px;
      top: 13px;
      background: url('/static/game/images/activity/qd_icon.png') no-repeat;
      background-position: 5px 5px;
    }

    .c_header span.next {
      right: 140px;
      top: 13px;
      background: url('/static/game/images/activity/qd_icon.png') no-repeat;
      background-position: -12px 5px;
    }

    .c_header ol {
      position: absolute;
      left: 0;
      top: 46px;
      overflow: hidden;
      width: 460px;
      height: 30px;
      background-color: #5475a0;
      padding: 0;
      margin: 0;
    }

    .c_header ol li {
      float: left;
      color: #ffffff;
      width: 65.5px;
      height: 30px;
      line-height: 30px;
      text-align: center;
    }

    .c_body {
      overflow: hidden;
      margin-top: 30px;
    }

    .c_body li {
      width: 63.5px;
      height: 22px;
      line-height: 22px;
      font-size: 14px;
      text-align: center;
      float: left;
      border: 1px solid #ffffff;
      color: #3d3d3d;
    }

    .c_body li.active {
      border: 1px solid #dadada;
      background: url('/static/game/images/activity/qd_icon.png') no-repeat;
      background-position: 21px -78px;
      color: #c921cb;
    }

    .c_body li.grey {
      color: #999;
    }


    /*奖品*/

    .qiandao_prize {
      width: 910px;
      height: 200px;
      background: url('/static/game/images/activity/prize_bg.png') no-repeat;
      margin-top: 10px;
      margin-left: 35px;
    }

    .qiandao_prize ul {
      padding-top: 65px;
      font-family: "微软雅黑";
    }

    .qiandao_prize ul li {
      width: 106px;
      height: 125px;
      float: left;
      background-color: #9eb1c6;
      border: 1px solid #5475a0;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
      margin-left: 19px;
      color: #fff;
      cursor: pointer;
    }

    .qiandao-tips {
      padding: 10px 40px;
      color: red;
      font-weight: bold;
    }

    .prize {
      width: 90px;
      height: 65px;
      padding-left: 10px;
      padding-top: 5px;
      background: url('/static/game/images/activity/box.png') no-repeat right 5px;
    }

    .qiandao_prize ul li p {
      display: block;
      width: 105px;
      height: 20px;
      border: 1px solid #5475a0;
      background-color: #446692;
      text-align: center;
      font-size: 12px;
      line-height: 20px;
      margin: 0;
    }

    .prize_btn {
      width: 72px;
      height: 18px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
      background-color: #446e92;
      text-align: center;
      font-size: 12px;
      margin-top: 10px;
      margin-left: 16px;
      cursor: pointer;
    }

    /*弹框样式*/
    .cd-popup4 {
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      min-height: 812px;
      background-color: rgba(0, 0, 0, 0.7);
      opacity: 0;
      visibility: hidden;
      -webkit-transition: opacity 0.3s 0s, visibility 0s 0.3s;
      -moz-transition: opacity 0.3s 0s, visibility 0s 0.3s;
      transition: opacity 0.3s 0s, visibility 0s 0.3s;
      z-index: 9999;
      display: block;
    }

    .cd-popup4 .zd_cont {
      color: #fff;
      margin-top: 100px;
      text-align: left;
      padding-top: 15px
    }


    .cd-popup4.is-visible {
      opacity: 1;
      visibility: visible;
      -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
      -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
      transition: opacity 0.3s 0s, visibility 0s 0s;
      display: block;
    }

    .cd-popup-container4 {
      position: relative;
      width: 610px;
      margin: 20px auto;
      height: 240px;
      background: url('/static/game/images/activity/prize_pop_bg.png') no-repeat;
      background-size: 90%;
      text-align: center;
      -webkit-transform: scale(0.8);
      -moz-transform: scale(0.8);
      -ms-transform: scale(0.8);
      -o-transform: scale(0.8);
      transform: scale(0.8);
      -webkit-transition-property: -webkit-transform;
      -moz-transition-property: -moz-transform;
      transition-property: transform;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -ms-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
    }

    .is-visible .cd-popup-container4 {
      -webkit-transform: scale(1);
      -moz-transform: scale(1);
      -ms-transform: scale(1);
      -o-transform: scale(1);
      transform: scale(1);
    }
</style>
