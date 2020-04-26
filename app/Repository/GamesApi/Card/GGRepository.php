<?php

namespace App\Repository\GamesApi\Card;


class GGRepository extends BaseRepository
{
    public $is_proxy_pass = true; //这个游戏是否使用代理那台服务器

    public function __construct($config){
        parent::__construct($config);
    }

    public $gameListArr = [];

    public function login()
    {
        $param = [
            'username' => $this->getUserName(),
            'app_id' => (int)($this->param['app_id'] ?? 0),
            'ip' => $this->param['ip'] ?? $this->defaultIp,
            'browser' => $this->param['browser'] ?? 'pc',
            'lang' => $this->param['lang'] ?? 'zh-cn',
            'is_demo' => $this->param['is_demo'] ?? false,
        ];
        $res = $this->request($param, '', 'LOGIN');
        return $this->show(0, '', [
            'url' => $res['url']
        ]);
    }

    public function pvp($index)
    {
        $param = [
            'index' => $index,
            'count' => 100,
            'org' => (int)$this->getConfig('org')
        ];
        $res = $this->request($param, '', 'GAMELOG');
        if($res['count']){
            $this->pvp_createData($res['list']);
        }
    }

    public function pvp_createData($aData)
    {
        $GameIDs = $this->distinct($aData, 'index');
        $insert = [];
        foreach ($aData as $v){
            if(in_array($v['index'], $GameIDs))
                continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['index'],
                'sessionId' => $v['game_record'] ?? '',
                'username' => $v['user_name'],
                'AllBet' => $v['total_pay'],
                'bet_money' => $v['total_pay'],
                'bunko' => $v['profit'],
                'GameStartTime' => date('Y-m-d H:i:s', strtotime($v['start_time'])),
                'GameEndTime' =>  date('Y-m-d H:i:s', strtotime($v['end_time'])),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s', strtotime($v['end_time'])),
                'gameCategory' => 'PVP',
                'game_type' => $v['app_name'] ?? '',
                'service_money' => $v['revenue'] ?? 0,
                'flag' => 1,
                'game_id' => $this->gameListArr['game_id'],
                'round_id' => $v['room_id'] ?? '',  //局号
            ];
            $array['content'] = $this->pvp_content($v) ?: $array['game_type'];
            $user = $this->getUser($array['username']);
            $array['username'] = $user->username ?? $array['username'];
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $insert[] = $array;
        }

