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
            $res = $http->request('get','http://vip.jiangyuan365.com/K25ae456c03d2df/'.$issue.'/xglhc.json');
            $json = json_decode((string) $res->getBody(), true);
            $backCode = str_replace('+',',',$json[0]['code']);
            $arrCode = explode(',',$backCode);
            return response()->json([
                'code' => 200,
                'data'=> $json,
                'status' => true,
                'openCode' => $backCode,
                'n1' => $arrCode[0],
                'n2' => $arrCode[1],
                'n3' => $arrCode[2],
                'n4' => $arrCode[3],
                'n5' => $arrCode[4],
                'n6' => $arrCode[5],
                'n7' => $arrCode[6],
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
