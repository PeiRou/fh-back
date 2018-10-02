<?php

namespace App\Console\Commands;

use App\Jobs\PayTypeNewInsert;
use App\PayTypeNew;
use Illuminate\Console\Command;

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
        $result = json_decode($this->postCurl(),true);
        if($result['code'] == 200){
            PayTypeNew::truncate();
            foreach ($result['data'] as $kData => $iData){
                $aArray = [
                    'rechName' => $iData['pay_name'],
                    'payName' => $iData['pay_uname'],
                    'code' => $iData['paytype'],
                    'pcMobile' => $iData['mechine'],
                    'sort' => $kData,
                    'isBank' => empty($iData['bank_info'])?0:1,
                    'bankInfo' => empty($iData['bank_info'])?json_encode([]):json_encode($iData['bank_info']),
                ];
                PayTypeNewInsert::dispatch($aArray)->onQueue($this->setQueueRealName('payTypeNewInsert'));
            }
            $this->info('ok');
        }else{
            $this->info($result['msg']);
        }
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }

    public function postCurl(){
        $url = "http://45.77.242.9:8666/api/v1/payways";
        $curl = curl_init();  //初始化
        curl_setopt($curl,CURLOPT_URL,$url);  //设置url
        curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC);  //设置http验证方法
        curl_setopt($curl,CURLOPT_HEADER,0);  //设置头信息
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);  //设置curl_exec获取的信息的返回方式
        curl_setopt($curl,CURLOPT_POST,1);  //设置发送方式为post请求
        curl_setopt($curl,CURLOPT_POSTFIELDS,[]);  //设置post的数据

        $result = curl_exec($curl);
        curl_close($curl);
        if($result === false){
            return [
                'code' => 0,
                'msg' => '接口访问失败'
            ];
        }
        return $result;
    }
}
