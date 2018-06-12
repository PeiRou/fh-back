<?php

namespace App\Http\Controllers;

use App\Notices;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class NoticeController extends Controller
{
    public function getNotices(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $getNotice = Notices::all();
        $getNoticeCount = Notices::all()->count();
        return response()->json([
            'data'=>$getNotice,
            'otherData'=>null,
            'totalCount'=>$getNoticeCount
        ]);
    }
}
