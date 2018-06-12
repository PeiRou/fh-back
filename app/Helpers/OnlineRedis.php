<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/1/26
 * Time: 下午9:04
 */

namespace App\Helpers;
use Illuminate\Support\Facades\Redis;

class OnlineRedis
{
    public function getOnlineData(){
        $onlineUser = Redis::get('onlineUser');
        return $onlineUser;
        //$data = '{"1":"admin","4":"2222"}';
        //return json_decode(json_encode($data),true);
    }
}