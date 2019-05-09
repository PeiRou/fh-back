<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/19
 * Time: 上午2:37
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Paoma extends Excel
{
    protected $arrPlay_id = array(991783286,991783287,991783288,991783289,991783290,991783291,991783292,991783293,991783294,991783295,991783296,991783297,991783298,991783299,991783300,991783301,991783302,991783303,991783304,991783305,991783306,991793307,991793308,991793309,991793310,991793311,991793312,991793313,991793314,991793315,991793316,991793317,991793318,991793319,991793320,991793321,991793322,991803323,991803324,991803325,991803326,991803327,991803328,991803329,991803330,991803331,991803332,991803333,991803334,991803335,991803336,991803337,991803338,991813339,991813340,991813341,991813342,991813343,991813344,991813345,991813346,991813347,991813348,991813349,991813350,991813351,991813352,991813353,991813354,991823355,991823356,991823357,991823358,991823359,991823360,991823361,991823362,991823363,991823364,991823365,991823366,991823367,991823368,991823369,991823370,991833371,991833372,991833373,991833374,991833375,991833376,991833377,991833378,991833379,991833380,991833381,991833382,991833383,991833384,991833385,991833386,991843387,991843388,991843389,991843390,991843391,991843392,991843393,991843394,991843395,991843396,991843397,991843398,991843399,991843400,991853401,991853402,991853403,991853404,991853405,991853406,991853407,991853408,991853409,991853410,991853411,991853412,991853413,991853414,991863415,991863416,991863417,991863418,991863419,991863420,991863421,991863422,991863423,991863424,991863425,991863426,991863427,991863428,991873429,991873430,991873431,991873432,991873433,991873434,991873435,991873436,991873437,991873438,991873439,991873440,991873441,991873442,991883443,991883444,991883445,991883446,991883447,991883448,991883449,991883450,991883451,991883452,991883453,991883454,991883455,991883456);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>178,
        'GUANJUN' =>179,
        'YAJUN' =>180,
        'DISANMING' =>181,
        'DISIMING' =>182,
        'DIWUMING' =>183,
        'DILIUMING' =>184,
        'DIQIMING' =>185,
        'DIBAMING' =>186,
        'DIJIUMING' =>187,
        'DISHIMING' =>188,
    );
    protected $arrPlayId = array(
        'GUANYADA' => 3286,
        'GUANYAXIAO' => 3287,
        'GUANYADAN' => 3288,
        'GUANYASHUANG' => 3289,
        'GUANYAJUNHE3' => 3290,
        'GUANYAJUNHE4' => 3291,
        'GUANYAJUNHE5' => 3292,
        'GUANYAJUNHE6' => 3293,
        'GUANYAJUNHE7' => 3294,
        'GUANYAJUNHE8' => 3295,
        'GUANYAJUNHE9' => 3296,
        'GUANYAJUNHE10' => 3297,
        'GUANYAJUNHE11' => 3298,
        'GUANYAJUNHE12' => 3299,
        'GUANYAJUNHE13' => 3300,
        'GUANYAJUNHE14' => 3301,
        'GUANYAJUNHE15' => 3302,
        'GUANYAJUNHE16' => 3303,
        'GUANYAJUNHE17' => 3304,
        'GUANYAJUNHE18' => 3305,
        'GUANYAJUNHE19' => 3306,
        'LIANGMIANGUANJUNDA' => 3307,
        'LIANGMIANGUANJUNXIAO' => 3308,
        'LIANGMIANGUANJUNDAN' => 3309,
        'LIANGMIANGUANJUNSHUANG' => 3310,
        'LIANGMIANGUANJUNLONG' => 3311,
        'LIANGMIANGUANJUNHU' => 3312,
        'DANHAOGUANJUN1' => 3313,
        'DANHAOGUANJUN2' => 3314,
        'DANHAOGUANJUN3' => 3315,
        'DANHAOGUANJUN4' => 3316,
        'DANHAOGUANJUN5' => 3317,
        'DANHAOGUANJUN6' => 3318,
        'DANHAOGUANJUN7' => 3319,
        'DANHAOGUANJUN8' => 3320,
        'DANHAOGUANJUN9' => 3321,
        'DANHAOGUANJUN10' => 3322,
        'LIANGMIANYAJUNDA' => 3323,
        'LIANGMIANYAJUNXIAO' => 3324,
        'LIANGMIANYAJUNDAN' => 3325,
        'LIANGMIANYAJUNSHUANG' => 3326,
        'LIANGMIANYAJUNLONG' => 3327,
        'LIANGMIANYAJUNHU' => 3328,
        'DANHAOYAJUN1' => 3329,
        'DANHAOYAJUN2' => 3330,
        'DANHAOYAJUN3' => 3331,
        'DANHAOYAJUN4' => 3332,
        'DANHAOYAJUN5' => 3333,
        'DANHAOYAJUN6' => 3334,
        'DANHAOYAJUN7' => 3335,
        'DANHAOYAJUN8' => 3336,
        'DANHAOYAJUN9' => 3337,
        'DANHAOYAJUN10' => 3338,
        'LIANGMIANDISANMINGDA' => 3339,
        'LIANGMIANDISANMINGXIAO' => 3340,
        'LIANGMIANDISANMINGDAN' => 3341,
        'LIANGMIANDISANMINGSHUANG' => 3342,
        'LIANGMIANDISANMINGLONG' => 3343,
        'LIANGMIANDISANMINGHU' => 3344,
        'DANHAODISANMING1' => 3345,
        'DANHAODISANMING2' => 3346,
        'DANHAODISANMING3' => 3347,
        'DANHAODISANMING4' => 3348,
        'DANHAODISANMING5' => 3349,
        'DANHAODISANMING6' => 3350,
        'DANHAODISANMING7' => 3351,
        'DANHAODISANMING8' => 3352,
        'DANHAODISANMING9' => 3353,
        'DANHAODISANMING10' => 3354,
        'LIANGMIANDISIMINGDA' => 3355,
        'LIANGMIANDISIMINGXIAO' => 3356,
        'LIANGMIANDISIMINGDAN' => 3357,
        'LIANGMIANDISIMINGSHUANG' => 3358,
        'LIANGMIANDISIMINGLONG' => 3359,
        'LIANGMIANDISIMINGHU' => 3360,
        'DANHAODISIMING1' => 3361,
        'DANHAODISIMING2' => 3362,
        'DANHAODISIMING3' => 3363,
        'DANHAODISIMING4' => 3364,
        'DANHAODISIMING5' => 3365,
        'DANHAODISIMING6' => 3366,
        'DANHAODISIMING7' => 3367,
        'DANHAODISIMING8' => 3368,
        'DANHAODISIMING9' => 3369,
        'DANHAODISIMING10' => 3370,
        'LIANGMIANDIWUMINGDA' => 3371,
        'LIANGMIANDIWUMINGXIAO' => 3372,
        'LIANGMIANDIWUMINGDAN' => 3373,
        'LIANGMIANDIWUMINGSHUANG' => 3374,
        'LIANGMIANDIWUMINGLONG' => 3375,
        'LIANGMIANDIWUMINGHU' => 3376,
        'DANHAODIWUMING1' => 3377,
        'DANHAODIWUMING2' => 3378,
        'DANHAODIWUMING3' => 3379,
        'DANHAODIWUMING4' => 3380,
        'DANHAODIWUMING5' => 3381,
        'DANHAODIWUMING6' => 3382,
        'DANHAODIWUMING7' => 3383,
        'DANHAODIWUMING8' => 3384,
        'DANHAODIWUMING9' => 3385,
        'DANHAODIWUMING10' => 3386,
        'LIANGMIANDILIUMINGDA' => 3387,
        'LIANGMIANDILIUMINGXIAO' => 3388,
        'LIANGMIANDILIUMINGDAN' => 3389,
        'LIANGMIANDILIUMINGSHUANG' => 3390,
        'DANHAODILIUMING1' => 3391,
        'DANHAODILIUMING2' => 3392,
        'DANHAODILIUMING3' => 3393,
        'DANHAODILIUMING4' => 3394,
        'DANHAODILIUMING5' => 3395,
        'DANHAODILIUMING6' => 3396,
        'DANHAODILIUMING7' => 3397,
        'DANHAODILIUMING8' => 3398,
        'DANHAODILIUMING9' => 3399,
        'DANHAODILIUMING10' => 3400,
        'LIANGMIANDIQIMINGDA' => 3401,
        'LIANGMIANDIQIMINGXIAO' => 3402,
        'LIANGMIANDIQIMINGDAN' => 3403,
        'LIANGMIANDIQIMINGSHUANG' => 3404,
        'DANHAODIQIMING1' => 3405,
        'DANHAODIQIMING2' => 3406,
        'DANHAODIQIMING3' => 3407,
        'DANHAODIQIMING4' => 3408,
        'DANHAODIQIMING5' => 3409,
        'DANHAODIQIMING6' => 3410,
        'DANHAODIQIMING7' => 3411,
        'DANHAODIQIMING8' => 3412,
        'DANHAODIQIMING9' => 3413,
        'DANHAODIQIMING10' => 3414,
        'LIANGMIANDIBAMINGDA' => 3415,
        'LIANGMIANDIBAMINGXIAO' => 3416,
        'LIANGMIANDIBAMINGDAN' => 3417,
        'LIANGMIANDIBAMINGSHUANG' => 3418,
        'DANHAODIBAMING1' => 3419,
        'DANHAODIBAMING2' => 3420,
        'DANHAODIBAMING3' => 3421,
        'DANHAODIBAMING4' => 3422,
        'DANHAODIBAMING5' => 3423,
        'DANHAODIBAMING6' => 3424,
        'DANHAODIBAMING7' => 3425,
        'DANHAODIBAMING8' => 3426,
        'DANHAODIBAMING9' => 3427,
        'DANHAODIBAMING10' => 3428,
        'LIANGMIANDIJIUMINGDA' => 3429,
        'LIANGMIANDIJIUMINGXIAO' => 3430,
        'LIANGMIANDIJIUMINGDAN' => 3431,
        'LIANGMIANDIJIUMINGSHUANG' => 3432,
        'DANHAODIJIUMING1' => 3433,
        'DANHAODIJIUMING2' => 3434,
        'DANHAODIJIUMING3' => 3435,
        'DANHAODIJIUMING4' => 3436,
        'DANHAODIJIUMING5' => 3437,
        'DANHAODIJIUMING6' => 3438,
        'DANHAODIJIUMING7' => 3439,
        'DANHAODIJIUMING8' => 3440,
        'DANHAODIJIUMING9' => 3441,
        'DANHAODIJIUMING10' => 3442,
        'LIANGMIANDISHIMINGDA' => 3443,
        'LIANGMIANDISHIMINGXIAO' => 3444,
        'LIANGMIANDISHIMINGDAN' => 3445,
        'LIANGMIANDISHIMINGSHUANG' => 3446,
        'DANHAODISHIMING1' => 3447,
        'DANHAODISHIMING2' => 3448,
        'DANHAODISHIMING3' => 3449,
        'DANHAODISHIMING4' => 3450,
        'DANHAODISHIMING5' => 3451,
        'DANHAODISHIMING6' => 3452,
        'DANHAODISHIMING7' => 3453,
        'DANHAODISHIMING8' => 3454,
        'DANHAODISHIMING9' => 3455,
        'DANHAODISHIMING10' => 3456
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
        $table = 'game_paoma';
        $gameName = '跑马';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'msssc killing...');
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