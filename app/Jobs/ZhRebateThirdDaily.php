<?php

namespace App\Jobs;

use App\Capital;
use App\GamesListReratio;
use App\Levels;
use App\ThirdRebate;
use App\Users;
use App\UsersSetrebate;
use App\ZhReportMemberBunko;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SameClass\Model\UsersModel;

class ZhRebateThirdDaily implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $aDateTime;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($aDateTime)
    {
        $this->aDateTime = $aDateTime;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit','2048M');
        //获取当前时间返点记录
        $aThird = ThirdRebate::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取会员数据
        $aJqBet = ZhReportMemberBunko::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取返点设置
        $aReratio = GamesListReratio::getGidArrayValue();
        //获取部分会员层级
        $aSetrebate = UsersSetrebate::getSetrebateStatus();
        if(count($aThird) > 0){
            $this->recodeYes($aThird,$aJqBet,$aReratio,$aSetrebate);
        }else{
            $this->recodeNo($aJqBet,$aReratio,$aSetrebate);
        }
    }

    private function recodeYes($aThird,$aJqBet,$aReratio,$aSetrebate){
        //获取初步返水数据
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aJqBet as $kJqBet => $iJqBet){
            if($iJqBet->bet_money > 1 && isset($aReratio[$iJqBet->game_id])){
                $iReratio = $this->getReratio($aReratio[$iJqBet->game_id],$iJqBet->bet_money);
                if(!empty($iReratio) && $iReratio->reratio > 0){
                    $iMoney = round($iReratio->reratio * $iJqBet->bet_money / 100,2);
                    $iMoney = $iMoney > $iReratio->rebate_limit ? $iReratio->rebate_limit : $iMoney;
                    $aArray[] = [
                        'game_id' => $iJqBet->game_id,
                        'game_name' => $iJqBet->game_name,
                        'user_id' => $iJqBet->user_id,
                        'user_account' => $iJqBet->user_account,
                        'user_name' => $iJqBet->user_name,
                        'agent_account' => $iJqBet->agent_account,
                        'agent_name' => $iJqBet->agent_name,
                        'agent_id' => $iJqBet->agent_id,
                        'general_account' => $iJqBet->general_account,
                        'general_name' => $iJqBet->general_name,
                        'general_id' => $iJqBet->general_id,
                        'money' => $iMoney,
                        'proportion' => $iReratio->reratio,
                        'bet_money' => $iJqBet->bet_money,
                        'threshold' => $iReratio->betamount_threshold,
                        'admin_id' => 0,
                        'admin_account' => '系统',
                        'admin_name' => '系统',
                        'status' => $this->isStatus($iJqBet->third_rebate,$iJqBet->user_id,$aSetrebate),
                        'content' => '',
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                        'balance' => round($iJqBet->userMoney + $iMoney, 2),
                        'testFlag' => $iJqBet->testFlag,
                    ];
                }
            }
        }

        $aData = [];
        $aCapital = [];
        $aUserMoney = [];
        foreach ($aArray as $kArray => $iArray){
            foreach ($aThird as $iThird){
                if($iThird->user_id == $iArray['user_id'] && $iThird->game_id == $iArray['game_id'] && $iThird->money < $iArray['money']){
                    $aData[] = [
                        'game_id' => $iThird->game_id,
                        'game_name' => $iThird->game_name,
                        'user_id' => $iThird->user_id,
                        'user_account' => $iThird->user_account,
                        'user_name' => $iThird->user_name,
                        'agent_account' => $iThird->agent_account,
                        'agent_name' => $iThird->agent_name,
                        'agent_id' => $iThird->agent_id,
                        'general_account' => $iThird->general_account,
                        'general_name' => $iThird->general_name,
                        'general_id' => $iThird->general_id,
                        'bet_money' => $iArray['bet_money'],
                        'proportion' => $iArray['proportion'],
                        'threshold' => $iArray['threshold'],
                        'money' => round($iArray['money'] - $iThird->money,2),
                        'admin_id' => 0,
                        'admin_account' => '系统',
                        'admin_name' => '系统',
                        'status' => $this->isStatus($iThird->third_rebate,$iThird->user_id,$aSetrebate),
                        'content' => '',
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                        'balance' => $iThird->userMoney,
                        'testFlag' => $iArray['testFlag'],
                    ];
                }
                if($iThird->user_id == $iArray['user_id'] && $iThird->game_id == $iArray['game_id']){
                    unset($aArray[$kArray]);
                }
            }
        }

        foreach ($aArray as $iArray){
            $aData[] = $iArray;
        }

        foreach ($aData as $kData => $iData){
            if($iData['status'] === 3) {
                if(array_key_exists($iData['user_id'],$aUserMoney)){
                    $aUserMoney[$iData['user_id']]['money'] += $iData['money'];
                }else{
                    $aUserMoney[$iData['user_id']] = [
                        'money' => $iData['money'],
                        'to_user' => $iData['user_id'],
                    ];
                }
                $aCapital[] = [
                    'to_user' => $iData['user_id'],
                    'testFlag' => $iData['testFlag'],
                    'user_type' => 'user',
                    'order_id' => "RTHR" . date('YmdHis') . rand(10000000, 99999999),
                    'type' => 't32',
                    'rechargesType' => NULL,
                    'game_id' => 0,
                    'issue' => 0,
                    'money' => $iData['money'],
                    'play_type' => NULL,
                    'playcate_id' => 0,
                    'balance' => round($iData['balance'] + $iData['money'],2),
                    'game_name' => $iData['game_name'],
                    'playcate_name' => '',
                    'operation_id' => NULL,
                    'content' => '第三方返点',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ];
            }
            unset($aData[$kData]['balance']);
            unset($aData[$kData]['testFlag']);
        }
        $this->editSql($aCapital,$aData,$aUserMoney);
    }

    private function recodeNo($aJqBet,$aReratio,$aSetrebate){
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        $aCapital = [];
        $aUserMoney = [];
        foreach ($aJqBet as $kJqBet => $iJqBet){
            if($iJqBet->bet_money > 0 && isset($aReratio[$iJqBet->game_id])) {
                $iMoney = 0;
                $iStatus = 0;
                $iReratio = $this->getReratio($aReratio[$iJqBet->game_id],$iJqBet->bet_money);
                if (!empty($iReratio) && $iReratio->reratio > 0) {
                    $iMoney = round($iReratio->reratio * $iJqBet->bet_money / 100, 2);
                    $iMoney = $iMoney > $iReratio->rebate_limit ? $iReratio->rebate_limit : $iMoney;
                    $iStatus = $this->isStatus($iJqBet->third_rebate,$iJqBet->user_id,$aSetrebate);
                    $aArray[] = [
                        'game_id' => $iJqBet->game_id,
                        'game_name' => $iJqBet->game_name,
                        'user_id' => $iJqBet->user_id,
                        'user_account' => $iJqBet->user_account,
                        'user_name' => $iJqBet->user_name,
                        'agent_account' => $iJqBet->agent_account,
                        'agent_name' => $iJqBet->agent_name,
                        'agent_id' => $iJqBet->agent_id,
                        'general_account' => $iJqBet->general_account,
                        'general_name' => $iJqBet->general_name,
                        'general_id' => $iJqBet->general_id,
                        'money' => $iMoney,
                        'proportion' => $iReratio->reratio,
                        'bet_money' => $iJqBet->bet_money,
                        'threshold' => $iReratio->betamount_threshold,
                        'status' => $iStatus,
                        'content' => '',
                        'admin_id' => 0,
                        'admin_account' => '系统',
                        'admin_name' => '系统',
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
                if ($iStatus === 3 && $iMoney > 0) {
                    if(array_key_exists($iJqBet->user_id,$aUserMoney)){
                        $aUserMoney[$iJqBet->user_id]['money'] += $iMoney;
                    }else{
                        $aUserMoney[$iJqBet->user_id] = [
                            'money' => $iMoney,
                            'to_user' => $iJqBet->user_id,
                        ];
                    }
                    $aCapital[] = [
                        'to_user' => $iJqBet->user_id,
                        'testFlag' => $iJqBet->testFlag,
                        'user_type' => 'user',
                        'order_id' => "THR" . date('YmdHis') . rand(10000000, 99999999),
                        'type' => 't31',
                        'rechargesType' => NULL,
                        'game_id' => 0,
                        'issue' => 0,
                        'money' => $iMoney,
                        'balance' => round($iJqBet->userMoney + $aUserMoney[$iJqBet->user_id]['money'], 2),
                        'play_type' => NULL,
                        'playcate_id' => 0,
                        'game_name' => $iJqBet->game_name,
                        'playcate_name' => '',
                        'operation_id' => NULL,
                        'content' => '第三方返点',
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }
        }
        $this->editSql($aCapital,$aArray,$aUserMoney);
    }

    private function getReratio($aReratio,$betMoney){
        $iData = [];
        foreach ($aReratio as $iReratio) {
            if ($betMoney >= $iReratio->betamount_threshold) {
                $iData = $iReratio;
            } else {
                continue;
            }
        }
        return $iData;
    }

    private function editSql($aCapital,$aArray,$aUserMoney){
        DB::beginTransaction();
        try{
            if(!empty($aCapital)){
                $aCapital = array_chunk($aCapital,1000);
                foreach ($aCapital as $iCapital){
                    Capital::insert($iCapital);
                }
            }

            if(!empty($aUserMoney)){
                $aUserMoney = array_chunk($aUserMoney,1000);
                foreach ($aUserMoney as $iUserMoney){
                    DB::update( Users::updateUserBatchStitching('users',$iUserMoney));
                    UsersModel::userCheakDrawings($iUserMoney, 't31', null, 'to_user', 'money',[
                        'capital_type' => 5
                    ]);
                }
            }

            if(!empty($aArray)){
                $aArray = array_chunk($aArray,1000);
                foreach ($aArray as $iArray){
                    ThirdRebate::insert($iArray);
                }
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
        }
    }

    private function isStatus($code,$user_id,$aSetrebate){
        switch ($code){
            case 1:
                $status = 3;
                break;
            case 2:
                $status = 4;
                break;
            default :
                $status = 0;
                break;
        }
        if(in_array($user_id,$aSetrebate[1])){
            $status = 3;
        }elseif (in_array($user_id,$aSetrebate[0])){
            $status = 4;
        }
        return $status;
    }
}
