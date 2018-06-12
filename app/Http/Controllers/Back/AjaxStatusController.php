<?php

namespace App\Http\Controllers\Back;

use App\Drawing;
use App\Recharges;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class AjaxStatusController extends Controller
{
    public function status()
    {
        $getCount = Recharges::where('status',1)->where('payType','!=','onlinePayment')->count();
        $getDrawCount = Drawing::where('status',0)->count();

        Redis::select(2);
        $onlineUserCount = Redis::dbsize();

        return response()->json([
            'status' => true,
            'count' => $getCount,
            'drawCount' => $getDrawCount,
            'onlineUser' => $onlineUserCount,
        ]);
    }
}
