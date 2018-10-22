<?php

namespace App\Http\Controllers\Back\Api;

use App\Agent;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function agents(Request $request)
    {
        $q = $request->get('q');
        $allAgent = Agent::select()
            ->where(function ($query) use($q){
                if(isset($q))
                {
                    $query->where('account','like',"%$q%")->orWhere('name','like',"%$q%");
                }
            })
            ->get();
        $data = [];
        foreach ($allAgent as $item){
            $data[] = [
                'id' => $item->a_id,
                'text' => $item->account."-".$item->name
            ];
        }
        $result = [
            "results" => $data,
            "pagination" => [
                "more"=> false
            ]
        ];
        return $result;
    }
    
    //检查用户表用户名是否可用
    public function checkUserUsername(Request $request)
    {
        $username = $request->get('username');
        $check = User::where('username',$username)->count();
        if($check == 0){
            $isAvailable = true;
        } else {
            $isAvailable = false;
        }
        return response()->json([
            'valid' => $isAvailable
        ]);
    }
}
