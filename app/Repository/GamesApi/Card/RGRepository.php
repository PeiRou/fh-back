<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/8 0008
 * Time: 18:26
 */

namespace App\Repository\GamesApi\Card;


use Illuminate\Support\Facades\DB;

class RGRepository extends BaseRepository
{
    private $password='123456';
    public $is_proxy_pass = true; //这个游戏是否使用代理那台服务器

    public function trial(){
        $login_url = '';
        if(is_null($username = $this->getUserName(false))){
            $params = [
                'sign' => $this->Config['test_access_code'],
                'username' => $this->getUserName(),
                'password' => $this->password,
                'password_confirmation' => $this->password,
                'ratio_switch' => 1,
                'ratio' => 0,
                'ratio_setting' => 1,
                'bet_limit' => 1,
            ];
            $url = $this->Config['test_register_api'].'?'.http_build_query($params);
            $res = $this->curl_get($url);
            $res = json_decode($res,true);
            if($res['status'] == 1){
                $params = [
                    'username' => $this->getUserName(false),
                    'password' => md5(md5($this->password)),
                    'loginUrl' => $this->Config['agent_login_url'],
                    'sign' => $this->Config['test_access_code'],
                ];
                $login_url = $this->Config['test_login_api'].'?'.http_build_query($params);
            }
        }else{
            $params = [
                'username' => $username,
                'password' => md5(md5($this->password)),
                'loginUrl' => $this->Config['agent_login_url'],
                'sign' => $this->Config['test_access_code'],
            ];
            $login_url = $this->Config['test_login_api'].'?'.http_build_query($params);
        }
        return $login_url;
    }
    public function login(){
        $login_url = '';
        if(is_null($username = $this->getUserName(false))){
            $params = [
                'sign' => $this->Config['access_code'],
                'username' => $this->getUserName(),
                'password' => $this->password,
                'password_confirmation' => $this->password,
                'ratio_switch' => 1,
                'ratio' => 0,
                'ratio_setting' => 1,
                'bet_limit' => 1,
            ];
            $url = $this->Config['register_api'].'?'.http_build_query($params);
            $res = $this->curl_get($url);
            $res = json_decode($res,true);
            if($res['status'] == 1){
                $params = [
                    'username' => $this->getUserName(false),
                    'password' => md5(md5($this->password)),
                    'loginUrl' => $this->Config['agent_login_url'],
                    'sign' => $this->Config['access_code'],
                ];
                $login_url = $this->Config['login_api'].'?'.http_build_query($params);
            }
        }else{
            $params = [
                'username' => $username,
                'password' => md5(md5($this->password)),
                'loginUrl' => $this->Config['agent_login_url'],
                'sign' => $this->Config['access_code'],
            ];
            $login_url = $this->Config['login_api'].'?'.http_build_query($params);
        }
        return $login_url;
    }

    private function getUserName($up=true){
        return parent::getName(preg_replace("/[_]/","",($this->Config['agent'] ?? '').$this->user['username']),'','',$up);
    }

