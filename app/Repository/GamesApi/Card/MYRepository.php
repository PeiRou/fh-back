<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/16 0016
 * Time: 13:41
 */

namespace App\Repository\GamesApi\Card;


use Illuminate\Support\Facades\DB;

class MYRepository extends BaseRepository
{
    public $userTag = 1; //默认是正式账户
    public $NowDateTime = null;
    public function __construct($config, $name = 'Utils')
    {
        $this->NowDateTime = date('YmdHis');
        parent::__construct($config, $name);
    }
    //登录
    public function login($param=""){
        $this->getGameMemberID();
        $this->getUserTag();
        $url = '';
        if(is_null($name = $this->getUserName(false))){
            $name = $this->getUserName();
            $res = $this->createMember($name);
            $res = json_decode($res,true);
            if($res['ErrorCode'] == 0){
                $url = $this->toLogin($name,$param);
            }
        }else{
            $url = $this->toLogin($name,$param);
        }
//        dd($url);
        return $this->show(0, '获取登录地址成功',['url' => $url]);
    }

    private function toLogin($name = "",$param=""){
        $data = [
            'VenderNo' => $this->Config['vender_no'],
            'SiteNo' => $this->Config['agent'],
            'GameMemberID' => $this->getGameMemberID(),
            'MemberName' => $name,
            'GameConfigID' => $this->Config['GameConfigID'],
            'LanguageNo' => $this->Config['language'],
            'ShowRecharge' => 2,
            'Token' => md5($this->Config['Token']),
            'NowDateTime' => $this->NowDateTime,
            'OpenURL' => $this->Config['OpenURL'],
            'OpenBackURL' => $this->Config['OpenBackURL'],
            'IsTrial' => $this->userTag,
            'EntryType' => isset($param['source']) ? 0 : 1,
        ];
        $data2 = [
            'PageStyle' => null,
        ];
        $sign = $this->sign($data);
        $data = array_merge($data,$data2);
        $data['MD5DATA'] = $sign;
        $res = $this->redirect($data,'post',$this->Config['in_game']);
        dd($res);
        return $res;
    }
    //上下分
    public function change(){
        if(is_null($username = $this->getUserName(false))) {
            $username = $this->getUserName();
            $this->createMember($username);
        }
        $data = [
            'VenderNo' => $this->Config['vender_no'],
            'GameMemberID' => $this->getGameMemberID(),
            'VenderTransactionID' => $this->param['orderid'],
            'Amount' => $this->param['money'],
            'Direction' => $this->param['type'],
            'NowDateTime' => $this->NowDateTime,
        ];
        $sign = $this->sign($data);
        unset($data['NowDateTime']);
        $url = $this->Config['fund_transfer_api'].'?'.http_build_query($data).'&NowDateTime='.$this->NowDateTime.'&MD5DATA='.$sign;
        $res = $this->curl_get($url);
        if(empty($res)){
            return $this->show(500,$this->code500);
        }
        $res = json_decode($res,true);
        if($res['ErrorCode'] == 0){
            return $this->show(0,'',['money'=>$this->param['money']]);
        }
        return $this->show($res['ErrorCode'],$res['ErrorMsg']??'系统异常',['money'=>$this->param['money']]);
    }

    private function getGameMemberID(){
        $data = [
            'VenderNo' => $this->Config['vender_no'],
            'VenderMemberID' => $this->user['id'],
            'SiteNo' => $this->Config['agent'],
            'NowDateTime' => $this->NowDateTime,
        ];
        $sign = $this->sign($data);
        unset($data['NowDateTime']);
        $url = $this->Config['get_game_member_id_api'].'?'.http_build_query($data).'&NowDateTime='.$this->NowDateTime.'&MD5DATA='.$sign;
        $res = $this->curl_get($url);
        $res = json_decode($res,true);
        if($res['ErrorCode'] == 0){
            return $res['GameMemberID'];
        }
        return null;
    }

