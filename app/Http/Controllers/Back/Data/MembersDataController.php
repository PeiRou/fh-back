<?php

namespace App\Http\Controllers\Back\Data;

use App\Agent;
use App\Bets;
use App\Capital;
use App\Drawing;
use App\GeneralAgent;
use App\Levels;
use App\Recharges;
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
            ->setTotalRecords($agentCount[0]->count)
            ->skipPaging()
            ->make(true);
    }

    //代理 - 表格数据
    public function agent(Request $request)
    {
        $ga_id = $request->get('gaid');
        $start = $request->get('start');
        $length = $request->get('length');
        $params = $request->post();
        $aSql = "SELECT * FROM `agent` WHERE 1 ";
        $cSql = "SELECT COUNT(`a_id`) AS `count` FROM `agent`  WHERE 1";
        $where = "";
        if(isset($ga_id) && $ga_id>0 ){
            $where .= " and gagent_id = ".$ga_id;
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
        $aSql = "SELECT ag.*,`u`.`countMember`,`general_agent`.`account` AS `gAccount` FROM (".$aSql.$where." ORDER BY created_at desc LIMIT ".$start.",".$length.") AS ag 
LEFT JOIN (SELECT COUNT(id) AS countMember,agent FROM `users` WHERE testFlag IN(0,2) GROUP BY `agent`) u on ag.a_id = u.agent 
JOIN `general_agent` ON `general_agent`.`ga_id` = `ag`.`gagent_id` ORDER BY `ag`.`created_at` DESC";
        $allAgent = DB::select($aSql);
        $cSql = $cSql.$where;
        $countAgent = DB::select($cSql);
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
                    return '<span class="edit-link" onclick="edit(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe602;</i> 修改</span> | 
                            <span class="edit-link" onclick="viewInfo(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe818;</i> 详情</span> | 
                            <span class="edit-link" onclick="changeAgentMoney(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe60b;</i> 修改余额</span> | 
                            <span class="edit-link" onclick="capital(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe67e;</i> 资金明细</span> | 
                            <span class="edit-link" onclick="panSetting(\''.$allAgent->a_id.'\')"><i class="iconfont">&#xe6dd;</i> 盘口设定</span> | 
                            <span class="edit-link" onclick="exportMember(\''.$allAgent->a_id.'\',\''.$allAgent->account.'\')"><i class="iconfont">&#xe818;</i> 导出会员</span> | 
                            <span class="edit-link" onclick="visitMember(\''.$allAgent->a_id.'\',\''.$allAgent->account.'\')"><i class="iconfont">&#xe818;</i> 回访会员</span> | 
                            <span class="edit-link" onclick="del(\''.$allAgent->a_id.'\',\''.$allAgent->account.'\')"><i class="iconfont">&#xe600;</i> 删除</span>';
                }
            })
            ->rawColumns(['online','agent','members','balance','status','editOdds','content','control'])
            ->setTotalRecords($countAgent[0]->count)
            ->skipPaging()
            ->make(true);
    }

    //代理的资金明细
    public function agentCapital($id, Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');
        $capitalType = $request->get('capital_type');
        $issue = $request->get('issue');
        $startTime = strtotime($request->get('startTime').' 00:00:00');
        $endTime = strtotime($request->get('endTime').' 23:59:59');
        $loginId = Session::get('account_id');
        $capitalModel = Capital::where(function($q) use($startTime,$endTime,$capitalType,$issue,$loginId,$id){
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
        });
        $capital = $capitalModel->orderBy('created_at','desc')->skip($start)->take($length)->get();
        $capitalCount = $capitalModel->count();

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
        $minMoney = $request->get('minMoney');
        $maxMoney = $request->get('maxMoney');
        $promoter = $request->get('promoter');
        $noLoginDays = $request->get('noLoginDays');
        $aid = $request->get('aid');    //代理id
        $gaid = $request->get('gaid');    //总代id
        $start = empty($request->get('start'))?0:$request->get('start');
        $length = empty($request->get('length'))?50:$request->get('length');

        $sql = ' FROM (select id ,agent,testFlag,users.mobile as user_mobile,users.qq as user_qq,users.promoter as user_promoter ,users.id as uid,users.rechLevel as user_rechLevel,users.created_at as user_created_at,users.updated_at as user_updated_at,users.username as user_username,users.email as user_email,users.fullName as user_fullName,users.money as user_money,users.status as user_status,users.PayTimes as user_PayTimes,users.DrawTimes as user_DrawTimes,users.saveMoneyCount as user_saveMoneyCount,users.drawMoneyCount as user_drawMoneyCount,users.lastLoginTime as user_lastLoginTime,users.content as user_content  from users ) u_fileds 
            left Join (SELECT name as level_name,value FROM level) lv on u_fileds.user_rechLevel = lv.value 
            left Join (SELECT a_id,account as ag_account,gagent_id FROM agent) ag on u_fileds.agent = ag.a_id  where 1 and testFlag in(0,2) ';

        if(isset($status) && $status){
            $sql .=' and users.status = ' .$status;
        }
        if(isset($gaid) && $gaid>0){
            $sql .= ' and ag.gagent_id = '.$gaid;
        }
        if(isset($aid) && $aid>0){
            $sql .= ' and u_fileds.agent = '.$aid;
        }
        if(isset($agent) && $agent){
            $sql .= ' and u_fileds.agent = '.$agent;
        }
        if(isset($rechLevel) && $rechLevel){
            $sql .= ' and u_fileds.user_rechLevel = '. $rechLevel;
        }
        if(isset($account) && $account){
            $sql .= " AND (u_fileds.user_username = '".$account ."'";
            $sql .= " OR u_fileds.user_email = '".$account ."'";
            $sql .= " OR u_fileds.user_fullName = '".$account ."')";
        }
        if(isset($mobile) && $mobile){
            $sql .= " AND u_fileds.user_mobile = '".$mobile."'";
        }
        if(isset($qq) && $qq){
            $sql .= " AND u_fileds.user_qq = '".$qq."'";
        }
        if(isset($minMoney) && $minMoney ){
            $sql .= ' AND u_fileds.user_money >= '.$minMoney;
        }
        if(isset($maxMoney) && $maxMoney ){
            $sql .= ' AND u_fileds.user_money <= '.$maxMoney;
        }
        if(isset($promoter) && $promoter ){
            $sql .= ' AND u_fileds.user_promoter = '.$promoter;
        }
        if(isset($noLoginDays) && $noLoginDays ){
            $sql .= ' AND u_fileds.user_lastLoginTime <= "'.date('Y-m-d 23:59:59',strtotime('-'.$noLoginDays.' day')).'"';
        }
        $users = DB::select('select * '.$sql.'  ORDER BY id desc '.'LIMIT '.$start.','.$length);
        $usersCount = DB::select('select count(id) AS count '.$sql);
        return DataTables::of($users)
            ->editColumn('online',function ($users) {
//                $key = 'user:'.md5($users->uid);
//                if(Redis::exists($key)){
//                    return "<span class='on-line-point'></span>";
//                } else {
//                    return "<span class='off-line-point'></span>";
//                }
                return "<span class='off-line-point'></span>";
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
            ->setTotalRecords($usersCount[0]->count)
            ->skipPaging()
            ->make(true);
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
                  SUM(CASE WHEN `payType` IN ('bankTransfer','alipay','wechat','cft') THEN `amount` ELSE 0 END) AS `payOffline`,
                  SUM(CASE WHEN `payType` = 'adminAddMoney' THEN `amount` ELSE 0 END) AS `payManual`,
                  SUM(`rebate_or_fee`) AS `payFormalities` FROM `recharges` WHERE `userId` = $id AND `status` = 2";

        $aBetSql = "SELECT sum(case WHEN `game_id` in (90,91) then `nn_view_money` else(case when `bunko` >0 then `bunko` - `bet_money` else `bunko` end)end) as `payBetting` FROM `bet` WHERE `user_id` = $id";

        $aDrawingSql = "SELECT SUM(`amount`) AS `payDrawing` FROM `drawing` WHERE status = 2 AND `user_id` = $id ";
        if(isset($param['startTime']) && array_key_exists('startTime', $param)){
            $aSql .= " AND `created_at` >= '".$param['startTime']."'";
            $aBetSql .= " AND `created_at` >= '".$param['startTime']."'";
            $aDrawingSql .= " AND `created_at` >= '".$param['startTime']."'";
        }
        if(isset($param['endTime']) && array_key_exists('endTime', $param)){
            $aSql .= " AND `created_at` <= '".$param['endTime']." 23:59:59'";
            $aBetSql .= " AND `created_at` <= '".$param['endTime']." 23:59:59'";
            $aDrawingSql .= " AND `created_at` <= '".$param['endTime']." 23:59:59'";
        }
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
        ];
        if(isset($param['type']) && array_key_exists('type', $param)){
            if(in_array($param['type'],Capital::$includePlayTypeOption)){
                $capital = Bets::AssemblyFundDetails($param);
                $capitalCount = $capital->count();
                $capital = $capital->skip($start)->take($length)->get();
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
                $capital = $capitalSql->orderBy('bet_id','desc')->skip($start)->take($length)->get();
                $capitalCount = $capitalSql->count();
            }
        }else {
            $capitalSql = Capital::AssemblyFundDetails($param);
            $betsSql = Bets::AssemblyFundDetails($param);
            $RechSql = Capital::AssemblyFundDetails_Rech($param);
            $drawingSql = Drawing::AssemblyFundDetails($param);
            $capitalCount = $capitalSql->count() + $betsSql->count() + $RechSql->count() + $drawingSql->count();
            $capital = $capitalSql->union($RechSql)->union($betsSql)->union($drawingSql)->orderBy('created_at','desc')->orderBy('bet_id','desc')->skip($start)->take($length);
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
                if($capital->game_id>0){
                    if($capital->game_id ==90 || $capital->game_id ==91){
                        if($capital->nn_view_money < 0)
                            return '<span class="green-text">下注:'.$capital->nn_view_money.'</span>'.'<span class="gary-text">(冻结:'.$capital->freeze_money.')</span>'.'<span class="gary-text">(解冻:'.$capital->freeze_money.')</span>';
                        else
                            return '<span class="red-text">下注:'.$capital->nn_view_money.'</span>'.'<span class="gary-text">(冻结:'.$capital->freeze_money.')</span>'.'<span class="gary-text">(解冻:'.$capital->freeze_money.')</span>';
                    }else{
                        return '<span class="green-text">-'.$capital->money.'</span>';
                    }
                }else{
                    if($capital->money < 0)
                    {
                        return '<span class="green-text">'.$capital->money.'</span>';
                    } else {
                        return '<span class="red-text">'.$capital->money.'</span>';
                    }
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
        $subAccounts = SubAccount::skip($start)->take($length)->get();
        $subAccountsCount = SubAccount::count();
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
            ->setTotalRecords($subAccountsCount)
            ->skipPaging()
            ->make(true);
    }

    //在线会员
    public function onlineUser(Request $request)
    {

        $start = $request->get('start');
        $length = $request->get('length');
        $redis = Redis::connection();
        $redis->select(6);
        $keys = $redis->keys('urtime:'.'*');
        $onlineUser = [];
        foreach ($keys as $item){
            $redisUser = $redis->get($item);
            $redisUser = (array)json_decode($redisUser,true);
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
            ->setTotalRecords($userCount)
            ->skipPaging()
            ->make(true);
    }
}
