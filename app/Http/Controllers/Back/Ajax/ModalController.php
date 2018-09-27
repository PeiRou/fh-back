<?php

namespace App\Http\Controllers\Back\Ajax;

use App\Activity;
use App\ActivityCondition;
use App\ActivityPrize;
use App\Agent;
use App\Article;
use App\Banks;
use App\Capital;
use App\Feedback;
use App\FeedbackMessage;
use App\Games;
use App\GeneralAgent;
use App\Levels;
use App\Notices;
use App\PayOnline;
use App\PayType;
use App\Permissions;
use App\PermissionsAuth;
use App\PermissionsType;
use App\PromotionConfig;
use App\PromotionReport;
use App\Recharges;
use App\RechargeWay;
use App\Roles;
use App\SubAccount;
use App\User;
use App\Whitelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ModalController extends Controller
{
    //添加权限
    public function addPermission()
    {
        $aPermissionsAuths = PermissionsAuth::getPermissionLowerLevelList();
        return view('back.modal.system.addPermission',compact('aPermissionsAuths'));
    }

    //修改权限
    public function editPermission($id)
    {
        $aPermissionsAuths = PermissionsAuth::getPermissionLowerLevelList();
        $aPermissions = Permissions::getPermissionOne($id);
        return view('back.modal.system.editPermission',compact('aPermissionsAuths','aPermissions'));
    }

    //添加权限控制
    public function addPermissionAuth(){
        $aPermissionsAuths = PermissionsAuth::getPermissionLowerLevelList();
        $aPermissionsTypes = PermissionsType::getPermissionType();

        return view('back.modal.system.addPermissionAuth',compact('aPermissionsAuths','aPermissionsTypes'));
    }

    //修改权限控制
    public function editPermissionAuth($id){
        $aPermissionsAuths = PermissionsAuth::getPermissionLowerLevelList();
        $aPermissionsTypes = PermissionsType::getPermissionType();
        $oPermissionsAuth = PermissionsAuth::getPermissionOne($id);

        return view('back.modal.system.editPermissionAuth',compact('aPermissionsAuths','aPermissionsTypes','oPermissionsAuth'));
    }

    //添加ip白名单
    public function addWhitelist(){
        return view('back.modal.system.addWhitelist');
    }

    //修改ip白名单
    public function editWhitelist($id){
        $aWhiteLists = Whitelist::where('id','=',$id)->first();
        return view('back.modal.system.editWhitelist',compact('aWhiteLists'));
    }

    //查看意见反馈
    public function viewFeedback($id){
        $aMessage = FeedbackMessage::getFeedbackMessageList($id);
        $iFeedback = Feedback::getFeedbackInfoOne($id);
        return view('back.modal.system.viewFeedback',compact('aMessage','iFeedback'));
    }

    //添加角色
    public function addRole()
    {
        $permissions = Permissions::all();
        return view('back.modal.system.addRole')->with('permissions',$permissions);
    }

    //修改角色
    public function editRole($id)
    {
        $permissions = Permissions::all();
        $aRole = Roles::getRoleOne($id);

        return view('back.modal.system.editRole',compact('permissions','aRole'));
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
    //杀率设置
    public function killSetting($id)
    {
        $game = DB::table('excel_base')->select('game.game_name','excel_base.kill_rate')->leftjoin('game','excel_base.game_id','=','game.game_id')->where('excel_base_idx',$id)->first();
        return view('back.modal.game.killSetting',compact('id','game'));
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
        $aRechargesType = Recharges::$rechargesType;
        return view('back.modal.member.changeUserMoney',compact('user','aRechargesType'));
    }
    //查看用户资金明细
    public function userCapitalHistory($id)
    {
        $games = Games::getGameOption();
        $capitalTimes = Capital::$playTypeOption;
        $aRechargesType = Recharges::$rechargesType;
        return view('back.modal.member.userCapitalHistory')->with('uid',$id)->with('games',$games)->with('capitalTimes',$capitalTimes)->with('aRechargesType',$aRechargesType);
    }

    //添加公告
    public function addNotice()
    {
        $levels = Levels::all();
        return view('back.modal.notice.addNotice')->with('levels',$levels);
    }

    //公告管理-修改公告
    public function editNotice($id){
        $levels = Levels::all();
        $iNotice = Notices::getNoticesInfoOne($id);
        $iNotice->userLevel = empty($iNotice->userLevel) ? [] : explode(',',$iNotice->userLevel);
        $aStatus = Notices::$noticesStatus;
        return view('back.modal.notice.editNotice')->with('levels',$levels)->with('iNotice',$iNotice)->with('aStatus',$aStatus);
    }
    
    //添加消息
    public function addSendMessage()
    {
        $levels = Levels::all();
        return view('back.modal.notice.addSendMessage')->with('levels',$levels);
    }

    //修改用户层级
    public function editUserLevels($uid,$nowLevels,$rid)
    {
        $user = User::where('id',$uid)->first();
        $levels = Levels::where('value',$nowLevels)->first();
        $levelsData = Levels::all();
        return view('back.modal.member.editUserLevels',compact('user','levels','levelsData','rid'));
    }

    //修改用户层级
    public function editDrawingLevels($uid,$nowLevels,$rid)
    {
        $user = User::where('id',$uid)->first();
        $levels = Levels::where('value',$nowLevels)->first();
        $levelsData = Levels::all();
        return view('back.modal.member.editDrawingLevels',compact('user','levels','levelsData','rid'));
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
        $getPayOnlineData->levels = explode(",",$getPayOnlineData->levels);
        return view('back.modal.pay.editPayOnline')->with('payType',$payType)->with('levels',$levels)->with('id',$id)->with('payOnline',$getPayOnlineData);
    }
    //修改银行支付配置
    public function editPayBank($id = "")
    {
        $banks = Banks::where('status',1)->get();
        $levels = Levels::all();
        $payBank = PayOnline::where('id',$id)->first();
        $payBank->levels = explode(",",$payBank->levels);
        return view('back.modal.pay.editPayBank',compact('banks','levels','payBank','id'));
    }
    //添加充值方式
    public function addRechargeWay()
    {
        return view('back.modal.pay.addRechargeWay');
    }
    //条件转移-模板
    public function rechargeConditionalTransfer($id){
        //获取层级
        $aLevel = Levels::getLevelInfoList();
        $iLevelInfo = Levels::where('id','=',$id)->first();
        return view('back.modal.pay.rechargeConditionalTransfer',compact('aLevel','iLevelInfo'));
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
        $payAlipay->levels = explode(",",$payAlipay->levels);
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
        $payWechat->levels = explode(",",$payWechat->levels);
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
        $payCft->levels = explode(",",$payCft->levels);
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
        if ($uid) {
            $user = DB::table('users')->where('id', $uid)->first();
            $userLastPay = DB::table('recharges')->select('amount')->where('userId', $uid)->orderBy('created_at', 'desc')->first();
            $hours48SQL = "SELECT sum(b.bet_money) as BETMONEY FROM bet b WHERE b.created_at > DATE_SUB(NOW(), INTERVAL 48 HOUR) AND user_id = {$uid}";
            $hours48Bet = DB::table('bet')
                ->select(DB::raw('sum(bet_money) as sum , sum(bunko) as sumBunko, sum(case WHEN bunko = 0 then bet_money else 0 end) as noBunko'))
                ->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 48 HOUR)')
                ->where('user_id', $uid)
                ->first();

            $table = '<table class="ui small celled striped table" cellspacing="0" width="100%">
                    <tbody>
                        <tr class="firstRow">
                            <td valign="top" style="word-break: break-all;">账号：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->username . '</td>
                            <td valign="top" style="word-break: break-all;">名称：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->fullName . '</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">当前登录时间：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->updated_at . '</td>
                            <td valign="top" style="word-break: break-all;">当前IP信息：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->login_ip_info . '</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">账户余额：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->money . '</td>
                            <td valign="top" style="word-break: break-all;">最后一笔充值金额：</td>
                            <td valign="top" style="word-break: break-all;">' . $userLastPay->amount . '</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">充值次数：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->PayTimes . '</td>
                            <td valign="top" style="word-break: break-all;">充值金额：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->saveMoneyCount . '</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">提现次数：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->DrawTimes . '</td>
                            <td valign="top" style="word-break: break-all;">提现金额：</td>
                            <td valign="top" style="word-break: break-all;">' . $user->drawMoneyCount . '</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">下注总金额：</td>
                            <td valign="top" style="word-break: break-all;">' . $hours48Bet->sum . '</td>
                            <td valign="top" style="word-break: break-all;">输赢总金额：</td>
                            <td valign="top" style="word-break: break-all;">' . $hours48Bet->sumBunko . '</td>
                        </tr>
                        <tr>
                            <td valign="top" style="word-break: break-all;">退水总金额：</td>
                            <td valign="top" style="word-break: break-all;">0</td>
                            <td valign="top" style="word-break: break-all;">未结算金额：</td>
                            <td valign="top" style="word-break: break-all;">' . $hours48Bet->noBunko . '</td>
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
                            <td valign="top" rowspan="1" colspan="4" style="word-break: break-all;">' . $user->content . '</td>
                        </tr>
                    </tbody>
                </table>';
            return $table;
        } else {
            return '加载错误！';
        }
    }

    //历史开奖
    //重庆时时彩 - 手动开奖
    public function openCqssc($id = '')
    {
        $cqssc = DB::table('game_cqssc')->where('id',$id)->first();
        return view('back.modal.open.openCQSSC',compact('cqssc'));
    }
    //秒速时时彩 - 手动开奖
    public function openMsssc($id = '')
    {
        $cqssc = DB::table('game_msssc')->where('id',$id)->first();
        return view('back.modal.open.openMSSSC',compact('cqssc'));
    }
    //北京赛车 - 手动开奖
    public function openBjpk10($id = '')
    {
        $bjpk10 = DB::table('game_bjpk10')->where('id',$id)->first();
        return view('back.modal.open.openBJPK10',compact('bjpk10'));
    }
    //北京快乐8 - 手动开奖
    public function openBjkl8($id = '')
    {
        $bjkl8 = DB::table('game_bjkl8')->where('id',$id)->first();
        return view('back.modal.open.openBJKL8',compact('bjkl8'));
    }
    //秒速赛车 - 手动开奖
    public function openMssc($id = ''){
        $mssc = DB::table('game_mssc')->where('id',$id)->first();
        return view('back.modal.open.openMSSC',compact('mssc'));
    }
    //秒速飞艇 - 手动开奖
    public function openMsft($id = ''){
        $mssc = DB::table('game_msft')->where('id',$id)->first();
        return view('back.modal.open.openMSFT',compact('mssc'));
    }
    //跑马 - 手动开奖
    public function openPaoma($id = ''){
        $mssc = DB::table('game_paoma')->where('id',$id)->first();
        return view('back.modal.open.openPAOMA',compact('mssc'));
    }
    //秒速快三 - 手动开奖
    public function openMsjsk3($id = ''){
        $k3 = DB::table('game_msjsk3')->where('id',$id)->first();
        $type = 'msjsk3';
        return view('back.modal.open.openK3',compact('k3','type'));
    }
    //江苏快三 - 手动开奖
    public function openJsk3($id = ''){
        $k3 = DB::table('game_jsk3')->where('id',$id)->first();
        $type = 'jsk3';
        return view('back.modal.open.openK3',compact('k3','type'));
    }
    //安徽快三 - 手动开奖
    public function openAhk3($id = ''){
        $k3 = DB::table('game_ahk3')->where('id',$id)->first();
        $type = 'ahk3';
        return view('back.modal.open.openK3',compact('k3','type'));
    }
    //吉林快三 - 手动开奖
    public function openJlk3($id = ''){
        $k3 = DB::table('game_jlk3')->where('id',$id)->first();
        $type = 'jlk3';
        return view('back.modal.open.openK3',compact('k3','type'));
    }
    //湖北快三 - 手动开奖
    public function openHbk3($id = ''){
        $k3 = DB::table('game_hbk3')->where('id',$id)->first();
        $type = 'hbk3';
        return view('back.modal.open.openK3',compact('k3','type'));
    }
    //广西快三 - 手动开奖
    public function openGxk3($id = ''){
        $k3 = DB::table('game_gxk3')->where('id',$id)->first();
        $type = 'gxk3';
        return view('back.modal.open.openK3',compact('k3','type'));
    }
    //添加六合彩
    public function addLhcNewIssue()
    {
        $endTime = date('Y-m-d 21:30:00');
        $openTime = date('Y-m-d 21:35:00');
        return view('back.modal.open.addLhcNewIssue',compact('endTime','openTime'));
    }
    //添加幸运六合彩
    public function addXylhcNewIssue(){
        $endTime = date('Y-m-d 21:30:00');
        $openTime = date('Y-m-d 21:35:00');
        return view('back.modal.open.addXylhcNewIssue',compact('endTime','openTime'));
    }
    //修改六合彩
    public function editLhcNewIssue($id = '')
    {
        $lhc = DB::table('game_lhc')->where('id',$id)->first();
        return view('back.modal.open.editLhcNewIssue',compact('lhc'));
    }
    //修改幸运六合彩
    public function editXylhcNewIssue($id = '')
    {
        $lhc = DB::table('game_xylhc')->where('id',$id)->first();
        return view('back.modal.open.editXylhcNewIssue',compact('lhc'));
    }
    //六合彩手动开奖
    public function openLhc($id = '')
    {
        $lhc = DB::table('game_lhc')->where('id',$id)->first();
        return view('back.modal.open.openLHC',compact('lhc'));
    }
    //幸运六合彩手动开奖
    public function openXylhc($id = '')
    {
        $lhc = DB::table('game_xylhc')->where('id',$id)->first();
        return view('back.modal.open.openXYLHC',compact('lhc'));
    }
    //六合彩重新开奖
    public function reOpenLhc($id = '')
    {
        $lhc = DB::table('game_lhc')->where('id',$id)->first();
        return view('back.modal.open.reOpenLHC',compact('lhc'));
    }
    //幸运六合彩重新开奖
    public function reOpenXylhc($id = '')
    {
        $lhc = DB::table('game_xylhc')->where('id',$id)->first();
        return view('back.modal.open.reOpenXYLHC',compact('lhc'));
    }

    //修改代理结算报表-模板
    public function editAgentSettleReport($id){
        $settleInfo = DB::table('agent_report')->where('agent_report_idx','=',$id)->first();
        return view('back.modal.agentSettle.editAgentSettleReport',compact('settleInfo'));
    }

    //代理结算审核
    public function editAgentSettleReview($id){
        $settleInfo = DB::table('agent_report_review')->where('agent_report_idx','=',$id)->first();
        return view('back.modal.agentSettle.editAgentSettleReview',compact('settleInfo'));
    }

    //新增活动-模板
    public function addActivityList(){
        $activityType = Activity::$activityType;
        return view('back.modal.activity.addActivityList',compact('activityType'));
    }

    //修改活动-模板
    public function editActivityList($id){
        $activityType = Activity::$activityType;
        $activityInfo = Activity::where('id','=',$id)->first();
        return view('back.modal.activity.editActivityList',compact('activityType','activityInfo'));
    }

    //增加活动条件-模板
    public function addActivityCondition(){
        $activityLists = Activity::select('id','name')->orderBy('sort','asc')->get();
        $prizeLists = ActivityPrize::select('id','name','quantity')->get();
        return view('back.modal.activity.addActivityCondition',compact('activityLists','prizeLists'));
    }

    //修改活动条件-模板
    public function editActivityCondition($id){
        $activityLists = Activity::select('id','name')->orderBy('sort','asc')->get();
        $prizeLists = ActivityPrize::select('id','name','quantity')->get();
        $conditionInfo = ActivityCondition::getDetailInfoOne($id);
        return view('back.modal.activity.editActivityCondition',compact('activityLists','prizeLists','conditionInfo'));
    }

    //增加奖品配置-模板
    public function addActivityPrize(){
        $prizeType = ActivityPrize::$prizeType;
        return view('back.modal.activity.addActivityPrize',compact('prizeType'));
    }

    //修改奖品配置-模板
    public function editActivityPrize($id){
        $prizeType = ActivityPrize::$prizeType;
        $prizeInfo = ActivityPrize::where('id','=',$id)->first();
        return view('back.modal.activity.editActivityPrize',compact('prizeType','prizeInfo'));
    }

    //增加推广配置-模板
    public function addPromotionConfig(){
        return view('back.modal.promotion.addPromotionConfig');
    }

    //修改推广配置-模板
    public function editPromotionConfig($id){
        $iPromotionInfo = PromotionConfig::getPromotionConfigInfoOne($id);
        return view('back.modal.promotion.editPromotionConfig',compact('iPromotionInfo'));
    }

    //修改推广就算报表-模板
    public function editPromotionReport($id){
        $iPromotionInfo = PromotionReport::promotionInfoOne($id);
        return view('back.modal.promotion.editPromotionReport',compact('iPromotionInfo'));
    }

    //会员回访用户-模板
    public function returnVisit(){
        return view('back.modal.member.returnVisit');
    }

    //导出用户数据-模板
    public function exportUser(){
        return view('back.modal.member.exportUser');
    }

    //操作报表添加-模板
    public function addStatistics(){
        return view('back.modal.report.addStatistics');
    }
}
