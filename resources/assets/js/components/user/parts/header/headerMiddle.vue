<template>
    <div class="header-middle lotterys">

        <!--{{headerMiddle}}-->
        <!--{{orderedHeaderMiddle}}-->
        <!--<div style="color: #000">{{ headerMiddleOrder }}</div>-->
        <!--<div style="color: #000;" v-for="(item, index) in headerMiddle">{{item}}</div>-->
        <!--<div style="color: #000;" v-for="(item, index) in orderedHeaderMiddle">{{item.name}}</div>-->

        <div class="show">
            <!--{{orderedHeaderMiddleData}}-->
            <!--外层的分类-->
            <!--<a href="javascript:void(0)" class="" v-for="(item,index) in orderedHeaderMiddle" :class="{ selected: changeSelected === index }" v-if="index<=4" @click="changeHeaderBottom(item.code,index)"><span>{{item.name}}</span> <i class="editbtn" style="display: none;"></i></a>-->

          <!--测试只用，前面5个，之后需要打开的-->
          <a href="javascript:void(0)" class="" v-for="(item,index) in orderedHeaderMiddle" :class="{ selected: changeSelected === index }" v-if="index<=4" @click="changeHeaderBottom(item.code,index)"><span>{{item.name}}</span> <i class="editbtn" style="display: none;"></i></a>
          <!--测试只用，前面5个，之后需要打开的结束-->


            <!--<a href="javascript:void(0)" class="selected" @click="changeHeaderBottomToMspk10()"><span>秒速赛车</span> <i class="editbtn" style="display: none;"></i></a>-->
            <!--<a href="javascript:void(0)" class="" @click="changeHeaderBottomToBjpk10()"><span>北京赛车(PK10)</span> <i class="editbtn" style="display: none;"></i></a>-->
            <!--<a href="javascript:void(0)" class="" @click="changeHeaderBottomToFtpk10()"><span>秒速飞艇</span> <i class="editbtn" style="display: none;"></i></a>-->
            <!--<a href="javascript:void(0)" class="" @click="changeHeaderBottomToＭsssc()"><span>秒速时时彩</span> <i class="editbtn" style="display: none;"></i></a>-->
            <!--<a href="javascript:void(0)" class="" @click="changeHeaderBottomToCqssc()"><span>重庆时时彩</span> <i class="editbtn" style="display: none;"></i></a>-->
            <!--<a href="javascript:void(0)" class="" @click="changeHeaderBottomToXydd()"><span>幸运蛋蛋</span> <i class="editbtn" style="display: none;"></i></a>-->
            <!--<a href="javascript:void(0)" class="" @click="changeHeaderBottomToXglhc()"><span>香港六合彩</span> <i class="editbtn" style="display: none;"></i></a>-->
            <!--<a href="javascript:void(0)" class="" @click="changeHeaderBottomToCqxync()"><span>重庆幸运农场</span> <i class="editbtn" style="display: none;"></i></a>-->
            <!--<a href="javascript:void(0)" class="" @click="changeHeaderBottomToXylhc()"><span>幸运六合彩</span> <i class="editbtn" style="display: none;"></i></a>-->
        </div>

      <!--更多游戏，之后需要打开的-->

        <!--<div class="more-game">-->
            <!--<a href="javascript:void(0);"><span><i class="currentGameTxt" v-text="html">更多游戏</i> ▼</span></a>-->
            <!--<div class="more-game-drop" style="">-->
                <!--<div class="gamebox">-->
                    <!--&lt;!&ndash;内层的分类&ndash;&gt;-->
                    <!--<a href="javascript:void(0)" class="" v-for="(item,index) in orderedHeaderMiddle" v-if="index > 8 && index < 17"-->
                       <!--@click="changeHeaderBottomMore(item.code, index)" :class="{ selected: changeMore === index }"><span>{{item.name}}</span>-->
                        <!--<i class="editbtn" style="display: none;"></i></a>-->

        <!--更多游戏，之后需要打开的结束-->

                  <!--循环的更多的部分-->

                    <!--<a href="javascript:void(0)" @click="changeHeaderBottomToPcdd()"><span>PC蛋蛋</span> <i class="editbtn" style="display: none;"></i></a>-->
                    <!--<a href="javascript:void(0)" @click="changeHeaderBottomToGd11x5()"><span>广东11选5</span> <i class="editbtn" style="display: none;"></i></a>-->
                    <!--<a href="javascript:void(0)" @click="changeHeaderBottomToJssb()"><span>江苏骰宝(快3)</span> <i class="editbtn"-->
                    <!--style="display: none;"></i></a>-->
                    <!--<a href="javascript:void(0)" @click="changeHeaderBottomToBjkl8()"><span>北京快乐8</span> <i class="editbtn" style="display: none;"></i></a>-->
                    <!--<a href="javascript:void(0)" @click="changeHeaderBottomToGdklsf()"><span>广东快乐十分</span> <i class="editbtn" style="display: none;"></i></a>-->
                    <!--<a href="javascript:void(0)" @click="changeHeaderBottomToXjssc()"><span>新疆时时彩</span> <i class="editbtn" style="display: none;"></i></a>-->
                  <!--循环的更多的部分-->

                  <!--更多游戏，之后需要打开的-->
                <!--</div>-->
                <!--<p>注：编辑模式下已选择的彩种可通过鼠标拖动改变排列顺序。</p>-->
                <!--<div class="actions">-->
                    <!--<a href="javascript:void(0);" class="actionBtn action-cancel" style="display: none;">取消</a>-->
                    <!--&nbsp; &nbsp;-->
                    <!--<a href="javascript:void(0);" class="actionBtn action-edit">编辑</a>-->
                    <!--<a href="javascript:void(0);" class="actionBtn action-edit" style="display: none;">确定</a>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
      <!--更多游戏，之后需要打开的结束-->


    </div>
