<?php

namespace App\Http\Controllers\Back\Data;

use App\BetHis;
use App\Bets;
use App\Games;
use App\Play;
use App\PlayCates;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BetDataController extends Controller
{
    public function betTodayRes($request, $start, $length){
        $res = $this->req($request,$start, $length,'today');
        $bet = $res['bet'];
        $betCount = $res['betCount'];
        $betMoney = $res['betMoney'];
        $currentIssue = '';
        $currentColor = '';
        $betModel = new Bets();
//        p($betMoney, 1);
        return DataTables::of($bet)
            ->editColumn('order_id',function ($bet){
                return $bet->bet_order_id;
            })
            ->editColumn('created_at',function ($bet){
                return $bet->bet_created_at;
            })
            ->editColumn('user',function ($bet){
                if($bet->users_username){
                    return $bet->users_username;
                } else {
                    return "<span class='red-text'>用户不存在,请核实</span>";
                }
            })
            ->editColumn('game',function ($bet){
                return $bet->game_game_name;
            })
            ->editColumn('issue',function ($bet) use(&$currentIssue,&$currentColor,$betModel){
                if($currentIssue != $bet->bet_issue){
                    $currentIssue = $bet->bet_issue;
                    $currentColor = $this->getRandColor($currentColor,$bet->bet_color,$betModel);
                }
                return '<span style="color: #'.$currentColor.'">'.$bet->bet_issue.'</span> 期';
            })
            ->editColumn('play',function ($bet){
                return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span> <span>$bet->bet_bet_info</span>";
            })
            ->editColumn('agnet_odds',function ($bet){
                if($bet->bet_agnet_odds == ""){
                    return "--";
                } else {
                    return $bet->bet_agnet_odds;
                }
            })
            ->editColumn('agent_rebate',function ($bet){
                if($bet->bet_agent_rebate == ""){
                    return "--";
                } else {
                    return $bet->bet_agent_rebate;
                }
            })
            ->editColumn('platform',function ($bet){
                if($bet->bet_platform == 1){
                    return "<i class='iconfont'>&#xe696;</i> PC端";
                } else if($bet->bet_platform == 2){
                    return "<i class='iconfont'>&#xe686;</i> H5端";
                } else if($bet->bet_platform == 3){
                    return "<i class='Hui-iconfont'>&#xe64a;</i> IOS";
                } else if($bet->bet_platform == 4){
                    return "<i class='Hui-iconfont'>&#xe6a2;</i> Android";
                } else {
                    return "<i class='Hui-iconfont'>&#xe69c;</i> 其它";
                }
            })
            ->editColumn('control',function ($bet){
                if($bet->status ==0)
                    return '<a href="javascript:;" onclick="cancel(\''.$bet->bet_order_id.'\')">取消注单</a>';
            })
            ->rawColumns(['user','play','issue','bunko','bet_money','platform','control'])
            ->setTotalRecords($betCount[0]->count)
            ->skipPaging()
            ->with('betMoney',$betMoney)
            ->make(true);$game = $request->input('game');
    }
    public function betToday(Request $request)
    {
        $start = $request->input('start');
        $length = $request->input('length');
        return $this->betTodayRes($request, $start, $length);
    }
    //生成表格查询数据库数据  暂时和betToday分开
    public function req($request, $start, $length,$type=''){
        $game = $request->input('game');
        $playCate = (int)$request->input('playCate');
        $issue = (int)$request->input('issue');
        $status = $request->input('status');
        $username = $request->input('username');
        $order = $request->input('order');
        $minMoney = $request->input('minMoney');
        $maxMoney = $request->input('maxMoney');
        $timeStart = $request->input('timeStart');
        $timeEnd = $request->input('timeEnd');
        $markSix = $request->input('markSix');
//        $start = $request->input('start');
//        $length = $request->input('length');
        $Sql = 'select users.username as users_username,game.game_name as game_game_name,bet.color as bet_color,bet.issue as bet_issue,bet.bet_money as bet_bet_money,bet.game_id as bet_game_id,bet.playcate_name as bet_playcate_name,bet.play_name as bet_play_name,bet.play_odds as bet_play_odds,bet.agnet_odds as bet_agnet_odds,bet.agent_rebate as bet_agent_rebate,bet.bunko as bet_bunko,bet.order_id as bet_order_id,bet.created_at as bet_created_at,bet.platform as bet_platform,bet.nn_view_money as bet_nn_view_money,bet.bet_info as bet_bet_info,bet.status from bet LEFT JOIN game ON bet.game_id = game.game_id LEFT JOIN users ON bet.user_id = users.id WHERE 1 = 1 ';
        $betSql = "";
        switch ($status){
            case 1: //未结
                $betSql .= " AND bet.status = 0 ";
                break;
            case 2: //已结
                $betSql .= " AND bet.status = 1 ";
                break;
            case 3: //撤单
                $betSql .= " AND bet.status = 2 ";
                break;
        }
        if(isset($markSix) && $markSix == 2){
            $betSql .= " AND bet.game_id != 70";
        }
        if(isset($timeStart) && isset($timeEnd) && $type != 'today' && $status != 1){
            $betSql .= " AND bet.created_at BETWEEN '{$timeStart} 00:00:00' and '{$timeEnd} 23:59:59' ";
        }
        if(isset($game) && $game>0){
            $betSql .= " AND bet.game_id = ".$game;
        }
        if(isset($playCate) && $playCate>0){
            $betSql .= " AND bet.playcate_id = ".$playCate;
        }
        if(isset($issue) && $issue>0){
            $betSql .= " AND bet.issue = ".$issue;
        }
        if(isset($order) && $order){
            $betSql .= " AND bet.order_id = '".trim($order)."'";
        }
        if(isset($username) && $username){
            $betSql .= " AND users.username ='".$username."'";
        }
        if($minMoney){
            $betSql .= " AND bet.bet_money >= ".$minMoney;
        }
        if($maxMoney){
            $betSql .= " AND bet.bet_money <= ".$maxMoney;
        }
        $betSql .= " AND bet.testFlag = 0 ";
        $betSql .= " ORDER BY bet.created_at desc,bet.bet_id desc ";
        $resSql = $Sql.$betSql;
        if(isset($start) && isset($length))
            $resSql .= "LIMIT ".$start.','.$length;
        $bet = DB::select($resSql);
        $betCount = DB::select("select count(bet.bet_id) as count from bet LEFT JOIN game ON bet.game_id = game.game_id LEFT JOIN users ON bet.user_id = users.id WHERE 1 = 1 ".$betSql);
        $betMoney = DB::table('bet')
            ->leftJoin('users','bet.user_id','=','users.id')
            ->where(function ($query) use ($timeStart){
                $query->where('bet.updated_at','>=',$timeStart.' 00:00:00');
            })
            ->where(function ($query) use ($timeEnd){
                $query->where('bet.updated_at','<=',$timeEnd.' 23:59:59');
            })
            ->where(function ($query) use ($markSix){
                if(isset($markSix) && $markSix){
                    if($markSix == 2)
                        $query->where("bet.game_id",'!=',70);
                }
            })
            ->where(function ($query) use($status){
                $query->where("bet.bunko",'=',0);
            })
            ->where(function ($query) use ($game){
                if(isset($game) && $game){
                    $query->where("bet.game_id",$game);
                }
            })
            ->where(function ($query) use ($playCate){
                if(isset($playCate) && $playCate){
                    $query->where("bet.playcate_id",$playCate);
                }
            })
            ->where(function ($query) use ($issue){
                if(isset($issue) && $issue){
                    $query->where("bet.issue",$issue);
                }
            })
            ->where(function ($query) use ($order){
                if(isset($order) && $order){
                    $query->where("bet.order_id",$order);
                }
            })
            ->where(function ($query) use ($username){
                if(isset($username) && $username){
                    $query->where("users.username",$username);
                }
            })
            ->where('bet.testFlag',0)->sum('bet.bet_money');
        return [
            'bet'=> $bet,
            'betCount' => $betCount,
            'betMoney' => $betMoney
        ];
    }
    public function exportExcelBetToday(Request $request){
        ini_set("auto_detect_line_endings", true);
        set_time_limit(0);
        $columns =['订单号','下单时间','会员','游戏','期号','玩法','下注金额','代理赔率/比','代理返水/比','会员输赢','终端'];
        $csvFileName = '今日注单-['.$request->input('timeStart').'-'.$request->input('timeEnd')."].csv";
        //设置好告诉浏览器要下载excel文件的headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$csvFileName.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        $fp = fopen('php://output', 'a');//打开output流
        mb_convert_variables('GBK', 'UTF-8', $columns);
        fputcsv($fp, $columns);//将数据格式化为CSV格式并写入到output流中
        $start = 1;
        while (1){
            $bet = $this->req($request,($start - 1) * 20000,20000)['bet'];
            if(count($bet) <= 1)
                break;
            foreach ($bet as $k=>$v){
                $money = '';
                if($v->status == 0){
                    $money = '未结算';
                }else{
                    if($v->bet_bunko > 0 && $v->bet_bunko != $v->bet_bet_money){
                        $tmpBet_bet_money = ($v->bet_bunko) > 0 ? ($v->bet_bet_money) : 0;
                        $lastMoney = ($v->bet_bunko) - $tmpBet_bet_money;
                        if($v->status==2)
                            $money = '已撤单';
                        else
                            $money = sprintf("%.2f",$lastMoney);
                    }else if($v->bet_bunko < 0){
                        $money = sprintf("%.2f",$v->bet_bunko);
                    }
                }
                $rowData =[
                    $v->bet_order_id, //订单号
                    $v->bet_created_at, //下单时间
                    $v->users_username,//会员
                    $v->game_game_name,//游戏
                    $v->bet_issue.'期',//期号
                    ($v->bet_playcate_name.'-'.$v->bet_play_name)." @ {$v->bet_play_odds} {$v->bet_bet_info}",//玩法
                    $v->bet_bet_money,//下注金额
                    $v->bet_agnet_odds,//代理赔率/比
                    $v->bet_agent_rebate == '' ? '--' : $v->bet_agent_rebate, //代理返水/比
                    $money, //会员输赢
                    ($v->bet_platform == 1 ? 'PC端' : ($v->bet_platform == 2 ? 'H5端' : ($v->bet_platform == 3 ? 'IOS' : ($v->bet_platform == 4 ? 'Android' : '--'))))//终端
                ];
                mb_convert_variables('GBK', 'UTF-8', $rowData);
                fputcsv($fp, $rowData);
            }
            unset($bet);//释放变量的内存
            //刷新输出缓冲到浏览器
            ob_flush();
            flush();//必须同时使用 ob_flush() 和flush() 函数来刷新输出缓冲。
            $start ++;
        }
        fclose($fp);
        exit();
    }

    //历史注单
    public function betHistory(Request $request)
    {
        $bet = BetHis::betHistory($request);
        $betCount = BetHis::betHistoryCount($request);
//        $betMoney = BetHis::betHistoryBetMoney($request);
        $currentIssue = '';
        $currentColor = '';
        $betModel = new Bets();
        return DataTables::of($bet)
            ->editColumn('order_id',function ($bet){
                return $bet->bet_order_id;
            })
            ->editColumn('created_at',function ($bet){
                return $bet->bet_created_at;
            })
            ->editColumn('user',function ($bet){
                if($bet->users_username){
                    return $bet->users_username;
                } else {
                    return "<span class='red-text'>用户不存在,请核实</span>";
                }
            })
            ->editColumn('game',function ($bet){
                return $bet->game_game_name;
            })
            ->editColumn('issue',function ($bet) use(&$currentIssue,&$currentColor,$betModel){
                if($currentIssue != $bet->bet_issue){
                    $currentIssue = $bet->bet_issue;
                    $currentColor = $this->getRandColor($currentColor,$bet->bet_color,$betModel);
                }
                return '<span style="color: #'.$currentColor.'">'.$bet->bet_issue.'</span> 期';
            })
            ->editColumn('play',function ($bet){
                return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span> <span>$bet->bet_bet_info</span>";
            })
            ->editColumn('agnet_odds',function ($bet){
                if($bet->bet_agnet_odds == ""){
                    return "--";
                } else {
                    return $bet->bet_agnet_odds;
                }
            })
            ->editColumn('agent_rebate',function ($bet){
                if($bet->bet_agent_rebate == ""){
                    return "--";
                } else {
                    return $bet->bet_agent_rebate;
                }
            })
            ->editColumn('platform',function ($bet){
                if($bet->bet_platform == 1){
                    return "<i class='iconfont'>&#xe696;</i> PC端";
                } else if($bet->bet_platform == 2){
                    return "<i class='iconfont'>&#xe686;</i> H5端";
                } else if($bet->bet_platform == 3){
                    return "<i class='Hui-iconfont'>&#xe64a;</i> IOS";
                } else if($bet->bet_platform == 4){
                    return "<i class='Hui-iconfont'>&#xe6a2;</i> Android";
                } else {
                    return "<i class='Hui-iconfont'>&#xe69c;</i> 其它";
                }
            })
            ->editColumn('control',function ($bet){
                if($bet->status ==0)
                    return '<a href="javascript:;" onclick="cancel(\''.$bet->bet_order_id.'\')">取消注单</a>';
            })
            ->rawColumns(['user','play','issue','bunko','bet_money','platform','control'])
            ->setTotalRecords($betCount[0]->count)
            ->skipPaging()
//            ->with('betMoney',$betMoney)
            ->make(true);
    }
    
    //实时滚单
    public function betRealTime(Request $request)
    {
        $games = $request->get('games');
        $issue = $request->get('issue');
        $username = $request->get('username');
        $minMoney = $request->get('minMoney');
        $start = $request->get('start');
        $length = $request->get('length');
        if(isset($games) && $games){
            $foreach = explode(',',implode(',',$games));
            $q = '';
            foreach($foreach as $item){
                $q .= '`bet`.`game_id` = "'.$item.'" and ';
            }
        } else {
            $q = '';
        }

        $betSQL = DB::table('bet')
            ->leftJoin('game','bet.game_id','=','game.game_id')
            ->leftJoin('users','bet.user_id','=','users.id')
            ->select('users.username as users_username','game.game_name as game_game_name','bet.color as bet_color','bet.issue as bet_issue','bet.bet_money as bet_bet_money','bet.game_id as bet_game_id','bet.playcate_name as bet_playcate_name','bet.play_name as bet_play_name','bet.play_odds as bet_play_odds','bet.agnet_odds as bet_agnet_odds','bet.agent_rebate as bet_agent_rebate','bet.bunko as bet_bunko','bet.order_id as bet_order_id','bet.created_at as bet_created_at','bet.platform as bet_platform','bet.play_rebate as bet_bet_rebate')
            ->where(function ($query) use ($games,$q){
                if(isset($games) && $games){
                    $query->whereRaw(rtrim($q,'and '));
                }
            })
            ->where(function ($query) use ($issue){
                if(isset($issue) && $issue){
                    $query->where('bet.issue',$issue);
                }
            })
            ->where(function ($query) use ($username){
                if(isset($username) && $username){
                    $query->where("users.username",$username);
                }
            })
            ->where(function ($query) use ($minMoney){
                if(isset($minMoney) && $minMoney){
                    $query->where('bet.bet_money','>=',$minMoney);
                }
            })
            ->where('bet.testFlag',0)->where('bet.bunko',0);
        $betCount = $betSQL->count();
        $bet = $betSQL->orderBy('bet.created_at','desc')->skip($start)->take($length)->get();
        return DataTables::of($bet)
            ->editColumn('order_id',function ($bet){
                return $bet->bet_order_id;
            })
            ->editColumn('created_at',function ($bet){
                return $bet->bet_created_at;
            })
            ->editColumn('user',function ($bet){
                if($bet->users_username){
                    return $bet->users_username;
                } else {
                    return "<span class='red-text'>用户不存在,请核实</span>";
                }
            })
            ->editColumn('game',function ($bet){
                return $bet->game_game_name;
            })
            ->editColumn('issue',function ($bet){
                return '<span style="color: #'.$bet->bet_color.'">'.$bet->bet_issue.'</span> 期';
            })
            ->editColumn('bet_money',function ($bet){
                return "<span class='bet-text'>$bet->bet_bet_money</span>";
            })
            ->editColumn('bet_rebate',function ($bet){
                return "<span class='bet-text'>$bet->bet_bet_rebate</span>";
            })
            ->editColumn('play',function ($bet){
                return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span>";
            })
            ->rawColumns(['user','play','issue','bunko','bet_money','bet_rebate'])
            ->setTotalRecords($betCount)
            ->skipPaging()
            ->make(true);
    }
    
    //用户注单-独占页面
    public function userBetSearch(Request $request)
    {
        $username = $request->get('userName');
        $startPage = $request->get('start');
        $lengthPage = $request->get('length');
        $user = DB::table('users')->where('username',$username)->first();

        if (!$user)
            return response()->json([
                'status' => false,
                'msg' => '用户不存在，请核实！'
            ],403);

        $aBetSql = Bets::userBetSearch($request,$user);
        $betCount = Bets::userBetSearchCount($request,$user);
        $aBetHisSql = BetHis::userBetSearch($request, $user);
        $betHisCount = BetHis::userBetSearchCount($request, $user);

        if(empty($aBetSql) && !empty($aBetHisSql)){
            $aSql = $aBetHisSql.' ORDER BY bet_created_at DESC,bet_bet_id DESC ';
        }elseif(empty($aBetHisSql) && !empty($aBetSql)){
            $aSql = $aBetSql.' ORDER BY bet_created_at DESC,bet_bet_id DESC ';
        }else{
            $aSql = $aBetSql . ' UNION ALL ' . $aBetHisSql .' ORDER BY bet_created_at DESC,bet_bet_id DESC';
        }
        $bet = DB::select($aSql." LIMIT ".$startPage.','.$lengthPage);
        $currentIssue = '';
        $currentColor = '';
        $betModel = new Bets();
        return DataTables::of($bet)
            ->editColumn('order_id',function ($bet){
                return '<span>'.$bet->bet_order_id.'</span>';
            })
            ->editColumn('user',function ($bet) use ($user){
                return '<span>'.$user->username.'</span>';
            })
            ->editColumn('created_at',function ($bet) {
                return $bet->bet_created_at;
            })
            ->editColumn('game',function ($bet){
                return '<span>'.$bet->g_game_name.'</span>';
            })
            ->editColumn('issue',function ($bet) use(&$currentIssue,&$currentColor,$betModel){
                if($currentIssue != $bet->bet_issue){
                    $currentIssue = $bet->bet_issue;
                    $currentColor = $this->getRandColor($currentColor,$bet->bet_color,$betModel);
                }
                return '<div style="position: relative"><div class="show-open" id="openH_'.$bet->bet_bet_id.'"></div><span onmouseover="showOpenHistory(\''.$bet->bet_game_id.'\',\''.$bet->bet_issue.'\',\''.$bet->bet_bet_id.'\',\''.$bet->g_game_name.'\')" onmouseout="hideOpenHistory(\''.$bet->bet_game_id.'\',\''.$bet->bet_issue.'\',\''.$bet->bet_bet_id.'\')" style="color: #'.$currentColor.';cursor: pointer;">'.$bet->bet_issue.'</span></div>';
            })
            ->editColumn('play',function ($bet){
                $betInfo = $bet->bet_bet_info ?? '';
                return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span> <span>$betInfo</span>";
            })
            ->editColumn('rebate',function ($bet){
                return empty($bet->bet_play_rebate)?0:$bet->bet_play_rebate * 100 . "%";
            })
            ->editColumn('platform',function ($bet){
                if($bet->bet_platform == 1){
                    return "<i class='iconfont'>&#xe696;</i> PC端";
                } else if($bet->bet_platform == 2){
                    return "<i class='iconfont'>&#xe686;</i> H5端";
                } else if($bet->bet_platform == 3){
                    return "<i class='Hui-iconfont'>&#xe64a;</i> IOS";
                } else if($bet->bet_platform == 4){
                    return "<i class='Hui-iconfont'>&#xe6a2;</i> Android";
                } else {
                    return "<i class='Hui-iconfont'>&#xe69c;</i> 其它";
                }
            })
            ->editColumn('none1',function ($bet){
                return '-';
            })
            ->editColumn('none2',function ($bet){
                return '-';
            })
            ->editColumn('dongjie',function ($bet){
                return $bet->bet_freeze_money;
            })
            ->editColumn('jiedong',function ($bet){
                return $bet->bet_unfreeze_money;
            })
            ->rawColumns(['order_id','user','game','issue','play','bunko','bet_money','platform'])
            ->setTotalRecords($betCount + $betHisCount)
            ->skipPaging()
            ->make(true);
    }

    public function betNumTotal(Request $request)
    {
        $searchType = $request->get('searchType');
        $status = $request->get('status');
        $game = $request->get('game');
        $total = DB::table('bet')
            ->where(function ($query) use ($searchType){
                if($searchType && isset($searchType)){
                    $data = Carbon::now()->addDay(-1)->toDateTimeString();
                    $query->whereDate('created_at',date('Y-m-d',strtotime($data)));
                } else {
                    $query->whereDate('created_at',date('Y-m-d'));
                }
            })->where(function ($query) use($status){
                if($status && isset($status)){
                    switch ($status){
                        case 1: //未结
                            $query->where('status',0);
                            break;
                        case 2: //已结
                            $query->where('status',1);
                            break;
                        case 3: //撤单
                            $query->where('status',2);
                            break;
                    }
                }
            })
            ->where(function ($query) use ($game){
                if($game && isset($game)){
                    $query->where('game_id',$game);
                }
            })
            ->where('testFlag',0)->sum(DB::raw("CASE WHEN `game_id` IN(90,91) THEN `nn_view_money` ELSE `bunko` END"));
        return $total;
    }

    private function play($gameId,$playCate,$play,$odds){
        $cate_txt = PlayCates::where('gameId',$gameId)->where('id',$playCate)->first();
        $play_txt = Play::where('gameId',$gameId)->where('id',$play)->first();
        return "<span class='blue-text'>$cate_txt->name - </span><span class='blue-text'>$play_txt->name</span> @ <span class='red-text'>$odds</span>";
    }

    private function getRandColor($needColor,$currentColor,$betModel){
        if($needColor === $currentColor){
            $needColor = $betModel->randColor();
            if($needColor === $currentColor)
                return $this->getRandColor($needColor,$currentColor,$betModel);
            else
                return $needColor;
        }else{
            return $currentColor;
        }
    }
}
