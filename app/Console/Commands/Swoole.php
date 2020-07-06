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
    public $maxId = 8;
    public $threadArray= [
        'BUNKO_1_bjkl8','BUNKO_1_pk10','BUNKO_1_cqssc','BUNKO_1_cqxync','BUNKO_1_gd11x5','BUNKO_1_gdklsf','BUNKO_1_gsk3',
        'BUNKO_1_gxk3','BUNKO_1_gzk3','BUNKO_1_hbk3','BUNKO_1_hebeik3','BUNKO_1_jsk3','BUNKO_1_msft','BUNKO_1_msjsk3',
        'BUNKO_1_qqffc','BUNKO_msnn','BUNKO_1_mssc','BUNKO_1_msssc','BUNKO_1_paoma','BUNKO_1_pcdd','BUNKO_pknn',
        'BUNKO_1_xjssc','BUNKO_1_xylhc','BUNKO_1_kssc','BUNKO_1_ksft','BUNKO_1_ksssc','BUNKO_1_twxyft',
        'BUNKO_1_sfsc','BUNKO_1_sfssc','BUNKO_1_jslhc','BUNKO_1_sflhc','BUNKO_1_xyft','BUNKO_1_ahk3',
        'BUNKO_1_xykl8','BUNKO_1_xylsc','BUNKO_1_xylft','BUNKO_1_xylssc','BUNKO_1_xy28','BUNKO_1_twbgc',
        'BUNKO_1_twbg28','BUNKO_1_hlsx','BUNKO_1_yfsc','BUNKO_1_yfssc','BUNKO_1_yflhc','BUNKO_1_efsc','BUNKO_1_efssc',
        'BUNKO_1_eflhc','BUNKO_1_wfsc','BUNKO_1_wfssc','BUNKO_1_wflhc','BUNKO_1_shfsc','BUNKO_1_shfssc','BUNKO_1_shflhc',
        'BUNKO_1_hkk3','BUNKO_1_yfk3','BUNKO_1_efk3','BUNKO_1_sfk3','BUNKO_1_wfk3',
        'BUNKO_1_xyft168','BUNKO_1_azxy5','BUNKO_1_azxy8','BUNKO_1_azxy10','BUNKO_1_azxy20',
        'KILL_1_msft','KILL_1_mssc','KILL_1_msssc',
        'KILL_1_paoma','KILL_1_xylhc','KILL_1_msjsk3','KILL_1_qqffc','KILL_1_kssc','KILL_1_ksft','KILL_1_ksssc','KILL_1_twxyft',
        'KILL_1_sfsc','KILL_1_sfssc','KILL_1_jslhc','KILL_1_sflhc','KILL_1_xykl8','KILL_1_xylsc','KILL_1_xylft','KILL_1_xylssc',
        'KILL_1_yfsc','KILL_1_yfssc','KILL_1_yflhc','KILL_1_efsc','KILL_1_efssc','KILL_1_eflhc','KILL_1_wfsc','KILL_1_wfssc',
        'KILL_1_wflhc','KILL_1_shfsc','KILL_1_shfssc','KILL_1_shflhc','KILL_1_hkk3','KILL_1_yfk3','KILL_1_efk3','KILL_1_sfk3','KILL_1_wfk3'
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
        $redis = Redis::connection();
        $redis->select(0);
        $redis->flushdb();        //清除所有开奖相关redis
        if(Storage::disk('thread')->exists('thread')){
            Storage::disk('thread')->delete('thread');
        }
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
            if(empty($data['thread2'])){
                if($data['thread'] == 'GameApiGetBet' || isset($serv->get['GamesApiArtisan'])){
                    if(isset($serv->get['GamesApiArtisan'])) unset($serv->get['GamesApiArtisan']);
                    if(isset($serv->get['thread'])) unset($serv->get['thread']);
                    ob_start();
                    Artisan::call($data['thread'], $serv->get);
                    $response->end(ob_get_clean());
                    return '';
                }else if(substr($data['thread'],0,6) == 'BUNKO_'){
                    $tmp = explode('_',$data['thread']);
                    if(isset($tmp[2])){
                        $data['code'] = $tmp[2];
                        $data['thread'] = $tmp[0].'_'.$tmp[1];
                    }
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
            }else if($data['thread2']=='push'){
                $ii = 1;
                foreach ($this->threadArray as $key => $val){
                    if(substr($val,0,7) == 'BUNKO_1'){
                        $tmp = explode('_',$val);
                        $data['code'] = $tmp[2];
                        $data['thread'] = 'BUNKO_1';
                    }else if(substr($val,0,6) == 'KILL_1'){
                        $tmp = explode('_',$val);
                        $data['code'] = $tmp[2];
                        $info['extra'] =  ['code'=>$data['code']];
                        $data['thread'] = 'KILL_1';
                    }
                    $tmpIndex = ($ii%$this->maxId)+1;
                    $this->num[$tmpIndex]['cmds'][$data['thread'].'-'.$data['code']] = $data;
                    $ii++;
                }
            }
//            echo json_encode($data).PHP_EOL;
            $this->timer = $this->serv->tick(1000, function($id) use ($data){
                $this->maxId = $id>$this->maxId?$id:$this->maxId;
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
    private function exeComds_one($data){
//        echo json_encode($data).PHP_EOL;
        Artisan::call($data['thread'],$data['extra']);
    }
}