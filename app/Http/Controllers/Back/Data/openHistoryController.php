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
            ->where(function ($query) use ($arrayIssuedate){        //
                if(isset($arrayIssuedate) && !empty($arrayIssuedate)){
                    $query->where("opentime",'<=',$arrayIssuedate['start']);
                    $query->where("opentime",'>=',$arrayIssuedate['end']);
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
        $table = 'game_'.$gameType;
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
        $table = 'game_'.$gameType;
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
        $HIS = $HISModel->orderBy('id','desc')->skip($start)->take($length)->get();
        return DataTables::of($HIS)
            ->setTotalRecords($HISCount)
            ->skipPaging()
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
            case 'hebk3':
                $table = 'game_hebeik3';
                break;
            case 'gzk3':
                $table = 'game_gzk3';
                break;
            case 'gsk3':
                $table = 'game_gsk3';
                break;
            default:
                return false;
                break;

        }
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
        $lhc = $lhcSql->orderBy('id','DESC')->skip($param['start'])->take($param['length'])->get();
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
                        <li onclick='cancel(\"$lhc->issue\",\"lhc\")'>撤单</li>
                        </ul>";
                }
                if($lhc->is_open == 1){
                    return "<ul class='control-menu'>
                        <li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>
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

        $HISModel = $this->getPostData('game_xylhc',$param['issue'],$param['issuedate']);
        $lhcCount = $HISModel->count();
        $lhc = $HISModel->orderBy('id','desc')->skip($param['start'])->take($param['length'])->get();
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
                        <li onclick='cancel(\"$lhc->issue\",\"xylhc\")'>撤单</li>
                        </ul>";
                }
                if($lhc->is_open == 1){
                    return "<ul class='control-menu'>
                        <li onclick='reOpen(\"$lhc->id\")'>重新开奖</li>
                        </ul>";
                }
            })
            ->rawColumns(['issue','control','n1','n2','n3','n4','n5','n6','n7'])
            ->setTotalRecords($lhcCount)
            ->skipPaging()
            ->make(true);
    }


}
