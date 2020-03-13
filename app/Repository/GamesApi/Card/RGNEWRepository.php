<?php
/* NN棋牌 */

namespace App\Repository\GamesApi\Card;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class RGNEWRepository extends BaseRepository
{

    public $is_proxy_pass = true; //这个游戏是否使用代理那台服务器

    public function __construct($config){
        parent::__construct($config,'Utils');
    }

    public function hook($f, ...$args)
    {
        try{
            return call_user_func([$this, $f], ...$args);
        }catch (\Throwable $e){
            if(!$e->getCode())
                throw  $e;
            return $this->show($e->getCode(), $e->getMessage());
        }
    }

    public function getBet1()
    {
        $param = [
            "agent" => $this->getConfig('agent'),
            "deadline" => $this->param['start_time'] ?? date('Y-m-d H:i:s',strtotime("-1 day")),
        ];
        $param['sign'] = sha1($this->getToken() .'|'. $param['deadline'] .'|'. $param['agent']);

        $res = $this->request($param, $this->getConfig('orderList_api'));
        $code = $res['code'] == 0 ? 1 : $res['code'];
        if($res['code'] === 0){
            $this->createData($res['data']);
            $code = 0;
        }
        return $this->show($code, $this->code($res['code']) ?? $res['msg']);
    }

    public function getBet()
    {
        $res = $this->hook('getBet1');
        $this->insertError($res['code'] ?? 123, $res['msg'] ?? 'error');
        return $res;
    }

    public function createData($aData)
    {

        $insert = [];
        foreach ($aData as $v){
            $GameID = DB::table('jq_bet')->where('GameID',$v['round_no'])->value('GameID');
            Redis::select(11);
            Redis::setex('rgnew_start_time', 60 * 60 * 2, $v['start_time']);
            if($v['start_time'] = $GameID)
                continue;
            if($v['is_mark'] = 0 ?? '')
                continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['round_no'],
                'sessionId' => $v['round_no'],
                'username' => $v['user_name'],
                'AllBet' => $v['total_bet_score'],
                'bunko' => $v['total_win_score'],
                'bet_money' => $v['valid_bet_score_total'],
                'GameStartTime' => $v['start_time'],
                'GameEndTime' =>  $v['start_time'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['start_time'],
                'gameCategory' => 'LIVE',
                'bet_info' => $v['game_period'],
                'game_type' => $v['game_name'] ?? '',
                'service_money' => 0,
                'flag' => $v['is_mark'],
                'game_id' => 35,
                'round_id' => $v['dwRound'] ?? '',  //局号
            ];
            $array['content'] = '';
            $user = $this->getUser($array['username']);
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            if($array);
            $insert[] = $array;
        }

        return count($insert) && $this->insertDB($insert);
    }


    public function getUserName()
    {
        return $this->getConfig('agent').$this->user['username'];
    }

    private function getToken()    //判断密钥是否生效
    {
        $redis = Redis::connection();
        $redis->select(12);
        $key = 'rgnewapi_token';
        if(!$token = $redis->get($key)){
            $res = $this->agentLogin();
            $token = $res['data']['private_key'];
            $date = $res['data']['expired_at'];
            $redis->setex($key,strtotime($date)- time(), $token);
        }
        return $token;
    }

    private function agentLogin()   //获取密钥
    {
        $param = [
            "agent" => $this->getConfig('agent'),
            "sign" => sha1($this->getConfig('agent')),
        ];

        $res = $this->request($param,$this->getConfig('privateKey_api'));
        if($res['code'] !== 0){
            throw new \Exception($this->code($res['code']) ?? $res['msg'], $res['code']);
        }
        return $res;

    }

    public function request($param, $url)
    {
        $res = $this->curl_post_content($url,$param ,'',['Content-Type:application/x-www-form-urlencoded'], 10, 15);
        if(empty($res = @json_decode($res, 1))){
            throw new \Exception('请求超时', 500);
        }
        if(isset($res['code']) && $res['code'] === 0) {
            return $res;
        }
        if(isset($res['code']) && $res['code'] === 5500) {
            throw new \Exception($this->code($res['code']) ?? $res['msg'], $res['code']);
        }
        throw new \Exception('未知异常，请联系客服', 500);
    }

    public function createOrderId()
    {
        $this->param['orderid'] = $this->Config[$this->ConfigPrefix.'agent'] . $this->orderNumber() . $this->user['username'];
        return $this->param['orderid'];
    }


    private function code($code)
    {
        return [
                0 => '成功',
                4000 => '参数缺失',
                4001 => '参数不合法',
                4002 => 'IP限制',
                4003 => '调试会员人数超额',
                4004 => '不能创建测试账户',
                4005 => '玩家登录频繁',
                4006 => '请求频繁',
                4007 => '请求时间区域跨度大',
                4100 => '代理不存在',
                4101 => '会员不存在',
                5000 => '系统维护',
                5100 => '代理配置错误',
                5101 => '非正常账户',
                5200 => '密钥过期',
                5201 => '密钥获取失败',
                5300 => '账户创建失败',
                5400 => '额度转换转入失败',
                5401 => '会员的余额不足',
                5402 => '额度转换转出失败',
                5403 => '序列号错误',
                5404 => '代理额度不足',
                5405 => '额度转换金额错误',
                5406 => '订单已存在',
                5500 => '数据为空'
            ][$code] ?? '';
    }
}