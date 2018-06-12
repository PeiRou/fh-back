<template>
 <div class="sub-wrap clearfix">
    <div class="center-page">
      <div class="memberheader">
        <div class="useravatar floatleft">
          <img src="/static/images/skin/blue/userlogo.jpg" width="84" height="83" alt="">
        </div>
        <div class="memberinfo floatleft">
          <h1 class="floatleft">
            {{NowTime}},
            <span id="userName" class="blue">{{userName}}</span>
          </h1>
          <div class="balance floatleft">
            <div class="balancevalue floatleft">
              中心钱包 :
              <span class="blue">
                <span class="balanceCount">{{money}}</span>元</span>
            </div>
            <div class="floatright margintop7 marginright10 marginleft5 pointer">
              <a href="javascript:;">
                <img src="/static/images/skin/blue/btnrefresh.jpg" width="16" height="17" alt="">
              </a>
            </div>
          </div>
          <div class="gap5"></div>
          <p>彩票网投领导者·实力铸就品牌·诚信打造一切·相信品牌的力量</p>
          <p>最后登录：
            <span id="loginTime">2018-03-29 15:39:49</span>
          </p>
        </div>
      </div>
      <div class="membersubnavi">
        <div class="subnavi blue">
          <router-link to="/frame/zxcz">充值</router-link>
          <div class="subnaviarrow" style="display: none;"></div>
        </div>
        <div class="subnavi blue">
          <router-link to="/frame/tk">提款</router-link>
          <div class="subnaviarrow"></div>
        </div>
        <div class="subnavi blue">
          <router-link to="/financial">充值记录</router-link>
          <div class="subnaviarrow" style="display: none;"></div>
        </div>
        <div class="subnavi blue">
          <router-link to="/frame/tkjl">提款记录</router-link>
          <div class="subnaviarrow" style="display: none;"></div>
        </div>
        <div class="subnavi blue">
          <router-link to="/frame/other">其它记录</router-link>
        </div>
      </div>
      <div>
        <div class="stepswithdraw">
          <div class="substeps">
            <div class="substepitmgray1 substepitmblue1">
              <b>01</b> 提交
            </div>
            <div class="substepitmgray2">
              <b>02</b> 审核
            </div>
            <div class="substepitmgray2">
              <b>03</b> 出款
            </div>
            <div class="substepitmgray2">
              <b>04</b> 到账
            </div>
          </div>
        </div>
        <div class="subcontent2">
          <div class="addbankcard">
            <div style="width:300px;margin:0 auto;">
              <el-form  status-icon :rules="rules" :model="bankForm" ref="bankForm" label-width="120px" size='mini' >
                <el-form-item label="持卡人姓名" prop='name' >
                  <el-input v-model="bankForm.name"></el-input>
                </el-form-item>
                 <el-form-item label="选择银行" prop='bank'>
                   <el-select v-model="bankForm.bank">
                     <el-option :label="item.name" :value="item.bank_id" v-for="item in post.bankList" :key="item.eng_name"></el-option>

                    <!--<el-option label="农业银行" value="农业银行"></el-option>-->
                    <!--<el-option label="建设银行" value="建设银行"></el-option>-->
                  </el-select>
                </el-form-item>
                <el-form-item label="银行卡号" prop='number'>
                  <el-input v-model='bankForm.number'></el-input>
                </el-form-item>
                <el-form-item label="开户网点" prop='khwd'>
                  <el-input v-model='bankForm.khwd'></el-input>
                </el-form-item>
                <el-form-item>
                  <el-button type="warning" @click="submitForm('bankForm')">提交</el-button>
                </el-form-item>
              </el-form>
            </div>
          </div>
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
        post:{},
      numberValidateForm: {
        age: ""
      },
      NowTime: "",
      bankForm:{
        name:'',
        number:'',
        khwd:'',
        bank:'',
      },
      rules: {
          name: [
            { required: true, message: '请输入持卡人姓名', trigger: 'blur' },
          ],
          number: [
            { required: true, message: '请输入银行卡号', trigger: 'blur' }
          ]
          ,
          khwd: [
            { required: true, message: '请输入卡户网点', trigger: 'blur' }
          ],
          bank: [
            { required: true, message: '请选择银行', trigger: 'change' }
          ],
        }
    }
  
  },
    mounted() {

        // 获取用户注单信息
        axios.get('/web/bankList').then(response => {
            this.post = {
                bankList : response.data
            }
        })
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
      money: "getMoney",
      userId: "getUserId",
        ifBankCard: 'getIfBankCard'
    }),
    BankCard: function() {
      return 1;
    }
  },
  methods: {
      submitForm(formName) {
          let _this =  this;
          _this.$refs[formName].validate((valid) => {
              if (valid) {
                  window.axios.post('/web/saveBankCard',{
                      user_id: _this.userId,
                      bank_id: _this.bankForm.bank,
                      trueName: _this.bankForm.name,
                      cardNo: _this.bankForm.number,
                      cardAddress: _this.bankForm.khwd,

                  }).then(function (response) {
                      if(response.data.status === true){
                          _this.$store.dispatch('storeIfBankCard')
                          _this.$router.push({path: '/frame/qrtk'})
                      }

                  }).catch(function (error) {

                      console.log(error);
                  });

                  // alert('submit!');
                  // console.log(_this.bankForm)
                  //
                  // window.axios.get('/web/bindBank/', {
                  //     user_id: _this.bankForm.name,
                  //     bank_name: _this.bankForm.bank,
                  //     subAddress: _this.bankForm.khwd,
                  //     cardNo: _this.bankForm.number,
                  // })
                  //     .then(function (response) {
                  //         alert(response.data);
                  //     })
                  //     .catch(function (error) {
                  //         console.log(error);
                  //     });



                  _this.$router.push({path:'/frame/qrtk'});
              } else {
                  alert('错误，请重试')
                  return false;
              }
          });
      },


    //
    // submitForm(formName) {
    //     this.$refs[formName].validate((valid) => {
    //       if (valid) {
    //           alert('123')
    //         this.$router.push({path:'/frame/qrtk'});
    //       } else {
    //         alert('错误，请重试')
    //       }
    //     });
    //   },
  }
};
</script>
<style scoped>
.main-body {
  position: absolute;
  overflow-x: auto;
  top: 0;
  left: 0;
  right: 0;
  bottom: 30px;
}

