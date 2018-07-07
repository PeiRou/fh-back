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
        $lhc = DB::table('game_lhc')->get();
        return DataTables::of($lhc)
            ->editColumn('issue',function ($lhc){
                return "<b style='color: #".$lhc->color.";'>$lhc->issue</b>";
            })
            ->editColumn('control',function ($lhc){
                return "<ul class='control-menu'>
                        <li onclick='edit(\"$lhc->id\")'>修改</li>
                        <li onclick='changeUserMoney(\"$lhc->id\")'>手动开奖</li>
                        </ul>";
            })
            ->rawColumns(['issue','control'])
            ->make(true);
    }
}
