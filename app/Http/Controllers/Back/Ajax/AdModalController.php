<?php

namespace App\Http\Controllers\Back\Ajax;

use App\Advertise;
use App\AdvertiseKey;
use App\AdvertiseValue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AdModalController extends Controller
{
    function __construct()
    {
        $this->replaceMYSQL();
    }

    //动态更换mysql
    public function replaceMYSQL(){
        if(env('DB_HOST_AD')!='' && env('DB_HOST_AD')!='127.0.0.1' ){
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

    //添加广告位-模板
    public function addAdvertise(){
        $aData = new Advertise();
        $aData1 = new AdvertiseKey();
        return view('back.modal.system.addAdvertise',compact('aData','aData1'));
    }

    //修改广告位-模板
    public function editAdvertise($id){
        $date = date('Y-m-d H:i:s');
        $aData = new Advertise();
        $iInfo = DB::table('advertise')->where('id',$id)->first();
        $aKeyData = DB::table('advertise_key')->where('ad_id',$id)->get();
        $iInfo_val = DB::table('advertise_info')->where('ad_id',$id)->first();
        if(empty($iInfo_val)){
            $result1 = DB::table('advertise_info')->insertGetId([
                'js_title' => '',
                'ad_id' => $id,
                'js_key' => NULL,
                'status' => 1,
                'sort' => 99,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
            $result1 = DB::table('advertise_value')->insertGetId([
                'info_id' => $result1,
                'key_id' => $aKeyData[0]->id,
                'js_value' => '',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }else{
            $iValue_val = DB::table('advertise_value')->where('info_id',$iInfo_val->id)->first();
            if(empty($iValue_val)){
                $result1 = DB::table('advertise_value')->insertGetId([
                    'info_id' => $iInfo_val->id,
                    'key_id' => $aKeyData[0]->id,
                    'js_value' => '',
                    'status' => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
        $aKeyModel = new AdvertiseKey();
        return view('back.modal.system.editAdvertise',compact('aData','iInfo','aKeyData','aKeyModel'));
    }

    //添加广告位-模板
    public function addAdvertiseInfo(){
        $aData = DB::table('advertise')->where('type','!=',1)->get();
        $advertiseValue = new Advertise();
        return view('back.modal.system.addAdvertiseInfo',compact('aData','advertiseValue'));
    }

    //添加广告位-模板
    public function editAdvertiseInfo($id){
        $iInfo = DB::table('advertise_info')->where('id',$id)->first();
        $type = DB::table('advertise')->where('id',$iInfo->ad_id)->value('type');
        $aData = DB::table('advertise_value')->select('advertise_value.id','advertise_value.js_value','advertise_key.js_key','advertise_key.description','advertise_key.type')->where('advertise_value.info_id',$id)
            ->join('advertise_key','advertise_key.id','=','advertise_value.key_id')->orderBy('advertise_key.id','asc')->get();
        $advertiseValue = new AdvertiseValue();
        return view('back.modal.system.editAdvertiseInfo',compact('iInfo','aData','type','advertiseValue'));
    }
}
