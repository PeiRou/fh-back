<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */

namespace App\Repository\HandleLog;
use App\Http\Services\FactoryService;
use App\LogHandle;
use App\Users;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
//    protected $response;
    protected $request;
    private $param = null;
    public function __construct($request,$id, $data)
    {
//        $this->response = $response;
        $this->request = $request;
        $this->id = $id;
        $this->data = $data;
        $this->action();
    }
    public function action(){
        $funcName = preg_replace_callback('/([\.]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$this->request->route()->getName());
        if(method_exists($this, $funcName))
            $this->$funcName();
        $this->update();
    }
    public function actionAfter(){
        $funcName = preg_replace_callback('/([\.]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$this->request->route()->getName());
        $funcName = $funcName.'After';
        if(method_exists($this, $funcName)) {
            $this->$funcName();
            $this->update();
        }
    }
    private function update(){
        if(!empty($this->param) && is_array($this->param)){
            LogHandle::where('id', $this->id)->update($this->param);
        }
    }
    private function getUserName($id){
        return \App\Users::where('id', $id)->value('username');
    }
    private function getUser($id){
        if(empty($this->users[$id]))
            $this->users[$id] = \App\Users::where('id', $id)->first();
        return $this->users[$id];
    }
    private function getBank($id){
        if(empty($this->bank[$id]))
            $this->bank[$id] = \App\Banks::where('bank_id', $id)->first();
        return $this->bank[$id];
    }
    private function getAgentName($a_id){
        return \App\Agent::where('a_id',$a_id)->value('account');
    }
    private function getGeneralAgent($id){
        if(empty($this->GeneralAgent[$id]))
            $this->GeneralAgent[$id] = \App\GeneralAgent::where('ga_id', $id)->first();
        return $this->GeneralAgent[$id];
    }
    private function getLevel($id){
        if(empty($this->Level[$id]))
            $this->Level[$id] = \App\Levels::where('value', $id)->first();
        return $this->Level[$id];
    }
    private function getAccountName($sa_id){
        return \App\SubAccount::where('sa_id',$sa_id)->value('account');
    }
    private function getBet($order_id){
        return \App\Bets::where('order_id',$order_id)->first();
    }
    //取消注单
    private function acAdBetCancel(){
        $this->param['action'] = '取消注单会员（'.$this->getUserName($this->getBet($this->request->orderId)->user_id ?? 0).'）
         -订单号（'.$this->request->orderId.'）';
    }
    //充值审核通过
    private function acAdPassRecharge(){
        $getInfo = \App\Recharges::where('id',$this->request->id)->first();
        $this->param['action'] = '审核充值通过会员（'.$this->getUserName($getInfo->userId).'）,金额（'.$getInfo->amount.'）';
    }
    //通过提款审核
    private function acAdPassDrawing(){
        $drawing = \App\Drawing::where('id',$this->request->id)->first();
        $this->param['action'] = '审核提款通过会员（'.$this->getUserName($drawing->user_id).'）,金额（'.$drawing->amount.'）';
    }
    //删除用户
    private function mUserDelUser(){
        $this->param['action'] = '删除会员('.$this->getUserName($this->request->id).')';
    }
    //改变用户金额
    private function acAdChangeUserMoney(){
        $this->param['action'] = '修改会员('.$this->getUserName($this->request->uid).')金额:'.$this->request->money;
        $this->param['action'] .= '</br>';
        $this->param['action'] .= '修改前:';
        $this->acAdChangeUserMoneyData();
    }
    //改变用户金额后
    private function acAdChangeUserMoneyAfter(){
        $this->param['action'] .= '修改后:';
        $this->acAdChangeUserMoneyData();
    }
    private function acAdChangeUserMoneyData(){
        $user = \App\Users::where('id', $this->request->uid)->first();
        $this->param['action'] .= '余额（'.$user->money.'）。';
        $this->param['action'] .= '</br>';
    }

    //修改会员资料
    private function acAdEditUser(){
        $this->param['action'] = '修改会员资料('.$this->request->account.')</br>';
        $this->param['action'] .= '修改前:';
        $this->acAdEditUserData();
    }
    private function acAdEditUserAfter(){
        $this->param['action'] .= '修改后:';
        $this->acAdEditUserData();
    }
    function acAdEditUserData(){
        $user = \App\Users::where('id', $this->request->uid)->first();
        if(isset($this->request->status))
            $this->param['action'] .= '状态（'.Users::$status[$user->status].'）。';
        if(isset($this->request->password))
            $this->param['action'] .= '密码（'.$user->password.'）。';
        if(isset($this->request->bank))
            $this->param['action'] .= '开户银行（'.$user->bank_name.'）。';
        if(isset($this->request->bank_num))
            $this->param['action'] .= '银行卡号（'.$user->bank_num.'）。';
        if(isset($this->request->bank_addr))
            $this->param['action'] .= '支行地址（'.$user->bank_addr.'）。';
        if(isset($this->request->mobile))
            $this->param['action'] .= '手机号码（'.$user->mobile.'）。';
        if(isset($this->request->qq))
            $this->param['action'] .= 'qq（'.$user->qq.'）。';
        if(isset($this->request->email))
            $this->param['action'] .= 'email（'.$user->email.'）。';
        if(isset($this->request->wechat))
            $this->param['action'] .= '微信（'.$user->wechat.'）。';
        if(isset($this->request->fundPwd))
            $this->param['action'] .= '提款密码（'.$user->fundPwd.'）。';
        if(isset($this->request->levels))
            $this->param['action'] .= '层级（'.$this->getLevel($user->rechLevel)->name.'）。';
        if(isset($this->request->content))
            $this->param['action'] .= '备注（'.$this->request->content.'）。';
        $this->param['action'] .= '</br>';
    }
    //更换代理
    private function acAdUserChangeAgent(){
        $this->param['action'] = '更换会员('.$this->getUser($this->request->uid)->username.')代理为:'.$this->getAgentName($this->request->agent);
        $this->param['action'] .= ',更换前为:'.$this->getAgentName($this->getUser($this->request->uid)->agent);
    }
    //删除代理
    private function mAgentDel(){
        $this->param['action'] = '删除代理('.$this->getAgentName($this->request->id).')';
    }
    //删除子账号
    private function acAdDelSubAccount(){
        $this->param['action'] = '删除子账号('.$this->getAccountName($this->request->id).')';
    }
    //会员更换真实姓名
    private function acAdUserChangeFullName(){
        $this->param['action'] = '更换会员('.$this->getUser($this->request->uid)->username.')真实姓名为:'.$this->request->fullName;
        $this->param['action'] .= '</br>更换前为:'.$this->getUser($this->request->uid)->fullName;
        $this->param['action'] .= '</br>';
    }
    //添加代理
    private function acAdAddAgent(){
        $this->param['action'] = '添加代理('.$this->request->account.'),上级总代('.$this->getGeneralAgent($this->request->gagent)->account.')';
        $this->param['action'] .= ',代理模式('.\App\Agent::$agentModelStatus[$this->request->modelStatus].')';
        $this->param['action'] .= ',代理名称('.$this->request->name.')';
    }
    //踢下线
    private function acAdGetOutUser(){
        $this->param['action'] = '踢下线('.$this->getUser($this->request->id)->username.')';
    }
    //修改在线支付配置
    private function acAdNewEditPayOnline(){
        $this->param['action'] = '修改在线支付配置</br>';
        $this->param['action'] .= '修改前：';
        $this->acAdNewEditPayOnlineData();
    }
    private function acAdNewEditPayOnlineAfter(){
        $this->param['action'] .= '修改后：';
        $this->acAdNewEditPayOnlineData();
    }
    private function acAdNewEditPayOnlineData(){
        $res = DB::table('pay_online_new')->find($this->request->id);
        $this->param['action'] .= '支付类型（'.$res->rechName.'）'
            . '不可见地区（'.$res->lockArea.'）'
            . '支付名称（'.$res->payeeName.'）'
            . '商户号（'.$res->apiId.'）<br/>';
    }
    //添加在线支付配置
    private function acAdNewAddPayOnline(){
        $iPayTypeNew = DB::table('pay_type_new')->where('id',$this->request->payType)->first();
        $this->param['action'] = '添加在线支付配置</br>';
        $this->param['action'] .= '支付类型（'.$iPayTypeNew->rechName.'）'
            . '不可见地区（'.implode(',', $this->request->lockArea).'）'
            . '支付名称（'.$this->request->payeeName.'）'
            . '商户号（'.$this->request->apiId.'）<br/>';
    }

}