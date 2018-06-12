<template>
    <div class="header-top clearfix">
        <!--clearfix 清除了上面多出的部分-->
        <div class="logo2"><img src="/home/images/SS500LOGO.png" alt="最专业彩票网" class="logo-header"></div>
        <div class="menu1">
            <div class="draw_number">
                <div>{{gameName}}</div>
                <div><span class="cur_turn_num"><!--{{msscLmpOpenCodeData.expect}}-->{{expect}}</span>期开奖</div>
            </div>
            <div id="result_balls" v-if="isPk10game" class="T_PK10 L_BJPK10">
                <span v-for="item in openCodeClassName"><b class="T_PK10 L_BJPK10" :class="item">{{item}}</b></span>
            </div>
            <div id="result_balls" v-else class="T_SSC L_CQSSC">
                <span v-for="item in openCodeClassName"><b :class="item">{{item}}</b></span>
            </div>

                <!--<span><b class="T_PK10 L_BJPK10 b5">05</b></span><span><b-->
                    <!--class="T_PK10 L_BJPK10 b11">07</b></span><span><b class="T_PK10 L_BJPK10 b2">02</b></span><span><b-->
                    <!--class="T_PK10 L_BJPK10 b9">09</b></span><span><b class="T_PK10 L_BJPK10 b1">01</b></span><span><b-->
                    <!--class="T_PK10 L_BJPK10 b6">06</b></span><span><b class="T_PK10 L_BJPK10 b4">04</b></span><span><b-->
                    <!--class="T_PK10 L_BJPK10 b10">10</b></span><span><b class="T_PK10 L_BJPK10 b3">03</b></span><span><b-->
                    <!--class="T_PK10 L_BJPK10 b8">08</b></span>-->

            <div v-if="open" title="点击关闭提醒声音" class="open_sound" @click="handleSound()"></div>
            <div v-if="!open" title="点击开启提醒声音" class="close_sound" @click="handleSound()"></div>


        </div>
        <div class="menu2"><span><router-link to="/betList/unsettled" class=""
                                              @click.native="closeContSider()">未结明细</router-link>&nbsp;&nbsp;|</span>
            <span><router-link
                    to="/betList/settled" class=""
                    @click.native="closeContSider()">今天已结</router-link>&nbsp;&nbsp;|</span> <span><router-link
                    to="/frame/history" class="" @click.native="closeContSider()">开奖结果</router-link>&nbsp;&nbsp;|</span>
            <span><router-link to="/betReport" class="" @click.native="closeContSider()">历史报表</router-link></span> <br>
            <span><router-link to="/frame/userBetInfo"
                               class="" @click.native="closeContSider()">个人资讯</router-link>&nbsp;&nbsp;|</span>
            <span><router-link to="/frame/gameRule" class="" @click.native="closeContSider()">游戏规则</router-link>&nbsp;&nbsp;|</span> <span><router-link
                    to="/financial" @click.native="closeContSider()">充值记录</router-link>&nbsp;&nbsp;|</span>
            <span id="skinPanel">
                    更换皮肤
                    <ul style="margin-top:0px"><li><a href="javascript:void(0)" @click="change_skin_red()"><i
                            style="background: rgb(220, 47, 57);"></i>红色</a></li> <li><a
                            href="javascript:void(0)" @click="change_skin_blue()"><i
                            style="background: rgb(83, 130, 188);"></i>蓝色</a></li></ul></span></div>
        <div class="menu4">
            <a href="javascript:void(0);" class="support"></a>
        </div>
        <div class="menu3">
            <a href="javascript:void(0);" @click="logout()" class="logout">退出</a>
        </div>
    </div>

