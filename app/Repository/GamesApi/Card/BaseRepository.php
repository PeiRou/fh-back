<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository\GamesApi\Card;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected $otherModel;
    public $Utils = null; //依赖类
    public $gameInfo = []; //游戏信息
    public $Config = []; //配置
    public $param = []; //参数
    public $user = []; //用户信息
    public $ConfigPrefix = ''; //试玩用户会加上前缀
    public $resData = null; //请求返回数据
    public function __construct($config, $name = 'Utils'){
        $class = 'App\\Repository\\GamesApi\\Card\\Utils\\'.$name;
        $this->Utils = new $class($config);
        $this->Config = $config;
//        $this->param['ip'] = realIp();
    }
    public function getOtherModel($model){
        if(empty($this->otherModel->$model)) {
            $model = '\App\\'.ucfirst($model);
            $this->otherModel->$model = new $model;
        }
        return $this->otherModel->$model;
    }
    //插入数据库
    public function insertDB($data){
        if($this->table->insert($data)){
            echo $this->gameInfo->name.'插入'.count($data).'条数据';
        }else{
            echo $this->gameInfo->name.'插入'.count($data).'条数据失败';
        }
    }
    //格式化数据  插入数据库
    public function createData($data){
        $table = $this->table;
        //根据GameID Accounts去掉重复的
        foreach ($data['GameID'] as $k => $k){
            $table->orWhere(['GameID'=>$data['GameID'][$k]])
                ->where([
                    'Accounts' => $data['Accounts'][$k],
                    'g_id' => $this->gameInfo->g_id
                ]);
        }
        $distinctArr = $table->pluck('GameID')->toArray();
        $res['GameID'] = array_diff($data['GameID'],$distinctArr);
        $arr = [];
        foreach ($data['GameID'] as $k => $k){
            $arr[] = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $data['GameID'][$k],
                'Accounts' => $data['Accounts'][$k],
                'AllBet' => $data['AllBet'][$k],
                'Profit' => $data['Profit'][$k],
//                'Revenue' => $res['Revenue'][$k],
                'GameStartTime' => $data['GameStartTime'][$k],
                'GameEndTime' => $data['GameEndTime'][$k],
            ];
        }
        $this->insertDB($arr);
    }

    //拼接请求数据
    public function createReqData(){
        try{
            $s = $this->param['s'];
            $timestamp = $this->Utils->microtime_int();
            $time_str = $this->Utils->timestamp_str('YmdHis', 'Asia/Chongqing');
//            $this->param['ip'] = $this->Utils->get_ip();
//            $this->param['orderid'] = $this->param['orderid'] ?? $this->Config[$this->ConfigPrefix.'agent'] . $time_str . $this->param['account'];
            switch($subCmd = intval($s)) {
                case 6:
                    $param = http_build_query(array(
                        's' => $s,
                        'startTime' => $this->param['startTime'],
                        'endTime' => $this->param['endTime']
                    ));
                    break;
            }
            $url = $s != 6 ? $this->Config[$this->ConfigPrefix.'apiUrl'] : $this->Config[$this->ConfigPrefix.'recordUrl'];
            $url .= '?' . http_build_query(array(
                    'agent' => $this->Config[$this->ConfigPrefix.'agent'],
                    'timestamp' => $timestamp,
                    'param' => $this->Utils->desEncode($this->Config[$this->ConfigPrefix.'desKey'], $param),
                    'key' => md5($this->Config[$this->ConfigPrefix.'agent'].$timestamp.($this->Config[$this->ConfigPrefix.'md5Key']))
                ));
            $res = json_decode($this->Utils->curl_get_content($url), true);
            if(!empty($res)){
                if(isset($res['d']['code']) && $res['d']['code'] == 0){
                    return $this->show(0, '', $res['d']);
                }
                return $this->show($res['d']['code'], $this->errorMessage($res['d']['code']));
            }
            return $this->show(500, '超时');
        }catch (\Exception $e){
            return $this->show(1, $e->getMessage());
        }
    }

    //获取时间
    public function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return  sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    //增加用户资金明细
    public function inCapital($type, $content, $nowMoney){
        $time = time();
        $content = '平台钱包';
        if($type == 't23') {
            $time += 1;
            $content = $content . ' - ' . $this->gameInfo->name;
        }else if($type == 't24'){
            $content = $this->gameInfo->name . ' - ' . $content;
        }
        $data = [
            'to_user' => $this->user['id'],
            'user_type' => 'user',
            'order_id' => $this->param['orderid'],
            'type' => $type,
            'money' => $this->param['money'],
            'balance' => $nowMoney,
            'operation_id' => 0,
            'issue' => 0,
            'game_id' => $this->gameInfo->type_id,
            'game_name' => '棋牌游戏',
            'playcate_id' => $this->gameInfo->type_id.'00'.$this->gameInfo->g_id,
            'playcate_name' => $this->gameInfo->name,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s', $time),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        return DB::table('capital')->insert($data);
    }
    //增加棋牌游戏表
    public function inList($type, $resmoney){
        $data = [
            'order_id' => $this->param['orderid'],
            'userid' => $this->user['id'],
            'username' => $this->user['username'],
            'type' => $type,
            'amount' => $this->param['money'],
            'date' => date('Y-m-d H:i:s'),
            'money_before' => 0,
            'money_after' => $resmoney,
            'ip' => $this->param['ip']
        ];
        return DB::table('jq_'.strtolower($this->gameInfo['alias']).'list')->insert($data);
    }
    protected function show($code = '', $msg = '', $data = []){
        $data = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return $data;
    }
    protected function errorMessage($code){
        $codeMessage = '未知错误,请联系在线客服';
        switch ($code){
            case 1:
                $codeMessage = '登录过期，请重新登录';
                break;
            case 2:
                $codeMessage = '渠道不存在';
                break;
            case 3:
                $codeMessage = '验证时间超时';
                break;
            case 4:
                $codeMessage = '验证错误';
                break;
            case 5:
                $codeMessage = '渠道白名单错误';
                break;
            case 6:
                $codeMessage = '验证字段丢失';
                break;
            case 8:
                $codeMessage = '不存在的请求';
                break;
            case 15:
                $codeMessage = '渠道验证错误';
                break;
            case 16:
                $codeMessage = '数据不存在(当前没有注单)';
                break;
            case 20:
                $codeMessage = '账号禁用';
                break;
            case 22:
                $codeMessage = 'AES解密失败';
                break;
            case 24:
                $codeMessage = '渠道拉取数据超过时间范围';
                break;
            case 26:
                $codeMessage = '订单号不存在';
                break;
            case 27:
                $codeMessage = '数据库异常';
                break;
            case 28:
                $codeMessage = 'IP禁用';
                break;
            case 29:
                $codeMessage = '订单号与订单规则不符';
                break;
            case 30:
                $codeMessage = '获取玩家在线状态失败';
                break;
            case 31:
                $codeMessage = '更新的分数小于或者等于0';
                break;
            case 32:
                $codeMessage = '更新玩家信息失败';
                break;
            case 33:
                $codeMessage = '更新玩家金币失败';
                break;
            case 34:
                $codeMessage = '订单重复';
                break;
            case 35:
                $codeMessage = '获取玩家信息失败，您还没有登录过游戏';
                break;
            case 36:
                $codeMessage = 'KindID不存在';
                break;
            case 37:
                $codeMessage = '登录瞬间禁止下分，导致下分失败';
                break;
            case 38:
                $codeMessage = '余额不足导致下分失败';
                break;
            case 39:
                $codeMessage = '禁止同一账号登录带分、上分、下分并发请求，后一个请求被拒';
                break;
            case 40:
                $codeMessage = '单次上下分数量不能超过一千万';
                break;
            case 41:
                $codeMessage = '拉取对局汇总统计时间范围有误';
                break;
            case 42:
                $codeMessage = '代理被禁用';
                break;
            case 43:
                $codeMessage = '拉单过于频繁(两次拉单时间间隔必须大于1秒)';
                break;
            case 1001:
                $codeMessage = '注册会员账号系统异常';
                break;
            case 1002:
                $codeMessage = '代理商金额不足，请联系在线客服';
                break;
        }
        return $codeMessage;
    }

}