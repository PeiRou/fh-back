<?php

namespace App\Console\Commands;

use App\Bets;
use App\Http\Proxy\GetDate;
use App\PlatformSettlement;
use Illuminate\Console\Command;

class PlatformOffer extends Command
{
    /**
     * 计算平台费用
     * date  2019-02 要计算的月份
     * clear 是否清除对应旧数据 默认1清除
     * jq    第三方游戏  默认1
     */
    protected $signature = 'PlatformOffer:Settlement {date?} {--clear=1}';

    protected $description = '计算平台费用';


    public function __construct()
    {
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
        $param = $this->options();
        $this->argument('date') && $param['date'] = strtotime($this->argument('date'));
        $obj = new \stdClass();
        $obj->instance = new \App\Repository\PlatformOfferRepository($param);
        //第三方游戏
        $obj->instance->jq($param);

    }
}
