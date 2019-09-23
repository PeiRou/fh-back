<?php

namespace App\Repository\GamesApi\Card;


use SameClass\Service\Cache;

class CQ9Repository extends BaseRepository
{
    use Cache;

    public function __construct($config){
        parent::__construct($config,'Utils');
    }

    //建立 Player
    public function player()
    {
        $param = [
            'account' => $this->getUserName(),
            'password' => $this->password(),
            'nickname' => $this->user['username']
        ];
        return $this->request('/gameboy/player', $param, 'post');
    }

    public function getBet()
    {
        $param = [
            'starttime' => $this->param['starttime'],
            'endtime' => $this->param['endtime'],
            'page' => $this->param['page'] ?? 1,
            'pagesize' => $this->param['pagesize'] ?? 1000,
        ];
        $res = $this->request('/gameboy/order/view', $param, 'get');
        $this->createData($res['Data']);
        if($res['TotalSize'] >= $this->param['pagesize']){
            $this->param['page'] ++;
            $this->getBet();
        }
        return $this->show(0);
    }

    public function createData($aData)
    {
        $web = $this->createGameList('web') ?: collect([]);
        $mobile = $this->createGameList('mobile') ?: collect([]);
        $GameIDs = $this->distinct($aData, 'round');
        $insert = [];
        foreach ($aData as $v){
            if(!preg_match("/^".$this->getVal('agent')."/", $v['account']))
                continue;
            if(in_array($v['round'], $GameIDs))
                continue;
            if($v['status'] !== 'complete')
                continue;
            $array = [
                'g_id' => $this->gameInfo->g_id,
                'GameID' => $v['round'],
                'sessionId' => '',
                'username' => preg_replace('/^'.$this->getConfig('agent').'/', '', $v['account']),
                'AllBet' => $v['bet'],
                'bunko' => $v['win'] - $v['bet'],
                'bet_money' => $v['bet'],
//                'GameStartTime' => $this->getDate($v['bettime']),
                'GameStartTime' => date('Y-m-d H:i:s', strtotime($v['bettime'])),
//                'GameEndTime' => $this->getDate($v['createtime']),
                'GameEndTime' => date('Y-m-d H:i:s', strtotime($v['createtime'])),
                'created_at' => date('Y-m-d H:i:s'),
//                'updated_at' => $this->getDate($v['createtime']),
                'updated_at' => date('Y-m-d H:i:s', strtotime($v['createtime'])),
                'gameCategory' => 'RNG',
                'bet_info' => '',
                'game_type' => ${$v['gameplat']}->get($v['gamehall'].$v['gamecode'])['gamename'] ?? 'CQ9',
                'service_money' => $v['rake'] ?? 0,
                'flag' => $v['status'] == 'complete' ? 1 : 0,
                'game_id' => 42,
                'round_id' => $v['round'] ?? '',  //局号
            ];
            $array['content'] = $this->content($v) ?: $array['game_type'];
            $user = $this->getUser($array['username']);
            $array['agent'] = $user->agent ?? 0;
            $array['user_id'] = $user->id ?? 0;
            $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
            $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
            $insert[] = $array;
        }
        return count($insert) && $this->insertDB($insert);
    }

    public function content($v)
    {
        $str = '局号：'.$v['round'].'<br />';
        $str .= '游戏后余额：'.$v['balance'];
        if(!empty($v['gamerole'])){
            $v['gamerole'] == 'banker' && $gamerole = '庄';
            $v['gamerole'] == 'player' && $gamerole = '闲';
            isset($gamerole) && $str .= '投注内容：'.$gamerole;
        }
        return $str;
    }

    public function formatTime($time, $hm = true)
    {
        $now = \DateTime::createFromFormat('U.u', $time + 0.999)->setTimezone(new \DateTimeZone('-0400')); // 美东时区
        $format = $hm ? \DateTime::RFC3339_EXTENDED : \DateTime::RFC3339;
        return $now->format($format);
    }

    public function createOrderId()
    {
        $this->param['orderid'] = $this->param['orderid'] ?? ($this->Config['agent'] . $this->orderNumber() . $this->user['username']);
        return $this->param['orderid'];
    }
    //默认生成订单号
    public function orderNumber(){
        $c = $this->gameInfo->alias;
        $date = date('YmdHis');
        $randnum = rand(1,9999999);
        return $c.$date.$randnum;
    }

    public function createGameList($gameplat)
    {
        $l = self::HandleCacheData(function() use($gameplat){
            $res = $this->request('/gameboy/game/halls', [], 'get');
            $c = collect([]);
//        $mobile =  collect([]);
            foreach ($res as $v){
                $list = $this->request('/gameboy/game/list/'.$v['gamehall'], [], 'get');
                foreach ($list as $vv){
                    $tag = $vv['gamehall'].$vv['gamecode'];
                    $data = [
                        'tag' => $tag,
                        'gamehall' => $vv['gamehall'],
                        'gametype' => $vv['gametype'],
                        'gamecode' => $vv['gamecode'],
                        'gameplat' => $vv['gameplat'],
                    ];
                    $r = (array_filter($vv['nameset'], function($t) {
                        return $t['lang'] == 'zh-cn';
                    }) ?: array_filter($vv['nameset'], function($t) {
                        return $t['lang'] == 'zh-tw';
                    }) ?: array_filter($vv['nameset'], function($t) {
                        return $t['lang'] == 'en';
                    }));
                    if(empty($r)) continue;
                    $r = array_pop($r);
                    $data['gamename'] = $r['name'];
                    $data['lang'] = $r['lang'];
                    if(preg_match('/'.$gameplat.'/', $vv['gameplat'])){
                        $c->put($tag, $data);
                    }
//                if(preg_match('/mobile/', $vv['gameplat'])){
//                    $mobile->put($tag, $data);
//                }
                }
            }
            return $this->show(0, '', $c);
        }, 60 * 24 * 7, true);
        if($l['code'] === 0){
            return $l['data'];
        }
        return false;
    }

    public function request($uri, $param, $method = 'post')
    {
        $headers = [
            'Authorization: ' . $this->getConfig('token'),
            'Content-Type: application/x-www-form-urlencoded'
        ];
        if($method === 'post')
            $res = $this->curl_post_content($this->getConfig('apiUrl').$uri, $param, false, $headers);
        else
            $res = $this->curl_get_content($this->getConfig('apiUrl').$uri, $param, false, $headers);
        if(empty($res = @json_decode($res, 1))){
            throw new \Exception('未知异常，请联系客服', 500);
        }
        if($res['status']['code'] === '0'){
            return $res['data'];
        }
        throw new \Exception($res['status']['message'] ?? '数据解析异常', $res['status']['code'] ?? 500);
    }

    public function getUserName()
    {
        static $userName;
        if(!$userName)
            $userName = parent::getName(($this->getConfig('agent').$this->user['username']));
        return $userName;
    }

    public function password()
    {
        return 123456;
    }

    public function getToken()
    {
        if(!$this->checkAccount()){
            $this->player();
        }
        return $this->playerLogin()['usertoken'] ?? '';
    }

    public function hook($f, ...$args)
    {
        try{
            return call_user_func([$this, $f], ...$args);
        }catch (\Throwable $e){
            if(!$e->getCode())
                throw  $e;
            return $this->show($e->getCode(), $e->getMessage());
        }
    }


}