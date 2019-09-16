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

class New_Wfsc extends Excel
{
    protected $arrPlay_id = array(91455313052,91455313053,91455313054,91455313055,91455313056,91455313057,91455313058,91455313059,91455313060,91455313061,91455313062,91455313063,91455313064,91455313065,91455313066,91455313067,91455313068,91455313069,91455313070,91455313071,91455313072,91455413073,91455413074,91455413075,91455413076,91455413077,91455413078,91455413079,91455413080,91455413081,91455413082,91455413083,91455413084,91455413085,91455413086,91455413087,91455413088,91455513089,91455513090,91455513091,91455513092,91455513093,91455513094,91455513095,91455513096,91455513097,91455513098,91455513099,91455513100,91455513101,91455513102,91455513103,91455513104,91455613105,91455613106,91455613107,91455613108,91455613109,91455613110,91455613111,91455613112,91455613113,91455613114,91455613115,91455613116,91455613117,91455613118,91455613119,91455613120,91455713121,91455713122,91455713123,91455713124,91455713125,91455713126,91455713127,91455713128,91455713129,91455713130,91455713131,91455713132,91455713133,91455713134,91455713135,91455713136,91455813137,91455813138,91455813139,91455813140,91455813141,91455813142,91455813143,91455813144,91455813145,91455813146,91455813147,91455813148,91455813149,91455813150,91455813151,91455813152,91455913153,91455913154,91455913155,91455913156,91455913157,91455913158,91455913159,91455913160,91455913161,91455913162,91455913163,91455913164,91455913165,91455913166,91456013167,91456013168,91456013169,91456013170,91456013171,91456013172,91456013173,91456013174,91456013175,91456013176,91456013177,91456013178,91456013179,91456013180,91456113181,91456113182,91456113183,91456113184,91456113185,91456113186,91456113187,91456113188,91456113189,91456113190,91456113191,91456113192,91456113193,91456113194,91456213195,91456213196,91456213197,91456213198,91456213199,91456213200,91456213201,91456213202,91456213203,91456213204,91456213205,91456213206,91456213207,91456213208,91456313209,91456313210,91456313211,91456313212,91456313213,91456313214,91456313215,91456313216,91456313217,91456313218,91456313219,91456313220,91456313221,91456313222);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' => 553,
        'GUANJUN' => 554,
        'YAJUN' => 555,
        'DISANMING' => 556,
        'DISIMING' => 557,
        'DIWUMING' => 558,
        'DILIUMING' => 559,
        'DIQIMING' => 560,
        'DIBAMING' => 561,
        'DIJIUMING' => 562,
        'DISHIMING' => 563
    );
    protected $arrPlayId = array(
        'GUANYADA' => 13052,
        'GUANYAXIAO' => 13053,
        'GUANYADAN' => 13054,
        'GUANYASHUANG' => 13055,
        'GUANYAJUNHE3' => 13056,
        'GUANYAJUNHE4' => 13057,
        'GUANYAJUNHE5' => 13058,
        'GUANYAJUNHE6' => 13059,
        'GUANYAJUNHE7' => 13060,
        'GUANYAJUNHE8' => 13061,
        'GUANYAJUNHE9' => 13062,
        'GUANYAJUNHE10' => 13063,
        'GUANYAJUNHE11' => 13064,
        'GUANYAJUNHE12' => 13065,
        'GUANYAJUNHE13' => 13066,
        'GUANYAJUNHE14' => 13067,
        'GUANYAJUNHE15' => 13068,
        'GUANYAJUNHE16' => 13069,
        'GUANYAJUNHE17' => 13070,
        'GUANYAJUNHE18' => 13071,
        'GUANYAJUNHE19' => 13072,
        'LIANGMIANGUANJUNDA' => 13073,
        'LIANGMIANGUANJUNXIAO' => 13074,
        'LIANGMIANGUANJUNDAN' => 13075,
        'LIANGMIANGUANJUNSHUANG' => 13076,
        'LIANGMIANGUANJUNLONG' => 13077,
        'LIANGMIANGUANJUNHU' => 13078,
        'DANHAOGUANJUN1' => 13079,
        'DANHAOGUANJUN2' => 13080,
        'DANHAOGUANJUN3' => 13081,
        'DANHAOGUANJUN4' => 13082,
        'DANHAOGUANJUN5' => 13083,
        'DANHAOGUANJUN6' => 13084,
        'DANHAOGUANJUN7' => 13085,
        'DANHAOGUANJUN8' => 13086,
        'DANHAOGUANJUN9' => 13087,
        'DANHAOGUANJUN10' => 13088,
        'LIANGMIANYAJUNDA' => 13089,
        'LIANGMIANYAJUNXIAO' => 13090,
        'LIANGMIANYAJUNDAN' => 13091,
        'LIANGMIANYAJUNSHUANG' => 13092,
        'LIANGMIANYAJUNLONG' => 13093,
        'LIANGMIANYAJUNHU' => 13094,
        'DANHAOYAJUN1' => 13095,
        'DANHAOYAJUN2' => 13096,
        'DANHAOYAJUN3' => 13097,
        'DANHAOYAJUN4' => 13098,
        'DANHAOYAJUN5' => 13099,
        'DANHAOYAJUN6' => 13100,
        'DANHAOYAJUN7' => 13101,
        'DANHAOYAJUN8' => 13102,
        'DANHAOYAJUN9' => 13103,
        'DANHAOYAJUN10' => 13104,
        'LIANGMIANDISANMINGDA' => 13105,
        'LIANGMIANDISANMINGXIAO' => 13106,
        'LIANGMIANDISANMINGDAN' => 13107,
        'LIANGMIANDISANMINGSHUANG' => 13108,
        'LIANGMIANDISANMINGLONG' => 13109,
        'LIANGMIANDISANMINGHU' => 13110,
        'DANHAODISANMING1' => 13111,
        'DANHAODISANMING2' => 13112,
        'DANHAODISANMING3' => 13113,
        'DANHAODISANMING4' => 13114,
        'DANHAODISANMING5' => 13115,
        'DANHAODISANMING6' => 13116,
        'DANHAODISANMING7' => 13117,
        'DANHAODISANMING8' => 13118,
        'DANHAODISANMING9' => 13119,
        'DANHAODISANMING10' => 13120,
        'LIANGMIANDISIMINGDA' => 13121,
        'LIANGMIANDISIMINGXIAO' => 13122,
        'LIANGMIANDISIMINGDAN' => 13123,
        'LIANGMIANDISIMINGSHUANG' => 13124,
        'LIANGMIANDISIMINGLONG' => 13125,
        'LIANGMIANDISIMINGHU' => 13126,
        'DANHAODISIMING1' => 13127,
        'DANHAODISIMING2' => 13128,
        'DANHAODISIMING3' => 13129,
        'DANHAODISIMING4' => 13130,
        'DANHAODISIMING5' => 13131,
        'DANHAODISIMING6' => 13132,
        'DANHAODISIMING7' => 13133,
        'DANHAODISIMING8' => 13134,
        'DANHAODISIMING9' => 13135,
        'DANHAODISIMING10' => 13136,
        'LIANGMIANDIWUMINGDA' => 13137,
        'LIANGMIANDIWUMINGXIAO' => 13138,
        'LIANGMIANDIWUMINGDAN' => 13139,
        'LIANGMIANDIWUMINGSHUANG' => 13140,
        'LIANGMIANDIWUMINGLONG' => 13141,
        'LIANGMIANDIWUMINGHU' => 13142,
        'DANHAODIWUMING1' => 13143,
        'DANHAODIWUMING2' => 13144,
        'DANHAODIWUMING3' => 13145,
        'DANHAODIWUMING4' => 13146,
        'DANHAODIWUMING5' => 13147,
        'DANHAODIWUMING6' => 13148,
        'DANHAODIWUMING7' => 13149,
        'DANHAODIWUMING8' => 13150,
        'DANHAODIWUMING9' => 13151,
        'DANHAODIWUMING10' => 13152,
        'LIANGMIANDILIUMINGDA' => 13153,
        'LIANGMIANDILIUMINGXIAO' => 13154,
        'LIANGMIANDILIUMINGDAN' => 13155,
        'LIANGMIANDILIUMINGSHUANG' => 13156,
        'DANHAODILIUMING1' => 13157,
        'DANHAODILIUMING2' => 13158,
        'DANHAODILIUMING3' => 13159,
        'DANHAODILIUMING4' => 13160,
        'DANHAODILIUMING5' => 13161,
        'DANHAODILIUMING6' => 13162,
        'DANHAODILIUMING7' => 13163,
        'DANHAODILIUMING8' => 13164,
        'DANHAODILIUMING9' => 13165,
        'DANHAODILIUMING10' => 13166,
        'LIANGMIANDIQIMINGDA' => 13167,
        'LIANGMIANDIQIMINGXIAO' => 13168,
        'LIANGMIANDIQIMINGDAN' => 13169,
        'LIANGMIANDIQIMINGSHUANG' => 13170,
        'DANHAODIQIMING1' => 13171,
        'DANHAODIQIMING2' => 13172,
        'DANHAODIQIMING3' => 13173,
        'DANHAODIQIMING4' => 13174,
        'DANHAODIQIMING5' => 13175,
        'DANHAODIQIMING6' => 13176,
        'DANHAODIQIMING7' => 13177,
        'DANHAODIQIMING8' => 13178,
        'DANHAODIQIMING9' => 13179,
        'DANHAODIQIMING10' => 13180,
        'LIANGMIANDIBAMINGDA' => 13181,
        'LIANGMIANDIBAMINGXIAO' => 13182,
        'LIANGMIANDIBAMINGDAN' => 13183,
        'LIANGMIANDIBAMINGSHUANG' => 13184,
        'DANHAODIBAMING1' => 13185,
        'DANHAODIBAMING2' => 13186,
        'DANHAODIBAMING3' => 13187,
        'DANHAODIBAMING4' => 13188,
        'DANHAODIBAMING5' => 13189,
        'DANHAODIBAMING6' => 13190,
        'DANHAODIBAMING7' => 13191,
        'DANHAODIBAMING8' => 13192,
        'DANHAODIBAMING9' => 13193,
        'DANHAODIBAMING10' => 13194,
        'LIANGMIANDIJIUMINGDA' => 13195,
        'LIANGMIANDIJIUMINGXIAO' => 13196,
        'LIANGMIANDIJIUMINGDAN' => 13197,
        'LIANGMIANDIJIUMINGSHUANG' => 13198,
        'DANHAODIJIUMING1' => 13199,
        'DANHAODIJIUMING2' => 13200,
        'DANHAODIJIUMING3' => 13201,
        'DANHAODIJIUMING4' => 13202,
        'DANHAODIJIUMING5' => 13203,
        'DANHAODIJIUMING6' => 13204,
        'DANHAODIJIUMING7' => 13205,
        'DANHAODIJIUMING8' => 13206,
        'DANHAODIJIUMING9' => 13207,
        'DANHAODIJIUMING10' => 13208,
        'LIANGMIANDISHIMINGDA' => 13209,
        'LIANGMIANDISHIMINGXIAO' => 13210,
        'LIANGMIANDISHIMINGDAN' => 13211,
        'LIANGMIANDISHIMINGSHUANG' => 13212,
        'DANHAODISHIMING1' => 13213,
        'DANHAODISHIMING2' => 13214,
        'DANHAODISHIMING3' => 13215,
        'DANHAODISHIMING4' => 13216,
        'DANHAODISHIMING5' => 13217,
        'DANHAODISHIMING6' => 13218,
        'DANHAODISHIMING7' => 13219,
        'DANHAODISHIMING8' => 13220,
        'DANHAODISHIMING9' => 13221,
        'DANHAODISHIMING10' => 13222
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
        $table = 'game_wfsc';
        $gameName = '五分赛车';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'wfsc killing...');
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