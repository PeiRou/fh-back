<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public static function exportUserData($aParam){
        $aSql = "SELECT `users`.`bank_name`,`users`.`content`,`users`.`bank_num`,`users`.`bank_addr`,`users`.`wechat`,`users`.`username`,`users`.`fullName`,`users`.`email`,`users`.`mobile`,`users`.`created_at`,`users`.`saveMoneyCount`,`users`.`lastLoginTime`,`re`.`sumReAmount`,`re`.`sumReAmountAd`,`dr`.`sumDrAmount`,`dr`.`sumDrAmountAd` FROM `users` 
LEFT JOIN (SELECT SUM(CASE WHEN `payType` != 'adminAddMoney' THEN `amount` ELSE 0 END) AS sumReAmount,SUM(CASE WHEN `payType` = 'adminAddMoney' THEN `amount` ELSE 0 END) AS sumReAmountAd,`userId` FROM `recharges` WHERE `status` = 2 GROUP BY `userId`) AS `re` ON `re`.`userId` = `users`.`id` 
LEFT JOIN (SELECT SUM(CASE WHEN `draw_type` != 2 THEN `amount` ELSE 0 END ) AS sumDrAmount,SUM(CASE WHEN `draw_type` = 2 THEN `amount` ELSE 0 END ) AS sumDrAmountAd,`user_id` FROM `drawing` WHERE `status` = 2 GROUP BY `user_id`) AS `dr` ON `dr`.`user_id` = `users`.`id` 
WHERE `users`.`testFlag` = 0 ";
        $aArray = [];
        if(isset($aParam['login_type']) && array_key_exists('login_type',$aParam)){
            if($aParam['login_type'] == 1){
                if(isset($aParam['day']) && array_key_exists('day',$aParam)){
                    $aSql .= " AND `users`.`lastLoginTime` <= :day ";
                    $aArray['day'] = date('Y-m-d 23:59:59',strtotime('-'.$aParam['day'].' day'));
                }
            }else{
                if(isset($aParam['startDay']) && array_key_exists('startDay',$aParam)){
                    $aSql .= " AND `users`.`lastLoginTime` >= :startDay ";
                    $aArray['startDay'] = $aParam['startDay'];
                }
                if(isset($aParam['endDay']) && array_key_exists('endDay',$aParam)){
                    $aSql .= " AND `users`.`lastLoginTime` <= :endDay ";
                    $aArray['endDay'] = $aParam['endDay'] .' 23:59:59';
                }
            }
        }
        if(isset($aParam['agentId']) && array_key_exists('agentId',$aParam)){
            $aSql .= " AND `users`.`agent` = :agent ";
            $aArray['agent'] = $aParam['agentId'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `users`.`created_at` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `users`.`created_at` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'] .' 23:59:59';
        }
        if(isset($aParam['username']) && array_key_exists('username',$aParam)){
            $aSql .= " AND `users`.`username` = :username ";
            $aArray['username'] = $aParam['username'];
        }
        if(isset($aParam['money']) && array_key_exists('money',$aParam)){
            $aSql .= " AND `re`.`sumAmount` >= :money ";
            $aArray['money'] = $aParam['money'];
        }
        $aSql .= " ORDER BY `users`.`lastLoginTime` DESC";
        return DB::select($aSql,$aArray);
    }
}