    public function getUserTag(){
        if($this->user['testFlag'] !== 0){
            $this->userTag = 1; //测试账号
        }else{
            $this->userTag = 0; //正式账号
        }
    }
    private function getUserName($up=true){
        return parent::getName(preg_replace("/[_]/","",($this->Config['agent'] ?? '').$this->user['username']),'','',$up);
    }
    public function createMember($name=""){
        $data = [
            'VenderNo' => $this->Config['vender_no'],
            'SiteNo' => $this->Config['agent'],
            'VenderMemberID' => $this->user['id'],
            'MemberName' => $name,
            'TestState' => $this->userTag,
            'CurrencyNo' => 'RMB',
            'NowDateTime' => $this->NowDateTime,
        ];
        $data2 = [
            'LayerNo' => null,
            'NickName' => null,
        ];
        $sign = $this->sign($data);
        $data = array_merge($data,$data2);
        unset($data['NowDateTime']);
        $url = $this->Config['create_member_api'].'?'.http_build_query($data).'&NowDateTime='.$this->NowDateTime.'&MD5DATA='.$sign;
        $res = $this->curl_get($url);
        return $res;
    }

    public function sign($data = []){
        $arrayKeys = array_keys($data);

        array_push($arrayKeys, 'pwd');
        usort($arrayKeys, function ($a, $b) {
            $a = strtolower($a);
            $b = strtolower($b);
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        });
        $str = '';
        foreach ($arrayKeys as $value) {
            $v = $data[$value]??null;
            if (is_null($v))
            {
                $str .= $this->Config['md5_key'];
            }
            else
            {
                $str .= $v;
            }
        }
        return md5($str);
    }

