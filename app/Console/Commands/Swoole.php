<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use SameClass\Config\LotteryGames\Games;

class Swoole extends Command
{
    public $ws;
    public $serv;
    public $num = [];
    public $gameIdtoCode = [];
    public $gameCodetoTable = [];
    public $gameKill = [];
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
        $this->ws->on('workerStart', function ($serv) {
            $this->serv = $serv;
            $this->num = array();
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
            }else if(substr($data['thread'],0,7) == 'BUNKO_1'){
                $tmp = explode('_',$data['thread']);
                $data['code'] = $tmp[2];
                $data['thread'] = 'BUNKO_1';
            }else if(substr($data['thread'],0,6) == 'KILL_1'){
                $tmp = explode('_',$data['thread']);
                $data['code'] = $tmp[2];
                $data['thread'] = 'KILL_1';
            }
            $this->timer = $this->serv->tick(1000, function($id) use ($data){
//                $this->maxId = $id>$this->maxId?$id:$this->maxId;
                $redis = Redis::connection();

                //设置ID计数器
                $this->setId($id);
                //开始计数器
                $this->settimer($id,$data, $redis);
                $this->num[$id]['num'] ++;
                $redis->disconnect();
            });
        });

        //监听WebSocket连接关闭事件
        $this->ws->on('close', function ($ws, $fd) {
        });

        $this->ws->start();
    }
    //计数到60则停下
    private function settimer($id,$data,$redis){
        if(!isset($data['thread']) || empty($data['thread']))
            $this->serv->clearTimer($id);
        try{
            if(env('IS_CLOUD',0)==0){       //如果非云主机
                DB::disconnect();
                $this->exeComds($data);
            }else{
                $redis->select(0);
                if(isset($this->num[$id]['cmds']))
                    foreach ($this->num[$id]['cmds'] as $key => $val ){
                        $this->cldComds($redis,$val,'cmds',$id);
                    }
                else
                    $this->cldComds($redis,$data);
            }
        }catch (\exception $exception){
            writeLog('error',$exception->getFile(). '-> Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            writeLog('error',$data);
        }
        if($this->num[$id]['num']>=59)
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
        if(empty($data['code']))
            Artisan::call($data['thread']);
        else
            Artisan::call($data['thread'],['code'=>$data['code']]);
    }
}