<template>
    <div>
        <!--{{authenticated}}-->
        <div style="position: absolute; top: 30%;">
            <Loading v-show="loading"></Loading>
        </div>
        <mainBodyOuter></mainBodyOuter>
    </div>

    <!--<div class="el-notification win-popup skin_blue" style="bottom: 56px; z-index: 2016;">&lt;!&ndash;&ndash;&gt;-->
        <!--<div class="el-notification__group"><h2 class="el-notification__title">中奖通知</h2>-->
            <!--<div class="el-notification__content">-->
                <!--<div><p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第二球 单 已中奖, 中奖金额 <span-->
                        <!--style="color: rgb(224, 79, 76);">1.00</span></p>-->
                    <!--<p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第二球 小 已中奖, 中奖金额 <span-->
                            <!--style="color: rgb(224, 79, 76);">4975.00</span></p>-->
                    <!--<p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第一球 0 已中奖, 中奖金额 <span-->
                            <!--style="color: rgb(224, 79, 76);">8.95</span></p>-->
                    <!--<p><span class="t-qi">秒速时时彩</span> 第 180327639 期 总和小 已中奖, 中奖金额 <span-->
                            <!--style="color: rgb(224, 79, 76);">1.00</span></p>-->
                    <!--<p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第三球 小 已中奖, 中奖金额 <span-->
                            <!--style="color: rgb(224, 79, 76);">4975.00</span></p>-->
                    <!--<p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第四球 大 已中奖, 中奖金额 <span-->
                            <!--style="color: rgb(224, 79, 76);">1.00</span></p>-->
                    <!--<p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第三球 小 已中奖, 中奖金额 <span-->
                            <!--style="color: rgb(224, 79, 76);">1.00</span></p></div>-->
            <!--</div>-->
            <!--<div class="el-notification__closeBtn el-icon-close"></div>-->
        <!--</div>-->
    <!--</div>-->
</template>

<style>
    .el-notification__title {
        background: #4274b3;
        padding: 3px 15px;
        display: inline-block;
        font-size: 16px;
        color: #FFFFFF;
    }
    .t-qi{
        color: #2060b3;
    }
