import Vue from 'vue'
import Router from 'vue-router'

import App from './../App.vue'

// // 引入 User组件
// // 开始通过路由进行懒加载
// const Game = r => require.ensure([], () => r(require('@/components/user/Game')), 'game')
const Game = r => require.ensure([], () => r(require('./../components/user/Game')), 'game')
// const Agreement = r => require.ensure([], () => r(require('@/components/user/agreement/Agreement')), 'agreement')
//
// // ContMain组件
// const Mspk10Lmp = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Mspk10Lmp')), 'mspk10Lmp')
const Mspk10Lmp = r => require.ensure([], ()=> r(require('../components/user/parts/mainWrap/contMain_parts/Mspk10Lmp')), 'mspk10Lmp')
//

//const Tjyhk = r => require.ensure([], ()=> r(require('../components/user/parts/mainWrap/siderBar/Tjyhk')), 'tjyhk')
// ContMain组件
// 极速赛车路由
// const Mspk10Lmp = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Mspk10Lmp')), 'mspk10Lmp')



// const Mspk10Sol = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Mspk10Sol')), 'mspk10Sol')

// 这样写会导致加载不成功,点击了sol然后再点击com的时候,加载不出来,所以这里我们改用import
// 先用全部加载实现效果,之后再用懒加载来实现
// 下面2行代码，没有指定webpackChunkName，每个组件打包成一个js文件。
// const ImportFuncDemo1 = () => import('../components/ImportFuncDemo1')
// const ImportFuncDemo2 = () => import('../components/ImportFuncDemo2')


// const Mspk10Sol = r => require.ensure([], ()=> r(require('../components/user/parts/mainWrap/contMain_parts/Mspk10Sol')), 'mspk10Sol')

// const Mspk10Sol = () => import('./../components/user/parts/mainWrap/contMain_parts/Mspk10Sol')


// const Mspk10Com = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Mspk10Com')), 'mspk10Com')
// const Mspk10Com = r => require.ensure([], ()=> r(require('../components/user/parts/mainWrap/contMain_parts/Mspk10Com')), 'mspk10Com')

// const Mspk10Com = () => import('./../components/user/parts/mainWrap/contMain_parts/Mspk10Com')

// // 秒速时时彩路由
// const MssscComb = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MssscComb')), 'mssscComb')
// const MssscSol1 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MssscSol1')), 'mssscSol1')
// const MssscSol2 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MssscSol2')), 'mssscSol2')
// const MssscSol3 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MssscSol3')), 'mssscSol3')
// const MssscSol4 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MssscSol4')), 'mssscSol4')
// const MssscSol5 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MssscSol5')), 'mssscSol5')
//
// // 北京赛车路由
// const Pk10Lmp = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Pk10Lmp')), 'pk10Lmp')
// const Pk10Sol = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Pk10Sol')), 'pk10Sol')
// const Pk10Com = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Pk10Com')), 'pk10Com')
//
// // 秒速飞艇路由
// const MsftLmp = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MsftLmp')), 'msftLmp')
// const MsftSol = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MsftSol')), 'msftSol')
// const MsftCom = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/MsftCom')), 'msftCom')
//
// // 重庆时时彩路由
// const CqsscComb = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/CqsscComb')), 'cqsscComb')
// const CqsscSol1 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/CqsscSol1')), 'cqsscSol1')
// const CqsscSol2 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/CqsscSol2')), 'cqsscSol2')
// const CqsscSol3 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/CqsscSol3')), 'cqsscSol3')
// const CqsscSol4 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/CqsscSol4')), 'cqsscSol4')
// const CqsscSol5 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/CqsscSol5')), 'cqsscSol5')
//
// // 新疆时时彩路由
// const XjsscComb = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/XjsscComb')), 'xjsscComb')
// const XjsscSol1 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/XjsscSol1')), 'xjsscSol1')
// const XjsscSol2 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/XjsscSol2')), 'xjsscSol2')
// const XjsscSol3 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/XjsscSol3')), 'xjsscSol3')
// const XjsscSol4 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/XjsscSol4')), 'xjsscSol4')
// const XjsscSol5 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/XjsscSol5')), 'xjsscSol5')
//
// // 幸运蛋蛋路由
// const Xydd = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Xydd')), 'xydd')
//
// // PC蛋蛋路由
// const Pcdd = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Pcdd')), 'pcdd')
//
// // 幸运快乐8
// const Xykl8Lmp = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Xykl8Lmp')), 'xykl8Lmp')
// const Xykl8Zhbswx = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Xykl8Zhbswx')), 'xykl8Zhbswx')
// const Xykl8Zm = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Xykl8Zm')), 'xykl8Zm')
//
// // 北京快乐8
// const Bjkl8Zhbswx = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Bjkl8Zhbswx')), 'bjkl8Zhbswx')
// const Bjkl8Zm = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Bjkl8Zm')), 'bjkl8Zm')
//
// // 江苏骰宝
// const Jsk3Dxtb = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Jsk3')), 'jsk3Dxtb')
//
// // 广东11选5 之后有checkbox的另外写
// const Gd11x5Lmp = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Gd11x5Lmp')), 'gd11x5Lmp')
// const Gd11x5Sol = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/Gd11x5Sol')), 'gd11x5Sol')
//
// // 广东快乐十分
// const GdklsfLmp = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfLmp')), 'gdklsfLmp')
// const GdklsfSol = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfSol')), 'gdklsfSol')
// const GdklsfQiu1 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfQiu1')), 'gdklsfQiu1')
// const GdklsfQiu2 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfQiu2')), 'gdklsfQiu2')
// const GdklsfQiu3 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfQiu3')), 'gdklsfQiu3')
// const GdklsfQiu4 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfQiu4')), 'gdklsfQiu4')
// const GdklsfQiu5 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfQiu5')), 'gdklsfQiu5')
// const GdklsfQiu6 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfQiu6')), 'gdklsfQiu6')
// const GdklsfQiu7 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfQiu7')), 'gdklsfQiu7')
// const GdklsfQiu8 = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfQiu8')), 'gdklsfQiu8')
// const GdklsfZm = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfZm')), 'gdklsfZm')
// const GdklsfLm = r => require.ensure([], ()=> r(require('@/components/user/parts/mainWrap/contMain_parts/GdklsfLm')), 'gdklsfLm')











