<template>
    <div class="bet-modal">
        <!--cartList-->
        <!--{{this.showChildCartList}}-->
        <!--{{this.tableData}}-->

        <!--<el-button type="text" @click="dialogTableVisible = true">打开嵌套表格的 Dialog</el-button>-->

        <el-dialog title="下注明细 (请确认注单)" :visible.sync="showChildCartList.changeClass" width="478"
                   style="font-weight: 700;">

            <div class="cart-empty" v-if="!cartList.length">下注都已被清空</div>
            <div style="max-height: 380px; overflow-y: auto;">
                <el-table
                        :data="this.cartListWithGoodsName"
                        border
                        size="small">
                    <el-table-column
                            label="号码"
                            width="261"
                            style="text-align: center;">
                        <template slot-scope="scope">
                            <span style="display:block;text-indent: 0.5em;text-align:left;">{{ scope.row.goodsName }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column
                            label="赔率"
                            width="67">
                        <template slot-scope="scope">
                            <span class="c-txt3">{{ scope.row.odds }}</span>
                        </template>
                    </el-table-column>
                    <el-table-column
                            label="金额"
                            width="67">
                        <template slot-scope="scope">
                            <!--<input type="number" :value="scope.row.count" style="width: 100px" />-->
                            <!--<el-input type="number" class="invalid" v-model="scope.row.count" style="width: 95%;" />-->
                            <!--<el-input type="number" v-model="scope.row.count" style="width: 95%;" />-->
                            <el-tooltip :disabled="scope.row.count > 0"
                                        :content="'输入的金额有误(最低'+ scope.row.minMoney +'元，最高'+ scope.row.maxMoney +'元)'"
                                        placement="bottom" effect="dark">
                                <input type="number" :class="{'invalid': scope.row.count <= 0}"
                                       v-model="scope.row.count" style="width: 85%;"/>
                            </el-tooltip>
                        </template>
                    </el-table-column>
                    <el-table-column label="确认" width="43">
                        <template slot-scope="scope">
                            <el-checkbox checked @change="selectProduct(scope.$index, scope.row)"></el-checkbox>


                            <!--<el-button-->
                            <!--size="mini"-->
                            <!--type="danger"-->
                            <!--@click="handleDelete(scope.$index, scope.row)">删除</el-button>-->
                        </template>
                    </el-table-column>

                </el-table>
            </div>


            <el-row style="margin-top: 10px; border: solid 1px #b9c2cb;">
                <el-col :span="7" style="border-right: solid 1px #b9c2cb;">
                    <div class="grid-content bg-purple" style="text-align: center;"><span
                            style="font-weight: 500;">组数 : </span>{{countAll}}
                    </div>
                </el-col>
                <el-col :span="13">
                    <div class="grid-content bg-purple-light" style="text-align: center;"><span
                            style="font-weight: 500;">总金额 : </span><!--{{subtotal_isNaN}}--><span v-html="subtotal_isNaN"></span><!--{{this.cartListWithGoodsName}}-->
                    </div>
                </el-col>
            </el-row>

            <div class="cont-col3-hd clearfix">
                <div class="cont-col3-box2"><a href="javascript:void(0)" class="u-btn1" @click="handleOrder()">确定</a> <a
                        href="javascript:void(0)" class="u-btn1" @click="handleOrderCancel()">取消</a></div>
                <!--<div class="bet-loading" style="display: none;"><div class="gif"></div> <div class="txt">正在提交</div></div>-->
            </div>


            <!--<p v-if="orderOnLimit">Order is over limit.</p>-->

        </el-dialog>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "cart-list",
        props: [
            "showChildCartList",
            // "tableData"
        ],
        data() {
            return {
                cartData: []
                //     gridData: [{
                //         date: '2016-05-02',
                //         name: '王小虎',
                //         address: '上海市普陀区金沙江路 1518 弄'
                //     }, {
                //         date: '2016-05-04',
                //         name: '王小虎',
                //         address: '上海市普陀区金沙江路 1518 弄'
                //     }, {
                //         date: '2016-05-01',
                //         name: '王小虎',
                //         address: '上海市普陀区金沙江路 1518 弄'
                //     }, {
                //         date: '2016-05-03',
                //         name: '王小虎',
                //         address: '上海市普陀区金沙江路 1518 弄'
                //     }],
            }
        },
        computed: {
            ...mapGetters({
                cartList: 'getCartList',
                subtotal: 'getSubtotal',
                plays: 'getMspk10LmpPlays',
                playCates: 'getMspk10LmpPlayCates',
                mspk10LmpSealIsTrue: 'getMspk10LmpSealIsTrue',
                currentGameCode: 'getCurrentGameCode',
                msscOpenCodeData: 'getMsscOpenCodeData',
                bjpk10OpenCodeData: 'getBjpk10OpenCodeData',
                msftOpenCodeData: 'getMsftOpenCodeData',
                mssscOpenCodeData: 'getMssscOpenCodeData',
                cqsscOpenCodeData: 'getCqsscOpenCodeData',
                money: 'getMoney',
            }),
            subtotal_isNaN: {
                get:function () {
                    if(isNaN(this.subtotal)){
                        return '<span style="color: rgb(255, 0, 0);">金额输入有误</span>'
                    }else{
                        return this.subtotal
                    }
                }
            },
            // 下注组数
            countAll: {
                get: function () {
                    let count = 0
                    this.cartList.forEach(item => {
                        if (item.checked === true) {
                            // 字符串变成数字
                            // item.count = parseInt(item.count)
                            //这里计算的不再是多少件商品,而是多少种商品
                            count++
                        }
                    })
                    return count
                }
            },
            // gridData () {
            //     return this.tableData.gridData
            // },
            cartListWithGoodsName() {
                // 通过id获取名字，通过playCateId获取第二个参数
                // return this.plays
                let emptyArr = []
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
                this.cartList.forEach(cartItem => {
                    // console.log(123)
                    if (step === 0) {
                        for (let item in this.plays) {
                            // console.log(item)

                            //1. 将相关的信息从plays里面取出
                            if (item == cartItem.id) {
                                cartItem.gameId = this.plays[item].gameId
                                cartItem.name = this.plays[item].name
                                cartItem.playCateId = this.plays[item].playCateId
                                cartItem.odds = this.plays[item].odds
                                cartItem.rebate = this.plays[item].rebate
                                cartItem.minMoney = this.plays[item].minMoney
                                cartItem.maxMoney = this.plays[item].maxMoney
                                cartItem.maxTurnMoney = this.plays[item].maxTurnMoney

                                // 加入开奖期数 通过当前页面获取相关的期数，先不考虑客户 多个彩种同时下注的情况

                                switch (this.currentGameCode) {
                                    case 'jspk10':
                                        cartItem.expect = parseInt(this.msscOpenCodeData.expect) + 1
                                        break
                                    case 'pk10':
                                        cartItem.expect = parseInt(this.bjpk10OpenCodeData.expect) + 1
                                        break
                                    case 'jsft':
                                        cartItem.expect = parseInt(this.msftOpenCodeData.expect) + 1
                                        break
                                    case 'jsssc':
                                        cartItem.expect = parseInt(this.mssscOpenCodeData.expect) + 1
                                        break
                                    case 'cqssc':
                                        cartItem.expect = parseInt(this.cqsscOpenCodeData.expect) + 1
                                        break

                                    default:
                                        alert('路由里面没有这个值，请查看routes/index')
                                        break


                                    // console.log(cartItem)
                                }

                            }
                        }
                        step++
                    }

                    if (step === 1) {
                        //2. 将相关的信息(playCate 的名字)从playCates里面取出
                        for (let item in this.playCates) {
                            // console.log(item)
                            if (item == cartItem.playCateId) {
                                cartItem.playCatesName = this.playCates[item].name
                                cartItem.playCateNameId = this.playCates[item].id
                                // console.log(cartItem)
                            }
                        }
                        step++
                    }

                    if (step === 2) {

                        // console.log(cartItem.playCateNameId)
                        // 这里需要如果名字是总和-龙虎和，那么需要playCateName不用加上
                        if (cartItem.playCateNameId == 1) {
                            cartItem.goodsName = cartItem.name
                        } else {
                            cartItem.goodsName = cartItem.playCatesName + ' - ' + cartItem.name
                        }
                        step++

                    }

                    if (step === 3) {
                        //4.将cart中的信息存入emptyArr
                        emptyArr.push(cartItem)
                        //最后一步将step清0
                        step = 0
                    }

                })

                // console.log(_this.emptyArr)
                // console.log(step)
                this.cartData = emptyArr;
                return emptyArr;

            }

        },
        methods: {
            // 删除下注的组数
            handleDelete(index, row) {
                // console.log(index, row);
                // console.log(row);
                // 获取到所需要删除的商品的id
                // console.log(row.id);
                // this.$store.commit('deleteCartItem', this.cartList[index].id);
                // 将上面的进行改写
                this.$store.dispatch('deleteCartItem', row.id)
            },

            // checkbox
            //checkbox 这个对象的checked仅仅用于这个购物车的局部的总价的变化，而我们这里的check

            selectProduct(index, row) {
                if (typeof row.checked == 'undefined') {
                    // Vue.set(product,"checked", true); //全局注册
                    this.$set(row, "checked", true) //局部注册
                } else {
                    row.checked = !row.checked
                }
                // this.subtotal();
                // alert([index, row.id]);
            },

            // 完成订单
            //　校验方法

            // 输入的金额有没有在最小的金额和最大的金额之间，则不能往下继续执行

            handleOrder() {
                let step = 0
                let _this = this
                // 如果输入的金额没有在最小的金额和最大的金额之间，则不能投注; 如果总金额是NaN，则把它变成输入金额有误
                if (step === 0) {
                    console.log(_this.subtotal == NaN)
                    // if(_this.subtotal == NaN) {
                    //     _this.subtotal = '金额输入有误'
                    // }

                    for (let item in _this.cartList) {



                        if (_this.cartList[item].count < _this.cartList[item].minMoney || _this.cartList[item].count > _this.cartList[item].maxMoney) {
                            // alert(_this.cartList[item].maxMoney)
                            _this.$alert('输入的金额有误(最低' + _this.cartList[item].minMoney + '元，最高' + _this.cartList[item].maxMoney + '元)', '', {})
                         return
                        }
                    }





                    step++
                }
                //如果已经封盘，则提示已经封盘，不能再次下注

                //如果总金额大于账户余额，则提示不能下注


                if (step === 1) {

                    //　如果已经封盘，则提示已经封盘，不能再次下注
                    if (this.mspk10LmpSealIsTrue === true) {
                        this.$alert('已经封盘，请开盘后再投注', '无法投注', {
                            type: 'error',
                            confirmButtonText: '确定',
                            // callback: action => {
                            // this.$message({
                            // type: '',
                            // message: `action: ${ action }`
                            // });
                            // }
                        })
                        // 点击关闭购物车
                        this.showChildCartList.changeClass = false
                        return
                    }
                    step++
                }

                if(step === 2) {
                    if (this.money < this.subtotal) {
                        this.$alert('余额不足', '请求出错', {
                            type: 'error',
                            confirmButtonText: '确定',
                            // callback: action => {
                            // this.$message({
                            // type: '',
                            // message: `action: ${ action }`
                            // });
                            // }
                        })
                        return
                    }
                    step++
                }




                if (step === 3) {

                    // 秒速赛车 北京赛车 秒速飞艇 纵向　超过7个则不能下注


                    let stepCheck7 = 0

                    // 秒速赛车check7 113-122 (owen)
                    if(stepCheck7 === 0) {
                        let count113shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 113) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count113shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count113shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 1) {
                        let count114shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 114) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count114shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count114shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 2) {
                        let count115shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 115) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count115shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count115shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 3) {
                        let count116shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 116) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count116shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count116shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 4) {
                        let count117shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 117) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count117shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count117shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 5) {
                        let count118shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 118) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count118shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count118shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 6) {
                        let count119shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 119) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count119shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count119shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 7) {
                        let count120shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 120) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count120shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count120shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 8) {
                        let count121shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 121) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count121shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count121shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 9) {
                        let count122shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 122) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count122shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count122shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }


                    // 秒速赛车 check7 结束　113-122 (owen)

                    // 北京赛车check7 开始　11-20 (alex)
                    // 如果前面三个彩种，中间数字的，选择横向或者纵向>=8，则弹出不能下注　秒速赛车、北京赛车、秒速飞艇　单号

                    // 北京赛车　每一列超过8个就不能下注

                    // 首先先放一个playCateId为11的name为1-10的进行统计 11-20

                    if(stepCheck7 === 10) {
                        let count11shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 11) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count11shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count11shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 11) {
                        let count12shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 12) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count12shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count12shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 12) {
                        let count13shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 13) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count13shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count13shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 13) {
                        let count14shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 14) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count14shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count14shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 14) {
                        let count15shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 15) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count15shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count15shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 15) {
                        let count16shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 16) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count16shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count16shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 16) {
                        let count17shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 17) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count17shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count17shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 17) {
                        let count18shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 18) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count18shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count18shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 18) {
                        let count19shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 19) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count19shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count19shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 19) {
                        let count20shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 20) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count20shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count20shuzi >= 8) {
                            this.$alert('下注失败，PK拾 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }


                    // 北京赛车 check7 结束　11-20 (alex)

                    // 秒速飞艇 check7 133-142 (paul)
                    // 如果前面三个彩种，中间数字的，选择横向或者纵向>=8，则弹出不能下注　秒速赛车、北京赛车、秒速飞艇　单号

                    // 北京赛车　每一列超过8个就不能下注

                    // 首先先放一个playCateId为11的name为1-10的进行统计 11-20

                    if(stepCheck7 === 20) {
                        let count133shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 133) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count133shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count133shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 21) {
                        let count134shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 134) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count134shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count134shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }
                    if(stepCheck7 === 22) {
                        let count135shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 135) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count135shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count135shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }
                    if(stepCheck7 === 23) {
                        let count136shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 136) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count136shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count136shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 24) {
                        let count137shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 137) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count137shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count137shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 25) {
                        let count138shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 138) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count138shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count138shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 26) {
                        let count139shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 139) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count139shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count139shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 27) {
                        let count140shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 140) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count140shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count140shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 28) {
                        let count141shuzi = 0


                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 141) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count141shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count141shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    if(stepCheck7 === 29) {
                        let count142shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].playCateId === 142) {
                                for (var i = 1; i < 11; i++) {
                                    if (_this.cartListWithGoodsName[item].name == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            count142shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (count142shuzi >= 8) {
                            this.$alert('下注失败，秒速飞艇 定位玩法，单个名次不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7 ++
                    }

                    // 秒速赛车 北京赛车 秒速飞艇 纵向　超过7个则不能下注　结束　stepCheck7 (0-29)

                    // 秒速赛车 北京赛车 秒速飞艇 横向　超过7个则不能下注

                    // 秒速赛车 横向不能超过7个　(owen) (113-122)

                    let stepCheck7heng = 0

                    if(stepCheck7heng === 0) {
                        let countpk10_113_1shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "1") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_1shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_1shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }


                    if(stepCheck7heng === 1) {
                        let countpk10_113_2shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "2") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_2shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_2shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }



                    if(stepCheck7heng === 2) {
                        let countpk10_113_3shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "3") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_3shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_3shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 3) {
                        let countpk10_113_4shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "4") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_4shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_4shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 4) {
                        let countpk10_113_5shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "5") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_5shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_5shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 5) {
                        let countpk10_113_6shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "6") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_6shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_6shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }



                    if(stepCheck7heng === 6) {
                        let countpk10_113_7shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "7") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_7shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_7shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 7) {
                        let countpk10_113_8shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "8") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_8shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_8shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服！', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 8) {
                        let countpk10_113_9shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "9") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_9shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_9shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }

                    if(stepCheck7heng === 9) {
                        let countpk10_113_10shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "10") {
                                for (let i = 113; i < 123; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_113_10shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_113_10shuzi >= 8) {
                            this.$alert('下注失败，秒速赛车 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }
                    // 秒速赛车 横向不能超过7个　结束 (owen) (113-123)




                    // 北京赛车 横向不能超过7个　(alex) (11-20)

                    if(stepCheck7heng === 10) {
                        let countpk10_11_1shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "1") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_1shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_1shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }


                    if(stepCheck7heng === 11) {
                        let countpk10_11_2shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "2") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_2shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_2shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }



                    if(stepCheck7heng === 12) {
                        let countpk10_11_3shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "3") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_3shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_3shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 13) {
                        let countpk10_11_4shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "4") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_4shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_4shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 14) {
                        let countpk10_11_5shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "5") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_5shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_5shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 15) {
                        let countpk10_11_6shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "6") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_6shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_6shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 16) {
                        let countpk10_11_7shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "7") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_7shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_7shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 17) {
                        let countpk10_11_8shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "8") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_8shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_8shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 18) {
                        let countpk10_11_9shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "9") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_9shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_9shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 19) {
                        let countpk10_11_10shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "10") {
                                for (let i = 11; i < 21; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_11_10shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_11_10shuzi >= 8) {
                            this.$alert('下注失败， PK拾 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }


                    // 北京赛车 横向不能超过7个　结束 (alex) (11-20)


                    // 秒速飞艇 横向不能超过7个　　(paul) (133-142)


                    if(stepCheck7heng === 20) {
                        let countpk10_133_1shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "1") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_1shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_1shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }


                    if(stepCheck7heng === 21) {
                        let countpk10_133_2shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "2") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_2shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_2shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }



                    if(stepCheck7heng === 22) {
                        let countpk10_133_3shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "3") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_3shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_3shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 23) {
                        let countpk10_133_4shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "4") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_4shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_4shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 24) {
                        let countpk10_133_5shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "5") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_5shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_5shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 25) {
                        let countpk10_133_6shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "6") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_6shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_6shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 26) {
                        let countpk10_133_7shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "7") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_7shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_7shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 27) {
                        let countpk10_133_8shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "8") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_8shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_8shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 28) {
                        let countpk10_133_9shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "9") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_9shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_9shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }




                    if(stepCheck7heng === 29) {
                        let countpk10_133_10shuzi = 0
                        for(let item in _this.cartListWithGoodsName) {
                            if (_this.cartListWithGoodsName[item].name === "10") {
                                for (let i = 133; i < 143; i++) {
                                    if (_this.cartListWithGoodsName[item].playCateId == i) {
                                        if(_this.cartListWithGoodsName[item].checked == true) {
                                            countpk10_133_10shuzi++
                                        }
                                    }
                                }
                            }
                        }
                        if (countpk10_133_10shuzi >= 8) {
                            this.$alert('下注失败， 秒速飞艇 定位玩法，不允许下注8码或8码以上！如有疑问请咨询客服!', '请求出错', {
                                type: 'error',
                                confirmButtonText: '确定',
                            })
                            return
                        }
                        stepCheck7heng ++
                    }



                    // 秒速飞艇 横向不能超过7个　结束 (paul) (133-142)

                    // 秒速赛车 北京赛车 秒速飞艇 横向　超过7个则不能下注



                    step++
                }

                if (step === 4) {
                    //点击关闭购物车
                    this.showChildCartList.changeClass = false
                    this.$store.dispatch('buy')
                    axios.post('/web/order', {cartList: _this.cartData}).then(function (response) {
                        if (response.data.code === -1) {
                            _this.$message({
                                message: '投注失败',
                                type: 'error'
                            });
                        } else {
                            _this.$message({
                                message: '投注成功',
                                type: 'success',
                                duration: 3000
                            });
                        }
                    })
                    step++
                }
            },
            // 取消完成订单
            handleOrderCancel() {
                //点击关闭购物车
                this.showChildCartList.changeClass = false
            }


        },
    }
