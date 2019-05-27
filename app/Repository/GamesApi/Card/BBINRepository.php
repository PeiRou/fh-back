<?php
/* BBIN */

namespace App\Repository\GamesApi\Card;


use App\Users;
use Illuminate\Support\Facades\DB;

class BBINRepository extends BaseRepository
{
    public $Configs;

    const gamekind = [
        1 => [
            'gameCategory' => 'SPORTS'
        ],
        3 => [
            'gameCategory' => 'LIVE'
        ],
        5 => [
            'gameCategory' => 'RNG',
            'subgamekinds' => [
                1,2,3,5
            ]
        ],
        30 => [//捕鱼大人
            'gameCategory' => 'FISH',
        ],
        38 => [//捕魚大師
            'gameCategory' => 'FISH',
        ],
    ];

    public function __construct($config){
        parent::__construct($config);
    }

    //格式化数据  插入数据库
    public function createData($data){
        $arr = [];
        $GameIDs = $this->distinct($data, 'WagersID');
        foreach ($data as $v) { 
            if (in_array($v['WagersID'], $GameIDs)) continue;
            if($this->resultStatus($v)) continue;
            if(!preg_match('/'.$this->Config['UsernameSuffix'].'$/', $v['UserName']))
                continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['WagersID'],   //游戏代码
                'username' => $v['UserName'],  //玩家账号
                'AllBet' => $v['Commissionable'],//总下注
                'bunko' => $v['Payoff'],       //盈利 输赢
                'bet_money' => $v['Commissionable'],//有效投注额
                'GameStartTime' => $this->getDate($v['WagersDate']),//游戏开始时间
                'GameEndTime' => $this->getDate($v['ModifiedDate'] ?? $v['UPTIME'] ?? $v['WagersDate']),  //游戏结束时间
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $this->getDate($v['ModifiedDate'] ?? $v['UPTIME'] ?? $v['WagersDate']),
                'gameCategory' => self::gamekind[$this->param['gamekind']]['gameCategory'] ?? '',
                'service_money' => 0, // + 服务费
                'bet_info' => json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            ];

            $user = $this->getUser($array['username']);
            $array['username'] = $user->username ?? $array['username'];
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $arr[] = $array;
        }

