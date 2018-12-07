<?php

namespace App\Http\Controllers\Back;

use App\Agent;
use App\AgentBackwater;
use App\Bets;
use App\Capital;
use App\Drawing;
use App\Events\LotteryCanceled;
use App\Events\LotteryFreeze;
use App\Events\LotteryRenew;
use App\Events\RunLHC;
use App\Events\RunXYLHC;
use App\Games;
use App\Helpers\LHC_SX;
use App\UserFreezeMoney;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
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
    private $role4 = [
        'id' => 'required',
        'n1' => 'required|integer|max:20',
        'n2' => 'required|integer|max:20',
        'n3' => 'required|integer|max:20',
        'n4' => 'required|integer|max:20',
        'n5' => 'required|integer|max:20',
        'n6' => 'required|integer|max:20',
        'n7' => 'required|integer|max:20',
        'n8' => 'required|integer|max:20',
    ];
    private $role5 = [
        'id' => 'required',
        'n1' => 'required|integer|max:11',
        'n2' => 'required|integer|max:11',
        'n3' => 'required|integer|max:11',
        'n4' => 'required|integer|max:11',
        'n5' => 'required|integer|max:11',
    ];

    //验证器数据
    public function verifyData($data,$type = 1){
        $role = 'role'.$type;
        $validator =  Validator::make($data,$this->$role);
        return ['stauts'=>$validator->fails(),'msg'=> $validator->errors()->first()];
    }
    //添加赛车开奖数据
    public function addscData(Request $request){
        if(!$gameType = $request->get('type')){
            return response()->json(['status' => false,'msg' => '参数不为空！']);
        }
        $table = 'game_'.Games::$aCodeGameName[$gameType];
        $verifyData = $this->verifyData($request->all());
        if($verifyData['stauts']){
            return response()->json(['status' => false, 'msg' => $verifyData['msg']]);
        }
        $id = $this->notTen($request->get('id'));
        $info = DB::table($table)->select('opentime','issue')->where('id',$id)->first();
        if(strtotime($info->opentime) > time())
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
        $data = [
            'opennum' => $openNum,
            'year'=> date('Y',strtotime($info->opentime)),
            'month'=> date('m',strtotime($info->opentime)),
            'day'=>  date('d',strtotime($info->opentime)),
            'is_open' => 1
        ];
        //处理牛牛
        if($table == 'game_mssc'){//秒速赛车
            $niuniu = $this->exePK10nn($openNum);
            $data['niuniu'] =$this->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5]);
        }
        $update = DB::table($table)->where('id',$id)->update($data);
        if($table == 'game_bjpk10'){//北京pk10
            //不能有两个以上相同的数
            $openNumArr =  explode(',',$openNum);
            $openNumArr1 = array_unique($openNumArr);
//            $repeat_arr = array_diff_assoc ( $openNumArr, $openNumArr1 );
            if(count($openNumArr1) < count($openNumArr)){
                return response()->json(['status' => false,'msg' => '请勿提交重复号码']);
            }
            $niuniu = $this->exePK10nn($openNum);
            $data['niuniu'] =$this->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5]);
            $updateNN = DB::table('game_pknn')->where('issue',$info->issue)->update($data);
            if(!$updateNN){
                return response()->json([
                    'status' => false,
                    'msg' => '开奖数据添加失败！'
                ]);
            }
        }
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
        $info = DB::table('game_bjkl8')->select('opentime','issue')->where('id',$id)->first();
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
        //不能有两个以上相同的数
        $openNumArr =  explode(',',$openNum);
        $openNumArr1 = array_unique($openNumArr);
        if(count($openNumArr1) < count($openNumArr)){
            return response()->json(['status' => false,'msg' => '请勿提交重复号码']);
        }

        $data = [
            'opennum' => $openNum,
            'year'=> date('Y',strtotime($info->opentime)),
            'month'=> date('m',strtotime($info->opentime)),
            'day'=>  date('d',strtotime($info->opentime)),
            'is_open' => 1
        ];
        $update = DB::table('game_bjkl8')->where('id',$id)->update($data);
        //处理pc蛋蛋
        $data['opennum'] = implode(',',$this->exePCdd($openNum));
        $update1 = DB::table('game_pcdd')->where('issue',$info->issue)->update($data);
        if(!$update1){
            return response()->json([
                'status' => false,
                'msg' => 'PC蛋蛋开奖数据添加失败！'
            ]);
        }
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
    //添加时时彩开奖数据
    public function addsscData(Request $request)
    {
        if(!$gameType = $request->get('type')){
            return response()->json(['status' => false,'msg' => '参数不为空！']);
        }
        $table = 'game_'.Games::$aCodeGameName[$gameType];
        $verifyData = $this->verifyData($request->all(),2);
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
        $n4 = $request->get('n4');
        $n5 = $request->get('n5');
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5;

        $update = DB::table($table)->where('id',$id)->update([
            'opennum' => $openNum,
            'year'=> date('Y',strtotime($info->opentime)),
            'month'=> date('m',strtotime($info->opentime)),
            'day'=>  date('d',strtotime($info->opentime)),
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
    //广东11选5开奖数据
    public function addGd11x5Data(Request $request){
        $type = $request->get('type');
        switch ($type){
            case 'gd11x5':
                $table = 'game_gd11x5';
                break;
            default:
                return response()->json(['status' => false,'msg' => '参数不为空！']);
        }
        $verifyData = $this->verifyData($request->all(),5);
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
        $n4 = $request->get('n4');
        $n5 = $request->get('n5');
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5;
        //不能有两个以上相同的数
        $openNumArr =  explode(',',$openNum);
        $openNumArr1 = array_unique($openNumArr);
        if(count($openNumArr1) < count($openNumArr)){
            return response()->json(['status' => false,'msg' => '请勿提交重复号码']);
        }
        $update = DB::table($table)->where('id',$id)->update([
            'opennum' => $openNum,
            'year'=> date('Y',strtotime($info->opentime)),
            'month'=> date('m',strtotime($info->opentime)),
            'day'=>  date('d',strtotime($info->opentime)),
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
    //添加幸运农场 快乐十分 开奖数据
    public function addXyncData(Request $request){
        $type = $request->get('type');
        switch ($type){
            case 'xync':
                $table = 'game_cqxync';
                break;
            case 'gdkl10':
                $table = 'game_gdklsf';
                break;
            default:
                return response()->json(['status' => false,'msg' => '参数不为空！']);
        }
        $verifyData = $this->verifyData($request->all(),4);
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
        $n4 = $request->get('n4');
        $n5 = $request->get('n5');
        $n6 = $request->get('n6');
        $n7 = $request->get('n7');
        $n8 = $request->get('n8');
        $msg = $this->notTen($request->get('msg'));

        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5.','.$n6.','.$n7.','.$n8;
        $update = DB::table($table)->where('id',$id)->update([
            'opennum' => $openNum,
            'year'=> date('Y',strtotime($info->opentime)),
            'month'=> date('m',strtotime($info->opentime)),
            'day'=>  date('d',strtotime($info->opentime)),
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
                $table = 'game_jlk3';
                break;
            case 'hbk3':
                $table = 'game_hbk3';
                break;
            case 'gxk3':
                $table = 'game_gxk3';
                break;
            case 'hebeik3':
                $table = 'game_hebeik3';
                break;
            case 'gzk3':
                $table = 'game_gzk3';
                break;
            case 'gsk3':
                $table = 'game_gsk3';
                break;
            default:
                return response()->json(['status' => false,'msg' => '类型不存在！']);
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
            'year'=> date('Y',strtotime($info->opentime)),
            'month'=> date('m',strtotime($info->opentime)),
            'day'=>  date('d',strtotime($info->opentime)),
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

    //添加幸运六合彩开奖数据
    public function addXylhcData(Request $request)
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

        $info = DB::table('game_xylhc')->where('id',$id)->first();
        $update = DB::table('game_xylhc')->where('id',$id)->update([
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
            'year'=> date('Y',strtotime($info->opentime)),
            'month'=> date('m',strtotime($info->opentime)),
            'day'=>  date('d',strtotime($info->opentime)),
            'msg' => $msg,
            'open_num' => $openNum,
            'total_num' => $totalNum,
            'is_open' => 1
        ]);
        if($update == 1){
            $update = DB::table('game_xylhc')->where('id', $id)->update([
                'bunko' => 2
            ]);
            if ($update == 1){
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

    //幸运六合彩重新开奖
    public function reOpenXylhcData(Request $request)
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

        $update = DB::table('game_xylhc')->where('id',$id)->update([
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

    function randOrder($fix)
    {
        $order_id_main = date('YmdHis').rand(10000000,99999999);
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for($i=0; $i<$order_id_len; $i++){
            $order_id_sum += (int)(substr($order_id_main,$i,1));
        }
        $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
        return $fix.$order_id;
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

    //处理秒速牛牛
    private function exePK10nn($opencode){
        if(empty($opencode))
            return false;
        $replace = str_replace('10','0',$opencode);
        $explodeNum = explode(',',$replace);
        $banker = (int)$explodeNum[0].(int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4];
        $player1 = (int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5];
        $player2 = (int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6];
        $player3 = (int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7];
        $player4 = (int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8];
        $player5 = (int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8].(int)$explodeNum[9];
        return [$banker,$player1,$player2,$player3,$player4,$player5];
    }
    //处理pc蛋蛋
    private function exePCdd($opencode){
        if(empty($opencode))
            return false;
        $explodeNum = explode(',',$opencode);
        $player1 = 0;
        $player2 = 0;
        $player3 = 0;
        foreach ($explodeNum as $k=>$v){
            if( $k >= 0 && $k <= 5){
                $player1 += $v;
            }else if( $k >= 6 && $k <= 11){
                $player2 += $v;
            }else if( $k >= 12 && $k <= 17){
                $player3 += $v;
            }
        }
        return [$player1%10, $player2%10, $player3%10];
    }

    function nn($num){
        $aNumber = str_split($num);
        $nSame = array();
        $stop = false;
        $nSp = 0;
        for ($yy = 0;$yy<5;$yy++){
            for ($ii = 0;$ii<5;$ii++){
                for ($xx = 0;$xx<5;$xx++){
                    if($xx==$yy ||$xx==$ii ||$ii==$yy )
                        continue;
                    $nn = str_split($yy.$ii.$xx);
                    sort($nn);
                    $nn = implode("",$nn);
                    if( in_array($nn,$nSame))
                        continue;
                    $nSum = $aNumber[$yy]+$aNumber[$ii]+$aNumber[$xx];
                    if($nSum%10==0){
                        unset($aNumber[$yy]);
                        unset($aNumber[$ii]);
                        unset($aNumber[$xx]);
                        $stop = true;
                        break;
                    }
                    $nSame[] = $nn;
                }
                if($stop)
                    break;
            }
            if($stop)
                break;
        }
        if(!$stop){
            $total = -1; //无牛
        } else {
            foreach ($aNumber as $val)
                $nSp+=$val;  //牛1～牛9&牛牛
            $nSp = $nSp%10==0?10:$nSp%10;
            $total = $nSp;
        }
        return $total;
    }

    //六合彩取消撤单
    public function cancelBettingLHC($issue,$type){
        $this->cancelBetting($issue,$type);
        return response()->json([
            'status' => true
        ]);
    }

    //取消撤单
    public function cancelBetting($issue,$type)
    {
        $gameInfo = Games::where('code', $type)->first();
        $aBet = Bets::getBetAndUserByIssue($issue, $gameInfo->game_id);
        $aCapital = [];
        $iCapital1 = [];
        $adminId = Session::get('account_id');
        $dateTime = date('Y-m-d H:i:s');
        $dateTime1 = date('Y-m-d H:i:s',time()+1);
        foreach ($aBet as $kBet => $iBet) {
            $money = $iBet->bet_money;
            $aCapital[] = [
                'to_user' => $iBet->id,
                'user_type' => 'user',
                'type' => 't16',
                'rechargesType' => 0,
                'game_id' => $gameInfo->game_id,
                'game_name' => $gameInfo->game_name,
                'issue' => $iBet->issue,
                'money' => $money,
                'balance' => $iBet->money + $money,
                'operation_id' => $adminId,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
            if(in_array($iBet->game_id,[90,91])) {
                $money += $iBet->freeze_money;
                $iCapital1[] = [
                    'to_user' => $iBet->id,
                    'user_type' => 'user',
                    'type' => 't26',
                    'rechargesType' => 0,
                    'game_id' => $gameInfo->game_id,
                    'game_name' => $gameInfo->game_name,
                    'issue' => $iBet->issue,
                    'money' => $money,
                    'balance' => $iBet->money + $money,
                    'operation_id' => $adminId,
                    'created_at' => $dateTime1,
                    'updated_at' => $dateTime1,
                ];
            }
        }
        DB::beginTransaction();
        try {
            Bets::updateBetStatus($issue, $gameInfo->game_id);
            if(!empty($aBet)) {
                Users::editBatchUserMoneyData($aBet);
                Capital::insert($aCapital);
            }
            if(in_array($gameInfo->game_id,[90,91]))    Users::editBatchUserFreezeMoneyData($aBet);
            if(!empty($iCapital1))  Capital::insert($iCapital1);

            DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update([
                'is_open' => 6
            ]);

            if(in_array($type,['pk10','bjkl8','jspk10']))
                $this->cancelBetting($issue, Games::$aCodeBindingGame[$type]);

            DB::commit();
            return response()->json(['status' => true]);
        }catch (\Exception $e){
            DB::rollback();
            return response()->json(['status' => false,'msg'=>'撤单失败']);
//        }
    }

    //取消注单
    public function cancelBetOrder($orderId){
//        $iBet = Bets::where('order_id',$orderId)->first();
        $iBet = DB::table('bet')->select('bet.*','game.game_name')
            ->leftjoin('game','bet.game_id','=','game.game_id')->where('order_id',$orderId)->first();
        if(empty($iBet))
            return response()->json(['status' => false,'msg' => '注单不存在']);
        $adminId = Session::get('account_id');
        $dateTime = date('Y-m-d H:i:s');
        $iUser = Users::where('id',$iBet->user_id)->first();
        if(empty($iUser))
            return response()->json(['status' => false,'msg' => '用户不存在']);

        $money = $iBet->bet_money;
        $iCapital = [
            'to_user' => $iBet->user_id,
            'user_type' => 'user',
            'order_id' => 'CN'.substr($iBet->order_id,1),
            'type' => 't16',
            'rechargesType' => 0,
            'game_id' => $iBet->game_id,
            'game_name' => $iBet->game_name,
            'playcate_id' => $iBet->playcate_id,
            'playcate_name' => $iBet->playcate_name,
            'issue' => $iBet->issue,
            'money' => $money,
            'balance' => $iUser->money + $money,
            'operation_id' => $adminId,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        $iCapital1 = [];
        if(in_array($iBet->game_id,[90,91])) {
            $money += $iBet->freeze_money;
            $dateTime1 = date('Y-m-d H:i:s',time()+1);
            $iCapital1 = [
                'to_user' => $iBet->user_id,
                'user_type' => 'user',
                'order_id' => 'CN'.substr($iBet->order_id,1),
                'type' => 't26',
                'rechargesType' => 0,
                'game_id' => $iBet->game_id,
                'game_name' => $iBet->game_name,
                'playcate_id' => $iBet->playcate_id,
                'playcate_name' => $iBet->playcate_name,
                'issue' => $iBet->issue,
                'money' => $money,
                'balance' => $iUser->money + $money,
                'operation_id' => $adminId,
                'created_at' => $dateTime1,
                'updated_at' => $dateTime1,
            ];
        }
        DB::beginTransaction();
        $result1 = Capital::insert($iCapital);
        if(!empty($iCapital1)) Capital::insert($iCapital1);
        $result2 = Users::where('id', $iBet->user_id)->increment('money', $money);
        $result3 = Bets::where('order_id',$orderId)->update([
            'bunko' =>  DB::raw("bet_money"),
            'nn_view_money' => 0
        ]);

        if($result1 && $result2 && $result3){
            DB::commit();
            return response()->json(['status' => true,'msg' => '']);
        }
        DB::rollback();
        return response()->json(['status' => false,'msg' => '注单失败']);
    }

    //结算后撤单
    public function canceledBetIssue($issue,$type){
        $redis = Redis::connection();
        $redis->select(5);
        $key = 'cancel:'.$issue.$type;
        if($redis->exists($key)){
            return ['status' => false,'msg' => '冻结,撤单,重新开奖一分钟内只能操作一次'];
        }
        $redis->setex($key,61,time());
        event(new LotteryCanceled($issue,$type));
        return ['status' => true,'msg'=> '操作成功'];
    }

    //结算后撤单
    public function canceledBetIssueEvent($issue,$type){
        $gameInfo = Games::where('code',$type)->first();
        if(empty($tableSuffix = Games::$aCodeGameName[$type])){
            return ['status' => false,'msg' => '游戏分类标识错误'];
        }
        if(DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->value('is_open') != 5){
            $result = $this->freezeOperating($issue,$type,$gameInfo);
            if(!$result['status']){
                return $result;
            }
        }
        sleep(1);
        return $this->canceledBetIssueOperating($issue,$type,$gameInfo);
    }

    //冻结后的撤单操作
    public function canceledBetIssueOperating($issue,$type,$gameInfo){
        if(!in_array($type,['msnn']))
            DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 11]);
        DB::beginTransaction();

        try {
            $aBetAll = Bets::getBetAndUserByIssueAll($issue,$gameInfo->game_id,false);

            $aAgentBackwater = AgentBackwater::getAgentBackwaterMoney($gameInfo->game_id,$issue);

            if(!in_array($type,['msnn']))
                DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 6]);
            Bets::updateBetStatus($issue, $gameInfo->game_id);
            if(!empty($aBetAll)){
                Users::editBatchUserMoneyDataReturn($aBetAll);
                $aCapital = [];
                $aCapitalBack = [];
                $adminId = Session::get('account_id');
                $dateTime4 = date('Y-m-d H:i:s',time()+4);
                $dateTime5 = date('Y-m-d H:i:s',time()+5);
                foreach ($aBetAll as $kBet => $iBet) {
                    $aCapital[] = [
                        'to_user' => $iBet->id,
                        'user_type' => 'user',
                        'order_id' => $this->randOrder('CN'),
                        'type' => 't16',
                        'rechargesType' => 0,
                        'game_id' => $gameInfo->game_id,
                        'game_name' => $gameInfo->game_name,
                        'issue' => $iBet->issue,
                        'money' => $iBet->bet_money,
                        'balance' => $iBet->money + $iBet->bet_money - $iBet->back_money,
                        'operation_id' => $adminId,
                        'created_at' => $dateTime4,
                        'updated_at' => $dateTime4,
                    ];
                    if($iBet->back_money > 0){
                        $aCapitalBack = [
                            'to_user' => $iBet->id,
                            'user_type' => 'user',
                            'order_id' => $this->randOrder('CNC'),
                            'type' => 't03',
                            'rechargesType' => 0,
                            'game_id' => $gameInfo->game_id,
                            'game_name' => $gameInfo->game_name,
                            'issue' => $iBet->issue,
                            'money' => $iBet->back_money,
                            'balance' => $iBet->money + $iBet->bet_money,
                            'operation_id' => $adminId,
                            'created_at' => $dateTime5,
                            'updated_at' => $dateTime5,
                        ];
                    }
                }
                Capital::insert($aCapital);
                Capital::insert($aCapitalBack);
            }

            if(!empty($aAgentBackwater)){
                AgentBackwater::where('game_id',$gameInfo->game_id)->where('issue',$issue)->update(['status' => 2]);
                DB::update(Agent::updateBatchStitching(json_decode(json_encode($aAgentBackwater),true),['money'],'a_id'));
            }

            UserFreezeMoney::where('game_id',$gameInfo->game_id)->where('issue',$issue)->delete();
            if(in_array($type,['pk10','bjkl8','jspk10'])){
                $gameInfo = Games::where('code',Games::$aCodeBindingGame[$type])->first();
                $this->canceledBetIssueOperating($issue,Games::$aCodeBindingGame[$type],$gameInfo);
            }
            DB::commit();
            return ['status' => true,'mag' => '操作成功'];
        }catch(\Exception $e){
            Log::info($e->getMessage());
            DB::rollback();
            if(!in_array($type,['msnn']))
                DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 12]);
            return ['status' => false,'msg' => '撤单失败'];
        }
    }

    //冻结
    public function freeze($issue,$type){
        $redis = Redis::connection();
        $redis->select(5);
        $key = 'cancel:'.$issue.$type;
        if($redis->exists($key)){
            return ['status' => false,'msg' => '冻结,撤单,重新开奖一分钟内只能操作一次'];
        }
        $redis->setex($key,61,time());
        event(new LotteryFreeze($issue,$type));
        return ['status' => true,'msg'=> '操作成功'];
    }

    public function freezeEvent($issue,$type){
        $gameInfo = Games::where('code',$type)->first();
        if(empty($tableSuffix = Games::$aCodeGameName[$type]))
            return ['status' => false,'msg' => '游戏分类标识错误'];
        return $this->freezeOperating($issue,$type,$gameInfo);
    }

    //冻结操作
    public function freezeOperating($issue,$type,$gameInfo){
        if(!in_array($type,['msnn']))
            DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 8]);

        DB::beginTransaction();

        try {
            $aBet = Bets::getBetUserDrawingByIssue($issue,$gameInfo->game_id);
            $aBetAll = Bets::getBetAndUserByIssueAll($issue,$gameInfo->game_id);
            $aCapitalFreeze = [];
            $aCapital = [];
            $aCapitalBack = [];
            $aUserFreezeMoney = [];
            $adminId = Session::get('account_id');
            $dateTime = date('Y-m-d H:i:s');
            $dateTime1 = date('Y-m-d H:i:s',time()+1);
            $dateTime2 = date('Y-m-d H:i:s',time()+2);
            $aUserId = [];
            if(!empty($aBetAll)){
                foreach ($aBetAll as $kBet => $iBet) {
                    if($iBet->bet_bunko > 0) {
                        $aCapital[] = [
                            'to_user' => $iBet->id,
                            'user_type' => 'user',
                            'order_id' => $this->randOrder('F'),
                            'type' => 't27',
                            'rechargesType' => 0,
                            'game_id' => $iBet->game_id,
                            'game_name' => $gameInfo->game_name,
                            'issue' => $iBet->issue,
                            'money' => -$iBet->bet_bunko,
                            'balance' => $iBet->money - $iBet->bet_bunko,
                            'operation_id' => $adminId,
                            'created_at' => $dateTime,
                            'updated_at' => $dateTime,
                        ];
                    }
                    if($iBet->back_money > 0){
                        $aCapitalBack[] = [
                            'to_user' => $iBet->id,
                            'user_type' => 'user',
                            'order_id' => $this->randOrder('FC'),
                            'type' => 't29',
                            'rechargesType' => 0,
                            'game_id' => $iBet->game_id,
                            'game_name' => $gameInfo->game_name,
                            'issue' => $iBet->issue,
                            'money' => -$iBet->back_money,
                            'balance' => $iBet->money - $iBet->bet_bunko - $iBet->back_money,
                            'operation_id' => $adminId,
                            'created_at' => $dateTime1,
                            'updated_at' => $dateTime1,
                        ];
                    }
                }
            }
            if(!empty($aBet)) {
                foreach ($aBet as $kBet1 => $iBet1) {
                    $amount = empty($iBet1->amount)?0:$iBet1->amount;
                    if(!empty($amount)) {
                        $aCapitalFreeze[] = [
                            'to_user' => $iBet1->id,
                            'user_type' => 'user',
                            'order_id' => null,
                            'type' => 't25',
                            'rechargesType' => 0,
                            'game_id' => $iBet1->game_id,
                            'game_name' => $gameInfo->game_name,
                            'issue' => $iBet1->issue,
                            'money' => $iBet1->amount,
                            'balance' => $iBet1->money - $iBet1->bet_bunko - $iBet1->back_money + $iBet1->amount,
                            'operation_id' => $adminId,
                            'created_at' => $dateTime2,
                            'updated_at' => $dateTime2,
                        ];
                    }

                    if($iBet1->amount > 0) {
                        $aUserFreezeMoney[] = [
                            'user_id' => $iBet1->id,
                            'game_id' => $iBet1->game_id,
                            'issue' => $iBet1->issue,
                            'money' => $iBet1->amount,
                            'status' => 0,
                            'created_at' => $dateTime,
                            'updated_at' => $dateTime,
                        ];
                    }
                    $aUserId[] = $iBet1->id;
                }
            }
            if(!in_array($type,['msnn']))
                DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 5]);
            if(!empty($aBetAll)){
                Users::editBatchUserMoneyDataFreeze($aBetAll);
                Users::editBatchUserMoneyDataBackWater($aBetAll);
                if(!empty($aCapital))    Capital::insert($aCapital);
                if(!empty($aCapitalBack)) Capital::insert($aCapitalBack);
            }
            if(!empty($aBet)) {
                Users::editBatchUserMoneyDataWithdraw($aBet);
                Drawing::whereIn('user_id',$aUserId)->where('status',0)->update(['status' => '3','msg' => '后台手动冻结']);
                Bets::where('issue',$issue)->whereIn('user_id',$aUserId)->update(['status' => '3']);
                if(!empty($aCapitalFreeze))    Capital::insert($aCapitalFreeze);
                UserFreezeMoney::insert($aUserFreezeMoney);
            }
            if(in_array($type,['pk10','bjkl8','jspk10'])){
                $gameInfo = Games::where('code',Games::$aCodeBindingGame[$type])->first();
                $this->freezeOperating($issue,Games::$aCodeBindingGame[$type],$gameInfo);
            }
            DB::commit();
            return ['status' => true,'msg'=> '操作成功'];
        }catch(\Exception $e){
            DB::rollback();
            DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 9]);
            Log::info($e->getMessage());
            return ['status' => false,'msg' => '冻结失败'];
        }
    }

    //重新开奖
    public function renewLottery(Request $request,$issue,$type){
        $redis = Redis::connection();
        $redis->select(5);
        $key = 'cancel:'.$issue.$type;
        if($redis->exists($key)){
            return ['status' => false,'msg' => '冻结,撤单,重新开奖一分钟内只能操作一次'];
        }
        $redis->setex($key,61,time());
        event(new LotteryRenew($request,$issue,$type));
        return ['status' => true,'msg'=> '操作成功'];
    }

    //重新开奖
    public function renewLotteryEvent(Request $request,$issue,$type){
        $aParam = $request->all();
        $number = $this->getOpenLotteryNumber($aParam,$type);
        if(!$number['status'])
            return $number;
        $gameInfo = Games::where('code',$type)->first();
        if(empty($tableSuffix = Games::$aCodeGameName[$type]))
            return ['status' => false,'msg' => '游戏分类标识错误'];
        if(DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->value('is_open') != 5){
            $result = $this->freezeOperating($issue,$type,$gameInfo);
            if(!$result['status'])
                return $result;
        }
        return $this->renewLotteryOperating($issue,$type,$gameInfo,$number['number']);
    }

    //重新开奖操作
    public function renewLotteryOperating($issue,$type,$gameInfo,$number){
        DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 7]);
//        $aBetAll = Bets::getBetAndUserByIssueAll($issue,$gameInfo->game_id);

        DB::beginTransaction();

        try {
//            if(!empty($aBetAll)){
//                $aCapital = [];
//                $adminId = Session::get('account_id');
//                $dateTime3 = date('Y-m-d H:i:s',time()+3);
//                foreach ($aBetAll as $kBet => $iBet){
//                    if($iBet->back_money > 0) {
//                        $aCapital[] = [
//                            'to_user' => $iBet->id,
//                            'user_type' => 'user',
//                            'order_id' => $this->randOrder('CC'),
//                            'type' => 't07',
//                            'rechargesType' => 0,
//                            'game_id' => $gameInfo->game_id,
//                            'game_name' => $gameInfo->game_name,
//                            'issue' => $iBet->issue,
//                            'money' => $iBet->back_money,
//                            'balance' => $iBet->money + $iBet->back_money,
//                            'operation_id' => $adminId,
//                            'created_at' => $dateTime3,
//                            'updated_at' => $dateTime3,
//                        ];
//                    }
//                }
//                Capital::insert($aCapital);
//                Users::editBatchUserMoneyDataBack($aBetAll);
//            }

            Bets::updateBetBunkoClear($issue, $gameInfo->game_id);
            UserFreezeMoney::where('game_id',$gameInfo->game_id)->where('issue',$issue)->delete();

            /* 临时添加 */
            if($type == 'pcdd'){ //如果是北京快乐8  修改pc蛋蛋的号码
                $number = implode(',',$this->exePCdd($number));
            }
            if($type == 'jspk10'){ //秒速赛车 修改牛牛
                $niuniu = $this->exePK10nn($number);
                $opennum =$this->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5]);
                DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['niuniu' => $opennum,'nn_bunko' => 0]);
                Bets::updateBetBunkoClear($issue, 91);
            }
            if($type == 'pk10nn'){ //如果是北京pk10  修改牛牛的号码
                $niuniu = $this->exePK10nn($number);
                $opennum =$this->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5]);
                DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['niuniu' => $opennum]);
            }
            if(!in_array($type,['lhc']))
                DB::table('game_' . Games::$aCodeGameName[$type])->where('issue', $issue)->update(['is_open' => 1, 'bunko' => 0, 'opennum' => $number]);
            if(in_array($type,['pk10','bjkl8'])){
                $gameInfo = Games::where('code',Games::$aCodeBindingGame[$type])->first();
                $this->renewLotteryOperating($issue,Games::$aCodeBindingGame[$type],$gameInfo,$number);
            }
            /* 临时添加 end */
            DB::commit();
            if(!in_array($type,['lhc']))
                return ['status' => true,'msg'=>'操作成功'];
        }catch(\Exception $e){
            DB::rollback();
            DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 10]);
            Log::info($e->getMessage());
            return ['status' => false,'msg' => '撤单失败'];
        }
        if(in_array($type,['lhc']))
            $this->reOpenLhc($number, $issue);
        return ['status' => true,'msg'=>'操作成功'];
    }

    //通过标识获取开奖号
    public function getOpenLotteryNumber($aParam,$type){
        $aCategory = Games::$aCodeCategory;
        $categry = '';
        foreach ($aCategory as $kCategory => $iCategory){
            if(in_array($type,$iCategory))
                $categry = $kCategory;
        }
        if(empty($categry)) return ['status' => false,'msg' => '游戏分类标识不匹配'];
        $actionName = 'get'.$categry.'Number';
        return [
            'status' => true,
            'number' => $this->$actionName($aParam),
        ];
    }

    public function getk3Number($aParam){
        return implode(',',[
            (int)$aParam['n1'],
            (int)$aParam['n2'],
            (int)$aParam['n3'],
        ]);
    }

    public function getsscNumber($aParam){
        return implode(',',[
            (int)$aParam['n1'],
            (int)$aParam['n2'],
            (int)$aParam['n3'],
            (int)$aParam['n4'],
            (int)$aParam['n5'],
        ]);
    }

    public function getscNumber($aParam){
        return implode(',',[
            (int)$aParam['n1'],
            (int)$aParam['n2'],
            (int)$aParam['n3'],
            (int)$aParam['n4'],
            (int)$aParam['n5'],
            (int)$aParam['n6'],
            (int)$aParam['n7'],
            (int)$aParam['n8'],
            (int)$aParam['n9'],
            (int)$aParam['n10'],
        ]);
    }

    public function getxyncNumber($aParam){
        return implode(',',[
            (int)$aParam['n1'],
            (int)$aParam['n2'],
            (int)$aParam['n3'],
            (int)$aParam['n4'],
            (int)$aParam['n5'],
            (int)$aParam['n6'],
            (int)$aParam['n7'],
            (int)$aParam['n8'],
        ]);
    }

    public function getgd11x5Number($aParam){
        return implode(',',[
            (int)$aParam['n1'],
            (int)$aParam['n2'],
            (int)$aParam['n3'],
            (int)$aParam['n4'],
            (int)$aParam['n5'],
        ]);
    }

    public function getbjkl8Number($aParam){
        return implode(',',[
            (int)$aParam['n1'],
            (int)$aParam['n2'],
            (int)$aParam['n3'],
            (int)$aParam['n4'],
            (int)$aParam['n5'],
            (int)$aParam['n6'],
            (int)$aParam['n7'],
            (int)$aParam['n8'],
            (int)$aParam['n9'],
            (int)$aParam['n10'],
            (int)$aParam['n11'],
            (int)$aParam['n12'],
            (int)$aParam['n13'],
            (int)$aParam['n14'],
            (int)$aParam['n15'],
            (int)$aParam['n16'],
            (int)$aParam['n17'],
            (int)$aParam['n18'],
            (int)$aParam['n19'],
            (int)$aParam['n20'],
        ]);
    }

    public function getlhcNumber($aParam){
        return [
            'n1' => $aParam['n1'],
            'n2' => $aParam['n2'],
            'n3' => $aParam['n3'],
            'n4' => $aParam['n4'],
            'n5' => $aParam['n5'],
            'n6' => $aParam['n6'],
            'n7' => $aParam['n7'],
        ];
    }

    //六合彩重新开奖新
    public function reOpenLhc($Number,$issue){
        $openNum = $Number['n1'].','.$Number['n2'].','.$Number['n3'].','.$Number['n4'].','.$Number['n5'].','.$Number['n6'].','.$Number['n7'];
        $totalNum = (int)$Number['n1']+(int)$Number['n2']+(int)$Number['n3']+(int)$Number['n4']+(int)$Number['n5']+(int)$Number['n6']+(int)$Number['n7'];

        DB::table('game_lhc')->where('issue',$issue)->update([
            'n1' => $Number['n1'],
            'n2' => $Number['n2'],
            'n3' => $Number['n3'],
            'n4' => $Number['n4'],
            'n5' => $Number['n5'],
            'n6' => $Number['n6'],
            'n7' => $Number['n7'],
            'n1_sb' => $this->LHC->sebo($Number['n1']),
            'n2_sb' => $this->LHC->sebo($Number['n2']),
            'n3_sb' => $this->LHC->sebo($Number['n3']),
            'n4_sb' => $this->LHC->sebo($Number['n4']),
            'n5_sb' => $this->LHC->sebo($Number['n5']),
            'n6_sb' => $this->LHC->sebo($Number['n6']),
            'n7_sb' => $this->LHC->sebo($Number['n7']),
            'n1_sx' => $this->LHC->shengxiao($Number['n1']),
            'n2_sx' => $this->LHC->shengxiao($Number['n2']),
            'n3_sx' => $this->LHC->shengxiao($Number['n3']),
            'n4_sx' => $this->LHC->shengxiao($Number['n4']),
            'n5_sx' => $this->LHC->shengxiao($Number['n5']),
            'n6_sx' => $this->LHC->shengxiao($Number['n6']),
            'n7_sx' => $this->LHC->shengxiao($Number['n7']),
            'open_num' => $openNum,
            'total_num' => $totalNum,
            'bunko' => 2,
            'is_open' => 1,
        ]);
        $iInfo = DB::table('game_lhc')->where('issue',$issue)->first();
        event(new RunLHC($openNum,$issue,70,$iInfo->id));
    }

}
