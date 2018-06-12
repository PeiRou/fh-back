<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    protected $fillable = [
        'type', 'money','sel_money','count','sel_count','recharge','chip','created_hand','status',
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
     * @param $id
     * @return mixed
     */
    public function scopeOfId($query, $id)
    {
        if(!empty($id)) {
            return $query->where('id',$id);
        }
        return $query;
    }

    /**
     * 搜索房间
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeOfType($query, $type)
    {
        if(!empty($type)) {
            return $query->where('type',$type);
        }
        return $query;
    }

    /**
     * 搜索红包状态
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


}
