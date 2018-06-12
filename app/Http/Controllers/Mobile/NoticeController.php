<?php

namespace App\Http\Controllers\Mobile;

use App\Notices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class NoticeController extends Controller
{
    public function getNotices(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $rows = $request->rows;

        $notice = Notices::select()->paginate($rows);
        if(count($notice) !== 0){
            foreach($notice as $item){
                $data[] = [
                    'addDate' => Carbon::parse($item->created_at)->toDateTimeString(),
                    'content' => $item->content,
                    'id' => $item->id,
                    'isRead' => 0,
                    'title' => $item->title,
                    'userId' => $user->id
                ];
            }
        } else {
            $data = [];
        }
        $notice = Notices::all()->count();
        return response()->json([
            'data' => $data,
            'otherData' => null,
            'totalCount' => $notice
        ]);
    }
}
