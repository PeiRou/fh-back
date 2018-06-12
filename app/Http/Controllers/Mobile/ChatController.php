<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class ChatController extends Controller
{
    public function getSign(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $sign = md5($user->id.$user->username);
        return response()->json([
            'betMoney' => 10,
            'platCode' => 'ss500',
            'rechMoney' => 0,
            'sign' => $sign,
            'userId' => $user->id,
            'userName' => $user->username,
            'userType' => 1
        ]);
    }

    public function chatInit(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $room = [
            'betMoney'=>0,
            'createDate'=>null,
            'id'=>1,
            'isOpen'=>'1',
            'isSpeak'=>'0',
            'name'=>'SS500聊天室',
            'onlineCount'=>null,
            'platCode'=>'ss500',
            'platName'=>null,
            'rechMoney'=>10,
            'remark'=>'',
            'roomType'=>"1"
        ];
        return response()->json([
            'balance' => 0,
            'chatSpeak' => false,
            'fk' => 'ep+YswW2hcOoWzFh8tiK/g==',
            'iconUrl' => null,
            'nickName' => '***',
            'pushBet' => '0',
            'setted' => '0',
            'status' => 0,
            'token' => $request->token,
            //'room'=> $room
        ]);
    }

//    public function webchatInfo()
//    {
//        $origins = ["*:*"];
//        return response()->json([
////           'cookie_needed' => true,
////           'entropy' => -1683414828,
////           'websocket'=> true,
////           'origins' =>$origins
//        ]);
//    }
}
