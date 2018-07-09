<?php

namespace App\Http\Controllers\Back\OpenData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class OpenApiGetController extends Controller
{
    public function lhc($date = '',$issue)
    {
        $http = new Client();
        try{
            $res = $http->request('get','http://api.caipiaokong.cn/lottery/?name=xglhc&format=json&uid=973140&token=10b2f648e496015c7e8f4d82caade52b02d9905d&date='.$date);
            $json = json_decode((string) $res->getBody(), true);
//            $arrCode = explode(',',$json['number']);
            $issue_str = '';
            foreach ($json as $k => $v){
                $issue_str .= $k;
            }
            return response()->json([
                'code' => 200,
                'data'=> $issue_str,
                'status' => true,
//                'openCode' => $json['number'],
//                'n1' => $arrCode[0],
//                'n2' => $arrCode[1],
//                'n3' => $arrCode[2],
//                'n4' => $arrCode[3],
//                'n5' => $arrCode[4],
//                'n6' => $arrCode[5],
//                'n7' => $arrCode[6],
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
