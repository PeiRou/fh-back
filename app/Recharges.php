<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recharges extends Model
{
    protected $table = 'recharges';

    public static $rechargesType = [
        '1' => '加彩金',
        '2' => '掉单补发',
        '3' => '其他'
    ];

    public static function getDailyStatistics($dayTime){
        return self::select(DB::raw("'userId','SUM(amount) AS amountSum','COUNT(id) AS idCount'"))->where('status',2)
            ->whereBetween('created_at',[$dayTime,$dayTime.' 23:59:59'])
            ->groupBy('userId')
            ->get();
    }

}
