<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class Swoole extends Command
{
    public $ws;
    public $serv;
    public $num;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole {action?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'swoole';

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
        $action = $this->argument('action');
        switch ($action) {
            case 'close':
                break;
            case 'clean':
                $this->clean();
                die;
                break;
            case 'start':
                $this->init();
            default:
                $this->start();
                break;
        }
    }

    /***
     * 初始化
     */
    private function init(){
        if(in_array(env('MODEL_TYPE',0),[0,1])){
            $redis = Redis::connection();
            $redis->select(0);
            $redis->flushdb();        //清除所有开奖相关redis
            if(Storage::disk('thread')->exists('thread')){
                Storage::disk('thread')->delete('thread');
            }
        }
        $directories = Storage::disk('logs')->directories();
        foreach ($directories as $key => $val){
            Storage::disk('logs')->deleteDirectory($val);
        }
        $files =  Storage::disk('logs')->files();
        if(count($files)>0)
            Storage::disk('logs')->delete($files);
    }

    /***
     * 清空数据
     */
    private function clean(){
    }

    public function start(){
        //创建websocket服务器对象，监听0.0.0.0:2021端口
        $this->ws = new \swoole_websocket_server("0.0.0.0", 9500);
        $this->ws->set([
            'worker_num'      => 3,
        ]);
        //监听WebSocket连接打开事件
        $this->ws->on('open', function ($ws, $request) {
        });

        //监听WebSocket消息事件
        $this->ws->on('message', function ($ws, $request) {
        });
        $this->ws->on('workerStart', function ($serv,$worker_id) {
            $this->serv = $serv;
            if(in_array(env('MODEL_TYPE',0),[0,1])){
                $Games = new \SameClass\Config\LotteryGames\Games();
                //取得需要做杀率的
                $doKillArrary = $Games->setlottery([],'isGuan',2);

                //取得需要做结算的的
                $doBunkoArrary = $Games->setlottery([],'isGuan',1);
                $doBunkoArrary1 = $Games->setlottery([],'isGuan',3);
                $doBunkoArrary = array_merge($doBunkoArrary,$doBunkoArrary1);
                unset($doBunkoArrary1);
                $doBunkoArrary = array_merge($doKillArrary,$doBunkoArrary);

                $excel = new \App\Excel;
                switch ($worker_id){
                    case 0:     //杀率
                        $this->serv->tick(1000, function($id) use ($excel,$doKillArrary) {
                            $this->urls = [];
                            $redis = Redis::connection();
                            foreach ($doKillArrary as $code){
                                try{
                                    $checkNeedKill = $excel->checkNeedKill($code);
                                    if($checkNeedKill){
                                        $send = 'KILL_1_'.$code;
                                        $this->pushData('http://127.0.0.1:9500?thread='.$send);
                                    }
                                }catch (\Exception $e) {
                                    writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
                                }
                            }
                            if(count($this->urls)>0)
                                $this->sendUrl();
                            $redis->disconnect();
                        });
                        break;
                    case 1:     //结算
                        $this->serv->tick(1000, function($id) use ($excel,$doBunkoArrary) {
                            $this->urls = [];

                            $redis = Redis::connection();
                            foreach ($doBunkoArrary as $code){
                                try{
                                    $checkNeedKill = !$excel->stopBunko($code, 0,'BunkoCP');
                                    if($checkNeedKill){
                                        if($code=='msnn' || $code=='pknn')
                                            $send = 'BUNKO_'.$code;
                                        else
                                            $send = 'BUNKO_1_'.$code;
                                        $this->pushData('http://127.0.0.1:9500?thread='.$send);
                                    }
                                }catch (\Exception $e) {
                                    writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
                                }
                            }
                            if(count($this->urls)>0)
                                $this->sendUrl();
                            $redis->disconnect();
                        });
                        break;
                }
            }
        });
        $this->ws->on('request', function ($serv, $response) {
            $data['thread'] = isset($serv->post['thread'])?$serv->post['thread']:(isset($serv->get['thread'])?$serv->get['thread']:'');      //定时任务名称
            $data['code'] = '';
            if($data['thread'] == 'GameApiGetBet' || isset($serv->get['GamesApiArtisan'])){
                if(isset($serv->get['GamesApiArtisan'])) unset($serv->get['GamesApiArtisan']);
                if(isset($serv->get['thread'])) unset($serv->get['thread']);
                ob_start();
                Artisan::call($data['thread'], $serv->get);
                $response->end(ob_get_clean());
                return '';
            }else if(substr($data['thread'],0,6) == 'BUNKO_'){
                $tmp = explode('_',$data['thread']);
                if(isset($tmp[2]))
                    $data['code'] = $tmp[2];
                $data['thread'] = $tmp[0].'_'.$tmp[1];
            }else if(substr($data['thread'],0,6) == 'KILL_1'){
                $tmp = explode('_',$data['thread']);
                $data['code'] = $tmp[2];
                $data['thread'] = 'KILL_1';
            }else if(substr($data['thread'],0,9) == 'AgentOdds'){
                $tmp = explode('-',$data['thread']);
                $data['extra'] = ['code'=>$tmp[1],'issue'=>$tmp[2]];
                $data['thread'] = $tmp[0];
                $this->exeComds_one($data);
                return '';
            }
            $this->doIt($data);
        });

        //监听WebSocket连接关闭事件
        $this->ws->on('close', function ($ws, $fd) {
        });

        $this->ws->start();
    }
    //计数到60则停下
    private function doIt($data){
        try{
            if(env('IS_CLOUD',0)==0){       //如果非云主机
                DB::disconnect();
                $this->exeComds($data);
            }else{
                $this->cldComds($data);
            }
        }catch (\exception $exception){
            writeLog('error',$exception->getFile(). '-> Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            writeLog('error',$data);
        }
    }
    private function cldComds($data){
        $key = 'Artisan:'.$data['thread'].'-'.$data['code'];
        $redis = Redis::connection();
        if(!$redis->exists($key)){
            $redis->setex($key, 60,'on');
            DB::disconnect();
            $this->exeComds($data);
            $redis->del($key);
        }
        $redis->disconnect();
    }
    private function exeComds($data){
        if(!in_array(env('MODEL_TYPE',0),[0,1])){
            writeLog('doIt',$data);
        }
        if(empty($data['code']))
            Artisan::call($data['thread']);
        else
            Artisan::call($data['thread'],['code'=>$data['code']]);
    }
    private function exeComds_one($data){
        Artisan::call($data['thread'],$data['extra']);
    }

    //这里以下只是组装执行多CURL---start
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
//        foreach ($apiData as $i => $url) {
//            $data = curl_multi_getcontent($conn[$i]);
//            $httpcode = curl_getinfo($conn[$i], CURLINFO_HTTP_CODE);
//            $err = curl_errno($conn[$i]);
//            if (($err) || (!in_array($httpcode,array(200,500))))
//                echo date('Y-m-d H:i:s').' '.$url.'**** '.$httpcode.PHP_EOL;
//            else
//                echo date('Y-m-d H:i:s').' '.$url.'**** ok'.PHP_EOL;
//        }

//5、移除子handle，并close子handle
        foreach ($apiData as $i => $url) {
            curl_multi_remove_handle($mh,$conn[$i]);
            curl_close($conn[$i]);
        }

        curl_multi_close($mh);
    }
    //这里以下只是组装执行多CURL---end
}