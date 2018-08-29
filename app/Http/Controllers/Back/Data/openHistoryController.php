<?php

namespace App\Http\Controllers\Back\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class openHistoryController extends Controller
{
    private function getPostData($table,$issue,$issuedate)
    {
        if(empty($table))
            return false;
        $now = time();

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
            ->where(function ($query) use ($arrayIssuedate){        //
                if(isset($arrayIssuedate) && $arrayIssuedate){
                    $query->where("opentime",'<=',$arrayIssuedate['start']);
                    $query->where("opentime",'>=',$arrayIssuedate['end']);
                }
            })
            ->orderBy('id','desc')->get();
        return $HIS;
    }
    //北京赛车-表格数据
    public function bjpk10(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $table = 'game_bjpk10';
        $HIS = $this->getPostData($table,$issue,$issuedate);
        return DataTables::of($HIS)
            ->make(true);
    }

    //历史开奖 - 秒速赛车
    public function mssc(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $table = 'game_mssc';
        $HIS = $this->getPostData($table,$issue,$issuedate);
        return DataTables::of($HIS)
            ->make(true);
    }

    //历史开奖 - 秒速飞艇
    public function msft(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $table = 'game_msft';
        $HIS = $this->getPostData($table,$issue,$issuedate);
        return DataTables::of($HIS)
            ->make(true);
    }

    //历史开奖 - 跑马
    public function paoma(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $table = 'game_paoma';
        $HIS = $this->getPostData($table,$issue,$issuedate);
        return DataTables::of($HIS)
            ->make(true);
    }

    //重庆时时彩-表格数据
    public function cqssc(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $table = 'game_cqssc';
        $HIS = $this->getPostData($table,$issue,$issuedate);
        return DataTables::of($HIS)
            ->make(true);
    }

    //秒速时时彩-表格数据
    public function msssc(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $table = 'game_msssc';
        $HIS = $this->getPostData($table,$issue,$issuedate);
        return DataTables::of($HIS)
            ->make(true);
    }

    //北京快乐8-表格数据
    public function bjkl8(Request $request)
    {
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $table = 'game_bjkl8';
        $HIS = $this->getPostData($table,$issue,$issuedate);
        return DataTables::of($HIS)
            ->make(true);
    }

    //快三-表格数据
    public function k3(Request $request)
    {
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
            case 'hbk3':
                $table = 'game_hbk3';
                break;
            case 'gxk3':
                $table = 'game_gxk3';
                break;
            default:
                return false;
                break;

        }
        $issue = $request->get('issue');
        $issuedate = $request->get('issuedate');
        $HIS = $this->getPostData($table,$issue,$issuedate);
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