</script>

<style>
    .cart-empty {
        text-align: center;
        padding: 32px;
    }

    .c-txt3 {
        color: red;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        padding: 0 4px;
    }

    .cont-col3-hd {
        padding: 8px 0;
        color: #310a07;
    }

    .cont-col3-box2 {
        text-align: center;
    }

    .skin_blue .u-btn1 {
        background: #5b8ac7;
        background: -moz-linear-gradient(top, #5b8ac7 0, #2765b5 100%);
        background: -webkit-linear-gradient(top, #5b8ac7 0, #2765b5 100%);
        background: linear-gradient(to bottom, #5b8ac7 0, #2765b5 100%);
        border: 1px solid #1e57a0;
        color: #fff;
    }

    .u-btn1 {
        display: inline-block;
        width: 56px;
        height: 20px;
        line-height: 20px;
        text-align: center;
        vertical-align: bottom;
        border-radius: 3px;
        font-size: 12px;
        margin-left: 3px;
    }

    /*element-ui custom css*/
    .el-dialog__header {
        padding: 20px 20px 0 !important;
        width: 440px !important;
    }

    .el-dialog__body {
        padding: 20px 20px 10px !important;
        width: 440px !important;
    }

    .el-table--small td, .el-table--small th {
        padding: 4px 0 !important;
        text-align: center !important;
    }

    .el-table .cell, .el-table th div, .el-table--border td:first-child .cell, .el-table--border th:first-child .cell {
        padding-left: 0px !important;
        color: #35406d !important;
    }

    .el-table .cell, .el-table th div {
        padding-right: 0px !important;
    }

    .skin_blue .el-table--mini, .el-table--small, .el-table__expand-icon {
        font-size: 14px !important;
        color: #35406d !important;
        width: 460px !important;
    }

    .el-dialog {
        width: 480px !important;
    }

    .el-table th, .el-table .has-gutter tr {
        background-color: #edf4fe !important;
    }

    .el-table--border td, .el-table--border th, .el-table__body-wrapper .el-table--border.is-scrolling-left ~ .el-table__fixed {
        border-right: 1px solid #b9c2cb !important;
    }

    .el-table td, .el-table th.is-leaf {
        border-bottom: 1px solid #b9c2cb !important;
    }

    .el-table--border, .el-table--group {
        border: solid 1px #b9c2cb !important;
    }

    .el-input__inner {
        height: 23px !important;
        padding: 0 2px !important;
        border-radius: 0px !important;
    }

    .el-table__row {
        text-align: left !important;
    }

    /*element-ui custom css end*/

    /*金额有误的时候，input框显示红色*/
    .bet-modal input.invalid {
        border: 2px solid red;
        padding: 2px;
        border-radius: 2px;
    }

</style>