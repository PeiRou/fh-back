<?php

namespace App\Jobs;

use App\Agent;
use App\GeneralAgent;
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
        //注册会员数
        $register_member = Users::getRegisteredCount($this->aDateTime);
        //注册代理数
        $register_agent = Agent::getRegisteredCount($this->aDateTime);
        //注册总代理数
        $register_general = GeneralAgent::getRegisteredCount($this->aDateTime);
        //今日首充人数
        $recharge_today = Recharges::getTodayChargeUsersCount($this->aDateTime);
        //今日首充金额
        $recharge_today_money = Recharges::getTodayChargeUsersMoney($this->aDateTime);
        //首充人数
        $recharge_first = RechargesTimes::getFirstChargeUsersCount($this->aDateTime);
        //首充金额
        $recharge_first_money = RechargesTimes::getFirstChargeUsersMoney($this->aDateTime);
        //第二次充值人数
        $recharge_second = RechargesTimes::getSecondChargeUsersCount($this->aDateTime);
        //第三次充值人数
        $recharge_third = RechargesTimes::getThirdChargeUsersCount($this->aDateTime);
        //当前注册充值人数,当前注册充值金额
        $iCurrent = Recharges::getCurrentChargeUsersMoney($this->aDateTime);
        $dateTime = date('Y-m-d H:i:s');
        ReportRecharge::where('date',$this->aDateTime)->delete();
        ReportRecharge::insert([
            'register_person' => round($register_member + $register_agent + $register_general),
            'register_member' => $register_member,
            'register_agent' => $register_agent,
            'register_general' => $register_general,
            'recharge_today' => $recharge_today,
            'recharge_today_money' => $recharge_today_money,
            'recharge_first' => $recharge_first,
            'recharge_first_money' => $recharge_first_money,
            'recharge_second' => $recharge_second,
            'recharge_third' => $recharge_third,
            'current_count' => $iCurrent->count ?: 0,
            'current_money' => $iCurrent->amount ?: 0,
            'date' => $this->aDateTime,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ]);
    }
}
