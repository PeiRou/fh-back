<template>
    <div class="main-body" :class="skin_color" style="right: 0px;">
        <!--<el-button-->
                <!--plain-->
                <!--@click="open_zhaongjian">-->
            <!--右下角-->
        <!--</el-button>-->
        <!--{{this.myState}}-->
        <!--<input type="text" v-model="message2">-->
        <!--{{this.contSiderShow}}-->
        <!--{{skin_color}}-->
        <div class="header">

            <header-top @child-info-for-skin="getSkin"></header-top> <!--头部顶部组件-->

            <header-middle @child-info-for-header-bottom="get"></header-middle> <!--头部中间组件-->

            <component v-bind:is="headerBottom">　　<!--头部底部组件，通过动态组件来改变,通过中间组件的参数来改变底部组件，底部组件通过路由改变contMain_parts-->
                <!--component changes when app.headerBottom changes!-->
            </component>
        </div>
        <div class="main-wrap">
            <sider-bar></sider-bar>
            <div class="content-wrap">
                <div class="content">
                    <div class="sub-wrap clearfix">
                        <router-view></router-view>
                        <ContSider v-if="this.contSiderShow"></ContSider>
                    </div>
                </div>
            </div>
        </div>

        <ChatBar></ChatBar> <!--聊天室-->

        <FooterNotice></FooterNotice> <!--底部公告-->

        <modal-box></modal-box>  <!--模态框组件-->

    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    import HeaderTop from './header/headerTop'  // 引入头部顶部组件
    import HeaderMiddle from './header/headerMiddle' // 引入头部中间组件

    // 引入headerBottom开始

    import HeaderBottom_Mspk10 from './header/headerBottom/headerBottom_Mspk10' // 引入头部底部的组件
    import HeaderBottom_Bjpk10 from './header/headerBottom/headerBottom_Bjpk10'
    import HeaderBottom_Ftpk10 from './header/headerBottom/headerBottom_Ftpk10'
    import HeaderBottom_Msssc from './header/headerBottom/headerBottom_Msccs'
    import HeaderBottom_Cqssc from './header/headerBottom/headerBottom_Cqssc'
    import HeaderBottom_Xydd from './header/headerBottom/headerBottom_Xydd'
    import HeaderBottom_Xglhc from './header/headerBottom/headerBottom_Xglhc'
    import HeaderBottom_Cqxync from './header/headerBottom/headerBottom_Cqxync'
    import HeaderBottom_Xylhc from './header/headerBottom/headerBottom_Xylhc'
    import HeaderBottom_Xykl8 from './header/headerBottom/headerBottom_Xykl8'
    import HeaderBottom_Pcdd from './header/headerBottom/headerBottom_Pcdd'
    import HeaderBottom_Gd11x5 from './header/headerBottom/headerBottom_Gd11x5'
    import HeaderBottom_Jssb from './header/headerBottom/headerBottom_Jssb'
    import HeaderBottom_Bjkl8 from './header/headerBottom/headerBottom_Bjkl8'
    import HeaderBottom_Gdklsf from './header/headerBottom/headerBottom_Gdklsf'
    import HeaderBottom_Xjssc from './header/headerBottom/headerBottom_Xjssc'


    // 引入headerBottoim结束

    import SiderBar from './mainWrap/siderBar'  // 引入mainWrap中的siderBar,中间的部分contMain通过路由加载出来
    import ContSider from './mainWrap/contSider'  // 引入mainWrap中的右边 ContSider

    import FooterNotice from '../../common/footer/footer' // 引入底部公告

    import ChatBar from '../../common/chatbar/chatbar' // 引入右侧聊天室

    import ModalBox from '../../common/modalbox/ModalBox.vue';



    export default {
        name: "main-body-outer",
        computed: {
            ...mapGetters({
                myState: 'getMyState',
                contSiderShow: 'getContSiderShow'
            }),
            //　利用message2监听vuex里面contSider_show的变化
            // message2: {
            //     get() {
            //         alert(this.$store.getters.getContSiderShow)
            //         return this.$store.getters.getContSiderShow
            //     },
            //     set(value) {
            //         this.$store.commit('updateContSiderShow', value)
            //         alert(value)
            //     }
            // }
        },
        data() {
            return {
                headerBottom: 'HeaderBottom_Mspk10', //头部组件默认是　秒速赛车
                skin_color: 'skin_blue', // 默认皮肤是蓝色
                MessageFromBackEnd: ''
            }
        },
        methods: {
            get(msg) { // 通过点击事件 改变headerMiddle中间的
                // this.msgParent = msg
                this.headerBottom = msg
            },
            getSkin(msg) { // 通过点击事件 改变header
                // alert(msg)
                this.skin_color = msg

            },
            open_zhaongjian() {
                this.$notify({
                    title: '中奖通知',
                    message: '<div class="el-notification__content"><div><p><span class="t-qi">秒速时时彩</span> 第 180327614 期 第三球  小 已中奖, 中奖金额 <span style="color: rgb(224, 79, 76);">4975.00</span></p><p><span class="t-qi">秒速时时彩</span> 第 180327614 期 第三球  单 已中奖, 中奖金额 <span style="color: rgb(224, 79, 76);">4975.00</span></p></div></div>',
                    position: 'bottom-right',
                    duration: 0,
                    dangerouslyUseHTMLString: true,

                });
            },
        },
        components: {
            HeaderTop,
            HeaderMiddle,
            // 引入headerBottom
            HeaderBottom_Mspk10, // 最开始加载的
            jspk10: HeaderBottom_Mspk10, // 通过headerMiddle点击事件,从子组件headMiddle传出的值jspk10
            pk10:HeaderBottom_Bjpk10,
            jsft:HeaderBottom_Ftpk10,
            jsssc:HeaderBottom_Msssc,
            cqssc:HeaderBottom_Cqssc,
            xydd:HeaderBottom_Xydd,
            lhc:HeaderBottom_Xglhc,
            xylhc:HeaderBottom_Xylhc,
            xync:HeaderBottom_Cqxync,
            xykl8:HeaderBottom_Xykl8,
            pcdd:HeaderBottom_Pcdd,
            gd11x5:HeaderBottom_Gd11x5,
            jsk3:HeaderBottom_Jssb,
            //　缺少 福彩3D 需要扣

            bjkl8:HeaderBottom_Bjkl8,
            gdkl10:HeaderBottom_Gdklsf,
            xjssc:HeaderBottom_Xjssc,

            // 缺少 天津时时彩　
            // 引入headerBottom结束



            SiderBar,
            ContSider,
            FooterNotice,
            ChatBar,
            ModalBox



        }

    }
</script>

<style>
    .main-body {
        position: absolute;
        overflow-x: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 30px;
    }

    .header {
        position: absolute;
        color: #fff;
        min-width: 1240px;
        width: 100%;
    }

    .main-wrap {
        position: absolute;
        width: 100%;
        top: 137px;
        bottom: 0;
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
    .el-notification__title {
        background: #4274b3;
        padding: 3px 15px;
        display: inline-block;
        font-size: 16px;
        color: #FFFFFF;
    }
</style>
