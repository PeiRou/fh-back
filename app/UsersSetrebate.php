<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersSetrebate extends Model
{
    protected $table = 'users_setrebate';

    public static function getSetrebateStatus(){
        $aData = self::select('setrebate_status','user_id')->get();
        $aArray = [0=>[],1=>[]];
        foreach ($aData as $iData){
            $aArray[$iData->setrebate_status][] = $iData->user_id;
        }
        return $aArray;
    }
}
