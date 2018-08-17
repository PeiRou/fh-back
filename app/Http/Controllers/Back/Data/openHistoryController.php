<?php

namespace App\Http\Controllers\Back\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class openHistoryController extends Controller
{
    //北京赛车-表格数据
    public function bjpk10(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');

        if(empty($issuedate))
            $issuedate = time();
        else
            $issuedate = strtotime($issuedate);

        $HIS = DB::table('game_bjpk10')->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($issuedate){        //年
                if(isset($issuedate) && $issuedate){
                    $query->where("opentime",'<=',date('Y-m-d H:i:s',$issuedate));
                    $query->where("opentime",'>=',date('Y-m-d 00:00:00',$issuedate));
                }
            })
            ->orderBy('id','desc')->get();
        return DataTables::of($HIS)
            ->make(true);
    }

    //历史开奖 - 秒速赛车
    public function mssc(Request $request){
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');

        if(empty($issuedate))
            $issuedate = time();
        else
            $issuedate = strtotime($issuedate);

        $HIS = DB::table('game_mssc')->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($issuedate){        //年
                if(isset($issuedate) && $issuedate){
                    $query->where("opentime",'<=',date('Y-m-d H:i:s',$issuedate));
                    $query->where("opentime",'>=',date('Y-m-d 00:00:00',$issuedate));
                }
            })
            ->orderBy('id','desc')->get();
        return DataTables::of($HIS)
            ->make(true);
    }

    //历史开奖 - 秒速飞艇
    public function msft(Request $request){
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');

        if(empty($issuedate))
            $issuedate = time();
        else
            $issuedate = strtotime($issuedate);

        $HIS = DB::table('game_msft')->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($issuedate){        //年
                if(isset($issuedate) && $issuedate){
                    $query->where("opentime",'<=',date('Y-m-d H:i:s',$issuedate));
                    $query->where("opentime",'>=',date('Y-m-d 00:00:00',$issuedate));
                }
            })
            ->orderBy('id','desc')->get();
        return DataTables::of($HIS)
            ->make(true);
    }

    //历史开奖 - 跑马
    public function paoma(Request $request){
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');

        if(empty($issuedate))
            $issuedate = time();
        else
            $issuedate = strtotime($issuedate);

        $HIS = DB::table('game_paoma')->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($issuedate){        //年
                if(isset($issuedate) && $issuedate){
                    $query->where("opentime",'<=',date('Y-m-d H:i:s',$issuedate));
                    $query->where("opentime",'>=',date('Y-m-d 00:00:00',$issuedate));
                }
            })
            ->orderBy('id','desc')->get();
        return DataTables::of($HIS)
            ->make(true);
    }

    //重庆时时彩-表格数据
    public function cqssc(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');

        if(!empty($issuedate))
            $aIssuedate = explode('-',$issuedate);
        else
            $aIssuedate = array();
        $HIS = DB::table('game_cqssc')->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //年
                if(isset($aIssuedate) && $aIssuedate){
                    $query->where("year",$aIssuedate[0]);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //月
                if(isset($aIssuedate) && $aIssuedate){
                    $aIssuedate[1] = intval($aIssuedate[1]);
                    if($aIssuedate[1]<10)                       //如果小于10补0
                        $aIssuedate[1] = "0".$aIssuedate[1];
                    $query->where("month",$aIssuedate[1]);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //日
                if(isset($aIssuedate) && $aIssuedate){
                    $aIssuedate[2] = intval($aIssuedate[2]);
                    if($aIssuedate[2]<10)                       //如果小于10补0
                        $aIssuedate[2] = "0".$aIssuedate[2];
                    $query->where("day",$aIssuedate[2]);
                }
            })
            ->where('opentime','<=',date('Y-m-d H:i:s',time()))
            ->orderBy('id','desc')->get();
        return DataTables::of($HIS)
            ->make(true);
    }

    //秒速时时彩-表格数据
    public function msssc(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');

        if(!empty($issuedate))
            $aIssuedate = explode('-',$issuedate);
        else
            $aIssuedate = array();
        $HIS = DB::table('game_msssc')->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //年
                if(isset($aIssuedate) && $aIssuedate){
                    $query->where("year",$aIssuedate[0]);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //月
                if(isset($aIssuedate) && $aIssuedate){
                    $aIssuedate[1] = intval($aIssuedate[1]);
                    if($aIssuedate[1]<10)                       //如果小于10补0
                        $aIssuedate[1] = "0".$aIssuedate[1];
                    $query->where("month",$aIssuedate[1]);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //日
                if(isset($aIssuedate) && $aIssuedate){
                    $aIssuedate[2] = intval($aIssuedate[2]);
                    if($aIssuedate[2]<10)                       //如果小于10补0
                        $aIssuedate[2] = "0".$aIssuedate[2];
                    $query->where("day",$aIssuedate[2]);
                }
            })
            ->where('opentime','<=',date('Y-m-d H:i:s',time()))
            ->orderBy('id','desc')->get();
        return DataTables::of($HIS)
            ->make(true);
    }

    //北京快乐8-表格数据
    public function bjkl8(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');

        if(!empty($issuedate))
            $aIssuedate = explode('-',$issuedate);
        else
            $aIssuedate = array();
        $HIS = DB::table('game_bjkl8')->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //年
                if(isset($aIssuedate) && $aIssuedate){
                    $query->where("year",$aIssuedate[0]);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //月
                if(isset($aIssuedate) && $aIssuedate){
                    $aIssuedate[1] = intval($aIssuedate[1]);
                    if($aIssuedate[1]<10)                       //如果小于10补0
                        $aIssuedate[1] = "0".$aIssuedate[1];
                    $query->where("month",$aIssuedate[1]);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //日
                if(isset($aIssuedate) && $aIssuedate){
                    $aIssuedate[2] = intval($aIssuedate[2]);
                    if($aIssuedate[2]<10)                       //如果小于10补0
                        $aIssuedate[2] = "0".$aIssuedate[2];
                    $query->where("day",$aIssuedate[2]);
                }
            })
            ->where('opentime','<=',date('Y-m-d H:i:s',time()))
            ->orderBy('id','desc')->get();
        return DataTables::of($HIS)
            ->make(true);
    }

    //快三-表格数据
    public function k3(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $type = $request->get('type');
        switch ($type){
            case 'msjsk3':
                $table = 'game_msjsk3';
                break;
            case 'jsk3':
                $table = 'game_jsk3';
                break;
            case 'ahk3':
                $table = 'game_ahk3';
                break;
            case 'jlk3':
                $table = 'game_jlk3';
                break;
            default:
                return false;
                break;

        }
        if(!empty($issuedate))
            $aIssuedate = explode('-',$issuedate);
        else
            $aIssuedate = array();
        $HIS = DB::table($table)->select()
            ->where(function ($query) use ($issue){             //奖期
                if(isset($issue) && $issue){
                    $query->where("issue",$issue);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //年
                if(isset($aIssuedate) && $aIssuedate){
                    $query->where("year",$aIssuedate[0]);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //月
                if(isset($aIssuedate) && $aIssuedate){
                    $aIssuedate[1] = intval($aIssuedate[1]);
                    if($aIssuedate[1]<10)                       //如果小于10补0
                        $aIssuedate[1] = "0".$aIssuedate[1];
                    $query->where("month",$aIssuedate[1]);
                }
            })
            ->where(function ($query) use ($aIssuedate){        //日
                if(isset($aIssuedate) && $aIssuedate){
                    $aIssuedate[2] = intval($aIssuedate[2]);
                    if($aIssuedate[2]<10)                       //如果小于10补0
                        $aIssuedate[2] = "0".$aIssuedate[2];
                    $query->where("day",$aIssuedate[2]);
                }
            })
            ->where('opentime','<=',date('Y-m-d H:i:s',time()))
            ->orderBy('id','desc')->get();
        return DataTables::of($HIS)
            ->make(true);
    }

    public function lhc(Request $request)
    {
        $lhc = DB::table('game_lhc')->orderBy('id','DESC')->get();
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
            ->editColumn('is_open',function ($lhc){
                if($lhc->is_open == 1){
                    return '已开奖';
                }
                if($lhc->is_open == 0){
                    return '暂未开奖';
                }
            })
            ->editColumn('control',function ($lhc){
                if($lhc->is_open == 0){
                    return "<ul class='control-menu'>
                        <li onclick='edit(\"$lhc->id\")'>修改</li>
                        <li onclick='openLhc(\"$lhc->id\")'>手动开奖</li>
                        </ul>";
                }
                if($lhc->is_open == 1){
                    return "<ul class='control-menu'>
                        <li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>
                        <li onclick='cancel(\"$lhc->id\")'>撤单</li>
                        </ul>";
                }
            })
            ->rawColumns(['issue','control','n1','n2','n3','n4','n5','n6','n7'])
            ->make(true);
    }
}
