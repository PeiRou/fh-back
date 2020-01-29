<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 2019/07/23
 * Time: 下午20:24
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryDD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class New_dd extends Excel
{
    public $arrPlay_id = array();
    public $arrPlayCate = array();
    public $arrPlayId = array();

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $DD = new ExcelLotteryDD();
        $DD->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $DD->HH($gameId,$win); //混合
        $DD->BS($gameId,$win); //波色
        $DD->TM($gameId,$win); //特码
        return $win;
    }

    public function all($openCode,$issue,$id,$excel,$code,$lotterys)
    {
        $gameId = $lotterys['gameId'];
        $table = $lotterys['table'];
        $gameName = $lotterys['lottery'];

        $game = Config::get('game.'.$table);
        $this->arrPlay_id = $game['arrPlay_id'];
        $this->arrPlayCate = $game['arrPlayCate'];
        $this->arrPlayId = $game['arrPlayId'];
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
        $update = DB::table($table)->where('id',$id)->where('is_open',1)->where('bunko',2)->update([
            'bunko' => 1
        ]);
        if ($update !== 1) {
            writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
        }else{
            //执行玩法退水跟层层代理反水
            $this->exeReturnAndBackWater($table,$id,$gameName,$issue,$gameId,$code);
        }
    }
}