.main-wrap {
  position: absolute;
  width: 100%;
  top: 137px;
  bottom: 0;
}

.logo img {
  max-width: 100%;
}
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
.cont-main {
  overflow: hidden;
  width: 839px;
  float: left;
}

.center-page .margintop5 {
  margin-top: 5px;
}

.center-page .margintop7 {
  margin-top: 7px;
}

.center-page .margintop8 {
  margin-top: 8px;
}

.center-page .margintop10 {
  margin-top: 10px;
}

.center-page .margintop15 {
  margin-top: 15px;
}

.center-page .margintop20 {
  margin-top: 20px;
}

.center-page .margintop25 {
  margin-top: 25px;
}

.center-page .margintop30 {
  margin-top: 30px;
}

.center-page .margintop35 {
  margin-top: 35px;
}

.center-page .margintop40 {
  margin-top: 40px;
}

.center-page .margintop50 {
  margin-top: 50px;
}

.center-page .marginbtm5 {
  margin-bottom: 5px;
}

.center-page .marginbtm7 {
  margin-bottom: 7px;
}

.center-page .marginbtm8 {
  margin-bottom: 8px;
}

.center-page .marginbtm10 {
  margin-bottom: 10px;
}

.center-page .marginbtm15 {
  margin-bottom: 15px;
}

.center-page .marginbtm20 {
  margin-bottom: 20px;
}

.center-page .marginbtm25 {
  margin-bottom: 25px;
}

.center-page .marginbtm30 {
  margin-bottom: 30px;
}

.center-page .marginbtm35 {
  margin-bottom: 35px;
}

.center-page .marginbtm40 {
  margin-bottom: 40px;
}

.center-page .marginleft3 {
  margin-left: 3px;
}

.center-page .marginleft5 {
  margin-left: 5px;
}

.center-page .marginleft7 {
  margin-left: 7px;
}

.center-page .marginleft10 {
  margin-left: 10px;
}

.center-page .marginleft15 {
  margin-left: 15px;
}

.center-page .marginleft20 {
  margin-left: 20px;
}

.center-page .marginleft25 {
  margin-left: 25px;
}

.center-page .marginleft30 {
  margin-left: 30px;
}

.center-page .marginright5 {
  margin-right: 5px;
}

