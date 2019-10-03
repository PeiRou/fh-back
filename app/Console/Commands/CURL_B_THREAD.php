<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CURL_B_THREAD extends Command
{

    protected $signature = 'CURL_B_THREAD';
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
            $this->pushData('http://127.0.0.1:9500?thread=CHECK_BUNKO');
            usleep(20000);
            $this->pushData('http://127.0.0.1:9500?thread=CHECK_EXEB');
            usleep(50000);
            $this->pushData('http://127.0.0.1:9500?thread=CHECK_BUNKO');
            usleep(20000);
            $this->pushData('http://127.0.0.1:9500?thread=CHECK_EXEB');

            //组装后一起发送
            $this->sendUrl();
        }
    }
//    private function pushData($url){
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_HEADER, 0);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_TIMEOUT, 2);
//        curl_exec($curl);
//        $res = curl_exec($curl);
//        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//        $err = curl_errno($curl);
//        curl_close($curl);
//        if (($err) || (!in_array($httpcode,array(200,500))))
//            echo date('Y-m-d H:i:s').' '.$url.'**** '.$httpcode.PHP_EOL;
//        else
//            echo date('Y-m-d H:i:s').' '.$url.'**** ok'.PHP_EOL;
//    }
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
