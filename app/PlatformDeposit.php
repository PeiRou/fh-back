<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatformDeposit extends Model
{
    protected $table = 'platform_deposit';

    public static $PlatformStatus = [
        '1' => '付款中',
        '2' => '付款成功',
        '3' => '付款失败',
    ];

    public static $PlatformType = [
        '1' => '在线支付',
        '2' => '银行卡支付',
    ];


}
