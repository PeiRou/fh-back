<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

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
}
