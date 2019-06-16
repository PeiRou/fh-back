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


    //修改会员打码量限制 如果修改了倍数 会员之前的倍数也要修改
    public static function upDrawingMoneyCheckCode($nowCode, $drawing_money_check_code)
    {
        $code = ($nowCode && $drawing_money_check_code) ? $nowCode / $drawing_money_check_code : 0;
        try{
            DB::table('users')->where('cheak_drawing', '>', 0)
                ->update([
                    'cheak_drawing' => DB::raw(" (`cheak_drawing` * ".$code." ) ")
                ]);
        }catch (\Throwable $e){
            writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            return false;
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

    //减少会员打码量限制
    public static function decDrawingMoneyCheckCode($arr, $moneyColumn = 'AllBet')
    {
        try{
            foreach ($arr as $v){
                DB::connection('mysql::write')->table('users')->where('id' , $v['user_id'])->update([
                    'cheak_drawing' => DB::raw(" 
                        CASE 
                            WHEN cheak_drawing - {$v[$moneyColumn]} < 0 THEN 0
                            ELSE cheak_drawing - {$v[$moneyColumn]}
                        END
                    ")
                ]);
            }
//            $str = '';
//            $ids = [];
//            foreach ($arr as $v){
//                $str .= "WHEN {$v['user_id']} THEN (CASE
//                            WHEN cheak_drawing - {$v[$moneyColumn]} < 0 THEN 0
//                            ELSE cheak_drawing - {$v[$moneyColumn]}
//                    END)";
//                $ids[] = $v['user_id'];
//            }
//            if(!count($ids))
//                return false;
//            $sql = "UPDATE `users` SET `cheak_drawing` = CASE `id`
//                    {$str}
//                    ELSE `cheak_drawing`
//                    END
//                    WHERE `id` IN(". implode(',', $ids) .")";
//            return DB::select($sql);
        }catch (\Throwable $e){
            writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
            return false;
        }
    }


}
