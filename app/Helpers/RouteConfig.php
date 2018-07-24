<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/1/26
 * Time: 下午9:04
 */

namespace App\Helpers;

class RouteConfig
{
    public static $routeList = [
        'back' => [
            'name' => '登陆分组',
            'route' => [
                    'back.Agent.login' => '代理登录页面',
                    'back.login' => '管理登录页面'
                ]
        ],
        'dash' => [
            'name' => '控制台',
            'route' => [
                    'dash' => '控制台'
                ]
        ],
        'm' => [
            'name' => '用户管理',
            'route' => [
                    'm.gAgent' => '总代理',
                    'm.agent' => '代理',
                    'm.user' => '用户',
                    'm.onlineUser' => '在线会员',
                    'm.subAccount' => '子账号',
                    'm.user.viewDetails' => '用户注单明细'
            ]
        ],
        'finance' => [
            'name' => '财务管理',
            'route' => [
                    'finance.rechargeRecord' => '充值记录',
                    'finance.drawingRecord' => '充值记录',
                    'finance.capitalDetails' => '资金明细',
                    'finance.memberReconciliation' => '会员对账',
                    'finance.agentReconciliation' => '代理对账'
                ]
        ],
        'report' => [
            'name' => '报表管理',
            'route' => [
                'report.gAgent' => '总代理报表',
                'report.agent' => '代理报表',
                'report.user' => '会员报表',
                'report.online' => '在线报表'
            ]
        ],
        'bet' => [
            'name' => '投注记录',
            'route' => [
                'bet.todaySearch' => '今日注单搜索',
                'bet.historySearch' => '历史注单搜索',
                'bet.betRealTime' => '实时滚单'
            ]
        ],
        'notice' => [
            'name' => '公告管理',
            'route' => [
                'notice.noticeSetting' => '公告设置',
                'notice.messageSend' => '消息推送'
            ]
        ],
        'game' => [
            'name' => '游戏管理',
            'route' => [
                'game.gameSetting' => '游戏设定',
                'game.handicapSetting' => '盘口设定'
            ]
        ],
        'historyLottery' => [
            'name' => '开奖管理',
            'route' => [
                'historyLottery.xglhc' => '六合彩',
                'historyLottery.xylhc' => '幸运六合彩'
            ]
        ],
        'system' => [
            'name' => '系统管理',
            'route' => [
                'system.permission' => '权限管理',
                'system.role' => '角色管理',
                'system.systemSetting' => '系统参数配置',
                'system.articleManage' => '文章管理'
            ]
        ],
        'log' => [
            'name' => '日志管理',
            'route' => [
                'log.login' => '登录日志',
                'log.handle' => '操作日志',
                'log.abnormal' => '异常日志'
            ]
        ],
        'pay' => [
            'name' => '充值配置',
            'route' => [
                'pay.online' => '在线支付配置',
                'pay.bank' => '银行支付配置',
                'pay.alipay' => '支付宝支付配置',
                'pay.wechat' => '微信支付配置',
                'pay.cft' => '财付通支付配置',
                'pay.bindBank' => '绑定银行配置',
                'pay.payLayout' => '支付层级配置',
                'pay.rechargeWay' => '支付层级配置',
            ]
        ],
        'select' => [
            'name' => '下拉菜单',
            'route' => [
                'select.playCate' => '下拉菜单获取玩法分类',
                'select.payOnlineSelectData' => '下拉菜单获取在线支付分类',
                'select.payOnlineDateChange' => '下拉菜单获取今日，昨日，上周',
            ]
        ],
        'error' => [
            'name' => '未知类型',
            'route' => []
        ]
    ];
}