        return count($insert) && $this->insertDB($insert);
    }

    public function pvp_content($v)
    {
        try{
            $str = '';
            if(isset($v['game_record'])) {
                $str .= '游戏单号:' . $v['game_record'].'<br />';
            }
            if(isset($v['room_id'])) {
                $str .= '房间号:' . $v['room_id'].'<br />';
            }
            if(isset($v['user_name'])) {
                $str .= '游戏内账号:' . $v['user_name'].'<br />';
            }
            if(isset($v['balance'])) {
                $str .= '结算后余额:' . $v['balance'].'<br />';
            }
            return $str;
        }catch (\Throwable $e){
            writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.var_export($e->getTraceAsString(), 1));
            return '';
        }
    }

    public function rng($index)
    {
        $param = [
            'index' => $index,
            'count' => 100,
            'org' => (int)$this->getConfig('org')
        ];
        $res = $this->request($param, '', 'GAMELOG');
        if($res['count']){
            $this->rng_createData($res['list']);
        }
    }

    public function rng_createData($aData)
    {
        $GameIDs = $this->distinct($aData, 'index');
        $insert = [];
        foreach ($aData as $v){
            if(in_array($v['index'], $GameIDs))
                continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['index'],
                'sessionId' => $v['game_record'] ?? '',
                'username' => $v['user_name'],
                'AllBet' => $v['total_pay'],
                'bet_money' => $v['total_pay'],
                'bunko' => $v['profit'] - $v['total_pay'],
                'GameStartTime' => date('Y-m-d H:i:s', strtotime($v['start_time'])),
                'GameEndTime' =>  date('Y-m-d H:i:s', strtotime($v['end_time'])),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s', strtotime($v['end_time'])),
                'gameCategory' => 'RNG',
                'game_type' => $v['app_name'] ?? '',
                'service_money' => 0,
                'flag' => 1,
                'game_id' => $this->gameListArr['game_id'],
                'round_id' => $v['index'] ?? '',  //局号
            ];
            $array['content'] = $this->pvp_content($v) ?: $array['game_type'];
            $user = $this->getUser($array['username']);
            $array['username'] = $user->username ?? $array['username'];
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $insert[] = $array;
        }

        return count($insert) && $this->insertDB($insert);
    }

    public function request($param, $url, $method)
    {
        static $i = false;
        if(empty($url)){
            switch ($this->gameListArr['game_id']){
                case 45:
                    $key = 'apiUrlP'; break;
                case 46:
                    $key = 'apiUrlR'; break;
                default:
                    throw new \Exception('游戏id错误', 102);
                    break;
            }
            $url = $this->getConfig($key);
        }
        $this->WriteLog($url.json_encode($param));
        $data = [
            'pid' => $this->getConfig('ID'),
            'ver' => '1.0.0',
            'method' => $method,
            'data' => $this->desEncode($param, $this->getConfig('apiKey')),
        ];
        $data = json_encode($data);
        $res = $this->curl_post_content($url, $data, '',['Content-Type:application/json'], 10, 15);
        if(empty($res = @json_decode($res, 1))){
            throw new \Exception('请求超时', 500);
        }
        if(isset($res['code']) && $res['code'] === 0){
            return $this->desDecode($res['data'], $this->getConfig('apiKey'));
        }else{
            if(isset($res['code']) && $res['code'] === 11 && !$i){
                $i = true;
                $this->register();
                return $this->request($param, $url, $method);
            }
            throw new \Exception($this->getCode($res['code'] ?? 500) ?? $res['message'], $res['code'] ?? 500);
        }
    }

    public function desEncode($param, $key)
    {
        ksort($param,SORT_NATURAL);
        $orig_data = json_encode($param);
//        $orig_data = $this->pkcs5_unpad($orig_data);
        $iv = substr($key, 0, 16);
        $encrypt_str = openssl_encrypt($orig_data, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return urlencode(base64_encode($encrypt_str));
    }
    public function desDecode($param, $key)
    {
        $data=urldecode($param);
        $data=base64_decode($data);
        $data=openssl_decrypt($data,'AES-128-CBC',$key,OPENSSL_RAW_DATA ,substr($key,0,16));
        if($data === false)
            throw new \Exception('数据解密失败', 102);
        $data=json_decode($data,true);
        return $data;
    }

    public function pkcs5_unpad($text)
    {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
        return substr($text, 0, -1 * $pad);
    }

    public function getCode($code)
    {
        return [0=>'调用成功',
                1=>'发生未定义错误',
                2=>'发生系统错误',
                3=>'参数错误',
                4=>'API调用方法不存在',
                5=>'商户数据错误或商户不存在',
                6=>'商户已经被停用',
                7=>'IP地址访问受限',
                8=>'数据签名有误，解密失败',
                9=>'业务接口参数错误',
                10=>'业务数据处理失败',
                11=>'用户数据未找到，请先调用注册接口以激活用户数据',
                12=>'当前用户已被禁用，无法开始游戏',
                13=>'游戏代码错误',
                14=>'游戏已暂停运行',
                15=>'更新用户信息失败',
                16=>'商户游戏配置数据错误',
                17=>'交易单号已使用，无法重复使用',
                18=>'操作失败，用户余额不足',
                19=>'分销商子站点数据错误',
                20=>'分销商子站点已禁用',
                21=>'玩家正在进行百人场游戏，无法转出余额',][$code] ?? 'error';
    }
}