.center-page .marginright7 {
  margin-right: 7px;
}

.center-page .marginright9 {
  margin-right: 9px;
}

.center-page .marginright10 {
  margin-right: 10px;
}

.center-page .marginright15 {
  margin-right: 15px;
}

.center-page .marginright20 {
  margin-right: 20px;
}

.center-page .marginright25 {
  margin-right: 25px;
}

.center-page .marginright30 {
  margin-right: 30px;
}

.center-page .alignleft {
  text-align: left;
}

.center-page .alignright {
  text-align: right;
}

.center-page .aligncenter {
  text-align: center;
}

.center-page .floatleft {
  float: left;
}

.center-page .floatright {
  float: right;
}
.center-page .blue {
  color: #217eec;
}

.center-page .red {
  color: #ff9797;
}

.center-page .gray {
  color: #a2a2a2;
}

.center-page .smalltxt {
  font-size: 12px;
}

.center-page .bigtxt {
  font-size: 24px;
}

.center-page .pointer {
  cursor: pointer;
}

.center-page .gap5 {
  height: 10px;
  width: 100%;
  overflow: hidden;
}

.wrap-main {
  padding: 0;
  margin: 0;
}

.wrap-header {
  border-bottom: 1px solid #cdcdcd;
  padding: 20px 0 10px 10px;
  font-size: 18px;
  background-color: #fde6eb;
}

.wrap-title {
  border-bottom: 1px solid #cdcdcd;
  padding: 20px 0 10px 20px;
  font-size: 18px;
  color: #313131;
}

.wrap-body {
  padding: 20px;
}

.wrap-main .info label {
  margin-right: 20px;
  color: #892122;
}

.wrap-main .form-ul {
  width: 96%;
  margin: 0 auto;
}

.wrap-main .form-ul li {
  font-size: 16px;
  line-height: 30px;
  color: #898989;
  margin: 0 0 18px 0;
  overflow: hidden;
}

.wrap-main .form-ul span {
  display: block;
  width: 140px;
  font-size: 18px;
  color: #313131;
  text-align: right;
  float: left;
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
  text-indent: 5px;
}

.wrap-main .w-small {
  width: 60px;
}

a {
  text-decoration: none;
}
.center-page .memberheader {
  height: 140px;
  border-bottom: 1px solid #cdcdcd;
  position: relative;
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

.center-page .memberinfo p {
  font-size: 12px;
}

.center-page .balancevalue {
  margin: 6px 0 0 40px;
}

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
  background-image: url(/static/game/images/subnaviarrow.jpg);
  background-position: top center;
  height: 20px;
  background-repeat: no-repeat;
}

.center-page .steps {
  height: 130px;
  position: relative;
}

.center-page .substeps {
  margin-top: 30px;
  margin-left: 30px;
}

.center-page .substepitmgray1 {
  width: 183px;
  height: 25px;
  float: left;
  background-image: url(/static/images/arrowblue1.png);
  color: #fff;
  padding: 5px 0 0 55px;
}

.center-page .substepitmblue1 {
  background-image: url(/static/images/arrowblue1.png);
}

.center-page .substepitmgray2 {
  width: 163px;
  height: 25px;
  float: left;
  margin-left: -4px;
  background-image: url(/static/images/arrowblue2.png);
  color: #fff;
  padding: 5px 0 0 75px;
}

.center-page .substepitmblue2 {
  background-image: url(/static/images/arrowblue2.png);
}

.center-page .line {
  height: 1px;
  position: absolute;
  bottom: 0;
  background-color: #217eec;
  width: 100%;
}

.center-page .stepswithdraw {
  height: 50px;
  position: relative;
}

.center-page .subcontent2 {
  padding-top: 35px;
  padding-bottom: 40px;
  border-top: 1px solid #93bdee;
}
.center-page .th-btn {
  margin-top: 20px;
  text-align: center;
}

.center-page .formpanel {
  width: 565px;
  margin: 0 auto;
}

.center-page .wd-row {
  margin: 10px 100px;
}

.center-page .wd-col1 {
  padding-top: 4px;
  float: left;
  width: 110px;
  min-height: 10px;
  text-align: right;
}

.center-page .wd-col2 {
  float: left;
  width: 238px;
  margin-left: 5px;
}

