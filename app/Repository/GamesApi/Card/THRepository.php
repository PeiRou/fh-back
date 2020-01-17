<?php

namespace App\Repository\GamesApi\Card;


use App\GamesListPlay;

class THRepository extends BaseRepository
{
    public $is_proxy_pass = true; //这个游戏是否使用代理那台服务器

    public function __construct($config){
        parent::__construct($config);
    }

    public function login()
    {
        $res = $this->token();
        if($this->param['source'] === 'pc'){
            $url = $res['loginurl_pc'];
        }else{
            $url = $res['loginurl'];
        }
        return $this->show(0, '', [
            'url' => $url
        ]);
    }

    public function getBet()
    {
        $param = [
            'username' => $this->param['username'] ?? '',
            'query_date' => $this->param['query_date'],
            'starttime' => $this->param['starttime'],
            'endtime' => $this->param['endtime'],
            'ip' => $this->ip(),
        ];
        $res = $this->request($param, $this->getConfig('apiUrl').'/gamerecord');
        $this->createData($res['info']);
        return $this->show(0);
    }

    public function createData($aData)
    {
        $GameIDs = $this->distinct($aData, 'desk_uuid');
        $insert = [];
        foreach ($aData as $v){
            if(in_array($v['desk_uuid'], $GameIDs)) continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['desk_uuid'],
                'sessionId' => '',
                'username' => explode('@', $v['username'])[0] ?? $v['username'],
                'AllBet' => $v['deal_money'],
                'bunko' => $v['win_money'],
                'bet_money' => $v['deal_money'],
                'GameStartTime' => $v['end_time'],
                'GameEndTime' =>  $v['end_time'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['end_time'],
                'gameCategory' => 'PVP',
                'bet_info' => '',
                'game_type' => $this->getGameType($v['game_type']),
                'service_money' => $v['tax_money'] ?? 0,
                'flag' => 1,
                'game_id' => 44,
                'round_id' => $v['desk_uuid'],  //局号
            ];
            $array['content'] = $this->content($v, $array) ?: $array['game_type'];
            $user = $this->getUser($array['username']);
            $array['username'] = $user->username ?? $array['username'];
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $insert[] = $array;
        }
        return $this->insertDB($insert);
    }

    public function content($v, $array)
    {
        $str = $array['game_type'] . '<br />';
        if(!empty($roomType = $this->getRoomType($v['room_type'])))
            $str .= $roomType . '<br />';
        $str .= '下注前余额：' . ($v['start_money'] ?? 0);
        return $str;
    }
    public function getGameType($key)
    {
//        static $list;
//        if (is_null($list))
//            $list = GamesListPlay::getOneList(43);
//        if (!empty($list->get($key)->game_name))
//            return $list->get($key)->game_name;
        return [
            '1002'=>'炸金花',
            '1015'=>'十三水',
            '1018'=>'德州扑克',
            '1027'=>'百人牌九',
            '1031'=>'百人牛牛',
            '1034'=>'对战牛牛',
            '1036'=>'通比牛牛',
            '1037'=>'通杀牛牛',
            '1038'=>'抢庄牌九',
            '1042'=>'抢庄牛牛',
            '1055'=>'看牌抢庄牛',
            '1056'=>'运气牛牛',
            '1062'=>'通比梭哈',
            '1092'=>'急速炸金花',
            '2021'=>'三公',
            '6000'=>'土豪奖池',
            '6002'=>'牛牛喜金',
            '1128'=>'金蟾海王2',
            '2022'=>'捕鸟达人',
            '1097'=>'四人梭哈',
            '1115'=>'金蟾捕鱼',
            '1117'=>'大闹天宫1',
            '1118'=>'大闹天宫2',
            '1120'=>'李逵劈鱼',
            '1122'=>'大圣捕鱼',
            '1126'=>'十点半',
            '1129'=>'百家乐',
            '1130'=>'二八杠',
            '1236'=>'水浒传',
            '2005'=>'龙虎大战',
            '2018'=>'红包扫雷',
            '1101'=>'财神到',
            '1235'=>'水果机',
            '1238'=>'九线拉王',
            '1201'=>'天豪斗地主比赛',
            '6001'=>'炸金花喜钱',
            '2020'=>'寻龙夺宝',
            '2019'=>'捕鱼来了3D',
        ][$key] ?? '';
    }

    public function getRoomType($key)
    {
        return [
            0=>'自由场',
            2=>'周赛',
            4=>'整点赛',
            6=>'5分钟赛',
            8=>'六人赛',
            13=>'练习场',
            1=>'普通场',
            3=>'九人赛',
            5=>'半点赛',
            7=>'三人赛',
            9=>'商盟赛',
        ][$key] ?? null;
    }

    public function ip()
    {
        return '127.0.0.1';
    }

    // 用户授权
    public function token()
    {
        $param = [
            'username' => $this->getUserName(),
            'money' => $this->param['money'] ?? 0,
            'orderid' => $this->param['orderid'] ?? $this->createOrderId(),
            'linecode' => $this->getConfig('lineCode'),
            'ip' => $this->param['ip'],
            'gametype' => $this->param['gametype'] ?? null,
            'roomlevel' => 1,
            'showbackbutton' => $this->param['showbackbutton'] ?? 0, // 0-不显示 1-返回大厅 2-返回上送的backurl
            'backurl' => $this->homeurl,
        ];
        $res = $this->request($param, $this->getConfig('apiUrl').'/gameauth');
        return $res;
    }

