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

class New_Yfsc extends Excel
{
    protected $arrPlay_id = array(90848111002,90848111003,90848111004,90848111005,90848111006,90848111007,90848111008,90848111009,90848111010,90848111011,90848111012,90848111013,90848111014,90848111015,90848111016,90848111017,90848111018,90848111019,90848111020,90848111021,90848111022,90848211023,90848211024,90848211025,90848211026,90848211027,90848211028,90848211029,90848211030,90848211031,90848211032,90848211033,90848211034,90848211035,90848211036,90848211037,90848211038,90848311039,90848311040,90848311041,90848311042,90848311043,90848311044,90848311045,90848311046,90848311047,90848311048,90848311049,90848311050,90848311051,90848311052,90848311053,90848311054,90848411055,90848411056,90848411057,90848411058,90848411059,90848411060,90848411061,90848411062,90848411063,90848411064,90848411065,90848411066,90848411067,90848411068,90848411069,90848411070,90848511071,90848511072,90848511073,90848511074,90848511075,90848511076,90848511077,90848511078,90848511079,90848511080,90848511081,90848511082,90848511083,90848511084,90848511085,90848511086,90848611087,90848611088,90848611089,90848611090,90848611091,90848611092,90848611093,90848611094,90848611095,90848611096,90848611097,90848611098,90848611099,90848611100,90848611101,90848611102,90848711103,90848711104,90848711105,90848711106,90848711107,90848711108,90848711109,90848711110,90848711111,90848711112,90848711113,90848711114,90848711115,90848711116,90848811117,90848811118,90848811119,90848811120,90848811121,90848811122,90848811123,90848811124,90848811125,90848811126,90848811127,90848811128,90848811129,90848811130,90848911131,90848911132,90848911133,90848911134,90848911135,90848911136,90848911137,90848911138,90848911139,90848911140,90848911141,90848911142,90848911143,90848911144,90849011145,90849011146,90849011147,90849011148,90849011149,90849011150,90849011151,90849011152,90849011153,90849011154,90849011155,90849011156,90849011157,90849011158,90849111159,90849111160,90849111161,90849111162,90849111163,90849111164,90849111165,90849111166,90849111167,90849111168,90849111169,90849111170,90849111171,90849111172);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' => 481,
        'GUANJUN' => 482,
        'YAJUN' => 483,
        'DISANMING' => 484,
        'DISIMING' => 485,
        'DIWUMING' => 486,
        'DILIUMING' => 487,
        'DIQIMING' => 488,
        'DIBAMING' => 489,
        'DIJIUMING' => 490,
        'DISHIMING' => 491
    );
    protected $arrPlayId = array(
        'GUANYADA' => 11002,
        'GUANYAXIAO' => 11003,
        'GUANYADAN' => 11004,
        'GUANYASHUANG' => 11005,
        'GUANYAJUNHE3' => 11006,
        'GUANYAJUNHE4' => 11007,
        'GUANYAJUNHE5' => 11008,
        'GUANYAJUNHE6' => 11009,
        'GUANYAJUNHE7' => 11010,
        'GUANYAJUNHE8' => 11011,
        'GUANYAJUNHE9' => 11012,
        'GUANYAJUNHE10' => 11013,
        'GUANYAJUNHE11' => 11014,
        'GUANYAJUNHE12' => 11015,
        'GUANYAJUNHE13' => 11016,
        'GUANYAJUNHE14' => 11017,
        'GUANYAJUNHE15' => 11018,
        'GUANYAJUNHE16' => 11019,
        'GUANYAJUNHE17' => 11020,
        'GUANYAJUNHE18' => 11021,
        'GUANYAJUNHE19' => 11022,
        'LIANGMIANGUANJUNDA' => 11023,
        'LIANGMIANGUANJUNXIAO' => 11024,
        'LIANGMIANGUANJUNDAN' => 11025,
        'LIANGMIANGUANJUNSHUANG' => 11026,
        'LIANGMIANGUANJUNLONG' => 11027,
        'LIANGMIANGUANJUNHU' => 11028,
        'DANHAOGUANJUN1' => 11029,
        'DANHAOGUANJUN2' => 11030,
        'DANHAOGUANJUN3' => 11031,
        'DANHAOGUANJUN4' => 11032,
        'DANHAOGUANJUN5' => 11033,
        'DANHAOGUANJUN6' => 11034,
        'DANHAOGUANJUN7' => 11035,
        'DANHAOGUANJUN8' => 11036,
        'DANHAOGUANJUN9' => 11037,
        'DANHAOGUANJUN10' => 11038,
        'LIANGMIANYAJUNDA' => 11039,
        'LIANGMIANYAJUNXIAO' => 11040,
        'LIANGMIANYAJUNDAN' => 11041,
        'LIANGMIANYAJUNSHUANG' => 11042,
        'LIANGMIANYAJUNLONG' => 11043,
        'LIANGMIANYAJUNHU' => 11044,
        'DANHAOYAJUN1' => 11045,
        'DANHAOYAJUN2' => 11046,
        'DANHAOYAJUN3' => 11047,
        'DANHAOYAJUN4' => 11048,
        'DANHAOYAJUN5' => 11049,
        'DANHAOYAJUN6' => 11050,
        'DANHAOYAJUN7' => 11051,
        'DANHAOYAJUN8' => 11052,
        'DANHAOYAJUN9' => 11053,
        'DANHAOYAJUN10' => 11054,
        'LIANGMIANDISANMINGDA' => 11055,
        'LIANGMIANDISANMINGXIAO' => 11056,
        'LIANGMIANDISANMINGDAN' => 11057,
        'LIANGMIANDISANMINGSHUANG' => 11058,
        'LIANGMIANDISANMINGLONG' => 11059,
        'LIANGMIANDISANMINGHU' => 11060,
        'DANHAODISANMING1' => 11061,
        'DANHAODISANMING2' => 11062,
        'DANHAODISANMING3' => 11063,
        'DANHAODISANMING4' => 11064,
        'DANHAODISANMING5' => 11065,
        'DANHAODISANMING6' => 11066,
        'DANHAODISANMING7' => 11067,
        'DANHAODISANMING8' => 11068,
        'DANHAODISANMING9' => 11069,
        'DANHAODISANMING10' => 11070,
        'LIANGMIANDISIMINGDA' => 11071,
        'LIANGMIANDISIMINGXIAO' => 11072,
        'LIANGMIANDISIMINGDAN' => 11073,
        'LIANGMIANDISIMINGSHUANG' => 11074,
        'LIANGMIANDISIMINGLONG' => 11075,
        'LIANGMIANDISIMINGHU' => 11076,
        'DANHAODISIMING1' => 11077,
        'DANHAODISIMING2' => 11078,
        'DANHAODISIMING3' => 11079,
        'DANHAODISIMING4' => 11080,
        'DANHAODISIMING5' => 11081,
        'DANHAODISIMING6' => 11082,
        'DANHAODISIMING7' => 11083,
        'DANHAODISIMING8' => 11084,
        'DANHAODISIMING9' => 11085,
        'DANHAODISIMING10' => 11086,
        'LIANGMIANDIWUMINGDA' => 11087,
        'LIANGMIANDIWUMINGXIAO' => 11088,
        'LIANGMIANDIWUMINGDAN' => 11089,
        'LIANGMIANDIWUMINGSHUANG' => 11090,
        'LIANGMIANDIWUMINGLONG' => 11091,
        'LIANGMIANDIWUMINGHU' => 11092,
        'DANHAODIWUMING1' => 11093,
        'DANHAODIWUMING2' => 11094,
        'DANHAODIWUMING3' => 11095,
        'DANHAODIWUMING4' => 11096,
        'DANHAODIWUMING5' => 11097,
        'DANHAODIWUMING6' => 11098,
        'DANHAODIWUMING7' => 11099,
        'DANHAODIWUMING8' => 11100,
        'DANHAODIWUMING9' => 11101,
        'DANHAODIWUMING10' => 11102,
        'LIANGMIANDILIUMINGDA' => 11103,
        'LIANGMIANDILIUMINGXIAO' => 11104,
        'LIANGMIANDILIUMINGDAN' => 11105,
        'LIANGMIANDILIUMINGSHUANG' => 11106,
        'DANHAODILIUMING1' => 11107,
        'DANHAODILIUMING2' => 11108,
        'DANHAODILIUMING3' => 11109,
        'DANHAODILIUMING4' => 11110,
        'DANHAODILIUMING5' => 11111,
        'DANHAODILIUMING6' => 11112,
        'DANHAODILIUMING7' => 11113,
        'DANHAODILIUMING8' => 11114,
        'DANHAODILIUMING9' => 11115,
        'DANHAODILIUMING10' => 11116,
        'LIANGMIANDIQIMINGDA' => 11117,
        'LIANGMIANDIQIMINGXIAO' => 11118,
        'LIANGMIANDIQIMINGDAN' => 11119,
        'LIANGMIANDIQIMINGSHUANG' => 11120,
        'DANHAODIQIMING1' => 11121,
        'DANHAODIQIMING2' => 11122,
        'DANHAODIQIMING3' => 11123,
        'DANHAODIQIMING4' => 11124,
        'DANHAODIQIMING5' => 11125,
        'DANHAODIQIMING6' => 11126,
        'DANHAODIQIMING7' => 11127,
        'DANHAODIQIMING8' => 11128,
        'DANHAODIQIMING9' => 11129,
        'DANHAODIQIMING10' => 11130,
        'LIANGMIANDIBAMINGDA' => 11131,
        'LIANGMIANDIBAMINGXIAO' => 11132,
        'LIANGMIANDIBAMINGDAN' => 11133,
        'LIANGMIANDIBAMINGSHUANG' => 11134,
        'DANHAODIBAMING1' => 11135,
        'DANHAODIBAMING2' => 11136,
        'DANHAODIBAMING3' => 11137,
        'DANHAODIBAMING4' => 11138,
        'DANHAODIBAMING5' => 11139,
        'DANHAODIBAMING6' => 11140,
        'DANHAODIBAMING7' => 11141,
        'DANHAODIBAMING8' => 11142,
        'DANHAODIBAMING9' => 11143,
        'DANHAODIBAMING10' => 11144,
        'LIANGMIANDIJIUMINGDA' => 11145,
        'LIANGMIANDIJIUMINGXIAO' => 11146,
        'LIANGMIANDIJIUMINGDAN' => 11147,
        'LIANGMIANDIJIUMINGSHUANG' => 11148,
        'DANHAODIJIUMING1' => 11149,
        'DANHAODIJIUMING2' => 11150,
        'DANHAODIJIUMING3' => 11151,
        'DANHAODIJIUMING4' => 11152,
        'DANHAODIJIUMING5' => 11153,
        'DANHAODIJIUMING6' => 11154,
        'DANHAODIJIUMING7' => 11155,
        'DANHAODIJIUMING8' => 11156,
        'DANHAODIJIUMING9' => 11157,
        'DANHAODIJIUMING10' => 11158,
        'LIANGMIANDISHIMINGDA' => 11159,
        'LIANGMIANDISHIMINGXIAO' => 11160,
        'LIANGMIANDISHIMINGDAN' => 11161,
        'LIANGMIANDISHIMINGSHUANG' => 11162,
        'DANHAODISHIMING1' => 11163,
        'DANHAODISHIMING2' => 11164,
        'DANHAODISHIMING3' => 11165,
        'DANHAODISHIMING4' => 11166,
        'DANHAODISHIMING5' => 11167,
        'DANHAODISHIMING6' => 11168,
        'DANHAODISHIMING7' => 11169,
        'DANHAODISHIMING8' => 11170,
        'DANHAODISHIMING9' => 11171,
        'DANHAODISHIMING10' => 11172
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
        $table = 'game_yfsc';
        $gameName = '一分赛车';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'yfsc killing...');
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