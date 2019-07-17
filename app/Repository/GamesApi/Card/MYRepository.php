<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/16 0016
 * Time: 13:41
 */

namespace App\Repository\GamesApi\Card;


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
        $data = [
            'VenderNo' => $this->Config['vender_no'],
            'SiteNo' => $this->Config['agent'],
            'StartGameSequenceID'
        ];
    }
}