    public function getMoney()
    {
        $param = [
            'username' => $this->getUserName().$this->getConfig('Suffix'),
            'ip' => $this->param['ip'],
        ];
        $res = $this->request($param, $this->getConfig('apiUrl').'/getmoney');
        return $this->show(0, '', [
            'money' => $res['bag_money']
        ]);
    }

    public function request($param, $url)
    {
        static $i = false;
        $data = [
            'userid' => $this->getConfig('userid'),
            'timestamp' => $this->getTimestamp(),
            'params' => $this->desEncode($param, $this->getConfig('desKey'))
        ];
        $this->WriteLog($url.json_encode($param));
        $data['sig'] = md5($data['userid'] . $data['timestamp'] . $this->getConfig('md5Key'));
        $url = $url . '?' . http_build_query($data);
        $res = $this->curl_get_content($url);
//        p($res, 1);
        if(empty($res = @json_decode($res, 1))){
            throw new \Exception('请求超时', 500);
        }
        if(isset($res['code']) && $res['code'] === '0'){
            return $res;
        }else{
            if(isset($res['code']) && $res['code'] === '11' && !$i){
                $i = true;
                $this->token();
                return $this->request($param, $url);
            }
            throw new \Exception($this->getCode($res['code'] ?? 500), $res['code'] ?? 500);
        }
    }

    public function createOrderId()
    {
        $this->param['orderid'] = $this->param['orderid'] ?? (function(){
                $str = $this->guid();
                $str = trim($str, '{}');
                return $str;
            })();
        return $this->param['orderid'];
    }

    public function getTimestamp()
    {
        $this->param['timestamp'] = $this->param['timestamp'] ?? (int)(microtime(true) * 1000);
        return $this->param['timestamp'];
    }

    public function getUserName($up = true)
    {
        $name = strtolower($this->getConfig('agent').$this->user['username']);
        $name = preg_replace('/[^A-Za-z0-9]/', '', $name);
        $name = substr($name, 0, 15);
        return $this->getName($name, '', '', $up);
    }

    public function desEncode($param, $key)
    {
        $orig_data = urldecode(http_build_query($param));
//        $orig_data = $param;
        $key = hash('sha256', $key, true);
        $key = substr($key, 0, 32);
        $iv = substr($key, 0, 16);
        $orig_data = $this->pkcs7padding(($orig_data), 16);
        $encrypt_str = openssl_encrypt($orig_data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv);
        return base64_encode($encrypt_str);
    }

    public function pkcs7padding($data, $blocksize) {
        $padding = $blocksize - strlen($data) % $blocksize;
        $padding_text = str_repeat(chr($padding), $padding);
        return $data . $padding_text;
    }

    public function getConfig($val = null)
    {
        $value = parent::getConfig($val);
        if($val === 'Suffix')
            $value = '@'.$value;
        return $value; // TODO: Change the autogenerated stub
    }

    function guid(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
            return $uuid;
        }
    }

    public function getCode($code)
    {
        return [1=>'信息不完整（缺少参数或名称错误）',
            2=>'平台不存在(未在我们平台开通第三方)',
            3=>'平台已关闭（第三方接入为关闭状态）',
            4=>'字符校验不通过（md5签名校验不通过）',
            5=>'请求已失效，请重新发起请求(请求时间戳失效)',
            6=>'用户授权失败1（api服务器发生错误）',
            7=>'用户授权失败2（用户未创建成功）',
            8=>'params中的值错误',
            9=>'平台转入金额不能为空',
            10=>'平台转入金额不能小于等于0',
            11=>'未登录用户',
            12=>'用户信息错误（查询不到用户信息）',
            13=>'你的账号在游戏中(不能进行转入和转出)',
            14=>'金额过大（大于5000000）',
            15=>'重复订单',
            16=>'平台转入失败',
            17=>'平台转出金额不能为空',
            18=>'平台转出金额不能小于等于0',
            19=>'游戏中不能进行平台转出',
            20=>'金额不足',
            40=>'gametype参数错误',
            42=>'gametype不能超过20个字符',
            70=>'roomlevel参数错误',
            72=>'showbackbutton参数非法',
            74=>'backurl参数错误',
            76=>'权限不足',
            21=>'平台转出失败',
            22=>'时间区间错误（结束时间大于开始时间）',
            23=>'时间区间间隔不能超过30分钟',
            24=>'查询日期和查询时间间隔需要在同一天',
            25=>'表不存在',
            26=>'加密错误（解密params时出错）',
            27=>'时间区间间隔不能超过10分钟（如果未上传用户名）',
            28=>'只能查询30日内注单记录',
            29=>'只能查询30日内牌桌录像',
            30=>'根据此uuid查询不到牌桌录像',
            31=>'上传用户名长度不能超过16个字符',
            32=>"上传用户名中不能含有'@'字符",
            33=>'独立代理线和共同代理线值不能重复',
            34=>'更新独立代理线配置失败',
            35=>'更新共同代理线配置失败',
            36=>'牌桌id参数错误',
            37=>'linecode参数错误',
            38=>'linecode只能包含数字或字母以及其组合',
            39=>'linecode不能超过10个字符',
            41=>'gametype只能包含数字或字母以及其组合',
            60=>'联系管理员添加白名单',
            71=>'roomlevel只能包含数字',
            73=>'showbackbutton值为0,1,2',
            75=>'rpc内部错误',][$code] ?? 'error';
    }

}