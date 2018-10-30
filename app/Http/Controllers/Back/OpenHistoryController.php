<?php

namespace App\Http\Controllers\Back;

use App\Bets;
use App\Capital;
use App\Drawing;
use App\Events\RunLHC;
use App\Events\RunXYLHC;
use App\Games;
use App\Helpers\LHC_SX;
use App\UserFreezeMoney;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
        //不能有两个以上相同的数
        $openNumArr =  explode(',',$openNum);
        $openNumArr1 = array_unique($openNumArr);
        if(count($openNumArr1) < count($openNumArr)){
            return response()->json(['status' => false,'msg' => '请勿提交重复号码']);
        }
        $update = DB::table('game_bjkl8')->where('id',$id)->update([
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
    //添加时时彩开奖数据
    public function addsscData(Request $request)
    {
        if(!$gameType = $request->get('type')){
            return response()->json(['status' => false,'msg' => '参数不为空！']);
        }
        $table = 'game_'.$gameType;
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
//        $id = $request->get('id');
//        $n1 = $request->get('n1');
//        $n2 = $request->get('n2');
//        $n3 = $request->get('n3');
//        $n4 = $request->get('n4');
//        $n5 = $request->get('n5');
//        $n6 = $request->get('n6');
//        $n7 = $request->get('n7');
//        $msg = $request->get('msg');
//
//        $openNum = $n1.','.$n2.','.$n3.','.$n4.','.$n5.','.$n6.','.$n7;
//        $totalNum = (int)$n1+(int)$n2+(int)$n3+(int)$n4+(int)$n5+(int)$n6+(int)$n7;
//
//        $update = DB::table('game_xylhc')->where('id',$id)->update([
//            'n1' => $n1,
//            'n2' => $n2,
//            'n3' => $n3,
//            'n4' => $n4,
//            'n5' => $n5,
//            'n6' => $n6,
//            'n7' => $n7,
//            'n1_sb' => $this->LHC->sebo($n1),
//            'n2_sb' => $this->LHC->sebo($n2),
//            'n3_sb' => $this->LHC->sebo($n3),
//            'n4_sb' => $this->LHC->sebo($n4),
//            'n5_sb' => $this->LHC->sebo($n5),
//            'n6_sb' => $this->LHC->sebo($n6),
//            'n7_sb' => $this->LHC->sebo($n7),
//            'n1_sx' => $this->LHC->shengxiao($n1),
//            'n2_sx' => $this->LHC->shengxiao($n2),
//            'n3_sx' => $this->LHC->shengxiao($n3),
//            'n4_sx' => $this->LHC->shengxiao($n4),
//            'n5_sx' => $this->LHC->shengxiao($n5),
//            'n6_sx' => $this->LHC->shengxiao($n6),
//            'n7_sx' => $this->LHC->shengxiao($n7),
//            'msg' => $msg,
//            'open_num' => $openNum,
//            'total_num' => $totalNum,
//            'is_open' => 1
//        ]);
//        if($update == 1){
//            return response()->json([
//                'status' => true
//            ]);
//        } else {
//            return response()->json([
//                'status' => false,
//                'msg' => '开奖数据添加失败！'
//            ]);
//        }
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
    public function cancelBetting($issue,$type){
        $gameInfo = Games::where('code',$type)->first();
        $aBet = Bets::getBetAndUserByIssue($issue,$gameInfo->game_id);
        if(empty($aBet))    return response()->json(['status' => true]);
        $aCapital = [];
        $adminId = Session::get('account_id');
        $dateTime = date('Y-m-d H:i:s');
        foreach ($aBet as $kBet => $iBet){
            $aCapital[] = [
                'to_user' => $iBet['id'],
                'user_type' => 'user',
                'order_id' => $iBet['order_id'],
                'type' => 't16',
                'rechargesType' => 0,
                'game_id' => $gameInfo->game_id,
                'issue' => $iBet['issue'],
                'money' => $iBet['bet_money'],
                'balance' => $iBet['money'],
                'operation_id' => $adminId,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }
        Bets::cancelBetting($issue,$gameInfo->game_id);
        Users::editBatchUserMoneyData($aBet);
        Capital::insert($aCapital);
        return response()->json(['status' => true]);
    }

    //取消注单
    public function cancelBetOrder($orderId){
        $iBet = Bets::where('order_id',$orderId)->first();
        if(empty($iBet))
            return response()->json(['status' => false,'msg' => '注单不存在']);
        $adminId = Session::get('account_id');
        $dateTime = date('Y-m-d H:i:s');
        $iUser = Users::where('id',$iBet->user_id)->first();
        if(empty($iUser))
            return response()->json(['status' => false,'msg' => '用户不存在']);
        $iCapital = [
            'to_user' => $iBet->user_id,
            'user_type' => 'user',
            'order_id' => $iBet->order_id,
            'type' => 't16',
            'rechargesType' => 0,
            'game_id' => $iBet->game_id,
            'issue' => $iBet->issue,
            'money' => $iBet->bet_bunko,
            'balance' => $iUser->money,
            'operation_id' => $adminId,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
        DB::beginTransaction();
        $result1 = Capital::insert($iCapital);
        $result2 = Users::where('id',$iBet->user_id)->increment('money',$iBet->bet_money);
        $result3 = Bets::where('order_id',$orderId)->delete();
        if($result1 && $result2 && $result3){
            DB::commit();
            return response()->json(['status' => true,'msg' => '']);
        }
        DB::rollback();
        return response()->json(['status' => false,'msg' => '注单失败']);
    }

    //撤单2
    public function canceledBetIssue($issue,$type){
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
        return $this->canceledBetIssueOperating($issue,$type,$gameInfo);
    }

    //撤单2操作
    public function canceledBetIssueOperating($issue,$type,$gameInfo){
        $aBet = Bets::getBetAndUserByIssueLose($issue,$gameInfo->game_id);
        DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 6]);
        if(empty($aBet))    return ['status' => true,'mag' => '操作成功2'];
        $aCapital = [];
        $adminId = Session::get('account_id');
        $dateTime = date('Y-m-d H:i:s');
        foreach ($aBet as $kBet => $iBet){
            $aCapital[] = [
                'to_user' => $iBet->id,
                'user_type' => 'user',
                'order_id' => null,
                'type' => 't16',
                'rechargesType' => 0,
                'game_id' => $gameInfo->game_id,
                'issue' => $iBet->issue,
                'money' => -$iBet->bet_bunko,
                'balance' => $iBet->money,
                'operation_id' => $adminId,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }

        DB::beginTransaction();

        try {
            Bets::updateBetStatus($issue, $gameInfo->game_id);
            Users::editBatchUserMoneyData1($aBet);
            Capital::insert($aCapital);
            DB::commit();
            return ['status' => true,'mag' => '操作成功'];
        }catch(\Exception $e){
            DB::rollback();
            return ['status' => false,'msg' => '撤单失败'];
        }
    }

    //冻结
    public function freeze($issue,$type){
        $gameInfo = Games::where('code',$type)->first();;
        if(empty($tableSuffix = Games::$aCodeGameName[$type])){
            return ['status' => false,'msg' => '游戏分类标识错误'];
        }
        return $this->freezeOperating($issue,$type,$gameInfo);
    }

    //冻结操作
    public function freezeOperating($issue,$type,$gameInfo){
        $aBet = Bets::getBetUserDrawingByIssue($issue,$gameInfo->game_id);
        DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 5]);
        if(empty($aBet))    return ['status' => true,'mag' => '操作成功2'];

        $aCapital = [];
        $aUserFreezeMoney = [];
        $adminId = Session::get('account_id');
        $dateTime = date('Y-m-d H:i:s');
        $aUserId = [];
        foreach ($aBet as $kBet => $iBet){
            $aCapital[] = [
                'to_user' => $iBet->id,
                'user_type' => 'user',
                'order_id' => null,
                'type' => 't25',
                'rechargesType' => 0,
                'game_id' => $iBet->game_id,
                'issue' => $iBet->issue,
                'money' => $iBet->amount -$iBet->bet_bunko,
                'balance' => $iBet->money,
                'operation_id' => $adminId,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
            $aUserFreezeMoney[] = [
                'user_id' => $iBet->id,
                'game_id' => $iBet->game_id,
                'issue' => $iBet->issue,
                'money' => -$iBet->bet_bunko,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
            $aUserId[] = $iBet->id;
        }

        DB::beginTransaction();

        try {
            Users::editBatchUserMoneyData2($aBet);
            Users::whereIn('id',$aUserId)->update(['status' => '4']);
            Drawing::whereIn('user_id',$aUserId)->update(['status' => '3','msg' => '提款申请未通过,如有疑问，请咨询在线客服']);
            Bets::where('issue',$issue)->whereIn('user_id',$aUserId)->update(['status' => '3']);
            Capital::insert($aCapital);
            UserFreezeMoney::insert($aUserFreezeMoney);
            DB::commit();
            return ['status' => true,'msg'=> '操作成功'];
        }catch(\Exception $e){
            DB::rollback();
            return ['status' => false,'msg' => '冻结失败'];
        }
    }

    //重新开奖
    public function renewLottery($issue,$type){
        $gameInfo = Games::where('code',$type)->first();;
        if(empty($tableSuffix = Games::$aCodeGameName[$type])){
            return ['status' => false,'msg' => '游戏分类标识错误'];
        }
        if(DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->value('is_open') != 5){
            $result = $this->freezeOperating($issue,$type,$gameInfo);
            if(!$result['status']){
                return $result;
            }
        }
        return $this->renewLotteryOperating($issue,$type,$gameInfo);
    }

    //重新开奖操作
    public function renewLotteryOperating($issue,$type,$gameInfo){
        $aBet = Bets::getBetAndUserByIssueLose($issue,$gameInfo->game_id);
        DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 7]);
        if(empty($aBet)) {
            DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 0]);
            return ['status' => true, 'msg' => '操作成功2'];
        }
        $aCapital = [];
        $adminId = Session::get('account_id');
        $dateTime = date('Y-m-d H:i:s');
        foreach ($aBet as $kBet => $iBet){
            $aCapital[] = [
                'to_user' => $iBet->id,
                'user_type' => 'user',
                'order_id' => null,
                'type' => 't07',
                'rechargesType' => 0,
                'game_id' => $gameInfo->game_id,
                'issue' => $iBet->issue,
                'money' => -$iBet->bet_bunko,
                'balance' => $iBet->money,
                'operation_id' => $adminId,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }

        DB::beginTransaction();

        try {
            Bets::updateBetBunkoClear($issue, $gameInfo->game_id);
            Users::editBatchUserMoneyData1($aBet);
            Capital::insert($aCapital);
            DB::table('game_' . Games::$aCodeGameName[$type])->where('issue',$issue)->update(['is_open' => 0]);
            DB::commit();
            return ['status' => true,'msg'=>'操作成功'];
        }catch(\Exception $e){
            DB::rollback();
            return ['status' => false,'msg' => '撤单失败'];
        }
    }

}
