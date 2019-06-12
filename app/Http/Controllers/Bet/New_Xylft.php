<?php
/**
 * Created by PhpStorm.
 * User: zoe
 * Date: 2019/2/12
 * Time: 22:50
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Xylft extends Excel
{
    protected $arrPlay_id = array(90642710271,90642710272,90642710273,90642710274,90642710275,90642710276,90642710277,90642710278,90642710279,90642710280,90642710281,90642710282,90642710283,90642710284,90642710285,90642710286,90642710287,90642710288,90642710289,90642710290,90642710291,90642810292,90642810293,90642810294,90642810295,90642810296,90642810297,90642810298,90642810299,90642810300,90642810301,90642810302,90642810303,90642810304,90642810305,90642810306,90642810307,90642910308,90642910309,90642910310,90642910311,90642910312,90642910313,90642910314,90642910315,90642910316,90642910317,90642910318,90642910319,90642910320,90642910321,90642910322,90642910323,90643010324,90643010325,90643010326,90643010327,90643010328,90643010329,90643010330,90643010331,90643010332,90643010333,90643010334,90643010335,90643010336,90643010337,90643010338,90643010339,90643110340,90643110341,90643110342,90643110343,90643110344,90643110345,90643110346,90643110347,90643110348,90643110349,90643110350,90643110351,90643110352,90643110353,90643110354,90643110355,90643210356,90643210357,90643210358,90643210359,90643210360,90643210361,90643210362,90643210363,90643210364,90643210365,90643210366,90643210367,90643210368,90643210369,90643210370,90643210371,90643310372,90643310373,90643310374,90643310375,90643310376,90643310377,90643310378,90643310379,90643310380,90643310381,90643310382,90643310383,90643310384,90643310385,90643410386,90643410387,90643410388,90643410389,90643410390,90643410391,90643410392,90643410393,90643410394,90643410395,90643410396,90643410397,90643410398,90643410399,90643510400,90643510401,90643510402,90643510403,90643510404,90643510405,90643510406,90643510407,90643510408,90643510409,90643510410,90643510411,90643510412,90643510413,90643610414,90643610415,90643610416,90643610417,90643610418,90643610419,90643610420,90643610421,90643610422,90643610423,90643610424,90643610425,90643610426,90643610427,90643710428,90643710429,90643710430,90643710431,90643710432,90643710433,90643710434,90643710435,90643710436,90643710437,90643710438,90643710439,90643710440,90643710441);
    protected $arrPlayCate = array(
        'GUANYAJUNHE'=>427,
        'GUANJUN'=>428,
        'YAJUN'=>429,
        'DISANMING'=>430,
        'DISIMING'=>431,
        'DIWUMING'=>432,
        'DILIUMING'=>433,
        'DIQIMING'=>434,
        'DIBAMING'=>435,
        'DIJIUMING'=>436,
        'DISHIMING'=>437
    );
    protected $arrPlayId = array(
        'GUANYADA'=>10271,
        'GUANYAXIAO'=>10272,
        'GUANYADAN'=>10273,
        'GUANYASHUANG'=>10274,
        'GUANYAJUNHE3'=>10275,
        'GUANYAJUNHE4'=>10276,
        'GUANYAJUNHE5'=>10277,
        'GUANYAJUNHE6'=>10278,
        'GUANYAJUNHE7'=>10279,
        'GUANYAJUNHE8'=>10280,
        'GUANYAJUNHE9'=>10281,
        'GUANYAJUNHE10'=>10282,
        'GUANYAJUNHE11'=>10283,
        'GUANYAJUNHE12'=>10284,
        'GUANYAJUNHE13'=>10285,
        'GUANYAJUNHE14'=>10286,
        'GUANYAJUNHE15'=>10287,
        'GUANYAJUNHE16'=>10288,
        'GUANYAJUNHE17'=>10289,
        'GUANYAJUNHE18'=>10290,
        'GUANYAJUNHE19'=>10291,
        'LIANGMIANGUANJUNDA'=>10292,
        'LIANGMIANGUANJUNXIAO'=>10293,
        'LIANGMIANGUANJUNDAN'=>10294,
        'LIANGMIANGUANJUNSHUANG'=>10295,
        'LIANGMIANGUANJUNLONG'=>10296,
        'LIANGMIANGUANJUNHU'=>10297,
        'DANHAOGUANJUN1'=>10298,
        'DANHAOGUANJUN2'=>10299,
        'DANHAOGUANJUN3'=>10300,
        'DANHAOGUANJUN4'=>10301,
        'DANHAOGUANJUN5'=>10302,
        'DANHAOGUANJUN6'=>10303,
        'DANHAOGUANJUN7'=>10304,
        'DANHAOGUANJUN8'=>10305,
        'DANHAOGUANJUN9'=>10306,
        'DANHAOGUANJUN10'=>10307,
        'LIANGMIANYAJUNDA'=>10308,
        'LIANGMIANYAJUNXIAO'=>10309,
        'LIANGMIANYAJUNDAN'=>10310,
        'LIANGMIANYAJUNSHUANG'=>10311,
        'LIANGMIANYAJUNLONG'=>10312,
        'LIANGMIANYAJUNHU'=>10313,
        'DANHAOYAJUN1'=>10314,
        'DANHAOYAJUN2'=>10315,
        'DANHAOYAJUN3'=>10316,
        'DANHAOYAJUN4'=>10317,
        'DANHAOYAJUN5'=>10318,
        'DANHAOYAJUN6'=>10319,
        'DANHAOYAJUN7'=>10320,
        'DANHAOYAJUN8'=>10321,
        'DANHAOYAJUN9'=>10322,
        'DANHAOYAJUN10'=>10323,
        'LIANGMIANDISANMINGDA'=>10324,
        'LIANGMIANDISANMINGXIAO'=>10325,
        'LIANGMIANDISANMINGDAN'=>10326,
        'LIANGMIANDISANMINGSHUANG'=>10327,
        'LIANGMIANDISANMINGLONG'=>10328,
        'LIANGMIANDISANMINGHU'=>10329,
        'DANHAODISANMING1'=>10330,
        'DANHAODISANMING2'=>10331,
        'DANHAODISANMING3'=>10332,
        'DANHAODISANMING4'=>10333,
        'DANHAODISANMING5'=>10334,
        'DANHAODISANMING6'=>10335,
        'DANHAODISANMING7'=>10336,
        'DANHAODISANMING8'=>10337,
        'DANHAODISANMING9'=>10338,
        'DANHAODISANMING10'=>10339,
        'LIANGMIANDISIMINGDA'=>10340,
        'LIANGMIANDISIMINGXIAO'=>10341,
        'LIANGMIANDISIMINGDAN'=>10342,
        'LIANGMIANDISIMINGSHUANG'=>10343,
        'LIANGMIANDISIMINGLONG'=>10344,
        'LIANGMIANDISIMINGHU'=>10345,
        'DANHAODISIMING1'=>10346,
        'DANHAODISIMING2'=>10347,
        'DANHAODISIMING3'=>10348,
        'DANHAODISIMING4'=>10349,
        'DANHAODISIMING5'=>10350,
        'DANHAODISIMING6'=>10351,
        'DANHAODISIMING7'=>10352,
        'DANHAODISIMING8'=>10353,
        'DANHAODISIMING9'=>10354,
        'DANHAODISIMING10'=>10355,
        'LIANGMIANDIWUMINGDA'=>10356,
        'LIANGMIANDIWUMINGXIAO'=>10357,
        'LIANGMIANDIWUMINGDAN'=>10358,
        'LIANGMIANDIWUMINGSHUANG'=>10359,
        'LIANGMIANDIWUMINGLONG'=>10360,
        'LIANGMIANDIWUMINGHU'=>10361,
        'DANHAODIWUMING1'=>10362,
        'DANHAODIWUMING2'=>10363,
        'DANHAODIWUMING3'=>10364,
        'DANHAODIWUMING4'=>10365,
        'DANHAODIWUMING5'=>10366,
        'DANHAODIWUMING6'=>10367,
        'DANHAODIWUMING7'=>10368,
        'DANHAODIWUMING8'=>10369,
        'DANHAODIWUMING9'=>10370,
        'DANHAODIWUMING10'=>10371,
        'LIANGMIANDILIUMINGDA'=>10372,
        'LIANGMIANDILIUMINGXIAO'=>10373,
        'LIANGMIANDILIUMINGDAN'=>10374,
        'LIANGMIANDILIUMINGSHUANG'=>10375,
        'DANHAODILIUMING1'=>10376,
        'DANHAODILIUMING2'=>10377,
        'DANHAODILIUMING3'=>10378,
        'DANHAODILIUMING4'=>10379,
        'DANHAODILIUMING5'=>10380,
        'DANHAODILIUMING6'=>10381,
        'DANHAODILIUMING7'=>10382,
        'DANHAODILIUMING8'=>10383,
        'DANHAODILIUMING9'=>10384,
        'DANHAODILIUMING10'=>10385,
        'LIANGMIANDIQIMINGDA'=>10386,
        'LIANGMIANDIQIMINGXIAO'=>10387,
        'LIANGMIANDIQIMINGDAN'=>10388,
        'LIANGMIANDIQIMINGSHUANG'=>10389,
        'DANHAODIQIMING1'=>10390,
        'DANHAODIQIMING2'=>10391,
        'DANHAODIQIMING3'=>10392,
        'DANHAODIQIMING4'=>10393,
        'DANHAODIQIMING5'=>10394,
        'DANHAODIQIMING6'=>10395,
        'DANHAODIQIMING7'=>10396,
        'DANHAODIQIMING8'=>10397,
        'DANHAODIQIMING9'=>10398,
        'DANHAODIQIMING10'=>10399,
        'LIANGMIANDIBAMINGDA'=>10400,
        'LIANGMIANDIBAMINGXIAO'=>10401,
        'LIANGMIANDIBAMINGDAN'=>10402,
        'LIANGMIANDIBAMINGSHUANG'=>10403,
        'DANHAODIBAMING1'=>10404,
        'DANHAODIBAMING2'=>10405,
        'DANHAODIBAMING3'=>10406,
        'DANHAODIBAMING4'=>10407,
        'DANHAODIBAMING5'=>10408,
        'DANHAODIBAMING6'=>10409,
        'DANHAODIBAMING7'=>10410,
        'DANHAODIBAMING8'=>10411,
        'DANHAODIBAMING9'=>10412,
        'DANHAODIBAMING10'=>10413,
        'LIANGMIANDIJIUMINGDA'=>10414,
        'LIANGMIANDIJIUMINGXIAO'=>10415,
        'LIANGMIANDIJIUMINGDAN'=>10416,
        'LIANGMIANDIJIUMINGSHUANG'=>10417,
        'DANHAODIJIUMING1'=>10418,
        'DANHAODIJIUMING2'=>10419,
        'DANHAODIJIUMING3'=>10420,
        'DANHAODIJIUMING4'=>10421,
        'DANHAODIJIUMING5'=>10422,
        'DANHAODIJIUMING6'=>10423,
        'DANHAODIJIUMING7'=>10424,
        'DANHAODIJIUMING8'=>10425,
        'DANHAODIJIUMING9'=>10426,
        'DANHAODIJIUMING10'=>10427,
        'LIANGMIANDISHIMINGDA'=>10428,
        'LIANGMIANDISHIMINGXIAO'=>10429,
        'LIANGMIANDISHIMINGDAN'=>10430,
        'LIANGMIANDISHIMINGSHUANG'=>10431,
        'DANHAODISHIMING1'=>10432,
        'DANHAODISHIMING2'=>10433,
        'DANHAODISHIMING3'=>10434,
        'DANHAODISHIMING4'=>10435,
        'DANHAODISHIMING5'=>10436,
        'DANHAODISHIMING6'=>10437,
        'DANHAODISHIMING7'=>10438,
        'DANHAODISHIMING8'=>10439,
        'DANHAODISHIMING9'=>10440,
        'DANHAODISHIMING10'=>10441
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
        $table = 'game_xylft';
        $gameName = '匈牙利飞艇';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'xylft killing...');
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
