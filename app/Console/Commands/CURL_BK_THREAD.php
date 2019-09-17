<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CURL_BK_THREAD extends Command
{

    protected $signature = 'CURL_BK_THREAD';
    protected $description = '执行所有的定时任务';
    private $urls = array();

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
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_bjkl8');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_bjpk10');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_cqssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_cqxync');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_gd11x5');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_gdklsf');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_gsk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_gxk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_gzk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_hbk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_hebeik3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_jsk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_msft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_msjsk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_qqffc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_msnn');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_mspk10');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_msssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_paoma');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_pcdd');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_pknn');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_xjssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_xylhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_kssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_ksft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_ksssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_twxyft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_sfsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_sfssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_jslhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_sflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_xyft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_ahk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_xykl8');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_xylsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_xylft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_xylssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_xy28');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_twbgc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_twbg28');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_hlsx');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_yfsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_yfssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_yflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_efsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_efssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_eflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_wfsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_wfssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_wflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_shfsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_shfssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_shflhc');

            $this->pushData('http://127.0.0.1:9500?thread=KILL_msft');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_mssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_msssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_paoma');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_xylhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_msjsk3');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_qqffc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_kssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_ksft');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_ksssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_twxyft');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_sfsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_sfssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_jslhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_sflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_xykl8');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_xylsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_xylft');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_xylssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_yfsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_yfssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_yflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_efsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_efssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_eflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_wfsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_wfssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_wflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_shfsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_shfssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_shflhc');

            //组装后一起发送
            $this->sendUrl();
        }
    }
    private function pushData($url){
        $this->urls[] = $url;
    }
    private function sendUrl(){
        $apiData = $this->urls;
        $mh = curl_multi_init();
        $conn = array();
        foreach ($apiData as $i => $url) {
            $conn[$i] = curl_init($url);
            curl_setopt($conn[$i], CURLOPT_URL, $url);
            curl_setopt($conn[$i], CURLOPT_HEADER, 0);
            curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($conn[$i], CURLOPT_TIMEOUT, 1);
            curl_multi_add_handle($mh,$conn[$i]);
        }
        $active=null;
//3、并发执行，直到全部结束。
        do {
            curl_multi_exec($mh, $active);
        } while ($active);

//4、获取结果
        foreach ($apiData as $i => $url) {
            $data = curl_multi_getcontent($conn[$i]);
            $httpcode = curl_getinfo($conn[$i], CURLINFO_HTTP_CODE);
            $err = curl_errno($conn[$i]);
            if (($err) || (!in_array($httpcode,array(200,500))))
                echo date('Y-m-d H:i:s').' '.$url.'**** '.$httpcode.PHP_EOL;
            else
                echo date('Y-m-d H:i:s').' '.$url.'**** ok'.PHP_EOL;
        }

//5、移除子handle，并close子handle
        foreach ($apiData as $i => $url) {
            curl_multi_remove_handle($mh,$conn[$i]);
            curl_close($conn[$i]);
        }

        curl_multi_close($mh);
    }
}
