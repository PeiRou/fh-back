<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/29
 * Time: 20:54
 */

namespace App\Repository\GamesApi\Card;

use App\Agent;
use App\Users;

class ReportBase
{
    //获取代理
    public function getAgent($a_id){
        if(empty($this->agent))
            $this->agent = Agent::select('a_id', 'name', 'account', 'gagent_id')->get()->keyBy('a_id');
        return $this->agent->get($a_id);
    }
    //获取用户
    public function getUserInfo(&$username){
        if(empty($this->Users))
            $this->Users = Users::where('username', $username)->get()->keyBy('username');
        return $this->Users->get($username);
    }
    //获取总代理
    public function getGeneralAgent($gagent_id){
        if(empty($this->GeneralAgent))
            $this->GeneralAgent = DB::table('general_agent')->get()->keyBy('ga_id');
        return $this->GeneralAgent->get($gagent_id);
    }

    public function __call($name, $arguments){
        return call_user_func_array([$this,$name],$arguments);
    }

}