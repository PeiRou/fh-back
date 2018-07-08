<?php

namespace App\Http\Controllers\Back\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class openHistoryController extends Controller
{
    public function lhc(Request $request)
    {
        $lhc = DB::table('game_lhc')->orderBy('id','DESC')->get();
        return DataTables::of($lhc)
            ->editColumn('issue',function ($lhc){
                return "<b style='color: #".$lhc->color.";'>$lhc->issue</b>";
            })
            ->editColumn('is_open',function ($lhc){
                if($lhc->is_open == 1){
                    return '已开奖';
                }
                if($lhc->is_open == 0){
                    return '暂未开奖';
                }
            })
            ->editColumn('control',function ($lhc){
                if($lhc->is_open == 0){
                    return "<ul class='control-menu'>
                        <li onclick='edit(\"$lhc->id\")'>修改</li>
                        <li onclick='open(\"$lhc->id\")'>手动开奖</li>
                        </ul>";
                }
                if($lhc->is_open == 1){
                    return "<ul class='control-menu'>
                        <li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>
                        <li onclick='cancel(\"$lhc->id\")'>撤单</li>
                        </ul>";
                }
            })
            ->rawColumns(['issue','control'])
            ->make(true);
    }
}
