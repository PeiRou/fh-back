<?php

namespace App\Http\Controllers\Back;

use App\Events\RunLHC;
use App\Helpers\LHC_SX;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    //验证规则
    private $role1 = [
        'id' => 'required',
        'n1' => 'required|integer|max:10',
        'n2' => 'required|integer|max:10',
        'n3' => 'required|integer|max:10',
        'n4' => 'required|integer|max:10',
        'n5' => 'required|integer|max:10',
        'n6' => 'required|integer|max:10',
        'n7' => 'required|integer|max:10',
        'n8' => 'required|integer|max:10',
        'n9' => 'required|integer|max:10',
        'n10' => 'required|integer|max:10',
    ];
    private $role2 = [
        'id' => 'required',
        'n1' => 'required|integer|max:10',
        'n2' => 'required|integer|max:10',
        'n3' => 'required|integer|max:10',
        'n4' => 'required|integer|max:10',
        'n5' => 'required|integer|max:10',
    ];
    private $role3 = [
        'id' => 'required',
        'n1' => 'required|integer|max:6',
        'n2' => 'required|integer|max:6',
        'n3' => 'required|integer|max:6',
    ];

    //验证器数据
    public function verifyData($data,$type = 1){
        $role = 'role'.$type;
        $validator =  Validator::make($data,$this->$role);
        return ['stauts'=>$validator->fails(),'msg'=> $validator->errors()->first()];
    }

    //添加北京PK10开奖数据
    public function addBjpk10Data(Request $request)
    {
        $verifyData = $this->verifyData($request->all());
        if($verifyData['stauts']){
            return response()->json(['status' => false, 'msg' => $verifyData['msg']]);
        }
        $id = $this->notTen($request->get('id'));
        $info = DB::table('game_bjpk10')->select('opentime')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
            return response()->json(['status' => false,'msg' => '请勿提早开奖']);
        $n1 = $this->notTen($request->get('n1'));
        $n2 = $this->notTen($request->get('n2'));
        $n3 = $this->notTen($request->get('n3'));
        $n4 = $this->notTen($request->get('n4'));
        $n5 = $this->notTen($request->get('n5'));
        $n6 = $this->notTen($request->get('n6'));
        $n7 = $this->notTen($request->get('n7'));
        $n8 = $this->notTen($request->get('n8'));
        $n9 = $this->notTen($request->get('n9'));
        $n10 = $this->notTen($request->get('n10'));
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5.','.$n6.','.$n7.','.$n8.','.$n9.','.$n10;

        $update = DB::table('game_bjpk10')->where('id',$id)->update([
            'opennum' => $openNum,
            'is_open' => 1
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

    //添加秒速赛车开奖数据
    public function addMsscData(Request $request){
        $verifyData = $this->verifyData($request->all());
        if($verifyData['stauts']){
            return response()->json(['status' => false, 'msg' => $verifyData['msg']]);
        }
        $id = $this->notTen($request->get('id'));
        $info = DB::table('game_mssc')->select('opentime')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
            return response()->json(['status' => false,'msg' => '请勿提早开奖']);
        $n1 = $this->notTen($request->get('n1'));
        $n2 = $this->notTen($request->get('n2'));
        $n3 = $this->notTen($request->get('n3'));
        $n4 = $this->notTen($request->get('n4'));
        $n5 = $this->notTen($request->get('n5'));
        $n6 = $this->notTen($request->get('n6'));
        $n7 = $this->notTen($request->get('n7'));
        $n8 = $this->notTen($request->get('n8'));
        $n9 = $this->notTen($request->get('n9'));
        $n10 = $this->notTen($request->get('n10'));
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5.','.$n6.','.$n7.','.$n8.','.$n9.','.$n10;

        $update = DB::table('game_mssc')->where('id',$id)->update([
            'opennum' => $openNum,
            'is_open' => 1
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

    //添加秒速飞艇开奖数据
    public function addMsftData(Request $request)
    {
        $verifyData = $this->verifyData($request->all());
        if($verifyData['stauts']){
            return response()->json(['status' => false, 'msg' => $verifyData['msg']]);
        }
        $id = $this->notTen($request->get('id'));
        $info = DB::table('game_msft')->select('opentime')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
            return response()->json(['status' => false,'msg' => '请勿提早开奖']);
        $n1 = $this->notTen($request->get('n1'));
        $n2 = $this->notTen($request->get('n2'));
        $n3 = $this->notTen($request->get('n3'));
        $n4 = $this->notTen($request->get('n4'));
        $n5 = $this->notTen($request->get('n5'));
        $n6 = $this->notTen($request->get('n6'));
        $n7 = $this->notTen($request->get('n7'));
        $n8 = $this->notTen($request->get('n8'));
        $n9 = $this->notTen($request->get('n9'));
        $n10 = $this->notTen($request->get('n10'));
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5.','.$n6.','.$n7.','.$n8.','.$n9.','.$n10;

        $update = DB::table('game_msft')->where('id',$id)->update([
            'opennum' => $openNum,
            'is_open' => 1
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

    //添加跑马开奖数据
    public function addPaomaData(Request $request)
    {
        $verifyData = $this->verifyData($request->all());
        if($verifyData['stauts']){
            return response()->json(['status' => false, 'msg' => $verifyData['msg']]);
        }
        $id = $this->notTen($request->get('id'));
        $info = DB::table('game_paoma')->select('opentime')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
            return response()->json(['status' => false,'msg' => '请勿提早开奖']);
        $n1 = $this->notTen($request->get('n1'));
        $n2 = $this->notTen($request->get('n2'));
        $n3 = $this->notTen($request->get('n3'));
        $n4 = $this->notTen($request->get('n4'));
        $n5 = $this->notTen($request->get('n5'));
        $n6 = $this->notTen($request->get('n6'));
        $n7 = $this->notTen($request->get('n7'));
        $n8 = $this->notTen($request->get('n8'));
        $n9 = $this->notTen($request->get('n9'));
        $n10 = $this->notTen($request->get('n10'));
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5.','.$n6.','.$n7.','.$n8.','.$n9.','.$n10;

        $update = DB::table('game_paoma')->where('id',$id)->update([
            'opennum' => $openNum,
            'is_open' => 1
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

    //添加北京快乐8开奖数据
    public function addBjkl8Data(Request $request)
    {
        $id = $this->notTen($request->get('id'));
        $info = DB::table('game_bjkl8')->select('opentime')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
            return response()->json(['status' => false,'msg' => '请勿提早开奖']);
        $n1 = $this->notTen($request->get('n1'));
        $n2 = $this->notTen($request->get('n2'));
        $n3 = $this->notTen($request->get('n3'));
        $n4 = $this->notTen($request->get('n4'));
        $n5 = $this->notTen($request->get('n5'));
        $n6 = $this->notTen($request->get('n6'));
        $n7 = $this->notTen($request->get('n7'));
        $n8 = $this->notTen($request->get('n8'));
        $n9 = $this->notTen($request->get('n9'));
        $n10 = $this->notTen($request->get('n10'));
        $n11 = $this->notTen($request->get('n11'));
        $n12 = $this->notTen($request->get('n12'));
        $n13 = $this->notTen($request->get('n13'));
        $n14 = $this->notTen($request->get('n14'));
        $n15 = $this->notTen($request->get('n15'));
        $n16 = $this->notTen($request->get('n16'));
        $n17 = $this->notTen($request->get('n17'));
        $n18 = $this->notTen($request->get('n18'));
        $n19 = $this->notTen($request->get('n19'));
        $n20 = $this->notTen($request->get('n20'));
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5.','.$n6.','.$n7.','.$n8.','.$n9.','.$n10.','.$n11.','.$n12.','.$n13.','.$n14.','.$n15.','.$n16.','.$n17.','.$n18.','.$n19.','.$n20;

        $update = DB::table('game_bjkl8')->where('id',$id)->update([
            'opennum' => $openNum,
            'is_open' => 1
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

    //添加重庆时时彩开奖数据
    public function addCqsscData(Request $request)
    {
        $verifyData = $this->verifyData($request->all(),2);
        if($verifyData['stauts']){
            return response()->json(['status' => false, 'msg' => $verifyData['msg']]);
        }
        $id = $this->notTen($request->get('id'));
        $info = DB::table('game_cqssc')->select('opentime')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
            return response()->json(['status' => false,'msg' => '请勿提早开奖']);
        $n1 = $request->get('n1');
        $n2 = $request->get('n2');
        $n3 = $request->get('n3');
        $n4 = $request->get('n4');
        $n5 = $request->get('n5');
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5;

        $update = DB::table('game_cqssc')->where('id',$id)->update([
            'opennum' => $openNum,
            'is_open' => 1
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

    //添加秒速时时彩开奖数据
    public function addMssscData(Request $request)
    {
        $verifyData = $this->verifyData($request->all(),2);
        if($verifyData['stauts']){
            return response()->json(['status' => false, 'msg' => $verifyData['msg']]);
        }
        $id = $this->notTen($request->get('id'));
        $info = DB::table('game_msssc')->select('opentime')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
            return response()->json(['status' => false,'msg' => '请勿提早开奖']);
        $n1 = $request->get('n1');
        $n2 = $request->get('n2');
        $n3 = $request->get('n3');
        $n4 = $request->get('n4');
        $n5 = $request->get('n5');
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5;

        $update = DB::table('game_msssc')->where('id',$id)->update([
            'opennum' => $openNum,
            'is_open' => 1
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

    //添加秒速快三开奖数据
    public function addK3Data(Request $request)
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
                $table = 'game_ahk3';
                break;
            default:
                return response()->json(['status' => false,'msg' => '参数不为空！']);
        }
        $verifyData = $this->verifyData($request->all(),3);
        if($verifyData['stauts']){
            return response()->json(['status' => false, 'msg' => $verifyData['msg']]);
        }
        $id = $this->notTen($request->get('id'));
        $info = DB::table($table)->select('opentime')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
            return response()->json(['status' => false,'msg' => '请勿提早开奖']);
        $n1 = $request->get('n1');
        $n2 = $request->get('n2');
        $n3 = $request->get('n3');
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3;

        $update = DB::table($table)->where('id',$id)->update([
            'opennum' => $openNum,
            'is_open' => 1
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

    private function notTen($num){
        $num = (int)$num;
        if($num<10)
            $num = '0'.(string)$num;
        return $num;
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

        $update = DB::table('game_lhc')->where('id',$id)->update([
            'n1' => $n1,
            'n2' => $n2,
            'n3' => $n3,
            'n4' => $n4,
            'n5' => $n5,
            'n6' => $n6,
            'n7' => $n7,
            'n1_sb' => $this->LHC->sebo($n1),
            'n2_sb' => $this->LHC->sebo($n2),
            'n3_sb' => $this->LHC->sebo($n3),
            'n4_sb' => $this->LHC->sebo($n4),
            'n5_sb' => $this->LHC->sebo($n5),
            'n6_sb' => $this->LHC->sebo($n6),
            'n7_sb' => $this->LHC->sebo($n7),
            'n1_sx' => $this->LHC->shengxiao($n1),
            'n2_sx' => $this->LHC->shengxiao($n2),
            'n3_sx' => $this->LHC->shengxiao($n3),
            'n4_sx' => $this->LHC->shengxiao($n4),
            'n5_sx' => $this->LHC->shengxiao($n5),
            'n6_sx' => $this->LHC->shengxiao($n6),
            'n7_sx' => $this->LHC->shengxiao($n7),
            'msg' => $msg,
            'open_num' => $openNum,
            'total_num' => $totalNum,
            'is_open' => 1
        ]);
        if($update == 1){
            $getIssue = DB::table('game_lhc')->where('id',$id)->first();
            $update = DB::table('game_lhc')->where('id', $id)->update([
                'bunko' => 2
            ]);
            if ($update == 1){
                event(new RunLHC($openNum,$getIssue->issue,70,$id)); //触发六合彩结算事件
                return response()->json([
                    'status' => true
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'msg' => '开奖数据添加失败！'
            ]);
        }
    }

    //六合彩重新开奖
    public function reOpenLhcData(Request $request)
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

        $update = DB::table('game_lhc')->where('id',$id)->update([
            'n1' => $n1,
            'n2' => $n2,
            'n3' => $n3,
            'n4' => $n4,
            'n5' => $n5,
            'n6' => $n6,
            'n7' => $n7,
            'n1_sb' => $this->LHC->sebo($n1),
            'n2_sb' => $this->LHC->sebo($n2),
            'n3_sb' => $this->LHC->sebo($n3),
            'n4_sb' => $this->LHC->sebo($n4),
            'n5_sb' => $this->LHC->sebo($n5),
            'n6_sb' => $this->LHC->sebo($n6),
            'n7_sb' => $this->LHC->sebo($n7),
            'n1_sx' => $this->LHC->shengxiao($n1),
            'n2_sx' => $this->LHC->shengxiao($n2),
            'n3_sx' => $this->LHC->shengxiao($n3),
            'n4_sx' => $this->LHC->shengxiao($n4),
            'n5_sx' => $this->LHC->shengxiao($n5),
            'n6_sx' => $this->LHC->shengxiao($n6),
            'n7_sx' => $this->LHC->shengxiao($n7),
            'msg' => $msg,
            'open_num' => $openNum,
            'total_num' => $totalNum,
            'is_open' => 1
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
