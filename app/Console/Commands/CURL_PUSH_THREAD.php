<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CURL_PUSH_THREAD extends Command
{

    protected $signature = 'CURL_PUSH_THREAD';
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
        $key = 'thread-push';
//        if(Storage::disk('thread')->exists($key)){
//            $thread_time = Storage::disk('thread')->get($key);
//            $thread_time = explode('***',$thread_time);
//            $thread_time = $thread_time[1];
//        }
//        if(!Storage::disk('thread')->exists($key)||($thread_time<$now)){
//            Storage::disk('thread')->put($key, date('Y-m-d H:i:s',$now).'***'.($now+1));
            $this->pushData('BUNKO_1-needbunko-bjkl8');
            $this->pushData('BUNKO_1-needbunko-pk10');
            $this->pushData('BUNKO_1-needbunko-cqssc');
            $this->pushData('BUNKO_1-needbunko-cqxync');
            $this->pushData('BUNKO_1-needbunko-gd11x5');
            $this->pushData('BUNKO_1-needbunko-gdklsf');
            $this->pushData('BUNKO_1-needbunko-gsk3');
            $this->pushData('BUNKO_1-needbunko-gxk3');
            $this->pushData('BUNKO_1-needbunko-gzk3');
            $this->pushData('BUNKO_1-needbunko-hbk3');
            $this->pushData('BUNKO_1-needbunko-hebeik3');
            $this->pushData('BUNKO_1-needbunko-jsk3');
            $this->pushData('BUNKO_1-needbunko-msft');
            $this->pushData('BUNKO_1-needbunko-msjsk3');
            $this->pushData('BUNKO_1-needbunko-qqffc');
            $this->pushData('BUNKO_1-needbunko-mssc');
            $this->pushData('BUNKO_1-needbunko-msssc');
            $this->pushData('BUNKO_1-needbunko-paoma');
            $this->pushData('BUNKO_1-needbunko-pcdd');
            $this->pushData('BUNKO_1-needbunko-xjssc');
            $this->pushData('BUNKO_1-needbunko-xylhc');
            $this->pushData('BUNKO_1-needbunko-kssc');
            $this->pushData('BUNKO_1-needbunko-ksft');
            $this->pushData('BUNKO_1-needbunko-ksssc');
            $this->pushData('BUNKO_1-needbunko-twxyft');
            $this->pushData('BUNKO_1-needbunko-sfsc');
            $this->pushData('BUNKO_1-needbunko-sfssc');
            $this->pushData('BUNKO_1-needbunko-jslhc');
            $this->pushData('BUNKO_1-needbunko-sflhc');
            $this->pushData('BUNKO_1-needbunko-xyft');
            $this->pushData('BUNKO_1-needbunko-ahk3');
            $this->pushData('BUNKO_1-needbunko-xykl8');
            $this->pushData('BUNKO_1-needbunko-xylsc');
            $this->pushData('BUNKO_1-needbunko-xylft');
            $this->pushData('BUNKO_1-needbunko-xylssc');
            $this->pushData('BUNKO_1-needbunko-xy28');
            $this->pushData('BUNKO_1-needbunko-twbgc');
            $this->pushData('BUNKO_1-needbunko-twbg28');
            $this->pushData('BUNKO_1-needbunko-hlsx');
            $this->pushData('BUNKO_1-needbunko-yfsc');
            $this->pushData('BUNKO_1-needbunko-yfssc');
            $this->pushData('BUNKO_1-needbunko-yflhc');
            $this->pushData('BUNKO_1-needbunko-efsc');
            $this->pushData('BUNKO_1-needbunko-efssc');
            $this->pushData('BUNKO_1-needbunko-eflhc');
            $this->pushData('BUNKO_1-needbunko-wfsc');
            $this->pushData('BUNKO_1-needbunko-wfssc');
            $this->pushData('BUNKO_1-needbunko-wflhc');
            $this->pushData('BUNKO_1-needbunko-shfsc');
            $this->pushData('BUNKO_1-needbunko-shfssc');
            $this->pushData('BUNKO_1-needbunko-shflhc');
            $this->pushData('BUNKO_1-needbunko-hkk3');
            $this->pushData('BUNKO_1-needbunko-yfk3');
            $this->pushData('BUNKO_1-needbunko-efk3');
            $this->pushData('BUNKO_1-needbunko-sfk3');
            $this->pushData('BUNKO_1-needbunko-wfk3');

            $this->pushData('KILL_1-needkill-msft');
            $this->pushData('KILL_1-needkill-mssc');
            $this->pushData('KILL_1-needkill-msssc');
            $this->pushData('KILL_1-needkill-paoma');
            $this->pushData('KILL_1-needkill-xylhc');
            $this->pushData('KILL_1-needkill-msjsk3');
            $this->pushData('KILL_1-needkill-qqffc');
            $this->pushData('KILL_1-needkill-kssc');
            $this->pushData('KILL_1-needkill-ksft');
            $this->pushData('KILL_1-needkill-ksssc');
            $this->pushData('KILL_1-needkill-twxyft');
            $this->pushData('KILL_1-needkill-sfsc');
            $this->pushData('KILL_1-needkill-sfssc');
            $this->pushData('KILL_1-needkill-jslhc');
            $this->pushData('KILL_1-needkill-sflhc');
            $this->pushData('KILL_1-needkill-xykl8');
            $this->pushData('KILL_1-needkill-xylsc');
            $this->pushData('KILL_1-needkill-xylft');
            $this->pushData('KILL_1-needkill-xylssc');
            $this->pushData('KILL_1-needkill-yfsc');
            $this->pushData('KILL_1-needkill-yfssc');
            $this->pushData('KILL_1-needkill-yflhc');
            $this->pushData('KILL_1-needkill-efsc');
            $this->pushData('KILL_1-needkill-efssc');
            $this->pushData('KILL_1-needkill-eflhc');
            $this->pushData('KILL_1-needkill-wfsc');
            $this->pushData('KILL_1-needkill-wfssc');
            $this->pushData('KILL_1-needkill-wflhc');
            $this->pushData('KILL_1-needkill-shfsc');
            $this->pushData('KILL_1-needkill-shfssc');
            $this->pushData('KILL_1-needkill-shflhc');
            $this->pushData('KILL_1-needkill-hkk3');
            $this->pushData('KILL_1-needkill-yfk3');
            $this->pushData('KILL_1-needkill-efk3');
            $this->pushData('KILL_1-needkill-sfk3');
            $this->pushData('KILL_1-needkill-wfk3');


            $this->pushData_old('http://127.0.0.1:9500?thread=CHECK_BUNKO');
            $this->pushData_old('http://127.0.0.1:9500?thread=CHECK_KILL');

            //组装后一起发送
            $this->sendUrl();
//        }
    }
    private function pushData($tmp){
//        echo $tmp.PHP_EOL;
        $tmp = explode('-',$tmp);
        $data['code'] = $tmp[2];
        $data['extra'] = ['code'=>$data['code']];
        $data['exethread'] = $tmp[0];
        $data['key'] = $tmp[1];
        $key = $tmp[1];
        $filename = time().'-'.$tmp[1].'-'.$data['exethread'].'-'.$data['code'];
//        echo $filename.PHP_EOL;
        if(count(Storage::disk($key)->files())<200);
            Storage::disk($key)->put($filename,json_encode($data));
    }
    private function pushData_old($url){
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
