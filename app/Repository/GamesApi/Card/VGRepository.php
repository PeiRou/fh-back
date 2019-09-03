<?php

namespace App\Repository\GamesApi\Card;

use Illuminate\Support\Facades\DB;

class VGRepository extends BaseRepository
{
    public $Config = [];

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
                'AllBet' => $v['betamount'],//总下注
                'bunko' => $v['money'] + $v['servicemoney'],       //盈利 输赢 servicemoney一般是负的  所以直接+
                'bet_money' => $v['betamount'],//有效投注额
                'GameStartTime' => $v['begintime'],//游戏开始时间
                'GameEndTime' => $v['endtime'],  //游戏结束时间
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['endtime'] ?? $v['begintime'],
                'gameCategory' => 'PVP',
                'service_money' => $v['servicemoney'], // + 服务费
            ];

//            $array['ratio_money'] = \App\GamesApi::getRatioMoney(
//                $array['bunko'] + $array['service_money'],
//                ['g_id' => $this->gameInfo->g_id]
//            ); //计算平台抽点

            $user = $this->getUser($array['username']);
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $arr[] = $array;
        }
        return $this->insertDB($arr);
    }

    //获取注单
    private function gamerecordid ()
    {
        $param = [
            'channel' => $this->channel,
            'agent' => $this->agent,
            'id' => $this->param['id'] ?? 0,
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
        return $this->curl_get_content($url);
    }

    public function __get ($value)
    {
        $this->createConfig();
        if (isset($this->$value)) {
            return $this->$value;
        }
        return null;
    }

    function curl_get_content($url, $conn_timeout=7, $timeout=10)
    {
        $headers = array(
            "Accept: application/json",
            "Accept-Encoding: deflate,sdch",
            "Accept-Charset: utf-8;q=1"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $conn_timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        $res = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_errno($ch);
        curl_close($ch);
        //记录日志
        if (($err) || ($httpcode !== 200)) {
            return null;
        }
        if(empty($res))
            return null;
        if(count($json = @json_decode($res, 1)))
            return $json;
        return json_decode(json_encode(simplexml_load_string($res)), 1);
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


}