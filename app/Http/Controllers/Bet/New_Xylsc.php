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

class New_Xylsc extends Excel
{
    protected $arrPlay_id = array(90541610100,90541610101,90541610102,90541610103,90541610104,90541610105,90541610106,90541610107,90541610108,90541610109,90541610110,90541610111,90541610112,90541610113,90541610114,90541610115,90541610116,90541610117,90541610118,90541610119,90541610120,90541710121,90541710122,90541710123,90541710124,90541710125,90541710126,90541710127,90541710128,90541710129,90541710130,90541710131,90541710132,90541710133,90541710134,90541710135,90541710136,90541810137,90541810138,90541810139,90541810140,90541810141,90541810142,90541810143,90541810144,90541810145,90541810146,90541810147,90541810148,90541810149,90541810150,90541810151,90541810152,90541910153,90541910154,90541910155,90541910156,90541910157,90541910158,90541910159,90541910160,90541910161,90541910162,90541910163,90541910164,90541910165,90541910166,90541910167,90541910168,90542010169,90542010170,90542010171,90542010172,90542010173,90542010174,90542010175,90542010176,90542010177,90542010178,90542010179,90542010180,90542010181,90542010182,90542010183,90542010184,90542110185,90542110186,90542110187,90542110188,90542110189,90542110190,90542110191,90542110192,90542110193,90542110194,90542110195,90542110196,90542110197,90542110198,90542110199,90542110200,90542210201,90542210202,90542210203,90542210204,90542210205,90542210206,90542210207,90542210208,90542210209,90542210210,90542210211,90542210212,90542210213,90542210214,90542310215,90542310216,90542310217,90542310218,90542310219,90542310220,90542310221,90542310222,90542310223,90542310224,90542310225,90542310226,90542310227,90542310228,90542410229,90542410230,90542410231,90542410232,90542410233,90542410234,90542410235,90542410236,90542410237,90542410238,90542410239,90542410240,90542410241,90542410242,90542510243,90542510244,90542510245,90542510246,90542510247,90542510248,90542510249,90542510250,90542510251,90542510252,90542510253,90542510254,90542510255,90542510256,90542610257,90542610258,90542610259,90542610260,90542610261,90542610262,90542610263,90542610264,90542610265,90542610266,90542610267,90542610268,90542610269,90542610270);
    protected $arrPlayCate = array(
        'GUANYAJUNHE'=>416,
        'GUANJUN'=>417,
        'YAJUN'=>418,
        'DISANMING'=>419,
        'DISIMING'=>420,
        'DIWUMING'=>421,
        'DILIUMING'=>422,
        'DIQIMING'=>423,
        'DIBAMING'=>424,
        'DIJIUMING'=>425,
        'DISHIMING'=>426
    );
    protected $arrPlayId = array(
        'GUANYADA'=>10100,
        'GUANYAXIAO'=>10101,
        'GUANYADAN'=>10102,
        'GUANYASHUANG'=>10103,
        'GUANYAJUNHE3'=>10104,
        'GUANYAJUNHE4'=>10105,
        'GUANYAJUNHE5'=>10106,
        'GUANYAJUNHE6'=>10107,
        'GUANYAJUNHE7'=>10108,
        'GUANYAJUNHE8'=>10109,
        'GUANYAJUNHE9'=>10110,
        'GUANYAJUNHE10'=>10111,
        'GUANYAJUNHE11'=>10112,
        'GUANYAJUNHE12'=>10113,
        'GUANYAJUNHE13'=>10114,
        'GUANYAJUNHE14'=>10115,
        'GUANYAJUNHE15'=>10116,
        'GUANYAJUNHE16'=>10117,
        'GUANYAJUNHE17'=>10118,
        'GUANYAJUNHE18'=>10119,
        'GUANYAJUNHE19'=>10120,
        'LIANGMIANGUANJUNDA'=>10121,
        'LIANGMIANGUANJUNXIAO'=>10122,
        'LIANGMIANGUANJUNDAN'=>10123,
        'LIANGMIANGUANJUNSHUANG'=>10124,
        'LIANGMIANGUANJUNLONG'=>10125,
        'LIANGMIANGUANJUNHU'=>10126,
        'DANHAOGUANJUN1'=>10127,
        'DANHAOGUANJUN2'=>10128,
        'DANHAOGUANJUN3'=>10129,
        'DANHAOGUANJUN4'=>10130,
        'DANHAOGUANJUN5'=>10131,
        'DANHAOGUANJUN6'=>10132,
        'DANHAOGUANJUN7'=>10133,
        'DANHAOGUANJUN8'=>10134,
        'DANHAOGUANJUN9'=>10135,
        'DANHAOGUANJUN10'=>10136,
        'LIANGMIANYAJUNDA'=>10137,
        'LIANGMIANYAJUNXIAO'=>10138,
        'LIANGMIANYAJUNDAN'=>10139,
        'LIANGMIANYAJUNSHUANG'=>10140,
        'LIANGMIANYAJUNLONG'=>10141,
        'LIANGMIANYAJUNHU'=>10142,
        'DANHAOYAJUN1'=>10143,
        'DANHAOYAJUN2'=>10144,
        'DANHAOYAJUN3'=>10145,
        'DANHAOYAJUN4'=>10146,
        'DANHAOYAJUN5'=>10147,
        'DANHAOYAJUN6'=>10148,
        'DANHAOYAJUN7'=>10149,
        'DANHAOYAJUN8'=>10150,
        'DANHAOYAJUN9'=>10151,
        'DANHAOYAJUN10'=>10152,
        'LIANGMIANDISANMINGDA'=>10153,
        'LIANGMIANDISANMINGXIAO'=>10154,
        'LIANGMIANDISANMINGDAN'=>10155,
        'LIANGMIANDISANMINGSHUANG'=>10156,
        'LIANGMIANDISANMINGLONG'=>10157,
        'LIANGMIANDISANMINGHU'=>10158,
        'DANHAODISANMING1'=>10159,
        'DANHAODISANMING2'=>10160,
        'DANHAODISANMING3'=>10161,
        'DANHAODISANMING4'=>10162,
        'DANHAODISANMING5'=>10163,
        'DANHAODISANMING6'=>10164,
        'DANHAODISANMING7'=>10165,
        'DANHAODISANMING8'=>10166,
        'DANHAODISANMING9'=>10167,
        'DANHAODISANMING10'=>10168,
        'LIANGMIANDISIMINGDA'=>10169,
        'LIANGMIANDISIMINGXIAO'=>10170,
        'LIANGMIANDISIMINGDAN'=>10171,
        'LIANGMIANDISIMINGSHUANG'=>10172,
        'LIANGMIANDISIMINGLONG'=>10173,
        'LIANGMIANDISIMINGHU'=>10174,
        'DANHAODISIMING1'=>10175,
        'DANHAODISIMING2'=>10176,
        'DANHAODISIMING3'=>10177,
        'DANHAODISIMING4'=>10178,
        'DANHAODISIMING5'=>10179,
        'DANHAODISIMING6'=>10180,
        'DANHAODISIMING7'=>10181,
        'DANHAODISIMING8'=>10182,
        'DANHAODISIMING9'=>10183,
        'DANHAODISIMING10'=>10184,
        'LIANGMIANDIWUMINGDA'=>10185,
        'LIANGMIANDIWUMINGXIAO'=>10186,
        'LIANGMIANDIWUMINGDAN'=>10187,
        'LIANGMIANDIWUMINGSHUANG'=>10188,
        'LIANGMIANDIWUMINGLONG'=>10189,
        'LIANGMIANDIWUMINGHU'=>10190,
        'DANHAODIWUMING1'=>10191,
        'DANHAODIWUMING2'=>10192,
        'DANHAODIWUMING3'=>10193,
        'DANHAODIWUMING4'=>10194,
        'DANHAODIWUMING5'=>10195,
        'DANHAODIWUMING6'=>10196,
        'DANHAODIWUMING7'=>10197,
        'DANHAODIWUMING8'=>10198,
        'DANHAODIWUMING9'=>10199,
        'DANHAODIWUMING10'=>10200,
        'LIANGMIANDILIUMINGDA'=>10201,
        'LIANGMIANDILIUMINGXIAO'=>10202,
        'LIANGMIANDILIUMINGDAN'=>10203,
        'LIANGMIANDILIUMINGSHUANG'=>10204,
        'DANHAODILIUMING1'=>10205,
        'DANHAODILIUMING2'=>10206,
        'DANHAODILIUMING3'=>10207,
        'DANHAODILIUMING4'=>10208,
        'DANHAODILIUMING5'=>10209,
        'DANHAODILIUMING6'=>10210,
        'DANHAODILIUMING7'=>10211,
        'DANHAODILIUMING8'=>10212,
        'DANHAODILIUMING9'=>10213,
        'DANHAODILIUMING10'=>10214,
        'LIANGMIANDIQIMINGDA'=>10215,
        'LIANGMIANDIQIMINGXIAO'=>10216,
        'LIANGMIANDIQIMINGDAN'=>10217,
        'LIANGMIANDIQIMINGSHUANG'=>10218,
        'DANHAODIQIMING1'=>10219,
        'DANHAODIQIMING2'=>10220,
        'DANHAODIQIMING3'=>10221,
        'DANHAODIQIMING4'=>10222,
        'DANHAODIQIMING5'=>10223,
        'DANHAODIQIMING6'=>10224,
        'DANHAODIQIMING7'=>10225,
        'DANHAODIQIMING8'=>10226,
        'DANHAODIQIMING9'=>10227,
        'DANHAODIQIMING10'=>10228,
        'LIANGMIANDIBAMINGDA'=>10229,
        'LIANGMIANDIBAMINGXIAO'=>10230,
        'LIANGMIANDIBAMINGDAN'=>10231,
        'LIANGMIANDIBAMINGSHUANG'=>10232,
        'DANHAODIBAMING1'=>10233,
        'DANHAODIBAMING2'=>10234,
        'DANHAODIBAMING3'=>10235,
        'DANHAODIBAMING4'=>10236,
        'DANHAODIBAMING5'=>10237,
        'DANHAODIBAMING6'=>10238,
        'DANHAODIBAMING7'=>10239,
        'DANHAODIBAMING8'=>10240,
        'DANHAODIBAMING9'=>10241,
        'DANHAODIBAMING10'=>10242,
        'LIANGMIANDIJIUMINGDA'=>10243,
        'LIANGMIANDIJIUMINGXIAO'=>10244,
        'LIANGMIANDIJIUMINGDAN'=>10245,
        'LIANGMIANDIJIUMINGSHUANG'=>10246,
        'DANHAODIJIUMING1'=>10247,
        'DANHAODIJIUMING2'=>10248,
        'DANHAODIJIUMING3'=>10249,
        'DANHAODIJIUMING4'=>10250,
        'DANHAODIJIUMING5'=>10251,
        'DANHAODIJIUMING6'=>10252,
        'DANHAODIJIUMING7'=>10253,
        'DANHAODIJIUMING8'=>10254,
        'DANHAODIJIUMING9'=>10255,
        'DANHAODIJIUMING10'=>10256,
        'LIANGMIANDISHIMINGDA'=>10257,
        'LIANGMIANDISHIMINGXIAO'=>10258,
        'LIANGMIANDISHIMINGDAN'=>10259,
        'LIANGMIANDISHIMINGSHUANG'=>10260,
        'DANHAODISHIMING1'=>10261,
        'DANHAODISHIMING2'=>10262,
        'DANHAODISHIMING3'=>10263,
        'DANHAODISHIMING4'=>10264,
        'DANHAODISHIMING5'=>10265,
        'DANHAODISHIMING6'=>10266,
        'DANHAODISHIMING7'=>10267,
        'DANHAODISHIMING8'=>10268,
        'DANHAODISHIMING9'=>10269,
        'DANHAODISHIMING10'=>10270
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
        $table = 'game_xylsc';
        $gameName = '匈牙利赛车';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'xylsc killing...');
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
