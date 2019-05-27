<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 上午10:21
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_PK10 extends Excel
{
    protected $arrPlay_id = array(5010340,5010341,5010342,5010343,5010344,5010345,5010346,5010347,5010348,5010349,5010350,5010351,5010352,5010353,5010354,5010355,5010356,5010357,5010358,5010359,5010360,5011361,5011362,5011363,5011364,5011365,5011366,5011367,5011368,5011369,5011370,5011371,5011372,5011373,5011374,5011375,5011376,5012377,5012378,5012379,5012380,5012381,5012382,5012383,5012384,5012385,5012386,5012387,5012388,5012389,5012390,5012391,5012392,5013393,5013394,5013395,5013396,5013397,5013398,5013399,5013400,5013401,5013402,5013403,5013404,5013405,5013406,5013407,5013408,5014409,5014410,5014411,5014412,5014413,5014414,5014415,5014416,5014417,5014418,5014419,5014420,5014421,5014422,5014423,5014424,5015425,5015426,5015427,5015428,5015429,5015430,5015431,5015432,5015433,5015434,5015435,5015436,5015437,5015438,5015439,5015440,5016441,5016442,5016443,5016444,5016445,5016446,5016447,5016448,5016449,5016450,5016451,5016452,5016453,5016454,5017455,5017456,5017457,5017458,5017459,5017460,5017461,5017462,5017463,5017464,5017465,5017466,5017467,5017468,5018469,5018470,5018471,5018472,5018473,5018474,5018475,5018476,5018477,5018478,5018479,5018480,5018481,5018482,5019483,5019484,5019485,5019486,5019487,5019488,5019489,5019490,5019491,5019492,5019493,5019494,5019495,5019496,5020497,5020498,5020499,5020500,5020501,5020502,5020503,5020504,5020505,5020506,5020507,5020508,5020509,5020510);
    protected $arrPlayCate = array(
        'GUANYAJUNHE' =>10,
        'GUANJUN' =>11,
        'YAJUN' =>12,
        'DISANMING' =>13,
        'DISIMING' =>14,
        'DIWUMING' =>15,
        'DILIUMING' =>16,
        'DIQIMING' =>17,
        'DIBAMING' =>18,
        'DIJIUMING' =>19,
        'DISHIMING' =>20
    );
    protected $arrPlayId = array(
        'GUANYADA' => 340,
        'GUANYAXIAO' => 341,
        'GUANYADAN' => 342,
        'GUANYASHUANG' => 343,
        'GUANYAJUNHE3' => 344,
        'GUANYAJUNHE4' => 345,
        'GUANYAJUNHE5' => 346,
        'GUANYAJUNHE6' => 347,
        'GUANYAJUNHE7' => 348,
        'GUANYAJUNHE8' => 349,
        'GUANYAJUNHE9' => 350,
        'GUANYAJUNHE10' => 351,
        'GUANYAJUNHE11' => 352,
        'GUANYAJUNHE12' => 353,
        'GUANYAJUNHE13' => 354,
        'GUANYAJUNHE14' => 355,
        'GUANYAJUNHE15' => 356,
        'GUANYAJUNHE16' => 357,
        'GUANYAJUNHE17' => 358,
        'GUANYAJUNHE18' => 359,
        'GUANYAJUNHE19' => 360,
        'LIANGMIANGUANJUNDA' => 361,
        'LIANGMIANGUANJUNXIAO' => 362,
        'LIANGMIANGUANJUNDAN' => 363,
        'LIANGMIANGUANJUNSHUANG' => 364,
        'LIANGMIANGUANJUNLONG' => 365,
        'LIANGMIANGUANJUNHU' => 366,
        'DANHAOGUANJUN1' => 367,
        'DANHAOGUANJUN2' => 368,
        'DANHAOGUANJUN3' => 369,
        'DANHAOGUANJUN4' => 370,
        'DANHAOGUANJUN5' => 371,
        'DANHAOGUANJUN6' => 372,
        'DANHAOGUANJUN7' => 373,
        'DANHAOGUANJUN8' => 374,
        'DANHAOGUANJUN9' => 375,
        'DANHAOGUANJUN10' => 376,
        'LIANGMIANYAJUNDA' => 377,
        'LIANGMIANYAJUNXIAO' => 378,
        'LIANGMIANYAJUNDAN' => 379,
        'LIANGMIANYAJUNSHUANG' => 380,
        'LIANGMIANYAJUNLONG' => 381,
        'LIANGMIANYAJUNHU' => 382,
        'DANHAOYAJUN1' => 383,
        'DANHAOYAJUN2' => 384,
        'DANHAOYAJUN3' => 385,
        'DANHAOYAJUN4' => 386,
        'DANHAOYAJUN5' => 387,
        'DANHAOYAJUN6' => 388,
        'DANHAOYAJUN7' => 389,
        'DANHAOYAJUN8' => 390,
        'DANHAOYAJUN9' => 391,
        'DANHAOYAJUN10' => 392,
        'LIANGMIANDISANMINGDA' => 393,
        'LIANGMIANDISANMINGXIAO' => 394,
        'LIANGMIANDISANMINGDAN' => 395,
        'LIANGMIANDISANMINGSHUANG' => 396,
        'LIANGMIANDISANMINGLONG' => 397,
        'LIANGMIANDISANMINGHU' => 398,
        'DANHAODISANMING1' => 399,
        'DANHAODISANMING2' => 400,
        'DANHAODISANMING3' => 401,
        'DANHAODISANMING4' => 402,
        'DANHAODISANMING5' => 403,
        'DANHAODISANMING6' => 404,
        'DANHAODISANMING7' => 405,
        'DANHAODISANMING8' => 406,
        'DANHAODISANMING9' => 407,
        'DANHAODISANMING10' => 408,
        'LIANGMIANDISIMINGDA' => 409,
        'LIANGMIANDISIMINGXIAO' => 410,
        'LIANGMIANDISIMINGDAN' => 411,
        'LIANGMIANDISIMINGSHUANG' => 412,
        'LIANGMIANDISIMINGLONG' => 413,
        'LIANGMIANDISIMINGHU' => 414,
        'DANHAODISIMING1' => 415,
        'DANHAODISIMING2' => 416,
        'DANHAODISIMING3' => 417,
        'DANHAODISIMING4' => 418,
        'DANHAODISIMING5' => 419,
        'DANHAODISIMING6' => 420,
        'DANHAODISIMING7' => 421,
        'DANHAODISIMING8' => 422,
        'DANHAODISIMING9' => 423,
        'DANHAODISIMING10' => 424,
        'LIANGMIANDIWUMINGDA' => 425,
        'LIANGMIANDIWUMINGXIAO' => 426,
        'LIANGMIANDIWUMINGDAN' => 427,
        'LIANGMIANDIWUMINGSHUANG' => 428,
        'LIANGMIANDIWUMINGLONG' => 429,
        'LIANGMIANDIWUMINGHU' => 430,
        'DANHAODIWUMING1' => 431,
        'DANHAODIWUMING2' => 432,
        'DANHAODIWUMING3' => 433,
        'DANHAODIWUMING4' => 434,
        'DANHAODIWUMING5' => 435,
        'DANHAODIWUMING6' => 436,
        'DANHAODIWUMING7' => 437,
        'DANHAODIWUMING8' => 438,
        'DANHAODIWUMING9' => 439,
        'DANHAODIWUMING10' => 440,
        'LIANGMIANDILIUMINGDA' => 441,
        'LIANGMIANDILIUMINGXIAO' => 442,
        'LIANGMIANDILIUMINGDAN' => 443,
        'LIANGMIANDILIUMINGSHUANG' => 444,
        'DANHAODILIUMING1' => 445,
        'DANHAODILIUMING2' => 446,
        'DANHAODILIUMING3' => 447,
        'DANHAODILIUMING4' => 448,
        'DANHAODILIUMING5' => 449,
        'DANHAODILIUMING6' => 450,
        'DANHAODILIUMING7' => 451,
        'DANHAODILIUMING8' => 452,
        'DANHAODILIUMING9' => 453,
        'DANHAODILIUMING10' => 454,
        'LIANGMIANDIQIMINGDA' => 455,
        'LIANGMIANDIQIMINGXIAO' => 456,
        'LIANGMIANDIQIMINGDAN' => 457,
        'LIANGMIANDIQIMINGSHUANG' => 458,
        'DANHAODIQIMING1' => 459,
        'DANHAODIQIMING2' => 460,
        'DANHAODIQIMING3' => 461,
        'DANHAODIQIMING4' => 462,
        'DANHAODIQIMING5' => 463,
        'DANHAODIQIMING6' => 464,
        'DANHAODIQIMING7' => 465,
        'DANHAODIQIMING8' => 466,
        'DANHAODIQIMING9' => 467,
        'DANHAODIQIMING10' => 468,
        'LIANGMIANDIBAMINGDA' => 469,
        'LIANGMIANDIBAMINGXIAO' => 470,
        'LIANGMIANDIBAMINGDAN' => 471,
        'LIANGMIANDIBAMINGSHUANG' => 472,
        'DANHAODIBAMING1' => 473,
        'DANHAODIBAMING2' => 474,
        'DANHAODIBAMING3' => 475,
        'DANHAODIBAMING4' => 476,
        'DANHAODIBAMING5' => 477,
        'DANHAODIBAMING6' => 478,
        'DANHAODIBAMING7' => 479,
        'DANHAODIBAMING8' => 480,
        'DANHAODIBAMING9' => 481,
        'DANHAODIBAMING10' => 482,
        'LIANGMIANDIJIUMINGDA' => 483,
        'LIANGMIANDIJIUMINGXIAO' => 484,
        'LIANGMIANDIJIUMINGDAN' => 485,
        'LIANGMIANDIJIUMINGSHUANG' => 486,
        'DANHAODIJIUMING1' => 487,
        'DANHAODIJIUMING2' => 488,
        'DANHAODIJIUMING3' => 489,
        'DANHAODIJIUMING4' => 490,
        'DANHAODIJIUMING5' => 491,
        'DANHAODIJIUMING6' => 492,
        'DANHAODIJIUMING7' => 493,
        'DANHAODIJIUMING8' => 494,
        'DANHAODIJIUMING9' => 495,
        'DANHAODIJIUMING10' => 496,
        'LIANGMIANDISHIMINGDA' => 497,
        'LIANGMIANDISHIMINGXIAO' => 498,
        'LIANGMIANDISHIMINGDAN' => 499,
        'LIANGMIANDISHIMINGSHUANG' => 500,
        'DANHAODISHIMING1' => 501,
        'DANHAODISHIMING2' => 502,
        'DANHAODISHIMING3' => 503,
        'DANHAODISHIMING4' => 504,
        'DANHAODISHIMING5' => 505,
        'DANHAODISHIMING6' => 506,
        'DANHAODISHIMING7' => 507,
        'DANHAODISHIMING8' => 508,
        'DANHAODISHIMING9' => 509,
        'DANHAODISHIMING10' => 510
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
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_bjpk10';
        $gameName = '北京PK10';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $win = $this->exc_play($openCode,$gameId);
            $bunko = $this->bunko($win,$gameId,$issue,false,$this->arrPlay_id,true);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                if($updateUserMoney == 1){
                    writeLog('New_Bet', $gameName . $issue . "结算出错");
                }
            }
        }
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