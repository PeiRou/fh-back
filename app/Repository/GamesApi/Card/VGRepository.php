<?php

namespace App\Repository\GamesApi\Card;

use App\GamesListPlay;
use Illuminate\Support\Facades\DB;

class VGRepository extends BaseRepository
{
    public $Config = [];
    public $is_proxy_pass = true; //这个游戏是否使用代理那台服务器

    public function __construct($config){
        parent::__construct($config);
    }

    //格式化数据  插入数据库
    public function createData($data){
        $GameID = array_map(function($v){
            return $v['id'];
        },$data);
        $GameIDs = [];
        if(count($GameID)){
            $where = ' g_id = '.$this->gameInfo->g_id.' and GameID in ("'.implode('","', $GameID).'")';
            $GameIDs = array_map(function($v){
                return $v->GameID;
            },DB::select('select GameID from jq_bet
                where 1 and '.$where.'
                union
                select GameID from jq_bet_his
                where 1 and '.$where));
        }

        $arr = [];
        foreach ($data as $v){
            if(in_array($v['id'], $GameIDs)) continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['id'],   //游戏代码
                'username' => str_replace($this->Config['agent'].'_','',$v['username']),  //玩家账号
                'AllBet' => $v['validbetamount'],//总下注
                'bunko' => $v['money'] + $v['servicemoney'],       //盈利 输赢 servicemoney一般是负的  所以直接+
                'bet_money' => $v['validbetamount'],//有效投注额
                'GameStartTime' => $v['begintime'],//游戏开始时间
                'GameEndTime' => $v['endtime'],  //游戏结束时间
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['endtime'] ?? $v['begintime'],
                'gameCategory' => $v['gametype'] == 5 ? 'FISH' : 'PVP',
                'game_type' => $this->getGameType($v['gametype']),
                'service_money' => $v['servicemoney'], // + 服务费
                'flag' => 1,
                'game_id' => $v['gametype'] == 5 ? 43 : 18,
                'round_id' => $v['roundid'] ?? '',  //场景号
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
            if($v['gametype'] == 22){
//                $str .= '投注内容：'.($v['isbanker'] == 1 ? '庄' : '闲').'<br />';
            }
            $v['beforebalance'] && $str .= '下注前余额：'.$v['beforebalance'];
            return $str;
        }catch (\Throwable $e){
            return false;
        }
    }

    //获取注单
    private function gamerecordid ()
    {
        $param = [
            'channel' => $this->channel,
            'agent' => $this->agent,
            'id' => $this->param['id'] ?? env('gamerecordid', 0),
        ];
        $verifyCode = $this->getverifyCode($param);
        return "{$this->url}/webapi/gamerecordid.aspx?".http_build_query($param)."&verifyCode={$verifyCode}";
    }
    //--------------------------------------------- 分割线 ----------------------------------------------

    private function getverifyCode($param)
    {
        return strtoupper(md5(implode('', $param).$this->privatekey));
    }

    public function createConfig ()
    {
        $this->url = $this->Config[$this->ConfigPrefix.'url'];
        $this->channel = $this->Config[$this->ConfigPrefix.'channel'];
        $this->agent = $this->Config[$this->ConfigPrefix.'agent'];
        $this->privatekey = $this->Config[$this->ConfigPrefix.'privatekey'];
    }

    public function __call ($name, $arguments)
    {
        if(!method_exists($this, $name))
            return '';
        $url = call_user_func([$this,$name], ...$arguments);
        $res = $this->curl_get_content($url);
        if(count($json = @json_decode($res, 1)))
            return $json;
        return json_decode(json_encode(simplexml_load_string($res)), 1);
    }

    public function __get ($value)
    {
        $this->createConfig();
        if (isset($this->$value)) {
            return $this->$value;
        }
        return null;
    }

    public $code = [
        '1' => '不合法的用户名',
        '0' => '成功',
        '-2' => '不合法的验证码',
        '-3' => '不合法的 IP 地址',
        '-5' => '不合法的 action',
        '-80' => '不合法的渠道号',
        '-81' => '比赛 id 错误',
        '-99' => '试图创建用户时用户已存在',
        '-100' => '其它错误',
        '-101' => '数据库事务执行错误',
        '-102' => '不合法游戏用户',
        '-103' => '余额不足',
        '-104' => '金额错误',
        '-105' => '事务失败',
        '-106' => '超出存取款限额',
        '-108' => '错误的订单号',
        '-109' => '订单号未找到',
        '-121' => '代理名字不合法（2-15 位字母数字下划线）',
        '-200' => '操作失败:(可能是因为参数为空)',
    ];

    public function getGameType($key)
    {
        static $list;
        if(is_null($list))
            $list = GamesListPlay::getOneList(18);
        if(!empty($list->get($key)->game_name))
            return $list->get($key)->game_name;
        return [
            1=>'斗地主',
            3=>'抢庄牛牛',
            4=>'百人牛牛',
            5=>'龙王捕鱼',
            6=>'多财多福',
            7=>'竞咪楚汉德州',
            8=>'推筒子',
            9=>'加倍斗地主',
            10=>'保险楚汉德州',
            11=>'血战麻将',
            12=>'炸金花',
            13=>'必下德州',
            14=>'百人三公',
            15=>'十三水',
            998=>'竞咪楚汉福袋',
            999=>'JACKPOT',
            19=>'开心摇摇乐',
            20=>'通比牛牛',
            22=>'百家乐',
            23=>'二八杠',
            24=>'广东推倒胡',
            25=>'二十一点',
            26=>'广东鸡平胡',
            33=>'急速抢庄牛牛',
            47=>'开心翻翻乐',
        ][$key] ?? '';
    }

}