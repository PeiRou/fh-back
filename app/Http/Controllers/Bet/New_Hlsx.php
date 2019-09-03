<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/5
 * Time: 上午9:19
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySSC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Hlsx extends Excel
{
    protected $arrPlay_id = array(245510676,245510677,245510678,245510679,245510680,245510681,245510682,245610683,245610684,245610685,245610686,245610687,245610688,245610689,245610690,245610691,245610692,245610693,245610694,245610695,245610696,245710697,245710698,245710699,245710700,245710701,245710702,245710703,245710704,245710705,245710706,245710707,245710708,245710709,245710710,245810711,245810712,245810713,245810714,245810715,245810716,245810717,245810718,245810719,245810720,245810721,245810722,245810723,245810724,245910725,245910726,245910727,245910728,245910729,245910730,245910731,245910732,245910733,245910734,245910735,245910736,245910737,245910738,246010739,246010740,246010741,246010742,246010743,246010744,246010745,246010746,246010747,246010748,246010749,246010750,246010751,246010752,246110753,246110754,246110755,246110756,246110757,246210758,246210759,246210760,246210761,246210762,246310763,246310764,246310765,246310766,246310767);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' => 455,
        'DIYIQIU' => 456,
        'DIERQIU' => 457,
        'DISANQIU' => 458,
        'DISIQIU' => 459,
        'DIWUQIU' => 460,
        'QIANSAN' => 461,
        'ZHONGSAN' => 462,
        'HOUSAN' => 463
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 10676,
        'ZONGHEXIAO' => 10677,
        'ZONGHEDAN' => 10678,
        'ZONGHESHUANG' => 10679,
        'LONG' => 10680,
        'HU' => 10681,
        'HE' => 10682,
        'DIYIQIU0' => 10683,
        'DIYIQIU1' => 10684,
        'DIYIQIU2' => 10685,
        'DIYIQIU3' => 10686,
        'DIYIQIU4' => 10687,
        'DIYIQIU5' => 10688,
        'DIYIQIU6' => 10689,
        'DIYIQIU7' => 10690,
        'DIYIQIU8' => 10691,
        'DIYIQIU9' => 10692,
        'DIYIQIUDA' => 10693,
        'DIYIQIUXIAO' => 10694,
        'DIYIQIUDAN' => 10695,
        'DIYIQIUSHUANG' => 10696,
        'DIERQIU0' => 10697,
        'DIERQIU1' => 10698,
        'DIERQIU2' => 10699,
        'DIERQIU3' => 10700,
        'DIERQIU4' => 10701,
        'DIERQIU5' => 10702,
        'DIERQIU6' => 10703,
        'DIERQIU7' => 10704,
        'DIERQIU8' => 10705,
        'DIERQIU9' => 10706,
        'DIERQIUDA' => 10707,
        'DIERQIUXIAO' => 10708,
        'DIERQIUDAN' => 10709,
        'DIERQIUSHUANG' => 10710,
        'DISANQIU0' => 10711,
        'DISANQIU1' => 10712,
        'DISANQIU2' => 10713,
        'DISANQIU3' => 10714,
        'DISANQIU4' => 10715,
        'DISANQIU5' => 10716,
        'DISANQIU6' => 10717,
        'DISANQIU7' => 10718,
        'DISANQIU8' => 10719,
        'DISANQIU9' => 10720,
        'DISANQIUDA' => 10721,
        'DISANQIUXIAO' => 10722,
        'DISANQIUDAN' => 10723,
        'DISANQIUSHUANG' => 10724,
        'DISIQIU0' => 10725,
        'DISIQIU1' => 10726,
        'DISIQIU2' => 10727,
        'DISIQIU3' => 10728,
        'DISIQIU4' => 10729,
        'DISIQIU5' => 10730,
        'DISIQIU6' => 10731,
        'DISIQIU7' => 10732,
        'DISIQIU8' => 10733,
        'DISIQIU9' => 10734,
        'DISIQIUDA' => 10735,
        'DISIQIUXIAO' => 10736,
        'DISIQIUDAN' => 10737,
        'DISIQIUSHUANG' => 10738,
        'DIWUQIU0' => 10739,
        'DIWUQIU1' => 10740,
        'DIWUQIU2' => 10741,
        'DIWUQIU3' => 10742,
        'DIWUQIU4' => 10743,
        'DIWUQIU5' => 10744,
        'DIWUQIU6' => 10745,
        'DIWUQIU7' => 10746,
        'DIWUQIU8' => 10747,
        'DIWUQIU9' => 10748,
        'DIWUQIUDA' => 10749,
        'DIWUQIUXIAO' => 10750,
        'DIWUQIUDAN' => 10751,
        'DIWUQIUSHUANG' => 10752,
        'QIANSANBAOZI' => 10753,
        'QIANSANSHUNZI' => 10754,
        'QIANSANDUIZI' => 10755,
        'QIANSANBANSHUN' => 10756,
        'QIANSANZALIU' => 10757,
        'ZHONGSANBAOZI' => 10758,
        'ZHONGSANSHUNZI' => 10759,
        'ZHONGSANDUIZI' => 10760,
        'ZHONGSANBANSHUN' => 10761,
        'ZHONGSANZALIU' => 10762,
        'HOUSANBAOZI' => 10763,
        'HOUSANSHUNZI' => 10764,
        'HOUSANDUIZI' => 10765,
        'HOUSANBANSHUN' => 10766,
        'HOUSANZALIU' => 10767
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $SSC = new ExcelLotterySSC();
        $SSC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $SSC->NUM1($gameId,$win);
        $SSC->NUM2($gameId,$win);
        $SSC->NUM3($gameId,$win);
        $SSC->NUM4($gameId,$win);
        $SSC->NUM5($gameId,$win);
        $SSC->NUM1_DXDS($gameId,$win);
        $SSC->NUM2_DXDS($gameId,$win);
        $SSC->NUM3_DXDS($gameId,$win);
        $SSC->NUM4_DXDS($gameId,$win);
        $SSC->NUM5_DXDS($gameId,$win);
        $SSC->ZHDXDS($gameId,$win);
        $SSC->QIANSAN($gameId,$win);
        $SSC->ZHONGSAN($gameId,$win);
        $SSC->HOUSAN($gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_hlsx';
        $gameName = '欢乐生肖';
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