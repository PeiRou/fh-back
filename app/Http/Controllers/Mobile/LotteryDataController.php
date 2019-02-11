<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Proxy\CurGame;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class LotteryDataController extends Controller
{
    protected $curGame;
    /**
     * LotteryDataController constructor.
     */
    public function __construct(CurGame $curGame)
    {
        $this->curGame = $curGame;
    }

    public function getLotteryData()
    {
        return response()->json([
            'unbalancedMoney' => 0,
            'winMoney' => 0
        ]);
    }

    public function CurIssue($gameId = "")
    {
        if($gameId == 1){
            $url = 'http://g.75speed.com/api/guan/cqssc';
            $html = json_decode(file_get_contents($url),true);
            if($html){
                return response()->json([
                    'gameId' => $gameId,
                    'issue' => $html[0]['issue'],
                    'nums' => $html[0]['nums'],
                    'opentime' => $html[0]['apitime']
                ]);
            }
        }
        if($gameId == 50){
            $url = 'http://g.75speed.com/api/guan/bjpk10';
            $html = json_decode(file_get_contents($url),true);
            if($html){
                return response()->json([
                    'gameId' => $gameId,
                    'issue' => $html[0]['issue'],
                    'nums' => $html[0]['nums'],
                    'opentime' => $html[0]['apitime']
                ]);
            }
        }
    }

    //
    public function getUserPlayData()
    {
        $quotaConfig = [];
        $playConfig = [];
        return response()->json([
            'quotaConfig'=>$quotaConfig,
            'playConfig'=>$playConfig
        ]);
    }
    
    //游戏页面获取下一期
    public function getNextIssue(Request $request)
    {
        $gameId = $request->get('gameId');
        return $this->curGame->nextIssue($gameId);
    }
    
    //当期游戏数据
    public function GameCurIssue($id)
    {
        return $this->curGame->HttpGet($id);
        //return $id;
    }
    
    //游戏大厅游戏数据
    public function getAllNextIssue()
    {
        $serverTime = date('Y-m-d H:i:s');
        //秒速赛车
        $mssc = DB::table('game_mssc')->orderBy('opentime','desc')->where('is_open',1)->first();
        $mssc_lotteryTime = Carbon::parse($mssc->opentime)->addSeconds('75')->toDateTimeString();
        $mssc_endTime = Carbon::parse($mssc->opentime)->addSeconds('60')->toDateTimeString();
        //北京赛车
        $bjpk10 = DB::table('game_bjpk10')->where('is_open',1)->orderBy('opentime','desc')->first();
        if(strtotime(date('H:i:s',strtotime($bjpk10->opentime))) == strtotime("23:50:00")){
            $bjpk10_lotteryTime = date('Y-m-d',strtotime('+1 day',strtotime($bjpk10->opentime)))." 09:10:30";
            $bjpk10_endTime = date('Y-m-d',strtotime('+1 day',strtotime($bjpk10->opentime)))." 09:10:00";
        } else {
            $bjpk10_lotteryTime = Carbon::parse($bjpk10->opentime)->addSeconds('300')->toDateTimeString();
            $bjpk10_endTime = Carbon::parse($bjpk10->opentime)->addSeconds('270')->toDateTimeString();
        }

        //秒速飞艇
        $msft = DB::table('game_msft')->orderBy('opentime','desc')->where('is_open',1)->first();
        $msft_lotteryTime = Carbon::parse($msft->opentime)->addSeconds('75')->toDateTimeString();
        $msft_endTime = Carbon::parse($msft->opentime)->addSeconds('60')->toDateTimeString();
        //跑马
        $paoma = DB::table('game_paoma')->orderBy('opentime','desc')->where('is_open',1)->first();
        $paoma_lotteryTime = Carbon::parse($paoma->opentime)->addSeconds('75')->toDateTimeString();
        $paoma_endTime = Carbon::parse($paoma->opentime)->addSeconds('60')->toDateTimeString();
        //秒速时时彩
        $msssc = DB::table('game_msssc')->orderBy('opentime','desc')->where('is_open',1)->first();
        $msssc_lotteryTime = Carbon::parse($msssc->opentime)->addSeconds('75')->toDateTimeString();
        $msssc_endTime = Carbon::parse($msssc->opentime)->addSeconds('60')->toDateTimeString();
        //PC蛋蛋
        $pcdd = DB::table('game_pcdd')->orderBy('opentime','desc')->where('is_open',1)->first();
        $pcdd_lotteryTime = Carbon::parse($pcdd->opentime)->addSeconds('300')->toDateTimeString();
        $pcdd_endTime = Carbon::parse($pcdd->opentime)->addSeconds('260')->toDateTimeString();
        //北京快乐8
        $bjkl8 = DB::table('game_bjkl8')->orderBy('opentime','desc')->where('is_open',1)->first();
        $bjkl8_lotteryTime = Carbon::parse($bjkl8->opentime)->addSeconds('300')->toDateTimeString();
        $bjkl8_endTime = Carbon::parse($bjkl8->opentime)->addSeconds('260')->toDateTimeString();
        //pk10牛牛
        $pknn = DB::table('game_pknn')->orderBy('opentime','desc')->where('is_open',1)->first();
        $pknn_lotteryTime = Carbon::parse($pknn->opentime)->addSeconds('300')->toDateTimeString();
        $pknn_endTime = Carbon::parse($pknn->opentime)->addSeconds('270')->toDateTimeString();
        //重庆时时彩
        $cqssc = DB::table('game_cqssc')->orderBy('id','desc')->where('is_open',1)->first();
        $db_opentime = explode(':',$cqssc->opentime);
        $secend_explode = explode(' ',$db_opentime[0]);
        $hour = (int)$secend_explode[1];
        $serverTime = explode(':',date('H:i:s'));
        $hours = $serverTime[0];
        // 早上10-晚上22，10分钟一期 。 晚上22-凌晨2，5分钟一期
        if($hour >= 22 || $hour <= 2){
            if(strtotime(date('H:i:s',strtotime($cqssc->opentime))) == strtotime("01:55:00")){
                $cqssc_lotteryTime = date('Y-m-d',strtotime($cqssc->opentime))." 10:00:00";
                $cqssc_endTime = date('Y-m-d',strtotime($cqssc->opentime))." 09:59:15";
            } else {
                $cqssc_lotteryTime = Carbon::parse($cqssc->opentime)->addSeconds('300')->toDateTimeString();
                $cqssc_endTime = Carbon::parse($cqssc->opentime)->addSeconds('255')->toDateTimeString();
            }
        }
        if($hour >= 10 && $hour < 22){
            $cqssc_lotteryTime = Carbon::parse($cqssc->opentime)->addSeconds('600')->toDateTimeString();
            $cqssc_endTime = Carbon::parse($cqssc->opentime)->addSeconds('555')->toDateTimeString();
        }
        if($hours > 2 && $hours < 10){
            $cqssc_lotteryTime = date('Y-m-d',strtotime($cqssc->opentime))." 10:00:00";
            $cqssc_endTime = date('Y-m-d',strtotime($cqssc->opentime))." 09:59:15";
        }

        $mssc_r = [
            'serverTime' => $serverTime,
            'preNum' => $mssc->opennum,
            'preLotteryTime' => $mssc->opentime,
            'preIssue' => $mssc->issue,
            'preIsOpen' => $mssc->is_open,
            'nums' => null,
            'lotteryTime' => $mssc_lotteryTime,
            'issue' => (string) ((int)$mssc->issue + 1),
            'gameId' => 80,
            'endtime' => $mssc_endTime
        ];
        $bjpk10_r = [
            'serverTime' => $serverTime,
            'preNum' => $bjpk10->opennum,
            'preLotteryTime' => $bjpk10->opentime,
            'preIssue' => $bjpk10->issue,
            'preIsOpen' => $bjpk10->is_open,
            'nums' => null,
            'lotteryTime' => $bjpk10_lotteryTime,
            'issue' => (string) ((int)$bjpk10->issue + 1),
            'gameId' => 50,
            'endtime' => $bjpk10_endTime
        ];
        $msft_r = [
            'serverTime' => $serverTime,
            'preNum' => $msft->opennum,
            'preLotteryTime' => $msft->opentime,
            'preIssue' => $msft->issue,
            'preIsOpen' => $msft->is_open,
            'nums' => null,
            'lotteryTime' => $msft_lotteryTime,
            'issue' => (string) ((int)$msft->issue + 1),
            'gameId' => 82,
            'endtime' => $msft_endTime
        ];
        $msssc_r = [
            'serverTime' => $serverTime,
            'preNum' => $msssc->opennum,
            'preLotteryTime' => $msssc->opentime,
            'preIssue' => $msssc->issue,
            'preIsOpen' => $msssc->is_open,
            'nums' => null,
            'lotteryTime' => $msssc_lotteryTime,
            'issue' => (string) ((int)$msssc->issue + 1),
            'gameId' => 81,
            'endtime' => $msssc_endTime
        ];
        $cqssc_r = [
            'serverTime' => $serverTime,
            'preNum' => $cqssc->opennum,
            'preLotteryTime' => $cqssc->opentime,
            'preIssue' => $cqssc->issue,
            'preIsOpen' => $cqssc->is_open,
            'nums' => null,
            'lotteryTime' => $cqssc_lotteryTime,
            'issue' => (string) ((int)$cqssc->issue + 1),
            'gameId' => 1,
            'endtime' => $cqssc_endTime
        ];
        $pcdd_r = [
            'serverTime' => $serverTime,
            'preNum' => $pcdd->opennum,
            'preLotteryTime' => $pcdd->opentime,
            'preIssue' => $pcdd->issue,
            'preIsOpen' => $pcdd->is_open,
            'nums' => null,
            'lotteryTime' => $pcdd_lotteryTime,
            'issue' => (string) ((int)$pcdd->issue + 1),
            'gameId' => 1,
            'endtime' => $pcdd_endTime
        ];
        $bjkl8_r = [
            'serverTime' => $serverTime,
            'preNum' => $bjkl8->opennum,
            'preLotteryTime' => $bjkl8->opentime,
            'preIssue' => $bjkl8->issue,
            'preIsOpen' => $bjkl8->is_open,
            'nums' => null,
            'lotteryTime' => $bjkl8_lotteryTime,
            'issue' => (string) ((int)$bjkl8->issue + 1),
            'gameId' => 1,
            'endtime' => $bjkl8_endTime
        ];
        $paoma_r = [
            'serverTime' => $serverTime,
            'preNum' => $paoma->opennum,
            'preLotteryTime' => $paoma->opentime,
            'preIssue' => $paoma->issue,
            'preIsOpen' => $paoma->is_open,
            'nums' => null,
            'lotteryTime' => $paoma_lotteryTime,
            'issue' => (string) ((int)$paoma->issue + 1),
            'gameId' => 1,
            'endtime' => $paoma_endTime
        ];
        $pknn_r = [
            'serverTime' => $serverTime,
            'preNum' => $pknn->opennum,
            'preLotteryTime' => $pknn->opentime,
            'preIssue' => $pknn->issue,
            'preIsOpen' => $pknn->is_open,
            'nums' => null,
            'lotteryTime' => $pknn_lotteryTime,
            'issue' => (string) ((int)$pknn->issue + 1),
            'gameId' => 1,
            'endtime' => $pknn_endTime
        ];
        $msnn_r = [
            'serverTime' => $serverTime,
            'preNum' => $mssc->opennum,
            'preLotteryTime' => $mssc->opentime,
            'preIssue' => $mssc->issue,
            'preIsOpen' => $mssc->is_open,
            'nums' => null,
            'lotteryTime' => $mssc_lotteryTime,
            'issue' => (string) ((int)$mssc->issue + 1),
            'gameId' => 1,
            'endtime' => $mssc_endTime
        ];

        return response()->json([
            80 => $mssc_r,
            50 => $bjpk10_r,
            82 => $msft_r,
            81 => $msssc_r,
            1 => $cqssc_r,
            66 => $pcdd_r,
            65 => $bjkl8_r,
            99 => $paoma_r,
            90 => $pknn_r,
            91 => $msnn_r
        ]);
    }
}
