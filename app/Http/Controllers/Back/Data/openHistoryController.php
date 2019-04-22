<?php

namespace App\Http\Controllers\Back\Data;

use App\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\GamesApi;

class openHistoryController extends Controller
{
    private function getPostData($table,$issue,$issuedate)
    {
        if(empty($table))
            return false;
        $now = time();
        $arrayIssuedate = [];

        if(empty($issue)){
            if(empty($issuedate))
                $issuedate = $now;
            else
                $issuedate = strtotime($issuedate);
            if(date('Y-m-d',$issuedate) == date('Y-m-d')){
                $issuedate = $now;
                $arrayIssuedate['start'] = date('Y-m-d H:i:s',$issuedate);
                $arrayIssuedate['end'] = date('Y-m-d 00:00:00',$issuedate);
            }else{
                $arrayIssuedate['start'] = date('Y-m-d 23:59:59',$issuedate);
                $arrayIssuedate['end'] = date('Y-m-d 00:00:00',$issuedate);
            }
        }
        $HIS = DB::table($table)->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($arrayIssuedate, $table){        //
                if(isset($arrayIssuedate) && !empty($arrayIssuedate)){
                    $query->where($table.".opentime",'<=',$arrayIssuedate['start']);
                    $query->where($table.".opentime",'>=',$arrayIssuedate['end']);
                }
            });
        return $HIS;
    }
    //北京赛车-表格数据
    public function bjpk10(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $table = 'game_bjpk10';
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }

    //历史开奖 - 赛车
    public function sc(Request $request){
        if(!($gameType = $request->get('type'))){
            return false;
        }
        $table = 'game_'.Games::$aCodeGameName[$gameType];
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel
            ->select('game_bjpk10.*', 'game_pknn.niuniu as niuniu')
            ->leftJoin('game_pknn', 'game_bjpk10.issue', 'game_pknn.issue')
            ->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }

    //历史开奖 - 秒速赛车
    public function mssc(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $table = 'game_mssc';
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }

    //历史开奖 - 秒速飞艇
    public function msft(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $table = 'game_msft';
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }

    //历史开奖 - 跑马
    public function paoma(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $table = 'game_paoma';
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }
    //广东快乐十分-表格数据
    public function gdklsf(Request $request){
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $table = 'game_gdklsf';
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }
    //重庆幸运农场-表格数据
    public function cqxync(Request $request){
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $table = 'game_cqxync';
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }
    //广东11选5-表格数据
    public function gd11x5(Request $request){
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $table = 'game_gd11x5';
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();

        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }
    //时时彩-表格数据
    public function ssc(Request $request){
        if(!($gameType = $request->get('type'))){
            return false;
        }
//        $table = 'game_'.$gameType;
        $table = 'game_'.Games::$aCodeGameName[$gameType];
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }
//    //重庆时时彩-表格数据
//    public function cqssc(Request $request)
//    {
//        $issue = $request->get('issue');
//        $issuedate = $request->get('issuedate');
//        $start = $request->get('start');
//        $length = $request->get('length');
//        $table = 'game_cqssc';
//        $HISModel = $this->getPostData($table,$issue,$issuedate);
//
//        $HISCount = $HISModel->count();
//        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
//        return DataTables::of($HIS)
//            ->setTotalRecords($HISCount)
//            ->skipPaging()
//            ->make(true);
//    }
//
//    //秒速时时彩-表格数据
//    public function msssc(Request $request)
//    {
//        $issue = $request->get('issue');
//        $issuedate = $request->get('issuedate');
//        $start = $request->get('start');
//        $length = $request->get('length');
//        $table = 'game_msssc';
//        $HISModel = $this->getPostData($table,$issue,$issuedate);
//        $HISCount = $HISModel->count();
//        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
//        return DataTables::of($HIS)
//            ->setTotalRecords($HISCount)
//            ->skipPaging()
//            ->make(true);
//    }

    //北京快乐8-表格数据
    public function bjkl8(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $table = 'game_bjkl8';
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();

        $HIS = $HISModel
            ->select('game_bjkl8.*', 'game_pcdd.opennum as pcddOpennum')
            ->leftJoin('game_pcdd', 'game_bjkl8.issue', 'game_pcdd.issue')
            ->orderBy('id','desc')->skip($start)->take($length)->get();

        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }

    //快三-表格数据
    public function k3(Request $request)
    {
        $gameType = $request->get('type');
        $table = 'game_'.Games::$aCodeGameName[$gameType];
//        switch ($type){
//            case 'msjsk3':
//                $table = 'game_msjsk3';
//                break;
//            case 'jsk3':
//                $table = 'game_jsk3';
//                break;
//            case 'ahk3':
//                $table = 'game_ahk3';
//                break;
//            case 'jlk3':
//                $table = 'game_jlk3';
//                break;
//            case 'hbk3':
//                $table = 'game_hbk3';
//                break;
//            case 'gxk3':
//                $table = 'game_gxk3';
//                break;
//            case 'hebk3':
//                $table = 'game_hebeik3';
//                break;
//            case 'gzk3':
//                $table = 'game_gzk3';
//                break;
//            case 'gsk3':
//                $table = 'game_gsk3';
//                break;
//            default:
//                return false;
//                break;
//        }
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $start = $request->get('start');
        $length = $request->get('length');
        $HISModel = $this->getPostData($table,$issue,$issuedate);
        $HISCount = $HISModel->count();
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
            ->make(true);
    }

    public function lhc(Request $request)
    {
        $param = $request->post();
        $lhcSql = DB::table('game_lhc')->where(function ($aSql) use($param){
            if(isset($param['issuedate']) && array_key_exists('issue',$param))
                $aSql->where('issue',$param['issue']);
            if(isset($param['issuedate']) && array_key_exists('time',$param))
                $aSql->whereBetween('opentime',[$param['issuedate'],$param['issuedate'].' 23:59:59']);
        });
        $lhcCount = $lhcSql->count();
        $lhc = $lhcSql->orderBy('issue','DESC')->orderBy('id','DESC')->skip($param['start'])->take($param['length'])->get();
        $gameIsOpen = Games::$gameIsOpen;
        return DataTables::of($lhc)
            ->editColumn('issue',function ($lhc){
                return "<b style='color: #".$lhc->color.";'>$lhc->issue</b>";
            })
            ->editColumn('n1',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n1_sb."'>$lhc->n1</span>";
            })
            ->editColumn('n2',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n2_sb."'>$lhc->n2</span>";
            })
            ->editColumn('n3',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n3_sb."'>$lhc->n3</span>";
            })
            ->editColumn('n4',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n4_sb."'>$lhc->n4</span>";
            })
            ->editColumn('n5',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n5_sb."'>$lhc->n5</span>";
            })
            ->editColumn('n6',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n6_sb."'>$lhc->n6</span>";
            })
            ->editColumn('n7',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n7_sb."'>$lhc->n7</span>";
            })
            ->editColumn('is_open',function ($lhc) use($gameIsOpen){
                return $gameIsOpen[$lhc->is_open];
            })
            ->editColumn('control',function ($lhc){
                if($lhc->is_open == 0){
                    return "<ul class='control-menu'>
                        <li onclick='edit(\"$lhc->id\")'>修改</li>
                        <li onclick='openLhc(\"$lhc->id\")'>手动开奖</li>
                        <li onclick='cancel(\"$lhc->issue\")'>撤单</li>
                        </ul>";
                }
                if($lhc->is_open == 1){
                    $html = "<ul class='control-menu'>";
                    $html .= "<li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>";
                    $html .= "<li onclick='canceled(\"$lhc->issue\")'>撤单</li>";
                    $html .= "<li onclick='freeze(\"$lhc->issue\")'>冻结</li>";
                    $html .= "</ul>";
                    return $html;
                }
                if($lhc->is_open == 5){
                    return "<ul class='control-menu'>
                        <li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>
                        </ul>";
                }
                if($lhc->is_open == 9){
                    return "<ul class='control-menu'>
                        <li onclick='freeze(\"$lhc->issue\")'>冻结</li>
                        </ul>";
                }
                if($lhc->is_open == 10){
                    return "<ul class='control-menu'>
                        <li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>
                        </ul>";
                }
                if($lhc->is_open == 12){
                    return "<ul class='control-menu'>
                        <li onclick='canceled(\"$lhc->issue\")'>撤单</li>
                        </ul>";
                }
            })
            ->rawColumns(['issue','control','n1','n2','n3','n4','n5','n6','n7'])
            ->setTotalRecords($lhcCount)
            ->skipPaging()
            ->make(true);
    }

    public function xylhc(Request $request){
        $param = $request->post();
        if(!($gameType = $request->get('type'))){
            return false;
        }
        $table = 'game_'.Games::$aCodeGameName[$gameType];
        $HISModel = $this->getPostData($table,$param['issue'],$param['issuedate']);
        $lhcCount = $HISModel->count();
        $lhc = $HISModel->orderBy('id','desc')->skip($param['start'])->take($param['length'])->get();
        $gameIsOpen = Games::$gameIsOpen;
        return DataTables::of($lhc)
            ->editColumn('issue',function ($lhc){
                return "<b style='color: #".$lhc->color.";'>$lhc->issue</b>";
            })
            ->editColumn('n1',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n1_sb."'>$lhc->n1</span>";
            })
            ->editColumn('n2',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n2_sb."'>$lhc->n2</span>";
            })
            ->editColumn('n3',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n3_sb."'>$lhc->n3</span>";
            })
            ->editColumn('n4',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n4_sb."'>$lhc->n4</span>";
            })
            ->editColumn('n5',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n5_sb."'>$lhc->n5</span>";
            })
            ->editColumn('n6',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n6_sb."'>$lhc->n6</span>";
            })
            ->editColumn('n7',function ($lhc){
                return "<span class='lhc-sb-".$lhc->n7_sb."'>$lhc->n7</span>";
            })
            ->editColumn('is_open',function ($lhc) use($gameIsOpen){
                return $gameIsOpen[$lhc->is_open];
            })
            ->editColumn('control',function ($lhc){
                if($lhc->is_open == 0){
                    return "<ul class='control-menu'>
                        <li onclick='edit(\"$lhc->id\")'>修改</li>
                        <li onclick='openLhc(\"$lhc->id\")'>手动开奖</li>
                        <li onclick='cancel(\"$lhc->issue\")'>撤单</li>
                        </ul>";
                }
                if($lhc->is_open == 1){
                    $html = "<ul class='control-menu'>";
                    $html .= "<li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>";
                    $html .= "<li onclick='canceled(\"$lhc->issue\")'>撤单</li>";
                    $html .= "<li onclick='freeze(\"$lhc->issue\")'>冻结</li>";
                    $html .= "</ul>";
                    return $html;
                }
                if($lhc->is_open == 5){
                    return "<ul class='control-menu'>
                        <li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>
                        </ul>";
                }
                if($lhc->is_open == 9){
                    return "<ul class='control-menu'>
                        <li onclick='freeze(\"$lhc->issue\")'>冻结</li>
                        </ul>";
                }
                if($lhc->is_open == 10){
                    return "<ul class='control-menu'>
                        <li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>
                        </ul>";
                }
                if($lhc->is_open == 12){
                    return "<ul class='control-menu'>
                        <li onclick='canceled(\"$lhc->issue\")'>撤单</li>
                        </ul>";
                }
            })
            ->rawColumns(['issue','control','n1','n2','n3','n4','n5','n6','n7'])
            ->setTotalRecords($lhcCount)
            ->skipPaging()
            ->make(true);
    }

    //棋牌下注查询
