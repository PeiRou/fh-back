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
        $this->ws->on('request', function ($serv) {
            $data['thread'] = isset($serv->post['thread'])?$serv->post['thread']:(isset($serv->get['thread'])?$serv->get['thread']:'');      //定时任务名称
//            $data['post'] = @$serv;

            $this->timer = $this->serv->tick(1000, function($id) use ($data){
                $redis = Redis::connection();

                //设置ID计数器
                $this->setId($id);
                //开始计数器
                $this->settimer($id,$data, $redis);
                $this->num[$id] ++;
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
            $thread = explode('-',$data['thread']);
            switch ($thread[0]){
                case 'PARAM_PUSH_WIN':                                  //特殊请求-中奖推送消息
                    $post['notice'] = $data['post']->post['notice'];
                    $post['userid'] = $data['post']->post['userid'];
                    writeLog('pusher','swoole:'.json_encode($post));
                    Artisan::call('PARAM_PUSH_WIN',$post);
                    $this->num[$id]=59;
                    break;
                default:
                    if(env('IS_CLOUD',0)==0){       //如果非云主机
                        DB::disconnect();
                        Artisan::call($data['thread']);
                    }else{
                        $redis->select(0);
                        $key = 'Artisan:'.$data['thread'];
                        if(!$redis->exists($key)){
                            $redis->setex($key, 60,'on');
                            DB::disconnect();
                            Artisan::call($data['thread']);
                            $redis->del($key);
                        }
                    }
                    break;
            }
        }catch (\exception $exception){
            writeLog('error',$exception->getFile(). '-> Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            writeLog('error','this commands error :'.$data['thread']);
        }
        if($this->num[$id]>=59)
            $this->serv->clearTimer($id);
    }
    private function setId($id){
        if(!isset($this->num[$id]))
            $this->num[$id] = 0;
    }
}