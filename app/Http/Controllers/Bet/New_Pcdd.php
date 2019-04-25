<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/21
 * Time: 下午4:13
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryDD;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Pcdd extends Excel
{
    protected $arrPlay_id = array(66911741,66911742,66911743,66911744,66911745,66911746,66911747,66911748,66911749,66911750,66911751,66921752,66921753,66921754,66931755,66931756,66931757,66931758,66931759,66931760,66931761,66931762,66931763,66931764,66931765,66931766,66931767,66931768,66931769,66931770,66931771,66931772,66931773,66931774,66931775,66931776,66931777,66931778,66931779,66931780,66931781,66931782);
    protected $arrPlayCate = array(
        'HH' => 91,
        'BS' => 92,
        'TM' => 93,
    );
    protected $arrPlayId = array(
        'DA' => 1741,
        'XIAO' => 1742,
        'DAN' => 1743,
        'SHUANG' => 1744,
        'DADAN' => 1745,
        'DASHUANG' => 1746,
        'XIAODAN' => 1747,
        'XIAOSHUANG' => 1748,
        'JIDA' => 1749,
        'JIXIAO' => 1750,
        'BAOZI' => 1751,
        'HONGBO' => 1752,
        'LUBO' => 1753,
        'LANBO' => 1754,
        'TEMA0' => 1755,
        'TEMA1' => 1756,
        'TEMA2' => 1757,
        'TEMA3' => 1758,
        'TEMA4' => 1759,
        'TEMA5' => 1760,
        'TEMA6' => 1761,
        'TEMA7' => 1762,
        'TEMA8' => 1763,
        'TEMA9' => 1764,
        'TEMA10' => 1765,
        'TEMA11' => 1766,
        'TEMA12' => 1767,
        'TEMA13' => 1768,
        'TEMA14' => 1769,
        'TEMA15' => 1770,
        'TEMA16' => 1771,
        'TEMA17' => 1772,
        'TEMA18' => 1773,
        'TEMA19' => 1774,
        'TEMA20' => 1775,
        'TEMA21' => 1776,
        'TEMA22' => 1777,
        'TEMA23' => 1778,
        'TEMA24' => 1779,
        'TEMA25' => 1780,
        'TEMA26' => 1781,
        'TEMA27' => 1782,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $DD = new ExcelLotteryDD();
        $DD->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $DD->HH($gameId,$win); //混合
        $DD->BS($gameId,$win); //波色
        $DD->TM($gameId,$win); //特码
        return $win;
    }

    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_pcdd';
        $gameName = 'PC蛋蛋';
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
                    \Log::info($gameName.$issue.'退水前失败！');
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
                    \Log::info($gameName.$issue.'退水前失败！');
            }else{//代理退水
                $agentJob = new AgentBackwaterJob($gameId,$issue);
                $agentJob->addQueue();
            }
        }
    }
}