</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "header-top",
        data() {
            return {
                open: true,
                skin_blue: 'skin_blue',
                skin_red: 'skin_red'
            }
        },
        methods: {
            handleSound: function () {
                this.open = !this.open
                this.$store.dispatch('handleSoundAlways')
            },
            change_skin_red: function () {

                // 更换皮肤的时候,就可以监听到 这个最好放到配置项文件里面
                //window.frames[0].postMessage('change_skin_red', 'http:112.213.105.60:8002')
                // alert('红色')
                // alert(this.skin_red)
                this.$emit('child-info-for-skin', this.skin_red)
            },
            change_skin_blue: function () {

                // 更换皮肤的时候,就可以监听到 这个最好放到配置项文件里面
                //window.frames[0].postMessage('change_skin_blue', 'http:112.213.105.60:8002')
                // alert('蓝色')
                // alert(this.skin_blue)
                this.$emit('child-info-for-skin', this.skin_blue)
            },
            logout: function () {
                this.$confirm('确定退出系统吗？', '退出', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    //这里是我们写的东西
                    this.$store.dispatch('logoutRequest'),
                        location.href= '/'
                    //这里是我们写的东西
                    this.$message({
                        type: 'success',
                        message: '退出成功'
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: 'Delete canceled'
                    });
                });
                //和
                // this.$store.dispatch('logoutRequest')
                // location.href = '/'
            }
        },
        computed: {
            ...mapGetters({
                msscLmpOpenCodeData: 'getMsscLmpOpenCodeData',
                gameMap: 'getAllGames',
                currentGameCode: 'getCurrentGameCode',
                msscOpenCodeData: 'getMsscOpenCodeData',
                bjpk10OpenCodeData: 'getBjpk10OpenCodeData',
                msftOpenCodeData: 'getMsftOpenCodeData',
                mssscOpenCodeData: 'getMssscOpenCodeData',
                cqsscOpenCodeData: 'getCqsscOpenCodeData',
            }),

            // gameName: {
            //     get: function () {
            //         let gameMap = this.gameMap
            //         let currentGameCode = this.msscLmpOpenCodeData.code
            //         // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
            //         if (currentGameCode === 'mssc') {
            //             currentGameCode = 'jspk10'
            //         }
            //
            //         // return this.gameMap
            //         for(let item in gameMap) {
            //             // console.log(gameMap[item]['code'])
            //             if (gameMap[item].code === currentGameCode) {
            //                 // console.log(123)
            //                 return this.gameMap[item].name
            //             }
            //         }
            //     }
            // },
            // openCodeClassName: {
            //         get: function () {
            //             let emptyArr = []
            //             let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
            //             currentOpenCode.forEach(item => {
            //                 let empyItem = 'b' + item
            //                 emptyArr.push(empyItem)
            //             })
            //             return emptyArr
            //         }
            // }
            gameName: {
                get: function () {
                    let gameMap = this.gameMap
                    let currentGameCode = 'jspk10'
                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，




                    // alert(this.currentGameCode)
                    // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                    if (this.currentGameCode === 'jspk10') {
                        currentGameCode = 'jspk10' // vuex里面的值

                        let currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode') // 从localStorage里面取出的
                        if (currentGameCodeFromLocalStorage != null) {
                            currentGameCode = currentGameCodeFromLocalStorage
                        }

                    }
                    if (this.currentGameCode === 'pk10') {
                        currentGameCode = 'pk10'
                    }
                    if (this.currentGameCode === 'jsft') {
                        currentGameCode = 'jsft'
                    }
                    if (this.currentGameCode === 'jsssc') {
                        currentGameCode = 'jsssc'
                    }
                    if (this.currentGameCode === 'cqssc') {
                        currentGameCode = 'cqssc'
                    }
                    // return this.gameMap
                    for(let item in gameMap) {
                        // console.log(gameMap[item]['code'])
                        if (gameMap[item].code === currentGameCode) {
                             // alert(123)
                            return this.gameMap[item].name
                        }
                    }
                }
            },
            openCodeClassName: {
                get: function () {

                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                    let currentGameCode = 'jspk10'
                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，




                    // alert(this.currentGameCode)
                    // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                    if (this.currentGameCode === 'jspk10') {
                        currentGameCode = 'jspk10' // vuex里面的值

                        let currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode') // 从localStorage里面取出的
                        if (currentGameCodeFromLocalStorage != null) {
                            currentGameCode = currentGameCodeFromLocalStorage
                        }

                    }
                    if (this.currentGameCode === 'pk10') {
                        currentGameCode = 'pk10'
                    }
                    if (this.currentGameCode === 'jsft') {
                        currentGameCode = 'jsft'
                    }
                    if (this.currentGameCode === 'jsssc') {
                        currentGameCode = 'jsssc'
                    }
                    if (this.currentGameCode === 'cqssc') {
                        currentGameCode = 'cqssc'
                    }




                    switch (currentGameCode) {
                        case 'jspk10':
                            // alert('jspk10')
                            // console.log(this.msscOpenCodeData.opencode)
                            // this.msscOpenCodeData.opencode
                            let emptyArr = []
                            // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                            let currentOpenCode = this.msscOpenCodeData.opencode.split(',')
                            currentOpenCode.forEach(item => {
                                let empyItem = 'b' + parseInt(item)
                                emptyArr.push(empyItem)
                            })
                            return emptyArr


                            break
                        case 'pk10':
                            // alert('pk10')
                            let emptyArr2 = []
                            // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                            let currentOpenCode2 = this.bjpk10OpenCodeData.opencode.split(',')
                            currentOpenCode2.forEach(item => {
                                let empyItem2 = 'b' + parseInt(item)
                                emptyArr2.push(empyItem2)
                            })
                            return emptyArr2



                            break
                        case 'jsft':
                            let emptyArr3 = []
                            // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                            let currentOpenCode3 = this.msftOpenCodeData.opencode.split(',')
                            currentOpenCode3.forEach(item => {
                                let empyItem3 = 'b' + parseInt(item)
                                emptyArr3.push(empyItem3)
                            })
                            return emptyArr3
                            break
                        case 'jsssc':
                            let emptyArr4 = []
                            // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                            let currentOpenCode4 = this.mssscOpenCodeData.opencode.split(',')
                            currentOpenCode4.forEach(item => {
                                let empyItem4 = 'b' + parseInt(item)
                                emptyArr4.push(empyItem4)
                            })
                            return emptyArr4
                            break
                        case 'cqssc':
                            let emptyArr5 = []
                            // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                            let currentOpenCode5 = this.cqsscOpenCodeData.opencode.split(',')
                            currentOpenCode5.forEach(item => {
                                let empyItem5 = 'b' + parseInt(item)
                                emptyArr5.push(empyItem5)
                            })
                            return emptyArr5
                            break
                        // case 'lhc':
                        //     alert('lhc 香港六合彩还未开通')
                        //     this.$store.dispatch('setCurrentGameCode', 'lhc')
                        //     // this.$router.push({path: '/lhc/tema'})
                        //     break
                        // case 'xydd':
                        //     // alert('xydd')
                        //     this.$store.dispatch('setCurrentGameCode', 'xydd')
                        //     this.$router.push({path: '/xydd/xydd'})
                        //     break
                        // case 'xync':
                        //     this.$store.dispatch('setCurrentGameCode', 'xync')
                        //     alert('xync 幸运农场还未开通')
                        //     // this.$router.push({path: '/cqxync/lmp'})
                        //     break
                        // case 'xylhc':
                        //     this.$store.dispatch('setCurrentGameCode', 'xylhc')
                        //     alert('xylhc 幸运六合彩')
                        //     // this.$router.push({path: '/xylhc/tema'})
                        //     break
                        default:
                            alert('路由里面没有这个值，请查看routes/index')
                            break
                        // case ''
                    }







                }
            },
            expect: {
                get: function () {


                    // 从localStorage里面取currentGameCode出来
                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                    let currentGameCode = 'jspk10'
                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，




                    // alert(this.currentGameCode)
                    // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                    if (this.currentGameCode === 'jspk10') {
                        currentGameCode = 'jspk10' // vuex里面的值

                        let currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode') // 从localStorage里面取出的
                        if (currentGameCodeFromLocalStorage != null) {
                            currentGameCode = currentGameCodeFromLocalStorage
                        }

                    }
                    if (this.currentGameCode === 'pk10') {
                        currentGameCode = 'pk10'
                    }
                    if (this.currentGameCode === 'jsft') {
                        currentGameCode = 'jsft'
                    }
                    if (this.currentGameCode === 'jsssc') {
                        currentGameCode = 'jsssc'
                    }
                    if (this.currentGameCode === 'cqssc') {
                        currentGameCode = 'cqssc'
                    }

                    // 从localStorage里面取currentGameCode出来 end


                    switch (currentGameCode) {
                        case 'jspk10':
                            // alert('jspk10')
                            // console.log(this.msscOpenCodeData.opencode)
                            return this.msscOpenCodeData.expect
                            break
                        case 'pk10':
                            // alert('pk10')
                            return this.bjpk10OpenCodeData.expect
                            break
                        case 'jsft':
                            // alert('jsft')
                            // this.$store.dispatch('setCurrentGameCode', 'jsft')
                            // this.$router.push({path: '/msft/lmp'})
                            return this.msftOpenCodeData.expect
                            break
                        case 'jsssc':
                            // alert('jsssc')
                            return this.mssscOpenCodeData.expect
                            break
                        case 'cqssc':
                            console.log(this.cqsscOpenCodeData);
                            return this.cqsscOpenCodeData.expect
                            break
                        // case 'lhc':
                        //     alert('lhc 香港六合彩还未开通')
                        //     this.$store.dispatch('setCurrentGameCode', 'lhc')
                        //     // this.$router.push({path: '/lhc/tema'})
                        //     break
                        // case 'xydd':
                        //     // alert('xydd')
                        //     this.$store.dispatch('setCurrentGameCode', 'xydd')
                        //     this.$router.push({path: '/xydd/xydd'})
                        //     break
                        // case 'xync':
                        //     this.$store.dispatch('setCurrentGameCode', 'xync')
                        //     alert('xync 幸运农场还未开通')
                        //     // this.$router.push({path: '/cqxync/lmp'})
                        //     break
                        // case 'xylhc':
                        //     this.$store.dispatch('setCurrentGameCode', 'xylhc')
                        //     alert('xylhc 幸运六合彩')
                        //     // this.$router.push({path: '/xylhc/tema'})
                        //     break
                        default:
                            alert('路由里面没有这个值，请查看routes/index')
                            break
                        // case ''
                    }
                }
            },
            isPk10game: {
                get: function () {

                    // 从localStorage里面取currentGameCode出来
                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                    let currentGameCode = 'jspk10'
                    // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                    // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，




                    // alert(this.currentGameCode)
                    // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                    if (this.currentGameCode === 'jspk10') {
                        currentGameCode = 'jspk10' // vuex里面的值

                        let currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode') // 从localStorage里面取出的
                        if (currentGameCodeFromLocalStorage != null) {
                            currentGameCode = currentGameCodeFromLocalStorage
                        }

                    }
                    if (this.currentGameCode === 'pk10') {
                        currentGameCode = 'pk10'
                    }
                    if (this.currentGameCode === 'jsft') {
                        currentGameCode = 'jsft'
                    }
                    if (this.currentGameCode === 'jsssc') {
                        currentGameCode = 'jsssc'
                    }
                    if (this.currentGameCode === 'cqssc') {
                        currentGameCode = 'cqssc'
                    }

                    // 从localStorage里面取currentGameCode出来 end


                    switch (currentGameCode) {
                        case 'jspk10':
                            // alert('jspk10')
                            // console.log(this.msscOpenCodeData.opencode)
                            return true
                            break
                        case 'pk10':
                            // alert('pk10')
                            return true
                            break
                        case 'jsft':
                            // alert('jsft')
                            // this.$store.dispatch('setCurrentGameCode', 'jsft')
                            // this.$router.push({path: '/msft/lmp'})
                            return true
                            break
                        case 'jsssc':
                            // alert('jsssc')
                            return false
                            break
                        case 'cqssc':
                            // alert('cqssc')
                            return false
                            break
                        // case 'lhc':
                        //     alert('lhc 香港六合彩还未开通')
                        //     this.$store.dispatch('setCurrentGameCode', 'lhc')
                        //     // this.$router.push({path: '/lhc/tema'})
                        //     break
                        // case 'xydd':
                        //     // alert('xydd')
                        //     this.$store.dispatch('setCurrentGameCode', 'xydd')
                        //     this.$router.push({path: '/xydd/xydd'})
                        //     break
                        // case 'xync':
                        //     this.$store.dispatch('setCurrentGameCode', 'xync')
                        //     alert('xync 幸运农场还未开通')
                        //     // this.$router.push({path: '/cqxync/lmp'})
                        //     break
                        // case 'xylhc':
                        //     this.$store.dispatch('setCurrentGameCode', 'xylhc')
                        //     alert('xylhc 幸运六合彩')
                        //     // this.$router.push({path: '/xylhc/tema'})
                        //     break
                        default:
                            alert('路由里面没有这个值，请查看routes/index')
                            break
                        // case ''
                    }
                }
            }
        }
    }
