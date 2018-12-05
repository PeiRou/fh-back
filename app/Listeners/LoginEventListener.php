<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
//use App\Jobs\UpdateIpInfo;

class LoginEventListener implements ShouldQueue
{
    //错误重试次数
    public $tries = 1;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param  LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        //获取事件中保存的信息
        $username = $event->getUser();
        $userId = $event->getUserId();
        $ip = $event->getIp();
        $loginTime = $event->getLoginTime();
        $loginHost = $event->getLoginHost();
        $type = $event->getType();

//        $ipInfo = ip($ip);
        $ipInfo = '';

        //存入数据库 DB: log_login
        $log_id = DB::table('log_admin_login')->insertGetId([
            'name' => $username,
            'u_id' => $userId,
            'login_time' => $loginTime,
            'ip' => $ip,
            'ip_info' => $ipInfo,
            'login_host' => $loginHost,
            'type' => $type
        ]);
        //如果增加成功异步修改ip
//        if($log_id)
//            UpdateIpInfo::dispatch('log_admin_login', 'id', $log_id, $ip, 'ip_info')->onQueue('UpdateIpInfo');
    }
}
