<?php

namespace App\Http\Controllers\Back\Data;

use App\Banks;
use App\Levels;
use App\PayOnline;
use App\PayType;
use App\RechargeWay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class PayDataController extends Controller
{
    //在线支付配置
    public function payOnline()
    {
        $payOnline = PayOnline::where('rechType','onlinePayment')->get();
        return DataTables::of($payOnline)
            ->editColumn('payType', function ($payOnline){
                $payTypeName = PayType::find($payOnline->payType);
                return $payTypeName->rechName;
            })
            ->editColumn('status', function ($payOnline){
                if($payOnline->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($payOnline->status == 0){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('levels', function ($payOnline){
                $data = '';
                $explode = explode(',',$payOnline->levels);
                foreach ($explode as $i){
                    $findLevels = Levels::where('value',$i)->first();
                    $data .= "<input type='checkbox' disabled checked value=$i> $findLevels->name ";
                }
                return $data;
            })
            ->editColumn('control', function ($payOnline){
                if($payOnline->status === 1){
                    $statusText = '<span class="edit-link" onclick="status(\''.$payOnline->id.'\',\''.$payOnline->status.'\',\''.$payOnline->payeeName.'\')"><i class="iconfont">&#xe687;</i> 停用</span>';
                } else {
                    $statusText = '<span class="edit-link" onclick="status(\''.$payOnline->id.'\',\''.$payOnline->status.'\',\''.$payOnline->payeeName.'\')"><i class="iconfont">&#xe687;</i> 启用</span>';
                }
                return '<span class="edit-link" onclick="edit(\''.$payOnline->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        '.$statusText.' | 
                        <span class="edit-link" onclick="del(\''.$payOnline->id.'\',\''.$payOnline->payeeName.'\')"><i class="iconfont">&#xe600;</i> 删除</span> | 
                        <span class="edit-link" onclick="copy(\''.$payOnline->id.'\')"><i class="iconfont">&#xe66d;</i> 复制</span>';
            })
            ->rawColumns(['control','status','levels'])
            ->make(true);
    }
    
    //银行支付配置
    public function payBank()
    {
        $payBank = PayOnline::where('rechType','bankTransfer')->get();
        return DataTables::of($payBank)
            ->editColumn('bank', function ($payBank){
                $findBank = Banks::where('bank_id',$payBank->paramId)->first();
                return $findBank->name;
            })
            ->editColumn('payeeName', function ($payBank){
                return $payBank->payeeName;
            })
            ->editColumn('payee', function ($payBank){
                return $payBank->payee;
            })
            ->editColumn('remark', function ($payBank){
                return $payBank->remark;
            })
            ->editColumn('status', function ($payBank){
                if($payBank->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($payBank->status == 0){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('levels', function ($payBank){
                $data = '';
                $explode = explode(',',$payBank->levels);
                foreach ($explode as $i){
                    $findLevels = Levels::where('value',$i)->first();
                    $data .= "<input type='checkbox' disabled checked value=$i> $findLevels->name ";
                }

                return $data;
            })
            ->editColumn('remark2', function ($payBank){
                return $payBank->remark2;
            })
            ->editColumn('control', function ($payBank){
                if($payBank->status === 1){
                    $statusText = '<span class="edit-link" onclick="status(\''.$payBank->id.'\',\''.$payBank->status.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe687;</i> 停用</span>';
                } else {
                    $statusText = '<span class="edit-link" onclick="status(\''.$payBank->id.'\',\''.$payBank->status.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe687;</i> 启用</span>';
                }
                return '<span class="edit-link" onclick="edit(\''.$payBank->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        '.$statusText.' | 
                        <span class="edit-link" onclick="del(\''.$payBank->id.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
            })
            ->rawColumns(['control','status','levels'])
            ->make(true);
    }
    
    //支付宝配置
    public function payAlipay()
    {
        $payAlipay = PayOnline::where('rechType','alipay')->get();
        return DataTables::of($payAlipay)
            ->editColumn('payeeName', function ($payAlipay){
                return $payAlipay->payeeName;
            })
            ->editColumn('payee', function ($payAlipay){
                return $payAlipay->payee;
            })
            ->editColumn('qrCode', function ($payAlipay){
                return "<img style='width: 100px;' src='$payAlipay->qrCode'>";
            })
            ->editColumn('status', function ($payAlipay){
                if($payAlipay->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($payAlipay->status == 0){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('levels', function ($payAlipay){
                $data = '';
                $explode = explode(',',$payAlipay->levels);
                foreach ($explode as $i){
                    $findLevels = Levels::where('value',$i)->first();
                    $data .= "<input type='checkbox' disabled checked value=$i> $findLevels->name ";
                }
                return $data;
            })
            ->editColumn('remark2', function ($payBank){
                return $payBank->remark2;
            })
            ->editColumn('control', function ($payBank){
                if($payBank->status === 1){
                    $statusText = '<span class="edit-link" onclick="status(\''.$payBank->id.'\',\''.$payBank->status.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe687;</i> 停用</span>';
                } else {
                    $statusText = '<span class="edit-link" onclick="status(\''.$payBank->id.'\',\''.$payBank->status.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe687;</i> 启用</span>';
                }
                return '<span class="edit-link" onclick="edit(\''.$payBank->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        '.$statusText.' | 
                        <span class="edit-link" onclick="del(\''.$payBank->id.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
            })
            ->rawColumns(['control','status','levels','qrCode'])
            ->make(true);
    }

    //微信配置
    public function payWechat()
    {
        $payWechat = PayOnline::where('rechType','weixin')->get();
        return DataTables::of($payWechat)
            ->editColumn('payeeName', function ($payWechat){
                return $payWechat->payeeName;
            })
            ->editColumn('payee', function ($payWechat){
                return $payWechat->payee;
            })
            ->editColumn('qrCode', function ($payWechat){
                return "<img style='width: 100px;' src='$payWechat->qrCode'>";
            })
            ->editColumn('status', function ($payWechat){
                if($payWechat->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($payWechat->status == 0){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('levels', function ($payWechat){
                $data = '';
                $explode = explode(',',$payWechat->levels);
                foreach ($explode as $i){
                    $findLevels = Levels::where('value',$i)->first();
                    $data .= "<input type='checkbox' disabled checked value=$i> $findLevels->name ";
                }
                return $data;
            })
            ->editColumn('remark2', function ($payWechat){
                return $payWechat->remark2;
            })
            ->editColumn('control', function ($payBank){
                if($payBank->status === 1){
                    $statusText = '<span class="edit-link" onclick="status(\''.$payBank->id.'\',\''.$payBank->status.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe687;</i> 停用</span>';
                } else {
                    $statusText = '<span class="edit-link" onclick="status(\''.$payBank->id.'\',\''.$payBank->status.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe687;</i> 启用</span>';
                }
                return '<span class="edit-link" onclick="edit(\''.$payBank->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        '.$statusText.' | 
                        <span class="edit-link" onclick="del(\''.$payBank->id.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
            })
            ->rawColumns(['control','status','levels','qrCode'])
            ->make(true);
    }
    
    //财付通
    public function payCft()
    {
        $payCft = PayOnline::where('rechType','cft')->get();
        return DataTables::of($payCft)
            ->editColumn('payeeName', function ($payCft){
                return $payCft->payeeName;
            })
            ->editColumn('payee', function ($payCft){
                return $payCft->payee;
            })
            ->editColumn('qrCode', function ($payCft){
                return "<img style='width: 100px;' src='$payCft->qrCode'>";
            })
            ->editColumn('status', function ($payCft){
                if($payCft->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($payCft->status == 0){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('levels', function ($payCft){
                $data = '';
                $explode = explode(',',$payCft->levels);
                foreach ($explode as $i){
                    $findLevels = Levels::where('value',$i)->first();
                    $data .= "<input type='checkbox' disabled checked value=$i> $findLevels->name ";
                }
                return $data;
            })
            ->editColumn('remark2', function ($payCft){
                return $payCft->remark2;
            })
            ->editColumn('control', function ($payBank){
                if($payBank->status === 1){
                    $statusText = '<span class="edit-link" onclick="status(\''.$payBank->id.'\',\''.$payBank->status.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe687;</i> 停用</span>';
                } else {
                    $statusText = '<span class="edit-link" onclick="status(\''.$payBank->id.'\',\''.$payBank->status.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe687;</i> 启用</span>';
                }
                return '<span class="edit-link" onclick="edit(\''.$payBank->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        '.$statusText.' | 
                        <span class="edit-link" onclick="del(\''.$payBank->id.'\',\''.$payBank->payeeName.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
            })
            ->rawColumns(['control','status','levels','qrCode'])
            ->make(true);
    }
    
    //支付层级配置
    public function level()
    {
        $level = Levels::all();
        return DataTables::of($level)
            ->editColumn('oneRechMoney', function ($level){
                if($level->oneRechMoney == ""){
                    return "--";
                } else {
                    return $level->oneRechMoney;
                }
            })
            ->editColumn('allRechMoney', function ($level){
                if($level->allRechMoney == ""){
                    return "--";
                } else {
                    return $level->allRechMoney;
                }
            })
            ->editColumn('oneDrawMoney', function ($level){
                if($level->oneDrawMoney == ""){
                    return "--";
                } else {
                    return $level->oneDrawMoney;
                }
            })
            ->editColumn('allDrawMoney', function ($level){
                if($level->allDrawMoney == ""){
                    return "--";
                } else {
                    return $level->allDrawMoney;
                }
            })
            ->editColumn('status', function ($level){
                if($level->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($level->status == 0){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('control', function ($level){
                if($level->value == 0){
                    return '<span class="edit-link" onclick="edit(\''.$level->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        <span class="edit-link" onclick="allExchange(\''.$level->id.'\')"><i class="iconfont">&#xe687;</i> 全部转移</span> | 
                        <span class="edit-link" onclick="searchExchange(\''.$level->id.'\')"><i class="iconfont">&#xe66d;</i> 条件转移</span>';
                } else {
                    return '<span class="edit-link" onclick="edit(\''.$level->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        <span class="edit-link" onclick="del(\''.$level->id.'\')"><i class="iconfont">&#xe600;</i> 删除</span> | 
                        <span class="edit-link" onclick="allExchange(\''.$level->id.'\')"><i class="iconfont">&#xe687;</i> 全部转移</span> | 
                        <span class="edit-link" onclick="searchExchange(\''.$level->id.'\')"><i class="iconfont">&#xe66d;</i> 条件转移</span>';
                }

            })
            ->rawColumns(['control','status'])
            ->make(true);
    }
    
    //绑定银行数据
    public function bank()
    {
        $allBanks = Banks::all();
        return DataTables::of($allBanks)
            ->editColumn('bank_icon', function ($allBanks){
                switch ($allBanks->eng_name){
                    case "ABC";
                        return "<i class='iconfont bank_icon'>&#xe616;</i>";
                    case "CCB";
                        return "<i class='iconfont bank_icon'>&#xe651;</i>";
                    case "ICBC";
                        return "<i class='iconfont bank_icon'>&#xe611;</i>";
                    case "CMB";
                        return "<i class='iconfont bank_icon'>&#xe60f;</i>";
                    case "BOCO";
                        return "<i class='iconfont bank_icon'>&#xe615;</i>";
                    case "CMBC";
                        return "<i class='iconfont bank_icon'>&#xe6c8;</i>";
                    case "CIB";
                        return "<i class='iconfont bank_icon'>&#xe6f5;</i>";
                    case "BOC";
                        return "<i class='iconfont bank_icon'>&#xe612;</i>";
                    case "POST";
                        return "<i class='iconfont bank_icon'>&#xe610;</i>";
                    case "CEBBANK";
                        return "<i class='iconfont bank_icon'>&#xe6c5;</i>";
                    case "ECITIC";
                        return "<i class='iconfont bank_icon'>&#xe6cf;</i>";
                    case "CGB";
                        return "<i class='iconfont bank_icon'>&#xe617;</i>";
                    case "SPDB";
                        return "<i class='iconfont bank_icon'>&#xe618;</i>";
                    case "HXB";
                        return "<i class='iconfont bank_icon'>&#xe614;</i>";
                    case "PINGAN";
                        return "<i class='iconfont bank_icon'>&#xe61a;</i>";
                    case "BCCB";
                        return "<i class='iconfont bank_icon'>&#xe619;</i>";
                    case "BOS";
                        return "<i class='iconfont bank_icon'>&#xe61b;</i>";
                    case "BRCB";
                        return "<i class='iconfont bank_icon'>&#xe61c;</i>";
                }
            })
            ->editColumn('control', function ($allGeneralAgent){
                return '222';
            })
            ->rawColumns(['online','bank_icon'])
            ->make(true);
    }
    
    //充值方式配置
    public function rechargeWay()
    {
        $rechargeWay = RechargeWay::all();
        return DataTables::of($rechargeWay)
            ->editColumn('status', function ($rechargeWay){
                if($rechargeWay->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($rechargeWay->status == 0){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('control', function ($rechargeWay){
                return '<span class="edit-link" onclick="edit(\''.$rechargeWay->id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                        <span class="edit-link" onclick="del(\''.$rechargeWay->id.'\',\''.$rechargeWay->type.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
            })
            ->rawColumns(['status','control'])
            ->make(true);
    }
}
