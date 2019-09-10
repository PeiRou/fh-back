<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPromoterShangji extends Model
{
    protected $table = 'users_promoter_shangji';

    public static function getPromoterStatus(){
        $aData = self::select('setrebate_status','user_id')->get();
        $aArray = [];
        foreach ($aData as $iData){
            $aArray[$iData->status][] = $iData->user_id;
        }
        return empty($aArray) ? [0=>[],1=>[]] :$aArray;
    }
}
