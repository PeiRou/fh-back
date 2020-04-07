<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/23 0023
 * Time: 16:09
 */

namespace App\Repository\GamesApi\Card;


use Illuminate\Support\Facades\DB;

class FYDJRepository extends BaseRepository
{
    public $password = "123456";
    public $is_proxy_pass = true; //这个游戏是否使用代理那台服务器
    public function login(){
        if(is_null($username = $this->getUserName(false))){
            $username = $this->getUserName();
            $res = $this->register();
            if($res['success'] == 1){
                return $this->toLogin($username);
            }
        }
        return $this->toLogin($username);
    }

    private function toLogin($username){
        $data = [
            'username' => $username,
        ];
        $res = $this->curl_post($this->Config['login_api'],$data);
        $res = json_decode($res,true);
        if($res['success'] == 1){
            return $this->show(0, '获取登录地址成功',['url' => $res['info']['Url']]);
        }
        writeLog('fydj_login_log',$res);
        return $this->show(500, '网络异常');
    }

    private function getUserName($up=true){
        return parent::getName(preg_replace("/[_]/","",($this->Config['agent'] ?? '').$this->user['username']),'','',$up);
    }

    public function register($username=""){
        $data=[
            'UserName' => $username,
            'password' => $this->getPassword(),
        ];
        $res = $this->curl_post($this->Config['register_api'],$data);
        $res = json_decode($res,true);
        return $res;
    }
    public function getPassword(){
        return substr(md5($this->Config['agent'].$this->password),0,8);
    }

