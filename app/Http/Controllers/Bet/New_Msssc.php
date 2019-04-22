<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 下午11:57
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySSC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Msssc extends Excel
{
    protected $arrPlay_id = array(811232334,811232335,811232336,811232337,811232338,811232339,811232340,811242341,811242342,811242343,811242344,811242345,811242346,811242347,811242348,811242349,811242350,811242351,811242352,811242353,811242354,811252355,811252356,811252357,811252358,811252359,811252360,811252361,811252362,811252363,811252364,811252365,811252366,811252367,811252368,811262369,811262370,811262371,811262372,811262373,811262374,811262375,811262376,811262377,811262378,811262379,811262380,811262381,811262382,811272383,811272384,811272385,811272386,811272387,811272388,811272389,811272390,811272391,811272392,811272393,811272394,811272395,811272396,811282397,811282398,811282399,811282400,811282401,811282402,811282403,811282404,811282405,811282406,811282407,811282408,811282409,811282410,811292411,811292412,811292413,811292414,811292415,811302416,811302417,811302418,811302419,811302420,811312421,811312422,811312423,811312424,811312425);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' =>123,
        'DIYIQIU' =>124,
        'DIERQIU' =>125,
        'DISANQIU' =>126,
        'DISIQIU' =>127,
        'DIWUQIU' =>128,
        'QIANSAN' =>129,
        'ZHONGSAN' =>130,
        'HOUSAN' =>131
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 2334,
        'ZONGHEXIAO' => 2335,
        'ZONGHEDAN' => 2336,
        'ZONGHESHUANG' => 2337,
        'LONG' => 2338,
        'HU' => 2339,
        'HE' => 2340,
        'DIYIQIU0' => 2341,
        'DIYIQIU1' => 2342,
        'DIYIQIU2' => 2343,
        'DIYIQIU3' => 2344,
        'DIYIQIU4' => 2345,
        'DIYIQIU5' => 2346,
        'DIYIQIU6' => 2347,
        'DIYIQIU7' => 2348,
        'DIYIQIU8' => 2349,
        'DIYIQIU9' => 2350,
        'DIYIQIUDA' => 2351,
        'DIYIQIUXIAO' => 2352,
        'DIYIQIUDAN' => 2353,
        'DIYIQIUSHUANG' => 2354,
        'DIERQIU0' => 2355,
        'DIERQIU1' => 2356,
        'DIERQIU2' => 2357,
        'DIERQIU3' => 2358,
        'DIERQIU4' => 2359,
        'DIERQIU5' => 2360,
        'DIERQIU6' => 2361,
        'DIERQIU7' => 2362,
        'DIERQIU8' => 2363,
        'DIERQIU9' => 2364,
        'DIERQIUDA' => 2365,
        'DIERQIUXIAO' => 2366,
        'DIERQIUDAN' => 2367,
        'DIERQIUSHUANG' => 2368,
        'DISANQIU0' => 2369,
        'DISANQIU1' => 2370,
        'DISANQIU2' => 2371,
        'DISANQIU3' => 2372,
        'DISANQIU4' => 2373,
        'DISANQIU5' => 2374,
        'DISANQIU6' => 2375,
        'DISANQIU7' => 2376,
        'DISANQIU8' => 2377,
        'DISANQIU9' => 2378,
        'DISANQIUDA' => 2379,
        'DISANQIUXIAO' => 2380,
        'DISANQIUDAN' => 2381,
        'DISANQIUSHUANG' => 2382,
        'DISIQIU0' => 2383,
        'DISIQIU1' => 2384,
        'DISIQIU2' => 2385,
        'DISIQIU3' => 2386,
        'DISIQIU4' => 2387,
        'DISIQIU5' => 2388,
        'DISIQIU6' => 2389,
        'DISIQIU7' => 2390,
        'DISIQIU8' => 2391,
        'DISIQIU9' => 2392,
        'DISIQIUDA' => 2393,
        'DISIQIUXIAO' => 2394,
        'DISIQIUDAN' => 2395,
        'DISIQIUSHUANG' => 2396,
        'DIWUQIU0' => 2397,
        'DIWUQIU1' => 2398,
        'DIWUQIU2' => 2399,
        'DIWUQIU3' => 2400,
        'DIWUQIU4' => 2401,
        'DIWUQIU5' => 2402,
        'DIWUQIU6' => 2403,
        'DIWUQIU7' => 2404,
        'DIWUQIU8' => 2405,
        'DIWUQIU9' => 2406,
        'DIWUQIUDA' => 2407,
        'DIWUQIUXIAO' => 2408,
        'DIWUQIUDAN' => 2409,
        'DIWUQIUSHUANG' => 2410,
        'QIANSANBAOZI' => 2411,
        'QIANSANSHUNZI' => 2412,
        'QIANSANDUIZI' => 2413,
        'QIANSANBANSHUN' => 2414,
        'QIANSANZALIU' => 2415,
        'ZHONGSANBAOZI' => 2416,
        'ZHONGSANSHUNZI' => 2417,
        'ZHONGSANDUIZI' => 2418,
        'ZHONGSANBANSHUN' => 2419,
        'ZHONGSANZALIU' => 2420,
        'HOUSANBAOZI' => 2421,
        'HOUSANSHUNZI' => 2422,
        'HOUSANDUIZI' => 2423,
        'HOUSANBANSHUN' => 2424,
        'HOUSANZALIU' => 2425,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $SSC = new ExcelLotterySSC();
        $SSC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $SSC->NUM1($gameId,$win);
        $SSC->NUM2($gameId,$win);
        $SSC->NUM3($gameId,$win);
        $SSC->NUM4($gameId,$win);
        $SSC->NUM5($gameId,$win);
        $SSC->NUM1_DXDS($gameId,$win);
        $SSC->NUM2_DXDS($gameId,$win);
        $SSC->NUM3_DXDS($gameId,$win);
        $SSC->NUM4_DXDS($gameId,$win);
        $SSC->NUM5_DXDS($gameId,$win);
        $SSC->ZHDXDS($gameId,$win);
        $SSC->QIANSAN($gameId,$win);
        $SSC->ZHONGSAN($gameId,$win);
        $SSC->HOUSAN($gameId,$win);
        return $win; 
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_msssc';
        $gameName = '秒速时时彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'msssc killing...');
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
                        \Log::info($gameName.$issue.'退水前失败！');
                        return 0;
                    }
                    //退水
                    $res = $this->reBackUser($gameId, $issue, $gameName);
                    if(!$res){
                        $res = DB::table($table)->where('id',$id)->where('returnwater',2)->update(['returnwater' => 1]);
                        if(empty($res)){
                            \Log::info($gameName.$issue.'退水中失败！');
                            return 0;
                        }
                    }else
                        \Log::info($gameName.$issue.'退水前失败！');
                }else{//代理退水
                    $agentJob = new AgentBackwaterJob($gameId,$issue);
                    $agentJob->addQueue();
                }
            }
        }
    }
}