</template>

<script>
    import { mapGetters } from 'vuex'


    export default {
        name: "header-top",
        //向mainBodyOuter父组件传递数据
        data() {
            return {
                // msgChild: 'child',
                // msgMspk10: 'Mspk10',
                // msgBjpk10: 'Bjpk10',
                // msgFtpk10: 'Ftpk10',
                // msgMsssc: 'Msssc',
                // msgCqssc: 'Cqssc',
                // msgXydd: 'Xydd',
                // msgXglhc: 'Xglhc',
                // msgCqxync: 'Cqxync',
                // msgXylhc: 'Xylhc',
                // msgXykl8: 'Xykl8',
                // msgPcdd: 'Pcdd',
                // msgGd11x5: 'Gd11x5',
                // msgJssb: 'Jssb',
                // msgBjkl8: 'Bjkl8',
                // msgGdklsf: 'Gdklsf',
                // msgXjssc: 'Xjssc',

                // 顶部选中效果
                changeSelected: 0,
                html: '更多游戏',
                changeMore: 0,
                orderedHeaderMiddleData: [],

                // 获取头部中间信息
                getGamesOuter:{
                    getGames: "" // 头部中间的顺序
                },
                getGameMapOuter:{
                    getGameMap: {} // 头部中间的信息
                },
                getOrderedHeaderMiddleOuter:{
                    getOrderedHeaderMiddle: []
                }



            }
        },
        computed: {
            ...mapGetters({
            headerMiddle: 'getAllGames',
            // headerMiddleOrderStr: 'getGamesOrderStr',
            headerMiddleOrderStr: 'getHeaderMiddleOrderStr',
            orderedHeaderMiddle: 'getOrderedHeaderMiddle'
            }),

            // headerMiddleOrderArray: function () {
            //     this.orderedHeaderMiddleString = this.orderedHeaderMiddle
            //     return orderedHeaderMiddleString.split(",")
            // }
        },
        methods: {
            getHeaderTopInfoFromHeaderMiddleActive () {

                let getDataAccordingToHeaderMiddle =  window.localStorage.getItem('headerMiddleActive')

                switch (getDataAccordingToHeaderMiddle) {
                    case '0':
                        window.axios.get("/api/getMssc").then(function (response) {
                            var _data = JSON.parse(response.data);
                            // 将数据存入vuex
                            // _this.$store.dispatch('storeMsscLmpOpenCodeData', {openCode: _data})
                            _this.$store.dispatch('storeMsscOpenCodeData', {openCode: _data})
                        }).catch(function (error) {
                            console.log(error);
                        });
                        break
                    case '1':
                        window.axios.get("/api/getMssc").then(function (response) {
                            var _data = JSON.parse(response.data);
                            // 将数据存入vuex
                            // _this.$store.dispatch('storeMsscLmpOpenCodeData', {openCode: _data})
                            _this.$store.dispatch('storeMsscOpenCodeData', {openCode: _data})
                        }).catch(function (error) {
                            console.log(error);
                        });
                        break
                    case '2':
                        cartItem.expect = parseInt(this.msftOpenCodeData.expect) + 1
                        break
                    case '3':
                        cartItem.expect = parseInt(this.mssscOpenCodeData.expect) + 1
                        break
                    case '4':
                        cartItem.expect = parseInt(this.cqsscOpenCodeData.expect) + 1
                        break

                    default:
                        alert('当前彩种接口还没有接上')
                        break


                }


            },
            getHeaderMiddleActive () {
                let headerMiddleActive = window.localStorage.getItem('headerMiddleActive')

                if(headerMiddleActive != null) {
                    this.changeSelected = parseInt(headerMiddleActive)
                }
            },

            getData:function () {
              let _this = this
              window.axios.get('/static/gamedatas.js')
                  .then(function (response) {
                      // 获取数据
                      let str = response.data
                      // 将数据切割成数组
                      let strs = str.split(";")

                      // let gamesArray = strs[0].slice(13,-1).split(",")
                      let gamesArrayStr = strs[0].slice(13,-1)
                      let lv = gamesArrayStr.split(',')

                      // console.log(gamesArrayStr)

                      // for (let i = 0; i < gamesArray.length; i++) {
                      //     _this.getGamesOuter.getGames[i]   = gamesArray[i]
                      // }
                      _this.getGamesOuter.getGames   = gamesArrayStr
                      _this.getGameMapOuter.getGameMap      = JSON.parse(strs[1].slice(15))
                      let lvv = JSON.parse(strs[1].slice(15))

                      // let emptyArr = []
                      lv.forEach((value,index) => {
                          //console.log(value)
                          for(let i in lvv){
                              if(value == lvv[i]['id']){
                                  // this.emptyArr.push(lvv[i])
                                  _this.getOrderedHeaderMiddleOuter.getOrderedHeaderMiddle.push(lvv[i])
                                  // console.log(lvv[i]['name'])
                              }
                              // console.log(lvv[i]['id'])
                          }
                      })
                      // console.log(_this.getOrderedHeaderMiddleOuter.getOrderedHeaderMiddle)

                        // console.log(emptyArr)
                      // state.headerMiddleOrder.getGames.forEach((value,index,array) => { // 将item按照headerMiddleOrder(games)中的顺序一个一个地放入到orderHeaderMiddle中
                      // console.log(value)
                      // console.log(index)
                      // console.log(array)
                      // state.orderedHeaderMiddle.push(JSON.parse(JSON.stringify(state.headerMiddle))[value])
                      // })
                      // console.log(state.orderedHeaderMiddle)
                      // emptyArr.forEach((value,index,array) => { // 将item按照headerMiddleOrder(games)中的顺序一个一个地放入到orderHeaderMiddle中
                      //     console.log(value)
                      //     console.log(index)
                      //     console.log(array)
                      //    orderedHeaderMiddleOuter
                      //     })
                      // console.log(JSON.parse(JSON.stringify(emptyArr)))
                      // console.log(_this.getGameMapOuter.getGameMap)
                      // console.log(_this.getGamesOuter)

                  }).then(
                  // this.$store.dispatch('getAllGames').then(this.$store.dispatch('getGameOrder')).then(this.$store.dispatch('getOrderedHeaderMiddle')).then(this.getOrderedHeaderMiddleData())
                  this.$store.dispatch('getGamesFromGameDatas', { getGamesFromGameDatas: _this.getGamesOuter }),
                  this.$store.dispatch('getGameMapFromGameDatas', { getGameMapFromGameDatas: _this.getGameMapOuter }))

                  .then(this.$store.dispatch('getOrderedHeaderMiddle', { getOrderedHeaderMiddle: _this.getOrderedHeaderMiddleOuter }))
                  // .then(this.$store.dispatch('getOrderedHeaderMiddle')).then(this.getOrderedHeaderMiddleData())
                      // 将headerMiddle顺序存入
                      //  this.$store.dispatch('getGamesFromGameDatas', { getGamesFromGameDatas: _this.getGamesOuter }),
                        // 将headerMiddle数据存入
                        // this.$store.dispatch('getGameMapFromGameDatas', { getGameMapFromGameDatas: _this.getGameMapOuter })

            },
            getOrderedHeaderMiddleData() {
                this.orderedHeaderMiddleData = this.orderedHeaderMiddle
            },
            // changeViewsToHome: function () {
            //     alert('home');
            // },
            // changeViewsToPosts: function () {
            //     alert('posts');
            // },
            // changeViewsToArchive: function () {
            //     alert('archive');
            // },
            // send() {
            //     this.$emit('child-info', this.msgChild)
            // },


            changeHeaderBottom(msg, k) {
                // alert(msg);
                // 点击　右侧的contSider　显示
                //     alert('openContSider')

                //将active的class存入localStorage,然后每次这组件mounted的时候，就从localStorage里面取出来。然后
                window.localStorage.setItem('headerMiddleActive', k)

                window.localStorage.setItem('currentGameCode',msg)

                //为了更新顶部，这里我们将currentCode直接存入localStorage，然后更新页面的时候，走一下路由，由于headerMiddle是一直有的，所以我们直接在created里面走一下路由，然后将vuex里面的currentGameCode也更新一下

                this.$store.dispatch('contSiderShowTrue')


                this.changeSelected = k
                this.html = '更多游戏'
                this.$emit('child-info-for-header-bottom', msg)
                // 根据改变headerBottom的传值，通过路由改变contMains的内容,点击跳转到这个大类下面的第一个小类
                switch (msg) {
                    case 'jspk10':
                        // alert('jspk10')
                        this.$store.dispatch('setCurrentGameCode', 'jspk10')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/mspk10/lmp')

                        this.$router.push({path: '/mspk10/lmp'})
                        break
                    case 'pk10':
                        // alert('pk10')
                        this.$store.dispatch('setCurrentGameCode', 'pk10')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/pk10/lmp')

                        this.$router.push({path: '/pk10/lmp'})


                        break
                    case 'jsft':
                        // alert('jsft')
                        this.$store.dispatch('setCurrentGameCode', 'jsft')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/msft/lmp')

                        this.$router.push({path: '/msft/lmp'})


                        break
                    case 'jsssc':
                        // alert('jsssc')
                        this.$store.dispatch('setCurrentGameCode', 'jsssc')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/msssc/comb')

                        this.$router.push({path: '/msssc/comb'})


                        break
                    case 'cqssc':
                        // alert('cqssc')
                        this.$store.dispatch('setCurrentGameCode', 'cqssc')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/cqssc/comb')
                        this.$router.push({path: '/cqssc/comb'})


                        break
                    case 'lhc':
                        alert('lhc 香港六合彩还未开通')
                        this.$store.dispatch('setCurrentGameCode', 'lhc')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        // window.localStorage.setItem('vue_routes', '/lhc/tema')

                        // this.$router.push({path: '/lhc/tema'})
                        break
                    case 'xydd':
                        // alert('xydd')
                        this.$store.dispatch('setCurrentGameCode', 'xydd')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/xydd/xydd')
                        this.$router.push({path: '/xydd/xydd'})

                        break
                    case 'xync':
                        this.$store.dispatch('setCurrentGameCode', 'xync')


                        alert('xync 幸运农场还未开通')
                        // this.$router.push({path: '/cqxync/lmp'})
                        break
                    case 'xylhc':
                        this.$store.dispatch('setCurrentGameCode', 'xylhc')
                        alert('xylhc 幸运六合彩')
                        // this.$router.push({path: '/xylhc/tema'})
                        break
                    default:
                        alert('1路由里面没有这个值，请查看routes/index')
                        break
                }
                // this.$router.push({path: '/mspk10/lmp'})


            },

            // changeHeaderBottomToMspk10(k) {
            //     alert('changeHeaderBottomToMspk10')
                // this.changeSelected = k
                // this.html = '更多游戏'

                // this.$emit('child-info-for-header-bottom', this.msgMspk10)
            // },
            // changeHeaderBottomToBjpk10() {
            //     alert('changeHeaderBottomToBjpk10')
            //     this.$emit('child-info-for-header-bottom', this.msgBjpk10)
            // },
            // changeHeaderBottomToFtpk10() {
            //     alert('changeHeaderBottomToFtpk10')
            //     this.$emit('child-info-for-header-bottom', this.msgFtpk10)
            // },
            // changeHeaderBottomToＭsssc() {
            //     alert('changeHeaderBottomToＭsssc');
            //     this.$emit('child-info-for-header-bottom', this.msgMsssc)
            // },
            // changeHeaderBottomToCqssc() {
            //     alert('changeHeaderBottomToCqssc');
            //     this.$emit('child-info-for-header-bottom', this.msgCqssc)
            //
            // },
            // changeHeaderBottomToXydd() {
            //     alert('changeHeaderBottomToXydd');
            //     this.$emit('child-info-for-header-bottom', this.msgXydd)
            // },
            // changeHeaderBottomToXglhc() {
            //     alert('changeHeaderBottomToXglhc');
            //     this.$emit('child-info-for-header-bottom', this.msgXglhc)
            //
            // },
            // changeHeaderBottomToCqxync() {
            //     alert('changeHeaderBottomToCqxync');
            //     this.$emit('child-info-for-header-bottom', this.msgCqxync)
            //
            // },
            // changeHeaderBottomToXylhc() {
            //     alert('changeHeaderBottomToXylhc');
            //     this.$emit('child-info-for-header-bottom', this.msgXylhc)
            // },
            changeHeaderBottomMore(msg, k) {

                //将active的class存入localStorage,然后每次这组件mounted的时候，就从localStorage里面取出来。然后
                window.localStorage.setItem('headerMiddleActive', k)

                window.localStorage.setItem('currentGameCode',msg)



                //为了更新顶部，这里我们将currentCode直接存入localStorage，然后更新页面的时候，走一下路由，由于headerMiddle是一直有的，所以我们直接在created里面走一下路由，然后将vuex里面的currentGameCode也更新一下


                // alert(msg)
                this.changeMore = k
                this.orderedHeaderMiddleData.forEach((v, ks) => {
                    if (k === ks) {
                        this.html = v.name
                    }
                })
                switch (msg) {
                    case 'xykl8':
                        // alert('xykl8')
                        this.$store.dispatch('setCurrentGameCode', 'xykl8')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/xykl8/lmp')

                        this.$router.push({path: '/xykl8/lmp'})
                        break
                    case 'pcdd':
                        // alert('pcdd')
                        this.$store.dispatch('setCurrentGameCode', 'pcdd')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/pcdd/pcdd')

                        this.$router.push({path: '/pcdd/pcdd'})
                        break
                    case 'gd11x5':
                        this.$store.dispatch('setCurrentGameCode', 'gd11x5')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/gd11x5/lmp')

                        alert('gd11x5 广东11选5 连码 直选 还未开通')
                        this.$router.push({path: '/gd11x5/lmp'})
                        break
                    case 'jsk3':
                        // alert('jsk3')
                        this.$store.dispatch('setCurrentGameCode', 'jsk3')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/jstb/dxtb')

                        this.$router.push({path: '/jstb/dxtb'})
                        break
                    case 'fc3d':
                        alert('fc3d'+'福彩3D还未开通')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        // window.localStorage.setItem('vue_routes', '/mspk10/lmp')
                        this.$store.dispatch('setCurrentGameCode', 'fc3d')

                        // this.$router.push({path: ''})
                        break
                    case 'bjkl8':
                        // alert('bjkl8')
                        this.$store.dispatch('setCurrentGameCode', 'bjkl8')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/bjkl8/zhbswx')

                        this.$router.push({path: '/bjkl8/zhbswx'})
                        break
                    case 'gdkl10':
                        alert('gdkl10 广东快乐十分 除两面盘之外还未开通')
                        this.$store.dispatch('setCurrentGameCode', 'gdkl10')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/gdklsf/lmp')

                        this.$router.push({path: '/gdklsf/lmp'})
                        break
                    case 'xjssc':
                        // alert('xjssc')
                        this.$store.dispatch('setCurrentGameCode', 'xjssc')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        window.localStorage.setItem('vue_routes', '/xjssc/comb')

                        this.$router.push({path: '/xjssc/comb'})
                        break
                    case 'tjssc':
                        alert('tjssc'+'天津时时彩还未开通')
                        // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                        // window.localStorage.setItem('vue_routes', '/mspk10/lmp')
                        this.$store.dispatch('setCurrentGameCode', 'tjssc')

                        // this.$router.push({path: ''})
                        break
                    default:
                        alert('2路由里面没有这个值，请查看routes/index')
                        break
                    // case ''
                }

                this.$emit('child-info-for-header-bottom', msg)
            },
            // changeHeaderBottomToPcdd() {
            //     alert('changeHeaderBottomToPcdd');
            //     this.$emit('child-info-for-header-bottom', this.msgPcdd)
            // },
            // changeHeaderBottomToGd11x5() {
            //     alert('changeHeaderBottomToGd11x5');
            //     this.$emit('child-info-for-header-bottom', this.msgGd11x5)
            // },
            // changeHeaderBottomToJssb() {
            //     alert('changeHeaderBottomToJssb');
            //     this.$emit('child-info-for-header-bottom', this.msgJssb)
            // },
            // changeHeaderBottomToBjkl8() {
            //     alert('changeHeaderBottomToBjkl8');
            //     this.$emit('child-info-for-header-bottom', this.msgBjkl8)
            // },
            // changeHeaderBottomToGdklsf() {
            //     alert('changeHeaderBottomToGdklsf');
            //     this.$emit('child-info-for-header-bottom', this.msgGdklsf)
            // },
            // changeHeaderBottomToXjssc() {
            //     alert('changeHeaderBottomToXjssc');
            //     this.$emit('child-info-for-header-bottom', this.msgXjssc)
            // }
        },
        // 这里请求的时候,我们先在这里获取数据,之后优化的时候,可以把获取数据的过程放在Game.vue created的地方,再获取了数据之后,就分配到两个地方,一部分作为商品标题和input,一部分作为头部headerMiddle所需要的数据
        created() {


            let vue_routes = window.localStorage.getItem('vue_routes')

            if(vue_routes === null){
                this.$router.push({path: vue_routes})
            }





            //　开始的时候，获取各种数据，并且将数据放入orderedHeaderMiddleData数组中
            // this.$store.dispatch('getAllGames').then(this.$store.dispatch('getGameOrder')).then(this.$store.dispatch('getOrderedHeaderMiddle')).then(this.getOrderedHeaderMiddleData())
        },
        mounted() {
            this.getData()
            this.getHeaderMiddleActive()
        }


    }
