<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password','username','fullName','chatRole','chatOffline','chatAvatar','chatStatus','login_ip'
    ];


    /**
     * 搜索用户名/昵称
     * @param $query
     * @param $name
     * @return mixed
     */
    public function scopeOfName($query, $name)
    {
        if(!empty($name)) {
            return $query->where('username',$name)
                ->orWhere('fullName',$name);
        }
        return $query;
    }

    /**
     * 搜索IP
     * @param $query
     * @param $ip
     * @return mixed
     */
    public function scopeOfIp($query, $ip)
    {
        if(!empty($ip)) {
            return $query->where('login_ip',$ip);
        }
        return $query;
    }

    /**
     * 搜索chatStatus
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeOfStatus($query, $status)
    {
        if(!empty($status)) {
            return $query->where('chatStatus',$status);
        }
        return $query;
    }

    /**
     * 搜索chatRole
     * @param $query
     * @param $role
     * @return mixed
     */
    public function scopeOfRole($query, $role)
    {
        if(!empty($role)) {
            return $query->where('chatRole',$role);
        }
        return $query;
    }

    public static function getUsersInfoList(){
        $data =  self::select('id','name','username','promoter')->get();
        $array = [];
        foreach ($data as $value){
            $array[$value->id] = [
                'id' => $value->id,
                'name' => $value->name,
                'username' => $value->username,
                'promoter' => $value->promoter,
            ];
        }
        return $array;
    }

    public static function getTransferUserInfo($params){
        $sqlArray = [];
        $aSql = 'SELECT COUNT(`id`) AS `count`,SUM(`amount`) AS `amount`,`userId` FROM `recharges` WHERE `status` = 2 ';
        if(!empty($params['startTime'])){
            $sqlArray['startTime'] = $params['startTime'] . ' 00:00:00';
            $aSql .= 'AND `created_at` >= :startTime ';
        }
        if(!empty($params['endTime'])){
            $sqlArray['endTime'] = $params['endTime'] . ' 23:59:59';
            $aSql .= 'AND `created_at` <= :endTime ';
        }
        $aSql .= 'GROUP BY `userId`';
        return DB::select($aSql,$sqlArray);
    }

    public static function getTransferUserId($params){
        $params['recharge'] = empty($params['recharge']) ? 0 : $params['recharge'];
        $params['money_min'] = empty($params['money_min']) ? 0 : $params['money_min'];
        $params['money_max'] = empty($params['money_max']) ? 99999999999 : $params['money_max'];
        $aUsers = self::getTransferUserInfo($params);
        $aUserId = [];
        foreach ($aUsers as $iUsers){
            if(($iUsers->count >= $params['recharge']) && ($iUsers->amount >= $params['money_min']) && ($iUsers->amount <= $params['money_max'])){
                $aUserId[] = $iUsers->userId;
            }
        }
        return $aUserId;
    }

    public static function userConditionTransfer($params){
        $aUserId = self::getTransferUserId($params);
        return self::whereIn('id',$aUserId)->where('rechLevel','=',$params['form_id'])->update(['rechLevel'=>$params['to_id']]);
    }
}
