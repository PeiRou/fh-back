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
//        if(class_exists($response)){
//            $class = new \ReflectionClass($response);
//            if($class->getName() == 'Illuminate\Http\JsonResponse')
//                $this->response = $response->getContent();
//        }
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
    private function update(){
        if(!empty($this->param) && is_array($this->param)){
            LogHandle::where('id', $this->id)->update($this->param);
        }
    }
    private function getUserName($id){
        return \App\Users::where('id', $id)->value('username');
    }
    private function getAgentName($a_id){
        return \App\Agent::where('a_id',$a_id)->value('account');
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
        $this->param['action'] = '修改会员('.$this->getUserName($this->request->uid).')金额：'.$this->request->money;
    }
    //修改会员资料
    private function acAdEditUser(){
        $this->param['action'] = '修改会员资料('.$this->request->account.')';
    }
    //更换代理
    private function acAdUserChangeAgent(){
        $this->param['action'] = '更换会员('.$this->getUserName($this->request->uid).')代理为'.$this->getAgentName($this->request->agent);
    }
    //删除代理
    private function mAgentDel(){
        $this->param['action'] = '删除代理('.$this->getAgentName($this->request->id).')';
    }
    //删除子账号
    private function acAdDelSubAccount(){
        $this->param['action'] = '删除子账号('.$this->getAccountName($this->request->id).')';
    }

}