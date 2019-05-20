<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 上午11:21
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Msft extends Excel
{
    protected $arrPlay_id = array(821322426,821322427,821322428,821322429,821322430,821322431,821322432,821322433,821322434,821322435,821322436,821322437,821322438,821322439,821322440,821322441,821322442,821322443,821322444,821322445,821322446,821332447,821332448,821332449,821332450,821332451,821332452,821332453,821332454,821332455,821332456,821332457,821332458,821332459,821332460,821332461,821332462,821342463,821342464,821342465,821342466,821342467,821342468,821342469,821342470,821342471,821342472,821342473,821342474,821342475,821342476,821342477,821342478,821352479,821352480,821352481,821352482,821352483,821352484,821352485,821352486,821352487,821352488,821352489,821352490,821352491,821352492,821352493,821352494,821362495,821362496,821362497,821362498,821362499,821362500,821362501,821362502,821362503,821362504,821362505,821362506,821362507,821362508,821362509,821362510,821372511,821372512,821372513,821372514,821372515,821372516,821372517,821372518,821372519,821372520,821372521,821372522,821372523,821372524,821372525,821372526,821382527,821382528,821382529,821382530,821382531,821382532,821382533,821382534,821382535,821382536,821382537,821382538,821382539,821382540,821392541,821392542,821392543,821392544,821392545,821392546,821392547,821392548,821392549,821392550,821392551,821392552,821392553,821392554,821402555,821402556,821402557,821402558,821402559,821402560,821402561,821402562,821402563,821402564,821402565,821402566,821402567,821402568,821412569,821412570,821412571,821412572,821412573,821412574,821412575,821412576,821412577,821412578,821412579,821412580,821412581,821412582,821422583,821422584,821422585,821422586,821422587,821422588,821422589,821422590,821422591,821422592,821422593,821422594,821422595,821422596);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>132,
        'GUANJUN' =>133,
        'YAJUN' =>134,
        'DISANMING' =>135,
        'DISIMING' =>136,
        'DIWUMING' =>137,
        'DILIUMING' =>138,
        'DIQIMING' =>139,
        'DIBAMING' =>140,
        'DIJIUMING' =>141,
        'DISHIMING' =>142,
    );
    protected $arrPlayId = array(
        'GUANYADA' => 2426,
        'GUANYAXIAO' => 2427,
        'GUANYADAN' => 2428,
        'GUANYASHUANG' => 2429,
        'GUANYAJUNHE3' => 2430,
        'GUANYAJUNHE4' => 2431,
        'GUANYAJUNHE5' => 2432,
        'GUANYAJUNHE6' => 2433,
        'GUANYAJUNHE7' => 2434,
        'GUANYAJUNHE8' => 2435,
        'GUANYAJUNHE9' => 2436,
        'GUANYAJUNHE10' => 2437,
        'GUANYAJUNHE11' => 2438,
        'GUANYAJUNHE12' => 2439,
        'GUANYAJUNHE13' => 2440,
        'GUANYAJUNHE14' => 2441,
        'GUANYAJUNHE15' => 2442,
        'GUANYAJUNHE16' => 2443,
        'GUANYAJUNHE17' => 2444,
        'GUANYAJUNHE18' => 2445,
        'GUANYAJUNHE19' => 2446,
        'LIANGMIANGUANJUNDA' => 2447,
        'LIANGMIANGUANJUNXIAO' => 2448,
        'LIANGMIANGUANJUNDAN' => 2449,
        'LIANGMIANGUANJUNSHUANG' => 2450,
        'LIANGMIANGUANJUNLONG' => 2451,
        'LIANGMIANGUANJUNHU' => 2452,
        'DANHAOGUANJUN1' => 2453,
        'DANHAOGUANJUN2' => 2454,
        'DANHAOGUANJUN3' => 2455,
        'DANHAOGUANJUN4' => 2456,
        'DANHAOGUANJUN5' => 2457,
        'DANHAOGUANJUN6' => 2458,
        'DANHAOGUANJUN7' => 2459,
        'DANHAOGUANJUN8' => 2460,
        'DANHAOGUANJUN9' => 2461,
        'DANHAOGUANJUN10' => 2462,
        'LIANGMIANYAJUNDA' => 2463,
        'LIANGMIANYAJUNXIAO' => 2464,
        'LIANGMIANYAJUNDAN' => 2465,
        'LIANGMIANYAJUNSHUANG' => 2466,
        'LIANGMIANYAJUNLONG' => 2467,
        'LIANGMIANYAJUNHU' => 2468,
        'DANHAOYAJUN1' => 2469,
        'DANHAOYAJUN2' => 2470,
        'DANHAOYAJUN3' => 2471,
        'DANHAOYAJUN4' => 2472,
        'DANHAOYAJUN5' => 2473,
        'DANHAOYAJUN6' => 2474,
        'DANHAOYAJUN7' => 2475,
        'DANHAOYAJUN8' => 2476,
        'DANHAOYAJUN9' => 2477,
        'DANHAOYAJUN10' => 2478,
        'LIANGMIANDISANMINGDA' => 2479,
        'LIANGMIANDISANMINGXIAO' => 2480,
        'LIANGMIANDISANMINGDAN' => 2481,
        'LIANGMIANDISANMINGSHUANG' => 2482,
        'LIANGMIANDISANMINGLONG' => 2483,
        'LIANGMIANDISANMINGHU' => 2484,
        'DANHAODISANMING1' => 2485,
        'DANHAODISANMING2' => 2486,
        'DANHAODISANMING3' => 2487,
        'DANHAODISANMING4' => 2488,
        'DANHAODISANMING5' => 2489,
        'DANHAODISANMING6' => 2490,
        'DANHAODISANMING7' => 2491,
        'DANHAODISANMING8' => 2492,
        'DANHAODISANMING9' => 2493,
        'DANHAODISANMING10' => 2494,
        'LIANGMIANDISIMINGDA' => 2495,
        'LIANGMIANDISIMINGXIAO' => 2496,
        'LIANGMIANDISIMINGDAN' => 2497,
        'LIANGMIANDISIMINGSHUANG' => 2498,
        'LIANGMIANDISIMINGLONG' => 2499,
        'LIANGMIANDISIMINGHU' => 2500,
        'DANHAODISIMING1' => 2501,
        'DANHAODISIMING2' => 2502,
        'DANHAODISIMING3' => 2503,
        'DANHAODISIMING4' => 2504,
        'DANHAODISIMING5' => 2505,
        'DANHAODISIMING6' => 2506,
        'DANHAODISIMING7' => 2507,
        'DANHAODISIMING8' => 2508,
        'DANHAODISIMING9' => 2509,
        'DANHAODISIMING10' => 2510,
        'LIANGMIANDIWUMINGDA' => 2511,
        'LIANGMIANDIWUMINGXIAO' => 2512,
        'LIANGMIANDIWUMINGDAN' => 2513,
        'LIANGMIANDIWUMINGSHUANG' => 2514,
        'LIANGMIANDIWUMINGLONG' => 2515,
        'LIANGMIANDIWUMINGHU' => 2516,
        'DANHAODIWUMING1' => 2517,
        'DANHAODIWUMING2' => 2518,
        'DANHAODIWUMING3' => 2519,
        'DANHAODIWUMING4' => 2520,
        'DANHAODIWUMING5' => 2521,
        'DANHAODIWUMING6' => 2522,
        'DANHAODIWUMING7' => 2523,
        'DANHAODIWUMING8' => 2524,
        'DANHAODIWUMING9' => 2525,
        'DANHAODIWUMING10' => 2526,
        'LIANGMIANDILIUMINGDA' => 2527,
        'LIANGMIANDILIUMINGXIAO' => 2528,
        'LIANGMIANDILIUMINGDAN' => 2529,
        'LIANGMIANDILIUMINGSHUANG' => 2530,
        'DANHAODILIUMING1' => 2531,
        'DANHAODILIUMING2' => 2532,
        'DANHAODILIUMING3' => 2533,
        'DANHAODILIUMING4' => 2534,
        'DANHAODILIUMING5' => 2535,
        'DANHAODILIUMING6' => 2536,
        'DANHAODILIUMING7' => 2537,
        'DANHAODILIUMING8' => 2538,
        'DANHAODILIUMING9' => 2539,
        'DANHAODILIUMING10' => 2540,
        'LIANGMIANDIQIMINGDA' => 2541,
        'LIANGMIANDIQIMINGXIAO' => 2542,
        'LIANGMIANDIQIMINGDAN' => 2543,
        'LIANGMIANDIQIMINGSHUANG' => 2544,
        'DANHAODIQIMING1' => 2545,
        'DANHAODIQIMING2' => 2546,
        'DANHAODIQIMING3' => 2547,
        'DANHAODIQIMING4' => 2548,
        'DANHAODIQIMING5' => 2549,
        'DANHAODIQIMING6' => 2550,
        'DANHAODIQIMING7' => 2551,
        'DANHAODIQIMING8' => 2552,
        'DANHAODIQIMING9' => 2553,
        'DANHAODIQIMING10' => 2554,
        'LIANGMIANDIBAMINGDA' => 2555,
        'LIANGMIANDIBAMINGXIAO' => 2556,
        'LIANGMIANDIBAMINGDAN' => 2557,
        'LIANGMIANDIBAMINGSHUANG' => 2558,
        'DANHAODIBAMING1' => 2559,
        'DANHAODIBAMING2' => 2560,
        'DANHAODIBAMING3' => 2561,
        'DANHAODIBAMING4' => 2562,
        'DANHAODIBAMING5' => 2563,
        'DANHAODIBAMING6' => 2564,
        'DANHAODIBAMING7' => 2565,
        'DANHAODIBAMING8' => 2566,
        'DANHAODIBAMING9' => 2567,
        'DANHAODIBAMING10' => 2568,
        'LIANGMIANDIJIUMINGDA' => 2569,
        'LIANGMIANDIJIUMINGXIAO' => 2570,
        'LIANGMIANDIJIUMINGDAN' => 2571,
        'LIANGMIANDIJIUMINGSHUANG' => 2572,
        'DANHAODIJIUMING1' => 2573,
        'DANHAODIJIUMING2' => 2574,
        'DANHAODIJIUMING3' => 2575,
        'DANHAODIJIUMING4' => 2576,
        'DANHAODIJIUMING5' => 2577,
        'DANHAODIJIUMING6' => 2578,
        'DANHAODIJIUMING7' => 2579,
        'DANHAODIJIUMING8' => 2580,
        'DANHAODIJIUMING9' => 2581,
        'DANHAODIJIUMING10' => 2582,
        'LIANGMIANDISHIMINGDA' => 2583,
        'LIANGMIANDISHIMINGXIAO' => 2584,
        'LIANGMIANDISHIMINGDAN' => 2585,
        'LIANGMIANDISHIMINGSHUANG' => 2586,
        'DANHAODISHIMING1' => 2587,
        'DANHAODISHIMING2' => 2588,
        'DANHAODISHIMING3' => 2589,
        'DANHAODISHIMING4' => 2590,
        'DANHAODISHIMING5' => 2591,
        'DANHAODISHIMING6' => 2592,
        'DANHAODISHIMING7' => 2593,
        'DANHAODISHIMING8' => 2594,
        'DANHAODISHIMING9' => 2595,
        'DANHAODISHIMING10' => 2596,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $SC = new ExcelLotterySC();
        $SC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $SC->GYH($gameId,$win);
        $SC->GYH_ZD_NUM($gameId,$win);
        $SC->GJ($gameId,$win);
        $SC->YJ($gameId,$win);
        $SC->SAN($gameId,$win);
        $SC->SI($gameId,$win);
        $SC->WU($gameId,$win);
        $SC->LIU($gameId,$win);
        $SC->QI($gameId,$win);
        $SC->BA($gameId,$win);
        $SC->JIU($gameId,$win);
        $SC->SHI($gameId,$win);
        $SC->NUM1($gameId,$win);
        $SC->NUM2($gameId,$win);
        $SC->NUM3($gameId,$win);
        $SC->NUM4($gameId,$win);
        $SC->NUM5($gameId,$win);
        $SC->NUM6($gameId,$win);
        $SC->NUM7($gameId,$win);
        $SC->NUM8($gameId,$win);
        $SC->NUM9($gameId,$win);
        $SC->NUM10($gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_msft';
        $gameName = '秒速飞艇';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'msft killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $table);
                }
            }
            if(!$excel){
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,$excel,$this->arrPlay_id,true);
                $this->bet_total($issue,$gameId);
                if($bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                    if($updateUserMoney == 1){
                        writeLog('New_Bet', $gameName . $issue . "结算出错");
                    }
                }
            }
        }
        if($excel){
            $update = DB::table($table)->where('id',$id)->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Kill', $gameName . $issue . "杀率not Finshed");
            }else
                $this->stopBunko($gameId,1,'Kill');
        }else{
            $update = DB::table($table)->where('id',$id)->update([
                'bunko' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
            }else{
                $this->stopBunko($gameId,1);
                //玩法退水
                if(env('AGENT_MODEL',1) == 1) {
                    $res = DB::table($table)->where('id',$id)->where('returnwater',0)->update(['returnwater' => 2]);
                    if(!$res){
                        writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                        return 0;
                    }
                    //退水
                    $res = $this->reBackUser($gameId, $issue, $gameName);
                    if(!$res){
                        $res = DB::table($table)->where('id',$id)->where('returnwater',2)->update(['returnwater' => 1]);
                        if(empty($res)){
                            writeLog('New_Bet',$gameName.$issue.'退水中失败！');
                            return 0;
                        }
                    }else
                        writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                }else{//代理退水
                    $agentJob = new AgentBackwaterJob($gameId,$issue);
                    $agentJob->addQueue();
                }
            }
        }
    }
}