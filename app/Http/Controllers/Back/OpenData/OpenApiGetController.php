<?php

namespace App\Http\Controllers\Back\OpenData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class OpenApiGetController extends Controller
{
    public function lhc($issue = '')
    {
        $http = new Client();
        try{
            $res = $http->request('get','http://vip.jiangyuan365.com/K25ae456c03d2df/18077/xglhc.json');
            $json = json_decode((string) $res->getBody(), true);
            return response()->json([
                'code' => 200,
                'data'=> $json,
                'status' => true
            ]);
        } catch (\Exception $e){
            return response()->json([
                'code'=> $e->getCode(),
                'status' => false,
                'msg' => '获取失败，原因1.本期暂未开奖，2.接口数据返回异常'
            ]);
        }
    }
}
