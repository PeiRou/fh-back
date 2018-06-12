<?php

namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
class OpenRecordController extends Controller
{

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){

        $type = $request->input('type');
        $date = $request->input('date');
        switch ($type){
            case '80':
                $items = $this->getMssc($date);
            case '81':
                $items = $this->getMsssc($date);
            case '82':
                $items = $this->getMsft($date);
        }
        return response()->json(['records'=>$items],200);
    }

    /***
     * @param $date
     * @return mixed
     */
    public function getMssc($date){
        $now = $date?false:true;
        return DB::table('game_mssc')->when($date, function ($query) use ($date) {
            $tomorrow = date('Y-m-d H:i:s',strtotime($date)+86399);
            return $query->whereBetween('opentime', [$date, $tomorrow]);
            })->when($now,function ($query) {
                $date     = date('Y-m-d 00:00:00');
                $tomorrow = date('Y-m-d H:i:s',strtotime($date)+86399);
                return $query->whereBetween('opentime', [$date, $tomorrow]);
            })->get(['issue','opentime','opennum'])->toArray();
    }

    /***
     * @param $date
     * @return mixed
     */
    public function getMsssc($date){
        $now = $date?false:true;
        return DB::table('game_mssc')->when($date, function ($query) use ($date) {
            $tomorrow = date('Y-m-d H:i:s',strtotime($date)+86399);
            return $query->whereBetween('opentime', [$date, $tomorrow]);
        })->when($now,function ($query) {
            $date     = date('Y-m-d 00:00:00');
            $tomorrow = date('Y-m-d H:i:s',strtotime($date)+86399);
            return $query->whereBetween('opentime', [$date, $tomorrow]);
        })->get(['issue','opentime','opennum'])->toArray();
    }

    /***
     * @param $date
     * @return mixed
     */
    public function getMsft($date){
        $now = $date?false:true;
        return DB::table('game_mssc')->when($date, function ($query) use ($date) {
            $tomorrow = date('Y-m-d H:i:s',strtotime($date)+86399);
            return $query->whereBetween('opentime', [$date, $tomorrow]);
        })->when($now,function ($query) {
            $date     = date('Y-m-d 00:00:00');
            $tomorrow = date('Y-m-d H:i:s',strtotime($date)+86399);
            return $query->whereBetween('opentime', [$date, $tomorrow]);
        })->get(['issue','opentime','opennum'])->toArray();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMsscData(){
        $client = new Client();
        $url    = \Config::get('website.openServerUrl').'mssc';
        $re     =  $client->request('GET', $url);
        $item   = $re->getBody()->getContents();
        return response()->json($item,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMssscData(){
        $client = new Client();
        $url    = \Config::get('website.openServerUrl').'msssc';
        $re     =  $client->request('GET', $url);
        $item   = $re->getBody()->getContents();
        return response()->json($item,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMsftData(){
        $client = new Client();
        $url    = \Config::get('website.openServerUrl').'msft';
        $re     =  $client->request('GET', $url);
        $item   = $re->getBody()->getContents();
        return response()->json($item,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBjpk10Data(){
        $client = new Client();
        $url    = 'http://e.apiplus.net/newly.do?token=a8e90a303ec6961f&code=bjpk10&rows=1&format=json';
        $re     =  $client->request('GET', $url);
        $response = json_decode((string) $re->getBody()->getContents(), true);
        $item = [
            'code'=>'bjpk10',
            'expect' => $response['data'][0]['expect'],
            'opencode' =>$response['data'][0]['opencode'],
            'opentime' => $response['data'][0]['opentime'],
            'opentimestamp' => strtotime($response['data'][0]['opentime']),
            'servertime' => strtotime(date('Y-m-d H:i:s')),
        ];
        return response()->json($item,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCqsscData(){
        $client = new Client();
        $url    = 'http://e.apiplus.net/newly.do?token=a8e90a303ec6961f&code=cqssc&rows=1&format=json';
        $re     =  $client->request('GET', $url);
        $response = json_decode((string) $re->getBody()->getContents(), true);
        $item = [
            'code'=>'cqssc',
            'expect' => $response['data'][0]['expect'],
            'opencode' =>$response['data'][0]['opencode'],
            'opentime' => $response['data'][0]['opentime'],
            'opentimestamp' => strtotime($response['data'][0]['opentime']),
            'servertime' => strtotime(date('Y-m-d H:i:s')),
        ];
        return response()->json($item,200);
    }

}
