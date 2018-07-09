<?php

namespace App\Http\Controllers\Back;

use App\Helpers\LHC_SX;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OpenHistoryController extends Controller
{
    protected $LHC;

    /**
     * OpenHistoryController constructor.
     * @param $shengxiao
     */
    public function __construct(LHC_SX $LHC)
    {
        $this->LHC = $LHC;
    }


    public function addLhcNewIssue(Request $request)
    {
        $issue = $request->get('issue');
        $end_time = $request->get('end_time');
        $open_time = $request->get('open_time');

        $findIssue = DB::table('game_lhc')->where('issue',$issue)->count();
        if($findIssue == 0){
            $insert = DB::table('game_lhc')->insert([
                'issue' => $issue,
                'is_open' => 0,
                'opentime' => $open_time,
                'endtime' => $end_time,
                'color' => $this->randColor()
            ]);
            if($insert == 1){
                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => '添加新期数异常，请稍后再试！'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'msg' => '本期记录已经存在，请勿重复添加！'
            ]);
        }
    }

    public function editLhcNewIssue(Request $request)
    {
        $id = $request->get('id');
        $issue = $request->get('issue');
        $end_time = $request->get('end_time');
        $open_time = $request->get('open_time');

        $update = DB::table('game_lhc')->where('id',$id)->update([
            'issue' => $issue,
            'endtime' => $end_time,
            'opentime' => $open_time
        ]);
        if($update == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '修改期数异常，请稍后再试！'
            ]);
        }
    }

    //添加六合彩开奖数据
    public function addLhcData(Request $request)
    {
        $id = $request->get('id');
        $n1 = $request->get('n1');
        $n2 = $request->get('n2');
        $n3 = $request->get('n3');
        $n4 = $request->get('n4');
        $n5 = $request->get('n5');
        $n6 = $request->get('n6');
        $n7 = $request->get('n7');
        $msg = $request->get('msg');

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5.','.$n6.','.$n7;
        $totalNum = (int)$n1+(int)$n2+(int)$n3+(int)$n4+(int)$n5+(int)$n6+(int)$n7;
        $sx = $this->LHC->shengxiao($n7);

        $update = DB::table('game_lhc')->where('id',$id)->update([
            'n1' => $n1,
            'n2' => $n2,
            'n3' => $n3,
            'n4' => $n4,
            'n5' => $n5,
            'n6' => $n6,
            'n7' => $n7,
            'msg' => $msg,
            'open_num' => $openNum,
            'sx' => $sx,
            'total_num' => $totalNum
        ]);
        if($update == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '开奖数据添加失败！'
            ]);
        }
    }

    function randColor(){
        $rand = rand(1,20);
        switch($rand){
            case 1:
                $color = 'ca2727';
                break;
            case 2:
                $color = '779888';
                break;
            case 3:
                $color = 'bbbbbb';
                break;
            case 4:
                $color = 'f59bca';
                break;
            case 5:
                $color = 'ef429d';
                break;
            case 6:
                $color = 'ca00be';
                break;
            case 7:
                $color = 'f351ea';
                break;
            case 8:
                $color = 'dba1f1';
                break;
            case 9:
                $color = 'bb00ff';
                break;
            case 10:
                $color = '5100ff';
                break;
            case 11:
                $color = '926ae8';
                break;
            case 12:
                $color = '1d3fd0';
                break;
            case 13:
                $color = '43c3fb';
                break;
            case 14:
                $color = '6edccb';
                break;
            case 15:
                $color = '18bfa5';
                break;
            case 16:
                $color = '81d47a';
                break;
            case 17:
                $color = '23dc13';
                break;
            case 18:
                $color = '99bf18';
                break;
            case 19:
                $color = 'dac54c';
                break;
            case 20:
                $color = 'ff9938';
                break;
        }
        return $color;
    }
}
