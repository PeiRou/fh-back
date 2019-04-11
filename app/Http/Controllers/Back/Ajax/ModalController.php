<?php

namespace App\Http\Controllers\Back\Ajax;

use App\Activity;
use App\ActivityCondition;
use App\ActivityPrize;
use App\Agent;
use App\AgentOdds;
use App\AgentOddsSetting;
use App\Article;
use App\Banks;
use App\Blacklist;
use App\Capital;
use App\CapitalAgent;
use App\Drawing;
use App\Feedback;
use App\FeedbackMessage;
use App\GameOddsCategory;
use App\Games;
use App\GeneralAgent;
use App\Http\Controllers\Obtain\BaseController;
use App\Http\Controllers\Obtain\SendController;
use App\Levels;
use App\Notices;
use App\Offer;
use App\PayOnline;
use App\PayOnlineNew;
use App\PayType;
use App\PayTypeNew;
use App\Permissions;
use App\PermissionsAuth;
use App\PermissionsType;
use App\PromotionConfig;
use App\PromotionReport;
use App\Recharges;
use App\RechargeWay;
use App\RechType;
use App\Roles;
use App\SubAccount;
use App\SystemSetting;
use App\User;
use App\Whitelist;
use App\GamesApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModalController extends Controller
{
    //弹窗
    public function alert(Request $request)
    {
        $msg[0] = $request->get('content');
        $msg[1] = $request->get('value');
        $msg[2] = $request->get('url');
        $msg[3] = $request->get('type');
        return view('back.modal.notice.alert',compact('msg'));
    }
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
    //添加黑名单
    public function addBlacklist(Request $request){
        $data = [];
        if(isset($request->id))
            $data['info'] = Blacklist::find($request->id);
        return view('back.modal.system.addBlacklist', $data);
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
//        $ga = new \PHPGangsta_GoogleAuthenticator();
//        $qrCodeUrl = $ga->getQRCodeGoogleUrl($account,$google_code,null,['chs'=>'300x300']);
        $qrCodeUrl = urlencode('otpauth://totp/'.$account.'?secret='.$google_code.'');
        return view('back.modal.member.subAccountGoogleCode',compact('qrCodeUrl','subAccountId','account','google_code'));
    }
    //会员对帐详情
    public function reconciliationInfo($id)
    {
        $strarray = explode("|",$id);
        $daytstrot = strtotime(date($strarray[0]));

        $totalreportsql = 'select data from totalreport where daytstrot = \''.$daytstrot.'\'';
        $totalreport =  DB::select($totalreportsql);
        if (!empty($totalreport)){
            $data = $totalreport[0]->data;
            $data = unserialize($data);
            $data = $data[$strarray[0]][$strarray[1]];
            $str= 0;

            foreach ($data as $k=>$v){
                $str += $v->amount;
            }
            foreach ($data as $k=>$v){
                $v->totle = sprintf('%0.2f',$str);
            }
            $phonyfitloss ='0.00';
            if(isset($strarray[3]) && $strarray[1]=="todayprofitlossitem"){ //for回圈不含未结算   为平帐用的条件--（平帐总数-for回圈不含未结算的总数）
                $profitlosstal= 0;
                $todayprofitlossitem=$data;
                foreach ($todayprofitlossitem as $k=>$v){
                    if($v ->rechname == '充值') {
                        $profitlosstal += $v ->amount;
                    }
                    if($v ->rechname == '返利/手续费') {
                        $profitlosstal += $v ->amount;
                    }
                    if($v ->rechname == '活动') {
                        $profitlosstal += $v ->amount;
                    }
                    if($v ->rechname == '抢到红包') {
                        $profitlosstal += $v ->amount;
                    }
                    if($v ->rechname == '棋牌上分') {
                        $profitlosstal -= $v ->amount;
                    }
                    if($v ->rechname == '棋牌下分') {
                        $profitlosstal += $v ->amount;
                    }
                    if($v ->rechname == '会员输赢（含退水）') {
                        $profitlosstal += $v ->amount;
                    }
                    if($v ->rechname == '未结算') {
                        $profitlosstal -= $v ->amount;
                    }
                    //提款
                    if($v ->rechname == '自动出款') {
                        $profitlosstal -= $v ->amount;
                    }
                    if($v ->rechname == '手动出款') {
                        $profitlosstal -= $v ->amount;
                    }
                    if($v ->rechname == '后台扣钱') {
                        $profitlosstal -= $v ->amount;
                    }
                }
                $phonyfitloss = sprintf('%0.3f',$profitlosstal - $strarray[3]);
            }
        }else{
            $data ='';
        }
        if(!empty($data)){
            $str = "<div class='agent-info'><table id=\"memberReconciliationTable\" class=\"ui small table\" cellspacing=\"0\" width=\"100%\">
            <tbody><tr><td>";
            foreach($data as $k=>$v){
                $amount = isset($v->amount)?$v->amount:'0';
                $giftamount = isset($v->giftamount)?'赠送'.$v->giftamount:'';
                /*if($v->rechname == '未结算'){ //为平帐用的条件
                    $str .="<div id=\"v\">$v->rechname</br><p>$giftamount   总计$phonyfitloss</p></div>";
                }else{
                    $str .="<div id=\"v\">$v->rechname</br><p>$giftamount   总计$amount</p></div>";
                }*/
                $str .="<div id=\"v\">$v->rechname</br><p>$giftamount   总计$amount</p></div>";
            }
            if(isset($strarray[3]) && $strarray[1]=="todayprofitlossitem"){
                $str .="<div id=\"v\">坏帐</br><p>总计$phonyfitloss</p></div>";
            }
            $str .="</td></tr></tbody>
            </table></div>";
            return $str;
        }
        return '';
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
        $statusArr = array(
            '0.01'=>'1%',
            '0.02'=>'2%',
            '0.03'=>'3%',
            '0.04'=>'4%',
            '0.05'=>'5%',
        );
        return view('back.modal.game.killSetting',compact('id','game','statusArr'));
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
    public function addAgent($agentId)
    {
        $allGeneralAgent = GeneralAgent::all();
        $aAgentOdds = [];
        $iAgent = [];
        if(!empty($agentId)) {
            $oddsLevel = Agent::select('agent_odds_setting.*','game_odds_category.title')->where('agent.a_id',$agentId)
                ->join('agent_odds','agent_odds.agent_id','=','agent.a_id')
                ->join('game_odds_category','game_odds_category.id','=','agent_odds.odds_category_id')
                ->join('agent_odds_setting','agent_odds_setting.id','=','agent_odds.odds_id')->get();
            foreach ($oddsLevel as $key => $value){
                $aAgentOdds[$key] = $value;
                $aAgentOdds[$key]->info = AgentOddsSetting::where('odds_category_id','=',$value->odds_category_id)->where('odds','>=',$value->odds)->orderBy('odds','asc')->get();
            }
            $iAgent = Agent::find($agentId);
        }else{
            $oddsLevel = GameOddsCategory::select('id as odds_category_id','title')->get();
            foreach ($oddsLevel as $key => $value){
                $aAgentOdds[$key] = $value;
                $aAgentOdds[$key]->info = AgentOddsSetting::where('odds_category_id','=',$value->odds_category_id)->orderBy('odds','asc')->get();
            }
        }
        $agentModelStatus = Agent::$agentModelStatus;
        return view('back.modal.member.addAgent')
            ->with('info',$allGeneralAgent)
            ->with('agentId',$agentId)
            ->with('aAgentOdds',$aAgentOdds)
            ->with('iAgent',$iAgent)
            ->with('agentModelStatus',$agentModelStatus);
    }
    //修改代理盘口
    public function changeAgentOdds($agentId){
        $aAgentOdds = [];
        $oddsLevel = GameOddsCategory::select('id as odds_category_id','title')->get();
        foreach ($oddsLevel as $key => $value){
            $aAgentOdds[$key] = $value;
            $aAgentOdds[$key]->info = AgentOddsSetting::where('odds_category_id','=',$value->odds_category_id)->orderBy('odds','asc')->get();
        }
        $aOdds = AgentOdds::where('agent_id',$agentId)->get();
        $aOddsArray = [];
        foreach ($aOdds as $iOdds){
            $aOddsArray[$iOdds->odds_category_id] = $iOdds->odds_id;
        }
        return view('back.modal.member.changeAgentOdds',compact('aAgentOdds','agentId','aOddsArray'));
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
        $aData = CapitalAgent::$playTypeOption;
        return view('back.modal.member.agentCapitalHistory')->with('a_id',$id)->with('aData',$aData);
    }
    //代理返水明细
    public function agentBackwater($id)
    {
        return view('back.modal.member.agentBackwater')->with('a_id',$id);
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
        return "<div class='agent-info' style='overflow-wrap: break-word' >
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
        $levelsData = Levels::all();
        return view('back.modal.member.userEditInfo',compact('user','allBanks','levelsData'));
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
        $aContentsql = 'SELECT msg AS \'content\' FROM recharges WHERE payType = \'adminAddMoney\' AND admin_add_money = 1 GROUP BY admin_add_money,msg';
        $aContent = DB::select($aContentsql);
        return view('back.modal.member.changeUserMoney',compact('user','aRechargesType','aContent'));
    }
    //批量修改用户余额
    public function addMoneyAllUser(){
        $levelArr = Levels::select('name','value')->where('status',1)->get();
        $aRechargesType = Recharges::$rechargesType;
        return view('back.modal.member.addMoneyAllUser',compact('aRechargesType','levelArr'));
    }
    // 下拉菜单获取加钱类型
    public function userMoneyType($type = ""){
        if($type){
            $aContentsql = 'SELECT msg  FROM recharges WHERE payType = \'adminAddMoney\' AND admin_add_money = '.$type.' GROUP BY admin_add_money,msg';
            $aContent = DB::select($aContentsql);
            return response()->json($aContent);
        }
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
    public function editUserLevels($uid,$nowLevels)
    {
        $user = User::where('id',$uid)->first();
        $levels = Levels::where('value',$nowLevels)->first();
        $levelsData = Levels::all();
        return view('back.modal.member.editUserLevels',compact('user','levels','levelsData'));
    }

    //修改充值用户层级
    public function editRechUserLevels($uid,$nowLevels,$rid=0)
    {
        $user = User::where('id',$uid)->first();
        $levels = Levels::where('value',$nowLevels)->first();
        $levelsData = Levels::all();
        return view('back.modal.member.editRechUserLevels',compact('user','levels','levelsData','rid'));
    }

    //修改提款用户层级
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
    // 支付前端修改
    public function editRechType($id){
        $remark = RechType::where('id',$id)->value('remark');
        return view('back.modal.pay.editRechType')->with('id',$id)->with('remark',$remark);
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
    //自动提款驳回
    public function drawingErrorAuto($id = '')
    {
        return view('back.modal.pay.drawingErrorAuto',compact('id'));
    }
    //提款记录 会员48小时详情
    public function user48hoursInfo(Request $request, $uid = '')
    {
        //修改為這條記錄之前24小時的
        if(isset($request->drawing_id))
            $dTime = Drawing::where('id', $request->drawing_id)->value('created_at');
        if ($uid) {
            $user = DB::table('users')->where('id', $uid)->first();
            $userLastPay = DB::table('recharges')->select('amount')->where('userId', $uid)->where('status',2)->orderBy('id', 'desc')->first();
            $hours48SQL = "SELECT sum(b.bet_money) as BETMONEY FROM bet b WHERE b.created_at > DATE_SUB('".($dTime ?? 'NOW()')."', INTERVAL 48 HOUR) AND user_id = {$uid}";
            $hours48Bet = DB::table('bet')
                ->select(DB::raw('sum(bet_money) as sum , SUM(CASE WHEN `game_id` IN(90,91) THEN `nn_view_money` ELSE (CASE WHEN `bunko` >0 THEN `bunko` - `bet_money` ELSE `bunko` END) END) AS `sumBunko`, sum(case WHEN bunko = 0 then bet_money else 0 end) as noBunko'))
                ->whereRaw('created_at > DATE_SUB("'.($dTime ?? 'NOW()').'", INTERVAL 48 HOUR)')
                ->where('user_id', $uid)
                ->first();
            //获取棋牌投注资金
            //获取所有的棋牌游戏
            $gamesList = GamesApi::where(function($aSql){
                $aSql->where('type_id', 111);
            })->get();
            if(count($gamesList)){
                $sqlArr = [];
                foreach ($gamesList as $k=>$v){
                    $table = 'jq_'.strtolower($v->alias).'_bet';
                    $where = ' 1 ';
                    $name = $user->username;
                    if($v->alias == 'WS'){//无双的账户名处理过
                        $name = substr(preg_replace("/[_]/","",$user->username), 0, 16);
                    }
                    $where .= " AND `Accounts` = '{$name}' ";
                    $sqlArr[] = " (SELECT SUM(`AllBet`) AS `AllBet`,'{$v->name}' as `name` FROM `{$table}` WHERE {$where} ) ";
                }
                $sql = 'SELECT SUM(`AllBet`) AS `ALLBet` FROM ( '.implode(' UNION ALL ', $sqlArr).' ) AS a ';
                $jqBetMoney = (float)DB::select($sql)[0]->ALLBet;
            }

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
                            <td valign="top" style="word-break: break-all;">' . ($userLastPay->amount ?? 0) . '</td>
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
                            <td valign="top" style="word-break: break-all;">棋牌投注：</td>
                            <td valign="top" style="word-break: break-all;">'.($jqBetMoney ?? 0).'</td>
                            <td valign="top" style="word-break: break-all;"></td>
                            <td valign="top" style="word-break: break-all;"></td>
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

    //充值配置新

    //添加在线支付配置新
    public function addPayOnlineNew()
    {
        $payType = PayTypeNew::where('status',1)->get();
        $levels = Levels::all();
        return view('back.modal.payNew.addPayOnline')->with('payType',$payType)->with('levels',$levels);
    }

    /**
     * 复制在线支付配置新
     * @param string $id
     * @return mixed
     */
    public function copyPayOnlineNew($id = '')
    {
        if(empty($id)){
            return response()->json([
                'status' => 0,
                'msg' => '参数错误'
            ]);
        }
        if(!$data = PayOnlineNew::where('id',$id)->first()->toArray()){
            return response()->json([
                'status' => 0,
                'msg' => ''
            ]);
        }
        $data['payeeName'] = $data['payeeName'] . ' - 复制';
        $data['remark2'] = $data['remark2'] . ' - 复制';
        unset($data['id']);
        if(PayOnlineNew::insert($data)){
            return response()->json([
                'status' => 1,
                'msg' => ''
            ]);
        }
        return response()->json([
            'status' => 0,
            'msg' => ''
        ]);
    }
    //修改在线支付配置新
    public function editPayOnlineNew($id = "")
    {
        $payType = PayTypeNew::all();
        $levels = Levels::all();
        $getPayOnlineData = PayOnlineNew::where('id',$id)->first();
        $getPayOnlineData->apiKey = empty($getPayOnlineData->apiKey)?'':substr($getPayOnlineData->apiKey,0,2).'*********'.substr($getPayOnlineData->apiKey,-2);
        $getPayOnlineData->apiPublicKey = empty($getPayOnlineData->apiPublicKey)?'':substr($getPayOnlineData->apiPublicKey,0, 2).'*********'.substr($getPayOnlineData->apiPublicKey,-2);
        $getPayOnlineData->apiPrivateKey = empty($getPayOnlineData->apiPrivateKey)?'':substr($getPayOnlineData->apiPrivateKey,0,2).'*********'.substr($getPayOnlineData->apiPrivateKey,-2);;
        $getPayOnlineData->levels = explode(",",$getPayOnlineData->levels);
        return view('back.modal.payNew.editPayOnline')->with('payType',$payType)->with('levels',$levels)->with('id',$id)->with('payOnline',$getPayOnlineData);
    }
    //添加银行支付配置
    public function addPayBankNew()
    {
        $banks = Banks::where('status',1)->get();
        $levels = Levels::all();
        return view('back.modal.payNew.addPayBank',compact('banks','levels'));
    }
    //修改银行支付配置
    public function editPayBankNew($id = "")
    {
        $banks = Banks::where('status',1)->get();
        $levels = Levels::all();
        $payBank = PayOnlineNew::where('id',$id)->first();
        $payBank->levels = explode(",",$payBank->levels);
        return view('back.modal.payNew.editPayBank',compact('banks','levels','payBank','id'));
    }
    //添加支付宝配置
    public function addPayAlipayNew()
    {
        $levels = Levels::all();
        return view('back.modal.payNew.addPayAlipay',compact('levels'));
    }

    //修改支付宝配置
    public function editPayAlipayNew($id = '')
    {
        $levels = Levels::all();
        $payAlipay = PayOnlineNew::where('id',$id)->first();
        $payAlipay->levels = explode(",",$payAlipay->levels);
        return view('back.modal.payNew.editPayAlipay',compact('levels','id','payAlipay'));
    }
    //添加支付宝扫码配置
    public function addPayAlipaySmNew()
    {
        $levels = Levels::all();
        return view('back.modal.payNew.addPayAlipaySm',compact('levels'));
    }

    //修改支付宝配置
    public function editPayAlipaySmNew($id = '')
    {
        $levels = Levels::all();
        $payAlipay = PayOnlineNew::where('id',$id)->first();
        $payAlipay->levels = explode(",",$payAlipay->levels);
        return view('back.modal.payNew.editPayAlipay',compact('levels','id','payAlipay'));
    }
    //添加云闪付配置
    public function addPayYsfNew()
    {
        $levels = Levels::all();
        return view('back.modal.payNew.addPayYsf',compact('levels'));
    }
    //修改云闪付配置
    public function editPayYsfNew($id = '')
    {
        $levels = Levels::all();
        $payYsf = PayOnlineNew::where('id',$id)->first();
        $payYsf->levels = explode(",",$payYsf->levels);
        return view('back.modal.payNew.editPayYsf',compact('levels','id','payYsf'));
    }
    //添加微信配置
    public function addPayWechatNew()
    {
        $levels = Levels::all();
        return view('back.modal.payNew.addPayWechat',compact('levels'));
    }
    //修改微信配置
    public function editPayWechatNew($id = '')
    {
        $levels = Levels::all();
        $payWechat = PayOnlineNew::where('id',$id)->first();
        $payWechat->levels = explode(",",$payWechat->levels);
        return view('back.modal.payNew.editPayWechat',compact('levels','id','payWechat'));
    }
    //添加财付通配置
    public function addPayCftNew()
    {
        $levels = Levels::all();
        return view('back.modal.payNew.addPayCft',compact('levels'));
    }
    //修改财付通
    public function editPayCftNew($id = '')
    {
        $levels = Levels::all();
        $payCft = PayOnlineNew::where('id',$id)->first();
        $payCft->levels = explode(",",$payCft->levels);
        return view('back.modal.payNew.editPayCft',compact('levels','id','payCft'));
    }

    //历史开奖

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

    //手动开奖
    public function open($id = '',$gameType = '', $cat = '',$issue,$typeC){
        $table = 'game_'.Games::$aCodeGameName[$gameType];
        $type = $gameType;
        $data = DB::table($table)->where('id',$id)->first();
        switch ($cat){
            case 'k3':  //快3类
                $view = 'back.modal.open.openK3';
                break;
            case 'ssc': //时时彩
                $view = 'back.modal.open.openSSC';
                break;
            case 'sc':  //赛车
                $view = 'back.modal.open.openSC';
                break;
            case 'xync':  //幸运农场 快乐十分
                $view = 'back.modal.open.openXync';
                break;
            case 'gd11x5':  //广东11选5
                $view = 'back.modal.open.openGd11x5';
                break;
            case 'bjkl8':  //北京快乐8
                $view = 'back.modal.open.openBJKL8';
                break;
            default:
                return false;
                break;
        }
        if(!isset($view)){
            return false;
        }
        $nums = [];
        if($typeC == 2)
            $nums = explode(',',$data->opennum);
        return view($view,compact('data','type','issue','typeC','nums'));
    }
    //重庆幸运农场开奖 1-20
    public function openCqxync($id = '')
    {
        $lhc = DB::table('game_cqxync')->where('id',$id)->first();
        return view('back.modal.open.o',compact('lhc'));
    }
    //添加六合彩
    public function addLhcNewIssue()
    {
        $endTime = date('Y-m-d 21:30:00');
        $openTime = date('Y-m-d 21:35:00');
        return view('back.modal.open.addLhcNewIssue',compact('endTime','openTime'));
    }
    //添加幸运六合彩
    /*public function addXylhcNewIssue(){
        $endTime = date('Y-m-d 21:30:00');
        $openTime = date('Y-m-d 21:35:00');
        return view('back.modal.open.addXylhcNewIssue',compact('endTime','openTime'));
    }*/
    //修改六合彩
    public function editLhcNewIssue($id = '')
    {
        $lhc = DB::table('game_lhc')->where('id',$id)->first();
        return view('back.modal.open.editLhcNewIssue',compact('lhc'));
    }
    //修改幸运六合彩
    public function editXylhcNewIssue($id = '',$gameType = '')
    {
        $table ='game_'.$gameType;
        $lhc = DB::table($table)->where('id',$id)->first();
        return view('back.modal.open.editXylhcNewIssue',compact('lhc'));
    }
    //六合彩手动开奖
    public function openLhc($id = '')
    {
        $lhc = DB::table('game_lhc')->where('id',$id)->first();
        return view('back.modal.open.openLHC',compact('lhc'));
    }
    //幸运六合彩手动开奖
    public function openXylhc($id = '',$gameType = '')
    {
        $table ='game_'.$gameType;
        $lhc = DB::table($table)->where('id',$id)->first();
        return view('back.modal.open.openXYLHC',compact('lhc'));
    }


    //六合彩重新开奖
    public function reOpenLhc($id = '')
    {
        $lhc = DB::table('game_lhc')->where('id',$id)->first();
        return view('back.modal.open.reOpenLHC',compact('lhc'));
    }
    //幸运六合彩重新开奖
    public function reOpenXylhc($id = '',$gameType = '')
    {
        $table ='game_'.$gameType;
        $lhc = DB::table($table)->where('id',$id)->first();
        return view('back.modal.open.reOpenXYLHC',compact('lhc','gameType'));
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
    //添加代理专属域名
    public function addAgentSettleDomain(){
        return view('back.modal.agentSettle.addAgentSettleDomain',compact('agentId'));
    }
    //修改代理专属域名
    public function editAgentSettleDomain($id){
        $data = \App\AgentDomain::where('id', $id)->first();
        return view('back.modal.agentSettle.editAgentSettleDomain',compact('data'));
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
        $activityLists = Activity::select('id','name','type')->orderBy('sort','asc')->get();
        $prizeLists = ActivityPrize::select('id','name','quantity')->get();
        return view('back.modal.activity.addActivityCondition',compact('activityLists','prizeLists'));
    }

    //修改活动条件-模板
    public function editActivityCondition($id, $activity_id){
        $data = [
            'activity_id' => $activity_id,
            'activityLists' => Activity::select('id','name')->orderBy('sort','asc')->get(),
            'prizeLists' => ActivityPrize::select('id','name','quantity')->get()
        ];
//        if($activity_id == 3){
//            $data['conditionInfoHongbao'] = \App\ActivityConditionHongbao::getDetailInfoOne($id);
//        } else {
        list($data['t1'], $data['t2']) = explode(' ',date('Y-m-d H:i:s'));
            $data['conditionInfo'] = ActivityCondition::getDetailInfoOne($id);
//        }
        return view('back.modal.activity.editActivityCondition',$data);
    }

    //编辑红包-单页面
    public function activityHongbaoProbability($id)
    {

        return view('back.modal.activity.activityHongbaoProbability', compact('id'));
    }

    //新增红包-模板
    public function addActivityHongbaoProbability ()
    {
        $level = DB::table('level')->get();
        return view('back.modal.activity.addActivityHongbaoProbability', compact('level'));
    }
    //编辑红包-模板
    public function editActivityHongbaoProbability ($id)
    {
        $data = \App\ActivityHongbaoProbability::where('id', $id)->first();
        $level = DB::table('level')->get();
        return view('back.modal.activity.addActivityHongbaoProbability', compact('level','data'));
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

    //导出会员报表-模板
    public function exportReportUser(){
        return view('back.modal.member.exportReportUser');
    }
    //导出代理报表-模板
    public function exportReportAgent(){
        return view('back.modal.member.exportReportAgent');
    }
    //导出代理报表-模板
    public function exportReportGAgent(){
        return view('back.modal.member.exportReportGAgent');
    }
    //导出投注报表-模板
    public function exportReportBet(){
        return view('back.modal.member.exportReportBet');
    }
    //导出棋牌报表-模板
    public function exportReportCart(){
        return view('back.modal.member.exportReportCart');
    }

    //操作报表添加-模板
    public function addStatistics(){
        return view('back.modal.report.addStatistics');
    }

    //添加代理赔率-模板
    public function gameAgentOddsAdd(){
        $iOdds = AgentOddsSetting::orderBy('level','desc')->value('odds');
        if(empty($iOdds))
            $iOdds = SystemSetting::getValueByRemark1('agent_odds_basis');
        return view('back.modal.game.agentOddsAdd',compact('iOdds'));
    }

    //修改代理赔率-模板
    public function gameAgentOddsEdit($id){
        $iData = AgentOddsSetting::find($id);
        if($iData->level == 1){
            $iOdds = SystemSetting::getValueByRemark1('agent_odds_basis');
        }else{
            $iOdds = AgentOddsSetting::where('level',$iData->level - 1)->value('odds');
        }
        return view('back.modal.game.agentOddsEdit',compact('iData','iOdds'));
    }

    //查看代理赔率-模板
    public function gameAgentOddsLook($agentId){
        $gameData = json_decode(Storage::disk('local')->get('gameData.php'),true);
        $game = Games::all();
        $modelStatus = 1;
        return view('back.modal.game.handicapSetting',compact('gameData','game','agentId','modelStatus'));
    }

    //代理赔率设置-模板
    public function gameAgentOddsSet($agentId){
        $gameData = json_decode(Storage::disk('local')->get('gameData.php'),true);
        $game = Games::all();
        $iAgent = Agent::where('a_id',$agentId)->first();
        $modelStatus = 3;
        return view('back.modal.game.handicapSetting',compact('gameData','game','iAgent','modelStatus'));
    }

    //添加游戏接口配置
    public function editGameApi(Request $request){
        $g_id = $request->get('g_id') ?? 0;
        $paramArr = [];
        $data = [];
        if($g_id){
            $paramArr = DB::table('games_api_config')->where('g_id',$g_id)->get();
            $data = DB::table('games_api')->where('g_id',$g_id)->first();
        }
        $GamesApi = new GamesApi();
        $statusArr = $GamesApi->statusArr;
        return view('back.gamesApi.list.editGameApi', compact('g_id', 'paramArr', 'data', 'statusArr'));
    }

    //后台支付页面
    public function payPlatformSettleOffer($id){
        $iInfo = Offer::where('id',$id)->first();
        $aArray = [
            'platform_id' => SystemSetting::getValueByRemark1('payment_platform_id'),
            'timestamp' => time(),
        ];
        $baseController = new SendController($aArray);
        $aPay = $baseController->sendParameter('pay/pay/index');
        if(!empty($aPay)) {
            if ($aPay['code'] == 0) {
                $aPay = $aPay['data'];
            }
        }else{
            $aPay = [];
        }
        return view('back.modal.platform.settleOffer',compact('iInfo','aPay'));
    }

    //棋牌投注报表-添加报表
    public function addReportCard()
    {
        return view('back.modal.report.addReportCard');
    }
    //棋牌投注报表-添加报表
    public function addReportGamesApi()
    {
        return view('back.modal.report.addReportGamesApi');
    }

}
