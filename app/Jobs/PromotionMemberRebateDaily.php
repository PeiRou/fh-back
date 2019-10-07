<?php

namespace App\Jobs;

use App\Capital;
use App\PromotionConfig;
use App\PromotionRecode;
use App\SystemSetting;
use App\SystemSetup;
use App\ThirdRebate;
use App\Users;
use App\UsersPromoter;
use App\UsersPromoterShangji;
use App\UsersPromoterZdfaf;
use App\ZhReportMemberBunko;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class PromotionMemberRebateDaily implements ShouldQueue
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
        //获取投注记录
        $aBet = ZhReportMemberBunko::betMemberPromotionData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取推广返点设置
        $aPromotion = PromotionConfig::getLevelPromotion();
        //获取特定会员
        $aPromotionUserS = UsersPromoterShangji::getPromoterStatus();
        //获取特定返佣人
        $aPromotionUser = UsersPromoter::getPromoterStatus();
        //获取自动领奖人
        $aReceiveUser = UsersPromoterZdfaf::getPromoterStatus();
        //获取当前时间返佣记录
        $aRecode = PromotionRecode::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        if(count($aRecode) > 0){
            $aArray = $this->recodeYes($aBet,$aPromotion,$aPromotionUserS,$aPromotionUser,$aReceiveUser,$aRecode);
            $iType = 't34';
        }else{
            $aArray = $this->recodeNo($aBet,$aPromotion,$aPromotionUserS,$aPromotionUser,$aReceiveUser);
            $iType = 't33';
        }
        if(empty($aArray))    return false;

        $aArrayUserId = [];
        foreach ($aArray as $iArray){
            if(!in_array($iArray['user_id'],$aArray)){
                $aArrayUserId[] = $iArray['user_id'];
            }
        }
        //获取会员信息
        $aUser = Users::getUserInfoByIds($aArrayUserId);
        $aData = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aArray as $iArray){
            foreach ($aUser as $iUser){
                if($iUser->user_id == $iArray['user_id']){
                    $aData[] = [
                        'order_id' => "PRO" . date('YmdHis') . rand(10000000, 99999999),
                        'promotion_user_id' => $iArray['promotion_user_id'],
                        'promotion_user_account' => $iArray['promotion_user_account'],
                        'promotion_user_name' => $iArray['promotion_user_name'],
                        'user_id' => $iUser->user_id,
                        'user_name' => $iUser->user_name,
                        'user_account' => $iUser->user_account,
                        'agent_account' => $iUser->agent_account,
                        'agent_name' => $iUser->agent_name,
                        'agent_id' => $iUser->agent_id,
                        'general_account' => $iUser->general_account,
                        'general_name' => $iUser->general_name,
                        'general_id' => $iUser->general_id,
                        'balance' => $iUser->user_money,
                        'game_id' => $iArray['game_id'],
                        'game_name' => $iArray['game_name'],
                        'status' => $iArray['status'],
                        'receive_status' => $iArray['receive_status'],
                        'money' => $iArray['money'],
                        'game_money' => $iArray['game_money'],
                        'promotion' => $iArray['promotion'],
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }
        }
        //统计资金明细
        $aCapital = [];
        foreach ($aData as $kData => $iData){
            if($iData['status'] === 3 && $iData['receive_status'] === 1) {
                if ($iData['receive_status'] === 1 && array_key_exists($iData['user_id'], $aCapital)) {
                    $aCapital[$iData['user_id']]['money'] += $iData['money'];
                    $aCapital[$iData['user_id']]['balance'] += $iData['money'];
                    $aCapital[$iData['user_id']]['content'] .= ',' . $iData['game_name'];
                } else {
                    $aCapital[$iData['user_id']] = [
                        'to_user' => $iData['user_id'],
                        'user_type' => 'user',
                        'order_id' => "PTHR" . date('YmdHis') . rand(10000000, 99999999),
                        'type' => $iType,
                        'rechargesType' => NULL,
                        'game_id' => 0,
                        'issue' => 0,
                        'money' => $iData['money'],
                        'play_type' => NULL,
                        'playcate_id' => 0,
                        'balance' => round($iData['balance'] + $iData['money'], 2),
                        'game_name' => '',
                        'playcate_name' => '',
                        'operation_id' => NULL,
                        'content' => '会员返佣 : ' . $iData['game_name'],
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }
            unset($aData[$kData]['balance']);
        }

        DB::beginTransaction();
        try{
            if(!empty($aCapital)){
                $aCapital = array_chunk($aCapital,1000);
                foreach ($aCapital as $iCapital){
                    Capital::insert($iCapital);
                    DB::update(Users::updateUserBatchStitching('users',$iCapital));
                }
            }
            if(!empty($aData)){
                $aData = array_chunk($aData,1000);
                foreach ($aData as $iData){
                    PromotionRecode::insert($iData);
                }
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
        }
    }

    private function recodeYes($aBet,$aPromotion,$aPromotionUserS,$aPromotionUser,$aReceiveUser,$aRecode){
        $aData = $this->recodeNo($aBet,$aPromotion,$aPromotionUserS,$aPromotionUser,$aReceiveUser);
        $aArray = [];
        foreach ($aData as $kData => $iData){
            foreach ($aRecode as $iRecode){
                if($iData['user_id'] == $iRecode->user_id && $iData['game_id'] == $iRecode->game_id && $iData['promotion_user_id'] == $iRecode->promotion_user_id){
                    if($iData['money'] > $iRecode){
                        $aArray[] = [
                            'promotion_user_id' => $iData['promotion_user_id'],
                            'promotion_user_account' => $iData['promotion_user_account'],
                            'promotion_user_name' => $iData['promotion_user_name'],
                            'user_id' => $iData['user_id'],
                            'game_id' => $iData['game_id'],
                            'game_name' => $iData['game_name'],
                            'status' => $iData['status'],
                            'receive_status' => $iData['receive_status'],
                            'money' => round($iData['money'] - $iRecode->money,2),
                            'game_money' => $iData['game_money'],
                            'promotion' => $iData['promotion'],
                            'level' => $iData['level'],
                        ];
                    }
                    unset($aData[$kData]);
                }
            }
        }
        foreach ($aData as $iData){
            $aArray[] = $iData;
        }
        return $aArray;
    }

    private function recodeNo($aBet,$aPromotion,$aPromotionUserS,$aPromotionUser,$aReceiveUser){
        $aArray = [];
        $promotionLevel = SystemSetting::where('id',1)->value('promotion_level');
        $isAutoReturn = SystemSetup::getValueByCode('automatic_grant_return');
        if($promotionLevel == 0) return $aArray;
        foreach ($aBet as $iBet){
            if(!empty($iBet->user_odds_level) && $iBet->bet_money > 0){
                $promotionUserId = explode(',', $iBet->user_odds_level);
                $promotionUserCount = count($promotionUserId);
                if ($promotionLevel >= $promotionUserCount){
                    $iCount = $promotionUserCount;
                }else{
                    $iCount = $promotionLevel;
                }
                for ($i = 1; $i <= $iCount; $i++){
                    $iPromotion = $this->getPromotion($i,$iBet->game_id,$aPromotion);
                    $iMoney = $this->getMoney($iPromotion, $iBet->bet_money);
                    if($iPromotion > 0 && $iMoney > 0) {
                        $iStatus = $this->isStatus($iBet->users_promoter_shangji, $iBet->user_id, $aPromotionUserS, $promotionUserId[$iCount - $i], $aPromotionUser);
                        $aArray[] = [
                            'promotion_user_id' => $iBet->user_id,
                            'promotion_user_account' => $iBet->user_account,
                            'promotion_user_name' => $iBet->user_name,
                            'user_id' => $promotionUserId[$iCount - $i],
                            'game_id' => $iBet->game_id,
                            'game_name' => $iBet->game_name,
                            'status' => $iStatus,
                            'receive_status' => $this->isReceiveStatus($iStatus,$promotionUserId[$iCount - $i],$aReceiveUser,$isAutoReturn),
                            'money' => $iMoney,
                            'game_money' => $iBet->bet_money,
                            'promotion' => $iPromotion['proportion'] / 100,
                            'level' => $i,
                        ];
                    }
                }
            }
        }
        return $aArray;
    }

    private function getPromotion($level,$gameId,$aPromotion){
        if(isset($aPromotion[$level]) && isset($aPromotion[$level][$gameId])){
            return $aPromotion[$level][$gameId];
        }
        return 0;
    }

    private function getMoney($iPromotion,$iMoney){
        if($iPromotion['reach_money'] <= $iMoney) {
            $iMoney = round($iPromotion['proportion'] * $iMoney / 100, 2);
            return $iMoney >= $iPromotion['rebate_limit'] ? $iPromotion['rebate_limit'] : $iMoney;
        }
        return 0;
    }

    private function isStatus($code,$userIdS,$aPromotionUserS,$userId,$aPromotionUser){
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

        $iStatusS = 0;
        if(in_array($userIdS,$aPromotionUserS[1])){
            $iStatusS = 3;
        }elseif (in_array($userIdS,$aPromotionUserS[0])){
            $iStatusS = 4;
        }

        $iStatus = 0;
        if(in_array($userId,$aPromotionUser[1])){
            $iStatus = 3;
        }elseif (in_array($userId,$aPromotionUser[0])){
            $iStatus = 4;
        }

        if($iStatusS === 4 || $iStatus === 4){
            $status = 4;
        }elseif($iStatus === 3 || $iStatusS === 3){
            $status = 3;
        }

        return $status;
    }

    private function isReceiveStatus($iStatus,$userId,$aReceiveUser,$isAutoReturn){
        $status = 0;
        if($iStatus === 3){
            $status = 2;
            if(in_array($userId,$aReceiveUser) && ($isAutoReturn == 1))    $status = 1;
        }

        if($iStatus === 4)    $status = 4;

        return $status;
    }
}
