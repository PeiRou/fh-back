<?php
/**
 * Created by PhpStorm.
 * User: zoe
 * Date: 2019/2/23
 * Time: 13:28
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Twxyft extends Excel
{
    protected $arrPlay_id = array(8043465594,8043465595,8043465596,8043465597,8043465598,8043465599,8043465600,8043465601,8043465602,8043465603,8043465604,8043465605,8043465606,8043465607,8043465608,8043465609,8043465610,8043465611,8043465612,8043465613,8043465614,8043475615,8043475616,8043475617,8043475618,8043475619,8043475620,8043475621,8043475622,8043475623,8043475624,8043475625,8043475626,8043475627,8043475628,8043475629,8043475630,8043485631,8043485632,8043485633,8043485634,8043485635,8043485636,8043485637,8043485638,8043485639,8043485640,8043485641,8043485642,8043485643,8043485644,8043485645,8043485646,8043495647,8043495648,8043495649,8043495650,8043495651,8043495652,8043495653,8043495654,8043495655,8043495656,8043495657,8043495658,8043495659,8043495660,8043495661,8043495662,8043505663,8043505664,8043505665,8043505666,8043505667,8043505668,8043505669,8043505670,8043505671,8043505672,8043505673,8043505674,8043505675,8043505676,8043505677,8043505678,8043515679,8043515680,8043515681,8043515682,8043515683,8043515684,8043515685,8043515686,8043515687,8043515688,8043515689,8043515690,8043515691,8043515692,8043515693,8043515694,8043525695,8043525696,8043525697,8043525698,8043525699,8043525700,8043525701,8043525702,8043525703,8043525704,8043525705,8043525706,8043525707,8043525708,8043535709,8043535710,8043535711,8043535712,8043535713,8043535714,8043535715,8043535716,8043535717,8043535718,8043535719,8043535720,8043535721,8043535722,8043545723,8043545724,8043545725,8043545726,8043545727,8043545728,8043545729,8043545730,8043545731,8043545732,8043545733,8043545734,8043545735,8043545736,8043555737,8043555738,8043555739,8043555740,8043555741,8043555742,8043555743,8043555744,8043555745,8043555746,8043555747,8043555748,8043555749,8043555750,8043565751,8043565752,8043565753,8043565754,8043565755,8043565756,8043565757,8043565758,8043565759,8043565760,8043565761,8043565762,8043565763,8043565764);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>346,
        'GUANJUN' =>347,
        'YAJUN' =>348,
        'DISANMING' =>349,
        'DISIMING' =>350,
        'DIWUMING' =>351,
        'DILIUMING' =>352,
        'DIQIMING' =>353,
        'DIBAMING' =>354,
        'DIJIUMING' =>355,
        'DISHIMING' =>356,
    );
    protected $arrPlayId = array(
        'GUANYADA' => 5594,
        'GUANYAXIAO' => 5595,
        'GUANYADAN' => 5596,
        'GUANYASHUANG' => 5597,
        'GUANYAJUNHE3' => 5598,
        'GUANYAJUNHE4' => 5599,
        'GUANYAJUNHE5' => 5600,
        'GUANYAJUNHE6' => 5601,
        'GUANYAJUNHE7' => 5602,
        'GUANYAJUNHE8' => 5603,
        'GUANYAJUNHE9' => 5604,
        'GUANYAJUNHE10' => 5605,
        'GUANYAJUNHE11' => 5606,
        'GUANYAJUNHE12' => 5607,
        'GUANYAJUNHE13' => 5608,
        'GUANYAJUNHE14' => 5609,
        'GUANYAJUNHE15' => 5610,
        'GUANYAJUNHE16' => 5611,
        'GUANYAJUNHE17' => 5612,
        'GUANYAJUNHE18' => 5613,
        'GUANYAJUNHE19' => 5614,
        'LIANGMIANGUANJUNDA' => 5615,
        'LIANGMIANGUANJUNXIAO' => 5616,
        'LIANGMIANGUANJUNDAN' => 5617,
        'LIANGMIANGUANJUNSHUANG' => 5618,
        'LIANGMIANGUANJUNLONG' => 5619,
        'LIANGMIANGUANJUNHU' => 5620,
        'DANHAOGUANJUN1' => 5621,
        'DANHAOGUANJUN2' => 5622,
        'DANHAOGUANJUN3' => 5623,
        'DANHAOGUANJUN4' => 5624,
        'DANHAOGUANJUN5' => 5625,
        'DANHAOGUANJUN6' => 5626,
        'DANHAOGUANJUN7' => 5627,
        'DANHAOGUANJUN8' => 5628,
        'DANHAOGUANJUN9' => 5629,
        'DANHAOGUANJUN10' => 5630,
        'LIANGMIANYAJUNDA' => 5631,
        'LIANGMIANYAJUNXIAO' => 5632,
        'LIANGMIANYAJUNDAN' => 5633,
        'LIANGMIANYAJUNSHUANG' => 5634,
        'LIANGMIANYAJUNLONG' => 5635,
        'LIANGMIANYAJUNHU' => 5636,
        'DANHAOYAJUN1' => 5637,
        'DANHAOYAJUN2' => 5638,
        'DANHAOYAJUN3' => 5639,
        'DANHAOYAJUN4' => 5640,
        'DANHAOYAJUN5' => 5641,
        'DANHAOYAJUN6' => 5642,
        'DANHAOYAJUN7' => 5643,
        'DANHAOYAJUN8' => 5644,
        'DANHAOYAJUN9' => 5645,
        'DANHAOYAJUN10' => 5646,
        'LIANGMIANDISANMINGDA' => 5647,
        'LIANGMIANDISANMINGXIAO' => 5648,
        'LIANGMIANDISANMINGDAN' => 5649,
        'LIANGMIANDISANMINGSHUANG' => 5650,
        'LIANGMIANDISANMINGLONG' => 5651,
        'LIANGMIANDISANMINGHU' => 5652,
        'DANHAODISANMING1' => 5653,
        'DANHAODISANMING2' => 5654,
        'DANHAODISANMING3' => 5655,
        'DANHAODISANMING4' => 5656,
        'DANHAODISANMING5' => 5657,
        'DANHAODISANMING6' => 5658,
        'DANHAODISANMING7' => 5659,
        'DANHAODISANMING8' => 5660,
        'DANHAODISANMING9' => 5661,
        'DANHAODISANMING10' => 5662,
        'LIANGMIANDISIMINGDA' => 5663,
        'LIANGMIANDISIMINGXIAO' => 5664,
        'LIANGMIANDISIMINGDAN' => 5665,
        'LIANGMIANDISIMINGSHUANG' => 5666,
        'LIANGMIANDISIMINGLONG' => 5667,
        'LIANGMIANDISIMINGHU' => 5668,
        'DANHAODISIMING1' => 5669,
        'DANHAODISIMING2' => 5670,
        'DANHAODISIMING3' => 5671,
        'DANHAODISIMING4' => 5672,
        'DANHAODISIMING5' => 5673,
        'DANHAODISIMING6' => 5674,
        'DANHAODISIMING7' => 5675,
        'DANHAODISIMING8' => 5676,
        'DANHAODISIMING9' => 5677,
        'DANHAODISIMING10' => 5678,
        'LIANGMIANDIWUMINGDA' => 5679,
        'LIANGMIANDIWUMINGXIAO' => 5680,
        'LIANGMIANDIWUMINGDAN' => 5681,
        'LIANGMIANDIWUMINGSHUANG' => 5682,
        'LIANGMIANDIWUMINGLONG' => 5683,
        'LIANGMIANDIWUMINGHU' => 5684,
        'DANHAODIWUMING1' => 5685,
        'DANHAODIWUMING2' => 5686,
        'DANHAODIWUMING3' => 5687,
        'DANHAODIWUMING4' => 5688,
        'DANHAODIWUMING5' => 5689,
        'DANHAODIWUMING6' => 5690,
        'DANHAODIWUMING7' => 5691,
        'DANHAODIWUMING8' => 5692,
        'DANHAODIWUMING9' => 5693,
        'DANHAODIWUMING10' => 5694,
        'LIANGMIANDILIUMINGDA' => 5695,
        'LIANGMIANDILIUMINGXIAO' => 5696,
        'LIANGMIANDILIUMINGDAN' => 5697,
        'LIANGMIANDILIUMINGSHUANG' => 5698,
        'DANHAODILIUMING1' => 5699,
        'DANHAODILIUMING2' => 5700,
        'DANHAODILIUMING3' => 5701,
        'DANHAODILIUMING4' => 5702,
        'DANHAODILIUMING5' => 5703,
        'DANHAODILIUMING6' => 5704,
        'DANHAODILIUMING7' => 5705,
        'DANHAODILIUMING8' => 5706,
        'DANHAODILIUMING9' => 5707,
        'DANHAODILIUMING10' => 5708,
        'LIANGMIANDIQIMINGDA' => 5709,
        'LIANGMIANDIQIMINGXIAO' => 5710,
        'LIANGMIANDIQIMINGDAN' => 5711,
        'LIANGMIANDIQIMINGSHUANG' => 5712,
        'DANHAODIQIMING1' => 5713,
        'DANHAODIQIMING2' => 5714,
        'DANHAODIQIMING3' => 5715,
        'DANHAODIQIMING4' => 5716,
        'DANHAODIQIMING5' => 5717,
        'DANHAODIQIMING6' => 5718,
        'DANHAODIQIMING7' => 5719,
        'DANHAODIQIMING8' => 5720,
        'DANHAODIQIMING9' => 5721,
        'DANHAODIQIMING10' => 5722,
        'LIANGMIANDIBAMINGDA' => 5723,
        'LIANGMIANDIBAMINGXIAO' => 5724,
        'LIANGMIANDIBAMINGDAN' => 5725,
        'LIANGMIANDIBAMINGSHUANG' => 5726,
        'DANHAODIBAMING1' => 5727,
        'DANHAODIBAMING2' => 5728,
        'DANHAODIBAMING3' => 5729,
        'DANHAODIBAMING4' => 5730,
        'DANHAODIBAMING5' => 5731,
        'DANHAODIBAMING6' => 5732,
        'DANHAODIBAMING7' => 5733,
        'DANHAODIBAMING8' => 5734,
        'DANHAODIBAMING9' => 5735,
        'DANHAODIBAMING10' => 5736,
        'LIANGMIANDIJIUMINGDA' => 5737,
        'LIANGMIANDIJIUMINGXIAO' => 5738,
        'LIANGMIANDIJIUMINGDAN' => 5739,
        'LIANGMIANDIJIUMINGSHUANG' => 5740,
        'DANHAODIJIUMING1' => 5741,
        'DANHAODIJIUMING2' => 5742,
        'DANHAODIJIUMING3' => 5743,
        'DANHAODIJIUMING4' => 5744,
        'DANHAODIJIUMING5' => 5745,
        'DANHAODIJIUMING6' => 5746,
        'DANHAODIJIUMING7' => 5747,
        'DANHAODIJIUMING8' => 5748,
        'DANHAODIJIUMING9' => 5749,
        'DANHAODIJIUMING10' => 5750,
        'LIANGMIANDISHIMINGDA' => 5751,
        'LIANGMIANDISHIMINGXIAO' => 5752,
        'LIANGMIANDISHIMINGDAN' => 5753,
        'LIANGMIANDISHIMINGSHUANG' => 5754,
        'DANHAODISHIMING1' => 5755,
        'DANHAODISHIMING2' => 5756,
        'DANHAODISHIMING3' => 5757,
        'DANHAODISHIMING4' => 5758,
        'DANHAODISHIMING5' => 5759,
        'DANHAODISHIMING6' => 5760,
        'DANHAODISHIMING7' => 5761,
        'DANHAODISHIMING8' => 5762,
        'DANHAODISHIMING9' => 5763,
        'DANHAODISHIMING10' => 5764
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
        $table = 'game_twxyft';
        $gameName = '台湾幸运飞艇';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'twxyft killing...');
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
