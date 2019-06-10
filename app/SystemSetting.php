<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SystemSetting extends Model
{
    protected $table = 'system_setting';
    public $timestamps = false;

    public function getValueByRemark($value){
        return $this->where('id',1)->value($value);
    }

    public static function getValueByRemark1($value){
        return self::where('id',1)->value($value);
    }

    //后台加钱增加会员打码量限制
    public static function addDrawingMoneyCheckAdminMoney($userId, $amout, $adminAddMoneyType)
    {
        $res = self::select('drawing_money_check_code', 'drawing_money_check_admin_money')->first();
        if($res->drawing_money_check_code > 0 && in_array($adminAddMoneyType, explode(',', $res->drawing_money_check_admin_money))){
            self::addDrawingMoneyCheckCode($userId, $amout);
        }
    }

    //增加会员打码量限制
    public static function addDrawingMoneyCheckCode($userId, $amout)
    {
        if(($drawing_money_check_code = self::value('drawing_money_check_code')) > 0){
            DB::connection('mysql::write')->table('users')->where('id' , $userId)->update([
                'cheak_drawing' => DB::raw(" cheak_drawing + ".($amout * $drawing_money_check_code)." ")
            ]);
        }
    }
}
