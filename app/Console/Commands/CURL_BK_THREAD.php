<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class CURL_BK_THREAD extends Command
{

    protected $signature = 'CURL_BK_THREAD';

    protected $description = '执行所有的定时任务';

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
        $now = time();
        $thread_time = $now;
        if(Storage::disk('thread')->exists('thread')){
            $thread_time = Storage::disk('thread')->get('thread');
            $thread_time = explode('***',$thread_time);
            $thread_time = $thread_time[1];
        }
        if(!Storage::disk('thread')->exists('thread')||($thread_time<$now)){
            Storage::disk('thread')->put('thread', date('Y-m-d H:i:s',$now).'***'.($now+50));
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_bjkl8');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_bjpk10');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_cqssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_cqxync');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_gd11x5');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_gdklsf');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_gsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_gxk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_gzk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_hbk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_hebeik3');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_jsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_msft');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_msjsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_qqffc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_msnn');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_mspk10');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_msssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_paoma');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_pcdd');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_pknn');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_xjssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_xylhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_kssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_ksft');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_ksssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_twxyft');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_sfsc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_sfssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_jslhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_sflhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_xyft');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_ahk3');

            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_msft');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_mssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_msssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_paoma');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_xylhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_msjsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_qqffc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_kssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_ksft');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_ksssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_twxyft');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_sfsc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_sfssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_jslhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_sflhc');
            //清数据
//            $this->exeCURL('http://127.0.0.1:9500?thread=clear_data');
        }
    }
    private function exeCURL($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_errno($curl);
        curl_close($curl);
        if (($err) || (!in_array($httpcode,array(200,500))))
            echo $httpcode.PHP_EOL;
        else
            echo $url.'**** ok'.PHP_EOL;
    }
}