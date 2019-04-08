<?php
/* 无双棋牌 */

namespace App\Repository\GamesApi\Card;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class WSRepository extends BaseRepository
{
    public $product_type = 2;//LOTTO 彩票, RNG 电子, PVP 棋牌,FISH 捕鱼
    public function __construct($config){
        parent::__construct($config, 'WS');
    }
    public function getBet(){
        $res = $this->Utils->getBetList(
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
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['betOrderNo'],   //游戏代码
                'username' => $v['username'],   //玩家账号
                'AllBet' => abs($v['netPnl']),//总下注
                'bet_money' => abs($v['netPnl']),//总下注
                'bunko' => $v['netPnl'],       //盈利
                'GameStartTime' => $v['betTime'] ?? $v['endTime'],//游戏开始时间
                'GameEndTime' => $v['endTime'] ?? $v['betTime'],  //游戏结束时间
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['betTime'] ?? $v['endTime'],
                'gameCategory' => 'PVP',
            ];
            $user = $this->getUser($array['username']);
            $array['user_id'] = $user->id ?? 0;
            $array['agent'] = $user->agent ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
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

}