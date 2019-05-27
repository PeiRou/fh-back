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

class New_Ksft extends Excel
{
    protected $arrPlay_id = array(8023155331,8023155332,8023155333,8023155334,8023155335,8023155336,8023155337,8023155338,8023155339,8023155340,8023155341,8023155342,8023155343,8023155344,8023155345,8023155346,8023155347,8023155348,8023155349,8023155350,8023155351,8023165352,8023165353,8023165354,8023165355,8023165356,8023165357,8023165358,8023165359,8023165360,8023165361,8023165362,8023165363,8023165364,8023165365,8023165366,8023165367,8023175368,8023175369,8023175370,8023175371,8023175372,8023175373,8023175374,8023175375,8023175376,8023175377,8023175378,8023175379,8023175380,8023175381,8023175382,8023175383,8023185384,8023185385,8023185386,8023185387,8023185388,8023185389,8023185390,8023185391,8023185392,8023185393,8023185394,8023185395,8023185396,8023185397,8023185398,8023185399,8023195400,8023195401,8023195402,8023195403,8023195404,8023195405,8023195406,8023195407,8023195408,8023195409,8023195410,8023195411,8023195412,8023195413,8023195414,8023195415,8023205416,8023205417,8023205418,8023205419,8023205420,8023205421,8023205422,8023205423,8023205424,8023205425,8023205426,8023205427,8023205428,8023205429,8023205430,8023205431,8023215432,8023215433,8023215434,8023215435,8023215436,8023215437,8023215438,8023215439,8023215440,8023215441,8023215442,8023215443,8023215444,8023215445,8023225446,8023225447,8023225448,8023225449,8023225450,8023225451,8023225452,8023225453,8023225454,8023225455,8023225456,8023225457,8023225458,8023225459,8023235460,8023235461,8023235462,8023235463,8023235464,8023235465,8023235466,8023235467,8023235468,8023235469,8023235470,8023235471,8023235472,8023235473,8023245474,8023245475,8023245476,8023245477,8023245478,8023245479,8023245480,8023245481,8023245482,8023245483,8023245484,8023245485,8023245486,8023245487,8023255488,8023255489,8023255490,8023255491,8023255492,8023255493,8023255494,8023255495,8023255496,8023255497,8023255498,8023255499,8023255500,8023255501);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>315,
        'GUANJUN' =>316,
        'YAJUN' =>317,
        'DISANMING' =>318,
        'DISIMING' =>319,
        'DIWUMING' =>320,
        'DILIUMING' =>321,
        'DIQIMING' =>322,
        'DIBAMING' =>323,
        'DIJIUMING' =>324,
        'DISHIMING' =>325
    );
    protected $arrPlayId = array(
        'GUANYADA' => 5331,
        'GUANYAXIAO' => 5332,
        'GUANYADAN' => 5333,
        'GUANYASHUANG' => 5334,
        'GUANYAJUNHE3' => 5335,
        'GUANYAJUNHE4' => 5336,
        'GUANYAJUNHE5' => 5337,
        'GUANYAJUNHE6' => 5338,
        'GUANYAJUNHE7' => 5339,
        'GUANYAJUNHE8' => 5340,
        'GUANYAJUNHE9' => 5341,
        'GUANYAJUNHE10' => 5342,
        'GUANYAJUNHE11' => 5343,
        'GUANYAJUNHE12' => 5344,
        'GUANYAJUNHE13' => 5345,
        'GUANYAJUNHE14' => 5346,
        'GUANYAJUNHE15' => 5347,
        'GUANYAJUNHE16' => 5348,
        'GUANYAJUNHE17' => 5349,
        'GUANYAJUNHE18' => 5350,
        'GUANYAJUNHE19' => 5351,
        'LIANGMIANGUANJUNDA' => 5352,
        'LIANGMIANGUANJUNXIAO' => 5353,
        'LIANGMIANGUANJUNDAN' => 5354,
        'LIANGMIANGUANJUNSHUANG' => 5355,
        'LIANGMIANGUANJUNLONG' => 5356,
        'LIANGMIANGUANJUNHU' => 5357,
        'DANHAOGUANJUN1' => 5358,
        'DANHAOGUANJUN2' => 5359,
        'DANHAOGUANJUN3' => 5360,
        'DANHAOGUANJUN4' => 5361,
        'DANHAOGUANJUN5' => 5362,
        'DANHAOGUANJUN6' => 5363,
        'DANHAOGUANJUN7' => 5364,
        'DANHAOGUANJUN8' => 5365,
        'DANHAOGUANJUN9' => 5366,
        'DANHAOGUANJUN10' => 5367,
        'LIANGMIANYAJUNDA' => 5368,
        'LIANGMIANYAJUNXIAO' => 5369,
        'LIANGMIANYAJUNDAN' => 5370,
        'LIANGMIANYAJUNSHUANG' => 5371,
        'LIANGMIANYAJUNLONG' => 5372,
        'LIANGMIANYAJUNHU' => 5373,
        'DANHAOYAJUN1' => 5374,
        'DANHAOYAJUN2' => 5375,
        'DANHAOYAJUN3' => 5376,
        'DANHAOYAJUN4' => 5377,
        'DANHAOYAJUN5' => 5378,
        'DANHAOYAJUN6' => 5379,
        'DANHAOYAJUN7' => 5380,
        'DANHAOYAJUN8' => 5381,
        'DANHAOYAJUN9' => 5382,
        'DANHAOYAJUN10' => 5383,
        'LIANGMIANDISANMINGDA' => 5384,
        'LIANGMIANDISANMINGXIAO' => 5385,
        'LIANGMIANDISANMINGDAN' => 5386,
        'LIANGMIANDISANMINGSHUANG' => 5387,
        'LIANGMIANDISANMINGLONG' => 5388,
        'LIANGMIANDISANMINGHU' => 5389,
        'DANHAODISANMING1' => 5390,
        'DANHAODISANMING2' => 5391,
        'DANHAODISANMING3' => 5392,
        'DANHAODISANMING4' => 5393,
        'DANHAODISANMING5' => 5394,
        'DANHAODISANMING6' => 5395,
        'DANHAODISANMING7' => 5396,
        'DANHAODISANMING8' => 5397,
        'DANHAODISANMING9' => 5398,
        'DANHAODISANMING10' => 5399,
        'LIANGMIANDISIMINGDA' => 5400,
        'LIANGMIANDISIMINGXIAO' => 5401,
        'LIANGMIANDISIMINGDAN' => 5402,
        'LIANGMIANDISIMINGSHUANG' => 5403,
        'LIANGMIANDISIMINGLONG' => 5404,
        'LIANGMIANDISIMINGHU' => 5405,
        'DANHAODISIMING1' => 5406,
        'DANHAODISIMING2' => 5407,
        'DANHAODISIMING3' => 5408,
        'DANHAODISIMING4' => 5409,
        'DANHAODISIMING5' => 5410,
        'DANHAODISIMING6' => 5411,
        'DANHAODISIMING7' => 5412,
        'DANHAODISIMING8' => 5413,
        'DANHAODISIMING9' => 5414,
        'DANHAODISIMING10' => 5415,
        'LIANGMIANDIWUMINGDA' => 5416,
        'LIANGMIANDIWUMINGXIAO' => 5417,
        'LIANGMIANDIWUMINGDAN' => 5418,
        'LIANGMIANDIWUMINGSHUANG' => 5419,
        'LIANGMIANDIWUMINGLONG' => 5420,
        'LIANGMIANDIWUMINGHU' => 5421,
        'DANHAODIWUMING1' => 5422,
        'DANHAODIWUMING2' => 5423,
        'DANHAODIWUMING3' => 5424,
        'DANHAODIWUMING4' => 5425,
        'DANHAODIWUMING5' => 5426,
        'DANHAODIWUMING6' => 5427,
        'DANHAODIWUMING7' => 5428,
        'DANHAODIWUMING8' => 5429,
        'DANHAODIWUMING9' => 5430,
        'DANHAODIWUMING10' => 5431,
        'LIANGMIANDILIUMINGDA' => 5432,
        'LIANGMIANDILIUMINGXIAO' => 5433,
        'LIANGMIANDILIUMINGDAN' => 5434,
        'LIANGMIANDILIUMINGSHUANG' => 5435,
        'DANHAODILIUMING1' => 5436,
        'DANHAODILIUMING2' => 5437,
        'DANHAODILIUMING3' => 5438,
        'DANHAODILIUMING4' => 5439,
        'DANHAODILIUMING5' => 5440,
        'DANHAODILIUMING6' => 5441,
        'DANHAODILIUMING7' => 5442,
        'DANHAODILIUMING8' => 5443,
        'DANHAODILIUMING9' => 5444,
        'DANHAODILIUMING10' => 5445,
        'LIANGMIANDIQIMINGDA' => 5446,
        'LIANGMIANDIQIMINGXIAO' => 5447,
        'LIANGMIANDIQIMINGDAN' => 5448,
        'LIANGMIANDIQIMINGSHUANG' => 5449,
        'DANHAODIQIMING1' => 5450,
        'DANHAODIQIMING2' => 5451,
        'DANHAODIQIMING3' => 5452,
        'DANHAODIQIMING4' => 5453,
        'DANHAODIQIMING5' => 5454,
        'DANHAODIQIMING6' => 5455,
        'DANHAODIQIMING7' => 5456,
        'DANHAODIQIMING8' => 5457,
        'DANHAODIQIMING9' => 5458,
        'DANHAODIQIMING10' => 5459,
        'LIANGMIANDIBAMINGDA' => 5460,
        'LIANGMIANDIBAMINGXIAO' => 5461,
        'LIANGMIANDIBAMINGDAN' => 5462,
        'LIANGMIANDIBAMINGSHUANG' => 5463,
        'DANHAODIBAMING1' => 5464,
        'DANHAODIBAMING2' => 5465,
        'DANHAODIBAMING3' => 5466,
        'DANHAODIBAMING4' => 5467,
        'DANHAODIBAMING5' => 5468,
        'DANHAODIBAMING6' => 5469,
        'DANHAODIBAMING7' => 5470,
        'DANHAODIBAMING8' => 5471,
        'DANHAODIBAMING9' => 5472,
        'DANHAODIBAMING10' => 5473,
        'LIANGMIANDIJIUMINGDA' => 5474,
        'LIANGMIANDIJIUMINGXIAO' => 5475,
        'LIANGMIANDIJIUMINGDAN' => 5476,
        'LIANGMIANDIJIUMINGSHUANG' => 5477,
        'DANHAODIJIUMING1' => 5478,
        'DANHAODIJIUMING2' => 5479,
        'DANHAODIJIUMING3' => 5480,
        'DANHAODIJIUMING4' => 5481,
        'DANHAODIJIUMING5' => 5482,
        'DANHAODIJIUMING6' => 5483,
        'DANHAODIJIUMING7' => 5484,
        'DANHAODIJIUMING8' => 5485,
        'DANHAODIJIUMING9' => 5486,
        'DANHAODIJIUMING10' => 5487,
        'LIANGMIANDISHIMINGDA' => 5488,
        'LIANGMIANDISHIMINGXIAO' => 5489,
        'LIANGMIANDISHIMINGDAN' => 5490,
        'LIANGMIANDISHIMINGSHUANG' => 5491,
        'DANHAODISHIMING1' => 5492,
        'DANHAODISHIMING2' => 5493,
        'DANHAODISHIMING3' => 5494,
        'DANHAODISHIMING4' => 5495,
        'DANHAODISHIMING5' => 5496,
        'DANHAODISHIMING6' => 5497,
        'DANHAODISHIMING7' => 5498,
        'DANHAODISHIMING8' => 5499,
        'DANHAODISHIMING9' => 5500,
        'DANHAODISHIMING10' => 5501
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
        $table = 'game_ksft';
        $gameName = '快速飞艇';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'ksft killing...');
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
