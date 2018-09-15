<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public static function exportUserData($aParam){
        $aSql = "SELECT `users`.`username`,`users`.`fullName`,`users`.`email`,`users`.`mobile`,`users`.`created_at`,`users`.`saveMoneyCount`,`users`.`lastLoginTime`,`re`.`sumAmount` FROM `users` LEFT JOIN (SELECT (CASE WHEN SUM(amount) IS NULL THEN 0 ELSE SUM(amount) END) AS sumAmount,`userId` FROM `recharges` WHERE `status` = 3 GROUP BY `userId`) AS `re` ON `re`.`userId` = `users`.`id` WHERE 1 ";
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
