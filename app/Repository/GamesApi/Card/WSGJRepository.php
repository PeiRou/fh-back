<?php
/* 无双棋牌 */

namespace App\Repository\GamesApi\Card;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class WSGJRepository extends BaseRepository
{
    public $GameList = [];
    public $product_type = 2;//LOTTO 彩票, RNG 电子, PVP 棋牌,FISH 捕鱼
    public function __construct($config){
        parent::__construct($config, 'WSGJ');
    }
    public function getBet(){
        $res = $this->Utils->get_bet_details(
            $this->param['time'],
            $this->param['page'] ?? 1);
        if(isset($res['status']) && $res['status'] == 0){
            return $this->show(0, '', $res);
        }
        return $this->show($res['status'] ?? 500,  $this->errorMessage($res['status'] ?? -1) ?? '请求超时');
    }
    /**
    {
    username: xxxxx,                            //用户名
    netPnl : xxxx,                              //净输赢
    transactionTime: "YYYY-MM-DD HH24:MI:SS",   //交易时间
    gameCode: xxxxx,  //游戏代码
    betOrderNo: xxxxxx,                        //投注订单号
    betTime: "YYYY-MM-DD HH24:MI:SS",          //投注时间
    endTime: "YYYY-MM-DD HH24:MI:SS",          //
    productType: 1
    sessionId: xxx,
    rake: xxx
    }
      {
    totalPage: xxx,  //总页数
    currentPage: xx, //当前页数
    totalCount: xx   //总数据
    }
     */
    public function matchName($name)
    {
        return preg_match('/^'.$this->Config['agent'].'/', $name);
    }
    public function arrInfo(&$array)
    {
        $user = $this->getUser($array['username']);
        $array['username'] = $user->username ?? $array['username'];
        $array['agent'] = $user->agent ?? 0;
        $array['user_id'] = $user->id ?? 0;
        $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
        $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
    }
    //格式化数据  插入数据库
    public function createData($data){
        $GameID = array_map(function($v){
            return $v['betOrderNo'];
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
            if(in_array($v['betOrderNo'], $GameIDs))
                continue;
            if(!preg_match('/'.$this->Config['agent'].'/', $v['username']))
                continue;
            $infoOne = $this->createGameList([
                'product_type' => $v['productType'],
                'gameType' => $v['gameCategory'],
            ]);
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['betOrderNo'],   //投注订单编号
                'username' => $v['username'],   //玩家账号
                'AllBet' => ($v['validBetAmount']),//投注金额
                'bunko' => $v['netPnl'],       //净输赢
                'GameStartTime' => $v['betTime'] ?? $v['endTime'],//投注时间
                'GameEndTime' => $v['endTime'] ?? '',  //游戏结束时间
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['endTime'] ?? $v['betTime'],
                'service_money' => 0,
                'game_type' => (@$infoOne[$v['gameCode']])['gameName'] ?? '',
                'bet_money' => $v['validBetAmount'] ?? '',  //有效投注金额
                'productType' => $v['productType'] ?? '',  //产品类别
                'gameCategory' => $v['gameCategory'] ?? '',  //游戏类别
                'sessionId' => $v['sessionId'] ?? '',  //会话标识
                'bet_info' => json_encode($v['additionalDetails'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?? '',  //额外细节
                'flag' => 1,
            ];

            $user = $this->getUser($array['username']);
            $array['username'] = $user->username ?? $array['username'];
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? '')->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? '')->name ?? '';
            $arr[] = $array;
        }
        return $this->insertDB($arr);
    }


    protected function errorMessage($code){
        $code = (int)$code;
        $data = [
            0 => '成功',
            1 => '未知的系统错误，请联系客服',
            2 => '缺少必需的参数',
            3 => '此产品类型不支持此方法',
            4 => '商家不允许使用此产品类型',
            5 => '找不到商家',
            6 => '参数无效，无法解密参数。',
            7 => '签名无效',
            8 => '不支持的货币',
            9 => '帐户类型无效',
            10 => '产品类型无效',
            11 => '提现余额不足',
            12 => '交易序号已經存在',
            14 => '游戏代码无效',
            15 => '用户不存在',
            16 => '信用额度不足',
            18 => '此游戏代码不支持试用模式',
            19 => '批次理未准备好',
            21=> '找不到方法',
            22=> '参数验证失败',
            23=> 'API 繁忙',
            500=> '请求超时',//自己加的
        ];
        if(isset($data[$code])){
            return $data[$code];
        }
        return '';
    }

    public function createGameList($param)
    {
        static $list;
        if(isset($list[$param['product_type']][$param['gameType']])){
            return $list[$param['product_type']][$param['gameType']];
        }

        $file = $param['product_type'].'/'.$param['gameType'];
        if(!Storage::disk('Card')->exists($file)){
            $this->getGameList($param);
            if(count($this->GameList)){
                $arr = [];
                foreach ($this->GameList as $v){
                    $arr [$v['tcgGameCode']] = $v;
                }
                $this->GameList = [];
                if(count($arr))
                    Storage::disk('Card')->put($file, json_encode($arr));
            }
        }

        if(Storage::disk('Card')->exists($file)){
            $list[$param['product_type']][$param['gameType']] = json_decode(Storage::disk('Card')->get($file), 1);
        }
        return $list[$param['product_type']][$param['gameType']] ?? [];
    }
    public function getGameList($param)
    {
        $this->param['product_type'] = $param['product_type'] ?? 4;
        $this->param['client_type'] = 'phone'; //终端设备 - pc:电脑客户端, phone:手机客户端, web:网页浏览器, html5:手机浏览器
        $this->param['game_type'] =  $param['gameType'] ?? 'LIVE';//游戏类型 - RNG, LIVE, PVP
        $this->param['page'] = $this->param['page'] ?? 1;
        $this->param['page_size'] =$param['page_size'] ?? 16;
        $res = $this->getGameList1();
        if($res['code'] === 0 && count((array)$res['data'])){
            $this->GameList = array_merge((array)$this->GameList, (array)$res['data']);
            $this->param['page'] ++;
            $this->getGameList($param);
        }
    }
    public function getGameList1()
    {
        $res = $this->Utils->getGameList(
            $this->param['product_type'],
            'all',
            $this->param['client_type'],  //终端设备 - pc:电脑客户端, phone:手机客户端, web:网页浏览器, html5:手机浏览器
            $this->param['game_type'],   //游戏类型 - RNG, LIVE, PVP
            $this->param['page'],
            $this->param['page_size']
        );
        if(isset($res['status']) && $res['status'] === 0)
            return $this->show(0, '', $res['games']);
        return $this->show($res['status'] ?? 500, $this->errorMessage($res['status'] ?? -1) ?? '请求超时', []);
    }

}