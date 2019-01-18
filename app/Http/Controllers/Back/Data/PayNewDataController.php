<?php

namespace App\Http\Controllers\Back\Data;

use App\Banks;
use App\Levels;
use App\PayOnline;
use App\PayOnlineNew;
use App\PayType;
use App\PayTypeNew;
use App\RechargeWay;
use App\RechType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PayNewDataController extends Controller
{


    //在线支付配置新
    public function payOnline()
    {
        $payOnline = PayOnlineNew::select('pay_online_new.*','pay_type_new.rechName as rechName1')->join('pay_type_new','pay_type_new.payName','=','pay_online_new.payName')->where('pay_online_new.rechType','onlinePayment')->orderBy('pay_online_new.status','desc')->orderBy('pay_online_new.sort','asc')->orderBy('pay_online_new.id','asc')->get();
        return DataTables::of($payOnline)
            ->editColumn('payType', function ($payOnline){
                return $payOnline->rechName1;
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
            ->editColumn('sort', function ($payOnline){
                return "<input type='text' value='".$payOnline->sort."' name='sort[]' style='border: 1px solid #aaa;height: 20px;width: 30px;'><input type='hidden' value='".$payOnline->id."' name='sortId[]'>";
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
            ->rawColumns(['control','status','levels','sort'])
            ->make(true);
    }
    
    //银行支付配置
    public function payBank()
    {
        $payBank = PayOnlineNew::where('rechType','bankTransfer')->orderBy('sort','asc')->get();
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
            ->editColumn('sort', function ($payOnline){
                return "<input type='text' value='".$payOnline->sort."' name='sort[]' style='border: 1px solid #aaa;height: 20px;width: 30px;'><input type='hidden' value='".$payOnline->id."' name='sortId[]'>";
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
            ->rawColumns(['control','status','levels','sort'])
            ->make(true);
    }
    
    //支付宝配置
    public function payAlipay()
    {
        $payAlipay = PayOnlineNew::where('rechType','alipay')->orderBy('sort','asc')->get();
        return DataTables::of($payAlipay)
            ->editColumn('payeeName', function ($payAlipay){
                return $payAlipay->payeeName;
            })
            ->editColumn('payee', function ($payAlipay){
                return $payAlipay->payee;
            })
            ->editColumn('qrCode', function ($payAlipay){
                return "<img style='width: 100px;' src='".(empty($payAlipay->qrCodeBase64) ? $payAlipay->qrCode : $payAlipay->qrCodeBase64)."'>";
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
            ->editColumn('sort', function ($payOnline){
                return "<input type='text' value='".$payOnline->sort."' name='sort[]' style='border: 1px solid #aaa;height: 20px;width: 30px;'><input type='hidden' value='".$payOnline->id."' name='sortId[]'>";
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
            ->rawColumns(['control','status','levels','qrCode','sort'])
            ->make(true);
    }

    //微信配置
    public function payWechat()
    {
        $payWechat = PayOnlineNew::where('rechType','weixin')->orderBy('sort','asc')->get();
        return DataTables::of($payWechat)
            ->editColumn('payeeName', function ($payWechat){
                return $payWechat->payeeName;
            })
            ->editColumn('payee', function ($payWechat){
                return $payWechat->payee;
            })
            ->editColumn('qrCode', function ($payWechat){
//                return "<img style='width: 100px;' src='$payWechat->qrCode'>";
                return "<img style='width: 100px;' src='".(empty($payWechat->qrCodeBase64) ? $payWechat->qrCode : $payWechat->qrCodeBase64)."'>";
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
            ->editColumn('sort', function ($payOnline){
                return "<input type='text' value='".$payOnline->sort."' name='sort[]' style='border: 1px solid #aaa;height: 20px;width: 30px;'><input type='hidden' value='".$payOnline->id."' name='sortId[]'>";
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
            ->rawColumns(['control','status','levels','qrCode','sort'])
            ->make(true);
    }
    
    //财付通
    public function payCft()
    {
        $payCft = PayOnlineNew::where('rechType','cft')->orderBy('sort','asc')->get();
        return DataTables::of($payCft)
            ->editColumn('payeeName', function ($payCft){
                return $payCft->payeeName;
            })
            ->editColumn('payee', function ($payCft){
                return $payCft->payee;
            })
            ->editColumn('qrCode', function ($payCft){
//                return "<img style='width: 100px;' src='$payCft->qrCode'>";
                return "<img style='width: 100px;' src='".(empty($payCft->qrCodeBase64) ? $payCft->qrCode : $payCft->qrCodeBase64)."'>";
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
            ->editColumn('sort', function ($payOnline){
                return "<input type='text' value='".$payOnline->sort."' name='sort[]' style='border: 1px solid #aaa;height: 20px;width: 30px;'><input type='hidden' value='".$payOnline->id."' name='sortId[]'>";
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
            ->rawColumns(['control','status','levels','qrCode','sort'])
            ->make(true);
    }
    //云闪付配置
    public function payYsf()
    {
        $payYsf = PayOnlineNew::where('rechType','ysf')->orderBy('sort','asc')->get();
        return DataTables::of($payYsf)
            ->editColumn('payeeName', function ($payYsf){
                return $payYsf->payeeName;
            })
            ->editColumn('payee', function ($payYsf){
                return $payYsf->payee;
            })
            ->editColumn('qrCode', function ($payYsf){
//                return "<img style='width: 100px;' src='$payYsf->qrCode'>";
                return "<img style='width: 100px;' src='".(empty($payYsf->qrCodeBase64) ? $payYsf->qrCode : $payYsf->qrCodeBase64)."'>";
            })
            ->editColumn('status', function ($payYsf){
                if($payYsf->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($payYsf->status == 0){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('levels', function ($payYsf){
                $data = '';
                $explode = explode(',',$payYsf->levels);
                foreach ($explode as $i){
                    $findLevels = Levels::where('value',$i)->first();
                    $data .= "<input type='checkbox' disabled checked value=$i> $findLevels->name ";
                }
                return $data;
            })
            ->editColumn('remark2', function ($payBank){
                return $payBank->remark2;
            })
            ->editColumn('sort', function ($payOnline){
                return "<input type='text' value='".$payOnline->sort."' name='sort[]' style='border: 1px solid #aaa;height: 20px;width: 30px;'><input type='hidden' value='".$payOnline->id."' name='sortId[]'>";
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
            ->rawColumns(['control','status','levels','qrCode','sort'])
            ->make(true);
    }
}
