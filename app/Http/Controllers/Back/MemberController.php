<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function returnVisit(Request $request){
        ini_set('memory_limit','1024M');
        $aParam = $request->all();
        $aSql = "SELECT `users`.`username`,`users`.`fullName`,`users`.`email`,`users`.`mobile`,`users`.`created_at`,`users`.`saveMoneyCount`,`users`.`lastLoginTime`,`re`.`sumAmount` FROM `users` LEFT JOIN (SELECT SUM(amount) AS sumAmount,`userId` FROM `recharges` WHERE `status` = 3 GROUP BY `userId`) AS `re` ON `re`.`userId` = `users`.`id` WHERE 1 ";
        $aArray = [];
        if(isset($aParam['startDay']) && array_key_exists('startDay',$aParam)){
            $aSql .= " AND `users`.`lastLoginTime` >= :startDay ";
            $aArray['startDay'] = $aParam['startDay'];
        }
        if(isset($aParam['endDay']) && array_key_exists('endDay',$aParam)){
            $aSql .= " AND `users`.`lastLoginTime` <= :endDay ";
            $aArray['endDay'] = $aParam['endDay'] .' 23:59:59';
        }
        if(isset($aParam['money']) && array_key_exists('money',$aParam)){
            $aSql .= " AND `re`.`sumAmount` >= :money ";
            $aArray['money'] = $aParam['money'];
        }
        $aSql .= " ORDER BY `users`.`lastLoginTime` DESC";
        $aData = DB::select($aSql,$aArray);
//        $cellData = [
//            ['用户账号','用户姓名','用户邮箱','用户手机','新增时间','未登录时间','是否存款','存款金额记录','存款总额']
//        ];
        $todayTime = date('Y-m-d');
//        foreach ($aData as $kData => $iData){
//            $cellData[] = [
//                $iData->username,
//                empty($iData->fullName)?'':$iData->fullName,
//                empty($iData->email)?'':$iData->email,
//                empty($iData->mobile)?'':$iData->mobile,
//                $iData->created_at,
//                floor((strtotime($todayTime) - strtotime(substr($iData->lastLoginTime,0,10)))/3600/24),
//                empty($iData->sumAmount)?'否':'是',
//                empty($iData->sumAmount)?'0.00':$iData->sumAmount,
//                empty($iData->saveMoneyCount)?'0.00':$iData->saveMoneyCount,
//            ];
//        }
        Excel::create('【'.$todayTime.'】回访用户-['.$aParam['startDay'].'-'.$aParam['endDay'].']',function ($excel) use ($aData,$todayTime){
            $excel->sheet('【'.$todayTime.'】回访用户', function($sheet) use ($aData,$todayTime){
//                $sheet->rows($cellData);
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','新增时间','未登录时间','是否存款','存款金额记录','存款总额']);
                $sheetHeight = [
                    1 => 20,
                ];
                foreach ($aData as $kData => $iData){
                    $sheet->appendRow([
                        $iData->username,
                        empty($iData->fullName)?'':$iData->fullName,
                        empty($iData->email)?'':$iData->email,
                        empty($iData->mobile)?'':$iData->mobile,
                        $iData->created_at,
                        floor((strtotime($todayTime) - strtotime(substr($iData->lastLoginTime,0,10)))/3600/24),
                        empty($iData->sumAmount)?'否':'是',
                        empty($iData->sumAmount)?'0.00':$iData->sumAmount,
                        empty($iData->saveMoneyCount)?'0.00':$iData->saveMoneyCount,
                    ]);
                    $sheetHeight[$kData + 2] = 20;
                }
                $sheet->setHeight($sheetHeight);
                $sheet->setWidth(array(
                    'A'    =>  10,
                    'B'    =>  20,
                    'C'    =>  10,
                    'D'    =>  15,
                    'E'    =>  18,
                    'F'    =>  10,
                    'G'    =>  10,
                    'H'    =>  12,
                    'I'    =>  10,
                ));
            });
        })->export('xls');
    }
}
