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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use SameClass\Config\LotteryGames\Games;

class New_sc extends Excel
{
    public $arrPlay_id = array();
    public $arrPlayCate = array();
    public $arrPlayId = array();

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
    public function all($openCode,$issue,$id,$excel,$code,$lotterys)
    {
        $gameId = $lotterys['gameId'];
        $table = $lotterys['table'];
        $gameName = $lotterys['lottery'];

        $game = Config::get('game.'.$table);
        $this->arrPlay_id = $game['arrPlay_id'];
        $this->arrPlayCate = $game['arrPlayCate'];
        $this->arrPlayId = $game['arrPlayId'];

        $havElse = $lotterys['conElseLottery'];
        $havElseLottery = [];

        writeLog('New_Kill', $code.'-- issue:'.$issue);
        if(!empty($havElse)){       //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
            $Games = new Games();
            $havElseLottery = isset($Games->games[$havElse])?$Games->games[$havElse]:[];
        }

        $param['lottery'] = $lotterys;
        $param['lotteryElse'] = $havElseLottery;

        $betCount = DB::connection('mysql::write')->table('bet')
            ->where(function ($sql) use ($param,$excel) {
                if(count($param['lotteryElse'])>0)      //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
                    return $sql->whereIn('game_id',[$param['lottery']['gameId'],$param['lotteryElse']['gameId']]);
                else
                    return $sql->where('game_id',$param['lottery']['gameId']);
            })->where('issue',$issue)->count();

        if($betCount > 0){
            if($excel){
                $exeIssue = $this->getNeedKillIssue($table,2);
                $exeBase = $this->getNeedKillBase($gameId);
                if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0){
                    $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                        'excel_num' => 3
                    ]);
                    if($update == 1) {
                        writeLog('New_Kill', $gameName.' killing...');
                        $this->excel($openCode, $exeBase, $issue, $code,$lotterys);
                    }
                }
            }else{
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,$excel,$this->arrPlay_id,true);
                if($bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                    if($updateUserMoney == 1){
                        writeLog('New_Bet', $gameName . $issue . "结算出错");
                    }
                }
                //统计一下杀率
                $this->bet_total($issue, $lotterys);
            }
        }

        if($excel){
            $update = DB::table($table)->where('id',$id)->whereIn('excel_num',[2,3])->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Kill', $gameName . $issue . "杀率not Finshed");
            }
        }else{
            $this->updateTableFinished($table,$id,$gameName,$issue,$gameId,$code);
        }
    }
}
