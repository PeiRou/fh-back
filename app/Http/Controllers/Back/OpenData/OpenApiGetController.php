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
            $num_str = '';
            foreach ($json as $k => $v){
                $num_str .= $v['number'];
            }
            $arrCode = explode(',',$num_str);
            return response()->json([
                'code' => 200,
                'data'=> $json,
                'status' => true,
                'openCode' => $num_str,
                'n1' => (int)$arrCode[0],
                'n2' => (int)$arrCode[1],
                'n3' => (int)$arrCode[2],
                'n4' => (int)$arrCode[3],
                'n5' => (int)$arrCode[4],
                'n6' => (int)$arrCode[5],
                'n7' => (int)$arrCode[6],
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
