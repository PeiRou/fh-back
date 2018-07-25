<?php

namespace App\Http\Controllers\Back;

use App\Agent;
use App\Capital;
use App\GeneralAgent;
use App\Recharges;
use App\SubAccount;
use App\User;
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

        $generalAgent = new GeneralAgent();
        $generalAgent->account = $account;
        $generalAgent->name = $name;
        $generalAgent->usertype = '888';
        $generalAgent->password = Hash::make($password);
        $insert = $generalAgent->save();
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
        $gagent = $request->input('gagent');
        $account = $request->input('account');
        $name = $request->input('name');
        $password = $request->input('password');
        $editOdds = $request->input('editodds');

        $agent = new Agent();
        $agent->gagent_id = $gagent;
        $agent->account = $account;
        $agent->name = $name;
        $agent->password = Hash::make($password);
        $agent->editodds = $editOdds;
        $insert = $agent->save();
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
        $del = Agent::find($id)->delete();
        if($del == 1){
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
    //添加会员账号
    public function AddUser(Request $request)
    {
        $agent = $request->input('agent');
        $username = $request->input('username');
        $password = Hash::make($request->input('password'));
        $fullName = $request->input('fullName');

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
            $testFlag = 3;
        } else {
            $testFlag = 0;
        }

        $user = new User();
        $user->agent = $agent;
        $user->username = $username;
        $user->email = 0;
        $user->password = $password;
        $user->fullName = $fullName;
        $user->testFlag = $testFlag;
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
        $del = User::find($id)->delete();
        if($del == 1){
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
        Redis::select(2);
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

        if($agent == 2){
            $update = User::where('id',$uid)
                ->update([
                    'agent'=>$agent,
                    'testFlag' => 2
                ]);
        } else if($agent == 3){
            $update = User::where('id',$uid)
                ->update([
                    'agent'=>$agent,
                    'testFlag' => 1
                ]);
        } else {
            $update = User::where('id',$uid)
                ->update([
                    'agent'=>$agent,
                    'testFlag' => 0
                ]);
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
        $data = collect([
            'status'=>$request->input('status'),
            'bank_id'=>$request->input('bank'),
            'bank_num'=>$request->input('bank_num'),
            'bank_addr'=>$request->input('bank_addr'),
            'mobile'=>$request->input('mobile'),
            'qq'=>$request->input('qq'),
            'email'=>$request->input('email'),
            'wechat'=>$request->input('wechat'),
            'editodds'=>$request->input('editodds'),
            'content'=>$request->input('content'),
        ]);
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
        $uid = $request->input('uid');
        $money = $request->input('money');
        $content = $request->input('content');
        $getUserBalance = User::find($uid);
        Redis::select(5);
        $key = 'addMy';
        if(!Redis::exists($key.$uid)){
            Redis::setex($key.$uid,5,'on');
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
                $insert = $capital->save();
                if($insert == 1){
                    if($money > 0){
                        $recharges = new Recharges();
                        $recharges->userId = $uid;
                        $recharges->username = $getUserBalance->username;
                        $recharges->orderNum = payOrderNumber();
                        $recharges->payType = 'adminAddMoney';
                        $recharges->amount = $money;
                        $recharges->balance = $getUserBalance->money;
                        $recharges->shou_info = "后台加钱：".$content;
                        $recharges->msg = $content;

                        $recharges->status = 2;
                        $recharges->addMoney = 1;
                        $recharges->process_date = date('Y-m-d H:i:s');
                        $recharges->operation_id = Session::get('account_id');
                        $recharges->operation_account = Session::get('account');
                        $save = $recharges->save();
                        if($save == 1){
                            $updateBalance = User::where('id',$uid)
                                ->update([
                                    'money'=>$newBalance
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
                                'msg'=>'提交失败，请稍后再试！'
                            ]);
                        }
                    } else {
                        $insert = DB::table('drawing')->insert([
                            'user_id' => $uid,
                            'username' => $getUserBalance->username,
                            'created_at' => date('Y-m-d H:i:s'),
                            'balance' => (int)$getUserBalance->money+(int)$money,
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
                            'platform' => 1
                        ]);
                        if($insert == 1){
                            $updateBalance = User::where('id',$uid)
                                ->update([
                                    'money'=>$newBalance
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
                                'msg'=>'提交失败，请稍后再试！'
                            ]);
                        }
                    }

                } else {
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
                'msg'=>'同一个用户5秒内无法重复操作，请稍后再试！'
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
        $userid = $request->get('userid');
        $levels = $request->get('levels');

        $update = User::where('id',$userid)
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
}
