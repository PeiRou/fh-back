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

class New_Efsc extends Excel
{
    protected $arrPlay_id = array(91151712027,91151712028,91151712029,91151712030,91151712031,91151712032,91151712033,91151712034,91151712035,91151712036,91151712037,91151712038,91151712039,91151712040,91151712041,91151712042,91151712043,91151712044,91151712045,91151712046,91151712047,91151812048,91151812049,91151812050,91151812051,91151812052,91151812053,91151812054,91151812055,91151812056,91151812057,91151812058,91151812059,91151812060,91151812061,91151812062,91151812063,91151912064,91151912065,91151912066,91151912067,91151912068,91151912069,91151912070,91151912071,91151912072,91151912073,91151912074,91151912075,91151912076,91151912077,91151912078,91151912079,91152012080,91152012081,91152012082,91152012083,91152012084,91152012085,91152012086,91152012087,91152012088,91152012089,91152012090,91152012091,91152012092,91152012093,91152012094,91152012095,91152112096,91152112097,91152112098,91152112099,91152112100,91152112101,91152112102,91152112103,91152112104,91152112105,91152112106,91152112107,91152112108,91152112109,91152112110,91152112111,91152212112,91152212113,91152212114,91152212115,91152212116,91152212117,91152212118,91152212119,91152212120,91152212121,91152212122,91152212123,91152212124,91152212125,91152212126,91152212127,91152312128,91152312129,91152312130,91152312131,91152312132,91152312133,91152312134,91152312135,91152312136,91152312137,91152312138,91152312139,91152312140,91152312141,91152412142,91152412143,91152412144,91152412145,91152412146,91152412147,91152412148,91152412149,91152412150,91152412151,91152412152,91152412153,91152412154,91152412155,91152512156,91152512157,91152512158,91152512159,91152512160,91152512161,91152512162,91152512163,91152512164,91152512165,91152512166,91152512167,91152512168,91152512169,91152612170,91152612171,91152612172,91152612173,91152612174,91152612175,91152612176,91152612177,91152612178,91152612179,91152612180,91152612181,91152612182,91152612183,91152712184,91152712185,91152712186,91152712187,91152712188,91152712189,91152712190,91152712191,91152712192,91152712193,91152712194,91152712195,91152712196,91152712197);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' => 517,
        'GUANJUN' => 518,
        'YAJUN' => 519,
        'DISANMING' => 520,
        'DISIMING' => 521,
        'DIWUMING' => 522,
        'DILIUMING' => 523,
        'DIQIMING' => 524,
        'DIBAMING' => 525,
        'DIJIUMING' => 526,
        'DISHIMING' => 527
    );
    protected $arrPlayId = array(
        'GUANYADA' => 12027,
        'GUANYAXIAO' => 12028,
        'GUANYADAN' => 12029,
        'GUANYASHUANG' => 12030,
        'GUANYAJUNHE3' => 12031,
        'GUANYAJUNHE4' => 12032,
        'GUANYAJUNHE5' => 12033,
        'GUANYAJUNHE6' => 12034,
        'GUANYAJUNHE7' => 12035,
        'GUANYAJUNHE8' => 12036,
        'GUANYAJUNHE9' => 12037,
        'GUANYAJUNHE10' => 12038,
        'GUANYAJUNHE11' => 12039,
        'GUANYAJUNHE12' => 12040,
        'GUANYAJUNHE13' => 12041,
        'GUANYAJUNHE14' => 12042,
        'GUANYAJUNHE15' => 12043,
        'GUANYAJUNHE16' => 12044,
        'GUANYAJUNHE17' => 12045,
        'GUANYAJUNHE18' => 12046,
        'GUANYAJUNHE19' => 12047,
        'LIANGMIANGUANJUNDA' => 12048,
        'LIANGMIANGUANJUNXIAO' => 12049,
        'LIANGMIANGUANJUNDAN' => 12050,
        'LIANGMIANGUANJUNSHUANG' => 12051,
        'LIANGMIANGUANJUNLONG' => 12052,
        'LIANGMIANGUANJUNHU' => 12053,
        'DANHAOGUANJUN1' => 12054,
        'DANHAOGUANJUN2' => 12055,
        'DANHAOGUANJUN3' => 12056,
        'DANHAOGUANJUN4' => 12057,
        'DANHAOGUANJUN5' => 12058,
        'DANHAOGUANJUN6' => 12059,
        'DANHAOGUANJUN7' => 12060,
        'DANHAOGUANJUN8' => 12061,
        'DANHAOGUANJUN9' => 12062,
        'DANHAOGUANJUN10' => 12063,
        'LIANGMIANYAJUNDA' => 12064,
        'LIANGMIANYAJUNXIAO' => 12065,
        'LIANGMIANYAJUNDAN' => 12066,
        'LIANGMIANYAJUNSHUANG' => 12067,
        'LIANGMIANYAJUNLONG' => 12068,
        'LIANGMIANYAJUNHU' => 12069,
        'DANHAOYAJUN1' => 12070,
        'DANHAOYAJUN2' => 12071,
        'DANHAOYAJUN3' => 12072,
        'DANHAOYAJUN4' => 12073,
        'DANHAOYAJUN5' => 12074,
        'DANHAOYAJUN6' => 12075,
        'DANHAOYAJUN7' => 12076,
        'DANHAOYAJUN8' => 12077,
        'DANHAOYAJUN9' => 12078,
        'DANHAOYAJUN10' => 12079,
        'LIANGMIANDISANMINGDA' => 12080,
        'LIANGMIANDISANMINGXIAO' => 12081,
        'LIANGMIANDISANMINGDAN' => 12082,
        'LIANGMIANDISANMINGSHUANG' => 12083,
        'LIANGMIANDISANMINGLONG' => 12084,
        'LIANGMIANDISANMINGHU' => 12085,
        'DANHAODISANMING1' => 12086,
        'DANHAODISANMING2' => 12087,
        'DANHAODISANMING3' => 12088,
        'DANHAODISANMING4' => 12089,
        'DANHAODISANMING5' => 12090,
        'DANHAODISANMING6' => 12091,
        'DANHAODISANMING7' => 12092,
        'DANHAODISANMING8' => 12093,
        'DANHAODISANMING9' => 12094,
        'DANHAODISANMING10' => 12095,
        'LIANGMIANDISIMINGDA' => 12096,
        'LIANGMIANDISIMINGXIAO' => 12097,
        'LIANGMIANDISIMINGDAN' => 12098,
        'LIANGMIANDISIMINGSHUANG' => 12099,
        'LIANGMIANDISIMINGLONG' => 12100,
        'LIANGMIANDISIMINGHU' => 12101,
        'DANHAODISIMING1' => 12102,
        'DANHAODISIMING2' => 12103,
        'DANHAODISIMING3' => 12104,
        'DANHAODISIMING4' => 12105,
        'DANHAODISIMING5' => 12106,
        'DANHAODISIMING6' => 12107,
        'DANHAODISIMING7' => 12108,
        'DANHAODISIMING8' => 12109,
        'DANHAODISIMING9' => 12110,
        'DANHAODISIMING10' => 12111,
        'LIANGMIANDIWUMINGDA' => 12112,
        'LIANGMIANDIWUMINGXIAO' => 12113,
        'LIANGMIANDIWUMINGDAN' => 12114,
        'LIANGMIANDIWUMINGSHUANG' => 12115,
        'LIANGMIANDIWUMINGLONG' => 12116,
        'LIANGMIANDIWUMINGHU' => 12117,
        'DANHAODIWUMING1' => 12118,
        'DANHAODIWUMING2' => 12119,
        'DANHAODIWUMING3' => 12120,
        'DANHAODIWUMING4' => 12121,
        'DANHAODIWUMING5' => 12122,
        'DANHAODIWUMING6' => 12123,
        'DANHAODIWUMING7' => 12124,
        'DANHAODIWUMING8' => 12125,
        'DANHAODIWUMING9' => 12126,
        'DANHAODIWUMING10' => 12127,
        'LIANGMIANDILIUMINGDA' => 12128,
        'LIANGMIANDILIUMINGXIAO' => 12129,
        'LIANGMIANDILIUMINGDAN' => 12130,
        'LIANGMIANDILIUMINGSHUANG' => 12131,
        'DANHAODILIUMING1' => 12132,
        'DANHAODILIUMING2' => 12133,
        'DANHAODILIUMING3' => 12134,
        'DANHAODILIUMING4' => 12135,
        'DANHAODILIUMING5' => 12136,
        'DANHAODILIUMING6' => 12137,
        'DANHAODILIUMING7' => 12138,
        'DANHAODILIUMING8' => 12139,
        'DANHAODILIUMING9' => 12140,
        'DANHAODILIUMING10' => 12141,
        'LIANGMIANDIQIMINGDA' => 12142,
        'LIANGMIANDIQIMINGXIAO' => 12143,
        'LIANGMIANDIQIMINGDAN' => 12144,
        'LIANGMIANDIQIMINGSHUANG' => 12145,
        'DANHAODIQIMING1' => 12146,
        'DANHAODIQIMING2' => 12147,
        'DANHAODIQIMING3' => 12148,
        'DANHAODIQIMING4' => 12149,
        'DANHAODIQIMING5' => 12150,
        'DANHAODIQIMING6' => 12151,
        'DANHAODIQIMING7' => 12152,
        'DANHAODIQIMING8' => 12153,
        'DANHAODIQIMING9' => 12154,
        'DANHAODIQIMING10' => 12155,
        'LIANGMIANDIBAMINGDA' => 12156,
        'LIANGMIANDIBAMINGXIAO' => 12157,
        'LIANGMIANDIBAMINGDAN' => 12158,
        'LIANGMIANDIBAMINGSHUANG' => 12159,
        'DANHAODIBAMING1' => 12160,
        'DANHAODIBAMING2' => 12161,
        'DANHAODIBAMING3' => 12162,
        'DANHAODIBAMING4' => 12163,
        'DANHAODIBAMING5' => 12164,
        'DANHAODIBAMING6' => 12165,
        'DANHAODIBAMING7' => 12166,
        'DANHAODIBAMING8' => 12167,
        'DANHAODIBAMING9' => 12168,
        'DANHAODIBAMING10' => 12169,
        'LIANGMIANDIJIUMINGDA' => 12170,
        'LIANGMIANDIJIUMINGXIAO' => 12171,
        'LIANGMIANDIJIUMINGDAN' => 12172,
        'LIANGMIANDIJIUMINGSHUANG' => 12173,
        'DANHAODIJIUMING1' => 12174,
        'DANHAODIJIUMING2' => 12175,
        'DANHAODIJIUMING3' => 12176,
        'DANHAODIJIUMING4' => 12177,
        'DANHAODIJIUMING5' => 12178,
        'DANHAODIJIUMING6' => 12179,
        'DANHAODIJIUMING7' => 12180,
        'DANHAODIJIUMING8' => 12181,
        'DANHAODIJIUMING9' => 12182,
        'DANHAODIJIUMING10' => 12183,
        'LIANGMIANDISHIMINGDA' => 12184,
        'LIANGMIANDISHIMINGXIAO' => 12185,
        'LIANGMIANDISHIMINGDAN' => 12186,
        'LIANGMIANDISHIMINGSHUANG' => 12187,
        'DANHAODISHIMING1' => 12188,
        'DANHAODISHIMING2' => 12189,
        'DANHAODISHIMING3' => 12190,
        'DANHAODISHIMING4' => 12191,
        'DANHAODISHIMING5' => 12192,
        'DANHAODISHIMING6' => 12193,
        'DANHAODISHIMING7' => 12194,
        'DANHAODISHIMING8' => 12195,
        'DANHAODISHIMING9' => 12196,
        'DANHAODISHIMING10' => 12197
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
        $table = 'game_efsc';
        $gameName = '二分赛车';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'efsc killing...');
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