</script>

<style scoped>
    /*全局样式*/
    .logo-header{
        margin-top: 12px;
        margin-left: 19px;
        height: 40px;
    }

    body {
        font: 12px/1.5 '\5FAE\8F6F\96C5\9ED1', '\5b8b\4f53', Arial, Helvetica, sans-serif;
        overflow-y: hidden
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
        zoom: 1
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    /*全局样式结束 将顶部固定在了左上角*/

    /*skin_blue skin_red公共样式*/

    .menu1 .draw_number {
        position: absolute;
        left: 15px;
        top: 5px;
    }

    .menu1 .draw_number div {
        height: 22px;
        line-height: 22px;
        text-align: center;
    }

    /*skin_blue skin_red公共样式结束*/

    /*skin_blue相关样式*/
    .skin_blue .header {
        background: #2060b3;
    }

    .skin_blue .header-top {
        background: url("/static/game/images/skin/blue/main_bg.jpg") no-repeat 0 0;
    }

    .skin_blue #skinPanel:hover .skin_blue .skinHover ul,
    .skin_blue #skinPanel:hover ul,
    .skin_blue .skinHover {
        background: #234b95;
    }

    .skin_blue .header .menu3 a {
        background-color: #2f97f7;
    }

    /*skin_blue相关样式结束*/

    /*头部相关样式*/
    #result_balls {
        position: absolute;
        left: 130px;
        top: 10px;
    }

    .menu1 a span {
        display: block;
        float: left;
    }

    .menu1 a b {
        display: block;
        width: 27px;
        height: 27px;
        font-size: 0;
        text-indent: -99999px;
        margin-top: 10px;
    }

    .menu1 a i {
        display: block;
        text-align: center;
        font-style: normal;
        font-weight: bolder;
        color: #fff;
    }

    .menu1 .T_PK10 b {
        margin: 15px 0 0 5px;
        height: 20px;
        background: url("/static/game/images/ball/ball-pk.png") no-repeat;
    }

    .menu1 .T_PK10 .b1 {
        background-position: 0 0;
    }

    .menu1 .T_PK10 .b2 {
        background-position: 0 -21px;
    }

    .menu1 .T_PK10 .b3 {
        background-position: 0 -42px;
    }

    .menu1 .T_PK10 .b4 {
        background-position: 0 -63px;
    }

    .menu1 .T_PK10 .b5 {
        background-position: 0 -84px;
    }

    .menu1 .T_PK10 .b6 {
        background-position: 0 -105px;
    }

    .menu1 .T_PK10 .b7 {
        background-position: 0 -126px;
    }

    .menu1 .T_PK10 .b8 {
        background-position: 0 -147px;
    }

    .menu1 .T_PK10 .b9 {
        background-position: 0 -168px;
    }

    .menu1 .T_PK10 .b10 {
        background-position: 0 -189px;
    }

    .menu1 span {
        display: block;
        float: left;
    }

    .menu1 b {
        display: block;
        height: 27px;
        margin-top: 10px;
        text-indent: -99999px;
        width: 27px;
    }

    .menu1 i {
        color: #fff;
        display: block;
        font-style: normal;
        font-weight: bolder;
        text-align: center;
    }

    .header .menu2 {
        line-height: 22px;
        font-size: 13px;
        position: absolute;
        left: 738px;
        top: 10px;
    }

    .header .menu2 span {
        padding: 0 5px;
    }

    .header .menu2 a {
        width: 5em;
    }

    .header .menu4 {
        position: absolute;
        left: 1050px;
        top: 20px;
    }

    .header .menu4 a {
        display: block;
        line-height: 22px;
        background-image: url("/static/game/images/support.png");
        width: 70px;
        height: 25px;
    }

    .header .menu3 {
        position: absolute;
        left: 1130px;
        top: 20px;
    }

    .header .menu3 a {
        display: block;
        line-height: 24px;
        width: 60px;
        height: 24px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        background: url("/static/game/images/logout.png") no-repeat 9px center;
        padding-left: 10px;
    }

    #skinPanel {
        display: inline-block;
        color: #fff;
        cursor: pointer;
    }

    #skinPanel ul {
        padding: 0 0 10px 0;
        margin-left: -5px;
        list-style: none;
        position: absolute;
        width: 62px;
        z-index: 999;
        display: none;
    }

    #skinPanel:hover ul {
        display: block;
    }

    #skinPanel ul li {
        padding: 2px 6px;
        height: 20px;
        line-height: 22px;
        clear: both;
    }

    #skinPanel li a {
        color: #ddd;
        text-align: center;
        vertical-align: middle;
    }

    #skinPanel li a:hover {
        color: #fff;
    }

    #skinPanel li i {
        display: inline-block;
        border: solid 1px #ffc8c8;
        height: 9px;
        width: 9px;
        vertical-align: middle;
        margin-right: 5px;
    }

    #skinPanel li a:hover i {
        border-color: #fff;
    }

    /*头部相关样式结束*/

    /*顶部声音开启 关闭图标*/
    .menu1 .open_sound {
        position: absolute;
        right: 10px;
        top: 5px;
        background: url(/static/game/images/sound.png) no-repeat;
        display: block;
        float: right;
        width: 16px;
        height: 16px;
        cursor: pointer;
        z-index: 99;
    }

    .menu1 .close_sound {
        position: absolute;
        right: 10px;
        top: 5px;
        background: url(/static/game/images/sound-close.png) no-repeat;
        display: block;
        width: 16px;
        height: 16px;
        cursor: pointer;
        z-index: 99;
    }

    /*后来加上的*/

    .skin_red #skinPanel:hover ul {
        background: #832c3c;
    }

    .skin_red .header .menu3 a {
        background-color: #751d28;
    }


    .menu1 .T_SSC b {
        margin-left: 10px;
        background: url(/static/game/images/ball/ball_2.png) no-repeat

    }


    .menu1 .T_SSC .b0 {
        background-position: 0 0
    }

    .menu1 .T_SSC .b1 {
        background-position: 0 -27px
    }

    .menu1 .T_SSC .b2 {
        background-position: 0 -54px
    }

    .menu1 .T_SSC .b3 {
        background-position: 0 -81px
    }

    .menu1 .T_SSC .b4 {
        background-position: 0 -108px
    }

    .menu1 .T_SSC .b5 {
        background-position: 0 -135px
    }

    .menu1 .T_SSC .b6 {
        background-position: 0 -162px
    }

    .menu1 .T_SSC .b7 {
        background-position: 0 -189px
    }

    .menu1 .T_SSC .b8 {
        background-position: 0 -216px
    }

    .menu1 .T_SSC .b9 {
        background-position: 0 -243px
    }

    .menu1 b {
        display: block;
        height: 27px;
        margin-top: 10px;
        text-indent: -99999px;
        width: 27px;
    }


</style>