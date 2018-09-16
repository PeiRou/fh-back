<?php

namespace App\Http\Controllers\Back;

use App\SubAccount;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function returnVisit(Request $request){
        ini_set('memory_limit','1024M');
        $aParam = $request->all();
        $aData = Users::exportUserData($aParam);
        if(empty($aData))
            return redirect('/back/control/userManage/user')->with('message', '该条件下没有会员');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】回访用户',function ($excel) use ($aData,$todayTime){
            $excel->sheet('【'.$todayTime.'】回访用户', function($sheet) use ($aData,$todayTime){
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','新增时间','未登录时间','是否存款','存款金额记录','取款金额记录']);
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
                        empty($iData->sumReAmount)?'0.00':$iData->sumReAmount,
                        empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
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

    public function exportUser(Request $request){
        ini_set('memory_limit','1024M');
        $aParam = $request->all();
        $ga = new \PHPGangsta_GoogleAuthenticator();
        $find = SubAccount::where('sa_id',Session::get('account_id'))->first();
        if($find->role !== 1){
            $checkGoogle = $ga->verifyCode($find->google_code,$aParam['code']);
            if($checkGoogle)
                redirect('/back/control/userManage/user')->with('message', 'Google验证码错误');
        }
        $aData = Users::exportUserData($aParam);
        if(empty($aData))
            return redirect('/back/control/userManage/user')->with('message', '该条件下没有会员');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】导出用户数据-['.$aParam['startTime'].'-'.$aParam['endTime'].']',function ($excel) use ($aData,$todayTime){
            $excel->sheet('【'.$todayTime.'】导出用户数据', function($sheet) use ($aData,$todayTime){
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','开户银行','银行卡号','支行地址','微信','新增时间','未登录时间','是否存款','存款金额记录','取款金额记录','备注信息']);
                $sheetHeight = [
                    1 => 20,
                ];
                foreach ($aData as $kData => $iData){
                    $sheet->appendRow([
                        $iData->username,
                        empty($iData->fullName)?'':$iData->fullName,
                        empty($iData->email)?'':$iData->email,
                        empty($iData->mobile)?'':$iData->mobile,
                        empty($iData->bank_name)?'':$iData->bank_name,
                        empty($iData->bank_num)?'':$iData->bank_num,
                        empty($iData->bank_addr)?'':$iData->bank_addr,
                        empty($iData->wechat)?'':$iData->wechat,
                        $iData->created_at,
                        floor((strtotime($todayTime) - strtotime(substr($iData->lastLoginTime,0,10)))/3600/24),
                        empty($iData->sumAmount)?'否':'是',
                        empty($iData->sumAmount)?'0.00':$iData->sumAmount,
                        empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
                        empty($iData->content)?'0.00':$iData->content,
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
                    'H'    =>  10,
                    'I'    =>  10,
                    'J'    =>  10,
                    'K'    =>  10,
                    'L'    =>  10,
                    'M'    =>  10,
                    'N'    =>  10,
                ));
            });
        })->export('xls');
    }
}
