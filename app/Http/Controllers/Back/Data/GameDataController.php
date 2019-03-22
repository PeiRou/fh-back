<?php

namespace App\Http\Controllers\Back\Data;

use App\AgentOddsSetting;
use App\Games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class GameDataController extends Controller
{
    //游戏数据
    public function games()
    {
        $games = DB::table('game')->orderBy('status','desc')->orderBy('order','asc')->orderBy('g_id','asc')->get();
        return DataTables::of($games)
            ->editColumn('holiday_start',function ($games){
                if(isset($games->holiday_start) && $games->holiday_start){
                    return "<span class=\"gary-text\">".$games->holiday_start."</span>";
                } else {
                    return "<span class=\"gary-text\">未设置</span>";
                }
            })
            ->editColumn('holiday_end',function ($games){
                if(isset($games->holiday_end) && $games->holiday_end){
                    return "<span class=\"gary-text\">".$games->holiday_end."</span>";
                } else {
                    return "<span class=\"gary-text\">未设置</span>";
                }
            })
            ->editColumn('order',function ($games){
                if(isset($games->order) && $games->order){
                    return $games->order;
                } else {
                    return "<span class=\"gary-text\">-</span>";
                }
            })
            ->editColumn('fengpan',function ($games){
                if($games->fengpan == 1){
                    return "<span class=\"status-1\"><i class=\"iconfont\">&#xe652;</i> 正常</span>";
                }
                if($games->fengpan == 0){
                    return "<span class=\"status-3\"><i class=\"iconfont\">&#xe657;</i> 封盘</span>";
                }
            })
            ->editColumn('status',function ($games){
                if($games->status == 1){
                    return "<span class=\"status-1\"><i class=\"iconfont\">&#xe652;</i> 正常</span>";
                }
                if($games->status == 0){
                    return "<span class=\"status-3\"><i class=\"iconfont\">&#xe601;</i> 停用</span>";
                }
            })
            ->editColumn('control',function ($games){
                $fengpan = '';
                $status = '';
                $seting = '';
                if(in_array('ac.ad.changeGameFengPan',$this->permissionArray)) {
                    if ($games->fengpan == 1) {
                        $fengpan = '| <span class="edit-link" onclick="fengpan(\'' . $games->g_id . '\',\'0\',\'' . $games->game_name . '\')"><i class="iconfont">&#xe657;</i> 封盘</span>';
                    } else {
                        $fengpan = '| <span class="edit-link" onclick="fengpan(\'' . $games->g_id . '\',\'1\',\'' . $games->game_name . '\')"><i class="iconfont">&#xe652;</i> 开盘</span>';
                    }
                }
                if(in_array('ac.ad.changeGameStatus',$this->permissionArray)) {
                    if ($games->status == 1) {
                        $status = '| <span class="edit-link" onclick="status(\'' . $games->g_id . '\',\'0\',\'' . $games->game_name . '\')"><i class="iconfont">&#xe601;</i> 停用</span>';
                    } else {
                        $status = '| <span class="edit-link" onclick="status(\'' . $games->g_id . '\',\'1\',\'' . $games->game_name . '\')"><i class="iconfont">&#xe652;</i> 开启</span>';
                    }
                }
                if(in_array('ac.ad.editGameSetting',$this->permissionArray)) {
                    $seting = '<span class="edit-link" onclick="setting(\''.$games->g_id.'\')"><i class="iconfont">&#xe64c;</i> 设置</span>';
                }

                return $seting.$fengpan.$status;
            })
            ->rawColumns(['holiday_start','holiday_end','fengpan','status','control','order'])
            ->make(true);
    }
    //杀率数据
    public function gamekillsetting()
    {
        $games = DB::table('excel_base')
            ->select(DB::raw('excel_base.*,game.game_name'))
            ->leftJoin('game', 'excel_base.game_id', '=', 'game.game_id')
            ->where('is_user', 1)
            ->get();
        return DataTables::of($games)
            ->editColumn('bet_money',function ($games){     //今日总投注
                if($games->count_date == date('Y-m-d'))
                    return round( $games->bet_money,3);
                else
                    return 0;
            })
            ->editColumn('bet_lose',function ($games){     //今日输
                if($games->count_date == date('Y-m-d'))
                    return round( $games->bet_lose,3);
                else
                    return 0;
            })
            ->editColumn('bet_win',function ($games){     //今日赢
                if($games->count_date == date('Y-m-d'))
                    return round( $games->bet_win,3);
                else
                    return 0;
            })
            ->editColumn('real_rate',function ($games){
                $total = $games->bet_lose + $games->bet_win;
                if($total>0 && $games->count_date == date('Y-m-d'))
                    return round(($games->bet_lose-$games->bet_win) / $total,3);
                else
                    return 0;
            })
            ->editColumn('kill_rate',function ($games){
                return floatval($games->kill_rate);
            })
            ->editColumn('control',function ($iData){
                $str = "";
                if(in_array('game.killStatus',$this->permissionArray)) {
                    if ($iData->is_open == 1) {         //----关闭
                        $str = $str . "<li onclick='closeKill(" . $iData->excel_base_idx . ")'><span class='status-3'>关闭</span></li>";
                    } else if ($iData->is_open == 0) {
                        $str = $str . "<li onclick='openKill(" . $iData->excel_base_idx . ")'><span class='status-1'>开启</span></li>";
                    }
                }

                if(in_array('game.killEdit',$this->permissionArray)) {
                    $str = $str . "<li onclick='setKill(" . $iData->excel_base_idx . ")'>修改</li>";
                }
                return "<ul class='control-menu'>" . $str . "</ul>";
//                return '<span class="edit-link" onclick="edit(\''.$iData->id.'\')"><i class="iconfont">&#xe64c;</i> 修改 </span> |
//                        <span class="edit-link" onclick="look(\''.$iData->level.'\')">当前赔率查看 </span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //代理赔率设定
    public function agentOdds(){
        $aData = AgentOddsSetting::get();
        return DataTables::of($aData)
            ->editColumn('control',function ($iData){
                $str = '';
                if(in_array('ac.ad.gameAgentOddsEdit',$this->permissionArray)) {
                    $str .= '<span class="edit-link" onclick="edit(\''.$iData->id.'\')"><i class="iconfont">&#xe64c;</i> 修改 </span> |';
                }
                $str .= '<span class="edit-link" onclick="look(\''.$iData->level.'\')">当前赔率查看 </span>';
                return $str;
//                return '<span class="edit-link" onclick="edit(\''.$iData->id.'\')"><i class="iconfont">&#xe64c;</i> 修改 </span> |
//                        <span class="edit-link" onclick="look(\''.$iData->level.'\')">当前赔率查看 </span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }
}