    private function curl_get($url){
        return $this->curl_get_content($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $result = curl_exec($ch);
        $code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        if ($code >= 400){
            die("<h1>网关异常</h1>");
        }
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    public function curl_post($post_data, $url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
    public function change(){
        if(!is_null($username = $this->getUserName(false))) {
            $this->login();
        }
        if ($this->param['type'] == 'IN') {
            return $this->Up_score($this->param['money'],$username);
        } elseif ($this->param['type'] == 'OUT') {
            return $this->Down_score($this->param['money'],$username);
        }
    }

    public function Up_score($score="",$username=""){
        $params = [
            'sign' => $this->Config['access_code'],
            'username' => $username,
            'password' => $this->password,
            'integral' => $score,
            'client_id' => $this->param['orderid'],
        ];
        $url = $this->Config['up_score_api'].'?'.http_build_query($params);
        $res = $this->curl_get($url);
        $res = json_decode($res,true);
        if($res['status'] == 1){
            return $this->show(0,'',['money'=>$score]);
        }
        return $this->show($res['status'],$res['err_msg'],['money'=>$score]);
    }
    public function Down_score($score="",$username=""){
        $params = [
            'sign' => $this->Config['access_code'],
            'username' => $username,
            'password' => $this->password,
            'integral' => $score,
            'client_id' => $this->param['orderid'],
        ];
        $url = $this->Config['down_score_api'].'?'.http_build_query($params);
        $res = $this->curl_get($url);
        $res = json_decode($res,true);
        if($res['status'] == 1){
            return $this->show(0,'',['money'=>$score]);
        }
        return $this->show($res['status'],$res['err_msg'],['money'=>$score]);
    }

    public function getMoney(){
        if(!is_null($username = $this->getUserName(false))) {
            $this->login();
        }
        return $this->Check_score($username);
    }

    public function Check_score($username){
        $params = [
            'sign' => $this->Config['access_code'],
            'username' => $username,
        ];
        $url = $this->Config['check_score_api'].'?'.http_build_query($params);
        $res = $this->curl_get($url);
        $res = json_decode($res,true);
        if($res['status'] == 1){
            return $this->show(0,'查询成功',['money'=>$res['integral']]);
        }
        return $this->show($res['status'],$res['err_msg']);
    }

    public function getOrder($param=""){
        dd($param);
        $data = [
            'sign' => $this->Config['access_code'],
            'client_id' => $param['order_id'],
        ];
        $res = $this->curl_post($data,$this->Config['check_order_api']);
        $res = json_decode($res,true);
        if($res['status'] == 1){
            return $this->show(0,'ok');
        }
        return $this->show($res['status']??500,$res['err_msg']??'error');
    }

    public function betList(){
        $data = [
            'sign' => $this->Config['access_code'],
            'begindate' => date('Y-m-d H:i:s',$this->param['startTime']),
            'enddate' => date('Y-m-d H:i:s',$this->param['endTime']),
        ];
        $url = $this->Config['betlist_api'].'?'.http_build_query($data);
        $res = $this->curl_get($url);
        $res = json_decode($res,true);
        return $res;
    }

    public function createData($aData){

        $GameIDs = $this->distinct($aData, 'id');
        $aArray = array_chunk($aData,1000);
        foreach ($aArray as $data) {
            $insert = [];
            $update = [];
            foreach ($data as $v) {
                if(!preg_match("/^".$this->getVal('agent')."/", $v['username']))
                    continue;
                $array = [
                    'g_id' => $this->gameInfo->g_id,
                    'GameID' => $v['id'],   //游戏代码
                    'username' => $v['username'],  //玩家账号
                    'AllBet' => $v['bet_amount'],//总下注
                    'bunko' => $v['profit'],       //盈利-下注
                    'bet_money' => $v['bet_amount'],//有效投注额
                    'GameStartTime' => $v['bet_time'],//游戏开始时间
                    'GameEndTime' => $v['draw_time'] ?? $v['bet_time'],  //游戏结束时间
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => $v['draw_time'] ?? $v['bet_time'],
                    'gameCategory' => 'LIVE', //
                    'game_type' => $this->getGameType($v['game_type']),
                    'service_money' => 0, // + 服务费
                    'bet_info' => '',
                    'flag' => $v['state'] == 1 ? 1 : $v['state'],
                    'productType' => null,
                    'game_id' => 35,
                    'round_id' => $v['record_id']
                ];
                $array['content'] = $this->content($v, $array);
                $this->arrInfo($array, $v);
                if (in_array($v['id'], $GameIDs))
                    $update[] = $array;
                else
                    $insert[] = $array;
            }
            count($insert) && $this->saveDB($insert);
            count($update) && $this->saveDB($update, 'GameID');
        }
    }

    public function content($v, $array)
    {
        try{
            $str = '';
            $str .= '局号:'.$array['round_id'].'<br />';
            $str .= '投注内容:'.$this->t($v).'<br />';
            $str .= '下注前余额:'.$v['balance_before'];
            return $str;
        }catch (\Throwable $e){
            writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            return $array['game_type'] ?? '';
        }
    }

    //投注内容
    public function t($v)
    {
        if($v['game_type'] == 'baccarat'){ # 百家乐
            switch ($v['bet_record']){
                case 'banker':
                    return '庄';
                case 'player':
                    return '闲';
                case 'tie':
                    return '和';
                case 'banker_pair':
                    return '庄对';
                case 'player_pair':
                    return '闲对';
                case 'big':
                    return '大';
                case 'small':
                    return '小';
            }
        }else if($v['game_type'] == 'dragon_tiger'){ # 龙虎
            switch ($v['bet_record']){
                case 'dragon':
                    return '龙';
                case 'tiger':
                    return '虎';
                case 'tie':
                    return '和';
                case 'dragon_even':
                    return '龙双';
                case 'dragon_odd':
                    return '龙单';
                case 'tiger_even':
                    return '虎双';
                case 'tiger_odd':
                    return '虎单';
            }
        }else if($v['game_type'] == 'cattle'){ # 牛牛
            switch ($v['bet_record']){
                case 'player1':
                    return '闲 1';
                case 'player1_double':
                    return '闲 1 翻倍';
                case 'player2':
                    return '闲 2';
                case 'player2_double':
                    return '闲 2 翻倍';
                case 'player3':
                    return '闲 3';
                case 'player3_double':
                    return '闲 3 翻倍';
            }
        }
        return '';
    }

    private function arrInfo(&$array, $v, $key = '')
    {
        $user = $this->getUser($array['username'], '', $key);
        $array['username'] = $user->username ?? $array['username'];
        $array['agent'] = $user->agent ?? 0;
        $array['user_id'] = $user->id ?? 0;
        $array['agent_account'] = $this->getAgent($user->agent ?? 0)->account ?? '';
        $array['agent_name'] = $this->getAgent($user->agent ?? 0)->name ?? '';
    }
    public function getGameType($key)
    {
        $data = [
            'baccarat' => '百家乐',
            'dragon_tiger' => '龙虎',
            'cattle' => '牛牛',
        ];
        return $data[$key];
    }

    //找出重复id
    public function distinct($data, $val = '')
    {
        $GameID = array_map(function($v)use($val){
            return $v[$val] ?? '';
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
}