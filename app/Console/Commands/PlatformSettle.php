<?php

namespace App\Console\Commands;

use App\Bets;
use App\Http\Proxy\GetDate;
use App\PlatformSettlement;
use Illuminate\Console\Command;

class PlatformSettle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PlatformSettle:Settlement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'billing platform last month report';

    //统计参数
    private $parameter = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->parameter = [
            'draw' => '0.03', //抽成比
            'other' => 2000,  //其他费用
            'https' => 2000,  //证书费用
        ];

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit','1024M');
        $date = new GetDate();
        //获取上月时间段
        //$currentMonth = ['start'=>'2018-07-01','end'=>'2018-07-30'];
        $currentMonth = $date->lastMonthDate();
        $yearMonth = date('Y-m-d',strtotime($currentMonth['start']));
        //平台统计
        $aPlatformData = Bets::platformManualSettlement($currentMonth);
        $data = [
            'date' => $yearMonth,
            'profit_loss' => $aPlatformData,
            'draw' => $this->parameter['draw'],                                                                                         //抽成比
            'cost' => $this->parameter['draw'] * $aPlatformData,                                                                        //平台费用
            'other' => $this->parameter['other'],                                                                                       //其它费用
            'https' => $this->parameter['https'],                                                                                       //证书费用
            'total' => $this->parameter['draw'] * $aPlatformData + $this->parameter['other'] + $this->parameter['https'],               //总费用
            'paid' => 0,                                                                                                                //已付费用
            'unpaid' => $this->parameter['draw'] * $aPlatformData + $this->parameter['other'] + $this->parameter['https'],              //未付费用
            'content' => '',                                                                                                            //备注
            'status' => 1                                                                                                               //状态
        ];
        PlatformSettlement::where('date','=',$yearMonth)->delete();
        PlatformSettlement::insert($data);
    }
}
