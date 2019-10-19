<?php

namespace App\Jobs;

use App\Agent;
use App\Recharges;
use App\RechargesTimes;
use App\ReportRecharge;
use App\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReportRechargeDaily implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $aDateTime;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($aParam)
    {
        $this->aDateTime = $aParam;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit','2048M');
        //获取注册人数
        $register_person = Users::getRegisteredCount($this->aDateTime);
        //注册会员数
        $register_member = 0;
        //注册代理数
        $register_agent = Agent::getRegisteredCount($this->aDateTime);
        //首充人数
        $recharge_first = RechargesTimes::getFirstChargeUsersCount($this->aDateTime);
        //第二次充值人数
        $recharge_second = RechargesTimes::getSecondChargeUsersCount($this->aDateTime);
        //第三次充值人数
        $recharge_third = RechargesTimes::getThirdChargeUsersCount($this->aDateTime);
        //当前注册充值人数
        $current_count = Recharges::getCurrentChargeUsersCount($this->aDateTime);
        //当前注册充值金额
        $current_money = Recharges::getCurrentChargeUsersMoney($this->aDateTime);
        $dateTime = date('Y-m-d H:i:s');

        ReportRecharge::where('date',$this->aDateTime)->delete();
        ReportRecharge::insert([
            'register_person' => $register_person,
            'register_member' => $register_member,
            'register_agent' => $register_agent,
            'recharge_first' => $recharge_first,
            'recharge_second' => $recharge_second,
            'recharge_third' => $recharge_third,
            'current_count' => $current_count,
            'current_money' => $current_money,
            'date' => $this->aDateTime,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ]);
    }
}
