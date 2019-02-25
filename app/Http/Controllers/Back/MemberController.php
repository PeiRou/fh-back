<?php

namespace App\Http\Controllers\Back;

use App\Agent;
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
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','新增时间','未登录时间','是否存款','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录']);
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
                        empty($iData->sumReAmount)?'否':'是',
                        empty($iData->sumReAmount)?'0.00':$iData->sumReAmount,
                        empty($iData->sumReAmountAd)?'0.00':$iData->sumReAmountAd,
                        empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
                        empty($iData->sumDrAmountAd)?'0.00':$iData->sumDrAmountAd,
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
                    'I'    =>  12,
                    'J'    =>  12,
                    'K'    =>  12,
                ));
            });
        })->export('xls');
    }

    public function visitMember($agentId,$name){
        ini_set('memory_limit','1024M');
        $aData = Users::exportUserData(['agentId'=>$agentId]);
        if(empty($aData))
            return redirect('/back/control/userManage/agent')->with('message', '该条件下没有会员');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】回访用户',function ($excel) use ($aData,$todayTime){
            $excel->sheet('【'.$todayTime.'】回访用户', function($sheet) use ($aData,$todayTime){
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','新增时间','未登录时间','是否存款','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录']);
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
                        empty($iData->sumReAmount)?'否':'是',
                        empty($iData->sumReAmount)?'0.00':$iData->sumReAmount,
                        empty($iData->sumReAmountAd)?'0.00':$iData->sumReAmountAd,
                        empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
                        empty($iData->sumDrAmountAd)?'0.00':$iData->sumDrAmountAd,
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
                    'I'    =>  12,
                    'J'    =>  12,
                    'K'    =>  12,
                ));
            });
        })->export('xls');
    }

    public function visitMemberSuper($agentId,$name){
        ini_set('memory_limit','1024M');
        $aData = Users::exportUserData(['agentId'=>$agentId,'amount'=>0]);
        if(empty($aData))
            return redirect('/back/control/userManage/agent')->with('message', '该条件下没有会员');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】回访用户',function ($excel) use ($aData,$todayTime){
            $excel->sheet('【'.$todayTime.'】回访用户', function($sheet) use ($aData,$todayTime){
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','新增时间','未登录时间','是否存款','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录']);
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
                        empty($iData->sumReAmount)?'否':'是',
                        empty($iData->sumReAmount)?'0.00':$iData->sumReAmount,
                        empty($iData->sumReAmountAd)?'0.00':$iData->sumReAmountAd,
                        empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
                        empty($iData->sumDrAmountAd)?'0.00':$iData->sumDrAmountAd,
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
                    'I'    =>  12,
                    'J'    =>  12,
                    'K'    =>  12,
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
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','开户银行','银行卡号','支行地址','微信','新增时间','未登录时间','是否存款','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录','备注信息']);
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
                        empty($iData->sumReAmount)?'否':'是',
                        empty($iData->sumReAmount)?'0.00':$iData->sumReAmount,
                        empty($iData->sumReAmountAd)?'0.00':$iData->sumReAmountAd,
                        empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
                        empty($iData->sumDrAmountAd)?'0.00':$iData->sumDrAmountAd,
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
                    'L'    =>  12,
                    'M'    =>  12,
                    'N'    =>  12,
                    'O'    =>  12,
                    'P'    =>  12,
                ));
            });
        })->export('xls');
    }

    public function exportMember($agentId,$name){
        ini_set('memory_limit','1024M');
        $aData = Users::exportUserData(['agentId'=>$agentId]);
        if(empty($aData))
            return redirect('/back/control/userManage/agent')->with('message', '该条件下没有会员');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】导出用户数据-[代理：'.$name.']',function ($excel) use ($aData,$todayTime){
            $excel->sheet('【'.$todayTime.'】导出用户数据', function($sheet) use ($aData,$todayTime){
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','开户银行','银行卡号','支行地址','微信','新增时间','未登录时间','是否存款','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录','备注信息']);
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
                        empty($iData->sumReAmount)?'否':'是',
                        empty($iData->sumReAmount)?'0.00':$iData->sumReAmount,
                        empty($iData->sumReAmountAd)?'0.00':$iData->sumReAmountAd,
                        empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
                        empty($iData->sumDrAmountAd)?'0.00':$iData->sumDrAmountAd,
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
                    'L'    =>  12,
                    'M'    =>  12,
                    'N'    =>  12,
                    'O'    =>  12,
                    'P'    =>  12,
                ));
            });
        })->export('xls');
    }

    public function exportGAgentMember ($GagentId,$name) {
        ini_set("auto_detect_line_endings", true);
        ini_set('memory_limit','1024M');
        set_time_limit(0);
        $inAgentId = Agent::where('gagent_id', $GagentId)->pluck('a_id')->toArray();
        if(empty($inAgentId))
            return redirect('/back/control/userManage/general_agent')->with('message', '该条件下没有会员');
        $aData = Users::exportUserData(['inAgentId'=>$inAgentId, 'inTestFlag' => [0, 2]]);
        if(empty($aData))
            return redirect('/back/control/userManage/general_agent')->with('message', '该条件下没有会员');
        $todayTime = date('Y-m-d');
        $columns =['用户账号','用户姓名','用户邮箱','用户手机','开户银行','银行卡号','支行地址','微信','新增时间',
            '未登录时间','是否存款','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录','备注信息'];
        $csvFileName = '【'.$todayTime.'】导出用户数据-[代理：'.$name.'].csv';
        //设置好告诉浏览器要下载excel文件的headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$csvFileName.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        $fp = fopen('php://output', 'a');//打开output流
        mb_convert_variables('GBK', 'UTF-8', $columns);
        fputcsv($fp, $columns);//将数据格式化为CSV格式并写入到output流中
        foreach ($aData as $k=>$iData){
            $rowData =[
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
                empty($iData->sumReAmount)?'否':'是',
                empty($iData->sumReAmount)?'0.00':$iData->sumReAmount,
                empty($iData->sumReAmountAd)?'0.00':$iData->sumReAmountAd,
                empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
                empty($iData->sumDrAmountAd)?'0.00':$iData->sumDrAmountAd,
                empty($iData->content)?'0.00':$iData->content,
                 ];
            mb_convert_variables('GBK', 'UTF-8', $rowData);
            fputcsv($fp, $rowData);
        }
        unset($aData);//释放变量的内存
        //刷新输出缓冲到浏览器
        ob_flush();
        flush();//必须同时使用 ob_flush() 和flush() 函数来刷新输出缓冲。
        fclose($fp);
        exit();
    }

    public function exportMemberSuper($agentId,$name){
        ini_set('memory_limit','1024M');
        $aData = Users::exportUserData(['agentId'=>$agentId,'amount'=>0]);
        if(empty($aData))
            return redirect('/back/control/userManage/agent')->with('message', '该条件下没有会员');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】导出用户数据-[代理：'.$name.']',function ($excel) use ($aData,$todayTime){
            $excel->sheet('【'.$todayTime.'】导出用户数据', function($sheet) use ($aData,$todayTime){
                $sheet->appendRow(['用户账号','用户姓名','用户邮箱','用户手机','可用余额','开户银行','银行卡号','支行地址','微信','新增时间','未登录时间','是否存款','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录','备注信息']);
                $sheetHeight = [
                    1 => 20,
                ];
                foreach ($aData as $kData => $iData){
                    $sheet->appendRow([
                        $iData->username,
                        empty($iData->fullName)?'':$iData->fullName,
                        empty($iData->email)?'':$iData->email,
                        empty($iData->mobile)?'':$iData->mobile,
                        empty($iData->money)?'':$iData->money,
                        empty($iData->bank_name)?'':$iData->bank_name,
                        empty($iData->bank_num)?'':$iData->bank_num,
                        empty($iData->bank_addr)?'':$iData->bank_addr,
                        empty($iData->wechat)?'':$iData->wechat,
                        $iData->created_at,
                        floor((strtotime($todayTime) - strtotime(substr($iData->lastLoginTime,0,10)))/3600/24),
                        empty($iData->sumReAmount)?'否':'是',
                        empty($iData->sumReAmount)?'0.00':$iData->sumReAmount,
                        empty($iData->sumReAmountAd)?'0.00':$iData->sumReAmountAd,
                        empty($iData->sumDrAmount)?'0.00':$iData->sumDrAmount,
                        empty($iData->sumDrAmountAd)?'0.00':$iData->sumDrAmountAd,
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
                    'L'    =>  12,
                    'M'    =>  12,
                    'N'    =>  12,
                    'O'    =>  12,
                    'P'    =>  12,
                ));
            });
        })->export('xls');
    }
}
