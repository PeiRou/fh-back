<?php

namespace App\Http\Controllers\Back\Data;

use App\Advertise;
use App\AdvertiseInfo;
use App\AdvertiseValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdDataController extends Controller
{
    function __construct()
    {
        $this->replaceMYSQL();
    }

    //动态更换mysql
    public function replaceMYSQL(){
        if(env('DB_HOST_AD')!='' && env('DB_HOST_AD')!='127.0.0.1' ) {
            Config::set("database.connections.mysql", [
                'driver' => 'mysql',
                "host" => env('DB_HOST_AD'),
                "database" => env('DB_DATABASE_AD'),
                "username" => env('DB_USERNAME_AD'),
                "password" => env('DB_PASSWORD_AD'),
                'charset' => 'utf8',
                'collation' => 'utf8_general_ci',
                'port' => env('DB_PORT_AD'),
            ]);
        }
    }

    //广告位-表格数据
    public function advertise(Request $request){
        $aData = DB::table('advertise')->get();
        $advertise = new Advertise();
        return DataTables::of($aData)
            ->editColumn('type',function ($aData) use($advertise){
                return  $advertise->advertiseType[$aData->type];
            })
            ->editColumn('status',function ($aData) use($advertise){
                return  $advertise->advertiseStatus[$aData->status];
            })
            ->editColumn('control',function ($data) {
                return '<span class="edit-link" style="color:#4183c4" onclick="edit('.$data->id.')">修改</span> | 
                        <span class="edit-link" style="color:#4183c4" onclick="del('.$data->id.')">删除</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //广告位-表格数据
    public function advertiseInfo(Request $request){
        $aParam = $request->post();
        $aData = DB::table('advertise_info')->select('advertise_info.status','advertise_info.js_title','advertise_info.created_at','advertise_info.sort','advertise_info.js_key','advertise.title','advertise_info.id','advertise.type')
            ->where(function ($aSql) use($aParam){
                if(isset($aParam['ad_id']) && array_key_exists('ad_id',$aParam))
                    $aSql->where('advertise_info.ad_id',$aParam['ad_id']);
            })->join('advertise','advertise.id','=','advertise_info.ad_id')
            ->orderBy('advertise_info.ad_id','asc')->orderBy('advertise_info.sort','asc')->get();
        $aType = (new Advertise())->advertiseType;
        $advertiseStatus = (new AdvertiseInfo())->advertiseStatus;
        return DataTables::of($aData)
            ->editColumn('type',function ($aData) use ($aType){
                return  $aType[$aData->type];
            })
            ->editColumn('status',function ($aData) use($advertiseStatus){
//                return  $advertiseStatus[$aData->status];
                if($aData->status == 0)
                {
                    return '<span class="power-off"><i class="iconfont">&#xe676;</i> 关闭</span>';
                } else {
                    return '<span class="power-on"><i class="iconfont">&#xe676;</i> 开启</span>';
                }
            })
            ->editColumn('sort', function ($aData){
                return "<input type='text' value='".$aData->sort."' name='sort[]' style='border: 1px solid #aaa;height: 20px;width: 30px;'><input type='hidden' value='".$aData->id."' name='sortId[]'>";
            })
            ->editColumn('js_key',function ($aData){
                return  empty($aData->js_key)?'-':$aData->js_key;
            })
            ->editColumn('content',function ($aData){
                if($aData->type == 1){
                    $value = AdvertiseValue::getValueByInfoId($aData->id);
                    if(strpos($value,'data:image/') === false)
                        return '<p style="width: 300px;flex-wrap:wrap;height:auto;word-wrap:break-word;word-break:break-all;overflow:hidden;">'.$value.'</p>';
                    return '<img src="'.$value.'" style="width:100px;"/>';
                }
                return '-';
            })
            ->editColumn('control',function ($aData) {
                if($aData->status==1)
                    $txt = '<span class="edit-link" style="color:#d42020" onclick="closeAd('.$aData->id.')">关闭</span> |';
                else
                    $txt = '<span class="edit-link" style="color:#37cc21" onclick="openAd('.$aData->id.')">开启</span> |';
                $txt .= '<span class="edit-link" style="color:#4183c4" onclick="edit('.$aData->id.')">修改</span> | 
                        <span class="edit-link" style="color:#4183c4" onclick="del('.$aData->id.')">删除</span>';
                return $txt;
            })
            ->rawColumns(['status','control','sort','content'])
            ->make(true);
    }
}
