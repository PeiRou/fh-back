<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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

            $this->timer = $this->serv->tick(1000, function($id) use ($data){
                //设置ID计数器
                $this->setId($id);
                //开始计数器
                $this->settimer($id,$data);
                $this->num[$id] ++;
            });
        });

        //监听WebSocket连接关闭事件
        $this->ws->on('close', function ($ws, $fd) {
        });

        $this->ws->start();
    }
    //计数到60则停下
    private function settimer($id,$data){
        if(!isset($data['thread']) || empty($data['thread']))
            $this->serv->clearTimer($id);
        try{
            DB::disconnect();
//            Artisan::call($data['thread']);
            if(empty(env('BACK_URL', ''))){
                Artisan::call($data['thread']);
            }else{
                file_get_contents(env('BAKE_URL').'/artisan/'.$data['thread']);
            }
//            exec('php /www/wwwroot/back/fh-back/artisan '.$data['thread']);
        }catch (\exception $exception){
            \Log::info($exception->getFile(). '-> Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            \Log::info('this commands error :'.$data['thread']);
        }
        if($this->num[$id]>=59)
            $this->serv->clearTimer($id);
    }
    private function setId($id){
        if(!isset($this->num[$id]))
            $this->num[$id] = 0;
    }
}