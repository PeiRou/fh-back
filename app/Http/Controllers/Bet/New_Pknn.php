<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/23
 * Time: 下午6:39
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryNN;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class New_Pknn extends Excel
{
    protected $arrPlay_id = array(901903462,901903463,901903464,901903465,901903466,901914229,901914230,901914231,901914232,901914233);
    protected $arrPlayCate = array(
        'NN' => 190,
        'NN1' => 191
    );
    protected $arrPlayId = array(
        'XIANYI' => 3462,
        'XIANER' => 3463,
        'XIANSAN' => 3464,
        'XIANSI' => 3465,
        'XIANWU' => 3466,
        'XIANYI1' => 4229,
        'XIANER1' => 4230,
        'XIANSAN1' => 4231,
        'XIANSI1' => 4232,
        'XIANWU1' => 4233
    );

    protected function exc_play_nn($openCode,$gameId,$nn){
        $win = collect([]);
        $lose = collect([]);
        $NN = new ExcelLotteryNN();
        $NN->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $NN->NN($openCode,$nn,$gameId,$win,$lose);
        return array('win'=>$win,'lose'=>$lose);
    }

    public function all($openCode,$nn,$issue,$gameId,$id)
    {
        $table = 'game_pknn';
        $gameName = 'PK10牛牛';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = 0;
            $resData = $this->exc_play_nn($openCode,$gameId,$nn);
            $win = @$resData['win'];
            $lose = isset($resData['lose'])?$resData['lose']:array();
            try{
                $bunko = $this->bunko_nn($win,$lose,$gameId,$issue);
            }catch (\exception $exception){
                writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                DB::table('bet')->where('status',1)->where('issue',$issue)->where('game_id',$gameId)->update(['bunko' => 0,'status' => 0]);
            }
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