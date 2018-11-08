<?php

namespace App\Http\Controllers\Back;

use App\Advertise;
use App\AdvertiseInfo;
use App\AdvertiseKey;
use App\AdvertiseValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdSystemSettingController extends Controller
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

    //添加广告位
    public function addAdvertise(Request $request){
        $aParams = $request->post();
        $validator = Validator::make($aParams,Advertise::$role);
        if($validator->fails())
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        $date = date('Y-m-d H:i:s');
        DB::beginTransaction();
        $result1 = DB::table('advertise')->insertGetId([
            'title' => $aParams['title'],
            'js_key' => $aParams['js_key'],
            'type' => $aParams['type'],
            'status' => 1,
            'mobile' => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        $aData = [
            'ad_id' => $result1,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ];

        if($aParams['type'] == 1) {
            $result2 = DB::table('advertise_info')->insertGetId($aData);
            $result3 = DB::table('advertise_key')->insertGetId([
                'ad_id' => $result1,
                'js_key' => $aParams['js_key'],
                'type' => $aParams['category'],
                'description' => $aParams['description'],
                'created_at' => $date,
                'updated_at' => $date,
            ]);
            $aData = [
                'info_id' => $result2,
                'key_id' => $result3,
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ];
            if($aParams['category'] == 1)
                $aData['js_value'] = $aParams['value1'];
            elseif($aParams['category'] == 2)
                $aData['js_value'] = $aParams['value2'];
            elseif($aParams['category'] == 3)
                $aData['js_value'] = $aParams['value3'];
            $result4 = DB::table('advertise_value')->insert($aData);
        }else{
            $result2 = 1;
            $aData = [];
            foreach ($aParams['paramType'] as $key => $value){
                if(!empty($aParams['paramKey'][$key])) {
                    $aData[] = [
                        'ad_id' => $result1,
                        'js_key' => $aParams['paramKey'][$key],
                        'description' => empty($aParams['paramDescription'][$key])?'':$aParams['paramDescription'][$key],
                        'type' => $value,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ];
                }
            }
            $result3 = DB::table('advertise_key')->insert($aData);
            $result4 = 1;
        }
        if($result1 && $result2 && $result3 && $result4) {
            DB::commit();
            return response()->json([
                'status' => true
            ]);
        }
        DB::rollback();
        return response()->json([
            'status' => false,
            'msg' => '添加失败，请稍后再试！'
        ]);
    }

    //修改广告位
    public function editAdvertise(Request $request){
        $aParams = $request->post();
        $iInfo = DB::table('advertise')->where('id',$aParams['id'])->first();
        $aArray = [];
        foreach ($aParams['paramId'] as $key => $value){
            $aArray[] = [
                'id' => $value,
                'description' => $aParams['paramDescription'][$key],
                'js_key' => $aParams['paramKey'][$key],
                'type' => $aParams['paramType'][$key],
            ];
        }
        DB::beginTransaction();
        try {
            if ($iInfo->type == 1) {
                DB::table('advertise')->where('id', $aParams['id'])->update([
                    'js_key' => $aParams['paramKey'][0],
                ]);
            }
            DB::update(AdvertiseKey::updateBatchStitching($aArray, ['description', 'js_key', 'type'], 'id'));
            DB::commit();
            return response()->json([
                'status' => true
            ]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => '添加失败，请稍后再试！'
            ]);
        }
    }

    //删除广告位
    public function delAdvertise(Request $request){
        $aParams = $request->post();
        $iInfo = DB::table('advertise')->where('id',$aParams['id'])->first();
        $aAdInfo = DB::table('advertise_info')->where('ad_id',$iInfo->id)->get();
        $keyId = [];
        foreach ($aAdInfo as $value){
            $keyId[] = $value->id;
        }
        DB::beginTransaction();
        try{
            DB::table('advertise')->where('id',$aParams['id'])->delete();
            DB::table('advertise_info')->where('ad_id',$iInfo->id)->delete();
            DB::table('advertise_key')->where('ad_id',$iInfo->id)->delete();
            DB::table('advertise_value')->whereIn('info_id',$keyId)->delete();
            DB::commit();
            return response()->json([
                'status' => true
            ]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => '删除失败，请稍后再试！'
            ]);
        }
    }

    //获取广告位栏位
    public function getAdvertiseKey(Request $request){
        $aParam = $request->post();
        $aData = DB::table('advertise_key')->select('id','type','js_key','description')->where('ad_id',$aParam['ad_id'])->where('status',1)->orderBy('id','asc')->get();
        $iInfo = DB::table('advertise')->where('id',$aParam['ad_id'])->first();
        return response()->json([
            'data' => $aData,
            'info' => $iInfo,
        ]);
    }

    //添加广告位内容
    public function addAdvertiseInfo(Request $request){
        $aParam = $request->post();
        $date = date('Y-m-d H:i:s');
        $aAdInfo = [
            'ad_id' => $aParam['ad_id'],
            'js_title' => $aParam['js_title'],
            'status' => 1,
            'sort' => empty($aParam['sort'])?99:$aParam['sort'],
            'created_at' => $date,
            'updated_at' => $date,
        ];
        $iAd = DB::table('advertise')->where('id',$aParam['ad_id'])->first();
        if($iAd->type == 3){
            $aAdInfo['js_key'] = $aParam['js_key'];
        }
        DB::beginTransaction();
        $result1 = DB::table('advertise_info')->insertGetId($aAdInfo);
        $aData = DB::table('advertise_key')->select('id','js_key')->where('ad_id',$aParam['ad_id'])->where('status',1)->orderBy('id','asc')->get();
        $aArray = [];
        foreach ($aData as $kData => $iData){
            foreach ($aParam as $kParam => $iParam){
                if($iData->js_key === $kParam){
                    $aArray[] = [
                        'info_id' => $result1,
                        'key_id' => $iData->id,
                        'js_value' => $iParam,
                        'status' => 1,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ];
                }
            }
        }
        $result2 = DB::table('advertise_value')->insert($aArray);
        if($result1 && $result2){
            DB::commit();
            return response()->json([
                'status' => true
            ]);
        }
        DB::rollback();
        return response()->json([
            'status' => false,
            'msg' => '添加失败，请稍后再试！'
        ]);
    }

    //修改广告位内容
    public function editAdvertiseInfo(Request $request){
        $aParam = $request->post();
        $date = date('Y-m-d H:i:s');
        $iInfo = DB::table('advertise_info')->select('advertise_info.ad_id','advertise.type','advertise_info.id')->where('advertise_info.id',$aParam['info_id'])
            ->join('advertise','advertise.id','=','advertise_info.ad_id')->first();
        DB::beginTransaction();
        try {
            if ($iInfo->type == 3) {
                $result1 = DB::table('advertise_info')->where('id', '=', $aParam['info_id'])->update(['js_key' => $aParam['js_key'], 'updated_at' => $date]);
            }
            $aKeyData = DB::table('advertise_key')->where('ad_id', $iInfo->ad_id)->get();
            $aArray = [];
            foreach ($aKeyData as $kKey => $iKey) {
                foreach ($aParam as $kParam => $iParam) {
                    if ($kParam == $iKey->js_key) {
                        $aArray[] = [
                            'info_id' => $iInfo->id,
                            'key_id' => $iKey->id,
                            'js_value' => $iParam,
                        ];
                    }
                }
            }
            $aValueData = DB::table('advertise_value')->where('info_id', $iInfo->id)->get();
            foreach ($aValueData as $kValue => $iValue) {
                foreach ($aArray as $kArray => $iArray) {
                    if ($iArray['info_id'] = $iValue->info_id && $iArray['key_id'] == $iValue->key_id) {
                        $aArray[$kValue]['id'] = $iValue->id;
                    }
                }
            }

            DB::update(AdvertiseValue::updateBatchStitching($aArray, ['js_value']));

            DB::commit();
            return response()->json([
                'status' => true
            ]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => '修改失败，请稍后再试！'
            ]);
        }
    }

    //排序广告位内容
    public function sortAdvertiseInfo(Request $request){
        $params = $request->all();
        $data = [];
        foreach ($params['sort'] as $key => $value){
            $data[$key]['sort'] = empty($value) ? 0 : $value;
            $data[$key]['id'] = $params['id'][$key];
        }
        if(DB::update(AdvertiseInfo::editBatchAdvertiseInfoData($data))){
            return response()->json([
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => '排序失败'
            ]);
        }
    }

    //删除广告位内容
    public function delAdvertiseInfo(Request $request){
        $aParam = $request->all();
        DB::beginTransaction();
        $result1 = DB::table('advertise_info')->where('id',$aParam['id'])->delete();
        $result2 = DB::table('advertise_value')->where('info_id',$aParam['id'])->delete();
        if($result1 && $result2){
            DB::commit();
            return response()->json([
                'status' => true
            ]);
        }
        DB::rollback();
        return response()->json([
            'status' => false,
            'msg' => '删除失败，请稍后再试！'
        ]);
    }

    //生成广告位内容
    public function generateAdvertiseInfo(){
        ini_set('memory_limit','2048M');
        //组装数据
        $aKeyData = DB::table('advertise_key')->where('status',1)->get();
        $aValueData = DB::table('advertise_value')->where('status',1)->get();
        $aFieldArray = [];
        foreach ($aKeyData as $kKey => $iKey){
            foreach ($aValueData as $kValue => $iValue){
                if($iValue->key_id == $iKey->id){
                    $aFieldArray[] = [
                        'key' => $iKey->js_key,
                        'type' => $iKey->type,
                        'value' => $iValue->js_value,
                        'info_id' => $iValue->info_id,
                        'key_id' => $iValue->key_id,
                        'value_id' => $iValue->id           //内容的id
                    ];
                }
            }
        }
        $aInfoData = DB::table('advertise_info')->where('status',1)->orderBy('sort','asc')->get();
        $aDataArray = [];
        foreach ($aInfoData as $kInfo => $iInfo){
            $aDataArray[$kInfo] = [
                'ad_id' => $iInfo->ad_id,
                'js_key' => $iInfo->js_key,
                'filed' => [],
            ];
            foreach ($aFieldArray as $kField => $iField){
                if($iInfo->id == $iField['info_id']){
                    if($iField['type']==3 && $iField['key']!='PChomeActivityKey')          //如果是富文本类型
                        $aDataArray[$kInfo]['filed'][$iField['key']] = $iField['value_id'];
                    else
                        $aDataArray[$kInfo]['filed'][$iField['key']] = $iField['value'];
                }
            }
        }
        unset($aFieldArray);
        $aAdData = DB::table('advertise')->where('status',1)->get();
        $aArray = [];
        foreach ($aAdData as $kAd => $iAd){
            $aArray[$iAd->js_key] = $this->getCombinationParam($aDataArray,$iAd);

        }
        $file = public_path('static/jsFile/generate.json');
        file_put_contents($file,json_encode($aArray));
        return response()->json([
            'status' => true
        ]);
    }

    public function getCombinationParam($aDataArray,$iAd){
        $aArray = [];
        foreach ($aDataArray as $kData => $iData){
            if($iAd->type == 1 && $iData['ad_id'] == $iAd->id){
                $aArray = $iData['filed'][$iAd->js_key];
            }elseif($iAd->type == 2 && $iData['ad_id'] == $iAd->id){
                $aArray[] = $iData['filed'];
            }elseif($iAd->type == 3 && $iData['ad_id'] == $iAd->id){
                $aArray[$iData['js_key']] = $iData['filed'];
            }
        }
        return $aArray;
    }
}