        return $this->insertDB($arr);
    }
    //插入数据库
    public function insertDB($data){
        $table = DB::table('jq_bet');
        if($table->insert($data)){
            echo $this->gameInfo->name.'_'.(self::gamekind[$this->param['gamekind']]['gameCategory'] ?? '').$this->param['subgamekind'].'插入'.count($data).'条数据'.PHP_EOL;
        }else{
            echo $this->gameInfo->name.'_'.(self::gamekind[$this->param['gamekind']]['gameCategory'] ?? '').$this->param['subgamekind'].'插入'.count($data).'条数据失败'.PHP_EOL;
        }
    }

    //什么样的注单状态不记录
    public function resultStatus($v)
    {
        //真人和电子 -1：註銷 0：未結算 的不记录
        if($this->param['gamekind'] == 3){
            if($v['Payoff'] == 0) return true;
//            writeLog('test'.$v['ResultType'], json_encode($v, 3));
//            if(in_array($v['ResultType'], [
//                -1, 0
//            ]))
//                return true;
        }

        if($this->param['gamekind'] == 5)
            if(in_array($v['Result'], [
                -1, 0
            ]))
                return true;

        if($this->param['gamekind'] == 1)
            if(in_array($v['Result'], [
                'X'
            ]))
                return true;

    }
    //------------------------------------------------------------------------------------------------------------
    public function BetRecord()
    {
        $param = [
            'website' => $this->getVal('website'),
            'uppername' => $this->getVal('Account'),
            'rounddate' => $this->param['rounddate'],
            'starttime' => '00:00:00',
            'endtime' => '23:59:59',
            'gamekind' => $this->param['gamekind'],
            'page' => $this->param['page'] ?? 0,
            'pagelimit' => $this->param['pagelimit'] ?? 100,
        ];
        $this->param['gamekind'] == 5 && $param['subgamekind'] = $this->param['subgamekind'];
        $param['key'] = $this->createKey(__FUNCTION__, 8, 2, $param);
        return $this->send_require(__FUNCTION__, $param);
    }

    //捞数据 1体育 30捕鱼大人 38捕鱼大师
    public function WagersRecordBy($method)
    {
        $param = [
            'website' => $this->getVal('website'),
            'action' => 'ModifiedTime',
            'uppername' => $this->getVal('Account'),
            'date' => $this->param['rounddate'],
            'starttime' => $this->param['starttime'],
            'endtime' => $this->param['endtime'],
            'page' => $this->param['page'] ?? 0,
            'pagelimit' => $this->param['pagelimit'] ?? 100,
        ];
        $param['key'] = $this->createKey($method, 8, 2, $param);
        return $this->send_require($method, $param);
    }
    //捞取体育数据
    public function WagersRecordBy1()
    {
        $param = [
            'website' => $this->getVal('website'),
            'action' => 'ModifiedTime',
            'uppername' => $this->getVal('Account'),
            'date' => $this->param['rounddate'],
//            'date' => '2019-05-01',
            'starttime' => $this->param['starttime'],
            'endtime' => $this->param['endtime'],
            'page' => $this->param['page'] ?? 0,
            'pagelimit' => $this->param['pagelimit'] ?? 100,
        ];
//        p($param, 1);
        $param['key'] = $this->createKey(__FUNCTION__, 8, 2, $param);
        return $this->send_require(__FUNCTION__, $param);
    }
    //捞取捕鱼达人数据
    public function WagersRecordBy30()
    {
        $param = [
            'website' => $this->getVal('website'),
            'action' => 'ModifiedTime',
            'uppername' => $this->getVal('Account'),
            'date' => $this->param['rounddate'],
            'starttime' => $this->param['starttime'],
            'endtime' => $this->param['endtime'],
            'page' => $this->param['page'] ?? 0,
            'pagelimit' => $this->param['pagelimit'] ?? 100,
        ];
        $param['key'] = $this->createKey(__FUNCTION__, 8, 2, $param);
        return $this->send_require(__FUNCTION__, $param);
    }
    //----------------------------------------------------------------------------------------

    public function getUrl($key = '')
    {
        $http = 'https://';
        $url = $this->getConfigs()->get($key)->description ?? '';
        if($url == 'linkapi.bbinsoft.com')
            $http = 'http://';
        return $http.$url;
    }
    public function send_require($key = '', $data =[], $json = 'JSON')
    {
        $url = $this->getUrl($key).'/app/WebService/'.$json.'/display.php/'.$key;
//        $res = $this->curl_post_content($url, $data);
        $res = $this->curl_get_content($url, $data);
        if($json == 'JSON')
            $res = @json_decode($res,1);
        return $res;
    }

    function curl_post_content($url, $data, $user_agent=null, $conn_timeout=7, $timeout=10)
    {
        $headers = array(
//            'Accept: application/json',
//            'Accept-Encoding: deflate',
            'Accept-Charset: utf-8;q=1'
        );
        if ($user_agent === null) {
            $user_agent = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36';
        }
        $headers[] = $user_agent;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $conn_timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        if ($data) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        $res = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_errno($ch);
        curl_close($ch);
        if (($err) || ($httpcode !== 200)) {
            $this->WriteLog($this->gameInfo->name.'   http状态码：'.$httpcode.'失败信息：'.$err.'返回信息：'.$res);
            return null;
        }
//        $res = file_get_contents($url.'?'.http_build_query($data));
//        p($res, 1);
        return $res;
    }

    function curl_get_content($url, $data, $conn_timeout=7, $timeout=5, $user_agent=null)
    {
        $url = $url.'?'.http_build_query($data);
        $headers = array(
            "Accept: application/json",
            "Accept-Encoding: deflate,sdch",
            "Accept-Charset: utf-8;q=1"
        );
        if ($user_agent === null) {
            $user_agent = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36';
        }
        $headers[] = $user_agent;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
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

        return $res;
    }

    public function createKey($keyName, $ai = 6, $ci = 2, $param = [])
    {
        $a = $this->getRandomStr($ai);
        $b = md5(
            $this->getVal('website').
            ($param['username'] ?? '').
            ($param['remitno'] ?? '').
            $this->getVal($keyName).
            date('Ymd', $this->getTime())
        );
        $c =  $this->getRandomStr($ci);
        return $a.$b.$c;
    }
    public function getRandomStr($len)
    {
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z"
        );

        $charsLen = count($chars) - 1;
        shuffle($chars);                            //打乱数组顺序
        $str = '';
        for($i=0; $i<$len; $i++){
            $str .= $chars[mt_rand(0, $charsLen)];    //随机取出一位
        }
        return $str;
    }
    //-------------------------------------------------------------------------------------------------------------------
    public function getVal($key = '')
    {
        return $this->getConfigs()->get($key)->value ?? '';
    }
    public function getConfigs()
    {
        empty($this->Configs) && $this->Configs = DB::table('games_api_config')->where('g_id', $this->gameInfo->g_id)->get()->keyBy('key');
        return $this->Configs;
    }

    public function show($code = '', $msg = '', $data = [])
    {
        $msg = $this->msg($code) ?? $msg;
        return parent::show($code, $msg, $data);
    }

    public function msg($code)
    {
        $data = [
            44900 => 'IP不被允許',
            44000 => 'key驗證錯誤',
            22006 => '上層不存在',
            44001 => '參數未帶齊',
            44002 => '無權限',
            45005 => '機率遊戲不存在',
            99999 => 'Login Successful',
        ];
        return $data[$code] ?? null;
    }

    public function createOrderId()
    {
        $this->param['orderid'] = $this->orderNumber();
        return $this->param['orderid'];
    }

    public function orderNumber(){
        $randnum = rand(1,9223372036854775806);
        return $randnum;
    }


}