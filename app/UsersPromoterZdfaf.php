<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPromoterZdfaf extends Model
{
    protected $table = 'users_promoter_zdfaf';

    public static function getPromoterStatus(){
        return self::where('setrebate_status',1)->pluck('user_id')->toArray();
    }
}