    protected function curl_post($url,$data){
        $url = str_replace('http://api.bw-gaming.com', 'https://api.avia-gaming.vip' , $url);
        return $this->curl_post_content($url, $data, null, ['Authorization:'. $this->Config['Authorization']]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization:'. $this->Config['Authorization']]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $result = curl_exec($ch);
        $code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        if ($code >= 400){
            die("<h1>第三方网关异常</h1>");
        }
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    public function change(){
        if(is_null($username = $this->getUserName(false))){
            $username = $this->getUserName();
            $res = $this->register();
            if($res['success'] == 1){
                return $this->toChange($username);
            }
        }
        return $this->toChange($username);
    }
    private function toChange($username){
        $data = [
            'UserName' => $username,
            'Money' => $this->param['money'],
            'Type' => strtoupper($this->param['type']),
            'ID' => $this->param['orderid'],
        ];
        $res = $this->curl_post($this->Config['transfer_api'],$data);
        if(empty($res)){
            return $this->show(500,$this->code500);
        }
        $res = json_decode($res,true);
        if($res['success'] == 1){
            return  $this->show(0,'',['money'=>$this->param['money']]);
        }
        return $this->show($res['success']??500,$res['msg']??'系统异常',['money'=>$this->param['money']]);
    }

    public function getMoney(){
        if(is_null($username = $this->getUserName(false))){
            $username = $this->getUserName();
            $res = $this->register();
            if($res['success'] == 1){
                return $this->toGetMoney($username);
            }
        }
        return $this->toGetMoney($username);
    }
    private function toGetMoney($username = ""){
        $data = [
            'UserName' => $username,
        ];
        $res = $this->curl_post($this->Config['balance_api'],$data);
        $res = json_decode($res,true);
        if($res['success'] == 1){
            return $this->show(0,'查询成功',['money'=>$res['info']['Money']]);
        }
        return $this->show($res['success']??500,$res['msg']??'系统异常');
    }
    public function getOrder($param = ""){
        $data = [
            'ID' => $param['order_id'],
        ];
        $res = $this->curl_post($this->Config['transferinfo_api'],$data);
        $res = json_decode($res,true);
        if($res['success'] == 1){
            return $this->show(0,'ok');
        }
        return $this->show($res['success']??500,$res['msg']??'error');
    }

    public function betList(){
        $resData = [];
//        $endDate = date("Y/m/d H:i:s");
//        /*-----------------确定时间开始------------------------*/
//        if(isset($this->param['toTime'])){
//            $endDate = date("Y/m/d H:i:s",$this->param['toTime']);
//        }
        $this->param['endDate'] = $this->param['endDate'] ?? date("Y/m/d H:i:s", strtotime($this->OffsetTime(['time' => $this->param['toTime'] ?? time()])));
        $this->param['startDate'] = date("Y/m/d 00:00:00",strtotime($this->param['endDate']));
        /*-----------------确定时间结束------------------------*/
        $this->toGetBetList($this->param['startDate'],$this->param['endDate'],1,$resData);
        return $resData;
    }

    private function toGetBetList($startDate="",$endDate="",$PageIndex="",&$resData){
        $data = [
            'Type' => 'UpdateAt',
            'StartAt' => $startDate,
            'EndAt' => $endDate,
            'UserName' => null,
            'PageIndex' => $PageIndex,
            'OrderType' => 'All'
        ];
        $res = $this->curl_post($this->Config['get_log_api'],$data);
        $res = json_decode($res,true);
        if($res['success'] == 1) {
            if (!empty($res['info']['list'])) {
                foreach ($res['info']['list'] as $k => $v) {
                    array_push($resData, $v);
                }
            }
            if (count($res['info']['list']) == 20) {
                $PageIndex += 1;
                $this->toGetBetList($startDate, $endDate, $PageIndex, $resData);
            }
        }else{
            $resData = [
                'error' => true,
            ];
        }
    }

    public function createData($aData){
        $GameIDs = $this->distinct($aData, 'OrderID');
        $aArray = array_chunk($aData,1000);
        foreach ($aArray as $data) {
            $insert = [];
            $update = [];

            foreach ($data as $v) {
                if(in_array(strtoupper($v['Status']), ['SETTLEMENT', 'NONE'])){
                    continue;
                }
                if(!preg_match("/^".$this->getVal('agent')."/", $v['UserName'])){
                    continue;
                }
                $array = [
                    'g_id' => $this->gameInfo->g_id,
                    'GameID' => $v['OrderID'],   //游戏代码
                    'username' => $v['UserName'],  //玩家账号
                    'AllBet' => $v['BetAmount'],//总下注
                    'bunko' => $v['Money'],       //盈利-下注
                    'bet_money' => $v['BetMoney'],//有效投注额
                    'GameStartTime' => $v['CreateAt'],//游戏开始时间
                    'GameEndTime' => $v['UpdateAt'] ?? $v['CreateAt'],  //游戏结束时间
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => $v['UpdateAt'] ?? $v['CreateAt'],
                    'gameCategory' => 'YOPLAY', //
                    'game_type' => $v['Category'] ?? $v['Code'] ?? '',
                    'service_money' => 0, // + 服务费
                    'bet_info' => '',
                    'flag' => in_array(strtoupper($v['Status']), ['SETTLEMENT', 'NONE']) ? 2 : 1,
                    'productType' => null,
                    'game_id' => 38,
                    'round_id' => $v['MatchID'] ?? $v['Index'] ?? ''
                ];
                $array['content'] = $this->content($v, $array);
                $this->arrInfo($array, $v);
                if (in_array($v['OrderID'], $GameIDs))
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
            switch ($v['Type']){
                case 'Smart':
                    $str .= '订单类型:小游戏订单<br />';
                    break;
                case 'Single':
                    $str .= '订单类型:单关电竞订单<br />';
                    break;
                case 'Combo':
                    $str .= '订单类型:串关订单<br />';
                    break;
            }
            !empty($v['League']) && $str .= '联赛名称:'.($v['League'] ?? '').'<br />';
            !empty($v['Bet']) && $str .= '投注名称:'.($v['Bet'] ?? '').'<br />';
            !empty($v['Content']) && $str .= '投注内容:'.($v['Content'] ?? '').'<br />';
            return $str;
        }catch (\Throwable $e){
            writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            return $array['game_type'] ?? '';
        }
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