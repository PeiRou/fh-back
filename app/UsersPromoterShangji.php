<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPromoterShangji extends Model
{
    protected $table = 'users_promoter_shangji';

    public static function getPromoterStatus(){
        $aData = self::select('setrebate_status','user_id')->get();
        $aArray = [0=>[],1=>[]];
        foreach ($aData as $iData){
            $aArray[$iData->setrebate_status][] = $iData->user_id;
        }
        return $aArray;
    }
}
