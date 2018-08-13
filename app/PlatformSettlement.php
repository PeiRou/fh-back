<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatformSettlement extends Model
{
    protected $table = 'platform_settlement';

    public static $PlatformStatus = [
        '1' => '未结算',
        '2' => '已结算',
        '3' => '本月未生成',
    ];


}