//    public function card_betInfo(Request $request){
//        $start = $request->get('start');
//        $length = $request->get('length');
//        $sql = DB::table('ky_bet')->where(function ($aSql) use($request){
//            if(($startTime = $request->get('startTime')) && ($endTime = $request->get('endTime'))){
//                $aSql->whereBetween('GameStartTime',[$startTime.' 00:00:00',$endTime.' 23:59:59']);
//            }
//            if($Accounts = $request->get('Accounts')){
//                $aSql->whereIn('Accounts',[$Accounts,env('KY_AGENT').'_'.$Accounts]);
//            }
//        });
//        $count = $sql->count();
//        $res = $sql->orderBy('id','DESC')->skip($start)->take($length)->get();
//        return DataTables::of($res)
//            ->editColumn('control',function ($res){
//                    return "<ul class='control-menu'>
//                            <li onclick='openLhc(\"$res->id\")'>手动开奖</li>
//                            </ul>";
//            })
//            ->setTotalRecords($count)
//            ->skipPaging()
//            ->make(true);
//    }

    public function card_betInfo(Request $request){
        $GamesApi = new GamesApi();
        $sqlArr = $GamesApi->card_betInfoSql1($request);
        $TotalSum = $GamesApi->card_betInfoTotal1($request, $sqlArr);
        $sqlCount =  'SELECT COUNT(`id`) AS `count` FROM ( '.implode(' UNION ALL ', $sqlArr).' ) AS b';
        $res = $GamesApi->card_betInfoData($request, $sqlArr);
        $resCount = DB::select($sqlCount)[0]->count;
        return DataTables::of($res)
            ->setTotalRecords($resCount)
            ->skipPaging()
            ->with('TotalSum',$TotalSum)
            ->make(true);
    }

    //第三方游戏拉取注单失败列表
    public function errorBet(Request $request)
    {
        $model = DB::table('jq_error_bet')->where(function($sql) use($request){
            $sql->where('code', '<>', 0);
        });
        $count = $model->count();
        if(isset($request->start, $request->length))
            $model->orderBy('id','desc')->skip($request->start)->take($request->length);
        $res = $model->get();
        return DataTables::of($res)
            ->editColumn('control',function ($aData) {
                return '<ul class=\'control-menu\'>
                            <li onclick=\'reGetBet('.$aData->id.')\'>重新获取</li>
                         </ul>';
            })
            ->rawColumns(['control','toTime'])
            ->setTotalRecords($count)
            ->skipPaging()
            ->make(true);
    }
    //下注查询
    public function BetInfo(Request $request)
    {
        $table = 'jq_bet_his';
        isset($request->startTime) && $request->startTime = date('Y-m-d', strtotime($request->startTime));
        isset($request->endTime) && $request->endTime = date('Y-m-d', strtotime($request->endTime));
        if(isset($request->startTime) && ($request->startTime == date('Y-m-d')) && ($request->startTime == $request->endTime))
            $table = 'jq_bet';
        $model = DB::table($table)->where(function($sql) use($request){
            isset($request->gameCategory) &&
            $sql->where('gameCategory', $request->gameCategory);
            isset($request->username) &&
            $sql->where('username', $request->username);
            isset($request->GameID) &&
            $sql->where('GameID', $request->GameID);
            isset($request->g_id) &&
            $sql->where('g_id', $request->g_id);
            isset($request->startTime) &&
            $sql->where('GameStartTime', '>=', date('Y-m-d',strtotime($request->startTime)).' 00:00:00');
            isset($request->endTime) &&
            $sql->where('GameStartTime', '<=', date('Y-m-d',strtotime($request->endTime)).' 23:59:59');
        });
        $totalModel = clone $model;
        $TotalSum = $totalModel->select(DB::raw(' COUNT(username) as BetCountSum, SUM(AllBet) as AllBet, SUM(bet_money) as bet_money, SUM(bunko) as bunkoSum '))->first();
        foreach ($TotalSum as &$v){
            $v = sprintf('%.2f', $v) * 1;
        }
        $count = $model->count();
        if(isset($request->start, $request->length))
            $model->skip($request->start)->take($request->length);
        $res = $model->orderBy('updated_at', 'desc')->orderBy('id','desc')->get();

        $g_ids = \App\GamesApi::getBetList()->keyBy('g_id')->toArray();
        return DataTables::of($res)
            ->editColumn('gameCategory',function ($v){
                return \App\GamesList::$gameCategory[$v->gameCategory] ?? '';
            })
            ->editColumn('g_id',function ($v) use ($g_ids){
                return $g_ids[$v->g_id]['name'] ?? $v->g_id;
            })
            ->rawColumns(['control'])
            ->setTotalRecords($count)
            ->with('TotalSum',$TotalSum)
            ->skipPaging()
            ->make(true);



        if($request->dataTag == 'qp'){ //棋牌
            if($gInfo = DB::table('games_list')->where('game_id', $request->dataId)->where('open', 1)->first()){
                $request->offsetSet('g_id', $gInfo->g_id);
            }
            return $this->card_betInfo($request);
        }elseif ($request->dataTag == 'tc'){
            return $this->TCBetInfo($request);
        }
    }
    //TC下注查询
    public function TCBetInfo(Request $request)
    {
        $model = DB::table('jq_wsgj_bet')->where(function($sql) use($request){
            isset($request->dataId) &&
                $sql->where('gameCategory', $request->dataId);
            isset($request->gameCategory) &&
                $sql->where('gameCategory', $request->gameCategory);
            isset($request->Accounts) &&
                $sql->where('Accounts', $request->Accounts);
            isset($request->productType) &&
                $sql->where('productType', $request->productType);
            isset($request->startTime) &&
                $sql->where('GameStartTime', '>=', date('Y-m-d',strtotime($request->startTime)).' 00:00:00');
            isset($request->endTime) &&
                $sql->where('GameStartTime', '<=', date('Y-m-d',strtotime($request->endTime)).' 23:59:59');
        });
        $totalModel = clone $model;
        $TotalSum = $totalModel->select(DB::raw(' COUNT(Accounts) as BetCountSum, SUM(AllBet) as AllBet, SUM(validBetAmount) as validBetAmount, SUM(Profit) as ProfitSum '))->first();
        foreach ($TotalSum as &$v){
            $v = sprintf('%.2f', $v) * 1;
        }
        $count = $model->count();
        if(isset($request->start, $request->length))
            $model->orderBy('id','desc')->skip($request->start)->take($request->length);
//        $model->select(DB::raw('gameCategory, Accounts, SUM(validBetAmount) as validBetAmount, SUM(AllBet) as AllBet, SUM(Profit) as Profit, productType, GameStartTime'));
//        $model->groupBy('Accounts','productType');
        $res = $model->get();
        return DataTables::of($res)
            ->editColumn('productType',function ($aData) {
                return \App\GamesList::$productType[$aData->productType] ?? '';
            })
            ->editColumn('gameCategory',function ($v){
                return \App\GamesList::$gameCategory[$v->gameCategory] ?? '';
            })
            ->rawColumns(['control'])
            ->setTotalRecords($count)
            ->with('TotalSum',$TotalSum)
            ->skipPaging()
            ->make(true);
    }
}
