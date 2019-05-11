<?php

namespace App\Http\Controllers\Back\Data;

use App\Agent;
use App\AgentBackwater;
use App\BetHis;
use App\Bets;
use App\Capital;
use App\CapitalAgent;
use App\Drawing;
use App\GeneralAgent;
use App\Levels;
use App\Recharges;
use App\Roles;
use App\SubAccount;
use App\User;
use App\Users;
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
    public function generalAgent(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');
//        $aSql = "SELECT g.*,count(DISTINCT(ag.a_id)) as countAgent,count(DISTINCT((case WHEN u.testFlag in (0,2) then u.id else NULL end))) as countMember FROM `general_agent` g
//LEFT JOIN `agent` ag on g.ga_id = ag.gagent_id
//LEFT JOIN `users` u on ag.a_id = u.agent GROUP BY g.ga_id LIMIT $start,$length";
        $aSql = "SELECT g.*,count(DISTINCT(ag.a_id)) as countAgent,SUM(u.`idCount`) as countMember FROM `general_agent` g 
LEFT JOIN `agent` ag on g.ga_id = ag.gagent_id 
LEFT JOIN (SELECT COUNT(`id`) AS `idCount`,`agent` FROM `users` WHERE `testFlag` IN(0,2) GROUP BY `agent`) u on ag.a_id = u.agent 
GROUP BY g.ga_id LIMIT $start,$length";
        $allGeneralAgent = DB::select($aSql);
        $agentCount = DB::select('SELECT COUNT(`ga_id`) AS `count` FROM general_agent');
        return DataTables::of($allGeneralAgent)
            ->editColumn('online', function ($allGeneralAgent){
                return '<span id="gagent_'.$allGeneralAgent->ga_id.'"><span class="tag-offline">离线</span></span>';
            })
            ->editColumn('account', function ($allGeneralAgent){
                return $allGeneralAgent->account." <span class='gary-text'>(".$allGeneralAgent->name.")</span>";
            })
            ->editColumn('agent', function ($allGeneralAgent){
                $agentCount = empty($allGeneralAgent->countAgent)?0:$allGeneralAgent->countAgent;
                return "<a class='tag-green' href='/back/control/userManage/agent?id=".$allGeneralAgent->ga_id."'>".$agentCount."</a>";
            })
            ->editColumn('members', function ($allGeneralAgent){
                $memberCount = empty($allGeneralAgent->countMember)?0:$allGeneralAgent->countMember;
                return "<a class='tag-green' href='/back/control/userManage/user?ga_id=".$allGeneralAgent->ga_id."'>".$memberCount."</a>";
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
            ->editColumn('control',function ($allGeneralAgent) use ($request){
                $str = '';
                if($allGeneralAgent->usertype == 8888)
                {
                    $str .= '系统默认账号无法修改';
                } else {
                    if(in_array('m.gAgent.edit',$this->permissionArray))
                        $str .= '<span class="edit-link" onclick="edit(\''.$allGeneralAgent->ga_id.'\')"><i class="iconfont">&#xe602;</i> 修改</span>';
                }
                if(in_array('member.exportGAgentMember',$this->permissionArray)) {
                    $str .= '|<span class="edit-link" onclick="exportMember(\''.$allGeneralAgent->ga_id.'\',\''.$allGeneralAgent->account.'\')"><i class="iconfont"></i> 导出会员</span>';
                }
                return $str;
            })
            ->rawColumns(['online','account','agent','members','balance','status','control'])
            ->setTotalRecords($agentCount[0]->count)
            ->skipPaging()
            ->make(true);
    }

    //代理 - 表格数据
    public function agent(Request $request)
    {
        $ga_id = $request->get('gaid');
        $agentId = $request->get('agentId');
        $start = $request->get('start');
        $length = $request->get('length');
        $params = $request->post();
        $aSql = "SELECT * FROM `agent` WHERE 1 ";
        $cSql = "SELECT COUNT(`a_id`) AS `count` FROM `agent`  WHERE 1";
        $where = "";
        if(isset($ga_id) && $ga_id>0 ){
            $where .= " and gagent_id = ".$ga_id;
        }
        if(isset($agentId) && $agentId>0 ){
            $where .= " and FIND_IN_SET(".$agentId.",superior_agent)";
        }
        if(isset($params['status']) && array_key_exists('status',$params)){
            $where .= " and status = ".$params['status'];
        }
        if(isset($params['name']) && array_key_exists('name',$params)){
            if(isset($params['type']) && array_key_exists('type',$params)){
                if($params['type'] == 1){
                    $where .= " and account = '".$params['name']."'";
                }elseif($params['type'] == 2){
                    $where .= " and name = '".$params['name']."'";
                }
            }
        }
        if(isset($params['day']) && array_key_exists('day',$params)){
            $time = date('Y-m-d',strtotime(-$params['day'].' day'));
//            var_dump($time);die();
            $where .= " and updated_at <= '".$time."'";
        }
        $aSql = "SELECT ag.*,`u`.`countMember`,`general_agent`.`account` AS `gAccount`,`countAgent`.countAgent AS `countAgent` FROM (".$aSql.$where." ORDER BY created_at desc LIMIT ".$start.",".$length.") AS ag 
                    LEFT JOIN (SELECT COUNT(id) AS countMember,agent FROM `users` WHERE testFlag IN(0,2) GROUP BY `agent`) u on ag.a_id = u.agent
                    LEFT JOIN (SELECT `agent`.a_id,COUNT(`agent`.a_id) AS `countAgent` FROM `agent`
                                    JOIN (SELECT a_id,superior_agent FROM `agent`) AS `agent1` ON FIND_IN_SET(`agent`.a_id,`agent1`.`superior_agent`)
                                GROUP BY `agent`.a_id) AS `countAgent` ON `countAgent`.a_id = ag.a_id
                    JOIN `general_agent` ON `general_agent`.`ga_id` = `ag`.`gagent_id` ORDER BY `ag`.`created_at` DESC";
        $allAgent = DB::select($aSql);
        $cSql = $cSql.$where;
        $countAgent = DB::select($cSql);
        $adminRole = DB::table('sub_account')->where('sa_id',Session::get('account_id'))->value('role');
        $modelStatus = Agent::$agentModelStatus;
        return DataTables::of($allAgent)
            ->editColumn('online', function ($allAgent){
                return '<span id="agent_'.$allAgent->a_id.'"><span class="tag-offline">离线</span></span>';
            })
            ->editColumn('general_agent', function ($allAgent){
                return $allAgent->gAccount;
            })
            ->editColumn('agent', function ($allAgent){
                return $allAgent->account." <span class='gary-text'>(".$allAgent->name.")</span>";
            })
            ->editColumn('members', function ($allAgent){
                $count = empty($allAgent->countMember)?0:$allAgent->countMember;
                return "<a class='tag-green' href='/back/control/userManage/user?id=".$allAgent->a_id."'>".$count."</a>";
            })
            ->editColumn('agentCount', function ($allAgent){
                $count = empty($allAgent->countAgent)?0:$allAgent->countAgent;
                return "<a class='tag-gary' href='/back/control/userManage/agent?agentId=".$allAgent->a_id."'>".$count."</a>";
            })
            ->editColumn('balance', function ($allAgent){
                if($allAgent->balance == 0)
                {
                    return "<span class='tag-gary'>".$allAgent->balance."</span>";
                } else {
                    return "<span class='tag-gary have-money'>".$allAgent->balance."</span>";
                }
            })
            ->editColumn('model', function ($allAgent) use($modelStatus){
                return " <span class='gary-text'>(".$modelStatus[$allAgent->modelStatus].")</span>";
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
                if($allAgent->status == 0){
                    return '<span class="status-2"><i class="iconfont">&#xe656;</i> 待审核</span>';
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
            ->editColumn('control', function ($allAgent) use ($adminRole){
                if($allAgent->usertype == 8888)
                {
                    if($adminRole ==  1)
                        return '<span class="edit-link" onclick="exportMemberSuper(\''.$allAgent->a_id.'\',\''.$allAgent->account.'\')"><i class="iconfont">&#xe818;</i> 导出会员</span> | 
                                <span class="edit-link" onclick="visitMemberSuper(\''.$allAgent->a_id.'\',\''.$allAgent->account.'\')"><i class="iconfont">&#xe818;</i> 回访会员</span>';
                    else
                        return "系统默认-无法操作";
                }else if($allAgent->status == 0){
                    if(in_array('ac.ad.checkAgent',$this->permissionArray))
                        return  "<ul class='control-menu'>
                            <li onclick='pass(". $allAgent->a_id .")'>通过</li>
                            <li onclick='error(". $allAgent->a_id .")'>驳回</li>
                            <ul>";
                    return '';
                }else {
                    $str = "<ul class='control-menu'>";
                    if(in_array('m.agent.edit',$this->permissionArray))
                        $str .= "<li onclick='edit(\"$allAgent->a_id\")'>修改</li>";
                    if(in_array('m.agent.viewDetails',$this->permissionArray))
                        $str .= "<li onclick='viewInfo(\"$allAgent->a_id\")'>详情</li>";
                    if(in_array('m.agent.editMoney',$this->permissionArray))
                        $str .= "<li onclick='changeAgentMoney(\"$allAgent->a_id\")'>修改余额</li>";
                    if(env('TEST',0) == 1 && env('AGENT_MODEL',1) == 2){
                        if(in_array('m.agent.capitalDetails',$this->permissionArray))
                            $str .= "<li onclick='capital(\"$allAgent->a_id\")'>资金明细</li>";
                    }
                    $gd = "<li>更多操作
                        <ul>";
                    $j = false;
                    if($allAgent->modelStatus == 1) {
                        $agentLevel = empty($allAgent->odds_level) ? 1 : $allAgent->odds_level;
                        if(in_array('ac.ad.gameAgentOddsLook',$this->permissionArray)) {
                            $gd .= "<li onclick='panSetting(\"$allAgent->a_id\")'>盘口设定</li>";
                            $j = true;
                        }
                    }else if($allAgent->modelStatus == 3){
                        if(in_array('ac.ad.gameAgentOddsLook',$this->permissionArray)) {
                            $gd .= "<li onclick='panSettingOne(\"$allAgent->a_id\")'>盘口设定</li>";
                            $j = true;
                        }
                    }
                    if(env('TEST',0) == 1 && env('AGENT_MODEL',1) == 2) {
                        if ($allAgent->modelStatus == 1){
                            if(in_array('m.agent.add',$this->permissionArray)) {
                                $gd .= "<li onclick='changeAgentOdds(\"$allAgent->a_id\")'>修改盘口</li>";
                                $j = true;
                            }
//                            if(in_array('m.agent.add',$this->permissionArray)) {
//                                $gd .= "<li onclick='addAgent(\"$allAgent->a_id\")'>添加子代理</li>";
//                                $j = true;
//                            }
                        }
                    }
                    if(in_array('member.exportMember',$this->permissionArray)) {
                        $gd .= "<li onclick='exportMember(\"$allAgent->a_id\",\"$allAgent->account\")'>导出会员</li>";
                        $j = true;
                    }
//                    $gd .= "<li onclick='visitMember(\"$allAgent->a_id\",\"$allAgent->account\")'>回访会员</li>";
                    if(in_array('m.agent.del',$this->permissionArray)) {
                        $gd .= "<li class='red-hover' onclick='del(\"$allAgent->a_id\",\"$allAgent->account\")'>删除代理</li>";
                        $j = true;
                    }
                    $gd .= "</ul>
                        </li>";
                    if($j) $str .= $gd;
                    $str .= "</ul>";
                    return $str;
                    $html = "<ul class='control-menu'>
                        <li onclick='edit(\"$allAgent->a_id\")'>修改</li>
                        <li onclick='viewInfo(\"$allAgent->a_id\")'>详情</li>
                        <li onclick='changeAgentMoney(\"$allAgent->a_id\")'>修改余额</li>";
                    if(env('TEST',0) == 1 && env('AGENT_MODEL',1) == 2)
                        $html .= "<li onclick='capital(\"$allAgent->a_id\")'>资金明细</li>";
                    $html .= "<li>更多操作
                        <ul>";
                    if($allAgent->modelStatus == 1) {
                        $agentLevel = empty($allAgent->odds_level) ? 1 : $allAgent->odds_level;
                        $html .= "<li onclick='panSetting(\"$agentLevel\")'>盘口设定</li>";
                    }else if($allAgent->modelStatus == 3){
                        $html .= "<li onclick='panSettingOne(\"$allAgent->a_id\")'>盘口设定</li>";
                    }
                    if(env('TEST',0) == 1 && env('AGENT_MODEL',1) == 2) {
                        if ($allAgent->modelStatus == 1)
                            $html .= "<li onclick='addAgent(\"$allAgent->a_id\")'>添加子代理</li>";
                    }
                    $html .= "<li onclick='exportMember(\"$allAgent->a_id\",\"$allAgent->account\")'>导出会员</li>
                        <li onclick='visitMember(\"$allAgent->a_id\",\"$allAgent->account\")'>回访会员</li>
                        <li class='red-hover' onclick='del(\"$allAgent->a_id\",\"$allAgent->account\")'>删除代理</li>
                        </ul>
                        </li>
                        </ul>";

                    return $html;
                }
            })
            ->rawColumns(['online','agent','members','balance','status','editOdds','content','control','model','agentCount'])
            ->setTotalRecords($countAgent[0]->count)
            ->skipPaging()
            ->make(true);
    }

    //代理的资金明细
    public function agentCapital($id, Request $request)
    {
        $aParam = $request->all();
        $capitalModel = CapitalAgent::where(function($q) use($aParam){
            if(isset($aParam['capital_type']) && array_key_exists('capital_type',$aParam))
                $q->where('capital_agent.type',$aParam['capital_type']);
            if(isset($aParam['issue']) && array_key_exists('issue',$aParam))
                $q->where('capital_agent.issue',$aParam['issue']);
            if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam))
                $q->where('capital_agent.created_at','>=',$aParam['startTime']);
            if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam))
                $q->where('capital_agent.created_at','<=',aParam['endTime'].' 23:59:59');
        })->where('capital_agent.agent_id',$id);
        $capitalCount = $capitalModel->count();
        $capital = $capitalModel->select('capital_agent.type','capital_agent.money','capital_agent.order_id','capital_agent.balance','capital_agent.issue','capital_agent.game_id','capital_agent.play_type','capital_agent.game_name','capital_agent.created_at','capital_agent.content','sub_account.account as sub_account','sub_account.name as sub_name')
            ->leftJoin('sub_account','sub_account.sa_id','=','capital_agent.operation_id')
            ->orderBy('capital_agent.created_at','desc')->skip($aParam['start'])->take($aParam['length'])->get();

        $playTypeOption = CapitalAgent::$playTypeOption;
        return DataTables::of($capital)
            ->editColumn('type', function($capital) use($playTypeOption){
                return $playTypeOption[$capital->type];
            })
            ->editColumn('money', function($capital){
                if($capital->money < 0)
                    return '<span class="green-text">'.$capital->money.'</span>';
                return '<span class="red-text">'.$capital->money.'</span>';
            })
            ->editColumn('balance', function($capital){
                return '<span class="blue-text">'.$capital->balance.'</span>';
            })
            ->editColumn('issue', function ($capital){
                if(empty($capital->issue))
                    return "-";
                return $capital->issue;
            })
            ->editColumn('game', function ($capital){
                if(empty($capital->game_name))
                    return "-";
                return $capital->game_name;
            })
            ->editColumn('play_type', function ($capital){
                if(empty($capital->play_type))
                    return "-";
                return $capital->play_type;
            })
            ->editColumn('operation', function ($capital){
                if(empty($capital->sub_account))
                    return '-';
                return $capital->sub_account."(".$capital->sub_name.")";
            })
            ->editColumn('content', function ($capital){
                if(empty($capital->content))
                    return '-';
                return $capital->content;
            })
            ->rawColumns(['money','balance'])
            ->setTotalRecords($capitalCount)
            ->skipPaging()
            ->make(true);
    }

    //代理的返水明细
    public function agentBackwater($id, Request $request)
    {
        $aParam = $request->all();
        $capitalModel = AgentBackwater::where(function($aSql) use($aParam){
            if(isset($aParam['issue']) && array_key_exists('issue',$aParam))
                $aSql->where('agent_backwater.issue',$aParam['issue']);
            if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam))
                $aSql->where('agent_backwater.game_id',$aParam['game_id']);
            if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam))
                $aSql->where('agent_backwater.created_at','>=',$aParam['timeStart']);
            if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam))
                $aSql->where('agent_backwater.created_at','<=',$aParam['timeEnd'].' 23:59:59');
        })->where('agent_backwater.agent_id',$id);
        $capitalCount = $capitalModel->count();
        $capital = $capitalModel->select('agent_backwater.*','users.username','users.fullName','game.game_name')
            ->leftJoin('users','users.id','=','agent_backwater.user_id')->leftJoin('game','game.game_id','=','agent_backwater.game_id')
            ->skip($aParam['start'])->take($aParam['length'])->get();

        $agentBackwaterStatus = AgentBackwater::$agentBackwaterStatus;
        return DataTables::of($capital)
            ->editColumn('status', function($capital) use($agentBackwaterStatus){
                return $agentBackwaterStatus[$capital->status];
            })
            ->editColumn('money', function($capital){
                if($capital->money < 0)
                    return '<span class="green-text">'.$capital->money.'</span>';
                return '<span class="red-text">'.$capital->money.'</span>';
            })
            ->editColumn('user', function($capital){
                return $capital->username.'('.$capital->fullName.')';
            })
            ->editColumn('game_name', function ($capital){
                if(empty($capital->game_name))
                    return "-";
                return $capital->game_name;
            })
            ->rawColumns(['money'])
            ->setTotalRecords($capitalCount)
            ->skipPaging()
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
        $bank = $request->get('bank');
        $minMoney = $request->get('minMoney');
        $maxMoney = $request->get('maxMoney');
        $promoter = $request->get('promoter');
        $noLoginDays = $request->get('noLoginDays');
        $killTestUser = $request->get('killTestUser');
        $aid = $request->get('aid');    //代理id
        $gaid = $request->get('gaid');    //总代id
        $start = empty($request->get('start'))?0:$request->get('start');
        $length = empty($request->get('length'))?50:$request->get('length');

        $sql1 = 'select id,agent,testFlag,users.bank_num AS user_bank_num,users.mobile as user_mobile,users.qq as user_qq,users.promoter as user_promoter ,users.id as uid,users.rechLevel as user_rechLevel,users.created_at as user_created_at,users.updated_at as user_updated_at,users.username as user_username,users.email as user_email,users.fullName as user_fullName,users.money as user_money,users.status as user_status,users.PayTimes as user_PayTimes,users.DrawTimes as user_DrawTimes,users.saveMoneyCount as user_saveMoneyCount,users.drawMoneyCount as user_drawMoneyCount,users.lastLoginTime as user_lastLoginTime,users.content as user_content 
                        from users ';

        $where = ' where 1 ';
        $order = '';
        if(isset($killTestUser) && $killTestUser){
            $where .= ' and users.testFlag = 0 ';
        }else{
            $where .= ' and users.testFlag in (0,2) ';
        }
        if(isset($bank) && $bank){
            $userArr = DB::table('user_bank')->where('cardNo',$bank)->pluck('user_id')->toArray();
            $or = '';
            if($userArr){
                $or = ' OR id IN( '. implode(',',$userArr) .' )';
            }
            $where .= ' AND ( bank_num = "' . $bank .'"'. $or . ' ) ';
        }
        if(isset($status) && $status){
            $where .=' and status = ' .$status;
        }
        if(isset($gaid) && $gaid>0){
            $aAgentId = Agent::getAgentIdArrayByGId($gaid);
            $where .= ' and agent in('.implode(',',$aAgentId).') ';
        }
        if(isset($aid) && $aid>0){
            $where .= ' and agent = '.$aid;
        }
        if(isset($agent) && $agent){
            $where .= ' and agent = '.$agent;
        }
        if(isset($rechLevel) && $rechLevel != ''){
            $where .= ' and rechLevel = '. $rechLevel;
        }
        if(isset($account) && $account){
            $where .= " AND (username = '".$account ."'";
            $where .= " OR email = '".$account ."'";
            $where .= " OR fullName = '".$account ."')";
        }
        if(isset($mobile) && $mobile){
            $where .= " AND mobile = '".$mobile."'";
        }
        if(isset($qq) && $qq){
            $where .= " AND qq = '".$qq."'";
        }
        if(isset($minMoney) && $minMoney ){
            $where .= ' AND money >= '.(float)$minMoney;
            $order .= 'u_fileds.user_money desc,';
        }
        if(isset($maxMoney) && $maxMoney ){
            $where .= ' AND money <= '.(float)$maxMoney;
            $order .= 'u_fileds.user_money desc,';
        }
        if(isset($promoter) && $promoter ){
            $userId = Users::where('username',$promoter)->value('id');
            $where .= ' AND promoter = \''.$userId.'\'';
        }
        if(isset($noLoginDays)){
            $order .= 'u_fileds.user_lastLoginTime desc,';
            $where .= ' AND lastLoginTime <= "'.date('Y-m-d 23:59:59',strtotime('-'.$noLoginDays.' day')).'"';
        }

        $sql = ' FROM ( '.$sql1.$where.'  ORDER BY rechLevel asc, id desc '.'LIMIT '.$start.','.$length.') u_fileds ';
        $sql .= 'left Join (SELECT name as level_name,value FROM level) lv on u_fileds.user_rechLevel = lv.value 
            left Join (SELECT a_id,account as ag_account,gagent_id FROM agent) ag on u_fileds.agent = ag.a_id  
            left Join users as p_Users on p_Users.id = u_fileds.user_promoter 
             		ORDER BY
		                user_rechLevel asc,'.$order.' u_fileds.id desc ';
        $users = DB::select('select u_fileds.*,lv.*,ag.*,p_Users.username as pusername,p_Users.fullName as pfullName  '.$sql);
