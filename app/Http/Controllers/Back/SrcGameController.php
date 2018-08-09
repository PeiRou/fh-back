<?php

namespace App\Http\Controllers\Back;

use App\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
}