</style>
<script>


    import mainBodyOuter from './parts/mainBodyOuter.vue'
    import Loading from './../common/loading/Loading.vue' // 引入Loading

    //为读取cookie而引入的插件

    import Cookie from 'js-cookie'
    import jwtToken from './../../helpers/jwt'

    import {mapGetters} from 'vuex'

    export default {
        data() {
            return {
                getPlayCatesOuter: {
                    getPlayCates: {},
                },
                getPlaysOuter: {
                    getPlays: {},
                },
                getGameMapOuter: {
                    getGameMap: {},
                },
                winData: {},   //开奖中奖数据
            }
        },
        name: "game",
        components: {
            mainBodyOuter,
            Loading
        },
        methods: {
            getData: function () {
                let _this = this
                window.axios.get('/static/gamedatas.js')
                    .then(function (response) {
                        // 获取数据
                        let str = response.data
                        // 将数据切割成数组
                        let strs = str.split(";")
                        // let gamesArray = strs[0].slice(13,-1).split(",")
                        // for (let i = 0; i < gamesArray.length; i++) {
                        //     _this.getGameDatas.games[i] = gamesArray[i]
                        // }
                        // _this.getGameDatas.gameMap      = JSON.parse(strs[1].slice(15))
                        // _this.getGameDatas.playCates    = JSON.parse(strs[2].slice(17))
                        // _this.getGameDatas.plays        = JSON.parse(strs[3].slice(13))
                        // _this.getGameDatas.playComs     = JSON.parse(strs[4].slice(16))
                        // _this.getGameDatas.animalsYear  = strs[5].slice(20,-1)
                        // console.log(strs[2].slice(17));
                        // 游戏数据
                        // 标题数据
                        _this.getPlayCatesOuter.getPlayCates = JSON.parse(strs[2].slice(17))
                        // input数据
                        _this.getPlaysOuter.getPlays = JSON.parse(strs[3].slice(13))

                        //console.log(_this.getPlayCates)


                    }).then(
                    // console.log(JSON.stringify(_this.getGameDatas))


                    // 将标题数据存入
                    this.$store.dispatch('getPlayCatesFromGameDatas', {getPlayCatesFromGameDatas: _this.getPlayCatesOuter}),

                    // 将input数据存入
                    this.$store.dispatch('getPlaysFromGameDatas', {getPlaysFromGameDatas: _this.getPlaysOuter}),

                    // console.log(_this.getPlaysOuter)
                    // this.$store.dispatch('getGameDatas',{ getGameDatas: _this.getGameDatas })
                )

                setTimeout(() => {
                    _this.$store.dispatch('hideLoading')
                }, 500)
            },

            getOpenCodeData() {
                let _this= this;
                // 获取所有的数据
                // 秒速赛车

                window.axios.get("/api/getMssc").then(function (response) {

                    let _data = JSON.parse(response.data);
                    // 将数据存入vuex
                    _this.$store.dispatch('storeMsscOpenCodeData', {openCode: _data})
                }).catch(function (error) {
                    console.log(error);
                })

                // 北京赛车

                window.axios.get("/api/getBjpk10").then(function (response) {

                    let _data = response.data
                    // 将数据存入vuex 北京pk10与重庆时时彩是官方的接口，数据有点不一样
                    _this.$store.dispatch('storeBjpk10OpenCodeData', {openCode: _data})
                }).catch(function (error) {
                    console.log(error);
                })

                // 秒速飞艇

                window.axios.get("/api/getMsft").then(function (response) {

                    let _data = JSON.parse(response.data);
                    // 将数据存入vuex
                    _this.$store.dispatch('storeMsftOpenCodeData', {openCode: _data})
                }).catch(function (error) {
                    console.log(error);
                })

                //　秒速时时彩

                window.axios.get("/api/getMsssc").then(function (response) {

                    let _data = JSON.parse(response.data);
                    // 将数据存入vuex
                    _this.$store.dispatch('storeMssscOpenCodeData', {openCode: _data})
                }).catch(function (error) {
                    console.log(error);
                })

                // 重庆时时彩

                window.axios.get("/api/getCqssc").then(function (response) {
                    let _data = response.data;
                    // 将数据存入vuex
                    _this.$store.dispatch('storeCqsscOpenCodeData', {openCode: _data})
                }).catch(function (error) {
                    console.log(error);
                })

            }

        },
        mounted() {

            let _this = this

            // 之后所有获取数据的地方都放在Game.vue里面进行，然后取什么数据，就用currentGameCode来决定
            this.getOpenCodeData()

            this.getData()

            this.$store.dispatch('showLoading')

            // /接收开奖信息/
            _this.socket.on('open-channel', function (data) {
                _this.$store.dispatch('setOpenCodeSoundToTrue')   //  只有后台推送数据过来时才会响应
                // console.log(typeof (data));
                _this.winData = data;



                //校验挡前用户是否有中奖，   若有调用中奖通知组件

                console.log(_this.winListWithGoodsName)
                if (_this.winListWithGoodsName != "") {
                    _this.$notify({
                        title: '中奖通知',
                        message: _this.winListWithGoodsName,
                        position: 'bottom-right',
                        duration: 5000,
                        dangerouslyUseHTMLString: true,
                    })
                }


                _this.$store.dispatch('setOpenCodeSoundToTrue')   //  只有后台推送数据过来时才会响应
                // console.log(data)
                switch (data.code) {
                    case 'mssc':
                        // alert(data.issue)
                        // console.log(_this)
                        _this.$store.dispatch('storeMsscOpenCodeData', {openCode: data})
                        break
                    case 'bjpk10':
                        // alert('bjpk10')
                        _this.$store.dispatch('storeBjpk10OpenCodeData', {openCode: data})
                        break
                    case 'msft':
                        // alert('msft')
                        _this.$store.dispatch('storeMsftOpenCodeData', {openCode: data})
                        break
                    case 'msssc':
                        // alert('msssc')
                        _this.$store.dispatch('storeMssscOpenCodeData', {openCode: data})
                        break
                    case 'cqssc':
                        // alert('cqssc')
                        _this.$store.dispatch('storeCqsscOpenCodeData', {openCode: data})
                        break
                    // case 'lhc':
                    //     alert('lhc 香港六合彩还未开通')
                    //     // this.$router.push({path: '/lhc/tema'})
                    //     break
                    // case 'xydd':
                    //     // alert('xydd')
                    //     this.$router.push({path: '/xydd/xydd'})
                    //     break
                    // case 'xync':
                    //     alert('xync 幸运农场还未开通')
                    //     // this.$router.push({path: '/cqxync/lmp'})
                    //     break
                    // case 'xylhc':
                    //     alert('xylhc 幸运六合彩')
                    //     // this.$router.push({path: '/xylhc/tema'})
                    //     break
                    default:
                        alert('在最外层的Game.vue里面的switch case里面，code没有这个值，修改那里面的case')
                        break
                    // case ''
                }
            });
        },
        computed: {
            ...mapGetters({
                loading: 'loading',
                plays: 'getMspk10LmpPlays',
                playCates: 'getMspk10LmpPlayCates',
                currentGameCode: 'getCurrentGameCode',
                gameMap:'getAllGames',
                userName: 'getUserName'
                // authenticated: 'getAuthenticated'
            }),
            winListWithGoodsName() {




                let _this = this

                // return _this.winData.winner
                // 通过id获取名字，通过playCateId获取第二个参数
                // return this.plays
                let emptyArr = []
                //
                // this.cartList.forEach(cartItem => {
                //     for(let item in this.plays) {
                //         // console.log(item)
                //         if(item == cartItem.id){
                //             this.plays[item].count = cartItem.count
                //             emptyArr.push(this.plays[item])
                //         }
                //     }
                // })

                // 存在于vuex里面的，只存id，之后需要什么数据，就取出什么数据

                // //1. 将相关的信息从plays里面取出
                //
                // this.cartList.forEach(cartItem => {
                //     for(let item in this.plays) {
                //         // console.log(item)
                //         if(item === cartItem.id){
                //             cartItem.name         = this.plays[item].name
                //             cartItem.playCateId   = this.plays[item].playCateId
                //             cartItem.odds         = this.plays[item].odds
                //             cartItem.rebate       = this.plays[item].rebate
                //             cartItem.minMoney     = this.plays[item].minMoney
                //             cartItem.maxMoney     = this.plays[item].maxMoney
                //             cartItem.maxTurnMoney = this.plays[item].maxTurnMoney
                //
                //         }
                //     }
                // })
                //
                // //2. 将相关的信息(playCate 的名字)从playCates里面取出
                // this.cartList.forEach(cartItem => {
                //     for(let item in this.playCates) {
                //         // console.log(item)
                //         if(item === cartItem.playCateId){
                //             cartItem.playCatesName        = this.playCates[item].name
                //             // console.log(cartItem)
                //         }
                //     }
                // })
                //
                // //3. 将名字组合起来
                // this.cartList.forEach(cartItem => {
                //     if(cartItem.playCateId === 1) {
                //         cartItem.goodsName = cartItem.name
                //     } else {
                //         cartItem.goodsName = cartItem.playCatesName + ' ' + cartItem.name
                //     }
                // })
                //
                //4.将cart中的信息存入emptyArr
                // this.cartList.forEach(cartItem => {
                //     emptyArr.push(cartItem)
                // })

                // 将前面四步的内容合并在一起，这里特别要注意for循环是并行的要用if把这些for循环连接起来



                let step = 0

                let emptyArrUserName = []

                _this.winData.winer.forEach(item => {
                    if(item.user === this.userName){
                        emptyArrUserName.push(item)
                    }
                })

                // 通过userName筛选中奖信息



                emptyArrUserName.forEach(winDataItem => {
                    // console.log(123)
                    if (step === 0) {
                        for (let item in _this.plays) {
                            // console.log(item)

                            //1. 将相关的信息从plays里面取出
                            if (item == winDataItem.gameId) {
                                winDataItem.gameId = this.plays[item].gameId
                                winDataItem.name = this.plays[item].name
                                winDataItem.playCateId = this.plays[item].playCateId
                                winDataItem.odds = this.plays[item].odds
                                winDataItem.rebate = this.plays[item].rebate
                                winDataItem.minMoney = this.plays[item].minMoney
                                winDataItem.maxMoney = this.plays[item].maxMoney
                                winDataItem.maxTurnMoney = this.plays[item].maxTurnMoney
                                // console.log(cartItem)

                            }
                        }
                        step++
                    }

                    if (step === 1) {
                        //2. 将相关的信息(playCate 的名字)从playCates里面取出
                        for (let item in _this.playCates) {
                            // console.log(item)
                            if (item == winDataItem.playCateId) {
                                winDataItem.playCatesName = this.playCates[item].name
                                winDataItem.playCateNameId = this.playCates[item].id
                                // console.log(cartItem)
                            }
                        }
                        step++
                    }

                    if (step === 2) {

                        // console.log(cartItem.playCateNameId)
                        // 这里需要如果名字是总和-龙虎和，那么需要playCateName不用加上
                        if (winDataItem.playCateNameId === 1) {
                            winDataItem.goodsName = winDataItem.name
                        } else {
                            winDataItem.goodsName = winDataItem.playCatesName + ' - ' + winDataItem.name
                        }
                        step++

                    }

                    // 根据gameId取出gameName

                    if (step  == 3) {
                        for (let item in _this.gameMap) {
                            //1. 将相关的信息从plays里面取出
                            if (item == winDataItem.gameId) {
                                winDataItem.gameName = _this.gameMap[item].name
                                // console.log(cartItem)

                            }

                        }

                        winDataItem.currentGameCode = this.currentGameCode
                        step ++
                    }

                    if (step === 4) {
                        //4.将cart中的信息存入emptyArr


                        emptyArr.push(winDataItem)
                        //最后一步将step清0
                        step = 0
                    }

                })

                // console.log(_this.emptyArr)
                // console.log(step)
                //_this.winData = emptyArr;
                // return emptyArr;
                let nullStr = ''

                emptyArr.forEach(item => {
                    nullStr += '\<p\>\<span class="t-qi"\> ' + item.gameName + '\ </span\> 第 <span style="color: #0c325e">' + this.winData.expect + '</span> 期 ' + item.goodsName + ' 已中奖, 中奖金额 \<span style="color: rgb(224, 79, 76);"\>' + item.money + '\</span\>\</p\>'
                    nullStr =  '\<div\>' + nullStr + '\</div\>'
                })

                return nullStr


                // 在这里组拼 消息通知
                // 名字之后再在gameDatas里面取出来。这里我们先直接从currentCode里面取出


            // <div><p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第二球 单 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">1.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第二球 小 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">4975.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第一球 0 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">8.95</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 总和小 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">1.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第三球 小 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">4975.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第四球 大 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">1.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第三球 小 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">1.00</span></p></div>
            //     </div>



            }

        },
        // 开始进行登录注册的状态管理

        created() {


            // alert(Cookie.get('token'))
            // let token = this.$cookie.get('laravel_session');
            // console.log("Token"+token);

            // 如果localStorage里面没有的话，就要refreshToken,来存这个token

            this.$store.dispatch('setAuthUser')


            // console.log(Cookie.get('XSRF-TOKEN'));

            // if (jwtToken.getToken()) {
            //     this.$store.dispatch('setAuthUser')
            // // } else if(Cookie.get('auth_id')) {
            // } else if(Cookie.get('user_id')) {
            //     this.$store.dispatch('refreshToken')
            // }


        }
    }
</script>
