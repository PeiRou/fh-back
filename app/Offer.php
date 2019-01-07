<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offer';

    public static $status = [
        0 => '待审核',
        1 => '失败',
        2 => '成功',
    ];
    public static $paystatus = [
        0 => '未支付',
        1 => '支付中',
        2 => '支付成功',
        3 => '支付失败',
    ];

}
