<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'username', 'money','packet_id','order','status',
    ];


    /**
     * 搜索红包日期
     * @param $query
     * @param $date
     * @return mixed
     */
    public function scopeOfDate($query, $date)
    {
        //dd(strtotime(last($date)),strtotime(date('Y-m-d')));   //86399
        if(!empty($date)) {
            return $query->where('created_at','>=', date('Y-m-d H:i:s',strtotime(head($date))))
                         ->where('created_at','<=', date('Y-m-d H:i:s',(strtotime(last($date))+86399)));
        }
        return $query;
    }

    /**
     * 搜索红包ID
     * @param $query
     * @param $packet_id
     * @return mixed
     */
    public function scopeOfPacketId($query, $packet_id)
    {
        if(!empty($packet_id)) {
            return $query->where('packet_id',$packet_id);
        }
        return $query;
    }

    /**
     * search username
     * @param $query
     * @param $username
     * @return mixed
     */
    public function scopeOfUser($query, $username)
    {
        if(!empty($username)) {
            return $query->where('username',$username);
        }
        return $query;
    }

    /**
     * search order
     * @param $query
     * @param $order
     * @return mixed
     */
    public function scopeOfOrder($query, $order)
    {
        if(!empty($order)) {
            return $query->where('order',$order);
        }
        return $query;
    }

    /**
     * search packet status
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeOfStatus($query, $status)
    {
        if(!empty($status)) {
            return $query->where('status',$status);
        }
        return $query;
    }

    /**
     * search min money
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeOfMinMoney($query, $moeny)
    {
        if(!empty($moeny)) {
            return $query->where('money','>=',$moeny);
        }
        return $query;
    }

    /**
     * search max money
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeOfMaxMoney($query, $moeny)
    {
        if(!empty($moeny)) {
            return $query->where('money','<=',$moeny);
        }
        return $query;
    }
}
