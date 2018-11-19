<?php

namespace App\Http\Controllers\Back;

use App\Capital;
use App\Models\Chat\Users;
use App\PromotionConfig;
use App\PromotionReport;
use App\PromotionReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    //推广结算报表-手动结算
    public function settlement(Request $request){
        Artisan::call('PromotionSettle:Settlement');
        return response()->json([
            'status'=>true,
            'msg'=>'结算成功'
        ]);
    }

    //推广配置-新增配置
    public function addConfig(Request $request){
        $params = $request->all();
        $validator = Validator::make($request->post(),PromotionConfig::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [
            'level' => $params['level'],
            'money' => $params['money'],
            'proportion' => $params['proportion'],
        ];
        if(PromotionConfig::insert($data)){
            return response()->json([
                'status'=>true
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法修改，请稍后重试'
            ]);
        }
    }

    //推广配置-修改配置
    public function editConfig(Request $request){
        $params = $request->all();
        $validator = Validator::make($request->post(),PromotionConfig::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [
            'level' => $params['level'],
            'money' => $params['money'],
            'proportion' => $params['proportion'],
        ];
        if(PromotionConfig::where('id','=',$params['id'])->update($data)){
            return response()->json([
                'status'=>true
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法修改，请稍后重试'
            ]);
        }
    }

    //推广结算报表-修改结算
    public function editReport(Request $request){
        $params = $request->post();
        $validator = Validator::make($params,PromotionReport::$role);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'msg'=> $validator->errors()->first()
            ]);
        }
        $data = [
            'bet_money' => $params['bet_money'],
            'fenhong_prop' => $params['fenhong_prop'],
            'commission' => $params['commission'],
        ];
        if(PromotionReport::where('id','=',$params['id'])->update($data)){
            return response()->json([
                'status'=>true
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法修改，请稍后重试'
            ]);
        }
    }

    //推广结算报表-提交审核
    public function commitReport(Request $request){
        $params = $request->post();
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        //开启事务
        DB::beginTransaction();
        $resultOne = PromotionReport::where('id','=',$params['id'])->update(['status'=>2]);
        $reportInfo = PromotionReport::where('id','=',$params['id'])->first();
        if(empty($reportInfo)){
            DB::rollBack();
            return response()->json(['status'=>false,'msg'=>'数据错误']);
        }
        $data = json_decode(json_encode($reportInfo),true);
        $data['report_id'] = $data['id'];
        $data['updated_at'] = date('Y-m-d H:i:s',time());
        unset($data['id']);
        $resultTwo = PromotionReview::insert($data);
        if($resultTwo && $resultOne){
            DB::commit();
            return response()->json(['status'=>true,'msg'=>'提交审核成功']);
        }else{
            DB::rollBack();
            return response()->json(['status'=>true,'msg'=>'提交审核失败']);
        }
    }

    //推广结算审核-提交驳回
    public function submitTurnDown(Request $request){
        $params = $request->post();
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        //开启事务
        DB::beginTransaction();
        try {
            PromotionReview::where('id', '=', $params['id'])->update(['status' => $params['status']]);
            $reportInfo = PromotionReview::select('promotion_review.*','users.money')->where('promotion_review.id', '=', $params['id'])
                ->join('users','users.id','=','promotion_review.promotion_id')->first();
            PromotionReport::where('id', '=', $reportInfo->report_id)->update(['status' => $params['status']]);
            if ($params['status'] == 1) {
                Users::where('id', '=', $reportInfo->promotion_id)->increment('money', -$reportInfo->commission);
            }
            $adminId = Session::get('account_id');
            $dateTime = date('Y-m-d H:i:s');
            Capital::insert([
                'to_user' => $reportInfo->promotion_id,
                'user_type' => 'user',
                'type' => 't28',
                'rechargesType' => 0,
                'money' => -$reportInfo->commission,
                'balance' => $reportInfo->money - $reportInfo->commission,
                'operation_id' => $adminId,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ]);
            DB::commit();
            return response()->json(['status'=>true,'msg'=>'提交结算成功']);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['status'=>true,'msg'=>'提交结算失败']);
        }
    }
}
