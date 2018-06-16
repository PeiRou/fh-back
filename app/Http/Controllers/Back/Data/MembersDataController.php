<?php

namespace App\Http\Controllers\Back\Data;

use App\Agent;
use App\Capital;
use App\GeneralAgent;
use App\Levels;
use App\Roles;
use App\SubAccount;
use App\User;
use function foo\func;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class MembersDataController extends Controller
{
    //总代理 - 表格数据
    public function generalAgent()
    {
        $allGeneralAgent = GeneralAgent::all();
        return DataTables::of($allGeneralAgent)
            ->editColumn('online', function ($allGeneralAgent){
                return '<span id="gagent_'.$allGeneralAgent->ga_id.'"><span class="tag-offline">离线</span></span>';
            })
            ->editColumn('account', function ($allGeneralAgent){
                return $allGeneralAgent->account." <span class='gary-text'>(".$allGeneralAgent->name.")</span>";
            })
            ->editColumn('agent', function ($allGeneralAgent){
                $getAgentCount = Agent::where('gagent_id',$allGeneralAgent->ga_id)->count();
                return "<span class='tag-green'>".$getAgentCount."</span>";
            })
            ->editColumn('members', function ($allGeneralAgent){
                return "<span class='tag-green'>0</span>";
            })
            ->editColumn('balance', function ($allGeneralAgent){
                if($allGeneralAgent->balance == 0)
                {
                    return "<span class='tag-gary'>".$allGeneralAgent->balance."</span>";
                } else {
                    return "<span class='tag-gary have-money'>".$allGeneralAgent->balance."</span>";
                }
            })
            ->editColumn('status', function ($allGeneralAgent){
                if($allGeneralAgent->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($allGeneralAgent->status == 2){
                    return '<span class="status-2"><i class="iconfont">&#xe656;</i> 冻结</span>';
                }
                if($allGeneralAgent->status == 3){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('control',function ($allGeneralAgent){
                if($allGeneralAgent->usertype == 8888)
                {
                    return '系统默认账号无法修改';
                } else {
                    return '<span class="edit-link" onclick="edit(\''.$allGeneralAgent->ga_id.'\')"><i class="iconfont">&#xe602;</i> 修改</span>';
                }
            })
            ->rawColumns(['online','account','agent','members','balance','status','control'])
            ->make(true);
    }

    //代理 - 表格数据
    public function agent()
    {
        $allAgent = Agent::orderBy('created_at','desc')->get();
        return DataTables::of($allAgent)
            ->editColumn('online', function ($allAgent){
                return '<span id="agent_'.$allAgent->a_id.'"><span class="tag-offline">离线</span></span>';
            })
            ->editColumn('general_agent', function ($allAgent){
                $get = GeneralAgent::find($allAgent->gagent_id);
                return $get->account;
            })
            ->editColumn('agent', function ($allAgent){
                return $allAgent->account." <span class='gary-text'>(".$allAgent->name.")</span>";
            })
            ->editColumn('members', function ($allAgent){
                $count = DB::table('users')->where('agent',$allAgent->a_id)->count();
                return "<span class='tag-green'>$count</span>";
            })
            ->editColumn('balance', function ($allAgent){
                if($allAgent->balance == 0)
                {
                    return "<span class='tag-gary'>".$allAgent->balance."</span>";
                } else {
                    return "<span class='tag-gary have-money'>".$allAgent->balance."</span>";
                }
            })
            ->editColumn('status', function ($allAgent){
                if($allAgent->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($allAgent->status == 2){
                    return '<span class="status-2"><i class="iconfont">&#xe656;</i> 冻结</span>';
                }
                if($allAgent->status == 3){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
                if($allAgent->status == 4){
                    return '<span class="status-3"><i class="iconfont">&#xe636;</i> 审核未通过</span>';
                }
            })
            ->editColumn('editOdds', function ($allAgent){
                if($allAgent->editodds == 0)
                {
                    return '<span class="power-off"><i class="iconfont">&#xe676;</i> 关闭</span>';
                } else {
                    return '<span class="power-on"><i class="iconfont">&#xe676;</i> 开启</span>';
                }
            })
            ->editColumn('login', function ($allAgent){
                return 0;
            })
            ->editColumn('content', function ($allAgent){
                if(empty($allAgent->content)){
                    return "无";
                } else {
                    return "<span class=\"edit-link\" onclick='seeContent(\"".$allAgent->a_id."\")'>查看</span>";
                }
            })
            ->editColumn('control', function ($allAgent){
                if($allAgent->usertype == 8888)
                {
                    return "系统默认-无法操作";
                } else {
                    return '<span class="edit-link" onclick="edit(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | <span class="edit-link" onclick="viewInfo(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe818;</i> 详情</span> | <span class="edit-link" onclick="changeAgentMoney(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe60b;</i> 修改余额</span> | <span class="edit-link" onclick="capital(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe67e;</i> 资金明细</span> | <span class="edit-link" onclick="panSetting(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe6dd;</i> 盘口设定</span> | <span class="edit-link" onclick="del(\''.$allAgent->a_id.'\',\''.$allAgent->account.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
                }
            })
            ->rawColumns(['online','agent','members','balance','status','editOdds','content','control'])
            ->make(true);
    }

    //代理的资金明细
    public function agentCapital($id, Request $request)
    {
        $capitalType = $request->get('capital_type');
        $issue = $request->get('issue');
        $startTime = strtotime($request->get('startTime').' 00:00:00');
        $endTime = strtotime($request->get('endTime').' 23:59:59');
        $loginId = Session::get('account_id');
        $capital = Capital::where(function($q) use($startTime,$endTime,$capitalType,$issue,$loginId,$id){
            if(isset($capitalType) && $capitalType)
            {
                $q->whereRaw('type = "'.$capitalType.'"');
            }
            if(isset($issue) && $issue)
            {
                $q->whereRaw('issue = '.$issue);
            }
            if(isset($startTime) && $startTime)
            {
                $q->whereRaw('unix_timestamp(created_at) >= '.$startTime);
            }
            if(isset($endTime) && $endTime)
            {
                $q->whereRaw('unix_timestamp(created_at) <= '.$endTime);
            }
            $q->whereRaw('to_user = '.$id.' and user_type = "agent"');
        })->orderBy('created_at','desc')->get();

        return DataTables::of($capital)
            ->editColumn('type', function($capital){
                switch ($capital->type)
                {
                    case 't01':
                        return '充值';
                    case 't02':
                        return '撤单[中奖金额]';
                    case 't03':
                        return '撤单[退水金额]';
                    case 't04':
                        return '返利/手续费';
                    case 't05':
                        return '下注';
                    case 't06':
                        return '重新开奖[中奖金额]';
                    case 't07':
                        return '重新开奖[退水金额]';
                    case 't08':
                        return '活动';
                    case 't09':
                        return '奖金';
                    case 't10':
                        return '代理结算佣金';
                    case 't11':
                        return '代理佣金提现';
                    case 't12':
                        return '代理佣金提现失败退回';
                    case 't13':
                        return '抢到红包';
                    case 't14':
                        return '退水';
                    case 't15':
                        return '提现';
                    case 't16':
                        return '撤单';
                    case 't17':
                        return '提现失败';
                    case 't18':
                        return '后台加钱';
                    case 't19':
                        return '后台扣钱';
                }
            })
            ->editColumn('money', function($capital){
                if($capital->money < 0)
                {
                    return '<span class="green-text">'.$capital->money.'</span>';
                } else {
                    return '<span class="red-text">'.$capital->money.'</span>';
                }
            })
            ->editColumn('balance', function($capital){
                return '<span class="blue-text">'.$capital->balance.'</span>';
            })
            ->editColumn('issue', function ($capital){
                if(empty($capital->issue))
                {
                    return "-";
                } else {
                    return $capital->issue;
                }
            })
            ->editColumn('game', function ($capital){
                if(empty($capital->game_id))
                {
                    return "-";
                } else {
                    return $capital->game_id;
                }
            })
            ->editColumn('play_type', function ($capital){
                if(empty($capital->play_type))
                {
                    return "-";
                } else {
                    return $capital->play_type;
                }
            })
            ->editColumn('operation', function ($capital){
                $getSubAccount = SubAccount::find($capital->operation_id);
                return $getSubAccount->account."(".$getSubAccount->name.")";
            })
            ->rawColumns(['money','balance'])
            ->make(true);
    }

    //会员数据
    public function user(Request $request)
    {
        $status = $request->get('status');
        $rechLevel = $request->get('rechLevel');
        $account = $request->get('account'); //多条件 邮箱/账号/名称
        $mobile = $request->get('mobile');
        $qq = $request->get('qq');
        $minMoney = $request->get('minMoney');
        $maxMoney = $request->get('maxMoney');
        $promoter = $request->get('promoter');
        $noLoginDays = $request->get('noLoginDays');

        $users = User::select()
            ->where(function ($query) use($status){
                if(isset($status) && $status){
                    $query->where('status','=',$status);
                }
            })
            ->where(function ($query) use($rechLevel){
                if(isset($rechLevel) && $rechLevel){
                    $query->where('rechLevel','=',$rechLevel);
                }
            })
            ->where(function ($query) use($account){
                if(isset($account) && $account){
                    $query->where('username','=',$account)
                        ->orWhere('email','=',$account)
                        ->orWhere('fullName','=',$account);
                }
            })
            ->where(function ($query) use($mobile){
                if(isset($mobile) && $mobile){
                    $query->where('mobile','=',$mobile);
                }
            })
            ->where(function ($query) use($qq){
                if(isset($qq) && $qq){
                    $query->where('qq','=',$qq);
                }
            })
            ->where(function ($query) use($minMoney,$maxMoney){
                if(isset($minMoney) && $minMoney || isset($maxMoney) && $maxMoney){
                    $query->where('money','>=',$minMoney)->where('money','<=',$maxMoney);
                }
            })
            ->where(function ($query) use($promoter){
                if(isset($promoter) && $promoter){
                    $query->where('promoter','=',$promoter);
                }
            })
            ->where(function ($query) use($noLoginDays){
                if(isset($noLoginDays) && $noLoginDays){
                    $query->where('noLoginDays','=',$noLoginDays);
                }
            })
            ->where('testFlag',0)->orderBy('created_at','desc')->get();
        $now = time();
        return DataTables::of($users)
            ->editColumn('online',function ($users) use($now){
                $userLastTime = strtotime($users->updated_at);
                $time = $now-$userLastTime;
                if($time > 3600)
                {
                    return "<span class='off-line-point'></span>";
                } else {
                    return "<span class='on-line-point'></span>";
                }
            })
            ->editColumn('promoter',function ($users){
                return empty($users->promoter) ? '无' : $users->promoter;
            })
            ->editColumn('rechLevel',function ($user){
                $levels = Levels::where('value',$user->rechLevel)->first();
                return  "<a href='javascript:void(0)' onclick='editLevels(\"$user->id\",\"$user->rechLevel\")' class='allow-edit'>$levels->name <i class='iconfont'>&#xe715;</i></a>";
            })
            ->editColumn('created_at',function ($users){
                return "<span data-tooltip=\"".$users->created_at."\" data-inverted=\"\">".date('m/d H:i:s',strtotime($users->created_at))."</span>";
            })
            ->editColumn('updated_at',function ($users){
                return "<span data-tooltip=\"".$users->updated_at."\" data-inverted=\"\">".date('m/d H:i:s',strtotime($users->updated_at))."</span>";
            })
            ->editColumn('user',function ($users){
                return $users->username."<span class='gary-text'> (".$users->fullName.")</span>";
            })
            ->editColumn('agent',function ($users){
                $getAgent = Agent::find($users->agent);
                if($getAgent){
                    return $getAgent->account;
                } else {
                    return '--';
                }
            })
            ->editColumn('balance',function ($users){
                return "<span class='red-text'>".$users->money."</span>";
            })
            ->editColumn('status',function ($users){
                if($users->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($users->status == 2){
                    return '<span class="status-2"><i class="iconfont">&#xe656;</i> 冻结</span>';
                }
                if($users->status == 3){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('saveOrDraw',function ($users){
                return $users->PayTimes.'/'.$users->DrawTimes;
            })
            ->editColumn('saveMoneyCount',function ($users){
                return $users->saveMoneyCount;
            })
            ->editColumn('drawMoneyCount',function ($users){
                return $users->drawMoneyCount;
            })
            ->editColumn('noLoginDays',function ($users){
                $startdate = strtotime(date('Y-m-d',strtotime($users->lastLoginTime)));
                $enddate = strtotime(date('Y-m-d'));
                $days=round(($enddate-$startdate)/3600/24) ;
                return $days.'天';
            })
            ->editColumn('content',function ($users){
                if($users->content){
                    return "<span class='edit-link' onclick='seeContent(\"$users->id\")'>查看</span>";
                } else {
                    return "-";
                }
            })
            ->editColumn('control',function ($users){
                return "<ul class='control-menu'>
                        <li onclick='edit(\"$users->id\")'>修改</li>
                        <li onclick='changeUserMoney(\"$users->id\")'>余额变更</li>
                        <li><a href='/back/control/userManage/userBetList/$users->id' target='_blank'>注单明细</a></li>
                        <li onclick='userCapital(\"$users->id\")'>资金明细</li>
                        <li>更多操作
                        <ul>
                        <li onclick='viewInfo(\"$users->id\")'>查看详情</li>
                        <li onclick='changeFullName(\"$users->id\")'>修改姓名</li>
                        <li>盘口设定</li>
                        <li>交易设定</li>
                        <li onclick='changeAgent(\"$users->id\",\"$users->username\")'>更换代理</li>
                        <li class='red-hover' onclick='delUser(\"$users->id\",\"$users->username\")'>删除会员</li>
                        </ul>
                        </li>
                        </ul>";
            })
            ->rawColumns(['online','user','balance','status','control','created_at','updated_at','content','rechLevel'])
            ->make(true);
    }

    //用户资金明细
    public function userCapital($id,Request $request)
    {
        $capitalType = $request->get('capital_type');
        $issue = $request->get('issue');
        $startTime = strtotime($request->get('startTime').' 00:00:00');
        $endTime = strtotime($request->get('endTime').' 23:59:59');
        $loginId = Session::get('account_id');
        $capital = Capital::where(function($q) use($startTime,$endTime,$capitalType,$issue,$loginId,$id){
            if(isset($capitalType) && $capitalType)
            {
                $q->whereRaw('type = "'.$capitalType.'"');
            }
            if(isset($issue) && $issue)
            {
                $q->whereRaw('issue = '.$issue);
            }
            if(isset($startTime) && $startTime)
            {
                $q->whereRaw('unix_timestamp(created_at) >= '.$startTime);
            }
            if(isset($endTime) && $endTime)
            {
                $q->whereRaw('unix_timestamp(created_at) <= '.$endTime);
            }
            $q->whereRaw('to_user = '.$id.' and user_type = "user"');
        })->orderBy('created_at','desc')->get();

        return DataTables::of($capital)
            ->editColumn('type', function($capital){
                switch ($capital->type)
                {
                    case 't01':
                        return '充值';
                    case 't02':
                        return '撤单[中奖金额]';
                    case 't03':
                        return '撤单[退水金额]';
                    case 't04':
                        return '返利/手续费';
                    case 't05':
                        return '下注';
                    case 't06':
                        return '重新开奖[中奖金额]';
                    case 't07':
                        return '重新开奖[退水金额]';
                    case 't08':
                        return '活动';
                    case 't09':
                        return '奖金';
                    case 't10':
                        return '代理结算佣金';
                    case 't11':
                        return '代理佣金提现';
                    case 't12':
                        return '代理佣金提现失败退回';
                    case 't13':
                        return '抢到红包';
                    case 't14':
                        return '退水';
                    case 't15':
                        return '提现';
                    case 't16':
                        return '撤单';
                    case 't17':
                        return '提现失败';
                    case 't18':
                        return '后台加钱';
                    case 't19':
                        return '后台扣钱';
                }
            })
            ->editColumn('money', function($capital){
                if($capital->money < 0)
                {
                    return '<span class="green-text">'.$capital->money.'</span>';
                } else {
                    return '<span class="red-text">'.$capital->money.'</span>';
                }
            })
            ->editColumn('balance', function($capital){
                return '<span class="blue-text">'.$capital->balance.'</span>';
            })
            ->editColumn('issue', function ($capital){
                if(empty($capital->issue))
                {
                    return "-";
                } else {
                    return $capital->issue;
                }
            })
            ->editColumn('game', function ($capital){
                if(empty($capital->game_id))
                {
                    return "-";
                } else {
                    return $capital->game_id;
                }
            })
            ->editColumn('play_type', function ($capital){
                if(empty($capital->play_type))
                {
                    return "-";
                } else {
                    return $capital->play_type;
                }
            })
            ->editColumn('operation', function ($capital){
                $getSubAccount = SubAccount::find($capital->operation_id);
                return $getSubAccount->account."(".$getSubAccount->name.")";
            })
            ->rawColumns(['money','balance'])
            ->make(true);
    }
    
    //子账号 - 表格数据
    public function subAccounts()
    {
        $subAccounts = SubAccount::all();
        return DataTables::of($subAccounts)
            ->editColumn('online', function ($subAccounts){
//                if($subAccounts->online == 0)
//                {
//                    return '<span class="tag-offline">离线</span>'.$onlineUsers;
//                } else {
//                    return '<span class="tag-online">在线</span>'.$onlineUsers;
//                }
                return '<span id="user_'.$subAccounts->sa_id.'"><span class="tag-offline">离线</span></span>';
            })
            ->editColumn('role', function ($subAccounts){
                $getRole = Roles::where('id',$subAccounts->role)->first();
                return $getRole->name;
            })
            ->editColumn('status', function ($subAccounts){
                if($subAccounts->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($subAccounts->status == 2){
                    return '<span class="status-2"><i class="iconfont">&#xe656;</i> 冻结</span>';
                }
                if($subAccounts->status == 3){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('control',function ($subAccounts){
                if($subAccounts->usertype == 8888)
                {
                    return '系统默认账号无法修改';
                } else {
                    return '<span class="edit-link" onclick="edit(\''.$subAccounts->sa_id.'\')"><i class="iconfont">&#xe602;</i> 修改</span>
                          | <span class="edit-link" onclick="google(\''.$subAccounts->sa_id.'\')"><i class="iconfont">&#xe6a9;</i> Google双重验证</span>
                          | <span class="edit-link" onclick="del(\''.$subAccounts->sa_id.'\',\''.$subAccounts->account.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
                }
            })
            ->rawColumns(['online','status','control'])
            ->make(true);
    }

    //在线会员
    public function onlineUser()
    {
        Redis::select(2);
        $keys = Redis::keys('user:'.'*');
        $onlineUser = [];
        foreach ($keys as $item){
            $data = "[".Redis::get($item)."]";
            $get = json_decode($data,true);
            $onlineUser[] = $get[0]['user_id'];
        }
        $ids = implode(',',$onlineUser);
        $user = User::select()
            ->whereIn('id',$onlineUser)->get();
        return DataTables::of($user)
            ->editColumn('online',function (){
                return "<span class='on-line-point'></span>";
            })
            ->editColumn('account',function ($user){
                return $user->username;
            })
            ->editColumn('userType',function ($user){
                return "会员";
            })
            ->editColumn('money',function ($user){
                return "<span class=\"red-text\">$user->money</span>";
            })
            ->editColumn('status', function ($user){
                if($user->status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($user->status == 2){
                    return '<span class="status-2"><i class="iconfont">&#xe656;</i> 冻结</span>';
                }
                if($user->status == 3){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('login_ip',function ($user){
                return "<span><i class='iconfont'>&#xe64f;</i> $user->login_ip</span>";
            })
            ->editColumn('login_ip_info',function ($user){
                return "<span data-tooltip='$user->login_ip_info' data-inverted><i class='iconfont'>&#xe627;</i> $user->login_ip_info</span>";
            })
            ->editColumn('login_client',function ($user){
                if($user->login_client == 1){
                    return "<i class='iconfont'>&#xe696;</i> PC端";
                }
                if($user->login_client == 2){
                    return "<i class='iconfont'>&#xe686;</i> 移动端";
                }
            })
            ->editColumn('control',function ($user){
                return '<span class="edit-link" onclick="getOut(\''.$user->id.'\',\''.$user->username.'\')"><i class="iconfont">&#xeab6;</i> 踢下线</span>';
            })
            ->rawColumns(['online','status','login_client','control','login_ip_info','login_ip','money'])
            ->make(true);
    }
}
