<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 2019/3/14
 * Time: 上午2:01
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Sfsc extends Excel
{
    protected $arrPlay_id = array(9013575765,9013575766,9013575767,9013575768,9013575769,9013575770,9013575771,9013575772,9013575773,9013575774,9013575775,9013575776,9013575777,9013575778,9013575779,9013575780,9013575781,9013575782,9013575783,9013575784,9013575785,9013585786,9013585787,9013585788,9013585789,9013585790,9013585791,9013585792,9013585793,9013585794,9013585795,9013585796,9013585797,9013585798,9013585799,9013585800,9013585801,9013595802,9013595803,9013595804,9013595805,9013595806,9013595807,9013595808,9013595809,9013595810,9013595811,9013595812,9013595813,9013595814,9013595815,9013595816,9013595817,9013605818,9013605819,9013605820,9013605821,9013605822,9013605823,9013605824,9013605825,9013605826,9013605827,9013605828,9013605829,9013605830,9013605831,9013605832,9013605833,9013615834,9013615835,9013615836,9013615837,9013615838,9013615839,9013615840,9013615841,9013615842,9013615843,9013615844,9013615845,9013615846,9013615847,9013615848,9013615849,9013625850,9013625851,9013625852,9013625853,9013625854,9013625855,9013625856,9013625857,9013625858,9013625859,9013625860,9013625861,9013625862,9013625863,9013625864,9013625865,9013635866,9013635867,9013635868,9013635869,9013635870,9013635871,9013635872,9013635873,9013635874,9013635875,9013635876,9013635877,9013635878,9013635879,9013645880,9013645881,9013645882,9013645883,9013645884,9013645885,9013645886,9013645887,9013645888,9013645889,9013645890,9013645891,9013645892,9013645893,9013655894,9013655895,9013655896,9013655897,9013655898,9013655899,9013655900,9013655901,9013655902,9013655903,9013655904,9013655905,9013655906,9013655907,9013665908,9013665909,9013665910,9013665911,9013665912,9013665913,9013665914,9013665915,9013665916,9013665917,9013665918,9013665919,9013665920,9013665921,9013675922,9013675923,9013675924,9013675925,9013675926,9013675927,9013675928,9013675929,9013675930,9013675931,9013675932,9013675933,9013675934,9013675935);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>357,
        'GUANJUN' =>358,
        'YAJUN' =>359,
        'DISANMING' =>360,
        'DISIMING' =>361,
        'DIWUMING' =>362,
        'DILIUMING' =>363,
        'DIQIMING' =>364,
        'DIBAMING' =>365,
        'DIJIUMING' =>366,
        'DISHIMING' =>367,
    );
    protected $arrPlayId = array(
        'GUANYADA' => 5765,
        'GUANYAXIAO' => 5766,
        'GUANYADAN' => 5767,
        'GUANYASHUANG' => 5768,
        'GUANYAJUNHE3' => 5769,
        'GUANYAJUNHE4' => 5770,
        'GUANYAJUNHE5' => 5771,
        'GUANYAJUNHE6' => 5772,
        'GUANYAJUNHE7' => 5773,
        'GUANYAJUNHE8' => 5774,
        'GUANYAJUNHE9' => 5775,
        'GUANYAJUNHE10' => 5776,
        'GUANYAJUNHE11' => 5777,
        'GUANYAJUNHE12' => 5778,
        'GUANYAJUNHE13' => 5779,
        'GUANYAJUNHE14' => 5780,
        'GUANYAJUNHE15' => 5781,
        'GUANYAJUNHE16' => 5782,
        'GUANYAJUNHE17' => 5783,
        'GUANYAJUNHE18' => 5784,
        'GUANYAJUNHE19' => 5785,
        'LIANGMIANGUANJUNDA' => 5786,
        'LIANGMIANGUANJUNXIAO' => 5787,
        'LIANGMIANGUANJUNDAN' => 5788,
        'LIANGMIANGUANJUNSHUANG' => 5789,
        'LIANGMIANGUANJUNLONG' => 5790,
        'LIANGMIANGUANJUNHU' => 5791,
        'DANHAOGUANJUN1' => 5792,
        'DANHAOGUANJUN2' => 5793,
        'DANHAOGUANJUN3' => 5794,
        'DANHAOGUANJUN4' => 5795,
        'DANHAOGUANJUN5' => 5796,
        'DANHAOGUANJUN6' => 5797,
        'DANHAOGUANJUN7' => 5798,
        'DANHAOGUANJUN8' => 5799,
        'DANHAOGUANJUN9' => 5800,
        'DANHAOGUANJUN10' => 5801,
        'LIANGMIANYAJUNDA' => 5802,
        'LIANGMIANYAJUNXIAO' => 5803,
        'LIANGMIANYAJUNDAN' => 5804,
        'LIANGMIANYAJUNSHUANG' => 5805,
        'LIANGMIANYAJUNLONG' => 5806,
        'LIANGMIANYAJUNHU' => 5807,
        'DANHAOYAJUN1' => 5808,
        'DANHAOYAJUN2' => 5809,
        'DANHAOYAJUN3' => 5810,
        'DANHAOYAJUN4' => 5811,
        'DANHAOYAJUN5' => 5812,
        'DANHAOYAJUN6' => 5813,
        'DANHAOYAJUN7' => 5814,
        'DANHAOYAJUN8' => 5815,
        'DANHAOYAJUN9' => 5816,
        'DANHAOYAJUN10' => 5817,
        'LIANGMIANDISANMINGDA' => 5818,
        'LIANGMIANDISANMINGXIAO' => 5819,
        'LIANGMIANDISANMINGDAN' => 5820,
        'LIANGMIANDISANMINGSHUANG' => 5821,
        'LIANGMIANDISANMINGLONG' => 5822,
        'LIANGMIANDISANMINGHU' => 5823,
        'DANHAODISANMING1' => 5824,
        'DANHAODISANMING2' => 5825,
        'DANHAODISANMING3' => 5826,
        'DANHAODISANMING4' => 5827,
        'DANHAODISANMING5' => 5828,
        'DANHAODISANMING6' => 5829,
        'DANHAODISANMING7' => 5830,
        'DANHAODISANMING8' => 5831,
        'DANHAODISANMING9' => 5832,
        'DANHAODISANMING10' => 5833,
        'LIANGMIANDISIMINGDA' => 5834,
        'LIANGMIANDISIMINGXIAO' => 5835,
        'LIANGMIANDISIMINGDAN' => 5836,
        'LIANGMIANDISIMINGSHUANG' => 5837,
        'LIANGMIANDISIMINGLONG' => 5838,
        'LIANGMIANDISIMINGHU' => 5839,
        'DANHAODISIMING1' => 5840,
        'DANHAODISIMING2' => 5841,
        'DANHAODISIMING3' => 5842,
        'DANHAODISIMING4' => 5843,
        'DANHAODISIMING5' => 5844,
        'DANHAODISIMING6' => 5845,
        'DANHAODISIMING7' => 5846,
        'DANHAODISIMING8' => 5847,
        'DANHAODISIMING9' => 5848,
        'DANHAODISIMING10' => 5849,
        'LIANGMIANDIWUMINGDA' => 5850,
        'LIANGMIANDIWUMINGXIAO' => 5851,
        'LIANGMIANDIWUMINGDAN' => 5852,
        'LIANGMIANDIWUMINGSHUANG' => 5853,
        'LIANGMIANDIWUMINGLONG' => 5854,
        'LIANGMIANDIWUMINGHU' => 5855,
        'DANHAODIWUMING1' => 5856,
        'DANHAODIWUMING2' => 5857,
        'DANHAODIWUMING3' => 5858,
        'DANHAODIWUMING4' => 5859,
        'DANHAODIWUMING5' => 5860,
        'DANHAODIWUMING6' => 5861,
        'DANHAODIWUMING7' => 5862,
        'DANHAODIWUMING8' => 5863,
        'DANHAODIWUMING9' => 5864,
        'DANHAODIWUMING10' => 5865,
        'LIANGMIANDILIUMINGDA' => 5866,
        'LIANGMIANDILIUMINGXIAO' => 5867,
        'LIANGMIANDILIUMINGDAN' => 5868,
        'LIANGMIANDILIUMINGSHUANG' => 5869,
        'DANHAODILIUMING1' => 5870,
        'DANHAODILIUMING2' => 5871,
        'DANHAODILIUMING3' => 5872,
        'DANHAODILIUMING4' => 5873,
        'DANHAODILIUMING5' => 5874,
        'DANHAODILIUMING6' => 5875,
        'DANHAODILIUMING7' => 5876,
        'DANHAODILIUMING8' => 5877,
        'DANHAODILIUMING9' => 5878,
        'DANHAODILIUMING10' => 5879,
        'LIANGMIANDIQIMINGDA' => 5880,
        'LIANGMIANDIQIMINGXIAO' => 5881,
        'LIANGMIANDIQIMINGDAN' => 5882,
        'LIANGMIANDIQIMINGSHUANG' => 5883,
        'DANHAODIQIMING1' => 5884,
        'DANHAODIQIMING2' => 5885,
        'DANHAODIQIMING3' => 5886,
        'DANHAODIQIMING4' => 5887,
        'DANHAODIQIMING5' => 5888,
        'DANHAODIQIMING6' => 5889,
        'DANHAODIQIMING7' => 5890,
        'DANHAODIQIMING8' => 5891,
        'DANHAODIQIMING9' => 5892,
        'DANHAODIQIMING10' => 5893,
        'LIANGMIANDIBAMINGDA' => 5894,
        'LIANGMIANDIBAMINGXIAO' => 5895,
        'LIANGMIANDIBAMINGDAN' => 5896,
        'LIANGMIANDIBAMINGSHUANG' => 5897,
        'DANHAODIBAMING1' => 5898,
        'DANHAODIBAMING2' => 5899,
        'DANHAODIBAMING3' => 5900,
        'DANHAODIBAMING4' => 5901,
        'DANHAODIBAMING5' => 5902,
        'DANHAODIBAMING6' => 5903,
        'DANHAODIBAMING7' => 5904,
        'DANHAODIBAMING8' => 5905,
        'DANHAODIBAMING9' => 5906,
        'DANHAODIBAMING10' => 5907,
        'LIANGMIANDIJIUMINGDA' => 5908,
        'LIANGMIANDIJIUMINGXIAO' => 5909,
        'LIANGMIANDIJIUMINGDAN' => 5910,
        'LIANGMIANDIJIUMINGSHUANG' => 5911,
        'DANHAODIJIUMING1' => 5912,
        'DANHAODIJIUMING2' => 5913,
        'DANHAODIJIUMING3' => 5914,
        'DANHAODIJIUMING4' => 5915,
        'DANHAODIJIUMING5' => 5916,
        'DANHAODIJIUMING6' => 5917,
        'DANHAODIJIUMING7' => 5918,
        'DANHAODIJIUMING8' => 5919,
        'DANHAODIJIUMING9' => 5920,
        'DANHAODIJIUMING10' => 5921,
        'LIANGMIANDISHIMINGDA' => 5922,
        'LIANGMIANDISHIMINGXIAO' => 5923,
        'LIANGMIANDISHIMINGDAN' => 5924,
        'LIANGMIANDISHIMINGSHUANG' => 5925,
        'DANHAODISHIMING1' => 5926,
        'DANHAODISHIMING2' => 5927,
        'DANHAODISHIMING3' => 5928,
        'DANHAODISHIMING4' => 5929,
        'DANHAODISHIMING5' => 5930,
        'DANHAODISHIMING6' => 5931,
        'DANHAODISHIMING7' => 5932,
        'DANHAODISHIMING8' => 5933,
        'DANHAODISHIMING9' => 5934,
        'DANHAODISHIMING10' => 5935
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
        $table = 'game_sfsc';
        $gameName = '三分赛车';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'sfsc killing...');
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
                            \Log::info($gameName.$issue.'退水中失败！');
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