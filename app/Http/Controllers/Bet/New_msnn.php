<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/21
 * Time: 下午7:28
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryNN;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class New_msnn extends Excel
{
    protected $arrPlay_id = array(911893457,911893458,911893459,911893460,911893461,911924234,911924235,911924236,911924237,911924238);
    protected $arrPlayCate = array(
        'NN' => 189,
        'NN1' => 192
    );
    protected $arrPlayId = array(
        'XIANYI' => 3457,
        'XIANER' => 3458,
        'XIANSAN' => 3459,
        'XIANSI' => 3460,
        'XIANWU' => 3461,
        'XIANYI1' => 4234,
        'XIANER1' => 4235,
        'XIANSAN1' => 4236,
        'XIANSI1' => 4237,
        'XIANWU1' => 4238,
    );

    protected function exc_play_nn($openCode,$gameId,$nn){
        $win = collect([]);
        $lose = collect([]);
        $NN = new ExcelLotteryNN();
        $NN->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $NN->NN($openCode,$nn,$gameId,$win,$lose);
        return array('win'=>$win,'lose'=>$lose);
    }

    public function all($openCode,$nn,$issue,$gameId,$id,$code,$table,$gameName)
    {
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
        $update = DB::table($table)->where('id',$id)->where('is_open',1)->where('nn_bunko',2)->update([
            'nn_bunko' => 1
        ]);
        if ($update !== 1) {
            writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
        }else{
            $this->stopBunko($gameId,1);
            //玩法退水
            if(env('AGENT_MODEL',1) == 1) {
                $res = DB::table($table)->where('id',$id)->where('nn_returnwater',0)->update(['nn_returnwater' => 2]);
                if(!$res){
                    writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                    return 0;
                }
                //退水
                $res = $this->reBackUser($gameId, $issue, $gameName);
                if(!$res){
                    $res = DB::table($table)->where('id',$id)->where('nn_returnwater',2)->update(['nn_returnwater' => 1]);
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