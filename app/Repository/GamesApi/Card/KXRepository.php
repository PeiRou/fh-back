<?php
/* 开心棋牌 */

namespace App\Repository\GamesApi\Card;

use App\Repository\GamesApi\Card\Utils\kx_Aes_lib;
use Illuminate\Support\Facades\DB;

class KXRepository extends BaseRepository
{
    public function __construct($config){

        $this->Config = $config;
        $this->homeurl = 'https://'.($_SERVER['HTTP_HOST'] ?? '');
//        $this->param['ip'] = realIp() ?? '';
    }

    //格式化数据  插入数据库
    public function createData($data){
        $where = ' g_id = '.$this->gameInfo->g_id.' and GameID in ("'.implode('","', $data['id']).'")';
        $GameIDs = DB::select('select GameID from jq_bet
                where 1 and '.$where.'
                union
                select GameID from jq_bet_his
                where 1 and '.$where);

        $res['GameID'] = array_diff($data['id'],array_map(function($v){
            return $v->GameID;
        },$GameIDs));
        $arr = [];
        foreach ($res['GameID'] as $k => $k){
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $data['id'][$k],
                'username' => str_replace($this->Config['siteID'].'_','',$data['account'][$k]),
                'AllBet' => $data['bet'][$k],
                'bunko' => sprintf("%.2f", $data['settlement'][$k] - $data['bet'][$k]), //中奖金额 - 下注金额
                'bet_money' => $data['bet'][$k],
                'GameStartTime' => date('Y-m-d H:i:s', $data['ctime'][$k]),
                'GameEndTime' =>  date('Y-m-d H:i:s', $data['ctime'][$k]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s', $data['ctime'][$k]),
                'gameCategory' => 'PVP',
                'serviceMoney' => 0,
            ];
            $user = $this->getUser($array['username']);
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $arr[] = $array;
        }

        return $this->insertDB($arr);
    }

    private function request_api($parms)
    {
        $parms['sign'] = md5($this->Config['GAME_API_MERCHANT_ID'].$parms['curtime'].$this->Config['GAME_API_MD5KEY']);
        $aes = new kx_Aes_lib();
        $aes->set_key($this->Config['GAME_API_AESKEY']);
        $aes->require_pkcs5();
        $token = $aes->encrypt(json_encode($parms,JSON_UNESCAPED_UNICODE));
        $res = $this->curl_get($this->Config['GAME_API_URL'].'?m='.$this->Config['GAME_API_MERCHANT_ID'].'&token='.urlencode($token));
        if(empty($res = @json_decode($res, 1))){
            return $this->show(500);
        }
        if($res['code'] == 0){
            $res['code'] -= 2;
        }
        return $res;
    }

    // 获取游戏大厅地址
    public function login()
    {
        $parms = [
            's' => 'login',
            'curtime' => time(),
            'account' => $this->Config['siteID'].'_'.$this->user['username'],
            'siteID' => $this->Config['siteID'],
            'homeurl' => urlencode($this->homeurl),
            'gtype' => $this->param['gtype'] ?? 0,
        ];
        $res_str = $this->request_api($parms);
        return $res_str;
    }

    //  获取试玩大厅网址
    public function trial()
    {
        $parms = [
            's' => 'trial',
            'curtime' => time(),
            'homeurl' => urlencode($this->homeurl),
        ];
        $res_str = $this->request_api($parms);
        return $res_str;
    }

    // 获取游戏列表和各房间列表
    public function grlist()
    {
        $parms = [
            's' => 'grlist',
            'curtime' => time(),
            'homeurl' => urlencode($this->homeurl),
        ];
        $res_str = $this->request_api($parms);
        return $res_str;
    }

    // 获取余额
    public function getBalance()
    {
        $parms = [
            's' => 'getBalance',
            'curtime' => time(),
            'account' => $this->Config['siteID'].'_'.$this->user['username'],
        ];
        $res_str = $this->request_api($parms);
        return $res_str;
    }

    // 转入金额
    public function recharge()
    {
        $parms = [
            's' => 'recharge',
            'curtime' => time(),
            'account' => $this->Config['siteID'].'_'.$this->user['username'],
            'money' => $this->param['money'],
            'orderNo' => $this->param['orderid'],
        ];
        $res_str = $this->request_api($parms);
        return $res_str;
    }

    // 转出金额
    public function withdraw()
    {
        $parms = [
            's' => 'withdraw',
            'curtime' => time(),
            'account' => $this->Config['siteID'].'_'.$this->user['username'],
            'money' => $this->param['money'],
            'orderNo' => $this->param['orderid'],
        ];
        $res_str = $this->request_api($parms);
        return $res_str;
    }

    // 查询玩家注单列表
    public function betList()
    {
        $parms = [
            's' => 'betList',
            'curtime' => time(),
            'startTime' => $this->param['startTime'],
            'endTime' => $this->param['endTime'],
        ];
        $res_str = $this->request_api($parms);
        return $res_str;
    }

    //查询订单
    public function queryOrder()
    {
        $parms = [
            's' => 'queryOrder',
            'curtime' => time(),
            'orderNo' => $this->param['orderid'],
        ];
        $res_str = $this->request_api($parms);
        return $res_str;
    }

    /**
     * 通过curl进行GET请求
     */
    public function curl_get($url){
        $headerArray =array("Content-type:application/json;","Accept:application/json");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headerArray);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * 通过curl进行POST请求
     * @param $post_data （字典类型）
     */
    public function curl_post($post_data, $url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

    public $code = [
        '1' => '处理成功',
        '2' => '处理失败',
        '3' => '不存在商户',
        '4' => '错误的 token',
        '5' => '错误的签名',
        '6' => '不在 ip 白名单',
        '500' => '超时',
    ];


}