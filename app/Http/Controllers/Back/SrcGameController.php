<?php

namespace App\Http\Controllers\Back;

use App\AgentOddsSetting;
use App\Games;
use App\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Array_;

class SrcGameController extends Controller
{
    //修改游戏设定
    public function editGameSetting(Request $request)
    {
        $g_id = $request->input('g_id');
        $holiday_start = $request->input('holiday_start');
        $holiday_end = $request->input('holiday_end');
        $order = $request->input('order');

        if(isset($g_id) && $g_id){
            $update = Games::where('g_id',$g_id)
                ->update([
                    'holiday_start'=>$holiday_start,
                    'holiday_end'=>$holiday_end,
                    'order'=>$order
                ]);
            if($update == 1){
                return response()->json([
                    'status'=>true,
                    'msg'=>'ok'
                ]);
            } else {
                return response()->json([
                    'status'=>false,
                    'msg'=>'暂时无法更新，请稍后重试'
                ]);
            }
        }
    }
    //变更游戏开封盘状态
    public function changeGameFengPan(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');

        $update = Games::where('g_id',$id)
            ->update([
                'fengpan'=>$type
            ]);
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'ok'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法更新，请稍后重试'
            ]);
        }
    }
    //修改游戏开启和停用状态
    public function changeGameStatus(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');

        $update = Games::where('g_id',$id)
            ->update([
                'status'=>$type
            ]);
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'ok'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法更新，请稍后重试'
            ]);
        }
    }

    //保存游戏赔率
    public function saveOddsRebate(Request $request)
    {
        $allForm = $request->all();
        $gameId = "";
        $gameData = collect([]);
        foreach ($allForm as $k=>$v){
            $gameData->put($k,$v);
        }
        $save = Storage::disk('local')->put('gameData.php',json_encode($gameData));
        if($save == true){
            return response()->json([
                'status'=>true,
                'msg'=>'OK!'
            ]);
        }
        //return $gameData;
//        $arr = array_unique($gameId);
//        $arr = array_values($arr);
//        $a = json_decode($gameData,true);
//        return $a['80_twoFace_odds'];
    }
    //修改杀率开启和停用状态
    public function killStatus(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');

        $update = DB::table('excel_base')->where('excel_base_idx',$id)
            ->update([
                'is_open'=>$type
            ]);
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'ok'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法更新，请稍后重试'
            ]);
        }
    }
    //修改杀率保留营利比
    public function editKillSetting(Request $request)
    {
        $id = $request->input('id');
        $rate = $request->input('kill_rate');

        if(isset($id) && $id){
            $update = DB::table('excel_base')->where('excel_base_idx',$id)
                ->update([
                    'kill_rate'=>$rate
                ]);
            if($update == 1){
                return response()->json([
                    'status'=>true,
                    'msg'=>'ok'
                ]);
            } else {
                return response()->json([
                    'status'=>false,
                    'msg'=>'暂时无法更新，请稍后重试'
                ]);
            }
        }
    }

    //添加代理赔率
    public function addAgentOdds(Request $request){
        $aParam = $request->post();
        if(!isset($aParam['odds']) || !array_key_exists('odds',$aParam)){
            return response()->json([
                'status'=>false,
                'msg'=>'请填写代理赔率'
            ]);
        }
        $iOdds = AgentOddsSetting::orderBy('level','desc')->value('odds');
        if(empty($iOdds))
            $iOdds = SystemSetting::getValueByRemark1('agent_odds_basis');
        if($aParam['odds'] >= $iOdds){
            return response()->json([
                'status'=>false,
                'msg'=>'赔率不得高于'.$iOdds
            ]);
        }
        if(empty($aParam['level'])) {
            $level = AgentOddsSetting::orderBy('level', 'desc')->value('level');
            $level = empty($level)?1:$level+1;
        }else{
            $level = $aParam['level'];
        }
        $aArray = [
            'level' => $level,
            'odds' => $aParam['odds'],
            'admin_id' => Session::get('account_id'),
            'admin_account' => Session::get('account'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if(AgentOddsSetting::insert($aArray))
            return response()->json([
                'status'=>true,
            ]);
        else
            return response()->json([
                'status'=>false,
                'msg'=>'添加失败，请稍后再试'
            ]);
    }

    //修改代理赔率
    public function editAgentOdds(Request $request){
        $aParam = $request->post();
        if(!isset($aParam['odds']) || !array_key_exists('odds',$aParam)){
            return response()->json([
                'status'=>false,
                'msg'=>'请填写代理赔率'
            ]);
        }
        $iData = AgentOddsSetting::find($aParam['id']);
        if($iData->level == 1){
            $iOdds = SystemSetting::getValueByRemark1('agent_odds_basis');
        }else{
            $iOdds = AgentOddsSetting::where('level',$iData->level - 1)->value('odds');
        }
        if($aParam['odds'] >= $iOdds){
            return response()->json([
                'status'=>false,
                'msg'=>'赔率不得高于'.$iOdds
            ]);
        }
        $aArray = [
            'odds' => $aParam['odds'],
            'admin_id' => Session::get('account_id'),
            'admin_account' => Session::get('account'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if(AgentOddsSetting::where('id',$aParam['id'])->update($aArray))
            return response()->json([
                'status'=>true,
            ]);
        else
            return response()->json([
                'status'=>false,
                'msg'=>'修改失败，请稍后再试'
            ]);
    }
}
