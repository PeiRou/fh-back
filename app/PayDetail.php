<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PayDetail extends Model
{
    protected $table = 'pay_detail';

    public static function getData($aParam){
        $aSql = "SELECT `third_name`,`third`,COUNT(DISTINCT(`platform`)) AS `payPlatform`,SUM(`success_order`) AS `success_order`,SUM(`total_order`) AS `total_order`, 
                    SUM(`success_money`) AS `success_money`,SUM(`total_money`) AS `total_money`,SUM(`success_order`)/SUM(`total_order`) AS `rate_order`
                    FROM `pay_detail` WHERE 1 ";
        $aArray = [];
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `product_at` >= :startTime";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `product_at` <= :endTime";
            $aArray['endTime'] = $aParam['endTime'];
        }
        if(isset($aParam['type']) && array_key_exists('type',$aParam)){
            $aSql .= " AND `type` = :type";
            $aArray['type'] = $aParam['type'];
        }
        $aSql .= " GROUP BY `third`";
        if(isset($aParam['order']) && array_key_exists('order',$aParam)){
            switch ($aParam['order']){
                case 1 :
                    $aSql .= " ORDER BY `payPlatform` DESC";
                    break;
                case 2 :
                    $aSql .= " ORDER BY `rate_order` DESC";
                    break;
                case 3 :
                    $aSql .= " ORDER BY `success_order` DESC";
                    break;
                case 4 :
                    $aSql .= " ORDER BY `success_money` DESC";
                    break;
                default :
                    $aSql .= " ORDER BY `payPlatform` DESC";
                    break;
            }
        }
        $aSql .= ",`third` ASC LIMIT :start,:length";
        $aArray['start'] = $aParam['start'];
        $aArray['length'] = $aParam['length'];
        return DB::select($aSql,$aArray);
    }
}
