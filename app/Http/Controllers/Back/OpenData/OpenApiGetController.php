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
                'issue'=> $json
            ]);
        } catch (\Exception $e){
            return response()->json([
                'issue'=> $e->getCode()
            ]);
        }
    }
}
