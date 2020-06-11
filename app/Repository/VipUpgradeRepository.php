<?php
/**
 * 后台的一些操作
 */

namespace App\Repository;



use App\UserVip;

class VipUpgradeRepository
{
    private $aVip = [];

    private $aCapital = [];

    private $aRecord = [];

    private $aUpgradeId = [];

    private $aUserGift = [];

    private $aNullUser = [];

    public function __construct($aVip)
    {
        $this->aVip = $aVip;
    }

    public function doAction($iUser){
        //添加不存在的vip用户
        if($iUser->vip_id === NULL){
            $this->aNullUser[] = $iUser->user_id;
            $iUser->vip_id = 0;
        }
        $this->isUpgradeBet($iUser);
    }

    public function returnData(){
        return [
            'aNullUser' => $this->aNullUser,
            'aCapital' => $this->aCapital,
            'aRecord' => $this->aRecord,
            'aUpgradeId' => $this->aUpgradeId,
            'aUserGift' => $this->aUserGift
        ];
    }

    //判断用户下注是否升级
    private function isUpgradeBet($iUser){
        $iUser->vip_id++;
        if($iUser->vip_id > 7){
            return ;
        }
        $iVip = $this->getVipInfo($iUser->vip_id);
        $isVipUp = false;
        if($iUser->recharges_money >= $iVip->claim_money){
            $this->userUpgrade($iUser,$iVip);
            $isVipUp = true;
        }
//        switch ($iVip->claim){
//            case 1:
//                if($iUser->recharges_money >= $iVip->claim_money){
//                    $this->userUpgrade($iUser,$iVip);
//                    $isVipUp = true;
//                }
//                break;
//            case 2:
//                if($iUser->bet_money >= $iVip->claim_bet){
//                    $this->userUpgrade($iUser,$iVip);
//                    $isVipUp = true;
//                }
//                break;
//            case 3:
//                if($iUser->recharges_money >= $iVip->claim_money && $iUser->bet_money >= $iVip->claim_bet){
//                    $this->userUpgrade($iUser,$iVip);
//                    $isVipUp = true;
//                }
//                break;
//            case 4:
//                if($iUser->recharges_money >= $iVip->claim_money || $iUser->bet_money >= $iVip->claim_bet){
//                    $this->userUpgrade($iUser,$iVip);
//                    $isVipUp = true;
//                }
//                break;
//        }
        if($isVipUp){
            $this->isUpgradeBet($iUser);
        }
    }

    //获取vip详情
    private function getVipInfo($id){
        $iData = (object)[];
        foreach ($this->aVip as $iVip){
            if($iVip->id == $id){
                $iData = $iVip;
                break;
            }
        }
        return $iData;
    }

    //用户升级
    private function userUpgrade($iUser,$iVip){
        $this->recordUpgradeGift($iUser,$iVip);
        $this->recordVip($iUser,$iVip);
        $this->aUpgradeId[$iUser->user_id] = $iVip->id >= 7 ? 7 : $iVip->id;
    }

    //记录晋级礼金并判断是否自动派发
    private function recordUpgradeGift($iUser,$iVip){
        if(array_key_exists($iUser->user_id,$this->aUserGift)){
            $this->aUserGift[$iUser->user_id] = round($this->aUserGift[$iUser->user_id] + $iVip->money,2);
        }else{
            $this->aUserGift[$iUser->user_id] = $iVip->money;
        }
        $iTime = date('Y-m-d H:i:s');
        $this->aCapital[] = [
            'to_user' => $iUser->user_id,
            'user_type' => 'user',
            'order_id' => 'VIP'.date('YmdHis').rand(10000000,99999999),
            'type' => 't37',
            'rechargesType' => NULL,
            'game_id' => 0,
            'issue' => 0,
            'money' => $iVip->money,
            'balance' => round($iUser->user_money + $iVip->money,2),
            'play_type' => NULL,
            'playcate_id' => 0,
            'game_name' => '',
            'playcate_name' => '',
            'operation_id' => NULL,
            'content' => 'VIP升级礼金('.$iVip->title.')',
            'testFlag' => $iUser->user_testFlag,
            'created_at' => $iTime,
            'updated_at' => $iTime,
        ];
    }

    //升级记录
    private function recordVip($iUser,$iVip){
        $this->aRecord[] = [
            'user_id' => $iUser->user_id,
            'claim' => $iVip->claim,
            'claim_bet' => $iVip->claim_bet,
            'claim_money' => $iVip->claim_money,
            'vip_id' => $iVip->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }

}