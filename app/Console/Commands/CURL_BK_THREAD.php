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
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_bjkl8');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_pk10');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_cqssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_cqxync');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_gd11x5');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_gdklsf');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_gsk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_gxk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_gzk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_hbk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_hebeik3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_jsk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_msft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_msjsk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_qqffc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_msnn');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_mssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_msssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_paoma');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_pcdd');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_pknn');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xjssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xylhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_kssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_ksft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_ksssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_twxyft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_sfsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_sfssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_jslhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_sflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xyft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_ahk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xykl8');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xylsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xylft');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xylssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xy28');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_twbgc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_twbg28');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_hlsx');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_yfsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_yfssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_yflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_efsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_efssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_eflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_wfsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_wfssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_wflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_shfsc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_shfssc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_shflhc');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_hkk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_yfk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_efk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_sfk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_wfk3');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_xyft168');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_azxy5');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_azxy8');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_azxy10');
            $this->pushData('http://127.0.0.1:9500?thread=BUNKO_1_azxy20');

            $this->pushData('http://127.0.0.1:9500?thread2=push');

            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_msft');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_mssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_msssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_paoma');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_xylhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_msjsk3');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_qqffc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_kssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_ksft');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_ksssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_twxyft');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_sfsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_sfssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_jslhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_sflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_xykl8');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_xylsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_xylft');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_xylssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_yfsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_yfssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_yflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_efsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_efssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_eflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_wfsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_wfssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_wflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_shfsc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_shfssc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_shflhc');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_hkk3');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_yfk3');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_efk3');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_sfk3');
            $this->pushData('http://127.0.0.1:9500?thread=KILL_1_wfk3');

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
