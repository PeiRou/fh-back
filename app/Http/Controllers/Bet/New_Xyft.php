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

class New_Xyft extends Excel
{
    protected $arrPlay_id = array(55807552,55807553,55807554,55807555,55807556,55807557,55807558,55807559,55807560,55807561,55807562,55807563,55807564,55807565,55807566,55807567,55807568,55807569,55807570,55807571,55807572,55817573,55817574,55817575,55817576,55817577,55817578,55817579,55817580,55817581,55817582,55817583,55817584,55817585,55817586,55817587,55817588,55827589,55827590,55827591,55827592,55827593,55827594,55827595,55827596,55827597,55827598,55827599,55827600,55827601,55827602,55827603,55827604,55837605,55837606,55837607,55837608,55837609,55837610,55837611,55837612,55837613,55837614,55837615,55837616,55837617,55837618,55837619,55837620,55847621,55847622,55847623,55847624,55847625,55847626,55847627,55847628,55847629,55847630,55847631,55847632,55847633,55847634,55847635,55847636,55857637,55857638,55857639,55857640,55857641,55857642,55857643,55857644,55857645,55857646,55857647,55857648,55857649,55857650,55857651,55857652,55867653,55867654,55867655,55867656,55867657,55867658,55867659,55867660,55867661,55867662,55867663,55867664,55867665,55867666,55877667,55877668,55877669,55877670,55877671,55877672,55877673,55877674,55877675,55877676,55877677,55877678,55877679,55877680,55887681,55887682,55887683,55887684,55887685,55887686,55887687,55887688,55887689,55887690,55887691,55887692,55887693,55887694,55897695,55897696,55897697,55897698,55897699,55897700,55897701,55897702,55897703,55897704,55897705,55897706,55897707,55897708,55907709,55907710,55907711,55907712,55907713,55907714,55907715,55907716,55907717,55907718,55907719,55907720,55907721,55907722);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>80,
        'GUANJUN' =>81,
        'YAJUN' =>82,
        'DISANMING' =>83,
        'DISIMING' =>84,
        'DIWUMING' =>85,
        'DILIUMING' =>86,
        'DIQIMING' =>87,
        'DIBAMING' =>88,
        'DIJIUMING' =>89,
        'DISHIMING' =>90
    );
    protected $arrPlayId = array(
        'GUANYADA' => 7552,
        'GUANYAXIAO' => 7553,
        'GUANYADAN' => 7554,
        'GUANYASHUANG' => 7555,
        'GUANYAJUNHE3' => 7556,
        'GUANYAJUNHE4' => 7557,
        'GUANYAJUNHE5' => 7558,
        'GUANYAJUNHE6' => 7559,
        'GUANYAJUNHE7' => 7560,
        'GUANYAJUNHE8' => 7561,
        'GUANYAJUNHE9' => 7562,
        'GUANYAJUNHE10' => 7563,
        'GUANYAJUNHE11' => 7564,
        'GUANYAJUNHE12' => 7565,
        'GUANYAJUNHE13' => 7566,
        'GUANYAJUNHE14' => 7567,
        'GUANYAJUNHE15' => 7568,
        'GUANYAJUNHE16' => 7569,
        'GUANYAJUNHE17' => 7570,
        'GUANYAJUNHE18' => 7571,
        'GUANYAJUNHE19' => 7572,
        'LIANGMIANGUANJUNDA' => 7573,
        'LIANGMIANGUANJUNXIAO' => 7574,
        'LIANGMIANGUANJUNDAN' => 7575,
        'LIANGMIANGUANJUNSHUANG' => 7576,
        'LIANGMIANGUANJUNLONG' => 7577,
        'LIANGMIANGUANJUNHU' => 7578,
        'DANHAOGUANJUN1' => 7579,
        'DANHAOGUANJUN2' => 7580,
        'DANHAOGUANJUN3' => 7581,
        'DANHAOGUANJUN4' => 7582,
        'DANHAOGUANJUN5' => 7583,
        'DANHAOGUANJUN6' => 7584,
        'DANHAOGUANJUN7' => 7585,
        'DANHAOGUANJUN8' => 7586,
        'DANHAOGUANJUN9' => 7587,
        'DANHAOGUANJUN10' => 7588,
        'LIANGMIANYAJUNDA' => 7589,
        'LIANGMIANYAJUNXIAO' => 7590,
        'LIANGMIANYAJUNDAN' => 7591,
        'LIANGMIANYAJUNSHUANG' => 7592,
        'LIANGMIANYAJUNLONG' => 7593,
        'LIANGMIANYAJUNHU' => 7594,
        'DANHAOYAJUN1' => 7595,
        'DANHAOYAJUN2' => 7596,
        'DANHAOYAJUN3' => 7597,
        'DANHAOYAJUN4' => 7598,
        'DANHAOYAJUN5' => 7599,
        'DANHAOYAJUN6' => 7600,
        'DANHAOYAJUN7' => 7601,
        'DANHAOYAJUN8' => 7602,
        'DANHAOYAJUN9' => 7603,
        'DANHAOYAJUN10' => 7604,
        'LIANGMIANDISANMINGDA' => 7605,
        'LIANGMIANDISANMINGXIAO' => 7606,
        'LIANGMIANDISANMINGDAN' => 7607,
        'LIANGMIANDISANMINGSHUANG' => 7608,
        'LIANGMIANDISANMINGLONG' => 7609,
        'LIANGMIANDISANMINGHU' => 7610,
        'DANHAODISANMING1' => 7611,
        'DANHAODISANMING2' => 7612,
        'DANHAODISANMING3' => 7613,
        'DANHAODISANMING4' => 7614,
        'DANHAODISANMING5' => 7615,
        'DANHAODISANMING6' => 7616,
        'DANHAODISANMING7' => 7617,
        'DANHAODISANMING8' => 7618,
        'DANHAODISANMING9' => 7619,
        'DANHAODISANMING10' => 7620,
        'LIANGMIANDISIMINGDA' => 7621,
        'LIANGMIANDISIMINGXIAO' => 7622,
        'LIANGMIANDISIMINGDAN' => 7623,
        'LIANGMIANDISIMINGSHUANG' => 7624,
        'LIANGMIANDISIMINGLONG' => 7625,
        'LIANGMIANDISIMINGHU' => 7626,
        'DANHAODISIMING1' => 7627,
        'DANHAODISIMING2' => 7628,
        'DANHAODISIMING3' => 7629,
        'DANHAODISIMING4' => 7630,
        'DANHAODISIMING5' => 7631,
        'DANHAODISIMING6' => 7632,
        'DANHAODISIMING7' => 7633,
        'DANHAODISIMING8' => 7634,
        'DANHAODISIMING9' => 7635,
        'DANHAODISIMING10' => 7636,
        'LIANGMIANDIWUMINGDA' => 7637,
        'LIANGMIANDIWUMINGXIAO' => 7638,
        'LIANGMIANDIWUMINGDAN' => 7639,
        'LIANGMIANDIWUMINGSHUANG' => 7640,
        'LIANGMIANDIWUMINGLONG' => 7641,
        'LIANGMIANDIWUMINGHU' => 7642,
        'DANHAODIWUMING1' => 7643,
        'DANHAODIWUMING2' => 7644,
        'DANHAODIWUMING3' => 7645,
        'DANHAODIWUMING4' => 7646,
        'DANHAODIWUMING5' => 7647,
        'DANHAODIWUMING6' => 7648,
        'DANHAODIWUMING7' => 7649,
        'DANHAODIWUMING8' => 7650,
        'DANHAODIWUMING9' => 7651,
        'DANHAODIWUMING10' => 7652,
        'LIANGMIANDILIUMINGDA' => 7653,
        'LIANGMIANDILIUMINGXIAO' => 7654,
        'LIANGMIANDILIUMINGDAN' => 7655,
        'LIANGMIANDILIUMINGSHUANG' => 7656,
        'DANHAODILIUMING1' => 7657,
        'DANHAODILIUMING2' => 7658,
        'DANHAODILIUMING3' => 7659,
        'DANHAODILIUMING4' => 7660,
        'DANHAODILIUMING5' => 7661,
        'DANHAODILIUMING6' => 7662,
        'DANHAODILIUMING7' => 7663,
        'DANHAODILIUMING8' => 7664,
        'DANHAODILIUMING9' => 7665,
        'DANHAODILIUMING10' => 7666,
        'LIANGMIANDIQIMINGDA' => 7667,
        'LIANGMIANDIQIMINGXIAO' => 7668,
        'LIANGMIANDIQIMINGDAN' => 7669,
        'LIANGMIANDIQIMINGSHUANG' => 7670,
        'DANHAODIQIMING1' => 7671,
        'DANHAODIQIMING2' => 7672,
        'DANHAODIQIMING3' => 7673,
        'DANHAODIQIMING4' => 7674,
        'DANHAODIQIMING5' => 7675,
        'DANHAODIQIMING6' => 7676,
        'DANHAODIQIMING7' => 7677,
        'DANHAODIQIMING8' => 7678,
        'DANHAODIQIMING9' => 7679,
        'DANHAODIQIMING10' => 7680,
        'LIANGMIANDIBAMINGDA' => 7681,
        'LIANGMIANDIBAMINGXIAO' => 7682,
        'LIANGMIANDIBAMINGDAN' => 7683,
        'LIANGMIANDIBAMINGSHUANG' => 7684,
        'DANHAODIBAMING1' => 7685,
        'DANHAODIBAMING2' => 7686,
        'DANHAODIBAMING3' => 7687,
        'DANHAODIBAMING4' => 7688,
        'DANHAODIBAMING5' => 7689,
        'DANHAODIBAMING6' => 7690,
        'DANHAODIBAMING7' => 7691,
        'DANHAODIBAMING8' => 7692,
        'DANHAODIBAMING9' => 7693,
        'DANHAODIBAMING10' => 7694,
        'LIANGMIANDIJIUMINGDA' => 7695,
        'LIANGMIANDIJIUMINGXIAO' => 7696,
        'LIANGMIANDIJIUMINGDAN' => 7697,
        'LIANGMIANDIJIUMINGSHUANG' => 7698,
        'DANHAODIJIUMING1' => 7699,
        'DANHAODIJIUMING2' => 7700,
        'DANHAODIJIUMING3' => 7701,
        'DANHAODIJIUMING4' => 7702,
        'DANHAODIJIUMING5' => 7703,
        'DANHAODIJIUMING6' => 7704,
        'DANHAODIJIUMING7' => 7705,
        'DANHAODIJIUMING8' => 7706,
        'DANHAODIJIUMING9' => 7707,
        'DANHAODIJIUMING10' => 7708,
        'LIANGMIANDISHIMINGDA' => 7709,
        'LIANGMIANDISHIMINGXIAO' => 7710,
        'LIANGMIANDISHIMINGDAN' => 7711,
        'LIANGMIANDISHIMINGSHUANG' => 7712,
        'DANHAODISHIMING1' => 7713,
        'DANHAODISHIMING2' => 7714,
        'DANHAODISHIMING3' => 7715,
        'DANHAODISHIMING4' => 7716,
        'DANHAODISHIMING5' => 7717,
        'DANHAODISHIMING6' => 7718,
        'DANHAODISHIMING7' => 7719,
        'DANHAODISHIMING8' => 7720,
        'DANHAODISHIMING9' => 7721,
        'DANHAODISHIMING10' => 7722
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
        $table = 'game_xyft';
        $gameName = '幸运飞艇';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'xyft killing...');
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