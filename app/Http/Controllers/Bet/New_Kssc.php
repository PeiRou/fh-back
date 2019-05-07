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

class New_Kssc extends Excel
{
    protected $arrPlay_id = array(8013045160,8013045161,8013045162,8013045163,8013045164,8013045165,8013045166,8013045167,8013045168,8013045169,8013045170,8013045171,8013045172,8013045173,8013045174,8013045175,8013045176,8013045177,8013045178,8013045179,8013045180,8013055181,8013055182,8013055183,8013055184,8013055185,8013055186,8013055187,8013055188,8013055189,8013055190,8013055191,8013055192,8013055193,8013055194,8013055195,8013055196,8013065197,8013065198,8013065199,8013065200,8013065201,8013065202,8013065203,8013065204,8013065205,8013065206,8013065207,8013065208,8013065209,8013065210,8013065211,8013065212,8013075213,8013075214,8013075215,8013075216,8013075217,8013075218,8013075219,8013075220,8013075221,8013075222,8013075223,8013075224,8013075225,8013075226,8013075227,8013075228,8013085229,8013085230,8013085231,8013085232,8013085233,8013085234,8013085235,8013085236,8013085237,8013085238,8013085239,8013085240,8013085241,8013085242,8013085243,8013085244,8013095245,8013095246,8013095247,8013095248,8013095249,8013095250,8013095251,8013095252,8013095253,8013095254,8013095255,8013095256,8013095257,8013095258,8013095259,8013095260,8013105261,8013105262,8013105263,8013105264,8013105265,8013105266,8013105267,8013105268,8013105269,8013105270,8013105271,8013105272,8013105273,8013105274,8013115275,8013115276,8013115277,8013115278,8013115279,8013115280,8013115281,8013115282,8013115283,8013115284,8013115285,8013115286,8013115287,8013115288,8013125289,8013125290,8013125291,8013125292,8013125293,8013125294,8013125295,8013125296,8013125297,8013125298,8013125299,8013125300,8013125301,8013125302,8013135303,8013135304,8013135305,8013135306,8013135307,8013135308,8013135309,8013135310,8013135311,8013135312,8013135313,8013135314,8013135315,8013135316,8013145317,8013145318,8013145319,8013145320,8013145321,8013145322,8013145323,8013145324,8013145325,8013145326,8013145327,8013145328,8013145329,8013145330);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>304,
        'GUANJUN' =>305,
        'YAJUN' =>306,
        'DISANMING' =>307,
        'DISIMING' =>308,
        'DIWUMING' =>309,
        'DILIUMING' =>310,
        'DIQIMING' =>311,
        'DIBAMING' =>312,
        'DIJIUMING' =>313,
        'DISHIMING' =>314
    );
    protected $arrPlayId = array(
        'GUANYADA' => 5160,
        'GUANYAXIAO' => 5161,
        'GUANYADAN' => 5162,
        'GUANYASHUANG' => 5163,
        'GUANYAJUNHE3' => 5164,
        'GUANYAJUNHE4' => 5165,
        'GUANYAJUNHE5' => 5166,
        'GUANYAJUNHE6' => 5167,
        'GUANYAJUNHE7' => 5168,
        'GUANYAJUNHE8' => 5169,
        'GUANYAJUNHE9' => 5170,
        'GUANYAJUNHE10' => 5171,
        'GUANYAJUNHE11' => 5172,
        'GUANYAJUNHE12' => 5173,
        'GUANYAJUNHE13' => 5174,
        'GUANYAJUNHE14' => 5175,
        'GUANYAJUNHE15' => 5176,
        'GUANYAJUNHE16' => 5177,
        'GUANYAJUNHE17' => 5178,
        'GUANYAJUNHE18' => 5179,
        'GUANYAJUNHE19' => 5180,
        'LIANGMIANGUANJUNDA' => 5181,
        'LIANGMIANGUANJUNXIAO' => 5182,
        'LIANGMIANGUANJUNDAN' => 5183,
        'LIANGMIANGUANJUNSHUANG' => 5184,
        'LIANGMIANGUANJUNLONG' => 5185,
        'LIANGMIANGUANJUNHU' => 5186,
        'DANHAOGUANJUN1' => 5187,
        'DANHAOGUANJUN2' => 5188,
        'DANHAOGUANJUN3' => 5189,
        'DANHAOGUANJUN4' => 5190,
        'DANHAOGUANJUN5' => 5191,
        'DANHAOGUANJUN6' => 5192,
        'DANHAOGUANJUN7' => 5193,
        'DANHAOGUANJUN8' => 5194,
        'DANHAOGUANJUN9' => 5195,
        'DANHAOGUANJUN10' => 5196,
        'LIANGMIANYAJUNDA' => 5197,
        'LIANGMIANYAJUNXIAO' => 5198,
        'LIANGMIANYAJUNDAN' => 5199,
        'LIANGMIANYAJUNSHUANG' => 5200,
        'LIANGMIANYAJUNLONG' => 5201,
        'LIANGMIANYAJUNHU' => 5202,
        'DANHAOYAJUN1' => 5203,
        'DANHAOYAJUN2' => 5204,
        'DANHAOYAJUN3' => 5205,
        'DANHAOYAJUN4' => 5206,
        'DANHAOYAJUN5' => 5207,
        'DANHAOYAJUN6' => 5208,
        'DANHAOYAJUN7' => 5209,
        'DANHAOYAJUN8' => 5210,
        'DANHAOYAJUN9' => 5211,
        'DANHAOYAJUN10' => 5212,
        'LIANGMIANDISANMINGDA' => 5213,
        'LIANGMIANDISANMINGXIAO' => 5214,
        'LIANGMIANDISANMINGDAN' => 5215,
        'LIANGMIANDISANMINGSHUANG' => 5216,
        'LIANGMIANDISANMINGLONG' => 5217,
        'LIANGMIANDISANMINGHU' => 5218,
        'DANHAODISANMING1' => 5219,
        'DANHAODISANMING2' => 5220,
        'DANHAODISANMING3' => 5221,
        'DANHAODISANMING4' => 5222,
        'DANHAODISANMING5' => 5223,
        'DANHAODISANMING6' => 5224,
        'DANHAODISANMING7' => 5225,
        'DANHAODISANMING8' => 5226,
        'DANHAODISANMING9' => 5227,
        'DANHAODISANMING10' => 5228,
        'LIANGMIANDISIMINGDA' => 5229,
        'LIANGMIANDISIMINGXIAO' => 5230,
        'LIANGMIANDISIMINGDAN' => 5231,
        'LIANGMIANDISIMINGSHUANG' => 5232,
        'LIANGMIANDISIMINGLONG' => 5233,
        'LIANGMIANDISIMINGHU' => 5234,
        'DANHAODISIMING1' => 5235,
        'DANHAODISIMING2' => 5236,
        'DANHAODISIMING3' => 5237,
        'DANHAODISIMING4' => 5238,
        'DANHAODISIMING5' => 5239,
        'DANHAODISIMING6' => 5240,
        'DANHAODISIMING7' => 5241,
        'DANHAODISIMING8' => 5242,
        'DANHAODISIMING9' => 5243,
        'DANHAODISIMING10' => 5244,
        'LIANGMIANDIWUMINGDA' => 5245,
        'LIANGMIANDIWUMINGXIAO' => 5246,
        'LIANGMIANDIWUMINGDAN' => 5247,
        'LIANGMIANDIWUMINGSHUANG' => 5248,
        'LIANGMIANDIWUMINGLONG' => 5249,
        'LIANGMIANDIWUMINGHU' => 5250,
        'DANHAODIWUMING1' => 5251,
        'DANHAODIWUMING2' => 5252,
        'DANHAODIWUMING3' => 5253,
        'DANHAODIWUMING4' => 5254,
        'DANHAODIWUMING5' => 5255,
        'DANHAODIWUMING6' => 5256,
        'DANHAODIWUMING7' => 5257,
        'DANHAODIWUMING8' => 5258,
        'DANHAODIWUMING9' => 5259,
        'DANHAODIWUMING10' => 5260,
        'LIANGMIANDILIUMINGDA' => 5261,
        'LIANGMIANDILIUMINGXIAO' => 5262,
        'LIANGMIANDILIUMINGDAN' => 5263,
        'LIANGMIANDILIUMINGSHUANG' => 5264,
        'DANHAODILIUMING1' => 5265,
        'DANHAODILIUMING2' => 5266,
        'DANHAODILIUMING3' => 5267,
        'DANHAODILIUMING4' => 5268,
        'DANHAODILIUMING5' => 5269,
        'DANHAODILIUMING6' => 5270,
        'DANHAODILIUMING7' => 5271,
        'DANHAODILIUMING8' => 5272,
        'DANHAODILIUMING9' => 5273,
        'DANHAODILIUMING10' => 5274,
        'LIANGMIANDIQIMINGDA' => 5275,
        'LIANGMIANDIQIMINGXIAO' => 5276,
        'LIANGMIANDIQIMINGDAN' => 5277,
        'LIANGMIANDIQIMINGSHUANG' => 5278,
        'DANHAODIQIMING1' => 5279,
        'DANHAODIQIMING2' => 5280,
        'DANHAODIQIMING3' => 5281,
        'DANHAODIQIMING4' => 5282,
        'DANHAODIQIMING5' => 5283,
        'DANHAODIQIMING6' => 5284,
        'DANHAODIQIMING7' => 5285,
        'DANHAODIQIMING8' => 5286,
        'DANHAODIQIMING9' => 5287,
        'DANHAODIQIMING10' => 5288,
        'LIANGMIANDIBAMINGDA' => 5289,
        'LIANGMIANDIBAMINGXIAO' => 5290,
        'LIANGMIANDIBAMINGDAN' => 5291,
        'LIANGMIANDIBAMINGSHUANG' => 5292,
        'DANHAODIBAMING1' => 5293,
        'DANHAODIBAMING2' => 5294,
        'DANHAODIBAMING3' => 5295,
        'DANHAODIBAMING4' => 5296,
        'DANHAODIBAMING5' => 5297,
        'DANHAODIBAMING6' => 5298,
        'DANHAODIBAMING7' => 5299,
        'DANHAODIBAMING8' => 5300,
        'DANHAODIBAMING9' => 5301,
        'DANHAODIBAMING10' => 5302,
        'LIANGMIANDIJIUMINGDA' => 5303,
        'LIANGMIANDIJIUMINGXIAO' => 5304,
        'LIANGMIANDIJIUMINGDAN' => 5305,
        'LIANGMIANDIJIUMINGSHUANG' => 5306,
        'DANHAODIJIUMING1' => 5307,
        'DANHAODIJIUMING2' => 5308,
        'DANHAODIJIUMING3' => 5309,
        'DANHAODIJIUMING4' => 5310,
        'DANHAODIJIUMING5' => 5311,
        'DANHAODIJIUMING6' => 5312,
        'DANHAODIJIUMING7' => 5313,
        'DANHAODIJIUMING8' => 5314,
        'DANHAODIJIUMING9' => 5315,
        'DANHAODIJIUMING10' => 5316,
        'LIANGMIANDISHIMINGDA' => 5317,
        'LIANGMIANDISHIMINGXIAO' => 5318,
        'LIANGMIANDISHIMINGDAN' => 5319,
        'LIANGMIANDISHIMINGSHUANG' => 5320,
        'DANHAODISHIMING1' => 5321,
        'DANHAODISHIMING2' => 5322,
        'DANHAODISHIMING3' => 5323,
        'DANHAODISHIMING4' => 5324,
        'DANHAODISHIMING5' => 5325,
        'DANHAODISHIMING6' => 5326,
        'DANHAODISHIMING7' => 5327,
        'DANHAODISHIMING8' => 5328,
        'DANHAODISHIMING9' => 5329,
        'DANHAODISHIMING10' => 5330
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
        $table = 'game_kssc';
        $gameName = '快速赛车';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'kssc killing...');
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
