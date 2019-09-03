<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 2019/07/23
 * Time: 下午20:24
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryKL8;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Twbgc extends Excel
{
    protected $arrPlay_id = array(4244710534,4244710535,4244710536,4244710537,4244710538,4244710539,4244710540,4244710541,4244710542,4244810543,4244810544,4244810545,4244910546,4244910547,4244910548,4245010549,4245010550,4245010551,4245010552,4245010553,4245110554,4245110555,4245110556,4245110557,4245110558,4245110559,4245110560,4245110561,4245110562,4245110563,4245110564,4245110565,4245110566,4245110567,4245110568,4245110569,4245110570,4245110571,4245110572,4245110573,4245110574,4245110575,4245110576,4245110577,4245110578,4245110579,4245110580,4245110581,4245110582,4245110583,4245110584,4245110585,4245110586,4245110587,4245110588,4245110589,4245110590,4245110591,4245110592,4245110593,4245110594,4245110595,4245110596,4245110597,4245110598,4245110599,4245110600,4245110601,4245110602,4245110603,4245110604,4245110605,4245110606,4245110607,4245110608,4245110609,4245110610,4245110611,4245110612,4245110613,4245110614,4245110615,4245110616,4245110617,4245110618,4245110619,4245110620,4245110621,4245110622,4245110623,4245110624,4245110625,4245110626,4245110627,4245110628,4245110629,4245110630,4245110631,4245110632,4245110633);
    protected $arrPlayCate = array(
        'ZH' => 447,
        'QHH' => 448,
        'DSH' => 449,
        'WX' => 450,
        'ZM' => 451,
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 10534,
        'ZONGHEXIAO' => 10535,
        'ZONGHEDAN' => 10536,
        'ZONGHESHUANG' => 10537,
        'ZONGHE810' => 10538,
        'ZONGDADAN' => 10539,
        'ZONGDASHUANG' => 10540,
        'ZONGXIAODAN' => 10541,
        'ZONGXIAOSHUANG' => 10542,
        'QIAN_DUO' => 10543,
        'HOU_DUO' => 10544,
        'QIANHOUHE' => 10545,
        'DAN_DUO' => 10546,
        'SHUANG_DUO' => 10547,
        'DANSHUANG_HE' => 10548,
        'JIN' => 10549,
        'MU' => 10550,
        'SHUI' => 10551,
        'HUO' => 10552,
        'TU' => 10553,
        'ZHENGMA1' => 10554,
        'ZHENGMA2' => 10555,
        'ZHENGMA3' => 10556,
        'ZHENGMA4' => 10557,
        'ZHENGMA5' => 10558,
        'ZHENGMA6' => 10559,
        'ZHENGMA7' => 10560,
        'ZHENGMA8' => 10561,
        'ZHENGMA9' => 10562,
        'ZHENGMA10' => 10563,
        'ZHENGMA11' => 10564,
        'ZHENGMA12' => 10565,
        'ZHENGMA13' => 10566,
        'ZHENGMA14' => 10567,
        'ZHENGMA15' => 10568,
        'ZHENGMA16' => 10569,
        'ZHENGMA17' => 10570,
        'ZHENGMA18' => 10571,
        'ZHENGMA19' => 10572,
        'ZHENGMA20' => 10573,
        'ZHENGMA21' => 10574,
        'ZHENGMA22' => 10575,
        'ZHENGMA23' => 10576,
        'ZHENGMA24' => 10577,
        'ZHENGMA25' => 10578,
        'ZHENGMA26' => 10579,
        'ZHENGMA27' => 10580,
        'ZHENGMA28' => 10581,
        'ZHENGMA29' => 10582,
        'ZHENGMA30' => 10583,
        'ZHENGMA31' => 10584,
        'ZHENGMA32' => 10585,
        'ZHENGMA33' => 10586,
        'ZHENGMA34' => 10587,
        'ZHENGMA35' => 10588,
        'ZHENGMA36' => 10589,
        'ZHENGMA37' => 10590,
        'ZHENGMA38' => 10591,
        'ZHENGMA39' => 10592,
        'ZHENGMA40' => 10593,
        'ZHENGMA41' => 10594,
        'ZHENGMA42' => 10595,
        'ZHENGMA43' => 10596,
        'ZHENGMA44' => 10597,
        'ZHENGMA45' => 10598,
        'ZHENGMA46' => 10599,
        'ZHENGMA47' => 10600,
        'ZHENGMA48' => 10601,
        'ZHENGMA49' => 10602,
        'ZHENGMA50' => 10603,
        'ZHENGMA51' => 10604,
        'ZHENGMA52' => 10605,
        'ZHENGMA53' => 10606,
        'ZHENGMA54' => 10607,
        'ZHENGMA55' => 10608,
        'ZHENGMA56' => 10609,
        'ZHENGMA57' => 10610,
        'ZHENGMA58' => 10611,
        'ZHENGMA59' => 10612,
        'ZHENGMA60' => 10613,
        'ZHENGMA61' => 10614,
        'ZHENGMA62' => 10615,
        'ZHENGMA63' => 10616,
        'ZHENGMA64' => 10617,
        'ZHENGMA65' => 10618,
        'ZHENGMA66' => 10619,
        'ZHENGMA67' => 10620,
        'ZHENGMA68' => 10621,
        'ZHENGMA69' => 10622,
        'ZHENGMA70' => 10623,
        'ZHENGMA71' => 10624,
        'ZHENGMA72' => 10625,
        'ZHENGMA73' => 10626,
        'ZHENGMA74' => 10627,
        'ZHENGMA75' => 10628,
        'ZHENGMA76' => 10629,
        'ZHENGMA77' => 10630,
        'ZHENGMA78' => 10631,
        'ZHENGMA79' => 10632,
        'ZHENGMA80' => 10633,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $KL8 = new ExcelLotteryKL8();
        $KL8->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $KL8->ZM($openCode,$gameId,$win);
        $KL8->ZH($openCode,$gameId,$win);
        $KL8->QHH($openCode,$gameId,$win);
        $KL8->DSH($openCode,$gameId,$win);
        $KL8->WX($openCode,$gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_twbgc';
        $gameName = '台湾宾果彩';
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