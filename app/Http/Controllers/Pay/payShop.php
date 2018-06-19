<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/6/19
 * Time: 下午7:53
 */

namespace App\Http\Controllers\Pay;


class payShop
{
    public function list()
    {
        return [
            1 => [
                'rechName' => '仁信（微信）',
                'company' => 'RENXIN',
                'code' => 'WX',
                'pcMobile' => 0,
                'status' => 1,
                'url' => 'http://dpos.rxpay88.com/Online/GateWay',
                'whitelist' => []
            ],
            2 => [
                'rechName' => '仁信（支付宝）',
                'company' => 'RENXIN',
                'code' => 'ZFB',
                'pcMobile' => 0,
                'status' => 1,
                'url' => 'http://dpos.rxpay88.com/Online/GateWay',
                'whitelist' => []
            ],
            3 => [
                'rechName' => '仁信（QQ钱包）',
                'company' => 'RENXIN',
                'code' => 'QQ',
                'pcMobile' => 0,
                'status' => 1,
                'url' => 'http://dpos.rxpay88.com/Online/GateWay',
                'whitelist' => []
            ],
            4 => [
                'rechName' => '仁信（京东钱包）',
                'company' => 'RENXIN',
                'code' => 'JD',
                'pcMobile' => 0,
                'status' => 1,
                'url' => 'http://dpos.rxpay88.com/Online/GateWay',
                'whitelist' => []
            ]
        ];
    }
}