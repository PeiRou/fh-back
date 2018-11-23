<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository\GamesApi\Card;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BaseRepository
{
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
        $this->param['ip'] = realIp();
    }
    //拼接请求数据
    public function createReqData(){
        try{
            $s = $this->param['s'];
            $timestamp = $this->Utils->microtime_int();
            $this->param['account'] = $this->param['account'] ?? '';
            $this->param['money'] = $this->param['money'] ?? 0;
            $time_str = $this->Utils->timestamp_str('YmdHis', 'Asia/Chongqing');
            $this->param['ip'] = $this->Utils->get_ip();
            $this->param['orderid'] = $this->param['orderid'] ?? $this->Config[$this->ConfigPrefix.'agent'] . $time_str . $this->param['account'];
            $lineCode =  $this->Config[$this->ConfigPrefix.'lineCode'] ?? '';
            $KindID = $this->param['KindID'] ?? 0;
//            \Log::info(print($this->user));
            $testFlag = $this->user['testFlag'];

            //处理试玩用户
            if($testFlag == 1){
                $checkIsHaveMoney = DB::table(strtolower($this->gameInfo['alias']).'list')->where('userid',$this->user['id'])->count();
                if($checkIsHaveMoney == 0){
                    $this->param['money'] = 200;
                    $this->inList(3, $this->param['money']);
                } else {
                    $this->param['money'] = 0;
                }
            }
            switch($subCmd = intval($s)) {
                case 0: // login
                    $param = http_build_query(array(
                        's' => $s,
                        'account' => $this->param['account'], //玩家账号
                        'money' => $testFlag == 1 ? $this->param['money'] : 0, //上分的金额,如果不携带分数传 0
                        'orderid' => $this->param['orderid'],
                        'ip' => $this->param['ip'],
                        'lineCode' => $lineCode, //代理下面的站点标识, 用防止站点之间导分
                        'KindID' => $KindID
                    ));
                    break;
                case 1: // 查询可下分
                    $param = http_build_query(array(
                        's' => $s,
                        'account' => $this->param['account']
                    ));
                    break;
                case 6:
                    $param = http_build_query(array(
                        's' => $s,
                        'startTime' => $this->getMillisecond() - (1000 * 10 * 60),
                        'endTime' => $this->getMillisecond()
                    ));
                    break;
                case 8: // force one player offline
                    $param = http_build_query(array(
                        's' => $s,
                        'account' => $this->param['account']
                    ));
                    break;
                case 3: // 下分
                    $param = http_build_query(array(
                        's' => $s,
                        'account' => $this->param['account'],
                        'orderid' => $this->param['orderid'],
                        'money' => $this->param['money'],
                        'ip' => $this->param['ip']
                    ));
                    break;
                case 2: //上分
                    $param = http_build_query(array(
                        's' => $s,
                        'account' => $this->param['account'],
                        'orderid' => $this->param['orderid'],
                        'money' => $this->param['money'],
                        'ip' => $this->param['ip']
                    ));
                    break;
                case 4: //查询订单状态
                    $param = http_build_query(array(
                        's' => $s,
                        'orderid' => $this->param['orderid'],
                        'ip' => $this->param['ip']
                    ));
                    break;
            }
            \Log::info($this->user['username'].$this->gameInfo->name.json_encode($param));
            $url = $s != 6 ? $this->Config[$this->ConfigPrefix.'apiUrl'] : $this->Config[$this->ConfigPrefix.'recordUrl'];
            $url .= '?' . http_build_query(array(
                    'agent' => $this->Config[$this->ConfigPrefix.'agent'],
                    'timestamp' => $timestamp,
                    'param' => $this->Utils->desEncode($this->Config[$this->ConfigPrefix.'desKey'], $param),
                    'key' => md5($this->Config[$this->ConfigPrefix.'agent'].$timestamp.($this->Config[$this->ConfigPrefix.'md5Key']))
                ));
            $this->requrl = $url;
//            \Log::info($url);
            \Log::info($this->user['username'].$this->gameInfo->name.$url);
            return true;
        }catch (\Exception $e){
           \Log::info($this->gameInfo->name.'请求错误!'.$e->getMessage());
            return false;
        }
    }
    public function req(){
        $res = $this->Utils->curl_get_content($this->requrl);
        \Log::info($res);
        if(!$this->reqData = @json_decode($res, true)){
            \Log::info($this->gameInfo->name.'-请求超时');
        };
    }
    //获取时间
    public function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return  sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
    //处理返回数据
    public function createRes(){
        if(empty($this->reqData) || is_null($this->reqData)){
            return false;
        }
        $res_json = $this->reqData;
        $res_m = @$res_json['s'];
        $res_code = @$res_json['d']['code'];
        if(isset($res_json['d']['code']) && $res_json['d']['code'] == 0){
            //登录游戏
            if($res_m == 100){
                return [
                    'status' => true,
                    'data' => ['url'=>$res_json['d']['url']]
                ];
            }
            //刷新余额
            if($res_m == 101){
                return [
                    'status' => true,
                    'data' => ['money'=>$res_json['d']['money']]
                ];
            }
            //上分
            if($res_m == 102){
                return [
                    'status' => true,
                    'data' => ['money'=>$res_json['d']['money']]//上分后可下分金额
                ];
            }
            //下分
            if($res_m == 103){
                return [
                    'status' => true,
                    'data' => ['money'=>$res_json['d']['money']],//下分后可下分金额
                ];
            }
            //查订单状态
            if($res_m == 104 && isset($res_json['d']['status']) && $res_json['d']['status'] == 0){
                return [
                    'status' => true,
                    'data' => ['money'=>$res_json['d']['money']],//订单交易金额
                ];
            }
            return [
                'status' => false,
                'data' => $res_json['d']
            ];
        } else {
            return [
                'status' => false,
                'data' => [
                    'errorCode' => $res_code,
                    'errorMsg' => $this->errorMessage($res_code)
                ]
            ];
        }
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