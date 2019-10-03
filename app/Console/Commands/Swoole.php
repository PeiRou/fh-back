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
        $ClassGames = new Games();
        $this->gameIdtoCode = $ClassGames->getGameData('gameIdtoCode','',['lhc']); //取得游戏id对应的游戏code，排除香港六合彩
        $this->gameCodetoTable = $ClassGames->getGameFileData('gameCodetoTable');   //取得游戏code对应的游戏table
        $tmp = $ClassGames->getGameFileData('gameKill');     //取得游戏不是官彩都要开启杀率
        foreach ($tmp as $k => $v){
            $this->gameKill[$k] = $v;
        }
        //进程一起来的时候只做一次检查
        $redis = Redis::connection();
        $redis->select(0);
        $redis->flushdb();
        foreach ($this->gameCodetoTable as $code => $table) {         //把需要结算的奖期放到redis
            $this->setNeedBunkoIssue($redis, $code, $table);
        }
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
        });
        $this->ws->on('request', function ($serv, $response) {
            $data['thread'] = isset($serv->post['thread'])?$serv->post['thread']:(isset($serv->get['thread'])?$serv->get['thread']:'');      //定时任务名称
            $data['code'] = '';

            if($data['thread'] == 'GameApiGetBet' || isset($serv->get['GamesApiArtisan'])){         //这是第三方游戏拉数据定时任务
                if(isset($serv->get['GamesApiArtisan'])) unset($serv->get['GamesApiArtisan']);
                if(isset($serv->get['thread'])) unset($serv->get['thread']);
                ob_start();
                Artisan::call($data['thread'], $serv->get);
                $response->end(ob_get_clean());
                return '';
            }else if(substr($data['thread'],0,7) == 'BUNKO_F'){     //改良的新结算，只执行一次
                $tmp = explode('_',$data['thread']);
                $data['code'] = $tmp[2];
                $data['thread'] = 'BUNKO_1';
                $this->exeComds($data);
                return '';
            }else if(substr($data['thread'],0,11) == 'CHECK_BUNKO'){     //改良的新结算，检查有需要结算的，把它放到文件做对列
                $data['dida'] = 1000;
                $data['dida_num'] = 59;
                $this->didaTimer($data);
            }else if(substr($data['thread'],0,10) == 'CHECK_EXEB'){     //改良的新结算，执行有需要结算的
                $data['dida'] = 1000;
                $data['dida_num'] = 59;
                $this->didaTimer($data);
            }else if(substr($data['thread'],0,10) == 'CHECK_KILL'){     //改良的新结算，检查有需要杀率的，把它放到文件做对列
                $data['dida'] = 1000;
                $data['dida_num'] = 59;
                $this->didaTimer($data);
            }else if(substr($data['thread'],0,10) == 'CHECK_EXEK'){     //改良的新结算，执行有需要杀率的
                $data['dida'] = 1000;
                $data['dida_num'] = 59;
                $this->didaTimer($data);
            }else{
                echo json_encode($data).PHP_EOL;
                $this->exeComds($data);
            }
        });

        //监听WebSocket连接关闭事件
        $this->ws->on('close', function ($ws, $fd) {
        });

        $this->ws->start();
    }

    //启动计数器
    private function didaTimer($data){
        $this->timer = $this->serv->tick($data['dida'], function($id) use ($data){
//            echo $data['thread'].'-----id----'.$id.'----'.$data['dida'].'----'.$data['dida_num'].PHP_EOL;
            //设置ID计数器
            $this->setId($id,$data);
            //开始计数器
            $this->settimer($id,$data);
            $this->num[$data['thread']][$id]['num']++;
        });
    }

    //计时器中间执行程序
    private function settimer($id,$data){
        if(!isset($data['thread']) || empty($data['thread']))
            $this->serv->clearTimer($id);
        try{
            switch ($data['thread']){
                case 'CHECK_BUNKO':           //改良的新结算，检查有需要结算的，把它放到文件做对列
                    $redis = Redis::connection();
                    $redis->select(0);
                    foreach ($this->gameIdtoCode as $k => $code){
                        if(empty($code))
                            continue;
                        $rsKey = $code.':needbunko--*';
                        try{
                            $needBunko = $redis->keys($rsKey);
                        }catch (\exception $exception){
                            foreach ($this->gameCodetoTable as $code => $table) {         //把需要结算的奖期放到redis
                                $this->setNeedBunkoIssue($redis, $code, $table);
                            }
                            continue;
                        }
                        if(is_array($needBunko)&&count($needBunko)>0){
                            foreach ($needBunko as $k1 => $v1){
                                $tmp = explode('--',$v1);
                                switch ($code){
                                    case 'msnn':
                                        $data['code'] = '';
                                        $data['exethread'] = 'BUNKO_msnn';
                                        break;
                                    case 'pknn':
                                        $data['code'] = '';
                                        $data['exethread'] = 'BUNKO_pknn';
                                        break;
                                    default:
                                        $data['code'] = $code;
                                        $data['exethread'] = 'BUNKO_1';
                                        break;
                                }
                                Storage::disk('needbunko')->put($data['exethread'].'-'.$data['code'].'-'.$tmp[1],json_encode($data));
//                                echo json_encode($data).PHP_EOL;
                            }
                        }
                    }
                    break;
                case 'CHECK_EXEB':           //改良的新结算，执行有需要结算的
                    $redis = Redis::connection();
                    $redis->select(0);
                    $files = Storage::disk('needbunko')->files();
                    try {
                        $ii = 0;
                        foreach ($files as $filename) {
                            if(Storage::disk('needbunko')->exists($filename)){
                                $info = json_decode(Storage::disk('needbunko')->get($filename),true);
                                $this->cldComds($redis, $info);
                                Storage::disk('needbunko')->delete($filename);
                            }
                            $ii++;
                            if ($ii > 10)
                                break;
                        }
                    } catch (\Exception $exception) {
                        writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    }
                    break;
                case 'CHECK_KILL':           //改良的新结算，检查有需要杀率的，把它放到文件做对列
                    $redis = Redis::connection();
                    $redis->select(0);
                    foreach ($this->gameKill as $gameId => $code){
                        $data['code'] = $code;
                        $data['exethread'] = 'KILL_1';
                        $this->cldComds($redis, $data);
//                        $rsKey = $code.':nextIssueLotteryTime';
//                        $LotteryTime = $redis->get($rsKey);
//                        if(empty($LotteryTime))
//                            continue;
//                        if(Storage::disk('thread')->exists('needkill-'.$code)&& time() <= Storage::disk('thread')->get('needkill-'.$code))
//                            continue;
//                        $data['code'] = $code;
//                        $data['exethread'] = 'KILL_1';
//                        $filename = ($LotteryTime+7).'--'.$code.'--'.date('H:i:s',$LotteryTime);
//                        if(time() <= (int)$LotteryTime && !Storage::disk('needkill')->exists($filename))
//                            Storage::disk('needkill')->put($filename,json_encode($data));
                    }
                    break;
//                case 'CHECK_EXEK':           //改良的新结算，执行有需要杀率的
//                    $redis = Redis::connection();
//                    $redis->select(0);
//                    $files = Storage::disk('needkill')->files();
//                    try {
//                        $ii = 0;
//                        foreach ($files as $filename) {
//                            if(Storage::disk('needkill')->exists($filename)){
//                                $info = json_decode(Storage::disk('needkill')->get($filename),true);
//                                $tmp = explode('--',$filename);
//                                if(time() >= (int)$tmp[0]) {
//                                    echo 'del--'.$info['code'].PHP_EOL;
//                                    Storage::disk('needkill')->delete($filename);
//                                }else
//                                if(time() >= (int)$tmp[0]) {
//                                    echo 'exe--'.$info['code'].PHP_EOL;
//                                    $this->cldComds($redis, $info);
//                                    Storage::disk('needkill')->delete($filename);
//                                    Storage::disk('thread')->put('needkill-'.$info['code'],time()+5);
//                                }
//                            }
//                            $ii++;
//                            if ($ii > 40)
//                                break;
//                        }
//                    } catch (\Exception $exception) {
//                        writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
//                    }
//                    break;
//                case 'CHECK_EXEK':           //改良的新结算，执行有需要杀率的
//                    $redis = Redis::connection();
//                    $redis->select(0);
//                    foreach ($this->gameKill as $gameId => $code){
//                        $rsKey = $code.':nextIssueLotteryTime';
//                        try{
//                            if($redis->exists($rsKey) && time()+10 >= (int)$redis->get($rsKey)){
//                                $data['code'] = $code;
//                                $data['exethread'] = 'KILL_1';
//                                $this->cldComds($redis, $data);
//                            }
//                        }catch (\exception $exception){
//                            continue;
//                        }
//                    }
//                    break;
                default:
                    $this->serv->clearTimer($id);
                    break;
            }
        }catch (\exception $exception){
            writeLog('error',$exception->getFile(). '-> Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            writeLog('error',$data);
        }
        if($this->num[$data['thread']][$id]['num']>=$data['dida_num'])
            $this->serv->clearTimer($id);
    }
    private function setId($id,$data){
        if(!isset($this->num[$data['thread']][$id]['num']))
            $this->num[$data['thread']][$id]['num'] = 0;
    }
    private function cldComds($redis,$data){
        $key = 'Artisan:'.$data['thread'].'-'.$data['exethread'].'-'.$data['code'];
        if(!$redis->exists($key)){
            $redis->setex($key, 60,'on');
            DB::disconnect();
            $this->exeComds($data);
            $redis->del($key);
        }
    }
    private function exeComds($data){
        if(empty($data['code'])){
            if(isset($data['exethread']))
                Artisan::call($data['exethread']);
            else
                Artisan::call($data['thread']);
        }else
            Artisan::call($data['exethread'],['code'=>$data['code']]);
    }
    private function setNeedBunkoIssue($redis,$code,$table){
        $excel = new Excel();
        if($code=='msnn')                               //只有秒速牛牛的表跟别人不一样
            $res = $excel->getNeedNNBunkoIssue($table);
        else
            $res = $excel->getNeedBunkoIssue($table);
        if($res){
            $redis->set($code.':needbunko--'.$res->issue,$res->issue);
        }
    }
}