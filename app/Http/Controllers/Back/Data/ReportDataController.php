<?php

namespace App\Http\Controllers\Back\Data;

use App\Agent;
use App\GeneralAgent;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ReportDataController extends Controller
{
    //总代理报表
    public function Gagent()
    {
        $Gagent = GeneralAgent::all();
        return DataTables::of($Gagent)
            ->make(true);
    }
    
    //代理报表
    public function Agent()
    {
        $agent = Agent::all();
        return DataTables::of($agent)
            ->make(true);
    }
    
    //会员报表
    public function User()
    {
        $user = User::all();
        return DataTables::of($user)
            ->make(true);
    }
}
