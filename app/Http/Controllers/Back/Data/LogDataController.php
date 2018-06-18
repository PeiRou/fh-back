<?php

namespace App\Http\Controllers\Back\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LogDataController extends Controller
{
    public function login(Request $request)
    {
        $loginLog = DB::table('log_login')->get();
        return DataTables::of($loginLog)
            ->make(true);
    }
}