//        var_dump('select u_fileds.*,lv.*,ag.*,p_Users.username as pusername,p_Users.fullName as pfullName  '.$sql);die();
        $usersCount = DB::select('select count(id) AS count from users '.$where);
        $TotalMoney = DB::select('select SUM(money) AS money from users '.$where);
        return DataTables::of($users)
            ->with('TotalMoney',$TotalMoney[0]->money ?? 0)
            ->editColumn('online',function ($users) {
                $redis = Redis::connection();
                $redis->select(2);
                $key = 'user:'.md5($users->uid);
                if($redis->exists($key)) {
                    $redisUser = $redis->get($key);
                    $redisUser = (array)json_decode($redisUser,true);
                    if(isset($redisUser['user_session_id'])){
                        $redis->select(6);
                        if($redis->exists('urtime:'.$redisUser['user_session_id'])){
                            return "<span class='on-line-point'></span>";
                        }
                    }
                }
                return "<span class='off-line-point'></span>";
            })
            ->editColumn('promoter',function ($users){
                return empty($users->pusername) ? '无' : ($users->pusername.'('.$users->pfullName.')');
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
                $str = "<ul class='control-menu'>";
                if(in_array('m.user.edit',$this->permissionArray))
                    $str .= "<li onclick='edit(".$users->uid.")'>修改</li>";
                if(in_array('m.user.changeBalance',$this->permissionArray))
                    $str .= "<li onclick='changeUserMoney(\"$users->uid\")'>余额变更</li>";
                if(in_array('m.user.viewDetails',$this->permissionArray))
                    $str .= "<li><a href='/back/control/userManage/userBetList/$users->uid' target='_blank'>注单明细</a></li>";
                $str .= "<li onclick='userCapital(\"$users->uid\")'>资金明细</li>";

                $gd =  '<li>更多操作
                        <ul>';
                $j = false;
                if(in_array('m.user.viewUserInfo',$this->permissionArray)) {
                    $gd .= "<li onclick='viewInfo(\"$users->uid\")'>查看详情</li>";
                    $j = true;
                }
                if(in_array('m.user.editTrueName',$this->permissionArray)) {
                    $gd .= "<li onclick='changeFullName(\"$users->uid\")'>修改姓名</li>";
                    $j = true;
                }
                if(in_array('m.user.changeAgent',$this->permissionArray)) {
                    $gd .= "<li onclick='changeAgent(\"$users->uid\",\"$users->user_username\")'>更换代理</li>";
                    $j = true;
                }
                if(in_array('game.tradeSetting',$this->permissionArray)) {
                    $gd .= "<li class='red-hover' onclick='setPlay(\"$users->uid\")'>个人交易</li>";
                    $j = true;
                }
                if(in_array('m.user.delUser',$this->permissionArray)) {
                    $gd .= "<li class='red-hover' onclick='delUser(\"$users->uid\",\"$users->user_username\")'>删除会员</li>";
                    $j = true;
                }
                $gd .= '</ul>
                        </li>';
                if($j) $str .= $gd;

                if(in_array('m.user.GamesApi',$this->permissionArray)) {
                    $str .= '<li onclick=\'GamesApi('.$users->uid.')\'>第三方游戏</li>';
                }
                if(Session::get('account') == 'admin'){
                    $str .= '<li onclick=\'allDown('.$users->uid.')\'>下所有分</li>';
                }

                $str .= "</ul>";
                return $str;


//                return "<ul class='control-menu'>
//                        <li onclick='edit(\"$users->uid\")'>修改</li>
//                        <li onclick='changeUserMoney(\"$users->uid\")'>余额变更</li>
//                        <li><a href='/back/control/userManage/userBetList/$users->uid' target='_blank'>注单明细</a></li>
//                        <li onclick='userCapital(\"$users->uid\")'>资金明细</li>
//                        <li>更多操作
//                        <ul>
//                        <li onclick='viewInfo(\"$users->uid\")'>查看详情</li>
//                        <li onclick='changeFullName(\"$users->uid\")'>修改姓名</li>
//                        <!-- <li>盘口设定</li>
//                        <li>交易设定</li> -->
//                        <li onclick='changeAgent(\"$users->uid\",\"$users->user_username\")'>更换代理</li>
//                        <li class='red-hover' onclick='delUser(\"$users->uid\",\"$users->user_username\")'>删除会员</li>
//                        </ul>
//                        </li>
//                        </ul>";
            })
            ->rawColumns(['online','user','balance','status','control','created_at','updated_at','content','rechLevel','saveMoneyCount','drawMoneyCount'])
            ->setTotalRecords($usersCount[0]->count)
            ->skipPaging()
            ->make(true);
    }

    //会员统计查看
    public function userTotal(){
        //统计会员数据
        $allUser = DB::table('users')->where('testFlag',0)->count();
        $todayRegUsers = DB::table('users')->where('testFlag',0)->whereDate('created_at',date('Y-m-d'))->count();
        $yesterday = Carbon::now()->addDays(-1)->toDateString();
        $yesterdayRegUsers = DB::table('users')->where('testFlag',0)->whereDate('created_at',$yesterday)->count();
        $monthRegUsers = DB::table('users')->where('testFlag',0)->whereRaw('DATE_FORMAT(created_at, "%Y%m" ) = DATE_FORMAT( CURDATE( ) , "%Y%m" )')->count();
        $lastMonthRegUsers = DB::table('users')->where('testFlag',0)->whereRaw('PERIOD_DIFF( date_format( now( ) , "%Y%m" ) , date_format( created_at, "%Y%m" ) ) =1')->count();
//        $todayRechargesUser = DB::table('users')->where('testFlag',0)->where('PayTimes',1)->whereDate('created_at',date('Y-m-d'))->count();
        $todayRechargesUser = \App\Recharges::todayRechargesUser();
        $yesterdayRechargesUser = DB::table('users')->where('testFlag',0)->where('PayTimes',1)->whereDate('created_at',Carbon::now()->addDays(-1)->toDateString())->count();
        $monthRechargesUser = DB::table('users')->where('testFlag',0)->where('PayTimes',1)->whereRaw('DATE_FORMAT(created_at, "%Y%m" ) = DATE_FORMAT( CURDATE( ) , "%Y%m" )')->count();
        return response()->json([
            'allUser' => $allUser,
            'todayRegUsers' => $todayRegUsers,
            'yesterdayRegUsers' => $yesterdayRegUsers,
            'monthRegUsers' => $monthRegUsers,
            'lastMonthRegUsers' => $lastMonthRegUsers,
            'todayRechargesUser' => $todayRechargesUser,
            'yesterdayRechargesUser' => $yesterdayRechargesUser,
            'monthRechargesUser' => $monthRechargesUser,
        ]);
    }

    //用户资金明细
    public function userCapital($id,Request $request)
    {
        $param = $request->all();
        $param['type'] = $request->get('capital_type');
        $param['startTime'] = $request->get('startTime');
        $param['endTime'] = $request->get('endTime');
        $param['recharges_id'] = $request->get('recharges_id');
        $param['account_id'] = $id;
        $start = $request->get('start');
        $length = $request->get('length');
        $aSql = "SELECT SUM(CASE WHEN `payType` = 'onlinePayment' THEN `amount` ELSE 0 END) AS `payOnline`,
                  SUM(CASE WHEN `payType` IN ('bankTransfer','alipay','weixin','cft') THEN `amount` ELSE 0 END) AS `payOffline`,
                  SUM(CASE WHEN `payType` = 'adminAddMoney' THEN `amount` ELSE 0 END) AS `payManual`,
                  SUM(`rebate_or_fee`) AS `payFormalities` FROM `recharges` WHERE `userId` = $id AND `status` = 2";

        $aBetSql = "SELECT sum(case WHEN `game_id` in (90,91) then `nn_view_money` else(case when `bunko` >0 then `bunko` - `bet_money` else `bunko` end)end) as `payBetting` FROM `bet` WHERE `user_id` = $id";
        $aBet_hisSql = "SELECT sum(case WHEN `game_id` in (90,91) then `nn_view_money` else(case when `bunko` >0 then `bunko` - `bet_money` else `bunko` end)end) as `payBetting` FROM `bet_his` WHERE `user_id` = $id";

        $aDrawingSql = "SELECT SUM(`amount`) AS `payDrawing` FROM `drawing` WHERE status = 2 AND `user_id` = $id ";
        if(isset($param['startTime']) && array_key_exists('startTime', $param)){
            $aSql .= " AND `updated_at` >= '".$param['startTime']."'";
            $aBetSql .= " AND `created_at` >= '".$param['startTime']."'";
            $aBet_hisSql .= " AND `created_at` >= '".$param['startTime']."'";
            $aDrawingSql .= " AND `updated_at` >= '".$param['startTime']."'";
        }
        if(isset($param['endTime']) && array_key_exists('endTime', $param)){
            $aSql .= " AND `updated_at` <= '".$param['endTime']." 23:59:59'";
            $aBetSql .= " AND `created_at` <= '".$param['endTime']." 23:59:59'";
            $aDrawingSql .= " AND `updated_at` <= '".$param['endTime']." 23:59:59'";
            $aBet_hisSql .= " AND `created_at` <= '".$param['endTime']." 23:59:59'";
        }
        $aBetSql = "SELECT SUM(`payBetting`) AS `payBetting` FROM (
          ({$aBetSql}) UNION ALL ({$aBet_hisSql}) 
        ) AS a ";
        $payRecharges = DB::select($aSql)[0];
        $payBet = DB::select($aBetSql)[0];
        $payDrawing = DB::select($aDrawingSql)[0];
        $payFunds = [
            'payOnline' => empty($payRecharges->payOnline)?0:$payRecharges->payOnline,
            'payManual' => empty($payRecharges->payManual)?0:$payRecharges->payManual,
            'payOffline' => empty($payRecharges->payOffline)?0:$payRecharges->payOffline,
            'payFormalities' => empty($payRecharges->payFormalities)?0:$payRecharges->payFormalities,
            'payBetting' => empty($payBet->payBetting)?0:$payBet->payBetting,
            'payDrawing' => empty($payDrawing->payDrawing)?0:$payDrawing->payDrawing,
            'payBalance' => DB::table('users')->where('id',$id)->value('money'),
        ];
        if(isset($param['type']) && array_key_exists('type', $param)){
            if(in_array($param['type'],Capital::$includePlayTypeOption)){
                $aBetHis = '';
                $aBets = '';
                $aBetHisCount = 0;
                $aBetsCount = 0;
                if(strtotime($param['startTime']) >= strtotime(date('Y-m-d',strtotime('-1 day')))){
                    $aBets = Bets::AssemblyFundDetails($param);
                    $aBetsCount = $aBets->count();
                }else{
                    $aBetHis = BetHis::AssemblyFundDetails($param);
                    $aBetHisCount = $aBetHis->count();
                }
                if(strtotime($param['endTime']) < strtotime(date('Y-m-d',strtotime('-1 day')))) {
                    if(empty($aBetHis)){
                        $aBetHis = BetHis::AssemblyFundDetails($param);
                        $aBetHisCount = $aBetHis->count();
                    }
                }else{
                    if(empty($aBets)){
                        $aBets = Bets::AssemblyFundDetails($param);
                        $aBetsCount = $aBets->count();
                    }
                }
                if(empty($aBetHis) && !empty($aBets)){
                    $capital = $aBets->skip($start)->take($length)->orderBy('created_at','desc')->orderBy('bet_id','desc')->get();
                }elseif(empty($aBets) && !empty($aBetHis)){
                    $capital = $aBetHis->skip($start)->take($length)->orderBy('created_at','desc')->orderBy('bet_id','desc')->get();
                }else{
                    $capital = $aBets->union($aBetHis)->orderBy('created_at','desc')->orderBy('bet_id','desc')->skip($start)->take($length)->get();
                }
                $capitalCount = $aBetHisCount + $aBetsCount;
//                $capital = Bets::AssemblyFundDetails($param);
//                $capitalCount = $capital->count();
//                $capital = $capital->skip($start)->take($length)->get();
            }else if($param['type']=='t01'){        //充值
                $capital = Capital::AssemblyFundDetails_Rech($param);
                $capitalCount = $capital->count();
                $capital = $capital->skip($start)->take($length)->get();
            }else if($param['type']=='t04'){        //返利/手续费
                $capital = Capital::AssemblyFundDetails($param);
                $capitalCount = $capital->count();
                $capital = $capital->skip($start)->take($length)->get();
            }else if($param['type'] === 't15' || $param['type'] === 't17'){        //提现和提现失败
                $capital = Drawing::AssemblyFundDetails($param,$param['type']);
                $capitalCount = $capital->count();
                $capital = $capital->skip($start)->take($length)->get();
            }else{
                $capitalSql = Capital::AssemblyFundDetails($param);
                $capitalCount = $capitalSql->count();
                $capital = $capitalSql->orderBy('bet_id','desc')->skip($start)->take($length)->get();
            }
        }else {
            $capitalSql = Capital::AssemblyFundDetails($param);
            $betsSql = Bets::AssemblyFundDetails($param);
            $betHisSql = BetHis::AssemblyFundDetails($param);
            $RechSql = Capital::AssemblyFundDetails_Rech($param);
            $drawingSql = Drawing::AssemblyFundDetails($param);
            $capitalCount = $capitalSql->count() + $betsSql->count() + $betHisSql->count() + $RechSql->count() + $drawingSql->count();
            $capital = $capitalSql->union($RechSql)->union($betsSql)->union($betHisSql)->union($drawingSql)->orderBy('created_at','desc')->orderBy('bet_id','desc')->skip($start)->take($length);
        }
        $playTypeOptions = Capital::$playTypeOption;
        $rechargesType = Recharges::$rechargesType;

        return DataTables::of($capital)
            ->editColumn('type',function ($capital) use ($playTypeOptions,$rechargesType){
                if(strpos($capital->type,'t') === false) {
                    return $playTypeOptions['t05'];
                }
                if($capital->type === 't18' && !empty($capital->rechargesType)){
                    return $playTypeOptions[$capital->type].'(<span class="red-text">'.$rechargesType[$capital->rechargesType].'</span>)';
                }
                return $playTypeOptions[$capital->type];
            })
            ->editColumn('money', function($capital){
                if($capital->type=='t05') {
                    if ($capital->game_id > 0) {
                        if ($capital->game_id == 90 || $capital->game_id == 91) {
                            if ($capital->nn_view_money < 0)
                                return '<span class="green-text">下注:' . $capital->nn_view_money . '</span>' . '<span class="gary-text">(冻结:' . $capital->freeze_money . ')</span>' . '<span class="gary-text">(解冻:' . $capital->freeze_money . ')</span>';
                            else
                                return '<span class="red-text">下注:' . $capital->nn_view_money . '</span>' . '<span class="gary-text">(冻结:' . $capital->freeze_money . ')</span>' . '<span class="gary-text">(解冻:' . $capital->freeze_money . ')</span>';
                        } else {
                            return '<span class="green-text">-' . $capital->money . '</span>';
                        }
                    } else {
                        if ($capital->money < 0) {
                            return '<span class="green-text">' . $capital->money . '</span>';
                        } else {
                            return '<span class="red-text">' . $capital->money . '</span>';
                        }
                    }
                }else{
                    return '<span class="red-text">' . $capital->money . '</span>';
                }
            })
            ->editColumn('balance', function($capital){
                if(empty($capital->balance))
                {
                    return "-";
                } else {
                    return '<span class="blue-text">'.$capital->balance.'</span>';
                }
            })
            ->editColumn('issue', function ($capital){
                if(empty($capital->issue))
                {
                    return "-";
                } else {
                    return '<span style="color: #'.$capital->account.'">'.$capital->issue.'</span>';
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
                if(empty($capital->playcate_name))
                {
                    return "-";
                } else {
                    return $capital->playcate_name;
                }
            })
            ->editColumn('operation', function ($capital){
                if(!empty($capital->operation_id)){
                    $getSubAccount = SubAccount::find($capital->operation_id);
                    if(empty($getSubAccount))
                        return "-";
                    return $getSubAccount->account."(".$getSubAccount->name.")";
                }else{
                    return "-";
                }
            })
            ->editColumn('content',function ($capital){
                if(empty($capital->content)){
                    return '-';
                }else{
                    if(empty($capital->content2))
                        return $capital->content;
                    else
                        return $capital->content2.'<br>'.$capital->content;
                }
            })
            ->rawColumns(['money','balance','content','issue','type'])
            ->setTotalRecords($capitalCount)
            ->skipPaging()
            ->with('payFunds',$payFunds)
            ->make(true);
    }
    
    //子账号 - 表格数据
    public function subAccounts(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $subAccounts = SubAccount::where('account','!=','admin')->skip($start)->take($length)->get();
        $subAccountsCount = SubAccount::where('account','!=','admin')->count();
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
                    $str = "";
                    if(in_array('m.subAccount.edit',$this->permissionArray))
                        $str .= '<span class="edit-link" onclick="edit(\''.$subAccounts->sa_id.'\')"><i class="iconfont">&#xe602;</i> 修改</span>';
                    if(in_array('m.subAccount.googleOTP',$this->permissionArray))
                        $str .= ' | <span class="edit-link" onclick="google(\''.$subAccounts->sa_id.'\')"><i class="iconfont">&#xe6a9;</i> Google双重验证</span>';
                    if(in_array('ac.ad.delSubAccount',$this->permissionArray))
                        $str .= ' | <span class="edit-link" onclick="del(\''.$subAccounts->sa_id.'\',\''.$subAccounts->account.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
                    return $str;
//                    return '<span class="edit-link" onclick="edit(\''.$subAccounts->sa_id.'\')"><i class="iconfont">&#xe602;</i> 修改</span>
//                          | <span class="edit-link" onclick="google(\''.$subAccounts->sa_id.'\')"><i class="iconfont">&#xe6a9;</i> Google双重验证</span>
//                          | <span class="edit-link" onclick="del(\''.$subAccounts->sa_id.'\',\''.$subAccounts->account.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
                }
            })
            ->rawColumns(['online','status','control'])
            ->setTotalRecords($subAccountsCount)
            ->skipPaging()
            ->make(true);
    }

    //在线会员
    public function onlineUser(Request $request)
    {

        $start = $request->get('start');
        $length = $request->get('length');
        $platform = Session::get('platform');
        $redis = Redis::connection();
        $redis->select(6);
        $keys = $redis->keys('urtime:'.'*');
        $onlineUser = [];
        foreach ($keys as $item){
            $redisUser = $redis->get($item);
            $redisUser = (array)json_decode($redisUser,true);
            if($platform && $platform == $redisUser['platform'] && @$redisUser['user_id'])
                $onlineUser[] = $redisUser['user_id'];
        }
        $user = User::select()
            ->whereIn('id',$onlineUser)->where('testFlag',0)->skip($start)->take($length)->get();
        $userCount = User::whereIn('id',$onlineUser)->where('testFlag',0)->count();
        return DataTables::of($user)
            ->editColumn('online',function (){
                return "<span class='on-line-point'></span>";
            })
            ->editColumn('account',function ($user){
                return '<a href="/back/control/userManage/userBetList/'.$user->id.'" target="_blank">'.$user->username."<span class='gary-text'> (".$user->fullName.")</span>".'</a>';
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
                return "<span class='".$redClass."'><i class='iconfont'>&#xe627;</i> $user->login_ip_info  <span  class=\"refreshIp\"  onclick='refreshIp({$user->id},\"{$user->login_ip}\", this)' >刷新</span></span>";
            })
            ->editColumn('login_client',function ($user){
                return [
                    1 => "<i class='iconfont'>&#xe696;</i> PC端",
                    2 => "<i class='iconfont'>&#xe686;</i> H5端",
                    3 => "<i class='Hui-iconfont'>&#xe64a;</i> IOS",
                    4 => "<i class='Hui-iconfont'>&#xe6a2;</i> Android"
                    ][$user->login_client]??"<i class='Hui-iconfont'>&#xe69c;</i> 其它";
            })
            ->editColumn('control',function ($user){
                if(in_array('ac.ad.getOutUser',$this->permissionArray))
                    return '<span class="edit-link" onclick="getOut(\''.$user->id.'\',\''.$user->username.'\')"><i class="iconfont">&#xeab6;</i> 踢下线</span>';
                return '';
            })
            ->rawColumns(['account','online','status','login_client','control','login_ip_info','login_ip','money'])
            ->setTotalRecords($userCount)
            ->skipPaging()
            ->make(true);
    }
}
