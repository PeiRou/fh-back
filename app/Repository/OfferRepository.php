<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository;

use Illuminate\Http\Request;

class OfferRepository extends BaseRepository
{
//    app('App\Repository\OfferRepository')->checkOffer();

    //有没有未支付的报价表
    public static function checkOffer ()
    {
        if(\Illuminate\Support\Facades\DB::table('offer')->where(function ($sql) {
            $sql->where('overstayed', '<', date('Y-m-d H:i:s'));
            $sql->where('status', '<>', 2);
        })->count()){
            return false;
        }
        return true;
    }

    /**
     *几分钟、几小时、几天的几个函数
     */
    public static function time_tran($dur) {
        if ($dur < 60) {
            return $dur . '秒';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时';
                } else {
                    if ($dur < (60 * 60 * 24 * 365)) {
                        //365天内
                        return floor($dur / 86400) . '天';
                    } else {
                        return floor($dur / (60 * 60 * 24 * 365)) . '年';;
                    }
                }
            }
        }
    }

    public static function offerCount ()
    {
        return \Illuminate\Support\Facades\DB::table('offer')->where(function ($sql) {
            $sql->where('overstayed', '<', date('Y-m-d H:i:s', strtotime(' +7 day')));
            $sql->where('status', '<>', 2);
        })->count();
    }

}