// // Test路由组件
// const Test = r => require.ensure([], () => r(require('@/components/test/Test')), 'test')
// // 测试用computed的方式 watch vuex里面的内容
// const Computed_Watch_vuex = r => require.ensure([], () => r(require('@/components/test/computed_for_watch/Computed_Watch_vuex')), 'Computed_Watch_vuex')



Vue.use(Router)

export default new Router({
    //mode: 'history',
    routes: [
        {
            path: '/',
            component: App, //顶层路由,对应index.html
            children: [ // 二级路由.对应App.vue
                //地址为空时,跳转game页面
                //之后地址为空时,跳转home页面,让用户进行登录
                {
                    path: '',
                    redirect: '/agreement'
                },
                //协议路由
                {
                    path: '/agreement',
                    name: 'agreement',
                    component: resolve => void(require(['./../components/user/agreement/Agreement'], resolve))
                },
                //首页列表页
                //登录后首页game页面
                {
                    path: '/game',
                    component: Game, // game页面路由
                    children: [{
                        //默认的时候,加载两面盘页面的元素
                        path: '',
                        component:Mspk10Lmp
                    },{
                        path: '/mspk10/lmp', // 两面盘的路径
                        name: 'mspk10Lmp',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Mspk10Lmp.vue'],r)
                    },{
                        path: '/mspk10/sol', // 单号1~10的路径
                        name: 'mspk10Sol',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Mspk10Sol.vue'],r)
                    },{
                        path: '/mspk10/com', // 冠亚组合的路径
                        name: 'mspk10Com',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Mspk10Com.vue'],r)
                    },{
                        path: '/pk10/lmp',
                        name: 'pk10Lmp',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Pk10Lmp.vue'],r)
                    },{
                        path: '/pk10/sol',
                        name: 'pk10Sol',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Pk10Sol.vue'],r)
                    },{
                        path: '/pk10/com',
                        name: 'pk10Com',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Pk10Com.vue'],r)
                    },{
                        path: '/msft/lmp',
                        name: 'msftLmp',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MsftLmp.vue'],r)
                    },{
                        path: '/msft/sol',
                        name: 'msftSol',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MsftSol'],r)
                    },{
                        path: '/msft/com',
                        name: 'msftCom',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MsftCom.vue'],r)
                    },{
                        path: '/msssc/comb',
                        name: 'mssscComb',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MssscComb.vue'],r)
                    },{
                        path: '/msssc/sol1',
                        name: 'mssscSol1',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MssscSol1.vue'],r)
                    },{
                        path: '/msssc/sol2',
                        name: 'mssscSol2',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MssscSol2.vue'],r)
                    },{
                        path: '/msssc/sol3',
                        name: 'mssscSol3',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MssscSol3.vue'],r)
                    },{
                        path: '/msssc/sol4',
                        name: 'mssscSol4',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MssscSol4.vue'],r)
                    },{
                        path: '/msssc/sol5',
                        name: 'mssscSol5',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/MssscSol5.vue'],r)
                    },{
                        path: '/cqssc/comb',
                        name: 'cqsscComb',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/CqsscComb.vue'],r)
                    },{
                        path: '/cqssc/sol1',
                        name: 'cqsscSol1',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/CqsscSol1.vue'],r)
                    },{
                        path: '/cqssc/sol2',
                        name: 'cqsscSol2',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/CqsscSol2.vue'],r)
                    },{
                        path: '/cqssc/sol3',
                        name: 'cqsscSol3',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/CqsscSol3.vue'],r)
                    },{
                        path: '/cqssc/sol4',
                        name: 'cqsscSol4',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/CqsscSol4.vue'],r)
                    },{
                        path: '/cqssc/sol5',
                        name: 'cqsscSol5',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/CqsscSol5.vue'],r)
                    },{
                        path: '/xjssc/comb',
                        name: 'xjsscComb',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/XjsscComb.vue'],r)
                    },{
                        path: '/xjssc/sol1',
                        name: 'xjsscSol1',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/XjsscSol1.vue'],r)
                    },{
                        path: '/xjssc/sol2',
                        name: 'xjsscSol2',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/XjsscSol2.vue'],r)
                    },{
                        path: '/xjssc/sol3',
                        name: 'xjsscSol3',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/XjsscSol3.vue'],r)
                    },{
                        path: '/xjssc/sol4',
                        name: 'xjsscSol4',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/XjsscSol4.vue'],r)
                    },{
                        path: '/xjssc/sol5',
                        name: 'xjsscSol5',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/XjsscSol5.vue'],r)
                    },{
                        path: '/xydd/xydd',
                        name: 'xydd',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Xydd.vue'],r)
                    },{
                        path: '/pcdd/pcdd',
                        name: 'pcdd',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Pcdd.vue'],r)
                    },{
                        path: '/xykl8/lmp',
                        name: 'xykl8Lmp',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Xykl8Lmp.vue'],r)
                    },{
                        path: '/xykl8/zhbswx',
                        name: 'xykl8Zhbswx',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Xykl8Zhbswx.vue'],r)
                    },{
                        path: '/xykl8/zm',
                        name: 'xykl8Zm',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Xykl8Zm.vue'],r)
                    },{
                        path: '/bjkl8/zhbswx',
                        name: 'bjkl8Zhbswx',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Bjkl8Zhbswx.vue'],r)
                    },{
                        path: '/bjkl8/zm',
                        name: 'bjkl8Zm',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Bjkl8Zm.vue'],r)
                    },{
                        path: '/jstb/dxtb',
                        name: 'jsk3Dxtb',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Jsk3.vue'],r)
                    },{
                        path: '/gd11x5/lmp',
                        name: 'gd11x5Lmp',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Gd11x5Lmp.vue'],r)
                    },{
                        path: '/gd11x5/sol',
                        name: 'gd11x5Sol',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/Gd11x5Sol.vue'],r)
                    },{
                        path: '/gdklsf/lmp',
                        name: 'gdklsfLmp',
                        component: r => require(['../components/user/parts/mainWrap/contMain_parts/GdklsfLmp.vue'],r)
                    },
                        // 顶部路由
                        {
                            path: '/betList/unsettled',
                            name: 'headerTopBetListUnsettled',
                            component: r => require(['../components/user/parts/header/headerTop/HeaderTopBetListUnsettled.vue'],r)
                        },{
                            path: '/betList/settled',
                            name: 'headerTopBetListSettled',
                            component: r => require(['../components/user/parts/header/headerTop/HeaderTopBetListSettled.vue'],r)
                        },{
                            path: '/frame/history',
                            name: 'headerTopFrameHistory',
                            component: r => require(['../components/user/parts/header/headerTop/HeaderTopFrameHistory.vue'],r)
                        },{
                            path: '/betReport',
                            name: 'headerTopBetReport',
                            component: r => require(['../components/user/parts/header/headerTop/HeaderTopBetReport.vue'],r)
                        },{
                            path: '/frame/userBetInfo',
                            name: 'headerTopUserBetInfo',
                            component: r => require(['../components/user/parts/header/headerTop/HeaderTopUserBetInfo.vue'],r)
                        },{
                            path: '/frame/gameRule',
                            name: 'headerTopGameRule',
                            component: r => require(['../components/user/parts/header/headerTop/HeaderTopGameRule.vue'],r)
                        },
                        //  充值记录
                        {
                            path: '/financial',
                            name: 'headerTopFinacial',
                            component: r => require(['../components/user/parts/header/headerTop/HeaderTopFinacial.vue'],r)
                        },
                        {
                            // 抽奖活动
                            path:'/frame/cjhd',
                            name: 'cjhd',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Cjhd.vue'],r)
                        },
                        {
                            // 每日签到
                            path:'/frame/mrqd',
                            name: 'mrqd',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Mrqd.vue'],r)
                        },
                        {
                            //登录送豪礼
                            path:'/frame/dlshl',
                            name: 'dlshl',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Dlshl.vue'],r)
                        },
                        {
                            //个人中心
                            path:'/frame/grzx',
                            name: 'grzx',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Grzx.vue'],r)
                        },
                        {
                            //在线充值
                            path:'/frame/zxcz',
                            name: 'zxcz',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Zxcz.vue'],r)
                        },
                        {
                            //密码设置
                            path:'/frame/mmsz',
                            name: 'mmsz',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Mmsz.vue'],r)
                        },
                        {
                            //提款密码
                            path:'/frame/tkmm',
                            name: 'tkmm',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Tkmm.vue'],r)
                        },
                        {
                            //支付宝在线支付
                            path:'/frame/zfb',
                            name: 'zfb',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Zfb.vue'],r)
                        },
                        {
                            //微信在线支付
                            path:'/frame/wechat',
                            name: 'wechat',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Wechat.vue'],r)
                        },
                        {
                            //QQ在线支付
                            path:'/frame/qpay',
                            name: 'qpay',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Qpay'],r)
                        },
                        {
                            //微信转账
                            path:'/frame/wechatchange',
                            name: 'wechatchange',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Wechatchange.vue'],r)
                        },
                        {
                            //财付通转账
                            path:'/frame/cft',
                            name: 'cft',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Cft.vue'],r)
                        },
                        //支付宝转账
                        {
                            path:'/frame/zfbzz',
                            name: 'zfbzz',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/ZfbZz.vue'],r)
                        },
                        //银行卡转账
                        {
                            path:'/frame/yhkzz',
                            name: 'yhkzz',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Yhkzz.vue'],r)
                        },
                        {
                            //银联快捷扫码
                            path:'/frame/yl',
                            name: 'yl',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Yl.vue'],r)
                        },
                        {
                            //京东支付
                            path:'/frame/jd',
                            name: 'jd',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Jd.vue'],r)
                        },

                        {
                            //提款
                            path:'/frame/tk',
                            name: 'tk',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Tk.vue'],r)
                        },
                        {
                            // 添加银行卡
                            path:'/frame/tjyhk',
                            name:'tjyhk',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Tjyhk.vue'],r)
                        },
                        {
                            // 确认提款
                            path:'/frame/qrtk',
                            name:'qrtk',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Qrtk.vue'],r)
                        },
                        {
                            //提款记录
                            path:'/frame/tkjl',
                            name: 'tkjl',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Tkjl.vue'],r)
                        },
                        {
                            //其它记录
                            path:'/frame/other',
                            name: 'other',
                            component: r => require(['../components/user/parts/mainWrap/siderBar/Other.vue'],r)
                        },
                        // {
                        //     path : '/frame/tjyhk',
                        //     name: 'tjyhk',
                        //     component: r => require(['../components/user/parts/mainWrap/siderBar/Tjyhk.vue'],r)
                        // }

                    ]
                }
            ]
        }
    ]
})
