<template>
    <div class="content-wrap" style="left: 0;">
        <div class="content">
            <div class="sub-wrap clearfix">
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
                            <p>最后登录：<span id="loginTime">2018-03-09 14:12:43</span></p>
                        </div>
                    </div>
                    <div class="membersubnavi">

                        <div class="subnavi blue">

                            <router-link to="/frame/zxcz" class="router-link-exact-active active">充值</router-link>

                            <div class="subnaviarrow" style=""></div>

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

                            <div class="subnaviarrow" style="display: none;"></div>

                        </div>

                    </div>

                    <div>

                        <div class="steps">

                            <div class="substeps">

                                <div class="substepitmgray1 substepitmblue1"><b>01</b> 选择支付模式

                                </div>

                                <div class="substepitmgray2"><b>02</b> 填写金额

                                </div>

                                <div class="substepitmgray2"><b>03</b> 选择银行

                                </div>

                                <div class="substepitmgray2"><b>04</b> 充值到账

                                </div>

                            </div>

                            <div class="line"></div>

                            <div class="tabs">

                                <div class="tabtitle">选择充值模式：</div>

                                <!--<router-link to="/frame/zxcz" class="tab">网银在线支付</router-link>-->

                                <!--<router-link to="/frame/zfb" class="tab">支付宝在线支付</router-link>-->

                                <!--<router-link to="/frame/wechat" class="tab">微信在线支付</router-link>-->

                                <!--<router-link to="/frame/qpay" class="tab">QQ在线支付</router-link>-->

                                <router-link to="/frame/wechatchange" class="tab">微信转账</router-link>
                                <router-link to="/frame/cft" class="tab">财付通转账</router-link>
                                <router-link to="/frame/zfbzz" class="tab">支付宝转账</router-link>
                                <router-link to="/frame/yhkzz" class="tab tabactive">银行卡转账</router-link>
                                <!--<router-link to="/frame/jd" class="tab">京东支付</router-link>-->

                            </div>

                        </div>

                        <div id="subpagetp_bank" class="subcontent" style="display: block;">

                            <div class="subrow">

                                <div class="subcol1"></div>

                                <div class="subcol2"><img src="/static/images/bank/method1.jpg" width="533" height="114" alt=""></div>

                            </div>

                            <div class="subrow">

                                <div class="subcol1">支付帐户：</div>

                                <div id="bank-subcol" class="subcol2">
                                    <label data-v-a979b222="" class="banklist marginbtm10"><input data-v-a979b222="" type="radio" name="payId" checked value="1"  class="bankradiobtn"><span data-v-a979b222="" style="padding-right: 8px;    padding-left: 10px;
    line-height: 36px;">银行转账</span></label>
                                </div>

                            </div>

                            <div class="subrow">

                                <div class="subcol1"></div>

                                <div class="subcol2 blue"><span>温馨提示{{ShuaixuanhouArr3}}：</span> <span class="remark-text">转账成功后提供会员账号</span></div>
                            </div>
                            <div class="subrow margintop30">
                                <div class="subcol1"></div>
                                <div class="subcol2"><input type="button" @click="IsShowModel(1)" value="开始充值" class="c-button"></div>
                            </div>
                            <div class="el-dialog__wrapper" v-if="IsShow" style="z-index: 2001;"><div class="el-dialog el-dialog--small pay-dialog transfer-confirm" style="top: 15%;width: 700px !important;"><div class="el-dialog__header"><span class="el-dialog__title">订单信息</span></div><div class="el-dialog__body" style="width: 700px !important;"><div class="popupinternal order-submit2"><div class="col-left"><p>请转账至下列银行账户中：</p> <table class="table" style="height: 150px;"><tbody><tr><td colspan="3"></td></tr> <tr><td style="width: 60px;">姓名：</td> <td><input type="text" id="xm" readonly="readonly" v-model="Name" style="width: 200px;"></td> <td><span class="copy" @click="Copy">复制</span></td></tr> <tr><td>帐号：</td> <td><input type="text" v-model="zhanghao" readonly="readonly" style="width: 200px;"></td> <td><span class="copy" @click="Copy">复制</span></td></tr> </tbody></table><div class="three-second"><h4>存款信息</h4> <div class="post-info"><p>
                                存款金额：<input id="amount" v-model="CKJE" type="number" autocomplete="off" placeholder="单笔金额请不要支付整数"></p> <p><span>账号信息</span>：<input type="text" v-model="FKNC" placeholder="请您填写付款昵称"></p>  <p>
                                存款时间：<input type="text" v-model="NYR" value="" size="10" maxlength="10" style="width: 70px;"> <input size="2" maxlength="2" v-model="hour" type="text" style="width: 20px;">
                                时
                                <input type="text" v-model="minute" size="2" maxlength="2" style="width: 20px;">
                                分
                            </p>  </div></div> <div class="fullwidth"><div><div class="container"><input type="button" @click="IsShowModel(0)" value="取消订单" class="button" style="margin-right: 50px;"> <input type="submit" value="提交充值" @click="TJCZ" class="button"></div></div></div></div> <div class="col-right"><div class="jc-info"><h4>复制提示</h4> <p>浏览器不支持复制,点击“复制”后请使用Ctrl+C或者鼠标右键菜单</p></div>  </div></div></div></div></div>
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
        mounted(){
            this.getBankInfo()

            // 获取用户注单信息
            axios.get('/api/mobile/userrech/getUserRechCfgs').then(response => {


                this.zxczData = {
                    zxcz : response.data.rechCfgs
                }
                for(let item in this.zxczData.zxcz){
                    if(this.zxczData.zxcz[item].rechType === 'weixin'){
                        this.onlinePaymentArr.push(this.zxczData.zxcz[item])
                    }
                }
                console.log(this.onlinePaymentArr);
            })
        },
        data() {
            return {
                biduiArr: [],
                shaixuanArr: [],
                ShaixuanhouArr1: [],
                NowTime: "",
                Name: "沈豪日(慈溪城建支行)",
                zhanghao: "3901300501105985905",
                NYR: "",
                hour: "",
                minute: "",
                IsShow: false,
                CKJE: "",
                FKNC: ""
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
            ShaixuanhouArr2 () {
                let emptyArr = []
                for(let item in this.biduiArr){
                    if(this.biduiArr[item].code === 'weixin'){
                        emptyArr.push(this.biduiArr[item])
                    }
                }
                return emptyArr
            },
            ShuaixuanhouArr3 () {
                let emptyArr = []
                for(let item in this.ShaixuanhouArr1){
                    for(let item in this.ShaixuanhouArr2){
                        // if(this.ShaixuanhouArr1[item].onlineType === this.ShaixuanhouArr2[i].type){
                        emptyArr.push(this.ShaixuanhouArr1[item])
                    }
                    // }

                }

                // 数组排重
                function getFilterArray (array) {
                    const res = [];
                    const json = {};
                    for (let i = 0; i < array.length; i++){
                        const _self = array[i];
                        if(!json[_self]){
                            res.push(_self);
                            json[_self] = 1;
                        }
                    }
                    return res;
                }

                return getFilterArray(emptyArr)
            }
        },
        methods: {
            getBankInfo() {
                let step = 0
                // 取出信息比对信息(第一步)
                if (step === 0) {
                    // 获取在线充值比对信息
                    axios.get('/api/mobile/userrech/getOtherRechCfgs').then(response => {
                        this.biduiArr = response.data.onlineTypes
                    })
                    step++
                }

                // 取出需要筛选的信息(第二步) (并且筛出onlinePayment)
                if (step === 1) {
                    // 获取京东支付信息，获取筛选的信息 京东支付
                    axios.get('/api/mobile/userrech/getUserRechCfgs').then(response => {
                        this.shaixuanArr = response.data.rechCfgs
                        for(let item in this.shaixuanArr){
                            if(this.shaixuanArr[item].rechType === 'onlinePayment'){
                                this.ShaixuanhouArr1.push(this.shaixuanArr[item])
                            }
                        }
                    })
                    step ++
                }
            },

            IsShowModel(index) {
                if (index == 1) {
                    this.IsShow = true;
                    let Data = new Date();
                    let Year = Data.getFullYear();
                    let Month = Data.getMonth() + 1;
                    let Day = Data.getDate();
                    this.NYR = Year + "-" + Month + "-" + Day;
                    this.hour = Data.getHours();
                    this.minute = Data.getMinutes();
                } else if (index == 0) {
                    this.$confirm("确定要取消此笔订单吗？", "提示", {
                        confirmButtonText: "确定",
                        cancelButtonText: "取消",
                        type: "warning"
                    }).then(() => {
                        this.IsShow = false;
                    });
                }
            },
            TJCZ() {
                if (this.CKJE < 50 || this.CKJE > 50000) {
                    this.$confirm("存款金额在50元到50000元", "取消订单", {
                        confirmButtonText: "确定",
                        type: "error",
                        showCancelButton: false
                    });
                } else if (this.FKNC == "") {
                    this.$confirm("请输入用户姓名", "取消订单", {
                        confirmButtonText: "确定",
                        type: "error",
                        showCancelButton: false
                    });
                } else {
                    // 提交逻辑
                    axios.post('/web/pc/userCharge/save',{cfgId:29,realName:this.FKNC,rechMoney:this.CKJE,user_id:this.userId}).then(response => {
                        if(response.data.status === true) {
                            this.$alert(response.data.msg, '提示', {
                                confirmButtonText: '确定',
                                type: "success"
                            }).then(()=>{
                                this.IsShow = false;
                            });
                        }else{
                            this.$alert(response.data.msg, '提示', {
                                confirmButtonText: '确定',
                                type: "error"
                            }).then(()=>{
                                this.IsShow = false;
                            });
                        }
                    })
                    // console.log(this.CKJE)
                    // console.log(this.FKNC)
                }
            },
            // 复制
            Copy() {
            }
        }
    };
