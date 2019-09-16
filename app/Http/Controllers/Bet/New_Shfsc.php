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

class New_Shfsc extends Excel
{
    protected $arrPlay_id = array(91758914077,91758914078,91758914079,91758914080,91758914081,91758914082,91758914083,91758914084,91758914085,91758914086,91758914087,91758914088,91758914089,91758914090,91758914091,91758914092,91758914093,91758914094,91758914095,91758914096,91758914097,91759014098,91759014099,91759014100,91759014101,91759014102,91759014103,91759014104,91759014105,91759014106,91759014107,91759014108,91759014109,91759014110,91759014111,91759014112,91759014113,91759114114,91759114115,91759114116,91759114117,91759114118,91759114119,91759114120,91759114121,91759114122,91759114123,91759114124,91759114125,91759114126,91759114127,91759114128,91759114129,91759214130,91759214131,91759214132,91759214133,91759214134,91759214135,91759214136,91759214137,91759214138,91759214139,91759214140,91759214141,91759214142,91759214143,91759214144,91759214145,91759314146,91759314147,91759314148,91759314149,91759314150,91759314151,91759314152,91759314153,91759314154,91759314155,91759314156,91759314157,91759314158,91759314159,91759314160,91759314161,91759414162,91759414163,91759414164,91759414165,91759414166,91759414167,91759414168,91759414169,91759414170,91759414171,91759414172,91759414173,91759414174,91759414175,91759414176,91759414177,91759514178,91759514179,91759514180,91759514181,91759514182,91759514183,91759514184,91759514185,91759514186,91759514187,91759514188,91759514189,91759514190,91759514191,91759614192,91759614193,91759614194,91759614195,91759614196,91759614197,91759614198,91759614199,91759614200,91759614201,91759614202,91759614203,91759614204,91759614205,91759714206,91759714207,91759714208,91759714209,91759714210,91759714211,91759714212,91759714213,91759714214,91759714215,91759714216,91759714217,91759714218,91759714219,91759814220,91759814221,91759814222,91759814223,91759814224,91759814225,91759814226,91759814227,91759814228,91759814229,91759814230,91759814231,91759814232,91759814233,91759914234,91759914235,91759914236,91759914237,91759914238,91759914239,91759914240,91759914241,91759914242,91759914243,91759914244,91759914245,91759914246,91759914247);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' => 589,
        'GUANJUN' => 590,
        'YAJUN' => 591,
        'DISANMING' => 592,
        'DISIMING' => 593,
        'DIWUMING' => 594,
        'DILIUMING' => 595,
        'DIQIMING' => 596,
        'DIBAMING' => 597,
        'DIJIUMING' => 598,
        'DISHIMING' => 599
    );
    protected $arrPlayId = array(
        'GUANYADA' => 14077,
        'GUANYAXIAO' => 14078,
        'GUANYADAN' => 14079,
        'GUANYASHUANG' => 14080,
        'GUANYAJUNHE3' => 14081,
        'GUANYAJUNHE4' => 14082,
        'GUANYAJUNHE5' => 14083,
        'GUANYAJUNHE6' => 14084,
        'GUANYAJUNHE7' => 14085,
        'GUANYAJUNHE8' => 14086,
        'GUANYAJUNHE9' => 14087,
        'GUANYAJUNHE10' => 14088,
        'GUANYAJUNHE11' => 14089,
        'GUANYAJUNHE12' => 14090,
        'GUANYAJUNHE13' => 14091,
        'GUANYAJUNHE14' => 14092,
        'GUANYAJUNHE15' => 14093,
        'GUANYAJUNHE16' => 14094,
        'GUANYAJUNHE17' => 14095,
        'GUANYAJUNHE18' => 14096,
        'GUANYAJUNHE19' => 14097,
        'LIANGMIANGUANJUNDA' => 14098,
        'LIANGMIANGUANJUNXIAO' => 14099,
        'LIANGMIANGUANJUNDAN' => 14100,
        'LIANGMIANGUANJUNSHUANG' => 14101,
        'LIANGMIANGUANJUNLONG' => 14102,
        'LIANGMIANGUANJUNHU' => 14103,
        'DANHAOGUANJUN1' => 14104,
        'DANHAOGUANJUN2' => 14105,
        'DANHAOGUANJUN3' => 14106,
        'DANHAOGUANJUN4' => 14107,
        'DANHAOGUANJUN5' => 14108,
        'DANHAOGUANJUN6' => 14109,
        'DANHAOGUANJUN7' => 14110,
        'DANHAOGUANJUN8' => 14111,
        'DANHAOGUANJUN9' => 14112,
        'DANHAOGUANJUN10' => 14113,
        'LIANGMIANYAJUNDA' => 14114,
        'LIANGMIANYAJUNXIAO' => 14115,
        'LIANGMIANYAJUNDAN' => 14116,
        'LIANGMIANYAJUNSHUANG' => 14117,
        'LIANGMIANYAJUNLONG' => 14118,
        'LIANGMIANYAJUNHU' => 14119,
        'DANHAOYAJUN1' => 14120,
        'DANHAOYAJUN2' => 14121,
        'DANHAOYAJUN3' => 14122,
        'DANHAOYAJUN4' => 14123,
        'DANHAOYAJUN5' => 14124,
        'DANHAOYAJUN6' => 14125,
        'DANHAOYAJUN7' => 14126,
        'DANHAOYAJUN8' => 14127,
        'DANHAOYAJUN9' => 14128,
        'DANHAOYAJUN10' => 14129,
        'LIANGMIANDISANMINGDA' => 14130,
        'LIANGMIANDISANMINGXIAO' => 14131,
        'LIANGMIANDISANMINGDAN' => 14132,
        'LIANGMIANDISANMINGSHUANG' => 14133,
        'LIANGMIANDISANMINGLONG' => 14134,
        'LIANGMIANDISANMINGHU' => 14135,
        'DANHAODISANMING1' => 14136,
        'DANHAODISANMING2' => 14137,
        'DANHAODISANMING3' => 14138,
        'DANHAODISANMING4' => 14139,
        'DANHAODISANMING5' => 14140,
        'DANHAODISANMING6' => 14141,
        'DANHAODISANMING7' => 14142,
        'DANHAODISANMING8' => 14143,
        'DANHAODISANMING9' => 14144,
        'DANHAODISANMING10' => 14145,
        'LIANGMIANDISIMINGDA' => 14146,
        'LIANGMIANDISIMINGXIAO' => 14147,
        'LIANGMIANDISIMINGDAN' => 14148,
        'LIANGMIANDISIMINGSHUANG' => 14149,
        'LIANGMIANDISIMINGLONG' => 14150,
        'LIANGMIANDISIMINGHU' => 14151,
        'DANHAODISIMING1' => 14152,
        'DANHAODISIMING2' => 14153,
        'DANHAODISIMING3' => 14154,
        'DANHAODISIMING4' => 14155,
        'DANHAODISIMING5' => 14156,
        'DANHAODISIMING6' => 14157,
        'DANHAODISIMING7' => 14158,
        'DANHAODISIMING8' => 14159,
        'DANHAODISIMING9' => 14160,
        'DANHAODISIMING10' => 14161,
        'LIANGMIANDIWUMINGDA' => 14162,
        'LIANGMIANDIWUMINGXIAO' => 14163,
        'LIANGMIANDIWUMINGDAN' => 14164,
        'LIANGMIANDIWUMINGSHUANG' => 14165,
        'LIANGMIANDIWUMINGLONG' => 14166,
        'LIANGMIANDIWUMINGHU' => 14167,
        'DANHAODIWUMING1' => 14168,
        'DANHAODIWUMING2' => 14169,
        'DANHAODIWUMING3' => 14170,
        'DANHAODIWUMING4' => 14171,
        'DANHAODIWUMING5' => 14172,
        'DANHAODIWUMING6' => 14173,
        'DANHAODIWUMING7' => 14174,
        'DANHAODIWUMING8' => 14175,
        'DANHAODIWUMING9' => 14176,
        'DANHAODIWUMING10' => 14177,
        'LIANGMIANDILIUMINGDA' => 14178,
        'LIANGMIANDILIUMINGXIAO' => 14179,
        'LIANGMIANDILIUMINGDAN' => 14180,
        'LIANGMIANDILIUMINGSHUANG' => 14181,
        'DANHAODILIUMING1' => 14182,
        'DANHAODILIUMING2' => 14183,
        'DANHAODILIUMING3' => 14184,
        'DANHAODILIUMING4' => 14185,
        'DANHAODILIUMING5' => 14186,
        'DANHAODILIUMING6' => 14187,
        'DANHAODILIUMING7' => 14188,
        'DANHAODILIUMING8' => 14189,
        'DANHAODILIUMING9' => 14190,
        'DANHAODILIUMING10' => 14191,
        'LIANGMIANDIQIMINGDA' => 14192,
        'LIANGMIANDIQIMINGXIAO' => 14193,
        'LIANGMIANDIQIMINGDAN' => 14194,
        'LIANGMIANDIQIMINGSHUANG' => 14195,
        'DANHAODIQIMING1' => 14196,
        'DANHAODIQIMING2' => 14197,
        'DANHAODIQIMING3' => 14198,
        'DANHAODIQIMING4' => 14199,
        'DANHAODIQIMING5' => 14200,
        'DANHAODIQIMING6' => 14201,
        'DANHAODIQIMING7' => 14202,
        'DANHAODIQIMING8' => 14203,
        'DANHAODIQIMING9' => 14204,
        'DANHAODIQIMING10' => 14205,
        'LIANGMIANDIBAMINGDA' => 14206,
        'LIANGMIANDIBAMINGXIAO' => 14207,
        'LIANGMIANDIBAMINGDAN' => 14208,
        'LIANGMIANDIBAMINGSHUANG' => 14209,
        'DANHAODIBAMING1' => 14210,
        'DANHAODIBAMING2' => 14211,
        'DANHAODIBAMING3' => 14212,
        'DANHAODIBAMING4' => 14213,
        'DANHAODIBAMING5' => 14214,
        'DANHAODIBAMING6' => 14215,
        'DANHAODIBAMING7' => 14216,
        'DANHAODIBAMING8' => 14217,
        'DANHAODIBAMING9' => 14218,
        'DANHAODIBAMING10' => 14219,
        'LIANGMIANDIJIUMINGDA' => 14220,
        'LIANGMIANDIJIUMINGXIAO' => 14221,
        'LIANGMIANDIJIUMINGDAN' => 14222,
        'LIANGMIANDIJIUMINGSHUANG' => 14223,
        'DANHAODIJIUMING1' => 14224,
        'DANHAODIJIUMING2' => 14225,
        'DANHAODIJIUMING3' => 14226,
        'DANHAODIJIUMING4' => 14227,
        'DANHAODIJIUMING5' => 14228,
        'DANHAODIJIUMING6' => 14229,
        'DANHAODIJIUMING7' => 14230,
        'DANHAODIJIUMING8' => 14231,
        'DANHAODIJIUMING9' => 14232,
        'DANHAODIJIUMING10' => 14233,
        'LIANGMIANDISHIMINGDA' => 14234,
        'LIANGMIANDISHIMINGXIAO' => 14235,
        'LIANGMIANDISHIMINGDAN' => 14236,
        'LIANGMIANDISHIMINGSHUANG' => 14237,
        'DANHAODISHIMING1' => 14238,
        'DANHAODISHIMING2' => 14239,
        'DANHAODISHIMING3' => 14240,
        'DANHAODISHIMING4' => 14241,
        'DANHAODISHIMING5' => 14242,
        'DANHAODISHIMING6' => 14243,
        'DANHAODISHIMING7' => 14244,
        'DANHAODISHIMING8' => 14245,
        'DANHAODISHIMING9' => 14246,
        'DANHAODISHIMING10' => 14247
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
        $table = 'game_shfsc';
        $gameName = '十分赛车';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'shfsc killing...');
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