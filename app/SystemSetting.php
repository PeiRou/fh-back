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
            $array = [];
            foreach ($arr as $v){
                if(isset($array[$v['user_id']])){
                    $array[$v['user_id']] += $v[$moneyColumn];
                }else{
                    $array[$v['user_id']] = $v[$moneyColumn];
                }
            }
            $str = '';
            $ids = [];
            foreach ($array as $k=>$v){
                $str .= "WHEN {$k} THEN (CASE
                            WHEN cheak_drawing - {$v} < 0 THEN 0
                            ELSE cheak_drawing - {$v}
                    END)";
                $ids[] = $k;
            }
            if(!count($ids))
                return false;
            $sql = "UPDATE `users` SET `cheak_drawing` = CASE `id`
                    {$str}
                    ELSE `cheak_drawing`
                    END
                    WHERE `id` IN(". implode(',', $ids) .")";
            DB::beginTransaction();
            $res = DB::update($sql);
//            writeLog('error', var_export($res, 1));
//            writeLog('error','修改打码量:'.$sql);
//            if(!$res){
//                writeLog('error','修改打码量失败'.$sql);
//            }
            DB::commit();
            return $res;
        }catch (\Throwable $e){
            DB::rollback();
            writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $e->getLine() . ' ' . $e->getMessage());
            return false;
        }
    }


}
