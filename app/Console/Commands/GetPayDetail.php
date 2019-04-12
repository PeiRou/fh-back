<?php

namespace App\Console\Commands;

use App\Helpers\PaymentPlatform;
use App\PayDetail;
use App\SystemSetting;
use Illuminate\Console\Command;

class GetPayDetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PayDetail:GetPayDetail {startTime?} {endTime?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '拉取支付明细数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        $startTime = empty($this->argument('startTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('startTime');
        $endTime = empty($this->argument('endTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('endTime');
        $result = json_decode($this->getArraySign($startTime,$endTime),true);
        if($result['errorCode'] == 200){
            $aArray = [];
            $time = date('Y-m-d H:i:s');
            foreach ($result['data'] as $iData){
                $aArray[] = [
                    'third' => $iData['third'],
                    'type' => $iData['type'],
                    'total_money' => $iData['total_money'],
                    'success_money' => $iData['success_money'],
                    'total_order' => $iData['total_order'],
                    'success_order' => $iData['success_order'],
                    'platform' => $iData['platform'],
                    'product_at' => $iData['product_at'],
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
            }
            PayDetail::where('product_at','<=',$startTime)->where('product_at','>=',$endTime)->delete();
            PayDetail::insert($aArray);
            $this->info('ok');
        }else{
            $this->info($result['msg']);
        }
    }

    protected function getArraySign($startTime,$endTime){
        $aArray = [
            'platform_id' => SystemSetting::where('id',1)->value('payment_platform_id'),
            'timestamp' => date('Y-m-d H:i:s'),
            'date_begin' => $startTime,
            'date_end' => $endTime
        ];

        $PaymentPlatform = new PaymentPlatform();
        $aArray['sign'] = $PaymentPlatform->getSign($aArray,SystemSetting::where('id',1)->value('payment_platform_key'));
        return $PaymentPlatform->postCurl('http://sc888999.com/api/v1/statistical',$aArray);
    }
}
