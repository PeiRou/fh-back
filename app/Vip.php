<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vip extends Model
{
    protected $table = 'vip';

    public static function getVipData(){
        $aVip = DB::table('vip')
            ->select('vip.id','vip.claim','vip.claim_bet','vip.claim_money','vip.title','vip_gift.category_id','vip_gift.money','vip_gift.type','vip_gift.status')
            ->join('vip_gift','vip_gift.vip_id','=','vip.id')
            ->where('vip_gift.category_id','=',1)->get();
        foreach ($aVip as $kVip => $iVip){
            if($iVip->id > 1){
                $preVip = self::getVipInfo($aVip,$iVip->id - 1);
                $aVip[$kVip]->upgradeBet = round($iVip->claim_bet - $preVip->claim_bet,2);
                $aVip[$kVip]->upgradeMoney = round($iVip->claim_money - $preVip->claim_money,2);
            }else{
                $aVip[$kVip]->upgradeBet = $iVip->claim_bet;
                $aVip[$kVip]->upgradeMoney = $iVip->claim_money;
            }
        }
        return $aVip;
    }

    //获取vip详情
    private static function getVipInfo($aVip,$id){
        $iData = (object)[];
        foreach ($aVip as $iVip){
            if($iVip->id == $id){
                $iData = $iVip;
                break;
            }
        }
        return $iData;
    }
}
