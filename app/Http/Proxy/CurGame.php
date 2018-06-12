<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/2/20
 * Time: 下午4:20
 */

namespace App\Http\Proxy;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CurGame
{
    public function HttpGet($gameId)
    {
        switch ($gameId){
            case 80; //秒速赛车
                $gameType = 'zi';
                $gameTag = 'mssc';
                break;
        }
        $http = new Client();
        if($gameType == 'zi'){
            $request = $http->get("http://112.213.105.60:8001/api/$gameTag");
            $response = json_decode((string) $request->getBody(), true);
            return response()->json([
                'gameId' => $gameId,
                'issue' => $response['expect'],
                'nums' => $response['opencode'],
                'opentime' => $response['opentime']
            ]);
        }
    }

    public function nextIssue($gameId)
    {
        switch ($gameId){
            case 80; //秒速赛车
                $gameTable = 'game_mssc';
                break;
            case 50; //北京赛车
                $gameTable = 'game_bjpk10';
                break;
            case 82; //秒速飞艇
                $gameTable = 'game_msft';
                break;
            case 81; //秒速时时彩
                $gameTable = 'game_msssc';
                break;
            case 1; //重庆时时彩
                $gameTable = 'game_cqssc';
                break;
            case 66; //PC蛋蛋
                $gameTable = 'game_pcdd';
                break;
            case 65; //北京快乐8
                $gameTable = 'game_bjkl8';
                break;
            case 99; //跑马
                $gameTable = 'game_paoma';
                break;
            case 90; //PK10牛牛
                $gameTable = 'game_pknn';
                break;
            case 91; //秒速牛牛
                $gameTable = 'game_mssc';
                break;
        }
        $getLottery = DB::table($gameTable)->where('is_open',1)->orderBy('opentime','desc')->take(1)->first();
        $issue = (int)$getLottery->issue+1;
        //秒速赛车
        if($gameTable == 'game_mssc'){
            $lotteryTime = Carbon::parse($getLottery->opentime)->addSeconds(75)->toDateTimeString();
            $endTime = Carbon::parse($getLottery->opentime)->addSeconds(60)->toDateTimeString();
            if(substr($getLottery->issue,-3) == 985){
                $issue = (int)date('ymd').'001';
                $lotteryTime = date('Y-m-d 07:30:30');
                $endTime = date('Y-m-d 07:30:15');
                $status = 0;
            } else {
                $status = 1;
            }
            if($gameId == 80){
                return response()->json([
                    "gameId"=>(int)$gameId,
                    "from_type"=>"0",
                    "serverTime"=>date('Y-m-d H:i:s'),
                    'issue' => $issue,
                    "endTime"=>$endTime,
                    "lotteryTime"=>$lotteryTime,
                    "preIssue"=>$getLottery->issue,
                    "preLotteryTime"=>$getLottery->opentime,
                    "preNum"=>$getLottery->opennum,
                    "preIsOpen"=>true,
                    "status" => $status
                ]);
            }
            //这里是秒速牛牛的结果
            if($gameId == 91){
                $nn = explode(',',$getLottery->niuniu);
                $replace = str_replace('10','0',$getLottery->opennum);
                $explodeNum = explode(',',$replace);
                $banker = (int)$explodeNum[0].(int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4];
                $player1 = (int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5];
                $player2 = (int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6];
                $player3 = (int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7];
                $player4 = (int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8];
                $player5 = (int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8].(int)$explodeNum[9];
                return response()->json([
                    "gameId"=>(int)$gameId,
                    "from_type"=>"0",
                    "serverTime"=>date('Y-m-d H:i:s'),
                    'issue' => $issue,
                    'n11'=>(int)$nn[0],
                    'n12'=>(int)$nn[1],
                    'n13'=>(int)$nn[2],
                    'n14'=>(int)$nn[3],
                    'n15'=>(int)$nn[4],
                    'n16'=>(int)$nn[5],
                    'banker' =>$banker,
                    'player1' =>$player1,
                    'player2' =>$player2,
                    'player3' =>$player3,
                    'player4' =>$player4,
                    'player5' =>$player5,
                    "endTime"=>$endTime,
                    "lotteryTime"=>$lotteryTime,
                    "preIssue"=>$getLottery->issue,
                    "preLotteryTime"=>$getLottery->opentime,
                    "preNum"=>$getLottery->opennum,
                    "preIsOpen"=>true,
                    "status" => $status
                ]);
            }

        }
        //跑马
        if($gameTable == 'game_paoma'){
            $lotteryTime = Carbon::parse($getLottery->opentime)->addSeconds(75)->toDateTimeString();
            $endTime = Carbon::parse($getLottery->opentime)->addSeconds(60)->toDateTimeString();
            if(substr($getLottery->issue,-3) == 985){
                $issue = (int)date('ymd').'001';
                $lotteryTime = date('Y-m-d 07:30:00');
                $endTime = date('Y-m-d 07:29:45');
                $status = 0;
            } else {
                $status = 1;
            }
            return response()->json([
                "gameId"=>(int)$gameId,
                "from_type"=>"0",
                "serverTime"=>date('Y-m-d H:i:s'),
                'issue' => $issue,
                "endTime"=>$endTime,
                "lotteryTime"=>$lotteryTime,
                "preIssue"=>$getLottery->issue,
                "preLotteryTime"=>$getLottery->opentime,
                "preNum"=>$getLottery->opennum,
                "preIsOpen"=>true,
                "status" => $status
            ]);
        }
        //秒速飞艇
        if($gameTable == 'game_msft'){
            $lotteryTime = Carbon::parse($getLottery->opentime)->addSeconds(75)->toDateTimeString();
            $endTime = Carbon::parse($getLottery->opentime)->addSeconds(60)->toDateTimeString();
            if(substr($getLottery->issue,-3) == 985){
                $issue = (int)date('ymd').'001';
                $lotteryTime = date('Y-m-d 07:31:00');
                $endTime = date('Y-m-d 07:30:45');
                $status = 0;
            } else {
                $status = 1;
            }
            return response()->json([
                "gameId"=>(int)$gameId,
                "from_type"=>"0",
                "serverTime"=>date('Y-m-d H:i:s'),
                'issue' => $issue,
                "endTime"=>$endTime,
                "lotteryTime"=>$lotteryTime,
                "preIssue"=>$getLottery->issue,
                "preLotteryTime"=>$getLottery->opentime,
                "preNum"=>$getLottery->opennum,
                "preIsOpen"=>true,
                "status" => $status
            ]);
        }
        //秒速时时彩
        if($gameTable == 'game_msssc'){
            $lotteryTime = Carbon::parse($getLottery->opentime)->addSeconds(75)->toDateTimeString();
            $endTime = Carbon::parse($getLottery->opentime)->addSeconds(60)->toDateTimeString();
            if(substr($getLottery->issue,-3) == 985){
                $issue = (int)date('ymd').'001';
                $lotteryTime = date('Y-m-d 07:31:30');
                $endTime = date('Y-m-d 07:31:15');
                $status = 0;
            } else {
                $status = 1;
            }
            return response()->json([
                "gameId"=>(int)$gameId,
                "from_type"=>"0",
                "serverTime"=>date('Y-m-d H:i:s'),
                'issue' => $issue,
                "endTime"=>$endTime,
                "lotteryTime"=>$lotteryTime,
                "preIssue"=>$getLottery->issue,
                "preLotteryTime"=>$getLottery->opentime,
                "preNum"=>$getLottery->opennum,
                "preIsOpen"=>true,
                "status" => $status
            ]);
        }
        //北京赛车
        if($gameTable == 'game_bjpk10'){
            $issue = Redis::get('pk10:nextIssue');
            $getNext = DB::table('game_bjpk10')->where('issue',$issue)->first();
            $time1 = strtotime(date('Y-m-d 00:00:01'));
            $time2 = strtotime(date('Y-m-d 09:02:30'));
            $now = strtotime(date('Y-m-d H:i:s'));

            //$lotteryTime = Carbon::parse($getLottery->opentime)->addMinutes(5)->toDateTimeString();
            $lotteryTime = $getNext->opentime;
            //$endTime = Carbon::parse($getLottery->opentime)->addSeconds(270)->toDateTimeString();
            $endTime = Carbon::parse($getNext->opentime)->addSeconds(-30)->toDateTimeString();

            if($now > $time1 && $now < $time2){
                $lotteryTime = date('Y-m-d 09:07:30');
                $endTime = date('Y-m-d 09:07:00');
                $status = 0;
            } else {
                $status = 1;
            }

            return response()->json([
                "gameId"=>(int)$gameId,
                "from_type"=>"0",
                "serverTime"=>date('Y-m-d H:i:s'),
                'issue' => $issue,
                "endTime"=>$endTime,
                "lotteryTime"=>$lotteryTime,
                "preIssue"=>$getLottery->issue,
                "preLotteryTime"=>$getLottery->opentime,
                "preNum"=>$getLottery->opennum,
                "preIsOpen"=>true,
                "status" => $status
            ]);
        }
        //PK10牛牛
        if($gameTable == 'game_pknn'){
            $issue = Redis::get('pknn:nextIssue');
            $getNext = DB::table('game_pknn')->where('issue',$issue)->first();
            $time1 = strtotime(date('Y-m-d 00:00:01'));
            $time2 = strtotime(date('Y-m-d 09:02:30'));
            $now = strtotime(date('Y-m-d H:i:s'));

            //$lotteryTime = Carbon::parse($getLottery->opentime)->addMinutes(5)->toDateTimeString();
            $lotteryTime = $getNext->opentime;
            //$endTime = Carbon::parse($getLottery->opentime)->addSeconds(270)->toDateTimeString();
            $endTime = Carbon::parse($getNext->opentime)->addSeconds(-30)->toDateTimeString();

            if($now > $time1 && $now < $time2){
                $lotteryTime = date('Y-m-d 09:07:30');
                $endTime = date('Y-m-d 09:07:00');
                $status = 0;
            } else {
                $status = 1;
            }

            $nn = explode(',',$getLottery->niuniu);
            $replace = str_replace('10','0',$getLottery->opennum);
            $explodeNum = explode(',',$replace);
            $banker = (int)$explodeNum[0].(int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4];
            $player1 = (int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5];
            $player2 = (int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6];
            $player3 = (int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7];
            $player4 = (int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8];
            $player5 = (int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8].(int)$explodeNum[9];

            return response()->json([
                "gameId"=>(int)$gameId,
                "from_type"=>"0",
                "serverTime"=>date('Y-m-d H:i:s'),
                'issue' => $issue,
                'n11'=>(int)$nn[0],
                'n12'=>(int)$nn[1],
                'n13'=>(int)$nn[2],
                'n14'=>(int)$nn[3],
                'n15'=>(int)$nn[4],
                'n16'=>(int)$nn[5],
                'banker' =>$banker,
                'player1' =>$player1,
                'player2' =>$player2,
                'player3' =>$player3,
                'player4' =>$player4,
                'player5' =>$player5,
                "endTime"=>$endTime,
                "lotteryTime"=>$lotteryTime,
                "preIssue"=>$getLottery->issue,
                "preLotteryTime"=>$getLottery->opentime,
                "preNum"=>$getLottery->opennum,
                "preIsOpen"=>true,
                "status" => $status
            ]);
        }
        //PC蛋蛋
        if($gameTable == 'game_pcdd' || $gameTable == 'game_bjkl8'){
            $issue = Redis::get('bjkl8:nextIssue');
            $getNext = DB::table($gameTable)->where('issue',$issue)->first();
            $time1 = strtotime(date('Y-m-d 00:00:01'));
            $time2 = strtotime(date('Y-m-d 09:00:00'));
            $now = strtotime(date('Y-m-d H:i:s'));

            //$lotteryTime = Carbon::parse($getLottery->opentime)->addMinutes(5)->toDateTimeString();
            $lotteryTime = $getNext->opentime;
            //$endTime = Carbon::parse($getLottery->opentime)->addSeconds(270)->toDateTimeString();
            $endTime = Carbon::parse($getNext->opentime)->addSeconds(-30)->toDateTimeString();

            if($now > $time1 && $now < $time2){
                $lotteryTime = date('Y-m-d 09:05:00');
                $endTime = date('Y-m-d 09:04:30');
                $status = 0;
            } else {
                $status = 1;
            }

            return response()->json([
                "gameId"=>(int)$gameId,
                "from_type"=>"0",
                "serverTime"=>date('Y-m-d H:i:s'),
                'issue' => $issue,
                "endTime"=>$endTime,
                "lotteryTime"=>$lotteryTime,
                "preIssue"=>$getLottery->issue,
                "preLotteryTime"=>$getLottery->opentime,
                "preNum"=>$getLottery->opennum,
                "preIsOpen"=>true,
                "status" => $status
            ]);
        }
        //重庆时时彩
        if($gameTable == 'game_cqssc'){
            $serverTime = explode(':',date('H:i:s'));
            $issue = Redis::get('cqssc:nextIssue');
            $getNext = DB::table('game_cqssc')->where('issue',$issue)->first();
            $hour = $serverTime[0];
            if($hour >= 22 || $hour <= 2){
                if(strtotime(date('H:i:s',strtotime($getLottery->opentime))) == strtotime("01:55:00")){
                    $lotteryTime = date('Y-m-d',strtotime($getLottery->opentime))." 10:00:00";
                    $endTime = date('Y-m-d',strtotime($getLottery->opentime))." 09:59:15";
                } else {
                    $lotteryTime = Carbon::parse($getLottery->opentime)->addSeconds('300')->toDateTimeString();
                    $endTime = Carbon::parse($getLottery->opentime)->addSeconds('255')->toDateTimeString();
                }
            }
            if($hour >= 10 && $hour < 22){
                $lotteryTime = Carbon::parse($getLottery->opentime)->addSeconds('600')->toDateTimeString();
                $endTime = Carbon::parse($getLottery->opentime)->addSeconds('555')->toDateTimeString();
            }
            if($hour > 2 && $hour < 10){
                $lotteryTime = date('Y-m-d',strtotime($getLottery->opentime))." 10:00:00";
                $endTime = date('Y-m-d',strtotime($getLottery->opentime))." 09:59:15";
                $status = 0;
            } else {
                $status = 1;
            }
            return response()->json([
                "gameId"=>(int)$gameId,
                "from_type"=>"0",
                "serverTime"=>date('Y-m-d H:i:s'),
                'issue' => $issue,
                "endTime"=>Carbon::parse($getNext->opentime)->addSeconds(-45)->toDateTimeString(),
                "lotteryTime"=>$getNext->opentime,
                "preIssue"=>$getLottery->issue,
                "preLotteryTime"=>$getLottery->opentime,
                "preNum"=>$getLottery->opennum,
                "preIsOpen"=>true,
                "status" => $status
            ]);
        }
    }
}