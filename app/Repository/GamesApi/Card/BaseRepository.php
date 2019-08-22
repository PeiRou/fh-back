<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository\GamesApi\Card;
use App\GamesApi;
use App\Http\Controllers\Obtain\SendController;
use App\SystemSetting;
use App\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BaseRepository
{
    const SwJobsKey = 'JqErrorBet'; //重新拉取注单的队列key
    const SwJobsKeyDb = 12; //队列使用的redis库

    protected $otherModel;
    public $Utils = null; //依赖类
    public $gameInfo = []; //游戏信息
    public $Config = []; //配置
    public $param = []; //参数
    public $user = []; //用户信息
    public $ConfigPrefix = ''; //试玩用户会加上前缀
    public $resData = null; //请求返回数据
    public $UsersArr_;
    public function __construct($config, $name = 'Utils'){
        $class = 'App\\Repository\\GamesApi\\Card\\Utils\\'.$name;
        $this->Utils = new $class($config);
        $this->Config = $config;
        $this->UsersArr_ = collect([]);
//        $this->param['ip'] = realIp();
    }
    public function __get($value)
    {
        if($value == 'UsersArr_')
            $this->$value = collect([]);
        return $this->$value ?? null;
    }
    public function getOtherModel($model){
        if(empty($this->otherModel->$model)) {
            $model = '\App\\'.ucfirst($model);
            $this->otherModel->$model = new $model;
        }
        return $this->otherModel->$model;
    }

    /**
     * 更新数据库
     * @param $data
     * @param null $whereField 更新或新增
     */
    public function saveDB($data, $whereField = null){
        $table = 'jq_bet';
        if(!$whereField){
            $a = '插入';
            # 修改提款打码量
            SystemSetting::decDrawingMoneyCheckCode($data, 'AllBet');
            $res = DB::table($table)->insert($data);
            $num = count($data);
        }else{
            $a = '更新';
            $res = \App\GamesApi::batchUpdate($data, $whereField,$table);
            $num = count($data);
            if(!$res || $res < $num){
                $res = \App\GamesApi::batchUpdate($data, $whereField,'jq_bet_his');
            }
        }
        if($res){
            echo $this->gameInfo->name.$a.$num.'条数据'.PHP_EOL;
        }else{
            echo $this->gameInfo->name.$a.count($data).'条数据失败'.PHP_EOL;
        }
    }
    //插入数据库
    public function insertDB($data){
        $this->saveDB($data);
    }
    //格式化数据  插入数据库
    public function createData($data){
        $where = ' g_id = '.$this->gameInfo->g_id.' and GameID in ("'.implode('","', $data['GameID']).'")';
        $GameIDs = DB::select('select GameID from jq_bet
                where 1 and '.$where.'
                union
                select GameID from jq_bet_his
                where 1 and '.$where);

        $res['GameID'] = array_diff($data['GameID'],array_map(function($v){
            return $v->GameID;
        },$GameIDs));
        $arr = [];
        foreach ($res['GameID'] as $k => $k){
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $data['GameID'][$k],
                'username' => str_replace($this->Config['agent'].'_','',$data['Accounts'][$k]),
                'AllBet' => $data['AllBet'][$k],
                'bunko' => $data['Profit'][$k], //输赢
                'bet_money' => $data['CellScore'][$k],
                'GameStartTime' => $data['GameStartTime'][$k],
                'GameEndTime' => $data['GameEndTime'][$k],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $data['GameEndTime'][$k] ?? $data['GameStartTime'][$k],
                'gameCategory' => 'PVP',
                'game_type' => $this->getGameType($data['ServerID'][$k]),
                'service_money' => $data['Revenue'][$k],// + 服务费
                'flag' => 1,
                'game_id' => $this->getGameId([]),
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

    //拼接请求数据
    public function createReqData(){
        try{
            $s = $this->param['s'];
            $timestamp = $this->Utils->microtime_int();
            $time_str = $this->Utils->timestamp_str('YmdHis', 'Asia/Chongqing');
//            $this->param['ip'] = $this->Utils->get_ip();
//            $this->param['orderid'] = $this->param['orderid'] ?? $this->Config[$this->ConfigPrefix.'agent'] . $time_str . $this->param['account'];
            switch($subCmd = intval($s)) {
                case 6:
                    $param = http_build_query(array(
                        's' => $s,
                        'startTime' => $this->param['startTime'],
                        'endTime' => $this->param['endTime']
                    ));
                    break;
            }
            $url = $s != 6 ? $this->Config[$this->ConfigPrefix.'apiUrl'] : $this->Config[$this->ConfigPrefix.'recordUrl'];
            $url .= '?' . http_build_query(array(
                    'agent' => $this->Config[$this->ConfigPrefix.'agent'],
                    'timestamp' => $timestamp,
                    'param' => $this->Utils->desEncode($this->Config[$this->ConfigPrefix.'desKey'], $param),
                    'key' => md5($this->Config[$this->ConfigPrefix.'agent'].$timestamp.($this->Config[$this->ConfigPrefix.'md5Key']))
                ));
            $res = json_decode($this->Utils->curl_get_content($url), true);
//            \Log::info($this->gameInfo->name.json_encode($res));
            if(!empty($res)){
                if(isset($res['d']['code']) && $res['d']['code'] == 0){
                    return $this->show(0, '', $res['d']);
                }
                return $this->show($res['d']['code'], $this->errorMessage($res['d']['code']));
            }
            return $this->show(500, '超时');
        }catch (\Exception $e){
            return $this->show(1, $e->getMessage());
        }
    }

    //获取时间
    public function getMillisecond($param = [])
    {
        if(isset($param['toTime'])){
            return $param['toTime'] * 1000;
        }
        list($t1, $t2) = explode(' ', microtime());
        return  sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    public function show($code = '', $msg = '', $data = []){
        $data = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return $data;
    }
    protected function errorMessage($code){
        $codeMessage = '未知错误,请联系在线客服';
        switch ($code){
            case 1:
                $codeMessage = '登录过期，请重新登录';
                break;
            case 2:
                $codeMessage = '渠道不存在';
                break;
            case 3:
                $codeMessage = '验证时间超时';
                break;
            case 4:
                $codeMessage = '验证错误';
                break;
            case 5:
                $codeMessage = '渠道白名单错误';
                break;
            case 6:
                $codeMessage = '验证字段丢失';
                break;
            case 8:
                $codeMessage = '不存在的请求';
                break;
            case 15:
                $codeMessage = '渠道验证错误';
                break;
            case 16:
                $codeMessage = '数据不存在(当前没有注单)';
                break;
            case 20:
                $codeMessage = '账号禁用';
                break;
            case 22:
                $codeMessage = 'AES解密失败';
                break;
            case 24:
                $codeMessage = '渠道拉取数据超过时间范围';
                break;
            case 26:
                $codeMessage = '订单号不存在';
                break;
            case 27:
                $codeMessage = '数据库异常';
                break;
            case 28:
                $codeMessage = 'IP禁用';
                break;
            case 29:
                $codeMessage = '订单号与订单规则不符';
                break;
            case 30:
                $codeMessage = '获取玩家在线状态失败';
                break;
            case 31:
                $codeMessage = '更新的分数小于或者等于0';
                break;
            case 32:
                $codeMessage = '更新玩家信息失败';
                break;
            case 33:
                $codeMessage = '更新玩家金币失败';
                break;
            case 34:
                $codeMessage = '订单重复';
                break;
            case 35:
                $codeMessage = '获取玩家信息失败，您还没有登录过游戏';
                break;
            case 36:
                $codeMessage = 'KindID不存在';
                break;
            case 37:
                $codeMessage = '登录瞬间禁止下分，导致下分失败';
                break;
            case 38:
                $codeMessage = '余额不足导致下分失败';
                break;
            case 39:
                $codeMessage = '禁止同一账号登录带分、上分、下分并发请求，后一个请求被拒';
                break;
            case 40:
                $codeMessage = '单次上下分数量不能超过一千万';
                break;
            case 41:
                $codeMessage = '拉取对局汇总统计时间范围有误';
                break;
            case 42:
                $codeMessage = '代理被禁用';
                break;
            case 43:
                $codeMessage = '拉单过于频繁(两次拉单时间间隔必须大于1秒)';
                break;
            case 1001:
                $codeMessage = '注册会员账号系统异常';
                break;
            case 1002:
                $codeMessage = '代理商金额不足，请联系在线客服';
                break;
        }
        return $codeMessage;
    }

    public function getUser($username, $key = '', $v = '')
    {
        if(in_array($this->gameInfo->g_id, [
            17,22,19,23,24,25,26
        ])){
            $res = \App\GamesApiUserName::getGidOtherName([
                'g_id' => $this->gameInfo->g_id,
                'username' => $username,
                'key' => $key,
                'value' => $v,
            ]);
        }else{
            return app(Report::class)->getUser($username);
        }

        return $res;
    }

    public function senterGetBet($param = [])
    {
        $this->param['endTime'] = $this->param['endTime'] ?? $param['toTime'] ?? time();
        $this->param['endTime'] = $this->param['endTime'] - 30 * 60;
        $this->param['startTime'] = $this->param['endTime'] - 5 * 60;
        $platform_id = SystemSetting::getValueByRemark1('payment_platform_id');
        $this->param['remark'] = $this->getVal('agent');
        $this->param['g_id'] = $this->gameInfo->g_id;
        $baseController = new SendController([
            'platform_id' => $platform_id,
            'data' => json_encode([
                'data' => $this->param,
            ]),
        ]);
        $data = $baseController->sendPlatformOffer('Children/GamesApiGetBet');
        if(isset($data['code']) && $data['code'] == 0){
            $this->senterCreateData($data['data']);
        }else{
            try{
                if(is_null(@app('obj')->jq_error_bet_id)) {
                    $message_error = [
                        'info' => [
                            'title' => 'zabbix告警通知',
                            'token' => 'bot927487364:AAExwRP53SbKdhx5r5n5YEOHOnxtM4cHTI4',
                            'chatid' => '-391676419',
                        ],
                        'data' => [['告警详情', $this->gameInfo->name.'拉取总后台第三方游戏数据异常'.($data['code']??'')], ['问题主机', env('APP_NAME', '')]]
                    ];
                    $http = app(\GuzzleHttp\Client::class);
                    $http->request('POST', 'https://telegram.uugl.pw/xiaotang/xiaotang', [
                        'connect_timeout' => 1,
                        'body' => json_encode($message_error)
                    ]);
                }
            }catch (\Throwable $e){
                writeLog('bot_error', '机器人推送失败'.$e->getMessage());
            }
        }
        $this->insertError($data['code'] ?? 500, $data['msg'] ?? 'error', $this->param);
        return  $this->show($data['code'] ?? 500, $data['msg'] ?? 'error', $this->param);
    }

    //总后台的数据插入数据库
    public function senterCreateData($data)
    {
        $GameIDs = $this->distinct($data, 'GameID');
        $insert = [];
        $update = [];
        foreach ($data as $v) {
            if(!$this->matchName($v['username']))
                continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['GameID'],   //游戏代码
                'username' => $v['username'],  //玩家账号
                'AllBet' => $v['AllBet'],//总下注
                'bunko' => $v['bunko'],       //盈利-下注
                'bet_money' => $v['bet_money'],//有效投注额
                'GameStartTime' => $v['GameStartTime'],//游戏开始时间
                'GameEndTime' => $v['GameStartTime'],  //游戏结束时间
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => $v['updated_at'],
                'gameCategory' => $v['gameCategory'], //
                'game_type' => $v['game_type'],
                'service_money' => $v['service_money'], // + 服务费
                'bet_info' => $v['bet_info'],
                'flag' => $v['flag'],
                'productType' => $v['productType'],
                'game_id' => $this->getGameId($v),
            ];
            $this->arrInfo($array, $v);
            if (in_array($v['GameID'], $GameIDs))
                $update[] = $array;
            else
                $insert[] = $array;
        }
        count($insert) && $this->saveDB($insert);
        count($update) && $this->saveDB($update, 'GameID');
    }

    public function getGameId($data = [])
    {
        switch ($this->gameInfo->g_id){
            case 15:
                return 15;
            case 16:
                return 16;
            case 21:
                return 31;
        }
        return $this->gameInfo->g_id;
    }

    public function getAgent($a_id)
    {
        return app(Report::class)->getAgent($a_id);
    }

    public function updateError($code, $codeMsg, $param = null)
    {
        $model = DB::table('jq_error_bet');
        $model->where('id', app('obj')->jq_error_bet_id)->update([
            'code' => $code ?? 0,
            'codeMsg' => $codeMsg ?? 'OK',
            'resNum' => DB::raw('resNum + 1'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if($this->isAdd($code))
            $this->addJob(app('obj')->jq_error_bet_id);

    }
    public function insertError($code, $codeMsg, $param = null)
    {
        if(($jq_error_bet_id = @app('obj')->jq_error_bet_id) <= 0 && $code == 0)
            return null;
        if($jq_error_bet_id > 0){
            return $this->updateError($code, $codeMsg, $param);
        }
        //不记录失败信息的
        if($code == 9999){
            return null;
        }
        $g_info = $this->gameInfo;
        echo $g_info->name.'更新失败：'.$codeMsg.'。错误码：'.$code."\n";
        if(($g_info->g_id == 15 || $g_info->g_id == 16)){
            if($code == 16){
                return null;
            }
        }elseif ($g_info->g_id == 21){
            if($code == 16){
                return null;
            }
        }elseif($g_info->g_id == 22 && $jq_error_bet_id <= 0){
            if($code == 40014){
                return null;
            }
        }
        $model = DB::table('jq_error_bet');
            $jq_error_bet_id = $model->insertGetId([
                'g_id' => $this->gameInfo->g_id,
                'g_name' => $this->gameInfo->name,
                'code' => $code,
                'codeMsg' => $codeMsg,
                'param' => json_encode($param ?? $this->param, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        if($this->isAdd($code))
            $this->addJob($jq_error_bet_id);

        //删除7天以前的
        $model->where('created_at', '<', date('Y-m-d H:i:s', time() - 3600 * 24 * 10))->delete();
    }

    public function isAdd($code)
    {
        $is = false;
        if($code == 500)
            return true;
        if($this->gameInfo->g_id == 19 && $code == 23)
            return true;
//        if($this->gameInfo->g_id == 22 && $code == 44003)
//            return true;
        if($this->gameInfo->g_id == 22)
            return false;
        return $is;
    }

    public function addJob($id){
        if($resNum = DB::table('jq_error_bet')->where('id', $id)->value('resNum'))
            if($resNum > 10) return '';
        $redis = Redis::connection();
        $redis->select(self::SwJobsKeyDb);
        $redis->Rpush(self::SwJobsKey, $id);
    }

    //东美时区转上海
    public function getDate($date = null)
    {
        is_null($date) && $date = date('Y-m-d H:i:s');
        return date('Y-m-d H:i:s', strtotime($date) + 60 * 60 * 12);
    }

    //东美时区时间戳
    public function getTime($time = null)
    {
        is_null($time) && $time = time();
        return $time - 60 * 60 * 12;
    }

    protected function getConfig($val = null)
    {
        if(is_null($val)) return $this->Config;
        return $this->Config[$val] ?? '';
    }

    public function WriteLog(...$args){
        writeLog('Card/'.($this->gameInfo->name ?? $this->gameInfo->g_id), ...$args);
    }

    //找出重复id
    public function distinct($data, $val = '')
    {
        $GameID = array_map(function($v)use($val){
            return $v[$val];
        },$data);
        return $this->getExists($GameID);
    }
    public function getExists($ids = [])
    {
        $GameIDs = [];
        if(count($ids)) {
            $where = ' g_id = ' . $this->gameInfo->g_id . ' and GameID in ("' . implode('","', $ids) . '")';
            $GameIDs = array_map(function($v){
                return $v->GameID;
            },DB::select('select GameID from jq_bet
                where 1 and '.$where.'
                union
                select GameID from jq_bet_his
                where 1 and '.$where));
        }
        return $GameIDs;
    }
    public function getVal($key = '')
    {
        return $this->Config[$key] ?? '';
    }

    public function getGameType($key)
    {
        return [
            3600=>'德州扑克新手房',
            3601=>'德州扑克初级房',
            3602=>'德州扑克中级房',
            3603=>'德州扑克高级房',
            3700=>'德州扑克财大气粗房',
            3701=>'德州扑克腰缠万贯房',
            3702=>'德州扑克挥金如土房',
            3703=>'德州扑克富贵逼人房',
            7201=>'二八杠体验房',
            7202=>'二八杠初级房',
            7203=>'二八杠中级房',
            7204=>'二八杠高级房',
            7205=>'二八杠至尊房',
            8301=>'抢庄牛牛体验房',
            8302=>'抢庄牛牛初级房',
            8303=>'抢庄牛牛中级房',
            8304=>'抢庄牛牛高级房',
            8305=>'抢庄牛牛至尊房',
            8306=>'抢庄牛牛王者房',
            2201=>'炸金花体验房',
            2202=>'炸金花初级房',
            2203=>'炸金花中级房',
            2204=>'炸金花高级房',
            8601=>'三公体验房',
            8602=>'三公初级房',
            8603=>'三公中级房',
            8604=>'三公高级房',
            8605=>'三公至尊房',
            9001=>'龙虎体验房',
            9002=>'龙虎初级房',
            9003=>'龙虎中级房',
            9004=>'龙虎高级房',
            6001=>'21点体验房',
            6002=>'21点初级房',
            6003=>'21点中级房',
            6004=>'21点高级房',
            8701=>'通比牛牛体验房',
            8702=>'通比牛牛初级房',
            8703=>'通比牛牛中级房',
            8704=>'通比牛牛高级房',
            8705=>'通比牛牛至尊房',
            8801=>'欢乐红包体验房',
            8802=>'欢乐红包初级房',
            8803=>'欢乐红包中级房',
            8804=>'欢乐红包高级房',
            2301=>'极速炸金花新手房',
            2302=>'极速炸金花初级房',
            2303=>'极速炸金花中级房',
            2304=>'极速炸金花高级房',
            7301=>'抢庄牌九新手房',
            7302=>'抢庄牌九初级房',
            7303=>'抢庄牌九中级房',
            7304=>'抢庄牌九高级房',
            7305=>'抢庄牌九至尊房',
            6101=>'斗地主体验房',
            6102=>'斗地主初级房',
            6103=>'斗地主中级房',
            6104=>'斗地主高级房',
            6301=>'十三水常规场新手房',
            6302=>'十三水常规场初级房',
            6303=>'十三水常规场中级房',
            6304=>'十三水常规场高级房',
            6305=>'十三水极速场新手房',
            6306=>'十三水极速场初级房',
            6307=>'十三水极速场中级房',
            6308=>'十三水极速场高级房',
            3801=>'幸运五张体验房',
            3802=>'幸运五张初级房',
            3803=>'幸运五张中级房',
            3804=>'幸运五张高级房',
            3901=>'射龙门经典房',
            3902=>'射龙门暴击房',
            9101=>'百家乐体验房',
            9102=>'百家乐初级房',
            9103=>'百家乐中级房',
            9104=>'百家乐高级房',
            9201=>'森林舞会体验房',
            9202=>'森林舞会初级房',
            9203=>'森林舞会中级房',
            9204=>'森林舞会高级房',
            7401=>'二人麻将体验房',
            7402=>'二人麻将初级房',
            7403=>'二人麻将中级房',
            7404=>'二人麻将高级房',
            13501=>'幸运转盘',
            13502=>'幸运转盘',
            13503=>'幸运转盘',
            19401=>'金鲨银鲨体验房',
            19402=>'金鲨银鲨初级房',
            19403=>'金鲨银鲨中级房',
            19404=>'金鲨银鲨高级房',
            19601=>'奔驰宝马体验房',
            19602=>'奔驰宝马初级房',
            19603=>'奔驰宝马中级房',
            19604=>'奔驰宝马高级房',
                9501=>'红黑大战新手场',
                9502=>'红黑大战普通场',
                9503=>'红黑大战高手场',
                9504=>'红黑大战大师场',
                9505=>'红黑大战宗师场',
                9901=>'抢庄五选三新手场',
                9902=>'抢庄五选三普通场',
                9903=>'抢庄五选三高手场',
                9904=>'抢庄五选三大师场',
                9905=>'抢庄五选三宗师场',
                6401=>'跑得快新手场',
                6402=>'跑得快普通场',
                6403=>'跑得快高手场',
                6404=>'跑得快大师场',
                6405=>'跑得快宗师场',
                9301=>'百人牛牛新手场',
                9302=>'百人牛牛普通场',
                9303=>'百人牛牛高手场',
                9304=>'百人牛牛大师场',
                8901=>'看牌抢庄牛牛体验房',
                8902=>'看牌抢庄牛牛初级房',
                8903=>'看牌抢庄牛牛中级房',
                8904=>'看牌抢庄牛牛高级房',
                8905=>'看牌抢庄牛牛至尊房',
                8906=>'看牌抢庄牛牛王者房',
                6501=>'血流成河体验房',
                6502=>'血流成河初级房',
                6503=>'血流成河中级房',
                6504=>'血流成河高级房',
                19501=>'万人炸金花体验房',
                19502=>'万人炸金花初级房',
                19503=>'万人炸金花中级房',
                19504=>'万人炸金花高级房',

        ][$key] ?? '';
    }

}