.center-page #bankCode {
  padding-left: 2px;
  font-size: 12px;
  width: 160px;
  height: 28px;
  color: #999;
}

.center-page .setting-table select,
.center-page .tabs {
  position: absolute;
  bottom: 0;
  left: 0;
}

.center-page .tabtitle {
  width: 120px;
  height: 30px;
  padding-top: 6px;
  text-align: center;
  float: left;
}

.center-page .tab {
  float: left;
  width: 130px;
  height: 28px;
  padding-top: 8px;
  margin-left: 10px;
  border-top: 1px solid #b0b1b1;
  border-left: 1px solid #b0b1b1;
  border-right: 1px solid #b0b1b1;
  border-bottom: 1px solid #217eec;
  text-align: center;
  background-color: #e3e6e8;
  color: #777f89;
  cursor: pointer;
}

.center-page .tabactive {
  color: #217eec;
  border-top: 1px solid #217eec;
  border-left: 1px solid #217eec;
  border-right: 1px solid #217eec;
  border-bottom: 1px solid #fff;
  background-color: #fff;
  cursor: default;
}

.center-page .subcontent {
  display: none;
}

.center-page .subrow {
  margin: 10px 0;
}

.center-page .subrow .subcol1 {
  width: 110px;
  float: left;
  padding-top: 4px;
  text-align: right;
}

.center-page .subrow .subcol2 {
  margin-left: 10px;
  width: 800px;
  float: left;
}

.center-page .textfield1 {
  padding: 0 5px;
  width: 160px;
  height: 26px;
  line-height: 26px;
  border: 1px solid #ccc;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -webkit-box-shadow: 0 1px 2px 0 #e8e8e8 inset;
  -moz-border-radius: 2px;
  -moz-box-shadow: 0 1px 2px 0 #e8e8e8 inset;
  -o-border-radius: 2px;
  -o-box-shadow: 0 1px 2px 0 #e8e8e8 inset;
  -ms-border-radius: 2px;
  -ms-box-shadow: 0 1px 2px 0 #e8e8e8 inset;
  border-radius: 2px;
  box-shadow: 0 1px 2px 0 #e8e8e8 inset;
}

.center-page .text {
  width: 260px;
  height: 18px;
  border: 1px solid #bdc6ca;
  background: #fff;
  border-radius: 2px;
  font-size: 14px;
  line-height: 18px;
  padding: 9px 5px;
}

.center-page .banklist {
  height: 35px;
  float: left;
  border: 1px solid #cec9c9;
  margin-right: 10px;
  cursor: pointer;
  background-color: #fff;
}

.center-page .banklist:hover {
  border: 1px solid #dbe8ec;
}

.center-page .banklistimg {
  float: left;
  margin: 8px 0 0 5px;
}

.center-page .bankradiobtn {
  float: left;
  margin: 12px 0 0 7px;
}

.center-page .submitbtn {
  border: 1px solid #a2a2a2;
  background-color: #fff;
  color: #a2a2a2;
  padding: 7px 20px;
  cursor: pointer;
}

.center-page .submitbtn:hover {
  border: 1px solid #a2a2a2;
  background-color: #a2a2a2;
  color: #fff;
}
.center-page .banklist2:hover {
  border: 1px solid #dbe8ec;
}

.center-page .bankradiobtn2 {
  float: left;
  margin: 12px 0 0 7px;
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
}

.center-page .c-button:focus,
.center-page .c-button:hover {
  background-image: linear-gradient(
    transparent,
    rgba(0, 0, 0, 0.05) 40%,
    rgba(0, 0, 0, 0.1)
  );
}

.center-page .c-button:focus {
  outline: 0 none;
}
.center-page .alignRight {
  text-align: right;
}

.center-page .records {
  padding: 0 5px;
}

.center-page .banklist i {
  margin: 0 6px 0 8px;
  margin-top: 9px;
  vertical-align: -4px;
  display: inline-block;
}
.center-page .trcolor {
  background-color: #f0f0f1;
}

.el-form-item__error {
  color: #ff4949;
  font-size: 12px;
  line-height: 1;
  padding-top: 4px;
  position: absolute;
  left: 120px;
  top: 81%;
  overflow: visible !important;
}

.IntBut {
  width: 300px;
  height: 26px;
  line-height: 26px;
  border-width: 1px;
  margin: 0 auto;
}
</style>