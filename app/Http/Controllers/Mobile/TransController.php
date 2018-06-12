<?php

namespace App\Http\Controllers\Mobile;

use App\Recharges;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransController extends Controller
{
    public function getRechList(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $rows = $request->rows;
        $getRecharges = Recharges::where('userId',$user->id)->orderBy('created_at','desc')->paginate($rows);
        $getRechargesCount = Recharges::where('userId',$user->id)->count();
        foreach ($getRecharges as $item){
            $data[] = [
                'id' => $item->id,
                'orderNo' => $item->orderNum,
                'userName' => $user->username,
                'userId' => $user->id,
                'statDate' => Carbon::parse($item->created_at)->toDateTimeString(),
                'rechType' => $item->payType,
                'account'=> $user->username,
                'addTime' => Carbon::parse($item->created_at)->toDateTimeString(),
                'rechTime' => Carbon::parse($item->created_at)->toDateTimeString(),
                'rechMoney' => $item->amount,
                'status' => $item->status,
                'remark' => $item->msg
            ];
        }
        return response()->json([
           'data'=>$data,
           'otherData'=>null,
            'totalCount' => $getRechargesCount
        ]);
    }

    public function getWithDrawList(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $rows = $request->rows;
        return response()->json([
            'data'=>[],
            'otherData'=>null,
            'totalCount' => 0
        ]);
    }

    public function getPacketList(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $rows = $request->rows;
        return response()->json([
            'data'=>[],
            'otherData'=>null,
            'totalCount' => 0
        ]);
    }
}
