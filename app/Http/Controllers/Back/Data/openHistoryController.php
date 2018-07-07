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
            ->make(true);
    }
}