</script>

<style scoped>
    /*全局样式*/

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

    .show {
        display: block;
    }

    /*与头部有关的全局性样式*/

    .header {
        position: absolute;
        color: #fff;
        min-width: 1240px;
        width: 100%;
    }

    .header .menu1 {
        width: 490px;
        position: absolute;
        left: 230px;
        top: 0;
    }

    .header a {
        color: #fff;
        text-align: center;
    }

    /*与头部有关的全局性样式结束*/

    /*skin_blue相关的全局性样式*/
    .skin_blue .header {
        background: #3682d0;
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

    /*skin_blue相关的全局性样式结束*/

    /*全局样式结束 将顶部固定在了左上角*/

    /*skin_blue 样式 header_middle*/
    .skin_blue .header .lotterys {
        background: #2161b3;
    }

    .skin_blue .header .lotterys .show span {
        background: url("/static/game/images/skin/blue/nav_shuxian.png") no-repeat scroll right 10px;
    }

    .skin_blue .lotterys .selected,
    .skin_blue .lotterys .show > a:hover {
        color: #143679;
        background: #e6e6e6;
        background: -moz-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);
        background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%)
    }

    .skin_blue .header .lotterys .more-game {
        border-left: solid 1px #2161b3;
    }

    .skin_blue .header .more-game-drop {
        background-color: #e7e7e7;
        border: solid 1px #2161b3;
    }

    .skin_blue .header .gamebox a {
        background: #2161b3;
    }

    /*skin_blue 样式 header_middle 结束*/

    /*header_middle相关样式*/
    .header .lotterys {
        height: 38px;
        line-height: 38px;
        position: relative;
        z-index: 2;
    }

    .header .lotterys .show {
        float: left;
    }

    .header .lotterys .show > a {
        display: block;
        float: left;
        font-size: 13px;
        text-align: center;
        width: 120px;
        position: relative;
    }

    .header .lotterys .more-game {
        position: absolute;
        font-weight: 700;
        text-align: center;
        width: 112px;
        height: 100%;
        left: 1110px;
        top: 0;
    }

    .header .lotterys .more-game > a {
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
    }

    .header .lotterys .currentGameTxt {
        font-style: normal;
        font-size: 13px;
        font-weight: 400;
    }

    .header .lotterys .selected span,
    .header .lotterys span:hover {
        background: 0 0 !important;
    }

    .header .more-game-drop {
        position: absolute;
        right: -1px;
        top: 38px;
        width: 480px;
        height: auto;
        padding: 0 15px 8px 15px;
        overflow: hidden;
        text-align: left;
        font-weight: 400;
        color: #333;
    }

    .header .editbtn {
        position: absolute;
        display: inline-block;
        top: 13px;
        right: 5px;
        width: 12px;
        height: 13px;
        background: url("/static/game/images/btnremove.png") no-repeat;
        cursor: pointer;
        display: none;
    }

    .header .lotterys a span {
        display: block;
        width: 100%;
    }

    .header .gamebox {
        margin-top: 20px;
        padding: 25px 35px;
        background-color: #fff;
        border: solid 1px #ccc;
        font-size: 13px;
        height: auto;
        overflow: hidden;
    }

    .header .gamebox a {
        display: block;
        width: 130px;
        height: 38px;
        float: left;
        margin: 1px;
        color: #fff;
        position: relative;
    }

    .header .gamebox .editbtn {
        background: url("/static/game/images/btnadd.png");
    }

    .header .lotterys.menu-editMode .editbtn {
        display: block;
    }

    .header .more-game-drop .actions {
        position: absolute;
        right: 17px;
        bottom: 6px;
    }

    .header .more-game-drop .actionBtn {
        display: inline-block;
        border-radius: 4px;
        color: #fff;
        padding: 10px 18px;
        line-height: 1em;
        font-weight: 400;
    }

    .header .more-game-drop .actionBtn.action-cancel {
        background: #bbb;
        display: none;
    }

    .header .lotterys.menu-editMode .more-game-drop .action-cancel {
        display: inline-block;
    }

    /*header_middle相关样式结束*/

    /*以下是增加的*/

    .skin_blue .header .more-game-drop {
        display: none;
    }

    .skin_blue .header .lotterys .more-game:hover .more-game-drop {
        display: block;
    }

    /*加入红色页面的hover效果*/
    .skin_red .header .more-game-drop {
        display: none;
    }

    .skin_red .header .lotterys .more-game:hover .more-game-drop {
        display: block;
    }



</style>
