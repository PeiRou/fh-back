<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentViewController extends Controller
{
    public function dash()
    {
        return view('agent.dash');
    }

    public function ajaxDash()
    {
        return view('agent.ajax.dash');
    }

    public function ajaxMember()
    {
        return view('agent.member');
    }
}
