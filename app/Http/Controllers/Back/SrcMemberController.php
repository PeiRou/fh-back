<?php

namespace App\Http\Controllers\Back;

use App\Agent;
use App\AgentOddsSetting;
use App\Capital;
use App\Drawing;
use App\GeneralAgent;
use App\Recharges;
use App\SubAccount;
use App\User;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class SrcMemberController extends Controller
{
    //添加总代理
    public function addGeneralAgent(Request $request)
    {
        $account = $request->input('account');
        $name = $request->input('name');
        $password = $request->input('password');

        $has = GeneralAgent::where('account',$account)->first();
        if(!empty($has))
            return response()->json([
                'status'=>false,
                'msg'=>'此总代理帐号已存在！'
            ]);
        try{
            $generalAgent = new GeneralAgent();
            $generalAgent->account = $account;
            $generalAgent->name = $name;
            $generalAgent->usertype = '888';
            $generalAgent->password = Hash::make($password);
            $insert = $generalAgent->save();
        }catch (\exception $e){
            $insert = 0;
        }
        if($insert == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'添加成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }
    //修改总代理
    public function editGeneralAgent(Request $request)
    {
        $id = $request->input('ga_id');
        $status = $request->input('status');
        $password = $request->input('password');
        $truename = $request->input('truename');
        $wechat = $request->input('wechat');
        $mobile = $request->input('mobile');
        $email = $request->input('email');
        $qq = $request->input('qq');
        $editodds = $request->input('editodds');
        $data = [
            'status'=>$status,
            'truename'=>$truename,
            'wechat'=>$wechat,
            'mobile'=>$mobile,
            'email'=>$email,
            'qq'=>$qq,
            'edit_odds'=>$editodds
        ];
        if($password !== ""){
            $data = [
                'status'=>$status,
                'truename'=>$truename,
                'wechat'=>$wechat,
                'mobile'=>$mobile,
                'email'=>$email,
                'qq'=>$qq,
                'password'=>Hash::make($password),
                'edit_odds'=>$editodds
            ];
        }
        $update = GeneralAgent::where('ga_id',$id)
            ->update($data);
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'更新成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法更新，请稍后重试'
            ]);
        }
    }

    //添加代理账号
    public function addAgent(Request $request)
    {
        $modelStatus = $request->input('modelStatus');
        $gagent = $request->input('gagent');
        $account = $request->input('account');
        $name = $request->input('name');
        $password = $request->input('password');
        $editOdds = $request->input('editodds');
        $agentId = $request->input('agentId');
        $odds_level = $request->input('odds_level');

        $has = Agent::where('account',$account)->first();
        if(!empty($has))
            return response()->json([
                'status'=>false,
                'msg'=>'此代理帐号已存在！'
            ]);
        $has = Agent::where('name',$name)->first();
        if(!empty($has))
            return response()->json([
                'status'=>false,
                'msg'=>'此代理名字已存在！'
            ]);

        if (empty($agentId))
            $superior_agent = 0;
        else {
            $iAgent = Agent::where('a_id', $agentId)->first();
            if ($iAgent->odds_level > $odds_level) {
                return response()->json([
                    'status' => false,
                    'msg' => '此代理赔率过高'
                ]);
            }
            $superior_agent = $iAgent->superior_agent;
            if (empty($superior_agent)) {
                $superior_agent = $agentId;
            } else {
                $superior_agent .= ',' . $agentId;
            }
        }

        try {
            $agent = new Agent();
            $agent->gagent_id = $gagent;
            $agent->account = $account;
            $agent->name = $name;
            $agent->password = Hash::make($password);
            $agent->editodds = $editOdds;
            $agent->superior_agent = $superior_agent;
            $agent->odds_level = $odds_level;
            $agent->modelStatus = empty($modelStatus)?0:$modelStatus;
            $insert = $agent->save();
        }catch (\exception $e){
            $insert = 0;
        }
        if($insert == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'添加成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }
    //修改代理账号
    public function editAgent(Request $request)
    {
        $a_id = $request->input('a_id');
        $password = $request->input('password');
        $draw_password = $request->input('draw_password');
        $data = collect([
            'status'=>$request->input('status'),
            'truename'=>$request->input('truename'),
            'bank_id'=>$request->input('bank'),
            'bank_num'=>$request->input('bank_num'),
            'bank_addr'=>$request->input('bank_addr'),
            'mobile'=>$request->input('mobile'),
            'qq'=>$request->input('qq'),
            'email'=>$request->input('email'),
            'wechat'=>$request->input('wechat'),
            'editodds'=>$request->input('editodds'),
            'content'=>$request->input('content'),
            'name'=>$request->input('name'),
        ]);
        if(!empty($password)){
            $data->put('password',Hash::make($password));
        }
        if(!empty($draw_password)){
            $data->put('draw_password',Hash::make($draw_password));
        }
        $update = Agent::where('a_id',$a_id)
            ->update($data->all());
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'修改成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法修改，请稍后重试'
            ]);
        }
    }
    public function passAgent($a_id){
        if(Agent::where('a_id',$a_id)->update(['status'=>1])){
            return  response()->json([
                'status'=>true,
                'msg'=>''
            ]);
        }
        response()->json([
            'status'=>false,
            'msg'=>'error'
        ]);
    }
    public function errorAgent($a_id){
        if(Agent::where('a_id',$a_id)->update(['status'=>4])){
            return  response()->json([
                'status'=>true,
                'msg'=>''
            ]);
        }
        response()->json([
            'status'=>false,
            'msg'=>'error'
        ]);
    }
    //修改代理金额
    public function changeAgentMoney(Request $request)
    {
        $loginAccount = Session::get('account_id');
        $a_id = $request->input('a_id');
        $money = $request->input('money');
        $content = $request->input('content');
        $getAgentBalance = Agent::find($a_id);
        try{
            $newBalance = $getAgentBalance->balance + $money;
            if($newBalance < 0)
            {
                return response()->json([
                    'status'=>false,
                    'msg'=>'您输入的金额超出了现有余额的计算结果！'
                ]);
            }
            $capital = new Capital();
            $capital->to_user = $a_id;
            $capital->user_type = 'agent';
            $capital->order_id = $this->randOrder('C');
            if($money < 0)
            {
                $capital->type = 't19';
            } else {
                $capital->type = 't18';
            }
            $capital->money = $money;
            $capital->balance = $newBalance;
            $capital->operation_id = $loginAccount;
            $capital->content = $content;
            $insert = $capital->save();
            if($insert == 1){
                $updateBalance = Agent::where('a_id',$a_id)
                    ->update([
                       'balance'=>$newBalance
                    ]);
                if($updateBalance == 1){
                    return response()->json([
                        'status'=>true,
                        'msg'=>'ok'
                    ]);
                } else {
                    return response()->json([
                        'status'=>false,
                        'msg'=>'资金操作失败，请稍后再试！'
                    ]);
                }
            } else {
                return response()->json([
                    'status'=>false,
                    'msg'=>'资金操作失败，请稍后再试！'
                ]);
            }
        } catch (\Exception $e){

        }
    }
    //删除代理账号
    public function delAgent($id)
    {
        //处理下级代理
        $aAgent = Agent::getSubordinateAgent($id);
        $aArray = [];
        $aArrayId = [];
        foreach ($aAgent as $iAgent){
            $aArray[] = [
                'a_id' => $iAgent->a_id,
                'superior_agent' => '1'.substr($iAgent->superior_agent,strpos($iAgent->superior_agent,$id)+strlen($id)),
            ];
            $aArrayId[] = $iAgent->a_id;
        }
        if(empty($aArray))
            $aAgentSql = '';
        else
            $aAgentSql = Agent::updateFiledBatchStitching($aArray,['superior_agent'],'a_id');

        //处理下级代理的会员
        $aAgent = Users::select('id','agent_odds')->whereIn('agent',$aArrayId)->get();
        $aArray = [];
        foreach ($aAgent as $iAgent){
            $agentOdds = unserialize($iAgent->agent_odds);
            unset($agentOdds[$id]);
            $aArray[] = [
                'id' => $iAgent->id,
                'agent_odds' => serialize($agentOdds)
            ];
        }
        if(empty($aArray))
            $aUserSql = '';
        else
            $aUserSql = Users::updateFiledBatchStitching($aArray,['agent_odds'],'id');
        DB::beginTransaction();
        try {
            if(!empty($aAgentSql))  DB::update($aAgentSql);
            Agent::where('a_id', $id)->delete();
            //处理本代理下的会员
            Users::where('agent',$id)->update(['agent_odds' => null,'agent' => 1]);
            if(!empty($aUserSql))   DB::update($aUserSql);
            DB::commit();
            return response()->json([
                'status'=>true,
                'msg'=>'ok'
            ]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json([
                'status'=>false,
                'msg'=>'删除失败，请稍后再试！'
            ]);
        }
    }
    //添加会员账号
    public function AddUser(Request $request)
    {
        $agent = $request->input('agent');
        $username = $request->input('username');
        $password = $request->input('password');
        $fullName = $request->input('fullName');

        if(empty($agent)){
            return response()->json([
                'status'=>false,
                'msg'=>'请选择用户代理层级'
            ]);
        }

        $check = User::where('username',$username)->count();
        if($check !== 0){
            return response()->json([
                'status'=>false,
                'msg'=>'用户名已经存在！'
            ]);
        }

        if($agent == 2){
            $testFlag = 2;
        } else if($agent == 3){
            $testFlag = 1;
        } else {
            $testFlag = 0;
        }

        $iAgent = Agent::where('a_id',$agent)->first();
        $promoter = 0;
        if($iAgent->modelStatus == 2)
            $promoter = 1;
        $odds = Agent::returnUserOdds($agent);

        $user = new User();
        $user->agent = $agent;
        $user->username = $username;
        $user->email = 0;
        $user->password = Hash::make(md5($password));
        $user->fullName = $fullName;
        $user->testFlag = $testFlag;
        $user->agent_odds = $odds['agent_odds'];
        $user->user_odds = $odds['user_odds'];
        $user->user_odds_level = $odds['user_odds_level'];
        $user->promoter = $promoter;
        $insert = $user->save();
        if($insert == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'添加成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }
    //删除会员
    public function delUser($id)
    {
        $User = User::find($id);
        if($User){
            $del = $User->delete();
        }
        if(isset($del) && $del == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'ok!'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'操作失败，请稍后再试！'
            ]);
        }
    }
    //会员踢下线
    public function getOutUser(Request $request)
    {
        $uid = $request->get('id');
        $key = 'user:'.md5($uid);
        $redis = Redis::connection();
        $redis->select(2);
        $user = (array)json_decode($redis->get($key),true);
        Redis::del($key);
        Redis::select(6);
        $key = 'urtime:'.$user['user_session_id'];
        Redis::del($key);
        return response()->json([
            'status'=>true,
            'msg'=>'会员已被强制踢下线！'
        ]);
    }
    //更换会员代理
    public function userChangeAgent(Request $request)
    {
        $uid = $request->input('uid');
        $agent = $request->input('agent');
        $check = User::where('id',$uid)->first();
        if(isset($check->agent) && $check->agent==2){
            return response()->json([
                'status'=>false,
                'msg'=>'测试用户不可修改代理！'
            ]);
        }

        $odds = Agent::returnUserOdds($agent);
        if($agent == 2 || $agent == 3){
            return response()->json([
                'status'=>false,
                'msg'=>'不可修改为测试用户，请重新添加！'
            ]);
//            $update = User::where('id',$uid)
//                ->update([
//                    'agent'=>$agent,
//                    'testFlag' => 2,
//                    'promoter' => 0,
//                    'user_odds' => $odds['user_odds'],
//                    'agent_odds' => $odds['agent_odds'],
//                    'user_odds_level' => $odds['user_odds_level'],
//                ]);
//        } else if($agent == 3){
//            $update = User::where('id',$uid)
//                ->update([
//                    'agent'=>$agent,
//                    'testFlag' => 1,
//                    'promoter' => 0,
//                    'user_odds' => $odds['user_odds'],
//                    'agent_odds' => $odds['agent_odds'],
//                    'user_odds_level' => $odds['user_odds_level'],
//                ]);
        } else {
            $aArray = [
                'agent'=>$agent,
                'testFlag' => 0,
                'user_odds' => $odds['user_odds'],
                'agent_odds' => $odds['agent_odds'],
                'user_odds_level' => $odds['user_odds_level'],
            ];
            $iAgent = Agent::where('a_id',$agent)->first();
            if($iAgent->modelStatus == 2){
                $aArray['promoter'] = -1;
            }
            $update = User::where('id',$uid)
                ->update($aArray);
        }

        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'ok!'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'操作失败，请稍后再试！'
            ]);
        }
     }
     //用户修改真实姓名
    public function userChangeFullName(Request $request)
    {
        $uid = $request->input('uid');
        $fullName = $request->input('fullName');
        //真名匹配
        $pattern = '/^[\x{4e00}-\x{9fa5}]+$/u';
        $matches = preg_match($pattern, $fullName);
        if(!$matches)
            return response()->json([
                'status' => false ,
                'msg'  => '请输入中文姓名！'
            ]);
        $update = User::where('id',$uid)
            ->update([
                'fullName'=>$fullName
            ]);
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'ok!'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'操作失败，请稍后再试！'
            ]);
        }
    }
    //修改用户资料
    public function editUser(Request $request)
    {
        $uid = $request->input('uid');
        $password = $request->input('password');
        $fundPwd = $request->input('fundPwd');
        $bank_id = $request->input('bank');
        if(!empty($bank_id)){
            $bank = DB::table('bank')->select('name')->where('bank_id',$bank_id)->first();
            $bank = $bank->name;
        }else
            $bank = '';
        $writeData = array();
        //会员状态
        if(!empty($request->input('status')))
            $writeData['status'] = $request->input('status');
        //开户银行
        if(!empty($bank)){
            $writeData['bank_id'] = $bank_id;
            $writeData['bank_name'] = $bank;
        }
        //银行卡号
        if(!empty($request->input('bank_num')))
            $writeData['bank_num'] = $request->input('bank_num');
        //支行地址
        if(!empty($request->input('bank_addr')))
            $writeData['bank_addr'] = $request->input('bank_addr');
        //手机号码
        if(!empty($request->input('mobile')))
            $writeData['mobile'] = $request->input('mobile');
        //qq
        if(!empty($request->input('qq')))
            $writeData['qq'] = $request->input('qq');
        //email
        if(!empty($request->input('email')))
            $writeData['email'] = $request->input('email');
        //微信
        if(!empty($request->input('wechat')))
            $writeData['wechat'] = $request->input('wechat');
        //editodds
        if(!empty($request->input('editodds')))
            $writeData['editodds'] = $request->input('editodds');
        //备注
        if(!empty($request->input('content')))
            $writeData['content'] = $request->input('content');
        //充值层级
        if(!empty($request->input('levels')))
            $writeData['rechLevel'] = $request->input('levels');
        $data = collect($writeData);
        if(!empty($password)){
            $data->put('password',Hash::make(md5($password)));
        }
        if(!empty($fundPwd)){
            $data->put('fundPwd',Hash::make(md5($fundPwd)));
        }
        $update = User::where('id',$uid)
            ->update($data->all());
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'修改成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法修改，请稍后重试'
            ]);
        }
    }
    //变更用户余额
    public function changeUserMoney(Request $request)
    {
        $loginAccount = Session::get('account_id');
        $loginAccountName = Session::get('account_name');
        $uid = $request->input('uid');
        $money = $request->input('money');
        $content = $request->input('content');
        $adminAddMoney = $request->input('admin_add_money');
        $getUserBalance = User::find($uid);
        if(empty($content))
            return response()->json([
                'status'=>false,
                'msg'=>'请输入余额变动备注！'
            ]);
        $redis = Redis::connection();
        $redis->select(5);
        $key = 'addMy';
        if(!$redis->exists($key.$uid.(string)$money)){
            $redis->setex($key.$uid.(string)$money,61,'on');
            try{
                $newBalance = $getUserBalance->money + $money;
                if($newBalance < 0)
                {
                    return response()->json([
                        'status'=>false,
                        'msg'=>'您输入的金额超出了现有余额的计算结果！'
                    ]);
                }
                $capital = new Capital();
                $capital->to_user = $uid;
                $capital->user_type = 'user';
                $capital->order_id = $this->randOrder('C');
                if($money < 0)
                {
                    $capital->type = 't19';
                } else {
                    $capital->type = 't18';
                }
                $capital->money = $money;
                $capital->balance = $newBalance;
                $capital->operation_id = $loginAccount;
                $capital->content = $content;
                $capital->rechargesType = $adminAddMoney;
                $insert = $capital->save();
                if($insert == 1){
                    if($money > 0){
                        $recharges = new Recharges();
                        $recharges->userId = $uid;
                        $recharges->username = $getUserBalance->username;
                        $recharges->orderNum = payOrderNumber();
                        $recharges->payType = 'adminAddMoney';
                        $recharges->amount = $money;
                        $recharges->balance = $getUserBalance->money+$money;
                        $recharges->shou_info = "后台加钱：".$content;
                        $recharges->msg = $content;
                        $recharges->updated_at = date('Y-m-d H:i:s');
                        $recharges->status = 2;
                        $recharges->addMoney = 1;
                        $recharges->process_date = date('Y-m-d H:i:s');
                        $recharges->operation_id = Session::get('account_id');
                        $recharges->operation_account = Session::get('account');
                        $recharges->admin_add_money = $adminAddMoney;
                        $save = $recharges->save();
                        if($save == 1){
                            $updateUserMoney = DB::table('users')->where('id',$uid)->update([
                                'money' => DB::raw('money + '.$money)
                            ]);
                            if($updateUserMoney == 1){
                                return response()->json([
                                    'status'=>true,
                                    'msg'=>'ok'
                                ]);
                            } else {
                                return response()->json([
                                    'status'=>false,
                                    'msg'=>'资金操作失败，请稍后再试！'
                                ]);
                            }
                        } else {
                            return response()->json([
                                'status'=>false,
                                'msg'=>'提交失败，请稍后再试！'
                            ]);
                        }
                    } else {
                        $insert = DB::table('drawing')->insert([
                            'user_id' => $uid,
                            'username' => $getUserBalance->username,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'balance' => $getUserBalance->money+$money,
                            'total_bet' => 0,
                            'operation_id' => Session::get('account_id'),
                            'operation_account' => Session::get('account'),
                            'process_date' => date('Y-m-d H:i:s'),
                            'order_id' => $this->orderNumber(),
                            'amount' => 0-$money,
                            'ip' => '-',
                            'ip_info' => '-',
                            'draw_type' => 2,
                            'status' => 2,
                            'platform' => 1,
                            'msg' => $content
                        ]);
                        if($insert == 1){
                            $updateUserMoney = DB::table('users')->where('id',$uid)->update([
                                'money' => DB::raw('money + '.$money)
                            ]);
                            if($updateUserMoney == 1){
                                return response()->json([
                                    'status'=>true,
                                    'msg'=>'ok'
                                ]);
                            } else {
                                return response()->json([
                                    'status'=>false,
                                    'msg'=>'资金操作失败，请稍后再试！'
                                ]);
                            }
                        } else {
                            return response()->json([
                                'status'=>false,
                                'msg'=>'提交失败，请稍后再试！'
                            ]);
                        }
                    }

                } else {
                    \Log::info('资金操作失败 order_id:'.$capital->order_id.' type:'.$capital->type.' sa_id:'.$capital->operation_id.' sa_name:'.$loginAccountName);
                    return response()->json([
                        'status'=>false,
                        'msg'=>'资金操作失败，请稍后再试！'
                    ]);
                }
            } catch (\Exception $e){

            }
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'同一个用户同资金61秒内无法重复操作，请稍后再试！'
            ]);
        }
    }

    function orderNumber(){
        $c = "D";
        $date = date('YmdHis');
        $randnum = rand(10000000,99999999);
        return $c.$date.$randnum;
    }
    //会员总余额统计
    public function totalUserMoney()
    {
        $total = DB::table('users')
            ->where('testFlag',0)
            ->where('agent','!=',2)
            ->sum('money');
        return response()->json([
            'total' => $total
        ]);
    }
    
    //添加子账号
    public function addSubAccount(Request $request)
    {
        $account = $request->input('account');
        $name = $request->input('name');
        $password = $request->input('password');
        $role = $request->input('role');

        if(strlen($account) < 6){
            return response()->json([
                'status'=>false,
                'msg'=>'帐号长度不能小于6位'
            ]);
        }

        if(SubAccount::where('account',$account)->count() > 0){
            return response()->json([
                'status'=>false,
                'msg'=>'该帐号已存在'
            ]);
        }

        //add google OTP Auth Code
        $ga = new \PHPGangsta_GoogleAuthenticator();
        $googleCode = $ga->createSecret();

        $subAccount = new SubAccount();
        $subAccount->account = $account;
        $subAccount->name = $name;
        $subAccount->password = Hash::make($password);
        $subAccount->role = $role;
        $subAccount->google_code = $googleCode;
        $insert = $subAccount->save();
        if($insert == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'添加成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }
    //修改子账号
    public function editSubAccount(Request $request)
    {
        $sub_id = $request->input('sub_id');
        $password = $request->input('password');
        $role = $request->input('role');
        $data = collect([
            'role'=>$role
        ]);
        if(!empty($password)){
            $data->put('password',Hash::make($password));
        };
        $update = SubAccount::where('sa_id',$sub_id)
            ->update($data->all());
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'ok'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法更新，请稍后重试'
            ]);
        }
    }
    //刷新google账号
    public function changeGoogleCode(Request $request)
    {
        $id = $request->get('id');
        $ga = new \PHPGangsta_GoogleAuthenticator();
        $secret = $ga->createSecret();
        $update = SubAccount::where('sa_id',$id)
            ->update([
               'google_code'=>$secret
            ]);
        if($update == 1){
            $find = SubAccount::find($id);
            $qrCodeUrl = $ga->getQRCodeGoogleUrl($find->account,$secret);
            return response()->json([
                'status'=>true,
                'msg'=>[
                    'qrCodeUrl'=>$qrCodeUrl,
                    'code'=>$secret
                ]
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法更新，请稍后重试'
            ]);
        }
    }
    //删除子账号
    public function delSubAccount(Request $request)
    {
        $id = $request->get('id');
        $nowSessionId = Session::get('account_id');
        if(isset($id)){
            $del = SubAccount::where('sa_id',$id)->delete();
            if($del == 1){
                if($id == $nowSessionId){
                    Session::flush();
                    return response()->json([
                        'status'=>true,
                        'msg'=>'logout'
                    ]);
                } else {
                    return response()->json([
                        'status'=>true,
                        'msg'=>'ok'
                    ]);
                }
            } else {
                return response()->json([
                    'status'=>false,
                    'msg'=>'删除失败，请稍后再试！'
                ]);
            }
        }
    }

    //修改会员层级
    public function editUserLevels(Request $request)
    {
        $id = $request->get('userid');
        $levels = $request->get('levels');


        $update = User::where('id',$id)
            ->update([
                'rechLevel'=>$levels
            ]);
        if($update == 1){
            return response()->json([
                'status'=>true
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg' => '更新失败！'
            ]);
        }
    }

    //修改充值会员层级
    public function editRechUserLevels(Request $request)
    {
        $rid = $request->get('rid');
        $levels = $request->get('levels');


        $update = Recharges::where('id',$rid)
            ->update([
                'levels'=>$levels
            ]);
        if($update == 1){
            return response()->json([
                'status'=>true
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg' => '更新失败！'
            ]);
        }
    }

    //修改提款会员层级
    public function editDrawingLevels(Request $request)
    {
        $rid = $request->get('rid');
        $levels = $request->get('levels');

        $update = Drawing::where('id',$rid)
            ->update([
                'levels'=>$levels
            ]);
        if($update == 1){
            return response()->json([
                'status'=>true
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg' => '更新失败！'
            ]);
        }
    }

    function randOrder($fix)
    {
        $order_id_main = date('YmdHis').rand(10000000,99999999);
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for($i=0; $i<$order_id_len; $i++){
            $order_id_sum += (int)(substr($order_id_main,$i,1));
        }
        $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
        return $fix.$order_id;
    }

    //
    public function selectAgentOdds(Request $request){
        $aParam = $request->post();
        $oddsLevel = Agent::where('a_id',$aParam['id'])->value('odds_level');
        $oddsLevel = empty($oddsLevel)?0:$oddsLevel;
        $aAgentOdds = AgentOddsSetting::where('level','>=',$oddsLevel)->orderBy('level','asc')->get();
        return response()->json([
            'aAgentOdds' => $aAgentOdds
        ]);
    }
}