    private function curl_get($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,20);
        $result = curl_exec($ch);
        $code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        if ($code >= 400){
            die("<h1>网关异常</h1>");
        }
        if (curl_errno($ch)) {
            return null;
        }
        curl_close($ch);
        return $result;
    }

    protected function redirect($data = "",$method="post",$url=""){
        $htmlStr = '<form id="submit"  target="_blank" name="submit" method="'.$method.'" action="'.$url.'">';
        foreach($data as $key => $val){
            $htmlStr.="<input type='hidden' name='".$key."' value='".$val."'>";
        }
        $htmlStr.='<input type="submit" value="提交" style="display:none;" />';
        $htmlStr.='</form>';
        $htmlStr.='<script>document.forms["submit"].submit();</script>';
        return $htmlStr;
    }

    public function getMoney(){
        if(is_null($username = $this->getUserName(false))) {
            $username = $this->getUserName();
            $this->createMember($username);
        }
        $data = [
            'VenderNo' => $this->Config['vender_no'],
            'GameMemberIDs' => $this->getGameMemberID(),
            'NowDateTime' => $this->NowDateTime,
        ];
        $sign = $this->sign($data);
        unset($data['NowDateTime']);
        $url = $this->Config['get_balance_api'].'?'.http_build_query($data).'&NowDateTime='.$this->NowDateTime.'&MD5DATA='.$sign;
        $res = $this->curl_get($url);
        if(empty($res)){
            return $this->show(500,$this->code500);
        }
        $res = json_decode($res,true);
        if($res['ErrorCode'] == 0){
            return $this->show(0,'查询成功',['money'=>$res['MemberBalanceList'][0]['Balance']]);
        }
        return $this->show($res['ErrorCode'],$res['ErrorMsg']??'系统异常');
    }

    public function getOrder($param = ""){
        $data = [
            'VenderNo' => $this->Config['vender_no'],
            'VenderTransactionID' => $param['order_id'],
            'NowDateTime' => $this->NowDateTime,
        ];
        $sign = $this->sign($data);
        unset($data['NowDateTime']);
        $url = $this->Config['check_fund_transfer_api'].'?'.http_build_query($data).'&NowDateTime='.$this->NowDateTime.'&MD5DATA='.$sign;
        $res = $this->curl_get($url);
        if(empty($res)){
            return $this->show(500,$this->code500);
        }
        $res = json_decode($res,true);
        if($res['ErrorCode'] == 0){
            return $this->show(0,'ok');
        }
        return $this->show($res['ErrorCode']??500,$res['ErrorMsg']??'error');
    }


    public function betList(){
        /*-------------确定局号开始----------------*/
        $StartGameSequenceID = 0;
        if(isset($this->param['toTime'])){
            $time = date('Y-m-d H:i:s',$this->param['toTime']);
            $res = DB::table('jq_bet')->where('GameStartTime',$time)->where('g_id',$this->gameInfo->g_id)->first();
            if(!empty($res)){
                $StartGameSequenceID = $res->GameID;
            }
        }else {
//            $res = DB::table('jq_bet')->where('g_id',$this->gameInfo->g_id)->orderByDesc('GameID')->get();
            $res = DB::table('jq_bet_his')->where('g_id',$this->gameInfo->g_id)->orderByDesc('GameID')->get();
//            dd($res);
            if(!$res->isEmpty()){
                $StartGameSequenceID = $res->max('GameID');
            }
        }
//        dd($StartGameSequenceID);
        /*-------------确定局号结束----------------*/
        $res = $this->getBetList($StartGameSequenceID); //拉取注单
        $res = json_decode($res,true);
        return $res;
    }

    private function getBetList($StartGameSequenceID=""){
        $data = [
            'VenderNo' => $this->Config['vender_no'],
            'SiteNo' => $this->Config['agent'],
            'StartGameSequenceID' => $StartGameSequenceID,
            'BetCodeLanguage' => 'zh_cn',
            'NowDateTime' => $this->NowDateTime,
        ];
        $sign = $this->sign($data);
        unset($data['NowDateTime']);
        $url = $this->Config['get_game_detail_api'].'?'.http_build_query($data).'&NowDateTime='.$this->NowDateTime.'&MD5DATA='.$sign;
        $res = $this->curl_get($url);
        return $res;
    }

    public function createData($aData){
        $GameIDs = $this->distinct($aData, 'GameSequenceID');
        $aArray = array_chunk($aData,1000);
        foreach ($aArray as $data) {
            $insert = [];
            $update = [];
            foreach ($data as $v) {
                if(!preg_match("/^".$this->getVal('agent')."/", $v['MemberName']))
                    continue;
                $array = [
                    'g_id' => $this->gameInfo->g_id,
                    'GameID' => $v['GameSequenceID'],   //游戏代码
                    'username' => $v['MemberName'],  //玩家账号
                    'AllBet' => $v['BetMoney'],//总下注
                    'bunko' => $v['WinLoseMoney'],       //盈利-下注
                    'bet_money' => $v['ValidBetMoney'],//有效投注额
                    'GameStartTime' => $v['BetDateTime'],//游戏开始时间
                    'GameEndTime' => $v['CountDateTime'] ?? $v['BetDateTime'],  //游戏结束时间
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => $v['CountDateTime'] ?? $v['BetDateTime'],
                    'gameCategory' => 'LIVE', //
                    'game_type' => $this->getGameType($v['GameID']),
                    'service_money' => 0, // + 服务费
                    'bet_info' => '',
                    'flag' => $v['State'] == 2 ? 1 : $v['State'],
                    'productType' => null,
                    'game_id' => 36,
                ];
                $this->arrInfo($array, $v);
                if (in_array($v['GameSequenceID'], $GameIDs))
                    $update[] = $array;
                else
                    $insert[] = $array;
            }
            count($insert) && $this->saveDB($insert);
            count($update) && $this->saveDB($update, 'GameID');
        }
    }
    private function arrInfo(&$array, $v, $key = 'MY')
    {
        $user = $this->getUser($array['username'], 'platformType', $key);
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

    public function getGameType($key)
    {
        $data = [
            'Baccarat' => '百家乐',
            'Roulette' => '轮盘',
            'LongHu' => '龙虎',
            'BIDBaccarat' => '竞眯百家乐',
            'VipBaccarat' => '百家乐包桌',
            'Dice' => '骰子',
            'INSBaccarat' => '保险百家乐',
            'NiuNiu' => '牛牛',
            'ThreeCardPoker' => '三王牌',
        ];
        return $data[$key];
    }
}