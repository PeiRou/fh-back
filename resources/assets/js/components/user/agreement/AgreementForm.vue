<template>
    <div class="skin_blue" style="height: 100%">
        <div class="user_win">
            <div class="agree_win">
                <div class="user_logo"></div>
                <ul>
                    <li class="user_wintitle">用户协议</li>
                    <li class="user_winmain">
                        <div class="win_info">
                            <ul>
                                <li>● 01. 使用本公司网站的客户，请留意阁下所在的国家或居住地的相关法律规定，如有疑问应就相关问题，寻求当地法律意见。</li>
                                <li>● 02.
                                    若发生遭黑客入侵破坏行为或不可抗拒之灾害导致网站故障或资料损坏、资料丢失等情况，我们将以本公司之后备资料为最后处理依据；为确保各方利益，请各会员投注后打印资料。本公司不会接受没有打印资料的投诉。
                                </li>
                                <li>● 03.
                                    为避免纠纷，各会员在投注之后，务必进入下注明细检查及打印资料。若发现任何异常，请立即与代理商联系查证，一切投注将以本公司资料库的资料为准，不得异议。如出现特殊网络情况或线路不稳定导致不能下注或下注失败。本公司概不负责。
                                </li>
                                <li>● 04. 开奖结果以官方公布的结果为准。</li>
                                <li>● 05. 如遇到官方停止销售或者开奖结果不确定的情况，本公司将对相关注单进行无效处理，并且返还下注本金。</li>
                                <li>● 06.
                                    我们将竭力提供准确而可靠的开奖统计等资料，但并不保证资料绝对无误，统计资料只供参考，并非是对客户行为的指引，本公司也不接受关于统计数据产生错误而引起的相关投诉。
                                </li>
                                <li>● 07.
                                    本公司拥有一切判决及注消任何涉嫌以非正常方式下注之权利，在进行更深入调查期间将停止发放与其有关之任何彩金。客户有责任确保自己的帐户及密码保密，如果客户怀疑自己的资料被盗用，应立即通知本公司，并须更改其个人详细资料。所有被盗用帐号之损失将由客户自行负责。
                                </li>
                                <li>管理层 敬啟</li>
                                <li>我了解以及同意下注列明的协定和规则。</li>
                                <li class="user_winbu">
                                    <div><span><a class="yes" href="javascript:void(0)" id="yesBtn"
                                                  @click="agree()">同意</a><a class="no"
                                                                            href="javascript:cancel();">不同意</a></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="user_winfooter"></li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "agreement-form",
        methods: {
            agree() {
                // alert(1);
                this.$router.push({path: 'game'})
            }
        }
    }
</script>

<style scoped>

    /*全局公共css*/
    body {
        height: 100%;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #313131;
        margin: 0;
        padding: 0;
        /*默认是红色背景*/
        /*原网站同意页面没有红色背景的图片*/
        /*background: #b44851 url("/static/game/images/skin/red/user_bgpic.png") repeat-x left top;*/
    }

    div, form, img, ul, ol, li, dl, dt, dd {
        margin: 0;
        padding: 0;
        border: 0;
        list-style: none;
        overflow: hidden;
    }

    a {
        text-decoration: none;
    }

    /*全局公共css结束*/

    /*agreement部分*/

    .agree_win {
        width: 778px;
        margin: 20px auto;
    }

    .user_logo {
        width: 210px;
        height: 45px;
    }

    /*agreement部分结束*/

    /*==== skin_blue 与　skin_red 的公共部分　=*/
    .user_win {
        width: 100%;
    }

    .user_wintitle {
        width: 100%;
        height: 51px;
        font-size: 20px;
        font-weight: bold;
        line-height: 50px;
        color: white;
        text-align: center;
    }

    .user_winmain {
        width: 100%;
    }

    .win_info {
        width: 770px;
    }

    .user_winmain ul {
        padding: 20px 40px;
    }

    .user_winmain li {
        line-height: 15px;
        margin: 0 0 10px 0;
    }

    .user_winbu div {
        border-top: 1px solid #d3d1d1;
        padding: 20px 0;
        margin: 30px 0 0 0;
    }

    .user_winbu span {
        display: block;
        width: 250px;
        margin: 0 auto;
    }

    .user_winbu a {
        display: block;
        width: 66px;
        height: 33px;
        line-height: 27px;
        font-size: 14px;
        color: white;
        font-weight: bold;
        text-align: center;
        margin: 0 0 0 30px;
        float: left;
    }

    .user_winbu a:hover {
        background-position: left -33px;
        color: yellow;
    }

    .user_winfooter {
        width: 100%;
        height: 20px;

    }

    /*==== skin_blue 与　skin_red 的公共部分　结束　=*/

    /*==== skin_blue =*/
    .skin_blue {
        background: #5a8fd4 url("/static/game/images/skin/blue/user_bgpic.png") repeat-x left top;
    }

    .skin_blue .user_win {
        background: url("/static/game/images/skin/blue/user_background.jpg") no-repeat center top;
    }

    .skin_blue .user_wintitle {
        background: url("/static/game/images/skin/blue/user_win.png") no-repeat left top;
    }

    .skin_blue .user_winmain {
        background: url("/static/game/images/user_winshadow.png") repeat-y right top;
    }

    .skin_blue .win_info {
        background: white url("/static/game/images/skin/blue/user_bgwin.png") repeat-x left top;
    }

    .skin_blue .user_winbu a {
        background: url("/static/game/images/skin/blue/tab3.png");
    }

    .skin_blue .user_winfooter {
        background: url("/static/game/images/skin/blue/user_win.png") no-repeat left bottom;
    }

    /*==== skin_blue 结束=*/


</style>