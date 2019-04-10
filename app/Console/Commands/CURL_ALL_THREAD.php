<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class CURL_ALL_THREAD extends Command
{

    protected $signature = 'CURL_ALL_THREAD';

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
            $thread_time = explode('-',$thread_time);
            $thread_time = $thread_time[1];
        }
        if(!Storage::disk('thread')->exists('thread')||($thread_time<time())){
            Storage::disk('thread')->put('thread', date('Y-m-d H:i:s',$now).'-'.($now+59));
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_pk10');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_pknn');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_pcdd');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_xylhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_cqssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_bjkl8');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_mssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_msssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_paoma');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_msft');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_msjsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_qqffc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_gsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_gxk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_gzk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_hbk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_hebeik3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_jsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_xjssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_gd11x5');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_cqxync');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_gdklsf');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_kssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_ksft');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_ksssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_twxyft');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_pk10');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_pknn');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_pcdd');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_cqssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_bjkl8');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_mssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_msssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_paoma');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_xylhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_msft');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_msjsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_qqffc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_gsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_gxk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_gzk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_hbk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_hebeik3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_jsk3');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_xjssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_gd11x5');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_cqxync');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_gdklsf');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_kssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_ksft');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_ksssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_twxyft');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_ahk3');
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
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_sfsc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_sfssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_jslhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_issue_sflhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_sfsc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_sfssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_jslhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=next_open_sflhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_sfsc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_sfssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_jslhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=BUNKO_sflhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_sfsc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_sfssc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_jslhc');
            $this->exeCURL('http://127.0.0.1:9500?thread=KILL_sflhc');
            //清数据
            $this->exeCURL('http://127.0.0.1:9500?thread=clear_data');
        }
    }
    private function exeCURL($url){
        $thread = explode('?',$url);
        if(isset($thread[1])){
            $redis = Redis::connection();
            $redis->select(0);
            $redis_issue = $redis->get($thread[1]);
            if(!$redis->exists($redis_issue)){
                $redis->setex($thread[1],1,'ing');
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HEADER, 0);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_TIMEOUT, 1);
                curl_exec($curl);
                curl_close($curl);
            }
        }
    }
}
