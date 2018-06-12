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
                <span class="balanceCount">{{money}}</span> 元</span>
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
            <span id="loginTime">2018-03-30 14:16:12</span>
          </p>
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
				<router-link to="/frame/tkjl" class="router-link-exact-active active">提款记录</router-link>
				<div class="subnaviarrow" style=""></div>
			</div>
			<div class="subnavi blue">
				<router-link to="/frame/other" class="active">其它记录</router-link>
				<div class="subnaviarrow" style="display: none;"></div>
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
          <div class="line2"></div>
        </div>
        <div class="subcontent2">
          <div class="addbankcard">
              <div style="width:370px;margin:0 auto;">
            <el-form  status-icon :rules="rules" :model="bankForm" ref="bankForm" label-width="120px" size='mini' >
              <el-form-item label="提款金额：" prop='number'>
                  <el-input v-model='bankForm.number' type ='number'></el-input>
              </el-form-item>
              <div class="el-form-item wd-row">
                <div class="el-form-item__content">
                  <div class="wd-col1">银行卡号：</div>
                  <div class="wd-col2" style="width: auto; line-height: 30px;">
                    <div class="radio-bank-2">
                      <div class="radio" style="padding: 0px;">
                        <input type="radio" name="bank" :value="this.bankData.info.bank_id" checked="checked">
                      </div>
                      <div class="radio-label">
                        <span class="name">{{ this.bankData.info.bankName }}</span>
                        <span>{{this.bankData.info.cardNo}}</span>
                      </div>
                    </div>
                    <a href="javascript:void(0)" style="line-height: 34px; margin-left: 20px;">重新绑定</a>
                  </div>
                </div>
              </div>
               <el-form-item label="提款密码：" prop='passWord'>
                  <el-input v-model='bankForm.passWord' type ='password'></el-input>
              </el-form-item>
              <el-form-item>
                  <el-button type="warning"  @click="submitForm('bankForm')">提交</el-button>
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
        bankData:{},
      numberValidateForm: {
        age: ""
      },
      NowTime: "",
      bankForm: {
      number: "",
      passWord: ""
      },
      rules: {
        number: [
            { required: true, message: "请输入提款金额", trigger: "blur" },
            {
                validator:function(rule,value,callback){
                    if(value<100){
                         callback(new Error("提款数额不可以小于100"));        
                    }else{
                        callback();
                    }
                 }, type:'number'}
            ],
        passWord :[
            { required : true , message :"请输入提款密码",  trigger: "blur" },
            { min: 4, max: 4, message: '提款密码为4位数', trigger: 'blur'}
        ]
      }
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
      money: "getMoney",
        userId:"getUserId"
    }),
    BankCard: function() {
      return 1;
    },
  },
    mounted(){
        //判断银行卡是否已经绑定
        axios.post('/web/checkUserBank',{user_id: this.userId}).then(response => {
            this.bankData= {
                info : response.data
            }
        })
    },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          this.$router.push({ path: "/frame/qrtk" });
        } else {
          alert("错误，请重试");
        }
      });
    }
  }
};
</script>

<style scoped>
.center-page .margintop7 {
  margin-top: 7px;
}

.center-page .margintop20 {
  margin-top: 20px;
}

.center-page .marginleft5 {
  margin-left: 5px;
}

.center-page .marginright10 {
  margin-right: 10px;
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

.center-page .pointer {
  cursor: pointer;
}

.center-page .gap5 {
  height: 10px;
  width: 100%;
  overflow: hidden;
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

.center-page .stepswithdraw {
  height: 50px;
  position: relative;
}

.center-page .subcontent2 {
  padding-top: 35px;
  padding-bottom: 40px;
  border-top: 1px solid #93bdee;
}

.center-page .formpanel {
  width: 565px;
  margin: 0 auto;
}

.center-page .wd-col1 {
  padding-top: 4px;
  float: left;
  width: 110px;
  min-height: 10px;
  text-align: right;
  color: #606266;
}

.center-page .wd-col2 {
  float: left;
  width: 238px;
  margin-left: 11px;
}

.center-page .wd-col2 a {
  color: red;
}

.center-page .wd-col2 .radio-bank-2 {
  border: 1px solid #dcdcdc;
  float: left;
  padding: 3px 10px 3px 5px;
}

.center-page .wd-col2 .radio-bank-2 .radio-label,
.center-page .wd-col2 .radio-bank-2 .radio {
  float: left;
  cursor: pointer;
  color: #333;
}

.center-page .wd-col2 .radio-bank-2 .radio-label {
  overflow: hidden;
}

.center-page .wd-col2 .radio-bank-2 .radio-label span {
  float: left;
  line-height: 30px;
}

.center-page .wd-col2 .radio-bank-2 .name {
  margin-left: 5px;
  width: 60px;
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
</style>
