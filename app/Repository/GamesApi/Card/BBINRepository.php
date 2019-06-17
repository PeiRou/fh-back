<?php
/* BBIN */

namespace App\Repository\GamesApi\Card;


use App\SystemSetting;
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
            if(!preg_match('/'.strtolower($this->Config['UsernameSuffix']).'$/', $v['UserName']))
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
                'game_type' => $this->getGameType($v['GameType'] ?? ''),
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
            # 修改提款打码量
            SystemSetting::decDrawingMoneyCheckCode($data, 'AllBet');
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

    public function getGameType($key)
    {
        return [
                '3600'=>'德州扑克新手房',
                'FT'=>'足球',
                'BK'=>'籃球',
                'FB'=>'美式足球',
                'IH'=>'冰球',
                'BS'=>'棒球',
                'TN'=>'網球',
                'F1'=>'其他',
                'SP'=>'冠軍賽',
                'CB'=>'混合過關',
                '3001'=>'百家樂',
                '3003'=>'龍虎鬥',
                '3005'=>'三公',
                '3006'=>'溫州牌九',
                '3007'=>'輪盤',
                '3008'=>'骰寶',
                '3010'=>'德州撲克',
                '3011'=>'色碟',
                '3012'=>'牛牛',
                '3014'=>'無限21點',
                '3015'=>'番攤',
                '3016'=>'魚蝦蟹',
                '3017'=>'保險百家樂',
                '3018'=>'炸金花',
                '5005'=>'惑星戰記',
                '5006'=>'Staronic',
                '5007'=>'激爆水果盤',
                '5008'=>'猴子爬樹',
                '5009'=>'金剛爬樓',
                '5010'=>'外星戰記',
                '5012'=>'外星爭霸',
                '5013'=>'傳統',
                '5014'=>'叢林',
                '5015'=>'FIFA2010',
                '5016'=>'史前叢林冒險',
                '5017'=>'星際大戰',
                '5018'=>'齊天大聖',
                '5019'=>'水果樂園',
                '5025'=>'法海鬥白蛇',
                '5026'=>'2012倫敦奧運',
                '5027'=>'功夫龍',
                '5028'=>'中秋月光派對',
                '5029'=>'聖誕派對',
                '5030'=>'幸運財神',
                '5034'=>'王牌5PK',
                '5035'=>'加勒比撲克',
                '5039'=>'魚蝦蟹',
                '5040'=>'百搭二王',
                '5041'=>'7PK',
                '5043'=>'鑽石水果盤',
                '5044'=>'明星97II',
                '5045'=>'森林舞會',
                '5046'=>'鬥魂',
                '5054'=>'爆骰',
                '5057'=>'明星97',
                '5058'=>'瘋狂水果盤',
                '5060'=>'動物奇觀五',
                '5061'=>'超級7',
                '5062'=>'龍在囧途',
                '5063'=>'水果拉霸',
                '5064'=>'撲克拉霸',
                '5065'=>'筒子拉霸',
                '5066'=>'足球拉霸',
                '5067'=>'大話西遊',
                '5068'=>'酷搜馬戲團',
                '5069'=>'水果擂台',
                '5070'=>'黃金大轉輪',
                '5073'=>'百家樂大轉輪',
                '5076'=>'數字大轉輪',
                '5077'=>'水果大轉輪',
                '5078'=>'象棋大轉輪',
                '5079'=>'3D數字大轉輪',
                '5080'=>'樂透轉輪',
                '5083'=>'鑽石列車',
                '5084'=>'聖獸傳說',
                '5088'=>'鬥大',
                '5089'=>'紅狗',
                '5090'=>'金雞報喜',
                '5091'=>'三國拉霸',
                '5092'=>'封神榜',
                '5093'=>'金瓶梅',
                '5094'=>'金瓶梅2',
                '5095'=>'鬥雞',
                '5096'=>'五行',
                '5097'=>'海底世界',
                '5098'=>'五福臨門',
                '5099'=>'金狗旺歲',
                '5100'=>'七夕',
                '5105'=>'歐式輪盤',
                '5106'=>'三國',
                '5107'=>'美式輪盤',
                '5108'=>'彩金輪盤',
                '5109'=>'法式輪盤',
                '5110'=>'夜上海',
                '5116'=>'西班牙21點',
                '5117'=>'維加斯21點',
                '5118'=>'獎金21點',
                '5119'=>'神秘島',
                '5120'=>'女媧補天',
                '5123'=>'經典21點',
                '5127'=>'絕地求生',
                '5131'=>'皇家德州撲克',
                '5201'=>'火燄山',
                '5202'=>'月光寶盒',
                '5203'=>'愛你一萬年',
                '5204'=>'2014FIFA',
                '5402'=>'夜市人生',
                '5404'=>'沙灘排球',
                '5406'=>'神舟27',
                '5407'=>'大紅帽與小野狼',
                '5601'=>'秘境冒險',
                '5701'=>'連連看',
                '5703'=>'發達囉',
                '5704'=>'鬥牛',
                '5705'=>'聚寶盆',
                '5706'=>'濃情巧克力',
                '5707'=>'金錢豹',
                '5802'=>'阿基里斯',
                '5803'=>'阿兹特克寶藏',
                '5804'=>'大明星',
                '5805'=>'凱薩帝國',
                '5806'=>'奇幻花園',
                '5808'=>'浪人武士',
                '5809'=>'空戰英豪',
                '5810'=>'航海時代',
                '5823'=>'發大財',
                '5824'=>'惡龍傳說',
                '5825'=>'金蓮',
                '5826'=>'金礦工',
                '5827'=>'老船長',
                '5828'=>'霸王龍',
                '5835'=>'喜福牛年',
                '5836'=>'龍捲風',
                '5837'=>'喜福猴年',
                '5839'=>'經典高球',
                '5901'=>'連環奪寶',
                '5902'=>'糖果派對',
                '5903'=>'秦皇祕寶',
                '5904'=>'蒸氣炸彈',
                '5907'=>'趣味台球',
                '5908'=>'糖果派對2',
                '5909'=>'開心消消樂',
                '5910'=>'魔法元素',
                '5912'=>'連環奪寶2',
                'LT'=>'六合彩',
                'BBQL'=>'BB競速六合彩',
                'BBLT'=>'BB六合彩',
                'LK28'=>'幸運28',
                'BBRB'=>'BB滾球王',
                'BQ3D'=>'BB競速3D',
                'BB3D'=>'BB3D',
                'BJ3D'=>'3D彩',
                'PL3D'=>'排列三',
                'SH3D'=>'上海時時樂',
                'BBDP'=>'BB龍鳳彩',
                'BBPT'=>'BB深海派對',
                'BBHL'=>'BB高低',
                'BBAD'=>'BB雙喜龍門',
                'BBGE'=>'BB淘金蛋',
                'LDDR'=>'梯子遊戲',
                'LDRS'=>'經典梯子',
                'BBLM'=>'BB射龍門',
                'LKPA'=>'BB幸運熊貓',
                'BCRA'=>'BB百家彩票-A',
                'BCRB'=>'BB百家彩票-B',
                'BCRC'=>'BB百家彩票-C',
                'BCRD'=>'BB百家彩票-D',
                'BCRE'=>'BB百家彩票-E',
                'BCR1'=>'BB百家彩票-TB1',
                'BCR2'=>'BB百家彩票-TB2',
                'BJPK'=>'北京PK拾',
                'BBPK'=>'BBPK3',
                'RDPK'=>'BB雷電PK',
                'GDE5'=>'廣東11選5',
                'JXE5'=>'江西11選5',
                'SDE5'=>'山東十一運奪金',
                'CQSC'=>'重慶時時彩',
                'XJSC'=>'新疆時時彩',
                'TJSC'=>'天津時時彩',
                'JSQ3'=>'江蘇快3',
                'AHQ3'=>'安徽快3',
                'BBQK'=>'BB競速快樂彩',
                'BJKN'=>'北京快樂8',
                'CQSF'=>'重慶幸運農場',
                'TJSF'=>'天津十分彩',
                'GXSF'=>'廣西十分彩',
                'CQWC'=>'重慶百變王牌',
                'OTHER'=>'BB彩票(但不包含六合彩)',
                '30599'=>'捕魚達人',
            ][$key] ?? '';
    }
}