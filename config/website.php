<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/2/10
 * Time: 上午2:27
 * 此文件作用，全局的配置文件，可以配置网站的所有可变参数
 */

return [
    //会员在线时间阈值 默认10分钟
    'userOnlineDiffTime' => 1,
    //当年的生肖
    'animalsYear' => '狗',
    //试玩用户的金额
    'guestMoney' => 20000,
    //试玩同一账号允许操作次数
    'guestTryTimes' => 20,
    //官方开奖
    'guanServerUrl' => env('GUAN_SERVER_URL'),
    //开奖服务器URL
    'openServerUrl'=> env('OPEN_SERVER_URL'),
    //第三方开奖接口
    'openApi' => [
        'url'   =>'http://e.apiplus.net/newly.do',
        'token' =>'a8e90a303ec6961f',
        'format'=>'json',
        'rows'  =>'1',
    ],
    //后台地址
    'backEndUrl' => [env('BACK_IP_1'),env('BACK_IP_1')]
];