</script>

<style scoped>
    *{
        margin: 0;
        padding: 0;
    }

    .qqq {
        color: red;
    }
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

    .center-page blockquote,
    .center-page button,
    .center-page code,
    .center-page dd,
    .center-page div,
    .center-page dl,
    .center-page dt,
    .center-page fieldset,
    .center-page form,
    .center-page h1,
    .center-page h2,
    .center-page h3,
    .center-page h4,
    .center-page h5,
    .center-page h6,
    .center-page hr,
    .center-page img,
    .center-page input,
    .center-page legend,
    .center-page li,
    .center-page ol,
    .center-page p,
    .center-page pre,
    .center-page textarea,
    .center-page ul {
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
        height: 95px;

        position: relative;
    }

    .center-page .subcontent2 {
        padding-top: 35px;

        padding-bottom: 40px;

        border-top: 1px solid #93bdee;
    }

    .center-page .logo-th-2 {
        margin: 0 auto;

        width: 48px;

        height: 48px;

        background-position: 0 0;

        display: block;

        background-image: url(/static/images/iconwarning.jpg);
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

    .center-page .records table {
        width: 100%;

        border-collapse: collapse !important;
    }

    .center-page .records table th {
        padding: 10px 0;

        font-weight: lighter;

        border: 1px solid #777f89;

        background-color: #777f89;

        color: #fff;
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

    .center-page .records table td a:hover {
        text-decoration: underline;
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

    .center-page .ico-weixin {
        background: url(/static/images/bank/WEIXIN_s.jpg) no-repeat;

        width: 27px;

        height: 25px;

        margin-top: 3px !important;
    }

    /* 模态框样式 */
    .el-dialog__wrapper {
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        position: fixed;
        overflow: auto;
        margin: 0;
    }

    .el-dialog {
        position: absolute;
        left: 50%;
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        background: #fff;
        border-radius: 2px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
        margin-bottom: 50px;
    }

    .el-dialog__header {
        padding: 20px 20px 0;
    }

    .pay-dialog .el-dialog__title {
        background: #4274b3;
        color: #fff;
        padding: 6px 20px 8px 10px;
        line-height: 1.2;
        display: inline-block;
    }

    .transfer-confirm .el-dialog__body {
        padding: 10px 20px 40px;
    }

    .transfer-confirm .el-dialog__body {
        padding: 10px 20px 40px;
        color: #48576a;
        font-size: 14px;
    }

    .order-submit2 {
        width: 600px;
        color: #515861;
    }

    .popupinternal {
        overflow: visible;
        height: 100%;
        position: relative;
        padding: 0 10px;
    }

    .order-submit2 .col-left {
        width: 58%;
        float: left;
    }

    .order-submit2 p {
        padding-top: 10px;
    }

    .order-submit2 table {
        width: 99%;
        border-spacing: 5px;
        border: 1px solid #b9b9b9 !important;
        margin-top: 10px;
        margin-bottom: 20px;
        border-collapse: collapse;
        font-size: 14px;
    }

    .order-submit2 table tr:first-child {
        border-bottom: 1px solid #b9b9b9 !important;
    }

    .col-left .table tr {
        height: 35px;
    }

    .order-submit2 table tr td:first-child {
        width: 50px;
        text-align: right;
    }

    .order-submit2 table tr:first-child td {
        text-align: left;
    }

    .order-submit2 table tr td:last-child {
        width: 50px;
    }

    .popupinternal input {
        border: 0;
    }

    .order-submit2 table tr td:last-child {
        width: 50px;
    }

    .copy {
        color: #217eec;
        cursor: pointer;
    }

    .order-submit2 .three-second {
        width: 98%;
        border-radius: 3px;
        border: 1px solid #b9b9b9;
        overflow: visible;
        margin-top: 15px;
    }

    .order-submit2 .three-second h4 {
        width: 73px;
        font-size: 18px;
        color: #66c75c;
        margin-top: -15px;
        margin-left: 20px;
        background-color: #fff;
    }

    .order-submit2 .three-second p {
        padding: 3px 8px 6px;
    }

    .order-submit2 .three-second p input {
        border: 1px solid #dddfe2;
        width: 170px;
        height: 22px;
    }

    .order-submit2 .fullwidth {
        width: 100%;
    }

    .order-submit2 .fullwidth {
        width: 100%;
    }

    .button {
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
    }

    .order-submit2 .fullwidth .container {
        height: 100%;
        margin: 7px auto 0;
    }

    .order-submit2 .fullwidth .container input {
        margin-right: 0;
        cursor: pointer;
    }

    .order-submit2 .col-right {
        padding: 5px;
        width: 30%;
    }

    .jc-info {
        border-radius: 3px;
        border: 1px solid #b9b9b9;
        overflow: visible;
        margin-top: 48px;
        height: 82px;
    }

    .order-submit2 .col-right h4 {
        font-size: 16px;
        color: #66c75c;
        font-weight: lighter;
        padding-top: 0;
        margin-left: 10px;
        padding-bottom: 6px;
    }

    .order-submit2 .col-right p {
        font-size: 13px;
        margin-top: -15px;
        margin-left: 10px;
        line-height: 16px;
    }

    .order-submit2 .col-right .bank-info {
        width: 100%;
        height: 215px;
        border-radius: 3px;
        border: 1px solid #b9b9b9;
        overflow: visible;
        margin-top: 3px;
    }

    .bank-info img {
        margin-top: 20px;
        margin-left: 20px;
    }

    .center-page .ico-zfb[data-v-a979b222] {
        background: url(/static/images/bank/ZFB_s.jpg) no-repeat;
        width: 25px;
        height: 25px;
        margin-top: 3px !important;
    }
</style>