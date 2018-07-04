<?php

namespace App\Http\Controllers\Back\Ajax;

use App\Agent;
use App\Article;
use App\Banks;
use App\Games;
use App\GeneralAgent;
use App\Levels;
use App\PayOnline;
use App\PayType;
use App\Permissions;
use App\RechargeWay;
use App\Roles;
use App\SubAccount;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ModalController extends Controller
{
    //添加权限
    public function addPermission()
    {
        return view('back.modal.system.addPermission');
    }

    //添加角色
    public function addRole()
    {
        $permissions = Permissions::all();
        return view('back.modal.system.addRole')->with('permissions',$permissions);
    }

    //添加子账号
    public function addSubAccount()
    {
        $roles = Roles::all();
        return view('back.modal.member.addSubAccount')->with('roles',$roles);
    }
    //修改子账号
    public function editSubAccount($id)
    {
        $role = Roles::all();
        $subAccount = SubAccount::find($id);
        return view('back.modal.member.editSubAccount')->with('sub_id',$id)->with('roles',$role)->with('subAccount',$subAccount);
    }
    //子账号google验证码
    public function googleSubAccount($id)
    {
        $get = SubAccount::find($id);
        $account = $get->account;
        $subAccountId = $get->sa_id;
        $google_code = $get->google_code;
        $ga = new \PHPGangsta_GoogleAuthenticator();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($account,$google_code,null,['chs'=>'300x300']);
        return view('back.modal.member.subAccountGoogleCode',compact('qrCodeUrl','subAccountId','account','google_code'));
    }
    //添加文章
    public function addArticle()
    {
        return view('back.modal.system.addArticle');
    }
    //修改文章
    public function editArticle($id)
    {
        $article = Article::where('id',$id)->first();
        return view('back.modal.system.editArticle',compact('id','article'));
    }
    
    //游戏
    //游戏设置选项
    public function gameSetting($id)
    {
        $game = Games::find($id);
        return view('back.modal.game.gameSetting',compact('id','game'));
    }
    
    //添加总代理账号
    public function addGeneralAgent()
    {
        return view('back.modal.member.addGeneralAgent');
    }
    //修改总代理账号
    public function editGeneralAgent($id)
    {
        $getInfo = GeneralAgent::where('ga_id',$id)->first();
        return view('back.modal.member.editGeneralAgent')->with('id',$id)->with('info',$getInfo);
    }
    //添加代理
    public function addAgent()
    {
        $allGeneralAgent = GeneralAgent::all();
        return view('back.modal.member.addAgent')->with('info',$allGeneralAgent);
    }
    //修改代理
    public function editAgent($id)
    {
        $allAgent = Agent::find($id);
        $allBanks = Banks::where('status',1)->get();
        return view('back.modal.member.editAgent')->with('info',$allAgent)->with('bank',$allBanks);
    }
    //查看代理备注
    public function agentContent($id)
    {
        $allAgent = Agent::find($id);
        return $allAgent->content;
    }
    //代理详情资料
    public function agentInfo($id)
    {
        $allAgent = Agent::find($id);
        if($allAgent->bank_id){
            $bank = Banks::find($allAgent->bank_id);
            $bankName = $bank->name;
        } else {
            $bankName = '无';
        }
        return "<div class='agent-info'>
                <span>账号：".$allAgent->account."</span><br>
                <span>真实姓名：".$allAgent->truename."</span><br>
                <span>开户银行：".$bankName."</span><br>
                <span>银行卡号：".$allAgent->bank_num."</span><br>
                <span>支行地址：".$allAgent->bank_addr."</span><br>
                <span>手机号码：".$allAgent->mobile."</span><br>
                <span>微信：".$allAgent->wechat."</span><br>
                <span>Email：".$allAgent->email."</span><br>
                <span>QQ：".$allAgent->qq."</span><br>
                <span>备注：".$allAgent->content."</span><br>
               </div>";
    }
    //修改代理金额
    public function changeAgentMoney($id)
    {
        $allAgent = Agent::find($id);
        return view('back.modal.member.changeAgentMoney')->with('info',$allAgent);
    }
    //代理资金明细
    public function agentCapitalHistory($id)
    {
        return view('back.modal.member.agentCapitalHistory')->with('a_id',$id);
    }
    //添加新用户
    public function addUser()
    {
        return view('back.modal.member.addUser');
    }
    //更换会员代理
    public function userChangeAgent($id)
    {
        $user = User::where('id',$id)->first();
        $agent = Agent::where('a_id',$user->agent)->first();
        $agentAccount = $agent->account;
        $agentName = $agent->name;
        return view('back.modal.member.userChangeAgent')
            ->with('uid',$id)
            ->with('agentAccount',$agentAccount)
            ->with('agentName',$agentName)
            ->with('username',$user->username);
    }
    //更换会员姓名
    public function userChangeFullName($id)
    {
        $user = User::find($id);
        return view('back.modal.member.userChangeFullName',compact('user'));
    }
    //查看用户详情
    public function viewUserInfo($id)
    {
        $user = User::find($id);
        if($user->bank_id){
            $bank = Banks::find($user->bank_id);
            $bankName = $bank->name;
        } else {
            $bankName = '无';
        }
        return "<div class='agent-info'>
                <span>账号：".$user->username."</span><br>
                <span>真实姓名：".$user->fullName."</span><br>
                <span>开户银行：".$bankName."</span><br>
                <span>银行卡号：".$user->bank_num."</span><br>
                <span>支行地址：".$user->bank_addr."</span><br>
                <span>手机号码：".$user->mobile."</span><br>
                <span>微信：".$user->wechat."</span><br>
                <span>Email：".$user->email."</span><br>
                <span>QQ：".$user->qq."</span><br>
                <span>备注：".$user->content."</span><br>
               </div>";
    }
    //编辑用户资料
    public function editUserInfo($id)
    {
        $user = User::find($id);
        $allBanks = Banks::where('status',1)->get();
        return view('back.modal.member.userEditInfo',compact('user','allBanks'));
    }
    //查看会员备注
    public function viewUserContent($id)
    {
        $user = User::find($id);
        return $user->content;
    }
    //修改用户余额
    public function changeUserMoney($id)
    {
        $user = User::find($id);
        return view('back.modal.member.changeUserMoney',compact('user'));
    }
    //查看用户资金明细
    public function userCapitalHistory($id)
    {
        return view('back.modal.member.userCapitalHistory')->with('uid',$id);
    }

    //添加公告
    public function addNotice()
    {
        $levels = Levels::all();
        return view('back.modal.notice.addNotice')->with('levels',$levels);
    }
    //修改用户层级
    public function editUserLevels($uid,$nowLevels)
    {
        $user = User::where('id',$uid)->first();
        $levels = Levels::where('value',$nowLevels)->first();
        $levelsData = Levels::all();
        return view('back.modal.member.editUserLevels',compact('user','levels','levelsData'));
    }
    
    //添加银行
    public function addBank()
    {
        return view('back.modal.pay.addBank');
    }
    //添加支付层级
    public function addLevel()
    {
        return view('back.modal.pay.addLevel');
    }
    //修改支付层级
    public function editLevel($id)
    {
        $level = Levels::where('id',$id)->first();
        return view('back.modal.pay.editLevel')->with('id',$id)->with('level',$level);
    }
    //支付层级全部转移
    public function allExchangeLevel($id)
    {
        $levelInfo = Levels::where('id',$id)->first();
        $countUser = User::where('rechLevel',$levelInfo->value)->count();
        $allLevel = Levels::all();
        return view('back.modal.pay.allExchangeLevel')->with('id',$id)->with('countUser',$countUser)->with('allLevels',$allLevel);
    }
    //添加在线支付配置
    public function addPayOnline()
    {
        $payType = PayType::where('status',1)->get();
        $levels = Levels::all();
        return view('back.modal.pay.addPayOnline')->with('payType',$payType)->with('levels',$levels);
    }
    //修改在线支付配置
    public function editPayOnline($id = "")
    {
        $payType = PayType::all();
        $levels = Levels::all();
        $getPayOnlineData = PayOnline::where('id',$id)->first();
        return view('back.modal.pay.editPayOnline')->with('payType',$payType)->with('levels',$levels)->with('id',$id)->with('payOnline',$getPayOnlineData);
    }
    //修改银行支付配置
    public function editPayBank($id = "")
    {
        $banks = Banks::where('status',1)->get();
        $levels = Levels::all();
        $payBank = PayOnline::where('id',$id)->first();
        return view('back.modal.pay.editPayBank',compact('banks','levels','payBank','id'));
    }
    //添加充值方式
    public function addRechargeWay()
    {
        return view('back.modal.pay.addRechargeWay');
    }
    //修改充值方式
    public function editRechargeWay($id)
    {
        $info = RechargeWay::where('id',$id)->first();
        return view('back.modal.pay.editRechargeWay')->with('id',$id)->with('info',$info);
    }
    //添加银行支付配置
    public function addPayBank()
    {
        $banks = Banks::where('status',1)->get();
        $levels = Levels::all();
        return view('back.modal.pay.addPayBank',compact('banks','levels'));
    }
    //添加支付宝配置
    public function addPayAlipay()
    {
        $levels = Levels::all();
        return view('back.modal.pay.addPayAlipay',compact('levels'));
    }
    //修改支付宝配置
    public function editPayAlipay($id = '')
    {
        $levels = Levels::all();
        $payAlipay = PayOnline::where('id',$id)->first();
        return view('back.modal.pay.editPayAlipay',compact('levels','id','payAlipay'));
    }
    //添加微信配置
    public function addPayWechat()
    {
        $levels = Levels::all();
        return view('back.modal.pay.addPayWechat',compact('levels'));
    }
    //修改微信配置
    public function editPayWechat($id = '')
    {
        $levels = Levels::all();
        $payWechat = PayOnline::where('id',$id)->first();
        return view('back.modal.pay.editPayWechat',compact('levels','id','payWechat'));
    }
    //添加财付通配置
    public function addPayCft()
    {
        $levels = Levels::all();
        return view('back.modal.pay.addPayCft',compact('levels'));
    }
    //修改财付通
    public function editPayCft($id = '')
    {
        $levels = Levels::all();
        $payCft = PayOnline::where('id',$id)->first();
        return view('back.modal.pay.editPayCft',compact('levels','id','payCft'));
    }
    //充值驳回
    public function rechargeError($id = '')
    {
        return view('back.modal.pay.rechargeError',compact('id'));
    }
    //提款驳回
    public function drawingError($id = '')
    {
        return view('back.modal.pay.drawingError',compact('id'));
    }
    //提款记录 会员48小时详情
    public function user48hoursInfo($uid = '')
    {
        if($uid){
            $user = DB::table('users')->where('id',$uid)->first();
            $userLastPay = DB::table('recharges')->select('amount')->where('userId',$uid)->orderBy('created_at','desc')->first();
            $hours48SQL = 'SELECT sum(b.bet_money) as BETMONEY FROM bet b WHERE b.created_at > DATE_SUB(NOW(), INTERVAL 48 HOUR)';
            $hours48Bet = DB::statement($hours48SQL);

            $table = '<table class="ui small celled striped table" cellspacing="0" width="100%">
                    <tbody>
                        <tr class="firstRow">
                            <td valign="top" style="word-break: break-all;">账号：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->username.'</td>
                            <td valign="top" style="word-break: break-all;">名称：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->fullName.'</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">当前登录时间：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->updated_at.'</td>
                            <td valign="top" style="word-break: break-all;">当前IP信息：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->login_ip_info.'</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">账户余额：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->money.'</td>
                            <td valign="top" style="word-break: break-all;">最后一笔充值金额：</td>
                            <td valign="top" style="word-break: break-all;">'.$userLastPay->amount.'</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">充值次数：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->PayTimes.'</td>
                            <td valign="top" style="word-break: break-all;">充值金额：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->saveMoneyCount.'</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">提现次数：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->DrawTimes.'</td>
                            <td valign="top" style="word-break: break-all;">提现金额：</td>
                            <td valign="top" style="word-break: break-all;">'.$user->drawMoneyCount.'</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">下注总金额：</td>
                            <td valign="top" style="word-break: break-all;">'.$hours48Bet['BETMONEY'].'</td>
                            <td valign="top" style="word-break: break-all;">输赢总金额：</td>
                            <td valign="top" style="word-break: break-all;"></td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">退水总金额：</td>
                            <td valign="top" style="word-break: break-all;">0</td>
                            <td valign="top" style="word-break: break-all;">未结算金额：</td>
                            <td valign="top" style="word-break: break-all;"></td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">活动金额：</td>
                            <td valign="top" style="word-break: break-all;">0</td>
                            <td valign="top" style="word-break: break-all;">红包金额：</td>
                            <td valign="top" style="word-break: break-all;">0</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">后台加钱：</td>
                            <td valign="top" style="word-break: break-all;">0</td>
                            <td valign="top" style="word-break: break-all;">后台扣钱：</td>
                            <td valign="top" style="word-break: break-all;">0</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;" rowspan="1" colspan="4">备注：</td>
                        </tr>
                        <tr>
                            <td valign="top" rowspan="1" colspan="4" style="word-break: break-all;">'.$user->content.'</td>
                        </tr>
                    </tbody>
                </table>';
            return $table;
        } else {
            return '加载错误！';
        }
    }
}
