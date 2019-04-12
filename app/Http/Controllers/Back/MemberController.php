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
                $sheet->appendRow(['用户账号','上级代理','用户姓名','用户邮箱','用户手机','开户银行','银行卡号','支行地址','微信','新增时间','未登录时间','是否存款','用户余额','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录','备注信息']);
                $sheetHeight = [
                    1 => 20,
                ];
                foreach ($aData as $kData => $iData){
                    $sheet->appendRow([
                        $iData->username,
                        $iData->agentAccount.'('.$iData->agentName.')',
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
                        empty($iData->money)?'0.00':$iData->money,
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
                    'F'    =>  18,
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
                    'Q'    =>  12,
                    'R'    =>  12,
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
                $sheet->appendRow(['用户账号','上级代理','用户姓名','用户邮箱','用户手机','开户银行','银行卡号','支行地址','微信','新增时间','未登录时间','是否存款','用户余额','存款金额记录','后台加钱记录','取款金额记录','后台扣钱记录','备注信息']);
                $sheetHeight = [
                    1 => 20,
                ];
                foreach ($aData as $kData => $iData){
                    $sheet->appendRow([
                        $iData->username,
                        $iData->agentAccount.'('.$iData->agentName.')',
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
                        empty($iData->money)?'0.00':$iData->money,
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
                    'C'    =>  20,
                    'D'    =>  15,
                    'E'    =>  18,
                    'F'    =>  18,
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
                    'Q'    =>  12,
                    'R'    =>  12,
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
        $columns =['用户账号','用户姓名','用户邮箱','用户手机','可用余额','开户银行','银行卡号','支行地址','微信','新增时间',
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

    //导出会员报表
    public function exportReportUser(Request $request){
        $aParam = $request->all();
        ini_set('memory_limit','1024M');
        $data = app(\App\Http\Controllers\Back\Data\ReportDataController::class)->UserData($request);
        $aData = $data['aData'];
        if(empty($aData) || count($request->column_ = explode(',', $request->column_)) < 1)
            return redirect('/back/control/reportManage/user')->with('message', '该条件下没有数据');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】导出会员报表-['.$aParam['timeStart'].'-'.$aParam['timeEnd'].']',function ($excel) use ($aData,$todayTime,$request){
            $excel->sheet('【'.$todayTime.'】导出会员报表', function($sheet) use ($aData,$todayTime,$request){
                $appendRowTitle = [];
                array_push($appendRowTitle, '');
                in_array('user_account', $request->column_) && array_push($appendRowTitle, '账号');
                in_array('user_name', $request->column_) && array_push($appendRowTitle, '姓名');
                in_array('agent_account', $request->column_) && array_push($appendRowTitle, '上级代理');
                in_array('recharges_money', $request->column_) && array_push($appendRowTitle, '充值金额');
                in_array('drawing_money', $request->column_) && array_push($appendRowTitle, '取款金额');
                in_array('bet_count', $request->column_) && array_push($appendRowTitle, '笔数');
                in_array('bet_money', $request->column_) && array_push($appendRowTitle, '投注金额');
                in_array('win_amount', $request->column_) && array_push($appendRowTitle, '中奖金额');
                in_array('bet_amount', $request->column_) && array_push($appendRowTitle, '赢利投注金额');
                in_array('activity_money', $request->column_) && array_push($appendRowTitle, '活动金额');
                in_array('handling_fee', $request->column_) && array_push($appendRowTitle, '充值优惠/手续费');
                in_array('bet_bunko', $request->column_) && array_push($appendRowTitle, '会员输赢(不含退水)');
                in_array('fact_return_amount', $request->column_) && array_push($appendRowTitle, '实际退水');
                in_array('fact_bet_bunko', $request->column_) && array_push($appendRowTitle, '实际输赢(含退水)');

                $sheet->appendRow($appendRowTitle);
                $sheetHeight = [
                    1 => 20,
                ];
                $arr = [];
                foreach ($aData as $kData => $iData){
                    $appendRowContent = [];
                    array_push($appendRowContent, '');
                    $activity_money = empty($iData->activity_money)?0:$iData->activity_money;
                    $handling_fee = empty($iData->handling_fee)?0:$iData->handling_fee;
                    $fact_return_amount = empty($iData->fact_return_amount)?0:$iData->fact_return_amount;
                    $fact_bet_bunko = round($iData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,2);
                    in_array('user_account', $request->column_) && array_push($appendRowContent, $iData->user_account) && $arr['user_account'] = '';
                    in_array('user_name', $request->column_) && array_push($appendRowContent, $iData->user_name) && $arr['user_name'] = '';
                    in_array('agent_account', $request->column_) && array_push($appendRowContent, $iData->agent_account) && $arr['agent_account'] = '';
                    in_array('recharges_money', $request->column_) && array_push($appendRowContent, $iData->recharges_money) && $arr['recharges_money'] = ($arr['recharges_money'] ?? 0) + $iData->recharges_money;
                    in_array('drawing_money', $request->column_) && array_push($appendRowContent, $iData->drawing_money) && $arr['drawing_money'] = ($arr['drawing_money'] ?? 0) + $iData->drawing_money;
                    in_array('bet_count', $request->column_) && array_push($appendRowContent, $iData->bet_count) && $arr['bet_count'] = ($arr['bet_count'] ?? 0) + $iData->bet_count;
                    in_array('bet_money', $request->column_) && array_push($appendRowContent, $iData->bet_money) && $arr['bet_money'] = ($arr['bet_money'] ?? 0) + $iData->bet_money;
                    in_array('win_amount', $request->column_) && array_push($appendRowContent, round($iData->bet_money + $iData->bet_bunko,2)) && $arr['win_amount'] = ($arr['win_amount'] ?? 0) + (round($iData->bet_money + $iData->bet_bunko,2));
                    in_array('bet_amount', $request->column_) && array_push($appendRowContent, $iData->bet_amount) && $arr['bet_amount'] = ($arr['bet_amount'] ?? 0) + $iData->bet_amount;
                    in_array('activity_money', $request->column_) && array_push($appendRowContent, $iData->activity_money) && $arr['activity_money'] = ($arr['activity_money'] ?? 0) + $iData->activity_money;
                    in_array('handling_fee', $request->column_) && array_push($appendRowContent, $iData->handling_fee) && $arr['handling_fee'] = ($arr['handling_fee'] ?? 0) + $iData->handling_fee;
                    in_array('bet_bunko', $request->column_) && array_push($appendRowContent, $iData->bet_bunko) && $arr['bet_bunko'] = ($arr['bet_bunko'] ?? 0) + $iData->bet_bunko;
                    in_array('fact_return_amount', $request->column_) && array_push($appendRowContent, $iData->fact_return_amount) && $arr['fact_return_amount'] = ($arr['fact_return_amount'] ?? 0) + $iData->fact_return_amount;
                    in_array('fact_bet_bunko', $request->column_) && array_push($appendRowContent, $fact_bet_bunko) && $arr['fact_bet_bunko'] = ($arr['fact_bet_bunko'] ?? 0) + $fact_bet_bunko;
                    $sheet->appendRow($appendRowContent);
                    $sheetHeight[$kData + 2] = 20;
                }
                $arrk = [];
                array_push($arrk, '总计：');
                foreach ($arr as $k=>$v){
                    array_push($arrk, $v);
                }
                $sheet->appendRow($arrk);
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
    //导出代理报表
    public function exportReportAgent(Request $request){
        $aParam = $request->all();
        ini_set('memory_limit','1024M');
        $data = app(\App\Http\Controllers\Back\Data\ReportDataController::class)->AgentData($request);
        $aData = $data['aData'];
        if(empty($aData) || count($request->column_ = explode(',', $request->column_)) < 1)
            return redirect('/back/control/reportManage/agent')->with('message', '该条件下没有数据');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】导出代理报表-['.$aParam['timeStart'].'-'.$aParam['timeEnd'].']',function ($excel) use ($aData,$todayTime,$request){
            $excel->sheet('【'.$todayTime.'】导出代理报表', function($sheet) use ($aData,$todayTime,$request){
                $appendRowTitle = [];
                array_push($appendRowTitle, '');
                in_array('agent_account', $request->column_) && array_push($appendRowTitle, '账号');
                in_array('memberCount', $request->column_) && array_push($appendRowTitle, '会员数');
                in_array('recharges_money', $request->column_) && array_push($appendRowTitle, '充值金额');
                in_array('drawing_money', $request->column_) && array_push($appendRowTitle, '取款金额');
                in_array('bet_count', $request->column_) && array_push($appendRowTitle, '笔数');
                in_array('bet_money', $request->column_) && array_push($appendRowTitle, '投注金额');
                in_array('win_amount', $request->column_) && array_push($appendRowTitle, '中奖金额');
                in_array('bet_amount', $request->column_) && array_push($appendRowTitle, '赢利投注金额');
                in_array('activity_money', $request->column_) && array_push($appendRowTitle, '活动金额');
                in_array('handling_fee', $request->column_) && array_push($appendRowTitle, '充值优惠/手续费');
                in_array('return_amount', $request->column_) && array_push($appendRowTitle, '代理退水金额');
                in_array('bet_bunko', $request->column_) && array_push($appendRowTitle, '会员输赢(不含退水');
                in_array('fact_return_amount', $request->column_) && array_push($appendRowTitle, '实际退水');
                in_array('fact_bet_bunko', $request->column_) && array_push($appendRowTitle, '实际输赢(含退水)');

                $sheet->appendRow($appendRowTitle);
                $sheetHeight = [1 => 20,];
                $arr = [];
                foreach ($aData as $kData => $iData){
                    $appendRowContent = [];
                    $activity_money = empty($iData->activity_money)?0:$iData->activity_money;
                    $handling_fee = empty($iData->handling_fee)?0:$iData->handling_fee;
                    $fact_return_amount = empty($iData->fact_return_amount)?0:$iData->fact_return_amount;
                    $fact_bet_bunko = round($iData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,2);

                    array_push($appendRowContent, '');
                    in_array('agent_account', $request->column_) && array_push($appendRowContent, $iData->agent_account) && $arr['agent_account'] = '';
                    in_array('memberCount', $request->column_) && array_push($appendRowContent, $iData->memberCount) && $arr['memberCount'] = ($arr['memberCount'] ?? 0) + $iData->memberCount;
                    in_array('recharges_money', $request->column_) && array_push($appendRowContent, $iData->recharges_money) && $arr['recharges_money'] = ($arr['recharges_money'] ?? 0) + $iData->recharges_money;
                    in_array('drawing_money', $request->column_) && array_push($appendRowContent, $iData->drawing_money) && $arr['drawing_money'] = ($arr['drawing_money'] ?? 0) + $iData->drawing_money;
                    in_array('bet_count', $request->column_) && array_push($appendRowContent, $iData->bet_count) && $arr['bet_count'] = ($arr['bet_count'] ?? 0) + $iData->bet_count;
                    in_array('bet_money', $request->column_) && array_push($appendRowContent, $iData->bet_money) && $arr['bet_money'] = ($arr['bet_money'] ?? 0) + $iData->bet_money;
                    in_array('win_amount', $request->column_) && array_push($appendRowContent, round($iData->bet_money + $iData->bet_bunko,2)) && $arr['win_amount'] = ($arr['win_amount'] ?? 0) + (round($iData->bet_money + $iData->bet_bunko,2));
                    in_array('bet_amount', $request->column_) && array_push($appendRowContent, $iData->bet_amount) && $arr['bet_amount'] = ($arr['bet_amount'] ?? 0) + $iData->bet_amount;
                    in_array('activity_money', $request->column_) && array_push($appendRowContent, $iData->activity_money) && $arr['activity_money'] = ($arr['activity_money'] ?? 0) + $iData->activity_money;
                    in_array('handling_fee', $request->column_) && array_push($appendRowContent, $iData->handling_fee) && $arr['handling_fee'] = ($arr['handling_fee'] ?? 0) + $iData->handling_fee;
                    in_array('return_amount', $request->column_) && array_push($appendRowContent, $iData->return_amount) && $arr['return_amount'] = ($arr['return_amount'] ?? 0) + $iData->return_amount;
                    in_array('bet_bunko', $request->column_) && array_push($appendRowContent, $iData->bet_bunko) && $arr['bet_bunko'] = ($arr['bet_bunko'] ?? 0) + $iData->bet_bunko;
                    in_array('fact_return_amount', $request->column_) && array_push($appendRowContent, $iData->fact_return_amount) && $arr['fact_return_amount'] = ($arr['fact_return_amount'] ?? 0) + $iData->fact_return_amount;
                    in_array('fact_bet_bunko', $request->column_) && array_push($appendRowContent, $fact_bet_bunko) && $arr['fact_bet_bunko'] = ($arr['fact_bet_bunko'] ?? 0) + $fact_bet_bunko;
                    $sheet->appendRow($appendRowContent);
                    $sheetHeight[$kData + 2] = 20;
                }
                $arrk = [];
                array_push($arrk, '总计：');
                foreach ($arr as $k=>$v){
                    array_push($arrk, $v);
                }
                $sheet->appendRow($arrk);
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
    //导出总代理报表
    public function exportReportGAgent(Request $request){
        $aParam = $request->all();
        ini_set('memory_limit','1024M');
        $data = app(\App\Http\Controllers\Back\Data\ReportDataController::class)->GagentData($request);
        $aData = $data['aData'];
        if(empty($aData) || count($request->column_ = explode(',', $request->column_)) < 1)
            return redirect('/back/control/reportManage/gagent')->with('message', '该条件下没有数据');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】导出总代理报表-['.$aParam['timeStart'].'-'.$aParam['timeEnd'].']',function ($excel) use ($aData,$todayTime,$request){
            $excel->sheet('【'.$todayTime.'】导出总代理报表', function($sheet) use ($aData,$todayTime,$request){
                $appendRowTitle = [];
                array_push($appendRowTitle, '');
                in_array('general_account', $request->column_) && array_push($appendRowTitle, '账号');
                in_array('memberCount', $request->column_) && array_push($appendRowTitle, '会员数');
                in_array('bet_count', $request->column_) && array_push($appendRowTitle, '笔数');
                in_array('bet_money', $request->column_) && array_push($appendRowTitle, '投注金额');
                in_array('win_amount', $request->column_) && array_push($appendRowTitle, '中奖金额');
                in_array('bet_amount', $request->column_) && array_push($appendRowTitle, '赢利投注金额');
                in_array('activity_money', $request->column_) && array_push($appendRowTitle, '活动金额');
                in_array('handling_fee', $request->column_) && array_push($appendRowTitle, '充值优惠/手续费');
                in_array('return_amount', $request->column_) && array_push($appendRowTitle, '代理退水金额');
                in_array('bet_bunko', $request->column_) && array_push($appendRowTitle, '会员输赢(不包括退水)');
                in_array('fact_return_amount', $request->column_) && array_push($appendRowTitle, '实际退水');
                in_array('fact_bet_bunko', $request->column_) && array_push($appendRowTitle, '实际输赢(包括退水)');

                $sheet->appendRow($appendRowTitle);
                $sheetHeight = [1 => 20,];
                $arr = [];
                foreach ($aData as $kData => $iData){
                    $appendRowContent = [];
                    $activity_money = empty($iData->activity_money)?0:$iData->activity_money;
                    $handling_fee = empty($iData->handling_fee)?0:$iData->handling_fee;
                    $fact_return_amount = empty($iData->fact_return_amount)?0:$iData->fact_return_amount;
                    $fact_bet_bunko = round($iData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,2);
                    array_push($appendRowContent, '');
                    in_array('general_account', $request->column_) && array_push($appendRowContent, $iData->general_account) && $arr['general_account'] = '';
                    in_array('memberCount', $request->column_) && array_push($appendRowContent, $iData->memberCount) && $arr['memberCount'] = ($arr['memberCount'] ?? 0) + $iData->memberCount;
                    in_array('bet_count', $request->column_) && array_push($appendRowContent, $iData->bet_count) && $arr['bet_count'] = ($arr['bet_count'] ?? 0) + $iData->bet_count;
                    in_array('bet_money', $request->column_) && array_push($appendRowContent, $iData->bet_money) && $arr['bet_money'] = ($arr['bet_money'] ?? 0) + $iData->bet_money;
                    in_array('win_amount', $request->column_) && array_push($appendRowContent, round($iData->bet_money + $iData->bet_bunko,2)) && ($arr['win_amount'] = ($arr['win_amount'] ?? 0) + round($iData->bet_money + $iData->bet_bunko,2));
                    in_array('bet_amount', $request->column_) && array_push($appendRowContent, $iData->bet_amount) && $arr['bet_amount'] = ($arr['bet_amount'] ?? 0) + $iData->bet_amount ;
                    in_array('activity_money', $request->column_) && array_push($appendRowContent, $iData->activity_money) && $arr['activity_money'] = ($arr['activity_money'] ?? 0) + $iData->activity_money;
                    in_array('handling_fee', $request->column_) && array_push($appendRowContent, $iData->handling_fee) && $arr['handling_fee'] = ($arr['handling_fee'] ?? 0) + $iData->handling_fee;
                    in_array('return_amount', $request->column_) && array_push($appendRowContent, $iData->return_amount) && $arr['return_amount'] = ($arr['return_amount'] ?? 0) + $iData->return_amount;
                    in_array('bet_bunko', $request->column_) && array_push($appendRowContent, $iData->bet_bunko) && $arr['bet_bunko'] = ($arr['bet_bunko'] ?? 0) + $iData->bet_bunko;
                    in_array('fact_return_amount', $request->column_) && array_push($appendRowContent, $iData->fact_return_amount) && ($arr['fact_return_amount'] = ($arr['fact_return_amount'] ?? 0) + $iData->fact_return_amount);
                    in_array('fact_bet_bunko', $request->column_) && array_push($appendRowContent, $fact_bet_bunko) && ($arr['fact_bet_bunko'] = ($arr['fact_bet_bunko'] ?? 0) + $fact_bet_bunko);

                    $sheet->appendRow($appendRowContent);
                    $sheetHeight[$kData + 2] = 20;
                }
                $arrk = [
                    '总计：'
                ];
                foreach ($arr as $k=>$v){
                    array_push($arrk, $v);
                }
                $sheet->appendRow($arrk);
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
    //导出投注报表
    public function exportReportBet(Request $request){
        $aParam = $request->all();
        ini_set('memory_limit','1024M');
        $data = app(\App\Http\Controllers\Back\Data\ReportDataController::class)->BetData($request);
        $aData = $data['aBet'];
        if(empty($aData) || count($request->column_ = explode(',', $request->column_)) < 1)
            return redirect('/back/control/reportManage/gagent')->with('message', '该条件下没有数据');
        $todayTime = date('Y-m-d');
        Excel::create('【'.$todayTime.'】导出投注报表-['.$aParam['startTime'].'-'.$aParam['endTime'].']',function ($excel) use ($aData,$todayTime,$request){
            $excel->sheet('【'.$todayTime.'】导出投注报表', function($sheet) use ($aData,$todayTime,$request){
                $appendRowTitle = [];
                array_push($appendRowTitle, '');
                in_array('game_name', $request->column_) && array_push($appendRowTitle, '彩种');
                in_array('sumMoney', $request->column_) && array_push($appendRowTitle, '投注金额');
                in_array('countBets', $request->column_) && array_push($appendRowTitle, '笔数');
                in_array('countMember', $request->column_) && array_push($appendRowTitle, '人数');
                in_array('rebate', $request->column_) && array_push($appendRowTitle, '返点');
                in_array('sumWinBunko', $request->column_) && array_push($appendRowTitle, '中奖金额');
                in_array('countWinBunkoBet', $request->column_) && array_push($appendRowTitle, '笔数(输赢占比)');
                in_array('countWinBunkoMember', $request->column_) && array_push($appendRowTitle, '人数');
                in_array('sumBunko', $request->column_) && array_push($appendRowTitle, '公司损益');

                $sheet->appendRow($appendRowTitle);
                $sheetHeight = [1 => 20,];
                $arr = [];
                foreach ($aData as $kData => $iData){
                    $appendRowContent = [];
                    $countWinBunkoBet1 = empty($iData->countWinBunkoBet)?0:$iData->countWinBunkoBet;
                    $countBets =  empty($iData->countBets)?1:$iData->countBets;
                    $bfb = $countWinBunkoBet1/$countBets * 100;
                    $countWinBunkoBet = $countWinBunkoBet1.' ('.round($bfb,1).'%)';
                    array_push($appendRowContent, '');
                    in_array('game_name', $request->column_) && array_push($appendRowContent, $iData->game_name) && $arr['game_name'] = '';
                    in_array('sumMoney', $request->column_) && array_push($appendRowContent, $iData->sumMoney ?? '0.00') && $arr['sumMoney'] = ($arr['sumMoney'] ?? 0) + $iData->sumMoney;
                    in_array('countBets', $request->column_) && array_push($appendRowContent, $iData->countBets ?? 0) && $arr['countBets'] = ($arr['countBets'] ?? 0) + $iData->countBets;
                    in_array('countMember', $request->column_) && array_push($appendRowContent, $iData->countMember ?? 0) && $arr['countMember'] = ($arr['countMember'] ?? 0) + $iData->countMember;
                    in_array('rebate', $request->column_) && array_push($appendRowContent, $iData->rebate ?? 0) && $arr['rebate'] = ($arr['rebate'] ?? 0) + $iData->rebate;
                    in_array('sumWinBunko', $request->column_) && array_push($appendRowContent, $iData->sumWinBunko ?? '0.00') && $arr['sumWinBunko'] = ($arr['sumWinBunko'] ?? 0) + $iData->sumWinBunko;
                    in_array('countWinBunkoBet', $request->column_) && array_push($appendRowContent, $countWinBunkoBet ?? 0) && $arr['countWinBunkoBet'] = ($arr['countWinBunkoBet'] ?? 0) + $countWinBunkoBet1;
                    in_array('countWinBunkoMember', $request->column_) && array_push($appendRowContent, $iData->countWinBunkoMember ?? 0) && $arr['countWinBunkoMember'] = ($arr['countWinBunkoMember'] ?? 0) + $iData->countWinBunkoMember;
                    in_array('sumBunko', $request->column_) && array_push($appendRowContent, $iData->sumBunko) && $arr['sumBunko'] = ($arr['sumBunko'] ?? 0) + $iData->sumBunko;

                    $sheet->appendRow($appendRowContent);
                    $sheetHeight[$kData + 2] = 20;
                }
                $arrk = [
                    '总计：'
                ];
                foreach ($arr as $k=>$v){
                    array_push($arrk, $v);
                }
                $sheet->appendRow($arrk);
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
    //导出棋牌报表
    public function exportReportCart(Request $request)
    {
        $aParam = $request->all();
        ini_set('memory_limit','1024M');
        $data = app(\App\Http\Controllers\Back\Data\ReportDataController::class)->CardNewDara($request);
        $aData = $data['aArray'];
        $request->column_ = explode(',', $request->column_);
        if(empty($aData))
            return redirect('/back/control/reportManage/CardNew')->with('message', '该条件下没有数据');
        $todayTime = date('Y-m-d');
        $request->apis = \App\GamesApi::select('g_id', 'name')->pluck('name', 'g_id')->toArray();
        $request->types = [
            'up_fraction' => '上分',
            'down_fraction' => '下分',
            'bet_money' => '投注额',
            'bet_bunko' => '输赢',
        ];
        Excel::create('【'.$todayTime.'】导出投注报表-['.$aParam['startTime'].'-'.$aParam['endTime'].']',function ($excel) use ($aData,$todayTime,$request){
            $excel->sheet('【'.$todayTime.'】导出投注报表', function($sheet) use ($aData,$todayTime,$request){
                $appendRowTitle = [];
                in_array('user_account', $request->column_) && array_push($appendRowTitle, '用户名');
                in_array('agent_account', $request->column_) && array_push($appendRowTitle, '代理');
                array_push($appendRowTitle, '');
                foreach ($request->column_ as $k=>$v){
                    isset($request->apis[$v]) && array_push($appendRowTitle, $request->apis[$v]);
                }
                array_push($appendRowTitle, '总计');
                $row = 2;
                $sheet->appendRow($appendRowTitle);
                $sheetHeight = [1 => 20,];
                $arr = [];
                foreach ($aData as $kData => $iData){
                    $is = false;
                    foreach ($request->types as $kk=>$vv){
                        $appendRowContent = [];
                        $column_ = $request->column_;
                        if(in_array('user_account', $column_)) {
                            array_push($appendRowContent, $is ? '' : $iData['user_account'].(empty($iData['user_name'])?'':'('.$iData['user_name'].')'));
                            unset($column_[array_search('user_account', $column_)]);
                        }
                        if (in_array('agent_account', $column_)){
                            array_push($appendRowContent, $is ? '' : $iData['agent_account'].(empty($iData['agent_name'])?'':'('.$iData['agent_name'].')'));
                            unset($column_[array_search('agent_account', $column_)]);
                        }
                        array_push($appendRowContent, $vv);
                        $total = 0;
                        foreach ($column_ as $k=>$v){
                            $m = $iData['game'][$v][$kk] ?? 0;
                            $total += $m;
                            $arr[$kk][$v] = ($arr[$kk][$v] ?? 0) + $m;
                            array_push($appendRowContent, $m);
                        }
                        $arr[$kk]['total'] = ($arr[$kk]['total'] ?? 0) + $total;
                        array_push($appendRowContent, $total);
                        $sheet->appendRow($appendRowContent);
                        $is = true;
                        $row++;
                    }
                    $sheet->mergeCells('A'.($row-count($request->types)).':A'.($row-1));
                    $sheet->mergeCells('B'.($row-count($request->types)).':B'.($row-1));
                }
                foreach ($arr as $kk => $vv){
                    $row++;
                    $arrk = [
                        '总计：'
                    ];
                    if (in_array('agent_account', $request->column_)){
                        array_push($arrk, '');
                    }
                    array_push($arrk, $request->types[$kk]);
                    foreach ($vv as $k=>$v){
                        array_push($arrk, $v);
                    }
                    $sheet->appendRow($arrk);
                }
                $sheet->mergeCells('A'.($row-count($request->types)).':A'.($row-1));
                $sheet->setHeight($sheetHeight);
                $sheet->setWidth(array(
                    'A'    =>  20,
                    'B'    =>  20,
                    'C'    =>  10,
                    'D'    =>  10,
                    'E'    =>  10,
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
