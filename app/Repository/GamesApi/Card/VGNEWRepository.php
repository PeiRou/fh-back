<?php


namespace App\Repository\GamesApi\Card;


use App\GamesListPlay;
use Illuminate\Support\Facades\Redis;

class VGNEWRepository extends BaseRepository
{
    public $Config = [];
    public $is_proxy_pass = true; //这个游戏是否使用代理那台服务器

    public function __construct($config){
        parent::__construct($config);
    }

    public function getBet ()
    {
        $param = [
            'agent' => $this->getConfig('agent'),
            'recordID' => $this->param['id'] ?? env('gamerecordid', 0),
        ];
        $res = $this->request($param, $this->getConfig('url').'/ChannelApi/GameRecord/'.$this->getConfig('channel').'/GetRecordByID');
        $this->createData($res['value']);

    }

    public function createData($aData)
    {
        $lastRecordID = $aData['lastRecordID'];
        \Illuminate\Support\Facades\Redis::select(11);
        \Illuminate\Support\Facades\Redis::setex('vg_id', 60 * 60 * 24 * 7, $lastRecordID);

        $data = $aData['GameRecords'];
        $GameIDs = $this->distinct($data, 'ID');
        $arr = [];
        foreach ($data as $v){
            if(in_array($v['ID'], $GameIDs)) continue;

            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['ID'],   //游戏代码
                'username' => str_replace($this->getConfig('channel') .'_'.$this->getConfig('agent').'_','',$v['Username']),  //玩家账号
                'AllBet' => $v['ValidBetAmount'],//总下注
                'bunko' => $v['Money'] + $v['ServiceMoney'],       //盈利 输赢 servicemoney一般是负的  所以直接+
                'bet_money' => $v['ValidBetAmount'],//有效投注额
                'GameStartTime' => $v['BeginTime'],//游戏开始时间
                'GameEndTime' => $v['EndTime'],  //游戏结束时间
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['EndTime'] ?? $v['BeginTime'],
                'gameCategory' =>  in_array($v['GameType'], [5,17]) ? 'FISH' : 'PVP',
                'game_type' => $this->getGameType($v['GameType']),
                'service_money' => $v['ServiceMoney'], // + 服务费
                'flag' => 1,
                'game_id' => in_array($v['GameType'], [5,17]) ? 43 : 18,
                'round_id' => $v['RoundID'] ?? '',  //场景号
            ];
            $array['content'] = $this->content($v, $array) ?: $array['game_type'];
            $user = $this->getUser($array['username']);
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $arr[] = $array;
        }
        return $this->insertDB($arr);
    }

    public function content($v, $array)
    {
        try{
            $str = '局号：'.$array['round_id'].'<br />';
            $v['BeforeBalance'] && $str .= '下注前余额：'.$v['BeforeBalance'];
            return $str;
        }catch (\Throwable $e){
            return false;
        }
    }

    public function request($param, $url, $header = null)
    {
        static $i = false;
        is_null($header) && $header[] = 'apitoken:'.$this->getToken();
        $res = $this->curl_get_content($url, $param, null, $header);
        if(empty($res = @json_decode($res, 1))){
            throw new \Exception('请求超时', 500);
        }
        if($res['state'] === 0){
            return $res;
        }
        if($res['state'] === 203 && !$i){
            $i = true;
            $this->createUser();
            return $this->request($param, $url);
        }
        if($res['state'] === 102 && !$i){
            $i = true;
            $this->refreshToken();
            return $this->request($param, $url);
        }
        throw new \Exception($this->getCode($res['state'] ?? 500), $res['state'] ?? 500);
    }

    public function createUser()
    {
        $param = [
            'username' => $this->getUserName(),
            'agent' => $this->getConfig('agent'),
        ];
        $res = $this->request($param, $this->getConfig('url').'/ChannelApi/API/'.$this->getConfig('channel').'/CreateUser');
    }

    public function getToken()
    {
        $redis = Redis::connection();
        $redis->select(12);
        if(!$token = $redis->get($this->redisTokenKey)){
            $this->refreshToken();
            $token = $redis->get($this->redisTokenKey);
        }
        return $token;
    }

    private function refreshToken()
    {
        $param = [
            'channel' => $this->getConfig('channel'),
            'timestamp' => time(),
        ];
        $param['verifycode'] = strtoupper(md5($param['channel'] . $param['timestamp'] . $this->getConfig('privatekey')));
        $res = $this->request($param, $this->getConfig('url').'/ChannelApi/Security/GetToken', []);
        $redis = Redis::connection();
        $redis->select(12);
        $redis->setex($this->redisTokenKey, 60 * 60 * 48, $res['value']);
        return $res['value'];
    }

    public function getUserName()
    {
        return $this->getConfig('agent').'_'.$this->user['username'];
    }

    public function getCode($code)
    {
        return $this->code[$code] ?? 'error';
    }

    public $code = [
        '0'=>'成功',
        '101'=>'不合法的 IP 地址',
        '102'=>'不合法的验证码',
        '103'=>'验证码过期',
        '104'=>'不合法的参数',
        '105'=>'错误',
        '201'=>'游戏不符',
        '202'=>'渠道不符',
        '203'=>'不合法的用户名或用户不存在',
        '601'=>'不合法的代理名',
        '602'=>'用户已存在',
        '603'=>'用户状态有误',
        '621'=>'错误的订单号',
        '622'=>'订单号未找到',
        '623'=>'存取款超限',
        '624'=>'余额不足',
        '625'=>'存取款失败',
        '626'=>'下注记录有误',
        '627'=>'订单号重复',
        '641'=>'游戏未开放',
        '642'=>'玩家在游戏中',
    ];
    public function getGameType($key)
    {
//        static $list;
//        if(is_null($list))
//            $list = GamesListPlay::getOneList(18);
//        if(!empty($list->get($key)->game_name))
//            return $list->get($key)->game_name;
        return [
                1=>'斗地主(停用)',
                49=>'斗地主',
                2=>'二人麻将',
                3=>'抢庄牛牛',
                4=>'百人牛牛',
                5=>'龙王捕鱼',
                6=>'多财多福',
                7=>'竞咪楚汉德州',
                8=>'推筒子',
                9=>'加倍斗地主',
                10=>'保险楚汉德州',
                11=>'血战到底',
                12=>'炸金花',
                13=>'必下德州',
                14=>'百人三公',
                15=>'十三水',
                17=>'3D 捕鱼',
                19=>'开心摇摇乐',
                20=>'通比牛牛',
                22=>'百家乐',
                23=>'二八杠',
                24=>'广东推倒胡',
                25=>'二十一点',
                26=>'广东鸡平胡',
                33=>'经典抢庄牛牛 ',
                39=>'跑得快',
                44=>'龙虎斗',
                45=>'牛牛大吃小',
                47=>'开心翻翻乐jackpot',
                52=>'看四张抢庄牛牛',
                994=>'搏一搏',
                995=>'幸运转盘',
                998=>'竞咪楚汉福袋',
                996=>'开心翻翻乐',
                999=>'JACKPOT',
            ][$key] ?? '';
    }


}