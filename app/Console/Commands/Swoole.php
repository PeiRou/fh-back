<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class Swoole extends Command
{
    public $ws;
    public $serv;
    public $num = [];
    public $firstId = 0;
    private $doOne = [
        'CURL_PUSH_THREAD',
        'BUNKO_msnn',
        'BUNKO_pknn',
    ];
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
        sleep(3);
        $redis = Redis::connection();
        $redis->select(0);
        $redis->flushdb();        //清除所有开奖相关redis
        $key = 'thread';
        $files = Storage::disk($key)->files();
        foreach ($files as $file){
            if(Storage::disk($key)->exists($file))
                Storage::disk($key)->delete($file);
        }
        $key = 'needbunko';
        $files = Storage::disk($key)->files();
        foreach ($files as $file){
            if(Storage::disk($key)->exists($file))
                Storage::disk($key)->delete($file);
        }
        $key = 'needkill';
        $files = Storage::disk($key)->files();
        foreach ($files as $file){
            if(Storage::disk($key)->exists($file))
                Storage::disk($key)->delete($file);
        }
//        $do['code'] = '';
//        $this->timer = $this->serv->tick(1000, function($id) use ($do){
//            $redis = Redis::connection();
//            //设置ID计数器
//            $this->setId($id);
//            //开始计数器
//            foreach ($this->doOne as $k => $v){
//                echo $v.PHP_EOL;
//                $do['thread'] = $v;
//                try{
//                    $this->settimer($id,$do, $redis);
//                }catch (\exception $exception){
//                    continue;
//                }
//            }
//            echo $this->num[$id]['num'].PHP_EOL;
//            $this->num[$id]['num'] ++;
//            $redis->disconnect();
//        });
    }

    /***
     * 初始化
     */
    private function first(){
        $do['code'] = '';
        $this->timer = $this->serv->tick(1000, function($id) use ($do){
            $redis = Redis::connection();
            //开始计数器
            foreach ($this->doOne as $k => $v){
//                echo $v.PHP_EOL;
                $do['thread'] = $v;
                try{
                    $this->settimer($id,$do, $redis,0);
                }catch (\exception $exception){
                    continue;
                }
            }

            $this->firstId ++;
            echo $this->firstId.PHP_EOL;
        });
    }

    /***
     * 清空数据
     */
    private function clean(){
    }

    public function start(){
        //创建websocket服务器对象，监听0.0.0.0:2021端口
        $this->ws = new \swoole_websocket_server("0.0.0.0", 9500);

        //监听WebSocket连接打开事件
        $this->ws->on('open', function ($ws, $request) {
        });

        //监听WebSocket消息事件
        $this->ws->on('message', function ($ws, $request) {
        });
        $this->ws->on('workerStart', function ($serv,$workid) {
            $this->serv = $serv;
            $this->num = array();
            if($workid===0)
                $this->first();
        });
        $this->ws->on('request', function ($serv, $response) {
            $data['thread'] = isset($serv->post['thread'])?$serv->post['thread']:(isset($serv->get['thread'])?$serv->get['thread']:'');      //定时任务名称
            $data['thread2'] = isset($serv->post['thread2'])?$serv->post['thread2']:(isset($serv->get['thread2'])?$serv->get['thread2']:'');      //定时任务名称
            $data['code'] = '';
            if($data['thread'] == 'GameApiGetBet' || isset($serv->get['GamesApiArtisan'])){
                if(isset($serv->get['GamesApiArtisan'])) unset($serv->get['GamesApiArtisan']);
                if(isset($serv->get['thread'])) unset($serv->get['thread']);
                ob_start();
                Artisan::call($data['thread'], $serv->get);
                $response->end(ob_get_clean());
                return '';
            }else if(substr($data['thread'],0,9) == 'AgentOdds'){
                $tmp = explode('-',$data['thread']);
                $data['extra'] = ['code'=>$tmp[1],'issue'=>$tmp[2]];
                $data['thread'] = $tmp[0];
                $data['exethread'] = $tmp[0];
                $this->exeComds($data);
                return '';
            }else if(substr($data['thread'],0,7) == 'BUNKO_1'){
                $tmp = explode('_',$data['thread']);
                $data['code'] = $tmp[2];
                $data['exethread'] = 'BUNKO_1';
                $data['key'] = 'needbunko';
                $key = 'needbunko';
                $filename = time().'-needbunko-'.$data['exethread'].'-'.$data['code'];
                if(count(Storage::disk($key)->files())<200);
                    Storage::disk($key)->put($filename,json_encode($data));
                return '';
            }else if(substr($data['thread'],0,6) == 'KILL_1'){
                $tmp = explode('_',$data['thread']);
                $data['code'] = $tmp[2];
                $data['extra'] = ['code'=>$data['code']];
                $data['exethread'] = 'KILL_1';
                $data['key'] = 'needkill';
                $key = 'needkill';
                $filename = time().'-needkill-'.$data['exethread'].'-'.$data['code'];
                if(count(Storage::disk($key)->files())<200);
                    Storage::disk($key)->put($filename,json_encode($data));
                return '';
            }else if(substr($data['thread'],0,6) == 'CHECK_'){
                switch ($data['thread']){
                    case 'CHECK_BUNKO':
                        $data['key'] = 'needbunko';
                        break;
                    case 'CHECK_KILL':
                        $data['key'] = 'needkill';
                        break;
                }
                $this->timer = $this->serv->tick(1000, function($id) use ($data){
                    $redis = Redis::connection();

                    //设置ID计数器
                    $this->setId($id);
                    //开始计数器
                    $key = $data['key'];
//                    $key = 'needbunko';
                    $files = Storage::disk($key)->files();
                    $ii = 0;
                    foreach ($files as $file){
                        try{
                            if(Storage::disk($key)->exists($file) && Storage::disk($key)->delete($file)) {
                                $tmp = explode('-',$file);
                                $info['thread'] =  $tmp[2];
                                $info['exethread'] =  $tmp[2];
                                $info['code'] =  $tmp[3];
                                $info['extra'] =  ['code'=>$info['code']];
                                $rsKey = 'Artisan:'.$info['thread'].'-'.$info['code'];
    //                            echo 'do-1-'.$rsKey.PHP_EOL;
                                if($redis->exists($rsKey))
                                    continue;
    //                            echo 'do-2-'.$rsKey.PHP_EOL;
                                $this->settimer_new($id,$info, $redis);
                                $ii++;
                            }
                        }catch (\exception $exception){
                            continue;
                        }
                        if($ii>10)
                            break;
                    }
                    $this->num[$id]['num'] ++;
                    $redis->disconnect();
                });
                return false;
            }
//            else if(substr($data['thread'],0,4) == 'DO_1'){
//                echo 'dooo-1-0-'.json_encode($data).PHP_EOL;
//                $this->timer = $this->serv->tick(1000, function($id) use ($data){
//                    $redis = Redis::connection();
//
//                    //设置ID计数器
//                    $this->setId($id);
//                    //开始计数器
//                    foreach ($this->doOne as $k => $v){
//                        echo $v.PHP_EOL;
//                        $do['thread'] = $v;
//                        $do['code'] = '';
//                        try{
//                            $this->settimer($id,$do, $redis);
//                        }catch (\exception $exception){
//                            continue;
//                        }
//                    }
//                    echo $this->num[$id]['num'].PHP_EOL;
//                    $this->num[$id]['num'] ++;
//                    $redis->disconnect();
//                });
//                return false;
//            }


            if(env('IS_CLOUD',0)==0){       //如果非云主机
                DB::disconnect();
                $this->exeComds($data);
            }else{
                $redis = Redis::connection();
                $redis->select(0);
                $this->cldComds($redis,$data);
            }
        });

        //监听WebSocket连接关闭事件
        $this->ws->on('close', function ($ws, $fd) {
        });

        $this->ws->start();
    }
    //计数到60则停下
    private function settimer_new($id,$data,$redis){
        if(!isset($data['thread']) || empty($data['thread']))
            $this->serv->clearTimer($id);
        try{
            if(env('IS_CLOUD',0)==0){       //如果非云主机
                DB::disconnect();
                $this->exeComds($data);
            }else{
                $redis->select(0);
                $this->cldComds($redis,$data);
            }
        }catch (\exception $exception){
            writeLog('error',$exception->getFile(). '-> Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            writeLog('error',$data);
        }
        if($this->num[$id]['num']>=59)
            $this->serv->clearTimer($id);
    }
    //计数到60则停下
    private function settimer($id,$data,$redis,$total_num=59){
        if(!isset($data['thread']) || empty($data['thread']))
            $this->serv->clearTimer($id);
//        echo json_encode($data).PHP_EOL;
        try{
            if(env('IS_CLOUD',0)==0){       //如果非云主机
                DB::disconnect();
                $this->exeComds($data);
            }else{
                $redis->select(0);
                $this->cldComds($redis,$data);
            }
        }catch (\exception $exception){
            writeLog('error',$exception->getFile(). '-> Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            writeLog('error',$data);
        }
        if($total_num>0 && $this->num[$id]['num']>=$total_num)
            $this->serv->clearTimer($id);
    }
    private function setId($id){
        if(!isset($this->num[$id]['num']))
            $this->num[$id]['num'] = 0;
    }
    private function cldComds($redis,$data){
        $key = 'Artisan:'.$data['thread'].'-'.$data['code'];
        if(!$redis->exists($key)){
            $redis->setex($key, 60,'on');
            DB::disconnect();
            $this->exeComds($data);
            $redis->del($key);

        }
    }
    private function exeComds($data){
        if(!isset($data['extra'])||empty($data['extra'])){
//            echo 'dooo-1-'.json_encode($data).PHP_EOL;
            Artisan::call($data['thread']);
//            echo 'finished-1'.PHP_EOL;
        }else{
//            echo 'dooo-2-'.json_encode($data).PHP_EOL;
            Artisan::call($data['exethread'],$data['extra']);
//            echo 'finished-2'.PHP_EOL;
        }
    }
}