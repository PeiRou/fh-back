<?php

namespace App\Http\Controllers\Back\Data;

use App\Agent;
use App\Bets;
use App\Capital;
use App\GeneralAgent;
use App\Levels;
use App\Roles;
use App\SubAccount;
use App\User;
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
        $aSql = "SELECT g.*,count(DISTINCT(ag.a_id)) as countAgent,count(DISTINCT((case WHEN u.testFlag in (0,2) then u.id else NULL end))) as countMember FROM `general_agent` g LEFT JOIN `agent` ag on g.ga_id = ag.gagent_id LEFT JOIN `users` u on ag.a_id = u.agent WHERE 1 GROUP BY g.ga_id ";
        $allGeneralAgent = DB::select($aSql);
        return DataTables::of($allGeneralAgent)
            ->editColumn('online', function ($allGeneralAgent){
                return '<span id="gagent_'.$allGeneralAgent->ga_id.'"><span class="tag-offline">离线</span></span>';
            })
            ->editColumn('account', function ($allGeneralAgent){
                return $allGeneralAgent->account." <span class='gary-text'>(".$allGeneralAgent->name.")</span>";
            })
            ->editColumn('agent', function ($allGeneralAgent){
                return "<a class='tag-green' href='/back/control/userManage/agent?id=".$allGeneralAgent->ga_id."'>".$allGeneralAgent->countAgent."</a>";
            })
            ->editColumn('members', function ($allGeneralAgent){
                return "<a class='tag-green' href='/back/control/userManage/user?ga_id=".$allGeneralAgent->ga_id."'>".$allGeneralAgent->countMember."</a>";
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
    public function agent(Request $request)
    {
        $ga_id = $request->get('gaid');
        $aSql = "SELECT ag.*,COUNT(DISTINCT((case WHEN u.testFlag in (0,2) then u.id else NULL end))) as countMember FROM `agent` ag LEFT JOIN `users` u on ag.a_id = u.agent WHERE 1 ";
        $where = "";
        if(isset($ga_id) && $ga_id>0 ){
            $where .= " and ag.gagent_id = ".$ga_id;
        }
        $aSql = $aSql.$where." GROUP BY ag.a_id ORDER BY ag.created_at desc ";
        $allAgent = DB::select($aSql);
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
                return "<a class='tag-green' href='/back/control/userManage/user?id=".$allAgent->a_id."'>".$allAgent->countMember."</a>";
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
        Redis::select(2);
        $status = $request->get('status');
        $agent = $request->get('agent');
        $rechLevel = $request->get('rechLevel');
        $account = $request->get('account'); //多条件 邮箱/账号/名称
        $mobile = $request->get('mobile');
        $qq = $request->get('qq');
        $minMoney = $request->get('minMoney');
        $maxMoney = $request->get('maxMoney');
        $promoter = $request->get('promoter');
        $noLoginDays = $request->get('noLoginDays');
        $aid = $request->get('aid');    //代理id
        $gaid = $request->get('gaid');    //总代id

        $users = DB::table('users')
            ->leftJoin('level','users.rechLevel','=','level.value')
            ->leftJoin('agent','users.agent','=','agent.a_id')
            ->leftJoin('general_agent', 'agent.gagent_id', '=', 'general_agent.ga_id')
            ->select('users.promoter as user_promoter','level.name as level_name','users.id as uid','users.rechLevel as user_rechLevel','users.created_at as user_created_at','users.updated_at as user_updated_at','users.username as user_username','users.fullName as user_fullName','agent.account as ag_account','users.money as user_money','users.status as user_status','users.PayTimes as user_PayTimes','users.DrawTimes as user_DrawTimes','users.saveMoneyCount as user_saveMoneyCount','users.drawMoneyCount as user_drawMoneyCount','users.lastLoginTime as user_lastLoginTime','users.content as user_content')
            ->where(function ($query) use($status){
                if(isset($status) && $status){
                    $query->where('users.status','=',$status);
                }
            })
	    ->where(function ($query) use($gaid){
                if(isset($gaid) && $gaid>0){
                    $query->where('gagent_id',$gaid);
                }
            })
	    ->where(function ($query) use($aid){
                if(isset($aid) && $aid>0){
                    $query->where('users.agent',$aid);
                }
            })
            ->where(function ($query) use($agent){
                if(isset($agent) && $agent){
                    $query->where('users.agent',$agent);
                }
            })
            ->where(function ($query) use($rechLevel){
                if(isset($rechLevel) && $rechLevel){
                    $query->where('users.rechLevel','=',$rechLevel);
                }
            })
            ->where(function ($query) use($account){
                if(isset($account) && $account){
                    $query->where('users.username','=',$account)
                        ->orWhere('users.email','=',$account)
                        ->orWhere('users.fullName','=',$account);
                }
            })
            ->where(function ($query) use($mobile){
                if(isset($mobile) && $mobile){
                    $query->where('users.mobile','=',$mobile);
                }
            })
            ->where(function ($query) use($qq){
                if(isset($qq) && $qq){
                    $query->where('users.qq','=',$qq);
                }
            })
            ->where(function ($query) use($minMoney,$maxMoney){
                if(isset($minMoney) && $minMoney || isset($maxMoney) && $maxMoney){
                    $query->where('users.money','>=',$minMoney)->where('users.money','<=',$maxMoney);
                }
            })
            ->where(function ($query) use($promoter){
                if(isset($promoter) && $promoter){
                    $query->where('users.promoter','=',$promoter);
                }
            })
            ->where(function ($query) use($noLoginDays){
                if(isset($noLoginDays) && $noLoginDays){
                    $query->where('users.noLoginDays','=',$noLoginDays);
                }
            })
            ->where('users.testFlag','!=',1)->orderBy('users.created_at','desc')->get();
        return DataTables::of($users)
            ->editColumn('online',function ($users) {
                $key = 'user:'.md5($users->uid);
                if(Redis::exists($key)){
                    return "<span class='on-line-point'></span>";
                } else {
                    return "<span class='off-line-point'></span>";
                }
//                $userLastTime = strtotime($users->updated_at);
//                $time = $now-$userLastTime;
//                if($time > 3600)
//                {
//                    return "<span class='off-line-point'></span>";
//                } else {
//                    return "<span class='on-line-point'></span>";
//                }
            })
            ->editColumn('promoter',function ($users){
                return empty($users->user_promoter) ? '无' : $users->user_promoter;
            })
            ->editColumn('rechLevel',function ($user){
                return  "<a href='javascript:void(0)' onclick='editLevels(\"$user->uid\",\"$user->user_rechLevel\")' class='allow-edit'>$user->level_name <i class='iconfont'>&#xe715;</i></a>";
            })
            ->editColumn('created_at',function ($users){
                return "<span data-tooltip=\"".$users->user_created_at."\" data-inverted=\"\">".date('m/d H:i:s',strtotime($users->user_created_at))."</span>";
            })
            ->editColumn('updated_at',function ($users){
                return "<span data-tooltip=\"".$users->user_updated_at."\" data-inverted=\"\">".date('m/d H:i:s',strtotime($users->user_updated_at))."</span>";
            })
            ->editColumn('user',function ($users){
                return $users->user_username."<span class='gary-text'> (".$users->user_fullName.")</span>";
            })
            ->editColumn('agent',function ($users){
                if($users->ag_account){
                    return $users->ag_account;
                } else {
                    return '--';
                }
            })
            ->editColumn('balance',function ($users){
                return "<span class='red-text'>".$users->user_money."</span>";
            })
            ->editColumn('status',function ($users){
                if($users->user_status == 1){
                    return '<span class="status-1"><i class="iconfont">&#xe652;</i> 正常</span>';
                }
                if($users->user_status == 2){
                    return '<span class="status-2"><i class="iconfont">&#xe656;</i> 冻结</span>';
                }
                if($users->user_status == 3){
                    return '<span class="status-3"><i class="iconfont">&#xe672;</i> 停用</span>';
                }
            })
            ->editColumn('saveOrDraw',function ($users){
                return $users->user_PayTimes.'/'.$users->user_DrawTimes;
            })
            ->editColumn('saveMoneyCount',function ($users){
                if($users->user_saveMoneyCount > 0){
                    return "<b class='blue-text'>".$users->user_saveMoneyCount."</b>";
                } else {
                    return $users->user_saveMoneyCount;
                }
            })
            ->editColumn('drawMoneyCount',function ($users){
                if($users->user_drawMoneyCount > 0){
                    return "<b class='blue-text'>".$users->user_drawMoneyCount."</b>";
                } else {
                    return $users->user_drawMoneyCount;
                }
            })
            ->editColumn('noLoginDays',function ($users){
                $startdate = strtotime(date('Y-m-d',strtotime($users->user_lastLoginTime)));
                $enddate = strtotime(date('Y-m-d'));
                $days=round(($enddate-$startdate)/3600/24) ;
                return $days.'天';
            })
            ->editColumn('content',function ($users){
                if($users->user_content){
                    return "<span class='edit-link' onclick='seeContent(\"$users->uid\")'>查看</span>";
                } else {
                    return "-";
                }
            })
            ->editColumn('control',function ($users){
                return "<ul class='control-menu'>
                        <li onclick='edit(\"$users->uid\")'>修改</li>
                        <li onclick='changeUserMoney(\"$users->uid\")'>余额变更</li>
                        <li><a href='/back/control/userManage/userBetList/$users->uid' target='_blank'>注单明细</a></li>
                        <li onclick='userCapital(\"$users->uid\")'>资金明细</li>
                        <li>更多操作
                        <ul>
                        <li onclick='viewInfo(\"$users->uid\")'>查看详情</li>
                        <li onclick='changeFullName(\"$users->uid\")'>修改姓名</li>
                        <li>盘口设定</li>
                        <li>交易设定</li>
                        <li onclick='changeAgent(\"$users->uid\",\"$users->user_username\")'>更换代理</li>
                        <li class='red-hover' onclick='delUser(\"$users->uid\",\"$users->user_username\")'>删除会员</li>
                        </ul>
                        </li>
                        </ul>";
            })
            ->rawColumns(['online','user','balance','status','control','created_at','updated_at','content','rechLevel','saveMoneyCount','drawMoneyCount'])
            ->make(true);
    }

    //用户资金明细
    public function userCapital($id,Request $request)
    {
        $param = $request->all();
        $param['type'] = $request->get('capital_type');
        $param['account_id'] = $id;
        $capitalSql = Capital::AssemblyFundDetails($param);
        if(isset($param['type']) && array_key_exists('type', $param)){
            if(in_array($param['type'],Capital::$includePlayTypeOption)){
                $betsSql = Bets::AssemblyFundDetails($param);
                $capital = $capitalSql->union($betsSql);
            }else{
                $capital = $capitalSql->get();
            }
        }else {
            $betsSql = Bets::AssemblyFundDetails($param);
            $capital = $capitalSql->union($betsSql);
        }
        $playTypeOptions = Capital::$playTypeOption;

        return DataTables::of($capital)
            ->editColumn('type',function ($capital) use ($playTypeOptions){
                if(strpos($capital->type,'t') === false) {
                    return $playTypeOptions['t05'];
                }
                return $playTypeOptions[$capital->type];
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
                    return $capital->game_name;
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
                if(!empty($capital->operation_id)){
                    $getSubAccount = SubAccount::find($capital->operation_id);
                    return $getSubAccount->account."(".$getSubAccount->name.")";
                }else{
                    return "-";
                }
            })
            ->editColumn('content',function ($capital){
                if(empty($capital->content)){
                    return '-';
                }else{
                    return $capital->content;
                }
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
                Redis::select(4);
                $key = 'sa:'.md5($subAccounts->sa_id);
                if(Redis::exists($key)){
                    return "<span class='on-line-point'></span>";
                } else {
                    return "<span class='off-line-point'></span>";
                }
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
                return '<a href="/back/control/userManage/userBetList/'.$user->id.'" target="_blank">'.$user->username.'</a>';
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
//                return "<span data-tooltip='$user->login_ip_info' data-inverted><i class='iconfont'>&#xe627;</i> $user->login_ip_info</span>";
                $t = strpos($user->login_ip_info,'中国');
                if($t === false){
                    $redClass = '';
                } else {
                    $redClass = 'red-text';
                }
                return "<span class='".$redClass."'><i class='iconfont'>&#xe627;</i> $user->login_ip_info</span>";
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
            ->rawColumns(['account','online','status','login_client','control','login_ip_info','login_ip','money'])
            ->make(true);
    }
}
