<?php

namespace App\Console\Commands;

use App\Helpers\PaymentPlatform;
use App\Jobs\PayTypeNewInsert;
use App\PayTypeNew;
use App\SystemSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetOnlinePaymentType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PayTypeNew:GetOnlinePaymentType';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $result = json_decode($this->getArraySign(),true);
        $this->info($result['errorCode']);
        if($result['errorCode'] == 200){
            PayTypeNew::truncate();
            $this->info('begin');
            foreach ($result['data'] as $kData => $iData){
                $aArray = [
                    'id' => $iData['id'],
                    'rechName' => $iData['pay_name'],
                    'payName' => $iData['pay_uname'],
                    'code' => $iData['paytype'],
                    'pcMobile' => $iData['mechine'],
                    'sort' => $kData,
                    'arouseBrowser' => empty($iData['arouse_browser'])?0:1,
                    'isBank' => empty($iData['bank_info'])?0:1,
                    'bankInfo' => empty($iData['bank_info'])?json_encode([]):json_encode($iData['bank_info']),
                    'gatewayAddress' => empty($iData['gateway_address'])?'':$iData['gateway_address'],
                ];
                PayTypeNewInsert::dispatch($aArray)->onQueue($this->setQueueRealName('payTypeNewInsert'));
            }
            //当支付渠道下架，将此渠道停用
            $sql="UPDATE pay_online_new SET status = 0 WHERE payName IN (SELECT old.payName FROM pay_type_new AS new RIGHT JOIN (SELECT payName FROM pay_online_new WHERE rechType = 'onlinePayment' AND status = 1) AS old ON new.payName = old.payName WHERE new.payName IS NULL);";
            DB::statement($sql);
            $this->info('ok');
        }else{
            $this->info($result['msg']);
        }
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }

    public function getArraySign(){
        $aArray = [
            'platform_id' => SystemSetting::where('id',1)->value('payment_platform_id'),
            'timestamp' => time()
        ];
        $PaymentPlatform = new PaymentPlatform();
        $aArray['sign'] = $PaymentPlatform->getSign($aArray,SystemSetting::where('id',1)->value('payment_platform_key'));
//        $this->info(base64_encode(json_encode($aArray)));
        return $PaymentPlatform->postCurl(SystemSetting::where('id',1)->value('payment_platform_interface'),[
            'ciphertext' => base64_encode(json_encode($aArray)),
        ]);
    }


}
