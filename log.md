> 20180319 开始进行注册登录的状态管理

# 在agreement和game页面进行是否登录的状态管理
> F: resources/assets/js/components/user/agreement/Agreement.vue
> F: resources/assets/js/components/user/Game.vue

// 获取接口数据
```
F: resources/assets/js/components/user/parts/mainWrap/contMain_parts/Mspk10Lmp.vue
(1)  
        methods: {
            getData () {

                    let _this= this;
                window.axios.get("/api/getMssc").then(function (response) {
                    clearInterval(timer)
                    // console.log(_this.result);
                    // djs_param = response.data;
                    // console.log(_this.result);
                    var djs = parseInt(
                    //     // 75 - (res.servertime - res.opentimestamp)
                    //     // console.log(this.result)
                        5 - (response.data.servertime - response.data.opentimestamp)
                    )

                    timer = setInterval(() => {
                    //     // console.log(djs)
                    //     // console.log(res.servertime)
                    //     // console.log(res.opentimestamp)
                        _this.seal = djs - 15
                        // console.log("seal: " + _this.seal)
                        _this.openLottery = djs --
                        // console.log("openLottery: " + _this.openLottery)
                    }, 1000)

                }).catch(function (error) {

                    console.log(error);
                });

                // 将所有状态变为初始状态
                this.$store.dispatch('setSealIsTrueToFalse')



            }


        },
        watch: {
            seal: function (val) {
                if (val <= 0 || val == '已封盘') {

                    // this.sealIstrue = true;
                    this.$store.dispatch('setSealIsTrueToTrue')
                    this.seal = "已封盘"
                } else {
                    // this.mspk10LmpSealIsTrue = false;
                }
            },
            openLottery : function(val){
                if(val <= 0){
                    this.getData();
                }
            }
        },

        mounted(){
            this.getData()
        },
(2) 
    let timer
    
(3)
    data() {
                return {
                    // 距离开奖时间
                    openLottery: 0,
                    // 距离封盘时间
                    seal:0,
                    .
                    .
                    .
                    }
             }
(4)
    <div class="fr"><span id="next_turn_num">180209242</span>&nbsp;期 距离封盘：
                        <span id="bet-date">{{seal}}</span> 距离开奖：
                        <span id="open-date">{{openLottery}}</span></div>                         
```
> 外部倒计时完成，现在完成input封盘
```
F:resources/assets/js/components/user/parts/mainWrap/contMain_parts/product_item/Mspk10LmpProduct_1/Mspk10LmpProduct_1_parts/Mspk10LmpProduct_1_content.vue
(1)computed: {
               ...mapGetters({
               .
               .
               .
                   // 封盘与否
                   mspk10LmpSealIsTrue: 'getMspk10LmpSealIsTrue'
               }),

(2)data () {
               return {
                   .
                   .
                   .
                   sealInput: '封盘'
   
               }
               
(3)       
<tr>
<td :data-id="info.id" class="name" @mouseover="addHover" @mouseleave="removeHover" :class="{'bg_yellow': changeClass === true, 'hover': hoverActive}" style="width: 69px;"  @click="!mspk10LmpSealIsTrue && addToCart(info.id)">{{info.name}}</td>
        <td :data-id="info.id" @mouseover="addHover" @mouseleave="removeHover" class="odds" style="width: 58px;" :class="{'bg_yellow': changeClass === true, 'hover': hoverActive}" @click="!mspk10LmpSealIsTrue && addToCart(info.id)">
            <span class="c-txt3">{{ mspk10LmpSealIsTrue ? '--' : info.odds}}</span>
        </td>
        <td :data-id="info.id" @mouseover="addHover" @mouseleave="removeHover" class="amount" style="width: 80px;" :class="{'bg_yellow': changeClass === true, 'hover': hoverActive}" @click="!mspk10LmpSealIsTrue && addToCart2(info.id)">
            <input type="text" ref="inp" v-model="mspk10LmpSealIsTrue ? sealInput :betAmountItem1" :disabled="mspk10LmpSealIsTrue">
          <!--{{betAmountItem1}}-->
        </td>   
        </tr>   
        
        (3.1)  @click="!mspk10LmpSealIsTrue && addToCart(info.id)"
        (3.2)  <span class="c-txt3">{{ mspk10LmpSealIsTrue ? '--' : info.odds}}</span>
        (3.3)  v-model="mspk10LmpSealIsTrue ? sealInput :betAmountItem1" :disabled="mspk10LmpSealIsTrue"
        (3.4) :disabled="mspk10LmpSealIsTrue"
        (3.5)v-model="mspk10LmpSealIsTrue ? sealInput :betAmountItem1"           
 
```
> 下面通过vuex里面通过currentPageCode来标识相关的页面的信息, currentPageCode里面的码来识别当前的页面,每次跳路由的时候, 都发送一个相关的方法,来改变这个值。最终的contMain_parts也组件化，投注的商品页面可以由不同的商品来组成,现在先完成功能，之后，再组件化。

> cartList里面通过当前页面的currentPageCode用switchCase来判断相关的封盘与否。

> headerTop的数据
gameName 例如 '秒速赛车'
用headerMiddle里面的getAllGames与Game提交ajax请求的时候获取的数据，来进行筛选获取gameName，期数就用Game里面获取的数据

```

                <div>{{gameName}}</div>
                <div><span class="cur_turn_num">{{msscLmpOpenCodeData.expect}}</span>期开奖</div>
            
        computed: {
            ...mapGetters({
                msscLmpOpenCodeData: 'getMsscLmpOpenCodeData',
                gameMap: 'getAllGames',
            }),

            gameName: {
                get: function () {
                    let gameMap = this.gameMap
                    let currentGameCode = this.msscLmpOpenCodeData.code
                    // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                    if (currentGameCode === 'mssc') {
                        currentGameCode = 'jspk10'
                    }



                    // return this.gameMap
                    for(let item in gameMap) {
                        // console.log(gameMap[item]['code'])
                        if (gameMap[item].code == currentGameCode) {
                            console.log(123)
                            return this.gameMap[item].name
                        }
                    }
                }
            }
        }

```

> 要用双引号，不能用单引号
